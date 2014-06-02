<?php
namespace Svea;

require_once SVEA_REQUEST_DIR . '/Includes.php';

/**
 * CancelOrderRowsBuilder is used to cancel individual order rows in a unified manner.
 * 
 * For Invoice and Payment Plan orders, the order row status of the order is updated
 * to reflect the order rows new status'.
 * 
 * For Card orders, individual order rows will still reflect the status they got in 
 * order creation, even if orders have since been cancelled, and the order amount 
 * to be charged is simply lowered by sum of the order rows' amount.
 * 
 * Use setOrderId() to specify the Svea order id, this is the order id returned 
 * with the original create order request response.
 *
 * Use setCountryCode() to specify the country code matching the original create
 * order request.
 * 
 * Use setRowToCancel or setRowsToCancel() to specify the order row(s) to cancel.
 * 
 * For card orders, use setNumberedOrderRows() to pass in order rows (from i.e. queryOrder)
 * 
 * Then use either cancelInvoiceOrderRows(), cancelPaymentPlanOrderRows or cancelCardOrderRows,
 * which ever matches the payment method used in the original order request.
 *  
 * The final doRequest() will send the queryOrder request to Svea, and the 
 * resulting response code specifies the outcome of the request. 
 * 
 * @author Kristian Grossman-Madsen for Svea WebPay
 */
class CancelOrderRowsBuilder {

    /** @var ConfigurationProvider $conf  */
    public $conf;
    
    /** @var int[] $rowsToCancel */
    public $rowsToCancel;

    /** @var NumberedOrderRows[] $numberedOrderRows */
    public $numberedOrderRows;

    public function __construct($config) {
         $this->conf = $config;
         $this->rowsToCancel = array();
         $this->numberedOrderRows = array();
    }

    /**
     * Required. Use SveaOrderId recieved with createOrder response.
     * @param string $orderIdAsString
     * @return $this
     */
    public function setOrderId($orderIdAsString) {
        $this->orderId = $orderIdAsString;
        return $this;
    }
    /** string $orderId  Svea order id to query, as returned in the createOrder request response, either a transactionId or a SveaOrderId */
    public $orderId;
    
    /**
     * Required. Use same countryCode as in createOrder request.
     * @param string $countryCode
     * @return $this
     */
    public function setCountryCode($countryCodeAsString) {
        $this->countryCode = $countryCodeAsString;
        return $this;
    }
    /** @var string $countryCode */
    public $countryCode;

    /**
     * Required.
     * @param string $orderType -- one of ConfigurationProvider::INVOICE_TYPE, ::PAYMENTPLAN_TYPE, ::HOSTED_TYPE
     * @return $this
     */
    public function setOrderType($orderTypeAsConst) {
        $this->orderType = $orderTypeAsConst;
        return $this;
    }
    /** @var string $orderType -- one of ConfigurationProvider::INVOICE_TYPE, ::PAYMENTPLAN_TYPE, ::HOSTED_TYPE */
    public $orderType;    

    /**
     * Required.
     * @param numeric $rowNumber
     * @return $this
     */
    public function setRowToCancel( $rowNumber ) {
        $this->rowsToCancel[] = $rowNumber;
        return $this;
    }    
    
    /**
     * Convenience method to provide several row numbers at once.
     * @param int[] $rowNumbers
     * @return $this
     */
    public function setRowsToCancel( $rowNumbers ) {
        array_merge( $this->rowsToCancel, $rowNumbers );
        return $this;
    }    
    
    /**
     * CancelCardOrderRows: Required
     * When cancelling card order rows, you must pass in an array of NumberedOrderRows
     * along with the request. This array is then matched with the order rows specified
     * with setRow(s)ToCredit(). 
     * 
     * Note: the card order does not update the state of any cancelled order rows, only
     * the total order amount to be charged.     
     */
    public function setNumberedOrderRows( $numberedOrderRows ) {
        $this->numberedOrderRows = $numberedOrderRows;
        return $this;
    }

    /**
     * Use cancelInvoiceOrderRows() to cancel an Invoice order using AdminServiceRequest CancelOrderRows request
     * @return CancelOrderRowsRequest 
     */
    public function cancelInvoiceOrderRows() {
        $this->setOrderType(\ConfigurationProvider::INVOICE_TYPE );
        return new CancelOrderRowsRequest($this);
    }
    
    /**
     * Use cancelPaymentPlanOrderRows() to cancel a PaymentPlan order using AdminServiceRequest CancelOrderRows request
     * @return CancelOrderRowsRequest 
     */
    public function cancelPaymentPlanOrderRows() {
        $this->setOrderType(\ConfigurationProvider::PAYMENTPLAN_TYPE);
        return new CancelOrderRowsRequest($this);    
    }

    /**
     * Use cancelCardOrderRows() to lower the amount of a Card order by the specified order row amounts using HostedRequests LowerTransaction request
     * 
     * @return LowerTransaction
     * @throws ValidationException  if setNumberedOrderRows() has not been used.
     */
    public function cancelCardOrderRows() {
        $this->setOrderType(\ConfigurationProvider::HOSTED_ADMIN_TYPE);
                
        $this->validateCancelCardOrderRows();
        $sumOfRowAmounts = $this->calculateSumOfRowAmounts( $this->rowsToCancel, $this->numberedOrderRows );
        
        $lowerTransaction = new LowerTransaction($this->conf);
        $lowerTransaction
            ->setTransactionId($this->orderId)
            ->setCountryCode($this->countryCode)
            ->setAmountToLower($sumOfRowAmounts*100) // *100, as setAmountToLower wants minor currency
        ;
                
        return $lowerTransaction;
    }
    
    private function validateCancelCardOrderRows() {           
        if(count($this->numberedOrderRows) == 0) {
            $exceptionString = "numberedOrderRows is required for cancelCardOrderRows(). Use method setNumberedOrderRows().";
            throw new ValidationException($exceptionString);
        }
        if(count($this->rowsToCancel) == 0) {
            $exceptionString = "rowsToCancel is required for cancelCardOrderRows(). Use method setRowToCancel() or setRowsToCancel.";
            throw new ValidationException($exceptionString);
        }
    } 

    private function calculateSumOfRowAmounts( $rowIndexes, $numberedRows ) {
        $sum = 0.0;
        $unique_indexes = array_unique( $rowIndexes );
        foreach( $numberedRows as $numberedRow) {            
            if( in_array($numberedRow->rowNumber,$unique_indexes) ) {
                $sum += ($numberedRow->quantity * ($numberedRow->amountExVat * (1 + ($numberedRow->vatPercent/100))));
            }
        }
        return $sum;
    }
}