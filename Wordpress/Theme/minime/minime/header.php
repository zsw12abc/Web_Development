<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>


        <!-- Meta UTF8 charset -->
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <!-- Basic page information --> 
        <meta name="author" content="<?php echo esc_html( ot_get_option( 'minime_author' ) ) ?>">
        <meta name="description" content="<?php echo esc_html( ot_get_option( 'minime_description' ) ) ?>">
		<meta name="keywords" content="<?php echo esc_html( ot_get_option( 'minime_keywords' ) ) ?>">
        <title><?php wp_title( '|', true, 'right' ); ?></title>		

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />


        <!--favicon-->
        <link rel="apple-touch-icon" href="<?php echo esc_url( ot_get_option( 'minime_fav' ) ) ?>">
        <link rel="icon" href="<?php echo esc_url( ot_get_option( 'minime_fav' ) ) ?>">



    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >

<div id="loader-wrapper">
    <div id="loader"></div>
</div>