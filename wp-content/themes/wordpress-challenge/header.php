<!DOCTYPE html>
<html lang="en">

<head>

<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>

    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/slick.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/custom.js"></script>
<?php
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$httpOptions = array('http' => array(
 'method'  => 'GET',
 'ignore_errors' => true
));
$context  = stream_context_create($httpOptions);
?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?<?php echo generateRandomString(); ?>" type="text/css" />
    
    <?php wp_head(); ?>
    
</head>

<body>

<header>
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="logo">Jobsity Wordpress Challenge<span>By Fausto Balloni Filho</span></div>
                <nav class="main-menu">
                    <ul>
                        <?php if ( !function_exists('dynamic_sidebar')
                        || !dynamic_sidebar('Header Sidebar') ) : ?>
                        <?php endif; ?>
                    </ul>
                </nav>

            </div>
        </div>
    </div>

</header>