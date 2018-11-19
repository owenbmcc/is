<?php //wrap it all in a check to make sure the taxonomy exists
if( taxonomy_exists('major') ): ?>

     <?php //Custom WP_Query to find other work in the major ?>
        <?php
            //get the current major slug
            $major = wp_get_post_terms($post->ID, 'major');
        //                                print_r($major);
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => '3',
                'post__not_in' => array($post->ID),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'major',
                        'field'    => 'slug',
                        'terms'    => $major[0]->slug
                    )
                )
            );
            $the_query = new WP_Query( $args );
        //                                print_r($the_query);
        ?>

        <?php if ( $the_query->have_posts() ) : ?> 
            <div class="col">
            <div class="related-work-major">
               <h3>Other Work in the <?php echo $major[0]->name ?> Major</h3>
                <!-- the loop -->
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
<!--                    <div>  -->
                        <?php get_template_part('content','thumbnail'); ?>
<!--                    </div>                                  -->
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