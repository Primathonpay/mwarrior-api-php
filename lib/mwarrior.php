<?php
if (!class_exists('\mwarrior\Settings')) {
  require_once (__DIR__ . '/mwarrior/Settings.php');
  require_once (__DIR__ . '/mwarrior/Logger.php');
  require_once (__DIR__ . '/mwarrior/Response.php');
  require_once (__DIR__ . '/mwarrior/GatewayCommand.php');
  require_once (__DIR__ . '/mwarrior/Payment.php');
  require_once (__DIR__ . '/mwarrior/Refund.php');
  require_once (__DIR__ . '/mwarrior/AddCard.php');
  require_once (__DIR__ . '/mwarrior/Webhook.php');}
?>
