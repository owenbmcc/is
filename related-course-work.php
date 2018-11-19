                        
<?php //Custom WP_Query to find other work in the course. Meant to be called from inside post loop ?>
<?php if(taxonomy_exists('course')): ?>
    <?php
        //get the current course slug
        $course = wp_get_post_terms($post->ID, 'course');
    //  print_r($course);
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => '1',
            'post__not_in' => array($post->ID),
            'tax_query' => array(
                array(
                    'taxonomy' => 'course',
                    'field'    => 'slug',
                    'terms'    => $course[0]->slug
                )
            )
        );
        $the_query = new WP_Query( $args );
    //                               print_r($the_query);
    ?>

    <?php if ( $the_query->have_posts() ) : ?> 
        <div class="col">
        <div class="related-work-course">
           <h3>Other Work in the <?php echo $course[0]->name ?> Course</h3>
            <!-- the loop -->
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <div >  
                    <?php get_template_part('content','thumbnail'); ?>
                </div>                                  
            <!-- end of the loop -->
            <?php endwhile; ?>
        </div>
        </div><!-- end column -->
        <?php wp_reset_postdata(); ?>

    <?php else : ?>
    <!-- No other course posts were found -->
    <?php endif; ?> 

<!-- end taxonomy_exists() -->
<?php endif; ?> 