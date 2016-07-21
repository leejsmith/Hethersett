<!DOCTYPE html>
<html <?php language_attributes();?>>

<head>
    <meta charset="<?php bloginfo('charset');?>" />
    <meta name="viewport" content="width=device-width" />
    <!-- STYLESHEETS -->
    <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory') . '/_includes/css/main.css'; ?>" />
    <link href='https://fonts.googleapis.com/css?family=Asap:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Sans+Mono' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,500,600,700,300,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu+Mono' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Boogaloo' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
    <!-- JAVASCRIPT -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo bloginfo('template_directory') . '/_includes/js/mason.js'; ?>"></script>
    <script src="https://use.fontawesome.com/b641923aef.js"></script>
    <?php if(is_front_page() || is_home()){ ?>
        <title>Hethersett Hawks CSC - Home</title>
    <?php } else {?>
        <title>Hethersett Hawks CSC - <?php echo $post->post_title;?></title>
    <?php }?>
    <?php wp_head();?>


<body>
    <div class="wrapper mason">

        <header class="header ">
            <button class="main_menu_btn" data-toggle=".mason--menu">
                <span class="main_menu_btn_open"><i class="fa fa-bars"></i>Open</span>
                <span class="main_menu_btn_close"><i class="fa fa-times"></i>Close</span>
            </button>
            <section class="menu">
                <div class="menu_wrapper">
                    <div class="search">
                        <form class="search_form" method="get" id="searchform" class="searchform" action="/">
                            <div class="search_wrapper">
                                <input class="search_input" value="" name="s" id="s" type="text" placeholder="Search" />
                                <button class="search_button" id="searchsubmit" value="Search" type="submit"><i class="fa fa-search"></i></button>
                                <button class="search_cancel" data-toggle=".mason--search" type="button"><i class="fa fa-times"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="quick_links">
                        <button class="quick_search" data-toggle=".mason--search"><i class="fa fa-search"></i></button>
                        <a href="https://www.facebook.com/hethersetthawkscsc/?fref=ts" class="quick_facebook" target="_blank"><i class="fa fa-facebook-square"></i><span>Facebook</span></a>
                    </div>
                    <?php wp_nav_menu(array('theme_location' => '', 'menu' => 'Main Menu', 'container' => 'nav', 'container_class' => 'main_menu_list', 'container_id' => '', 'menu_class' => 'main_menu', 'menu_id' => '', 'echo' => true, 'fallback_cb' => 'wp_page_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'items_wrap' => '<ul class="main_menu_list">%3$s</ul>', 'depth' => 2, 'walker' => ''));?>
                </div>
            </section>
            <div class="banner">
                <div class="banner_wave">
                    <svg width="100%" height="208px">
                        <pattern id="wave" patternUnits="userSpaceOnUse" width="1200" height="200">
                            <path d="M0,100 C400,150 800,50 1200,100 L1200,00 L0,0 Z"></path>
                        </pattern>
                        <path d="M0,183 C500,290 350,0 1200,100 L1200,00 L0,0 Z"></path>
                        <rect x="1200" y="0" width="100%" height="200" fill="url(#wave)"></rect>
                    </svg>
                </div>
                <img src="<?php echo bloginfo('template_directory') . '/_includes/images/banner.jpg'; ?>" alt="banner" />
                <div class="header_title"><a href="/"><span class="hethersett">Hethersett</span><span class="hawks">Hawks</span><span class="csc">Cycle Speedway Club</span></a></div>
                <div class="header_est"><p>Established in 1966</p></div>
                <div class="header_jubilee"><p>Celebrating 50 Years of Hethersett Cycle Speedway Club</p></div>
            </div>
        </header>
        <div class="container">
        <?php if (!is_front_page() || !is_home()){ ?>
            <div class="breadcrumbs">
                <?php if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb('<p class="breadcrumbs">','</p>');
} ?>
</div>
<?php } ?>
