<?php get_header(); ?>

<div id="archive" class="main-content">
    
<div class="container">
    


<div class="row">
    <div class="col-sm-12">

        <?php //run the wordpress loop 
        if (have_posts()) : //Set the title for the page the_post(); ?>
            <h2 class="page-title">
                        <?php 
                        //get queried object in case it's needed
                        $queried_object = get_queried_object();
//                        $vars = get_object_vars ( $queried_object );
//                        print_r ( $vars );
                        if ( $queried_object->taxonomy == "students" ) { 
                            echo 'Work by ' . $queried_object->name; 
                        } elseif ( $queried_object->taxonomy == "major" ) { 
                            echo 'Work by Students in the ' . $queried_object->name . ' Major';
                        } elseif ( $queried_object->taxonomy == "course" ) { 
                            echo 'Work by Students in the ' . $queried_object->name . ' Course'; 
                        } 
                        ?>
            </h2>
            
            <?php //If you added an image through the Taxonomy Images Plugin, this is how you show it 
                    //In this case it is only shown for students
                //could change to: if( is_tax('students') ):
                if ( $queried_object->taxonomy == "students" ):
            ?>
            <div class="student-image">
                <?php print apply_filters( 'taxonomy-images-queried-term-image', '', array(
                            'attr' => array('class' => 'img-fluid'),
                            'image_size' => 'post-medium'
                        ) ); ?>
            </div>
            <?php
                endif;
            ?>
            
            <?php //add in taxonomy description, if you added one ?>
                <?php
                        if( $queried_object->description){
						 	echo '<p class="taxonomy-description">' . $queried_object->description . '</p>';
						}
                ?>
            </p>
    </div> 
<!--    end smal-12 that contains archive title-->
           
            <?php //Now show the posts
                
                //this gets ready for the loop
                rewind_posts();
                while (have_posts()) : the_post(); ?>
                   <div class="col-xs-12 col-sm-2 col-md-3">

                    <article id="post-<?php the_ID(); ?>" <?php post_class('index-card'); ?>>
                        <header>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        </header>
                        <div class="entry-content">
                            <figure>
                                <a href="<?php the_permalink(); ?>">
                                <?php if ( has_post_thumbnail() ) {the_post_thumbnail('post-medium', array( 'class' => 'img-fluid' ) ); }?></a></figure> 
                            <?php the_excerpt(); ?>
                        </div>
                    </article>
                    </div>
            <?php
                endwhile; 
            ?>
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

</div>
    <!-- end row for main posts -->

</div>
<!--end container-->
</div>
<!--end #archive .main-content-->



</div>
<!--end #archive-->

<?php get_footer(); ?>