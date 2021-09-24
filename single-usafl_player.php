<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Miniva
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) :
			the_post();

		?>


		<?php 
			do_action( 'miniva_post_before' );
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php 
			do_action( 'miniva_post_start' ); 
			$thisplayermeta = get_post_meta( $post->ID, 'player_information', true ); 
		?>

		<header class="entry-header">
			<?php
				$thetitle = get_the_title($post -> ID);
			?>
			<h1 class='entry-title'><?php echo $thisplayermeta['number'].". ".$thetitle;?></h1>
			<?php
			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php
					miniva_posted_on();
					miniva_posted_by();
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<?php 
			do_action( 'miniva_post_middle' );
		 ?>

		<div class="entry-content">
			<div class="player_information">
				<div class="player_information_fact">
					<?php if ($thisplayermeta['birthdate'] != '') { ?>
					<span class='player_information_label'>Age:</span>
					<span class= 'player_information_data'>
						<?php 
							$todayis = strtotime(date("Y-m-d"));
							$timediff = $todayis - strtotime($thisplayermeta['birthdate']);
							//$theinterval = $todayis->diff($thisplayermeta['birthdate'])->format("%a");
							echo floor($timediff / (60*60*24*365.25));
							//echo $todayis . " " .$thisplayermeta['birthdate'] . " // " . $theinterval; //$todayis - $thisplayermeta['birthdate'];
						?>
					</span>
				</div><!-- .player_information_fact -->
				 <?php } ?>
				<div class="player_information_fact">
					<span class='player_information_label'>Height:</span>
					<span class= 'player_information_data'><?php echo $thisplayermeta['height'];?></span>
				</div><!-- .player_information_fact -->
				<div class="player_information_fact">
					<span class='player_information_label'>Nationality:</span>
					<span class= 'player_information_data'><?php 
						echo get_flag_emoji_unicode($thisplayermeta['nationality']) . $thisplayermeta['nationality'];
						?>
					</span>
				</div><!-- .player_information_fact -->
				<div class="player_information_fact">
					<span class='player_information_label'>Position:</span>
					<span class= 'player_information_data'><?php echo $thisplayermeta['position'];?></span>
				</div><!-- .player_information_fact -->
				<div class="player_information_fact">
					<span class='player_information_label'>Seasons:</span>
					<span class= 'player_information_data'><?php echo $thisplayermeta['seasons'];?></span>
				</div><!-- .player_information_fact -->
			</div><!-- .player_information -->

                <h2>About <?php 
                				if ($thisplayermeta['name_nickname'] != '') {
                					echo $thisplayermeta['name_nickname']; 
                				} else {
            						echo $thisplayermeta['name_first'];
            					}
                			?></h2>
			<?php miniva_the_content(); ?>
			<?php if ((get_post_field('menu_order', $post->ID) < 100) || (strpos($thisplayermeta['seasons'], date("y")) !== false)) {   // i.e. if substring is found ?>  
				<div class='player_information_linkback'><a href="localhost/baltimoredockers.com/roster/">Back to roster page</a></div>
			<?php } else { ?>
				<div class='player_information_linkback'><a href="localhost/baltimoredockers.com/alumni/">Back to alumni page</a></div>
			<?php } ?> 
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php miniva_entry_footer(); ?>
		</footer><!-- .entry-footer -->

		<?php do_action( 'miniva_post_end' ); ?>

	</article><!-- #post-<?php the_ID(); ?> -->

	<?php do_action( 'miniva_post_after' ); ?>

	<?php 
		/*
			if ( function_exists( 'jetpack_author_bio' ) ) {
				jetpack_author_bio();
			}

			the_post_navigation(
				array(
					'prev_text' => '<span>' . __( 'Previous Post', 'miniva' ) . '</span>%title',
					'next_text' => '<span>' . __( 'Next Post', 'miniva' ) . '</span>%title',
				)
			); */

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
?>
