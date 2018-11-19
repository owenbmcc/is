<?php //wrap it all in a check to make sure the taxonomy exists
if( taxonomy_exists('students') ): ?>

    <?php //Custom WP_Query to find other work by this student ?>
    <?php
        //get the current student slug
        $student = wp_get_post_terms($post->ID, 'students');
//                                print_r($student);
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => '1',
            'post__not_in' => array($post->ID),
            'tax_query' => array(
                array(
                    'taxonomy' => 'students',
                    'field'    => 'slug',
                    'terms'    => $student[0]->slug
                )
            )
        );
        $the_query = new WP_Query( $args );
//                                print_r($the_query);
    ?>

    <?php if ( $the_query->have_posts() ) : ?> 
        <div class="col">
        <div class="related-work-student">
           <h3>Other Work by the Student</h3>
            <!-- the loop -->
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <div>  
                    <?php get_template_part('content','thumbnail'); ?>
                </div>                                  
            <!-- end of the loop -->
            <?php endwhile; ?>
           
        </div>
        </div><!-- end column -->
        <?php wp_reset_postdata(); ?>

    <?php else : ?>
        <!-- No other student posts were found -->
    <?php endif; ?> 
                            
<?php 
//end if taxonomy_exists()
endif; 
?>