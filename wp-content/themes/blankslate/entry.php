<article class="post-<?php the_ID();?> category_list_item_article" <?php post_class();?>>

	<a href="<?php the_permalink();?>">
	<?php 
	if (has_post_thumbnail() ) {
		the_post_thumbnail(); 
	} else {
		?><img src="<?php echo bloginfo("template_directory") . "/_includes/images/thumbnail.jpg";?>"/><?php
	} ?>
	</a>
	<?php 
	if (is_singular()) {
		echo '<h1 class="content_title">';
	} else {
		echo '<h3 class="content_title">';
	}?>
	<?php the_title();?>
	<?php 
	if (is_singular()) {
		echo '</h1>';
	} else {
		echo '</h3>';
	}?> 
		
	
	
	<?php edit_post_link();?>
	<?php if (!is_search()) {
		get_template_part('entry', 'meta');
	}
?>

<?php get_template_part('entry', (is_archive() || is_search() ? 'summary' : 'content'));?>
<a class="category_list_item_readmore" href="<?php the_permalink();?>">Read More </a>
</article>
