<!-- 
	currently no links to page using category,
	everything is taxonomy
	ignoring this for now
 -->
<?php get_header(); ?>

<?php $taxonomy = get_queried_object(); ?>
<div class="title gallery-header">
	<?php echo $taxonomy->name; ?> Gallery
</div>

<?php get_template_part( 'project-grid' ); ?>

<?php get_footer(); ?>