<div class="thumbnail-link">
    <p>
       <!-- check if the post has a Post Thumbnail assigned to it. -->
        <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
              <?php  the_post_thumbnail( 'post-medium', array( 'class' => 'img-fluid' ) );?>
            </a>
        <?php endif; ?>

    </p>
    <!-- show the title as h4 element-->
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <h4><?php the_title(); ?></h4> 
    </a>
</div>