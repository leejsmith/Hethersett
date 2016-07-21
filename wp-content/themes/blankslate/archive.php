<?php get_header(); ?>
<section class="content" role="main">
<header class="header">
<h1 class="content_title"><?php 
if ( is_day() ) { printf( __( 'Daily Archives: %s', 'blankslate' ), get_the_time( get_option( 'date_format' ) ) ); }
elseif ( is_month() ) { printf( __( 'Monthly Archives: %s', 'blankslate' ), get_the_time( 'F Y' ) ); }
elseif ( is_year() ) { printf( __( 'Yearly Archives: %s', 'blankslate' ), get_the_time( 'Y' ) ); }
else { _e( single_cat_title(), 'blankslate' ); }
?></h1>
</header>
<?php if ( have_posts() ) {
	?><ul class="category_list"><?php
	 while ( have_posts() ) { echo "<li class=\"category_list_item\"/>"; echo the_post();  ?>
<?php get_template_part( 'entry' );echo "</li>"; ?>
<?php } ?></ul> <?php } ?>
<?php get_template_part( 'nav', 'below' ); ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>