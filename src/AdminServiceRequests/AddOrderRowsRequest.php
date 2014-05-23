<?php
namespace Svea;

require_once SVEA_REQUEST_DIR . '/Includes.php';
require_once 'AdminServiceRequest.php';

/**
 * Admin Service AddOrderRowsRequest class
 * 
 * @author Kristian Grossman-Madsen
 */
class AddOrderRowsRequest extends AdminServiceRequest {
    
    /** @var AddOrderRowBuilder $orderBuilder */
    public $orderBuilder;

    /**
     * @param addOrderRowsBuilder $orderBuilder
     */
    public function __construct($addOrderRowsBuilder) {
        $this->action = "AddOrderRows";
        $this->orderBuilder = $addOrderRowsBuilder;
    }

    /**
     * populate and return soap request contents using AdminSoap helper classes to get the correct data format
     * @return Svea\AdminSoap\AddOrderRowsRequest
     */    
    public function prepareRequest() {        
                   
        $this->validateRequest();

        $orderRowNumbers = array();        
        foreach( $this->orderBuilder->orderRows as $orderRow ) {       
            $orderRows[] = new \SoapVar($orderRow, SOAP_ENC_OBJECT, null, null, 'OrderRow', "http://schemas.microsoft.com/2003/10/Serialization/Arrays");
        }        
        
        $soapRequest = new AdminSoap\AddOrderRowsRequest( 
            new AdminSoap\Authentication( 
                $this->orderBuilder->conf->getUsername( strtoupper($this->orderBuilder->orderType), $this->orderBuilder->countryCode ), 
                $this->orderBuilder->conf->getPassword( strtoupper($this->orderBuilder->orderType), $this->orderBuilder->countryCode ) 
            ),
            $this->orderBuilder->conf->getClientNumber( strtoupper($this->orderBuilder->orderType), $this->orderBuilder->countryCode ),
            new \SoapVar($orderRows, SOAP_ENC_OBJECT),            
            AdminServiceRequest::CamelCaseOrderType( $this->orderBuilder->orderType ),
            $this->orderBuilder->orderId
        );
        return $soapRequest;
    }
        
    public function validate() {
        $errors = array();
        $errors = $this->validateOrderId($errors);
        $errors = $this->validateOrderType($errors);
        $errors = $this->validateCountryCode($errors);
        $errors = $this->validateRowsToAdd($errors);                        
        return $errors;
    }
    
    private function validateOrderId($errors) {
        if (isset($this->orderBuilder->orderId) == FALSE) {                                                        
            $errors[] = array('missing value' => "orderId is required.");
        }
        return $errors;
    }               

    private function validateOrderType($errors) {
        if (isset($this->orderBuilder->orderType) == FALSE) {                                                        
            $errors[] = array('missing value' => "orderType is required.");
        }
        return $errors;
    }            
    
    private function validateCountryCode($errors) {
        if (isset($this->orderBuilder->countryCode) == FALSE) {                                                        
            $errors[] = array('missing value' => "countryCode is required.");
        }
        return $errors;
    }    
    
    private function validateRowsToAdd($errors) {
        if (isset($this->orderBuilder->orderRows) == FALSE) {                                                        
            $errors[] = array('missing value' => "orderRows is required.");
        }
        return $errors;
    }  
}        
