<?php
namespace Svea;

require_once SVEA_REQUEST_DIR . '/Includes.php';

/**
 * CancelOrderBuilder is the class used to cancel an order with Svea, that has
 * not yet been delivered (invoice, payment plan) or been confirmed (card).
 * 
 * Supports Invoice, Payment Plan and Card orders. For Direct Bank orders, @see
 * CreditOrderBuilder instead.
 * 
 * Use setOrderId() to specify the Svea order id, this is the order id returned 
 * with the original create order request response.
 *
 * Use setCountryCode() to specify the country code matching the original create
 * order request.
 * 
 * Use either cancelInvoiceOrder(), cancelPaymentPlanOrder or cancelCardOrder,
 * which ever matches the payment method used in the original order request.
 *  
 * The final doRequest() will send the cancelOrder request to Svea, and the 
 * resulting response code specifies the outcome of the request. 
 * 
 * @author Kristian Grossman-Madsen for Svea Webpay
 */
class CancelOrderBuilder {

    /** ConfigurationProvider $conf  */
    public $conf;
    
    public function __construct($config) {
         $this->conf = $config;
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
    /** string $orderId  Svea order id to cancel, as returned in the createOrder request response, either a transactionId or a SveaOrderId */
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
     * Use cancelInvoiceOrder() to close an Invoice order.
     * @return CloseOrder
     */
    public function cancelInvoiceOrder() {
        $this->orderType = \ConfigurationProvider::INVOICE_TYPE;
        return new CloseOrder($this);
    }
    
    /**
     * Use cancelPaymentPlanOrder() to close a PaymentPlan order.
     * @return CloseOrder
     */
    public function cancelPaymentPlanOrder() {
        $this->orderType = \ConfigurationProvider::PAYMENTPLAN_TYPE;
        return new CloseOrder($this);    
    }
    
    /** @var string "Invoice" or "PaymentPlan" */
    public $orderType;  

    /**
     * Use cancelCardOrder() to close a Card order.
     * @return AnnulTransaction
     */
    public function cancelCardOrder() {
        $this->orderType = \ConfigurationProvider::HOSTED_ADMIN_TYPE;
        $annulTransaction = new AnnulTransaction($this->conf);
        return $annulTransaction->setTransactionId($this->orderId)->setCountryCode($this->countryCode);
    }  
}
