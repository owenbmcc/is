<?php get_header(); ?>

<div class="container">
	<?php  $queried_object = get_queried_object(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
		<div class="row">
			<div class="title">
				<?php echo $queried_object->name; ?>
			</div>
			<div class="content">
				<p><?php echo $queried_object->description; ?></p>
			</div>
		</div>
	</div>

	<div class="title">
		Student Work
	</div>
	<div class="project-grid">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" class="project">
				<div class="title"><a href="<?php the_permalink(); ?>">
					<?php the_title(); ?></a>
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