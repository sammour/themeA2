<?php
get_header();
?>
    <div class="col-lg-9">
        <div class="row">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="thumbnail">
						<?= the_post_thumbnail('original'); ?>
                        <div class="caption">
                            <h4 class="gros-titre"><?= the_title(); ?></h4>
                            <?= the_content(); ?>
                            <i><?= the_modified_date(); ?></i>
                            <p><a href="<?= the_permalink(); ?>" class="btn btn-primary" role="button">Lire la suite</a></p>
                        </div>
                    </div>
                </div>
			<?php endwhile; endif; ?>
        </div>
    </div>
    <div class="col-lg-3 fancy-sidebar">
		<?php dynamic_sidebar();?>
    </div>
<?php
get_footer();
