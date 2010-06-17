<?php
/**
 * @package Garson
 */

/**
 * Swift Mailer Include
 */
require_once "../lib/swift/swift_required.php";

/**
 * Class that handle email sending 
 */
class Mailer {
  /**
   * Vendor's {@link Swift_Mailer}
   * @var Swift_Mailer
   */
  private $__Mailer= Null;
  
  public function __construct() {
    
    $Config = Config::getInstance();
    
    if ($Config->email_ssl='on') {
      $Transport = Swift_SmtpTransport::newInstance($Config->email_server, $Config->email_port,'ssl');
    }else{
      $Transport = Swift_SmtpTransport::newInstance($Config->email_server, $Config->email_port);
    }
    $Transport->setUsername($Config->email_login);
    $Transport->setPassword($Config->email_password);
    
    $this->__Mailer = Swift_Mailer::newInstance($Transport);
  }
  
  public function send($subject, $body) {
    $Config = Config::getInstance();
    
    $Message = Swift_Message::newInstance();
    $Message->setSubject($subject);
    $Message->setFrom(array($Config->email_from => $Config->email_name));
    $Message->setTo( array($User->email => $User->full_name) );
    $Message->setBody($body);
    
    return $this->__Mailer->send($Message);
  }
}