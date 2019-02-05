<!-- 
	pretty sure this isn't used, should consider removing
 -->

<?php get_header(); ?>
<div class="container">
	<div class="row">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
			    <div class="col-sm-4">
			        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
			            <!-- check if the post has a Post Thumbnail assigned to it. -->
			            <p>
			            	<?php if ( has_post_thumbnail() ) : ?>
			            		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php  the_post_thumbnail( 'post-medium', array( 'class' => 'img-fluid' ) );?>
								</a>
							<?php endif; ?>
						</p>
						<!-- show the title as h3 element-->
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_title('<h3>','</h3>'); ?> 
						</a>
			   
						<p>
			      			<!-- <?php echo get_the_term_list( $post->ID, 'students', 'Student: ', ', ', '' ); ?><br/>
							<?php echo get_the_term_list( $post->ID, 'major', 'Major: ', ', ', '' ); ?> <br/>
							<?php echo get_the_term_list( $post->ID, 'course', 'Course: ', ', ', '' ); ?> <br/> -->
						</p>
					</div> <!-- end post -->
				</div> <!-- end column -->
		<?php endwhile; ?>	
		<?php else : ?>
			 <div class="col-sm-8 col-sm-push-2 col-md-4 col-md-push-4">
				<p>No posts found</p>
			</div>
		<?php endif; ?>
		</div><!-- end row-->   
</div><!-- end container-->



<?php get_footer(); ?>
