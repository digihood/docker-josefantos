<?php
/**
 * The template part for displaying a message that posts cannot be found
 */
?>


<div class="post-not-found">
	
	<?php if ( is_search() ) : ?>
		
		<header class="article-header">
			<h1><?php _e( 'Bohužel nic nemůžeme najít.', 'custom' );?></h1>
		</header>
		
		<section class="entry-content">
			<p><?php _e( 'Zkuste požadovanou stránku znovu vyhledat.', 'custom' );?></p>
		</section>
		
		<section class="search">
		    <p><?php get_search_form(); ?></p>
		</section> 
				
	<?php else: ?>
	
		<header class="article-header">
			<h1><?php _e( 'Bohužel stránku nelze najít.', 'custom' ); ?></h1>
		</header>
		
		<section class="entry-content">
			<p><?php _e( 'Zkuste jí vyhledat.', 'custom' ); ?></p>
		</section>
		
		<section class="search">
		    <p><?php get_search_form(); ?></p>
		</section> 
					
	<?php endif; ?>
	
</div>
