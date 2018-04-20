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
                <h2><a href="<?= the_permalink(); ?>"><?= the_title(); ?></a></h2>
                <?= the_content(); ?>
                <i><?= the_date(); ?></i>
            </div>
        </article>
	<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>



