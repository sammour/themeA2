<!DOCTYPE html>
<html>
<head>
	<?php wp_head(); ?>
</head>
<body>
<header>
        <?php
	    wp_nav_menu( array(
	    	'theme_location' => 'primary',
		    'container'      => 'nav',
		    'container_class'=> 'navbar navbar-default',
		    'menu_class'     => 'nav navbar-menu',
	    ) );
    	?>
</header>
	<div class="container">
