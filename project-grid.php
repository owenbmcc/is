<div class="projects-grid">
	<?php 
		$project_counter = 0; 
		$project_count = 3;
		/* count 3 then 2 projects */
	?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php if (!has_category( 'private' )) : ?>

		<div  class="project">
			
			<div class="thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php if ( has_post_thumbnail() ) {the_post_thumbnail('post-medium', array( 'class' => 'img-fluid' ) ); }?>
				</a>
			</div>
			
			<div class="info <?php if (!has_post_thumbnail()) echo 'no-featured-image' ?>">
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
		</div>
		
		
		<?php 
			$project_counter += 1; 
			if ($project_count == $project_counter) {
				?>
			<div class="break"></div>
		<?php
			$project_counter = 0;
			$project_count = ($project_count == 2 ? 3 : 2);
			}
		?>
		<?php endif; ?>
	<?php endwhile; ?>
</div>
	<?php else:  //there are no posts ?>
		<div class="col-sm-12" id="content">
			<div class="nocontent">
				<h2>No Posts Found</h2>
				<p>It looks like there are no posts for this archive.</p>
			</div>
		</div>
	<?php endif; ?>
</div><!--end projects grid -->