<?php
get_header();
if (is_user_logged_in()) {
    $args = [
            'post_type' => ['post'],
            'post_status' => ['publish', 'draft'],
            'posts_per_page' => 4,
        ];
}
else {
	$args = [
		'post_type' => ['post'],
		'post_status' => ['publish'],
		'posts_per_page' => 4,

	];
}
$query = new WP_Query($args);
?>
    <div class="row"><h1>MAISON</h1></div>
    <div class="row"><?php get_search_form(); ?></div>
    <div class="col-lg-6 home-leftside">
        <h2>Articles récents</h2>
        <div class="row">
			<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                <div class="col-lg-6 home-leftsize">
                    <div class="thumbnail">
						<?= the_post_thumbnail('original'); ?>
                        <div class="caption">
                            <h4 class="gros-titre"><?= the_title(); ?></h4>
                            <?= the_content(); ?>
                            <i><?= the_modified_date(); ?></i><br/>
                            <a href="<?= the_permalink(); ?>" class="btn btn-primary" role="button">Lire la suite</a>
                        </div>
                    </div>
                </div>
			<?php endwhile; endif; ?>
        </div>
    </div>
	    <?php
	    if (is_user_logged_in()) {
		    $args = [
			    'post_type' => ['films', 'series', 'animes'],
			    'post_status' => ['publish', 'draft'],
			    'posts_per_page' => 4,
		    ];
	    }
	    else {
		    $args = [
			    'post_type' => ['films', 'series', 'animes'],
			    'post_status' => ['publish'],
			    'posts_per_page' => 4,

		    ];
	    }
	    $query = new WP_Query($args);
	    ?>
    <div class="col-lg-6 home-rightside">
        <h2>Films et séries ajoutés récemment</h2>
        <div class="row">
			<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                <div class="col-lg-6">
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

<?php
get_footer();
