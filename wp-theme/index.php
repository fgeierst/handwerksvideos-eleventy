<?php
/**
 * Main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package P2
 */
?>
<?php get_header(); ?>

<div class="sleeve_main">
	<?php if ( p2_user_can_post() && !is_archive() ) : ?>
		<?php locate_template( array( 'post-form.php' ), true ); ?>
	<?php endif; ?>
	<div id="main">
		<h2>Blog
		</h2>


		<ul id="postlist">
		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
	    		<?php p2_load_entry(); ?>
			<?php endwhile; ?>

		<?php else : ?>

			<li class="no-posts">
		    	<h3><?php _e( 'No posts yet!', 'p2' ); ?></h3>
			</li>

		<?php endif; ?>
		</ul>

		<div class="navigation">
			<p class="nav-older"><?php next_posts_link( __( '&larr; Older posts', 'p2' ) ); ?></p>
			<p class="nav-newer"><?php previous_posts_link( __( 'Newer posts &rarr;', 'p2' ) ); ?></p>
		</div>

	</div> <!-- main -->

</div> <!-- sleeve -->

<?php get_footer(); ?>