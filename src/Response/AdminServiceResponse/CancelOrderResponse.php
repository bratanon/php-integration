<?php
namespace Svea;

/**
 * Handles the Svea Admin Web Service CancelOrder request response.
 * 
 * @author Kristian Grossman-Madsen
 */
class CancelOrderResult {
//
//    /** @var int $accepted  true iff request was accepted by the service */
//    public $accepted;
//    
//    /** @var int $resultcode  response specific result code */
//    public $resultcode;
//
//    /** @var string errormessage  may be set iff accepted above is false */
//    public $errormessage;   
//
//
//    function __construct($message) {
//        $this->formatObject($message);  
//    }
//
//    /**
//     * Parses response and sets attributes.
//     */    
//    protected function formatObject($message) {
//        // was request accepted?
//        $this->accepted = $message->CloseOrderEuResult->Accepted; // false or 1
//        $this->errormessage = isset($message->CloseOrderEuResult->ErrorMessage) ? $message->CloseOrderEuResult->ErrorMessage : "";        
//
//        // set response resultcode
//        $this->resultcode = $message->CloseOrderEuResult->ResultCode;
//    }
}