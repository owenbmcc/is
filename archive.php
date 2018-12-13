ARCHIVE????

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
                        if ( is_day() ) { 
                            echo 'Archive for ' . get_the_date(); 
                        } elseif ( is_month() ) { 
                            echo 'Archive for ' . get_the_date('F Y'); 
                        } elseif ( is_year() ) { 
                            echo 'Archive for ' . get_the_date('Y'); 
                        } elseif ( is_tag() ) { 
                            echo 'Posts Tagged with ' . $queried_object->name ; 
                        } elseif ( is_category() ) { 
                            echo $queried_object->name ;//just echo out the category name 
                        }elseif($queried_object->user_login){
                            echo 'Posts by ' . $queried_object->user_nicename ;
                        } 
                        ?>
            </h2>
            
            <?php //add in category description ?>
            <p class="category-description">
                <?php
						 if( is_category()){
						 	//echo '<p>' . $queried_object->description . '</p>';
						 	//trying something else instead
						 	echo category_description();
						}
  			  
  						//print_r(get_queried_object());
                ?>
            </p>
    </div> 
<!--    end smal-12 that contains archive title-->
  
            <?php //Now show the posts
                
                //this gets ready for the loop
//                rewind_posts();
//		print_r(get_queried_object());
                while (have_posts()) : the_post(); ?>
                   <div class="col-xs-12 col-sm-2 col-md-3">

                    <article id="post-<?php the_ID(); ?>" <?php post_class('index-card'); ?>>
                        <header>
                            <h2><a href="<?php the_permalink(); ?>"<?php the_title(); ?></a></h2>
                        </header>
                        <div class="entry-content">
                            <figure>
                                <a href="<?php the_permalink(); ?>">
                                <?php if ( has_post_thumbnail() ) {the_post_thumbnail('large'); } ?></a></figure> <?php the_excerpt(); ?>
                        </div>
                    </article>
                    </div>
            <?php
                endwhile; 
            ?>
        
    
            
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




<?php get_footer(); ?>