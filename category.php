<?php get_header(); ?>

<?php 
	// echo get_query_var( 'slideshow' );
?>

<?php $taxonomy = get_queried_object(); ?>
<div class="title gallery-header">
	<?php echo $taxonomy->name; ?> Gallery
</div>


<div class="projects-grid">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" class="project">
			<div class="info">
				<div class="title"><a href="<?php the_permalink(); ?>">
					<?php the_title(); ?></a>
				</div>
				<?php
					$terms = get_the_terms( $post->ID , 'students' );
					foreach ( $terms as $term ) {
						$student = $term->name;
						$student_link = get_term_link( $term );
					}
				?>
				<div class="student">
					<a href="<?php echo $student_link; ?>">
						<?php echo $student; ?>
					</a>
				</div>
			</div>
			<div class="thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php if ( has_post_thumbnail() ) {the_post_thumbnail('post-medium', array( 'class' => 'img-fluid' ) ); }?>
				</a>
			</div>
		</div>
	<?php endwhile; ?>
</div>
	<?php else:  //there are no posts?>
		<div class="col-sm-12" id="content">
			<!-- No posts were found for the archive. -->
			<div class="nocontent">
				<h2>No Posts Found</h2>
				<p>It looks like there are no posts for this archive.</p>
			</div>
		</div>
	<?php endif; ?>
</div><!--end container-->

<?php get_footer(); ?>