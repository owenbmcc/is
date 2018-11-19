<?php get_header(); ?>

    <!-- CHANGE THIS TO class="container-fluid" if you want the content to span the whole width of the page -->
    <div class="container pushdown" id="content">

        <?php if (have_posts()) : ?>

            <?php while (have_posts()) : the_post(); ?>
                <div class="row">
                    <div class="col-sm-12 col-lg-7">
                        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                            <!-- featured image across the top -->                  
                                <p>
                                    <!-- check if the post has a Post Thumbnail assigned to it. -->
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                            <?php  the_post_thumbnail( 'post-featured', array( 'class' => 'img-fluid' ) );?>
                                        </a>
                                        <?php endif; ?>
                                </p>
                        </div><!-- end post -->
                    </div><!-- end col -->        
                   
                    <div class="col-lg-5">        
                    <!-- This shows the title of the post  -->

                        <!-- show the title as h3 element-->
                        <?php the_title('<h3>','</h3>'); ?>
                        <?php //if there is a url custom field then show it
                        $url = get_post_meta($post->ID, 'url', true);
                        if($url):?>
                            <p class="view-work">
                                view work: <a href="<?php echo $url ?>" > <?php echo $url ?> </a>
                            </p>
                        <?php endif; ?>
                    
                        <div class="work-info">
                            <div class="student">
                           <?php //these next few lines only work if the Taxonomy Images plugin is installed
                                $image = apply_filters( 'taxonomy-images-list-the-terms', '', array(
                                    'before'       => '',
                                    'after'        => '',
                                    'before_image' => '',
                                    'after_image'  => '',
                                    'image_size' => 'thumbnail',
                                    'attr' => array('class' => 'img-fluid'),
                                    'taxonomy'     => 'students',
                                ) );
                            
                                if(!empty($image)):
                            ?>                       
                                <div class="student-picture">
                                    <?php 
                                        echo $image; 
                                    ?>
                                </div>
                            <?php endif; ?>
                            <?php //this requires the Media Creators Plugin is installed ?>
                            <p>Student: <?php echo get_the_term_list( $post->ID, 'students', ' ',', '); 
                                //add a comma if more than one student?></p>
                            <p>Major: <?php echo get_the_term_list( $post->ID, 'major'); ?> </p>
                            <p>Class: <?php echo get_the_term_list( $post->ID, 'course'); ?> </p>
                            </div>
                        </div><!-- end work info-->
                    </div> <!-- end col -->
                </div> <!-- end row-->
                
                <div class="row">   
                  <div class="col-lg-12">
                        
                       <div class="main-content">
                           <!-- main page content You need to add your own bootstrap markup to the page content
                                by entering it in the content field in the dashboard.
                                No div.row or anything is wrapped here so each page can do its own thing. TO change the
                                position of the title or featured image from page to page you would need to modify them
                                in this file or create more than one page template file.
                                Make sure to add at least one <div class="row"> around your content when you add it in the dashboard.
                            -->
                           <?php the_content() ?>
                       </div>
                   </div> <!-- end col-->
                </div><!-- end row-->
                        
                        
                 <div class="row">
                    <div class="col-12">
                        <div class="prev-next">
                            <?php
                                $prev = get_previous_post_link('Previous Work: %link', '%title');
                                if(!empty($prev)):
                                ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/img/Next-Prev-Icons-01.png"> 
                                <?php echo($prev); ?>
                                <?php //previous_post_link('Previous Work: %link', '%title'); ?> </a>
                                <?php endif; ?>
                            

                            &nbsp;&nbsp;&nbsp;
                            <?php
                                $next = get_next_post_link('Next Work: %link', '%title');
                                if(!empty($next)):
                                    echo($next);
                                ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/Next-Prev-Icons-02.png">
                            <?php endif; ?>
                        </div> <!-- end prev-next -->
                    </div>
                </div>   
                

                    <div class="related-work row">
                                        
                        <?php get_template_part('related-work-student'); ?>
                        <!-- ---------------------------------------------------- -->

                        <?php get_template_part('related-work-major'); ?>
                        
                        <!-- ---------------------------------------------------- -->
                        <?php get_template_part('related-work-course'); ?>
                          
                    </div> <!-- end related work --> 

                    

        <?php endwhile; ?>
        <?php endif; ?>
                    

                <!-- end post -->
                </div>

        

    </div>
    <!-- end container-->




    <?php get_footer(); ?>