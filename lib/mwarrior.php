<?php
if (!class_exists('\primathonpay\Settings')) {
  require_once (__DIR__ . '/primathonpay/Settings.php');
  require_once (__DIR__ . '/primathonpay/Logger.php');
  require_once (__DIR__ . '/primathonpay/Response.php');
  require_once (__DIR__ . '/primathonpay/GatewayCommand.php');
  require_once (__DIR__ . '/primathonpay/Payment.php');
  require_once (__DIR__ . '/primathonpay/Refund.php');
  require_once (__DIR__ . '/primathonpay/AddCard.php');
  require_once (__DIR__ . '/primathonpay/Webhook.php');}
?>
