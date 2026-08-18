<?php
/**
 * Odesílatel odchozích e-mailů
 *
 * Adresa musí odpovídat účtu nastavenému v pluginu Post SMTP, jinak server
 * odeslání odmítne. Samotné zprávy posílá Contact Form 7.
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if ( ! class_exists( 'sendEmaild1g1' ) ) {

  class sendEmaild1g1 {

    public function __construct() {
      add_filter( 'wp_mail_from_name', [ $this, 'my_mail_from_name' ] );
      add_filter( 'wp_mail_from', [ $this, 'my_mail_from' ] );
    }

    function my_mail_from_name( $name ) {
      return d1g1Settings::email_name();
    }

    function my_mail_from( $email ) {
      return d1g1Settings::email_from_d1g1();
    }

  }

  new sendEmaild1g1;
}
