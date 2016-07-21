<div class="clear"></div>

<footer class="footer" role="contentinfo">
<div class="logos">
<ul class="logos_list">
<li class="logos_list_item"><img class="logos_list_item_image" src="<?php echo bloginfo('template_directory') . '/_includes/images/britishcycling.png';?>" alt="British Cycling"/></li>
<li class="logos_list_item"><img class="logos_list_item_image" src="<?php echo bloginfo('template_directory') . '/_includes/images/goride.png';?>" alt="British Cycling"/></li>
</div>
<div class="copyright">
<?php echo sprintf( __( '%1$s %2$s %3$s. All Rights Reserved.', 'blankslate' ), '&copy;', date( 'Y' ), esc_html( get_bloginfo( 'name' ) ) ); ?>
</div>
</footer>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>