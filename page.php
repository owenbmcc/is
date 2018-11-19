<?php get_header(); ?>

<!-- CHANGE THIS TO JUST class="container" if you don't want the content to span whe whole width of the page -->
<div class="container" id="content">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>

            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >

                <div class="row">
		
                        <!-- featured image across the top -->

                        <div class="col-sm-12">
                            <p>
                                <!-- check if the post has a Post Thumbnail assigned to it. -->
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <?php  the_post_thumbnail( 'post-medium', array( 'class' => 'img-fluid' ) );?>
                                    </a>
                                <?php endif; ?>

                            </p>
                        </div>

                    </div>
	
                    <!-- end row -->

                    <div class="row">
                        <div class="col-sm-12">

                            <!-- show the title as h3 element-->
                            <?php the_title('<h3>','</h3>'); ?>
                        </div>
                    </div>

                    <div class="main-content">
                        <!-- main page content You need to add your own bootstrap markup to the page content
                             by entering it in the content field in the dashboard.
                             No div.row or anything is wrapped here so each page can do its own thing. TO change the
                             position of the title or featured image from page to page you would need to modify them
                             in this file or create more than one page template file.
                         -->
                        <?php the_content() ?>
                    </div>


                </div>

                <!--                end post-->
            </div>

            <?php endwhile; ?>
               

    <?php endif; ?>

</div>
<!-- end container-->




<?php get_footer(); ?>