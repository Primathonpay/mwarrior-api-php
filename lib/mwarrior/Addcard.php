<?php
namespace mwarrior;

class AddCard {
  public static $version = 2;

  public $card;
  public $gatewayResult;

  protected $_success_url;
  protected $_decline_url;
  protected $_fail_url;
  protected $_cancel_url;
  protected $_method;
  protected $_merchantUUID;
  protected $_apiKey;
  protected $_tracking_id;
  protected $_card_number;
  protected $_card_holder;
  protected $_card_exp_month;
  protected $_card_exp_year;
  protected $_gateway_result;
  public function __construct() {
    $this->card = new Card();
    $this->gatewayResult = null;

  }

  protected function _endpoint() {
     return Settings::$gatewayBase;
  }

  protected function _buildRequestMessage() {
    $request = array(
        'method' => 'addCard',
        'merchantUUID' => Settings::$merchantUUID,
        'apiKey' => Settings::$shopKey,
        'cardName'=>  $this->getCardHolder(),
        'cardNumber' => $this->getCardNumber(),
        'cardExpiryMonth' => $this->getCardExpMonth(),
        'cardExpiryYear' => $this->getCardExpYear()
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
        return Gatewaycommand::submit($this->_endpoint(), $this->_buildRequestMessage() );
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

  public function setSuccessUrl($success_url) {
    $this->_success_url = $success_url;
  }
  public function getSuccessUrl() {
    return $this->_success_url;
  }

  public function setDeclineUrl($decline_url) {
    $this->_decline_url = $decline_url;
  }
  public function getDeclineUrl() {
    return $this->_decline_url;
  }

  public function setFailUrl($fail_url) {
    $this->_fail_url = $fail_url;
  }
  public function getFailUrl() {
    return $this->_fail_url;
  }
  public function setCancelUrl($cancel_url) {
    $this->_cancel_url = $cancel_url;
  }
  public function getCancelUrl() {
    return $this->_cancel_url;
  }
}
?>
