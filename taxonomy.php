<?php get_header(); ?>

<div class="taxonomy-info">
	<?php $taxonomy = get_queried_object(); ?>
	<div class="title page-header">
		<?php echo $taxonomy->name; ?>
	</div>
	<div class="content">
		<p><?php echo $taxonomy->description; ?></p>
	</div>
</div>

<div class="title projects-header">
	Student Work
</div>

<?php get_template_part( 'project-grid' ); ?>

<?php get_footer(); ?>