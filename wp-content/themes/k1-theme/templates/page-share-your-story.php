<?php
/**
 * Page: Share Your Story
 *
 * @package KingdomOne
 */

$content = new Content_Sections();
k1_enqueue_page_style( 'shareYourStory' );

/** Strips videoId from Youtube Video
 *
 * @param string $url the URL
 */
function k1_get_youtube_video_id( string $url ): string|false {
	// Parse the URL to get its components
	$parsed_url = wp_parse_url( $url );

	// Check if the URL contains a query string
	if ( isset( $parsed_url['query'] ) ) {
		// Parse the query string into an associative array
		parse_str( $parsed_url['query'], $query_parameters );

		// Check if the 'v' parameter is set
		if ( ! empty( $query_parameters['v'] ) ) {
			return $query_parameters['v'];
		}
	}
	// If the 'v' parameter was not found, return false
	return false;
}

?>
<section class="bg-color-primary" id='section-2'>
	<div class="container">
		<div class="row text-sm-center text-lg-end">
			<h2 class="headline text-white">what's your story?</h2>
			<p class="subheadline fw-bold text-black">The best way to share our vision of being courageous, healthy & effective is by sharing stories of life change within your ministry.
			</p>
		</div>
	</div>
</section>
<section class="story-examples">
	<div class="container">
		<div class="row py-5">
			<h2 class="headline h1 text-center mt-5">we love hearing stories</h2>
			<?php k1_get_svg_asset( 'leaves-3' ); ?>
			<span class="subheadline text-center">Send us your personal story of how Kingdom One has changed your life by sharing your story and or answering the following
				questions:</span>
		</div>
		<div class="row mt-5">
			<h3 class="text-center">tell us things like...</h3>
		</div>
		<div class="row my-5">
			<?php
			$story_cols = array(
				array(
					'svg'     => 'profile',
					'content' => 'What’s your name and where are you from?',
				),
				array(
					'svg'     => 'compass',
					'content' => 'How did you discover Kingdom One?',
				),
				array(
					'svg'     => 'clock',
					'content' => 'What was life like before Kingdom One?',
				),
				array(
					'svg'     => 'lightbulb',
					'content' => 'How has Kingdom One been a light in your ministry?',
				),
			);
			?>
			<?php foreach ( $story_cols as $col ) : ?>
			<div class=" my-5 my-lg-0 col-sm-6 col-lg-3 d-flex flex-column align-items-center">
				<?php k1_get_svg_asset( 'story-icon-' . $col['svg'] ); ?>
				<p class="text-center"><?php echo $col['content']; ?></p>
			</div>
			<?php endforeach; ?>
		</div>
		<div class="row mt-5 justify-content-center">
			<?php
			$content->cta_button(
				array(
					'text' => 'Share Now',
					'link' => '/share-your-story#share-form',
				)
			);
			?>
		</div>
	</div>
</section>
<?php
$query = new WP_Query(
	array(
		'posts_per_page' => 6,
		'post_type'      => 'stories',
	)
);
?>
<?php if ( $query->have_posts() ) : ?>
<section class="stories">
	<?php $content->get_color_background_layers( 'stories', 'left' ); ?>
	<div class="stories__content z-3 position-relative">
		<div class="container">
			<div class="row my-5">
				<div class="col">
					<h2 class="headline text-white">recent stories</h2>
					<?php k1_get_svg_asset( 'leaves-3' ); ?>
				</div>
			</div>
			<div class="row">
				<?php
				$query = new WP_Query(
					array(
						'posts_per_page' => -1,
						'post_type'      => 'stories',
					)
				);
				?>
				<?php while ( $query->have_posts() ) : ?>
					<?php $query->the_post(); ?>
				<div class="story col-lg-4 my-5">
					<div class="story__video">
						<lite-youtube videoid="<?php the_field( 'video_id' ); ?>"></lite-youtube>
					</div>
					<?php the_title( '<h3 class="headline text-white h4 story__title">', '</h3>' ); ?>
				</div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<section class="how-it-works">
	<div class="container">
		<div class="row justify-content-lg-end">
			<div class="col-lg-8 text-lg-end position-relative">
				<?php k1_get_svg_asset( 'leaves-3' ); ?>
				<h2 class="headline">How It Works</h2>
				<p class="subheadline">If you would like to share your story with us, there are a couple of ways you can do that!</p>
			</div>
		</div>
		<div class="row my-5">
			<div class="col-lg-6 d-flex flex-column align-items-center">
				<?php k1_get_svg_asset( 'story-icon-phone' ); ?>
				<h3 class="headline color-grey text-poppins my-5">Give Us A Call!</h3>
				<ol>
					<li>Find a nice quiet place to call in your story</li>
					<li>Call (951) 223-1104</li>
					<li>Share your story in 2-3 minutes as a voicemail</li>
				</ol>
			</div>
			<div class="col-lg-6 d-flex flex-column align-items-center">
				<?php k1_get_svg_asset( 'story-icon-video' ); ?>
				<h3 class="headline color-grey text-poppins my-5">Send us a video!</h3>
				<ol>
					<li>Find a nice, quiet place that's well-lit to record your story</li>
					<li>Record your story with a smartphone in landscape (horizontal) mode</li>
					<li>Let us know you're ready to share with the form below!</li>
				</ol>
			</div>
		</div>
		<div class="row text-center">
			<small>By sharing your story you give Kingdom One permission to edit, reformat, share, or publish your story publicly.</small>
		</div>
		<div class="row contact justify-content-center my-5 py-5" id='share-form'>
			<div class="col-10">
				<h3 class="headline text-center color-primary--dark my-3">ready to share?</h3>
				<?php echo do_shortcode( '[contact-form-7 id="36b3aef" title="Share Your Story"]' ); ?>
			</div>
		</div>
	</div>
</section>
