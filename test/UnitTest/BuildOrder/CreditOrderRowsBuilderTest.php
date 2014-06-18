<?php
namespace Svea;

$root = realpath(dirname(__FILE__));
require_once $root . '/../../../src/Includes.php';

$root = realpath(dirname(__FILE__));
require_once $root . '/../../TestUtil.php';

/**
 * @author Kristian Grossman-Madsen for Svea Webpay
 */
class CreditOrderRowsBuilderTest extends \PHPUnit_Framework_TestCase {

    protected $creditOrderRowsObject;
    
    function setUp() {
        $this->creditOrderRowsObject = new CreditOrderRowsBuilder(SveaConfig::getDefaultConfig());  
    }
    
    public function test_creditOrderRowsBuilder_class_exists() {     
        $this->assertInstanceOf("Svea\CreditOrderRowsBuilder", $this->creditOrderRowsObject);
    }
    
    public function test_creditOrderRowsBuilder_setOrderId() {
        $orderId = "123456";
        $this->creditOrderRowsObject->setOrderId($orderId);
        $this->assertEquals($orderId, $this->creditOrderRowsObject->orderId);        
    }
    
    public function test_creditOrderRowsBuilder_setInvoiceId() {
        $orderId = "123456";
        $this->creditOrderRowsObject->setInvoiceId($orderId);
        $this->assertEquals($orderId, $this->creditOrderRowsObject->invoiceId);        
    }
    public function test_creditOrderRowsBuilder_setCountryCode() {
        $country = "SE";
        $this->creditOrderRowsObject->setCountryCode($country);
        $this->assertEquals($country, $this->creditOrderRowsObject->countryCode);        
    }
    
    public function test_creditOrderRowsBuilder_setOrderType() {
        $orderType = \ConfigurationProvider::INVOICE_TYPE;
        $this->creditOrderRowsObject->setOrderType($orderType);
        $this->assertEquals($orderType, $this->creditOrderRowsObject->orderType);        
    }
    
    public function test_creditOrderRowsBuilder_setInvoiceDistributionType() {
        $distributionType = \DistributionType::POST;
        $this->creditOrderRowsObject->setInvoiceDistributionType($distributionType);
        $this->assertEquals($distributionType, $this->creditOrderRowsObject->distributionType);        
    }
    
    public function test_addNumberedOrderRow() {
        $numberedOrderRow = new \Svea\NumberedOrderRow();
        $numberedOrderRow
            ->setAmountExVat(100.00)                // recommended to specify price using AmountExVat & VatPercent
            ->setVatPercent(25)                     // recommended to specify price using AmountExVat & VatPercent
            ->setQuantity(1)                        // required
            ->setRowNumber(1)
        ;            
                
        $this->creditOrderRowsObject->addNumberedOrderRow( $numberedOrderRow );
        $this->assertInternalType('array', $this->creditOrderRowsObject->numberedOrderRows);     
    }
    
    public function test_addNumberedOrderRows() {
        $numberedOrderRow1 = new \Svea\NumberedOrderRow();
        $numberedOrderRow1
            ->setAmountExVat(100.00)                // recommended to specify price using AmountExVat & VatPercent
            ->setVatPercent(25)                     // recommended to specify price using AmountExVat & VatPercent
            ->setQuantity(1)                        // required
            ->setRowNumber(1)
        ;   
        $numberedOrderRow2 = new \Svea\NumberedOrderRow();
        $numberedOrderRow2
            ->setAmountExVat(100.00)                // recommended to specify price using AmountExVat & VatPercent
            ->setVatPercent(25)                     // recommended to specify price using AmountExVat & VatPercent
            ->setQuantity(1)                        // required
            ->setRowNumber(2)
        ;  
                
        $this->creditOrderRowsObject->addNumberedOrderRows( array( $numberedOrderRow1, $numberedOrderRow2 ) );
        $this->assertInternalType('array', $this->creditOrderRowsObject->numberedOrderRows);     
    }
    
    public function test_creditOrderRowsBuilder_creditInvoiceOrderRowsBuilder_returns_CreditOrderRowsRequest() {
        $orderId = "123456";
        $creditOrderRowsObject = $this->creditOrderRowsObject->setOrderId($orderId)->creditInvoiceOrderRows();
        
        $this->assertInstanceOf("Svea\AdminService\CreditOrderRowsRequest", $creditOrderRowsObject);
    }
    
    public function test_creditOrderRowsBuilder_creditCardOrderRowsBuilder_returns_LowerTransaction() {
        $orderId = "123456";  
        $mockedNumberedOrderRow = new \Svea\NumberedOrderRow();
        $mockedNumberedOrderRow
            ->setAmountExVat(100.00)                // recommended to specify price using AmountExVat & VatPercent
            ->setVatPercent(25)                     // recommended to specify price using AmountExVat & VatPercent
            ->setQuantity(1)                        // required
            ->setRowNumber(1)
        ;            
        
        $creditOrderRowsObject = $this->creditOrderRowsObject
                ->setOrderId($orderId)
                ->addNumberedOrderRow( $mockedNumberedOrderRow )
                ->setRowToCredit(1)
        ;
        
        $request = $creditOrderRowsObject->creditCardOrderRows();
        
        $this->assertInstanceOf("Svea\HostedService\CreditTransaction", $request);
    }
    
    public function test_creditOrderRowsBuilder_creditDirectBankOrderRowsBuilder_returns_LowerTransaction() {
        $orderId = "123456";  
        $mockedNumberedOrderRow = new \Svea\NumberedOrderRow();
        $mockedNumberedOrderRow
            ->setAmountExVat(100.00)                // recommended to specify price using AmountExVat & VatPercent
            ->setVatPercent(25)                     // recommended to specify price using AmountExVat & VatPercent
            ->setQuantity(1)                        // required
            ->setRowNumber(1)
        ;            
        
        $creditOrderRowsObject = $this->creditOrderRowsObject
                ->setOrderId($orderId)
                ->addNumberedOrderRow( $mockedNumberedOrderRow )
                ->setRowToCredit(1)
        ;
        
        $request = $creditOrderRowsObject->creditDirectBankOrderRows();
        
        $this->assertInstanceOf("Svea\HostedService\CreditTransaction", $request);
    }
    
}
