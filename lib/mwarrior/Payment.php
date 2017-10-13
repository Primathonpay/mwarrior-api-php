<?php
namespace primathonpay;

class Payment {
  protected $_method;
  protected $_merchantUUID;
  protected $_apiKey;
  protected $_tracking_id;
  protected $_card_number;
  protected $_card_holder;
  protected $_card_exp_month;
  protected $_card_exp_year;
  protected $_card_expiry;
  protected $_gateway_result;
  protected $_customer_email;

  protected $_hash;
  protected $_customer_name;
  protected $_token;
  protected $_customer_first_name;
  protected $_customer_last_name;
  protected $_customer_address;
  protected $_customer_city;
  protected $_customer_country;
  protected $_customer_state;
  protected $_customer_post_code;
  protected $_customer_phone;
    protected $_customer_ip;


    protected $_transaction_product;
  protected $_transaction_amount;
  protected $_transaction_currency;

  protected function _endpoint() {
     return Settings::$gatewayBase;
  }

  protected function _buildRequestMessage() {
    $request = array(
        'method' => 'processCard',
        'merchantUUID' => $this->getMerchantUUID(),
        'apiKey' => $this->getApiKey(),
        'cardID' => $this->getToken(),
        'customerName' => $this->getCustomerName(),
        'customerCountry' => $this->getCountryId(),
        'customerCity' => $this->getCity(),
        'customerState' => $this->getRegion(),
        'customerPostCode' => $this->getPostCode(),
        'customerAddress' => $this->getStreet(),
        'customerPhone' => $this->getTelephone(),
        'transactionAmount' => $this->getGrandTotal(),
        'transactionCurrency' => 'AUD',
        'transactionProduct' => $this->getTransactionProduct(),
        'customerIP' => $this->getCustomerIp(),
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

  public function setTrackingId($tracking_id) {
    $this->_tracking_id = $tracking_id;
  }
  public function getTrackingId() {
    return $this->_tracking_id;
  }

  public function setCardNumber($number) {
    $this->_card_number = $number;
  }
  public function getCardNumber() {
    return $this->_card_number;
  }

  public function setCountryId($customer_country) {
    $this->_customer_country = $customer_country;
  }
  public function getCountryId() {
    return $this->_customer_country;
  }

  public function setCardHolder($holder) {
    $this->_card_holder = $holder;
  }
  public function getCardHolder() {
    return $this->_card_holder;
  }

  public function setCardExpMonth($exp_month) {
    $this->_card_exp_month = sprintf('%02d', $exp_month);
  }
  public function getCardExpMonth() {
    return $this->_card_exp_month;
  }

  public function setCardExpYear($exp_year) {
    $this->_card_exp_year = $exp_year;
  }
  public function getCardExpYear() {
    return $this->_card_exp_year;
  }
  
  public function setCardExpiry($card_expiry) {
    $this->_card_expiry = $card_expiry;
  }
  public function getCardExpiry() {
    return $this->_card_expiry;
  }

   public function setEmail($email) {
    $this->_customer_email = $email;
  }
  public function getEmail() {
    return $this->_customer_email;
  }

  public function setCustomerIp($ip) {
        $this->_customer_ip = $ip;
    }

  public function getCustomerIp() {
      return $this->_customer_ip;
  }

  public function setFirstName($first_name) {
    $this->_customer_first_name = $first_name;
  }
  public function getFirstName() {
    return $this->_customer_first_name;
  }

  public function setCustomerName($customer_name) {
    $this->_customer_name = $customer_name;
  }
  public function getCustomerName() {
    return $this->_customer_name;
  }

  public function setLastName($last_name) {
    $this->_customer_last_name = $last_name;
  }
  public function getLastName() {
    return $this->_customer_last_name;
  }

  public function setStreet($address) {
    $this->_customer_address = $address;
  }

  public function getStreet() {
    return $this->_customer_address;
  }

  public function setCity($city) {
    $this->_customer_city = $city;
  }
  public function getCity() {
    return $this->_customer_city;
  }

  public function setRegion($state) {
    $this->_customer_state = $state;
  }
  public function getRegion() {
    return $this->_customer_state;
  }

 public function setTelephone($phone) {
    $this->_customer_phone = $phone;
  }
  public function getTelephone() {
    return $this->_customer_phone;
  }

 public function setPostCode($postcode) {
    $this->_customer_post_code = $postcode;
  }
  public function getPostCode() {
    return $this->_customer_post_code;
  }

  public function setGrandTotal($amount) {
    $this->_transaction_amount = $amount;
  }
  public function getGrandTotal() {
    return $this->_transaction_amount;
  }
  public function setBaseCurrency($transactionCurrency) {
    $this->_transaction_currency;
  }
  public function getBaseCurrency() {
    return $this->_transaction_currency;
  }

  public function setTransactionProduct($transactionProduct) {
    $this->_transaction_product = $transactionProduct;
  }

  public function getTransactionProduct() {
    return $this->_transaction_product;
  }
}
?>
