<?php /* Template Name: Portfolios Template */ ?>
<?php get_header(); ?>


<div class="title main-title">
	Portfolios
</div>

<?php 
	$query = new WP_Query( array( 'category_name' => 'portfolios' ) ); 
?>

<div class="projects-grid portfolios">

	<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
    	<?php $portfolio_url = get_post_meta($post->ID, "portfolio_url", true); ?>
    	<div  class="project portfolio">
    		<div class="thumbnail">
				<a href="<?php echo $portfolio_url ?>" target="_blank">
					<?php if ( has_post_thumbnail() ) {the_post_thumbnail('post-medium', array( 'class' => 'img-fluid' ) ); }?>
				</a>
			</div>

			<div class="info <?php if (!has_post_thumbnail()) echo 'no-featured-image' ?>">
				
				<div class="title"><a href="<?php echo $portfolio_url ?>" target="_blank">
					<?php the_title(); ?></a>
				</div>
				
			</div>
    	</div>



    <?php endwhile; ?>
	<?php else : ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; ?>

</div>

<?php get_footer(); ?>