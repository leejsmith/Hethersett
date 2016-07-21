<?php
add_action('after_setup_theme', 'blankslate_setup');
function blankslate_setup()
{
    load_theme_textdomain('blankslate', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    global $content_width;
    if (!isset($content_width)) {
        $content_width = 640;
    }

    register_nav_menus(
        array('main-menu' => __('Main Menu', 'blankslate'))
    );
}
add_action('wp_enqueue_scripts', 'blankslate_load_scripts');
function blankslate_load_scripts()
{
    wp_enqueue_script('jquery');
}
add_action('comment_form_before', 'blankslate_enqueue_comment_reply_script');
function blankslate_enqueue_comment_reply_script()
{
    if (get_option('thread_comments')) {wp_enqueue_script('comment-reply');}
}
add_filter('the_title', 'blankslate_title');
function blankslate_title($title)
{
    if ($title == '') {
        return '&rarr;';
    } else {
        return $title;
    }
}
add_filter('wp_title', 'blankslate_filter_wp_title');
function blankslate_filter_wp_title($title)
{
    return $title . esc_attr(get_bloginfo('name'));
}
add_action('widgets_init', 'blankslate_widgets_init');
function blankslate_widgets_init()
{
    register_sidebar(array(
        'name'          => __('Sidebar Widget Area', 'blankslate'),
        'id'            => 'primary-widget-area',
        'before_widget' => '<li class="%1$s" class="widget-container %2$s">',
        'after_widget'  => "</li>",
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
function blankslate_custom_pings($comment)
{
    $GLOBALS['comment'] = $comment;
    ?>
<li <?php comment_class();?> class="li-comment-<?php comment_ID();?>"><?php echo comment_author_link(); ?></li>
<?php
}
add_filter('get_comments_number', 'blankslate_comments_number');
function blankslate_comments_number($count)
{
    if (!is_admin()) {
        global $id;
        $comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
        return count($comments_by_type['comment']);
    } else {
        return $count;
    }
}

//Deletes all CSS classes and id's, except for those listed in the array below
function custom_wp_nav_menu($var)
{
    return is_array($var) ? array_intersect($var, array(
        //List of allowed menu classes
        'current_page_item',
        'current_page_parent',
        'current_page_ancestor',
        'first',
        'last',
        'vertical',
        'horizontal',
        'menu-item',
        'menu-item-has-children',
    )
    ) : '';
}
add_filter('nav_menu_css_class', 'custom_wp_nav_menu');
add_filter('nav_menu_item_id', 'custom_wp_nav_menu');
add_filter('page_css_class', 'custom_wp_nav_menu');

//Replaces "current-menu-item" with "active"
function current_to_active($text)
{
    $replace = array(
        //List of menu item classes that should be changed to "active"
        'current_page_item'        => 'current_item',
        'current_page_parent'      => 'current_item',
        'current_page_ancestor'    => 'active',
        'menu-item'                => 'main_menu_list_item',
        'menu-main-menu-container' => 'main_menu',
        '-has-children'            => '_has_submenu',
        'sub-menu'                 => 'main_menu_list_item_submenu',
    );
    $text = str_replace(array_keys($replace), $replace, $text);
    return $text;
}
add_filter('wp_nav_menu', 'current_to_active');

//Deletes empty classes and removes the sub menu class
function strip_empty_classes($menu)
{
    $menu = preg_replace('/ class=""| class="sub-menu"/', '', $menu);
    return $menu;
}
add_filter('wp_nav_menu', 'strip_empty_classes');

function add_menuclass($ulclass)
{
    return preg_replace('/<a/', '<a class="main_menu_list_item_link"', $ulclass, 1);
}
add_filter('wp_nav_menu', 'add_menuclass');

//remove class from the_post_thumbnail
function the_post_thumbnail_remove_class($output)
{
    $output = preg_replace('/class=".*?"/', '', $output);
    return $output;
}
add_filter('post_thumbnail_html', 'the_post_thumbnail_remove_class');
add_filter('post_secondary-image_thumbnail_html', 'the_post_thumbnail_remove_class');
add_filter('post_secondary-image_thumbnail_html', 'remove_width_attribute', 10);
add_filter('post_thumbnail_html', 'remove_width_attribute', 10);
add_filter('image_send_to_editor', 'remove_width_attribute', 10);

function remove_width_attribute($html)
{
    $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
    return $html;
}

function get_post_page_content($atts)
{
    extract(shortcode_atts(array(
        'id'    => null,
        'title' => false,
    ), $atts));

    $the_query = new WP_Query('page_id=' . $id);
    while ($the_query->have_posts()) {
        $the_query->the_post();
        if ($title == true) {
            the_title();
        }
        the_content();
    }
    wp_reset_postdata();

}
add_shortcode('my_content', 'get_post_page_content');

function display_category_album_list($parent_id)
{
    global $wpdb;

    $sql        = "SELECT * FROM wp_posts WHERE post_parent=" . $parent_id . " AND post_status='publish' ORDER BY post_date DESC LIMIT 12 ";
    $retVal     = "";
    $album_list = $wpdb->get_results($sql);
    if (count($album_list) > 0) {
        $retVal = "<ul class=\"gallery_list\">";
        foreach ($album_list as $album){
        	$retVal .= "<li class=\"gallery_list_item\">";
        	$retVal .= "<div class=\"gallery_list_item_content\">";
        	$retVal .= "<h3>" . $album->post_title . "</h3>";
        	$sql = "SELECT meta_value FROM wp_postmeta WHERE post_id=(SELECT meta_value FROM wp_postmeta WHERE post_id=".$album->ID ." AND meta_key='_thumbnail_id') AND meta_key='_wp_attached_file';";
        	$thumbnail = $wpdb->get_row($sql);
        	$retVal .= "<img src=\"/wp-content/uploads/" . $thumbnail->meta_value . "\"/>";
        	$retVal .= "<p>" . wp_trim_excerpt($album->post_content) . "</p>";
        	$retVal .= "</div>";
        	$retVal .= "</li>";
        }
        $retVal .= "</ul>";

        return $retVal;
    } else {
        return count($album_list) . "<p>No Current Albums";
    }
}


function wpb_list_child_pages() {

    global $post;

    if (is_page() && $post->post_parent) {
        $childpages = wp_list_pages('sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0&depth=1');
    } else {
        $childpages = wp_list_pages('sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0&depth=1');
    }

    if ($childpages) {
        $string = '<ul class="subnav_list">' . $childpages . '</ul>';
    }

    return $string;
}
function is_descendant_of($pid) {
    //$pid = The ID of the ancestor page
    global $post; //load details about this page
    $anc = get_post_ancestors($post->ID);
    foreach ($anc as $ancestor) {
        if (is_page() && $ancestor == $pid) {
            return true;
        }
    }
    if (is_page() && (is_page($pid))) {
        return true; // we’re at the page or at a sub page
    } else {
        return false; //we’re elsewhere
    }
}
?>