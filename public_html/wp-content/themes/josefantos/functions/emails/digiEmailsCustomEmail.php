<?php 

if ( ! defined( 'ABSPATH' ) ) {

  exit;

}

if( ! class_exists( 'digiEmailsCustomEmail' ) )
 
{

	class digiEmailsCustomEmail
	{
		public static $order_id;
		public static $email_data = [
			'order_id' => 0,
			'subject' => '',
			'title' => '',
			'message' => '',
			'mailto' => '',
			'attach' => [],
		];
		public function __construct($order_id=""){
			if ($order_id) self::$order_id = $order_id;
		}
		// z url adresy vytvoří path pro přílohy 
		public function email_attach_url_to_path($url_attach) {
			$path = parse_url($url_attach, PHP_URL_PATH);
            $attach_path = $_SERVER['DOCUMENT_ROOT'] . $path;
			return $attach_path;
		}

		/*============================================

			Email - new registration (contact seller) 
			
			HOTOVO

		============================================*/
		public function email_registration( $mail, $user, $activation_url ) {
			$subject = __('Potvrzení registrace - Žijte ve své zahradě', 'digi');
			$message =  digiEmailsController::email_content(
				__('Potvrzení registrace', 'digi'),
				array(__('Vítejte!', 'digi'), __('Děkujeme za registraci na našem webu. Pro přihlášení klikněte na tlačítko Přihlásit se.', 'digi')),
				__('PODPIS', 'digi'),
				$activation_url,
				__('Přihlásit se', 'digi')
			);
			digiEmailsController::send_client_emails( $mail, $subject, $message );

			return true;
		}

		/*============================================

			Email - forgotten password
			
			HOTOVO
			email_content( $title, $title_mail, $subtitle, $subtitle_gray="", $content_title, $body, $footer, $signature="false", $button_link = "", $button_text = "", $top_image_url="")

		============================================*/
		public function forgotten_password( $mail, $link ) {
			$subject = __('Obnovení hesla', 'digi') . " - Žijte ve své zahradě";

			$message =  digiEmailsController::email_content(
				__('Zapomenuté heslo', 'digi'),
				array(
					__('Obnovení hesla', 'digi'),
					__('Dobrý den,', 'digi'),
					__('požádali jste o obnovení přístupu do kurzu Žijte ve své zahradě. Heslo obnovíte kliknutím na tlačítko "Obnovit přistup", nebo můžete do svého prohlížeče zkopírovat následující odkaz:', 'digi') . '<br>' . $link,
					__('Po přihlášení si můžete heslo změnit v nastavení svého účtu.', 'digi')
				),
				__('PODPIS', 'digi'),
				$link,
				__('Obnovit přístup', 'digi')
			);
			digiEmailsController::send_client_emails( $mail, $subject, $message );
			return true;
		}


		/* NOVĚ VYTVOŘENÉ EMAILY
		==================================*/

		/*============================================

			Email - Nová objednávka

		============================================*/
		public static function new_order_user_mail() {
			$email_data = self::$email_data;
			$email_data['title'] = 'Nadpis emailu';
			$email_data['subject'] = 'Předmět emailu';
			$email_data['message'] = ['Text emailu včetně všech drobností', 'druhý odstavec'];
			$email_data['mailto'] = 'milan@digihood.cz';
			$email_data['attach'] = self::email_attach_url_to_path('http://localhost:8080/wp-content/pdf/blablalba.pdf'); //
			return $email_data;
			/*$subject = __('Potvrzení přijetí objednávky č. 123', 'digi');
			$message =  digiEmailsController::email_content(
				__('Potvrzení objednávky č. 123', 'digi'), 
				__('Dobrý den,', 'digi') ,
				array(__('Děkujeme za registraci na našem webu. Pro přihlášení klikněte na tlačítko Přihlásit se.', 'digi'), '<br>' ),
				__('PODPIS', 'digi'), 
				$activation_url, 
				__('Přihlásit se', 'digi')  
			);
			digiEmailsController::send_client_emails( $mail, $subject, $message );
			
			return true;*/
		}
		public static function new_order_admin_mail( $order_id  ) {
			$subject = __('Potvrzení přijetí objednávky č. 123', 'digi');
			$message =  digiEmailsController::email_content(
				__('Potvrzení objednávky č. 123', 'digi'),
				array(__('Dobrý den,', 'digi'), __('Děkujeme za registraci na našem webu. Pro přihlášení klikněte na tlačítko Přihlásit se.', 'digi')),
				__('PODPIS', 'digi'),
				$activation_url,
				__('Přihlásit se', 'digi')
			);
			digiEmailsController::send_client_emails( $mail, $subject, $message );

			return true;
		}

		/*============================================

			Email - Dokončená objednávka

		============================================*/
		public function finished_order_mail( $mail, $user, $activation_url ) {
			$subject = __('Potvrzení dokončení objednávky č. 123', 'digi');
			$message =  digiEmailsController::email_content(
				__('Potvrzení registrace', 'digi'),
				array(__('Vítejte!', 'digi'), __('Děkujeme za registraci na našem webu. Pro přihlášení klikněte na tlačítko Přihlásit se.', 'digi')),
				__('PODPIS', 'digi'),
				$activation_url,
				__('Přihlásit se', 'digi')
			);
			digiEmailsController::send_client_emails( $mail, $subject, $message );

			return true;
		}

		/*============================================

			Email - Zaplacená záloha

		============================================*/
		public function invoice_paid_mail( $mail, $user, $activation_url ) {
			$subject = __('Potvrzení zaplacení zálohy za objednávku č. 123', 'digi');
			$message =  digiEmailsController::email_content(
				__('Potvrzení registrace', 'digi'),
				array(__('Vítejte!', 'digi'), __('Děkujeme za registraci na našem webu. Pro přihlášení klikněte na tlačítko Přihlásit se.', 'digi')),
				__('PODPIS', 'digi'),
				$activation_url,
				__('Přihlásit se', 'digi')
			);
			digiEmailsController::send_client_emails( $mail, $subject, $message );

			return true;
		}

		/*============================================

			Email - Připraveno k vyzvednutí

		============================================*/
		public function ready_to_pickup_mail( $mail, $user, $activation_url ) {
			$subject = __('Vaši objednávku jsme připravili k vyzvednutí', 'digi');
			$message =  digiEmailsController::email_content(
				__('Potvrzení registrace', 'digi'),
				array(__('Vítejte!', 'digi'), __('Děkujeme za registraci na našem webu. Pro přihlášení klikněte na tlačítko Přihlásit se.', 'digi')),
				__('PODPIS', 'digi'),
				$activation_url,
				__('Přihlásit se', 'digi')
			);
			digiEmailsController::send_client_emails( $mail, $subject, $message );

			return true;
		}

		/*============================================

			Email - Zaslání parte

		============================================*/
		public function parte_delivery_mail( $mail, $user, $activation_url ) {
			$subject = __('Zasíláme Vám parte k objednávce č. 123', 'digi');
			$message =  digiEmailsController::email_content(
				__('Potvrzení registrace', 'digi'),
				array(__('Vítejte!', 'digi'), __('Děkujeme za registraci na našem webu. Pro přihlášení klikněte na tlačítko Přihlásit se.', 'digi')),
				__('PODPIS', 'digi'),
				$activation_url,
				__('Přihlásit se', 'digi')
			);
			digiEmailsController::send_client_emails( $mail, $subject, $message );

			return true;
		}

		/*============================================

			Email - Zaslání faktury

		============================================*/
		public function invoice_send_mail( $mail, $user, $activation_url ) {
			$subject = __('Zasíláme Vám fakturu k objednávce č. 123', 'digi');
			$message =  digiEmailsController::email_content(
				__('Potvrzení registrace', 'digi'),
				array(__('Vítejte!', 'digi'), __('Děkujeme za registraci na našem webu. Pro přihlášení klikněte na tlačítko Přihlásit se.', 'digi')),
				__('PODPIS', 'digi'),
				$activation_url,
				__('Přihlásit se', 'digi')
			);
			digiEmailsController::send_client_emails( $mail, $subject, $message );

			return true;
		}

		/**
		* 	Description 
		*
		* 	@param $mail_id = ID emailu
		* 	@param $order_id = order id není povinný, může se totiž vyplnit při volání celé classy
		* 
		* 	@author Digihood
		* 	@return echo
		*/
		public static function digi_mail_trigger( $mail_id, $order_id="") { 
			if ($order_id) self::$order_id = $order_id;
			switch ($mail_id) {
				case 'new_order_admin':
					$params = self::new_order_user_mail();
					break;
				case 'new_order_customer':
					$params = [];
					break;
				case 'deposit_paid':
					$params = [];
					break;
				case 'order_canceled':
					$params = [];
					break;
				case 'send_final_invoice':
					$params = [];
					break;
				case 'final_invoice_paid':
					$params = [];
					break;
				case 'card_payment_failed':
					$params = [];
					break;
				case 'contact_form_admin':
					$params = [];
					break;
				case 'contact_form_customer':
					$params = [];
					break;
				case 'meeting_reminder':
					$params = [];
					break;
				case 'send_client_files':
					$params = [];
					break;
				case 'urn_ready_pickup':
					$params = [];
					break;
				case 'payment_reminder_1':
					$params = [];
					break;
				case 'payment_reminder_2':
					$params = [];
					break;
				case 'payment_reminder_3':
					$params = [];
					break;
				default:
					wp_die('Pozor, tento typ emailu neexistuje. ID volaného emailu je: ' . $mail_id);
					break;
			}
			$params['order_id'] = $order_id;
			return $params;
		}

	}
	
}