<?php 
/**
 * class description
 *
 * 
 * @author Digihood
 */ 

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if( ! class_exists( 'd1g1Settings' ) )
{
	class d1g1Settings
	{
      
    //defaultní počet příspěvků
    public static function cookieHeader( ) {
      return __('Naše webová stránka používá cookies', 'digi');
    }

    //počet příspěvků načtených na šabloně pro logace
    public static function cookieContent( ) {
      return __('Používáme je, abychom mohli našim zákazníkům poskytnout lepší služby. Odsouhlasením této informace jejich použití schválíte.', 'digi');
    }
    //nastavit jméno pro odesílání emailů
    public static function email_name() {
      return 'Ing. Josef Antoš';
    }
    //nastavit email pro odesílání emailů (musí sedět s účtem v Post SMTP)
    public static function email_from_d1g1() {
      return 'hello@digihood.cz';
    }
    //nastaví API pro google
    public static function google_api_digihood() {
      return 'XXX';
    }

	}

}
