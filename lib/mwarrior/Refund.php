<?php
namespace primathonpay;

class Refund {
    protected $_method;
    protected $_merchantUUID;
    protected $_apiKey;

    protected $_hash;
    protected $_refund_amount;
    protected $_token;

    protected $_transaction_id;
    protected $_transaction_amount;
    protected $_transaction_currency;

    protected function _endpoint() {
        return Settings::$checkoutBase;
    }

    protected function _buildRequestMessage() {
        $request = array(
            'method' => 'refundCard',
            'merchantUUID' => $this->getMerchantUUID(),
            'apiKey' => $this->getApiKey(),
            'transactionAmount' => $this->getGrandTotal(),
            'transactionCurrency' => 'AUD',
            'transactionID' => $this->getTransactionID(),
            'refundAmount' => $this->getRefundAmount(),
            'hash' => $this->getHash()
        );
    
        Logger::getInstance()->write($request, Logger::DEBUG, get_class() . '::' . __FUNCTION__);

        return $request;
    }

    public function submit() {
        try {
            $response = $this->_remoteRequest();
            $this->gatewayResult = $response;
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $response = '{ "errors":"' . $msg . '", "Build message":"' . $this->_buildRequestMessage() . '" }';
        }
        return new Response($response);
    }

    protected function _remoteRequest() {
        return GatewayCommand::submit($this->_endpoint(), $this->_buildRequestMessage() );
    }


    public function gatewayResponse(){
        return $this->gatewayResult;
    }
    public function setMethod($method) {
        $this->_method = $method;
    }

    public function getMethod() {
        return $this->_method;
    }

    public function setHash($hash) {
        $this->_hash = $hash;
    }
    public function getHash() {
        return $this->_hash;
    }

    public function setToken($token) {
        $this->_token = $token;
    }
    public function getToken() {
        return $this->_token;
    }

    public function setMerchantUUID($merchantUUID) {
        $this->_merchantUUID = $merchantUUID;
    }
    public function getMerchantUUID() {
        return $this->_merchantUUID;
    }

    public function setApiKey($apiKey) {
        $this->_apiKey = $apiKey;
    }
    public function getApiKey() {
        return $this->_apiKey;
    }

    public function setRefundAmount($refund_amount) {
        $this->_refund_amount = $refund_amount;
    }
    public function getRefundAmount() {
        return $this->_refund_amount;
    }

    public function setGrandTotal($amount) {
        $this->_transaction_amount = $amount;
    }
    public function getGrandTotal() {
        return $this->_transaction_amount;
    }
   
    public function setTransactionID($transactionID) {
        $this->_transaction_ID = $transactionID;
    }

    public function getTransactionID() {
        return $this->_transaction_ID;
    }

    public function setBaseCurrency($transactionCurrency) {
        $this->_transaction_currency;
    }
    public function getBaseCurrency() {
        return $this->_transaction_currency;
    }
}
?>
