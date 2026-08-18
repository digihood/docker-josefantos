<?php 

/**
 * Theme styles and scripts
 *
 * 
 * @author Digihood
 */ 

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if( ! class_exists( 'd1g1RegisterStylesScripts' ) )
{
	class d1g1RegisterStylesScripts
	{
    // Měřicí ID Google Analytics (gtag.js)
    const GA_ID = 'G-Z9KS0FD0TS';

    private $styles_directory = '/assets-minified/styles';
    private $scripts_directory = '/assets-minified/scripts';
    private $specific_styles_directory = '/assets-minified/styles';
    private $specific_scripts_directory = '/assets-minified/scripts';
		public function __construct()
		{
			if (defined('VITE_DEVELOPMENT') && VITE_DEVELOPMENT === true) {
        $this->styles_directory = '/assets/styles';
        $this->scripts_directory = '/assets/scripts/js';
        $this->specific_styles_directory = '/assets/styles/specific-css';
        $this->specific_scripts_directory = '/assets/scripts/specific-scripts';
      } 
			//register scripts
      add_action( 'wp_enqueue_scripts' , [$this, 'register_styles_scripts_d1g1']);

      //admin scripts
      add_action( 'admin_enqueue_scripts' , [$this,'enqueue_admin_scripts_d1g1'] );

      //move scripts to the footer
      add_action( 'wp_enqueue_scripts' , [$this,'remove_head_scripts_d1g1'] );

      //remove scripts
      add_action( 'wp_enqueue_scripts' , [$this,'dequeue_script'], 100 );

      //defer css and js
      add_action( 'wp_footer', [$this,'defer_css_d1g1'], PHP_INT_MAX );
      //add_filter( 'script_loader_tag', [$this,'defer_parsing_of_js'], 10 ); Zakomentováno, způsobuje WP not defined u několika pluginů

      //show registred scripts
      //add_action( 'wp_print_scripts', [$this,'wpa54064_inspect_scripts'] );

    }


    
    /**
     * Register
     *
     * @param none
     * 
     * @author Digihood
     * @return void
     */ 
    function register_styles_scripts_d1g1() {
  
      global $wp_styles, $wp_scripts;
      global $wp_query;

      // Register main stylesheet
      // Styl vynechavame jen ve vyvoji, kdy ho dodava Vite server. Pokud konstanta neni
      // definovana (typicky na produkci), plati zbuildeny soubor.
      if ( ! defined('VITE_DEVELOPMENT') || VITE_DEVELOPMENT !== true ) {
        $maincsstime = filemtime( get_stylesheet_directory() . $this->styles_directory . '/style.css');
        wp_enqueue_style( 'main-css', get_template_directory_uri() . $this->styles_directory . '/style.css', array(), $maincsstime);
      }
      $fontstime = filemtime( get_stylesheet_directory() . $this->styles_directory . '/fonts.css');
      wp_enqueue_style( 'fonts', get_template_directory_uri() . $this->styles_directory . '/fonts.css', array(), $fontstime);

      // Register javacript
      $apptime = filemtime( get_stylesheet_directory() . $this->scripts_directory . '/app.js');
      wp_enqueue_script( 'global', get_template_directory_uri() . $this->scripts_directory . '/app.js', array( 'jquery', 'cookiebanner' ), $apptime, true );

      // Register tailwind observer script
      $observertime = filemtime( get_stylesheet_directory() . '/node_modules/tailwindcss-intersect/dist/observer.min.js');
      wp_enqueue_script('tailwind-observer', get_stylesheet_directory_uri() . '/node_modules/tailwindcss-intersect/dist/observer.min.js', array(), $observertime, true);

      wp_localize_script( 'global', 'globaldata', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'home_url' => home_url( ),
        'theme_url' => get_stylesheet_directory_uri( ),
        // styly cookie lišty si načítá knihovna sama, cesta musí respektovat VITE_DEVELOPMENT
        'cookiecss' => get_template_directory_uri() . $this->specific_styles_directory . '/cookiebanner.css',
        'title' => __('Náš web používá cookies', 'digi'),
        'cookiemaintitle' => __('Informace o používání souborů cookies', 'digi'),
        'primarybtn_text' => __('Přijmout vše', 'digi'),
        'pref_btn_text' => __('Uložit nastavení', 'digi'),
        'cookie_close_btn_text' => __('Zavřít', 'digi'),
        'secondarybtn_text' =>__('Další volby', 'digi'),
        'thirdbtn_text' => __('Pouze nezbytné', 'digi'),
        'consent_description' => __('Kliknutím na "Přijmout vše" souhlasíte s ukládáním souborů cookies na vašem zařízení. Soubory cookies používáme k analýze využití dat a marketingovým účelům.<br><a class="d1g1_cookie" href="'.get_privacy_policy_url().'">Více informací >></a>', 'digi').'<button type="button" class="cc-link">Odmítnout vše</button>',
        'block_description' => __('Soubory cookies používáme k analýze údajů o našich návštěvnících, ke zlepšení našich webových stránek, zobrazování personalizovaného obsahu a k tomu, abychom vám poskytli skvělý zážitek z webu.', 'digi'),
        'func_cookie_title' => __('Funkční cookies', 'digi'),
        'market_cookie_title' => __('Marketingové cookies', 'digi'),
        'anal_cookie_title' => __('Analytické cookies', 'digi'),
        'func_cookie_desc' => __('Tyto soubory cookies jsou bezprostředně zapotřebí k zajištění základních funkcí webové stránky, neukládají žádné informace, které lze přiřadit konkrétní osobě. Funkční soubory cookies umožňují např. funkci nákupních košíků e-shopů či sledování návštěvnosti webu. Tyto druhy cookies jsou vzhledem ke své podstatě a účelu bez dalšího povoleny a souhlas subjektu údajů se zde nevyžaduje. Funkční cookies jsou využívány vždy. Svůj prohlížeč můžete nastavit tak, aby blokoval soubory cookies nebo o nich zasílal upozornění.', 'digi'),
        'anal_cookie_desc' => __('Tyto soubory cookies se používají ke zlepšení fungování webových stránek. Umožňují nám rozpoznat a sledovat počet návštěvníků a sledovat, jak návštěvníci web používají. Pomáhají nám zlepšit způsob, jakým webové stránky fungují, například tím, že uživatelům umožňují snadno najít to, co hledají. Tyto soubory cookies neshromažďují informace, které by vás mohly identifikovat. Pomocí těchto nástrojů analyzujeme a pravidelně zlepšujeme funkčnost našich webových stránek. Získané statistiky můžeme využít ke zlepšení uživatelského komfortu a k tomu, aby byla návštěva Webu pro vás jako uživatele zajímavější.', 'digi'),
        'market_cookie_desc' => __('Tyto soubory cookies shromažďují osobní údaje o uživateli z marketingového hlediska. Např. shromažďují informace za účelem přizpůsobení nabízené reklamy zájmům zákazníka, propojení se sociální sítí atd. K využívání cookies tohoto druhu potřebujeme Váš souhlas. Bez souhlasu nelze marketingové cookies využívat.', 'digi'),
        'func_cookie_table2' => __('Povolené cookies', 'digi'),
        'func_cookie_wp_session' => __('Wordpress cookies', 'digi'),
        'google_marketing' => __('Google analytics - Tato skupina nastavuje jedinečné ID pro zapamatování vašich preferencí a dalších informací, jako jsou statistiky webových stránek a sledování míry konverze.', 'digi'),
        'cookie_table_header1' => __('Cookies', 'digi'),
        'cookie_table_header2' => __('Popis', 'digi'),
        'anal_cookie_table_desc_seznam' => __('Sid cookie obsahuje digitálně podepsané a zašifrované záznamy ID účtu Google uživatele a poslední čas přihlášení.', 'digi'),
        'anal_cookie_table_desc_gcalendar1' => __('Google Calendar - Ověření a ochrana uživatelských dat a přihlašovacích údajů proti zneužití', 'digi'),
        'anal_cookie_table_desc_gcalendar2' => __('Google Calendar - Ověřování uživatelů (zabránění zneužití uživatelských dat a přihlašovacích údajů.)', 'digi'),
        'anal_cookie_table_desc1' => __('Google Analytics – ukládat a počítat zobrazení stránek.', 'digi'),
        'anal_cookie_table_desc2' => __('Správce značek Google – funkce propojovače konverzí', 'digi'),
        'fb_pixel' => __('Facebook Pixel – zobrazování reklam na Facebooku nebo na digitální platformě založené na reklamě na Facebooku, po návštěvě webové stránky.', 'digi'),
        'fb_fb_marketing1' => __('Facebook nastavuje tento soubor cookie tak, aby uživatelům zobrazoval relevantní reklamy sledováním chování uživatelů na webu, na stránkách, které mají Facebook pixel nebo sociální plugin Facebooku.', 'digi'),
         
      ));
      // Registrace Cookiebanner js
      $apptime = filemtime( get_stylesheet_directory() . $this->specific_scripts_directory . '/cookiebanner.js'); 
      wp_enqueue_script( 'cookiebanner', get_template_directory_uri() . $this->specific_scripts_directory  . '/cookiebanner.js', array( 'jquery' ), $apptime, true );
      
      // Google Analytics — gtag.js se stahuje asynchronně, náš snippet plní dataLayer
      wp_enqueue_script( 'gtag', 'https://www.googletagmanager.com/gtag/js?id=' . self::GA_ID, array(), null, array( 'strategy' => 'async', 'in_footer' => true ) );

      $analyticstime = filemtime( get_stylesheet_directory() . $this->specific_scripts_directory . '/analytics.js');
      wp_enqueue_script( 'analytics', get_template_directory_uri() . $this->specific_scripts_directory . '/analytics.js', array(), $analyticstime, true );
      wp_localize_script( 'analytics', 'd1g1Analytics', array(
        'id' => self::GA_ID,
      ));

      // Comment reply script for threaded comments
      if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
        wp_enqueue_script( 'comment-reply' );
      }

      //register scripts
      if ( $this->is_lightgallery_required_d1g1() ) {
        //light gallery
        $lightjs = filemtime( get_stylesheet_directory() . '/node_modules/lightgallery/dist/js/lightgallery-all.min.js');
        wp_enqueue_script ( 'lightgallery', get_stylesheet_directory_uri() . '/node_modules/lightgallery/dist/js/lightgallery-all.min.js', array("jquery", "global"), $lightjs, true); 
      }

      //slick slider
      if ( $this->is_slick_required_d1g1( ) ) { 
        
        $slickjs = filemtime( get_stylesheet_directory() . '/node_modules/slick-carousel/slick/slick.min.js');
        wp_enqueue_script ( 'slickslider', get_stylesheet_directory_uri() . '/node_modules/slick-carousel/slick/slick.min.js', array("jquery", "global"), $slickjs, true); 
      }
      
    }

    /**
     * Add admin scripts if required
     *
     * @param none
     * 
     * @author Digihood
     * @return void
     */ 
    function enqueue_admin_scripts_d1g1()
    {
        
      $addtime = filemtime( get_stylesheet_directory() . $this->specific_styles_directory . '/admin.css');
      wp_enqueue_style ( 'admin-css',  get_template_directory_uri() . $this->specific_styles_directory . '/admin.css', array(), $addtime, 'all'); 
      
      //$jgctime = filemtime( get_stylesheet_directory() . $this->sspecific_cripts_directory . '/admin.js');
      //wp_enqueue_style ( 'admin-js', get_template_directory_uri() . $this->specific_scripts_directory . '/admin.js', array(), $jgctime, 'all');
      
    }

    /**
     * Move scripts to the footer
     *
     * @param none
     * 
     * @author Digihood
     * @return void
     */ 
    function remove_head_scripts_d1g1() {
      remove_action('wp_head', 'wp_print_scripts');
      remove_action('wp_head', 'wp_print_head_scripts', 9);
      remove_action('wp_head', 'wp_enqueue_scripts', 1);
      remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

      add_action('wp_footer', 'wp_print_scripts', 5);
      add_action('wp_footer', 'wp_enqueue_scripts', 5);
      add_action('wp_footer', 'wp_print_head_scripts', 5);
    }

    /**
     * Remove scripts where required
     *
     * @param none
     * 
     * @author Digihood
     * @return void
     */ 
    function dequeue_script() {

      //odebereme všechny contact form 7 scripty
      //wp_dequeue_style( 'contact-form-7' );
      //wp_dequeue_script( 'contact-form-7' );

      //odregistrujeme základní script pro WP guttenberg
      wp_dequeue_style( 'wp-block-library' );

      //embed na tomto webu nebude potřeba
      wp_deregister_script( 'wp-embed' );
      
    }
        
    /**
     * Inspect scripts
     *
     * @param none
     * 
     * @author Digihood
     * @return void
     */ 
    function wpa54064_inspect_scripts() {
        global $wp_scripts;
        foreach( $wp_scripts->queue as $handle ) :
            echo $handle . ' | ';
        endforeach;
    }

    /**
     * Add css to footer
     *
     * @param none
     * 
     * @author Digihood
     * @return void
     */ 
    function defer_css_d1g1( ) 
    { 
    ?>
    <script type="text/javascript">
      var tl = "<?php echo get_stylesheet_directory_uri();?>";var url = "<?php echo site_url();?>";
      function c(e, m, s) {var l = document.createElement("link");l.setAttribute("rel", "stylesheet");l.setAttribute("media", m);l.setAttribute("href", e + '?hash=' + Math.random());document.getElementsByTagName("head")[0].appendChild(l);}
      <?php if ( $this->is_lightgallery_required_d1g1() ) { ?>
      c( tl +'/node_modules/lightgallery/dist/css/lightgallery.min.css', 'screen', null);
      <?php } ?>
      <?php if ( $this->is_slick_required_d1g1( ) ) { ?>
      c( tl +'/node_modules/slick-carousel/slick/slick.css', 'screen', null);
      <?php } ?>
      c( url +'/wp-includes/css/dist/block-library/style.min.css', 'screen', null);
    </script>
    <?php 
    } 
    
    /**
     * Určí, kam přidat scripty slickslideru
     *
     * @param none
     * 
     * @author Digihood
     * @return void
     */ 
    private function is_lightgallery_required_d1g1( ) {
      //
      //if ( is_singular() ) return true;
      return false;
    }

    /**
     * Určí, kam přidat scripty slickslideru
     *
     * @param none
     * 
     * @author Digihood
     * @return void
     */ 
    private function is_slick_required_d1g1( ) {
      //
      //if ( is_singular() ) return true;
      return false;
    }
    
    /**
     * Add css to footer
     *
     * @param $url
     * 
     * @author Digihood
     * @return void
     */ 
    function defer_parsing_of_js( $url ) {



       if ( is_admin() ) return $url; //don't break WP Admin
       if ( FALSE === strpos( $url, '.js' ) ) return $url;
       if ( strpos( $url, 'jquery.js' ) || strpos( $url, 'jquery.min.js' ) || strpos( $url, 'jquery-migrate.min.js' )  ) return $url;
       return str_replace( ' src', ' defer src', $url );
    }
		
	}

}

new d1g1RegisterStylesScripts;