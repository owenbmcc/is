</div> <!-- end #content -->

<!--  modified from template by chris stein -->
<div id="footer">
	<div class="two-column">
		<div class="col">
			<h2>BMCC Student Showcase</h2>
			<p>A collection of work from our talented and hard-working students here at Borough of Manhattan Community College.</p>
		</div>
		<div class="col">
			<a href="http://www.bmcc.cuny.edu/media-arts/" target="blank">
				<h3>MEA Department Website:</h3>
				<img id="bmcc-logo" src="<?php echo get_template_directory_uri() . '/img/BMCC-Logo_white.gif' ?>">
			</a>
		</div>
	</div>
	<div class="bottom">
		&copy; <?php the_date('Y'); ?> <?php bloginfo('name'); ?>
	</div>
</div>

<?php wp_footer(); // js scripts are inserted using this function ?>
</body>
</html>