<?php
namespace mwarrior;

class Webhook extends Response {

  protected $_json_source = 'php://input';

  public function __construct() {
    parent::__construct(file_get_contents($this->_json_source));
  }

  public function isAuthorized() {
    return $this->_getMerchantUUIDFromAuthorization() == Settings::$merchantUUID
           && $this->_getShopKeyFromAuthorization() == Settings::$apiKey;
  }

  private function _getMerchantUUIDFromAuthorization() {
    if (isset($_SERVER['PHP_AUTH_USER']))
      return $_SERVER['PHP_AUTH_USER'];
    return '';
  }

  private function _getShopKeyFromAuthorization() {
    if (isset($_SERVER['PHP_AUTH_PW']))
      return $_SERVER['PHP_AUTH_PW'];
    return '';
  }
}
?>
