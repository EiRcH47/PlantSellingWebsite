<?php 
$header 	= apply_filters( 'greenmart_tbay_get_header_layout', 'header_default' );
?>

<header id="tbay-header" class="tbay_header-template site-header">

	<?php if ( !empty($header) && $header !== 'header_default' ) : ?>

		<?php greenmart_tbay_display_header_builder(); ?> 

	<?php else : ?>
	
	<?php get_template_part( 'headers/themes/fresh-el/header-default' ); ?>

	<?php endif; ?>
	<div id="nav-cover"></div>
</header>