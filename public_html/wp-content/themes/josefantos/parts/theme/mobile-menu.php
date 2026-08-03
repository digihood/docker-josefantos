<?php
/**
 * Mobilní menu — panel vysunutý pod záhlavím
 *
 * @author Digihood
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div id="mobile-menu"
     class="hidden md:hidden fixed top-16 [.admin-bar_&]:top-24 left-0 right-0 z-40 bg-background border-b border-border
            [&_ul]:px-6 [&_ul]:py-6 [&_ul]:flex [&_ul]:flex-col [&_ul]:gap-5
            [&_a]:text-base [&_a]:font-medium [&_a]:transition-colors
            [&_a:hover]:text-primary">

    <?php do_action( 'd1g1_menu_mobile' ); ?>

</div>
