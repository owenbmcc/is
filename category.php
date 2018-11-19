<?php get_header(); ?>

<div id="archive" class="main-content">
         

<div id="hg">
<div class="container">
<div class="row">
    <div class="col-md-10 col-md-offset-1 centered">

        <?php //run the wordpress loop 
        if (have_posts()) : //Set the title for the page the_post(); ?
                       
            //get queried object in case it's needed
            $queried_object = get_queried_object();
            ?>
            <h1 class="page-title" data-effect="slide-bottom"><?php echo $queried_object->name ; ?> <br> Gallery</h1>
    </div> <!--/col-->
</div><!--/row -->
</div><!--/container -->
</div><!--/hg -->


<!--    end smal-12 that contains category title -->
  <div class="container gallerySpace">
    <div class="row">
                  
            <?php //Now show the posts
                
                //this gets ready for the loop
//                rewind_posts();
//		print_r(get_queried_object());
                while (have_posts()) : the_post(); ?>
<!--
                   <div class="col-xs-12 col-sm-2 col-md-3">

                    <article id="post-<?php the_ID(); ?>" <?php post_class('index-card'); ?>>
                        <header>
                            <h2><a href="<?php the_permalink(); ?>"<?php the_title(); ?></a></h2>
                        </header>
                        <div class="entry-content">
                            <figure>
                                <a href="<?php the_permalink(); ?>">
                                <?php if ( has_post_thumbnail() ) {the_post_thumbnail('post-large','class= img-fluid'); } ?></a></figure> <?php the_title(); ?>
                        </div>
                    </article>
                    </div>
-->
           <div class="col-sm-4 mb-5">
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                    <p>
                       <!-- check if the post has a Post Thumbnail assigned to it. -->
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
                   <?php echo get_the_term_list( $post->ID, 'students', 'Student: ', ', ', '' ); ?><br/>
                   <?php echo get_the_term_list( $post->ID, 'major', 'Major: ', ', ', '' ); ?> <br/>
                   <?php echo get_the_term_list( $post->ID, 'course', 'Course: ', ', ', '' ); ?> <br/>
                    </p>
                    
                </div> <!-- end post -->
                </div> <!-- end column -->
           
           
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

<?php //WE NEED TO IMPLEMENT PAGING HERE FOR WHEN THERE ARE A LOT OF POSTS ?>
<!--     
          <div class="col-12">
            <div class="prev-next">
               <img src="http://group.bmcc.is/g2_sp16/wp-content/uploads/2016/05/Next-Prev-Icons-01.png"> 
                &nbsp;
                 <img src="http://group.bmcc.is/g2_sp16/wp-content/uploads/2016/05/Next-Prev-Icons-02.png">
            </div>  end prev-next 
-->
        </div> <!-- end col -->
</div> <!-- end row -->
</div> <!--end container-->
</div>
<!--end #archive .main-content-->




<?php get_footer(); ?>