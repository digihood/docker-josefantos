<?php 

if ( ! defined( 'ABSPATH' ) ) {

  exit;

}

if( ! class_exists( 'sendEmailContentd1g1' ) )
 
{

	class sendEmailContentd1g1
	{
		
		public function __construct(){
			// content param
			// $title, 
			// $subtitle="", 
			// $body="",
			// $footer="", 
			// $button_link = "", 
			// $button_text = ""
		}

		/*============================================

			Email - new registration (contact seller) 
			
			HOTOVO

		============================================*/
		public function email_registration( $mail, $user, $activation_url ) {
			$subject = __('Potvrzení registrace - Žijte ve své zahradě', 'digi');
			$message =  sendEmaild1g1::email_content(__('Potvrzení registrace', 'digi'),  __('Vítejte!', 'digi') ,array(__('Děkujeme za registraci na našem webu. Pro přihlášení klikněte na tlačítko Přihlásit se.', 'digi'), '<br>' ),
				__('PODPIS', 'digi'), $activation_url, __('Přihlásit se', 'digi')  
			);
			sendEmaild1g1::send_client_emails( $mail, $subject, $message );
			
			return true;
		}

		/*============================================

			Email - forgotten password
			
			HOTOVO
			email_content( $title, $title_mail, $subtitle, $subtitle_gray="", $content_title, $body, $footer, $signature="false", $button_link = "", $button_text = "", $top_image_url="")

		============================================*/
		public function forgotten_password( $mail, $link ) {
			$subject = __('Obnovení hesla', 'digi') . " - Žijte ve své zahradě";

			$message =  sendEmaild1g1::email_content(__('Zapomenuté heslo', 'digi'),  __('Obnovení hesla', 'digi'),
				array(  __('Dobrý den,', 'digi'),_('požádali jste o obnovení přístupu do kurzu Žijte ve své zahradě. Heslo obnovíte kliknutím na tlačítko "Obnovit přistup", nebo můžete do svého prohlížeče zkopírovat následující odkaz:', 'digi'). '<br>'. $link,  __('Po přihlášení si můžete heslo změnit v nastavení svého účtu.', 'digi'). '<br>' ),
				__('PODPIS', 'digi'), $link, __('Obnovit přístup', 'digi')  
			);
			/*echo $message;
			die();*/
			sendEmaild1g1::send_client_emails( $mail, $subject, $message );
			return true;
		}

	}
	
}
new sendEmailContentd1g1;
