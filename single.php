<?php
/*
 * Template Name: Sidebar page
 */

?>
<?php get_header(); ?>
<div class="col-lg-9">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="row">
            <div class="col-lg-3"><?= the_post_thumbnail('thumbnail'); ?></div>
            <div class="col-lg-9">
                <h2><?= the_title(); ?></h2>
                <p><?= the_content(); ?></p>
                <i><?= the_date(); ?></i>
            </div>
        </article>
	<?php endwhile; endif; ?>
</div>
<div class="col-lg-3 fancy-sidebar">
	<?php dynamic_sidebar();?>
</div>
<?php get_footer(); ?>



