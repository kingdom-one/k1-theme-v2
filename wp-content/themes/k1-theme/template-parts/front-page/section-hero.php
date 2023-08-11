<?php
/**
 * Custom Front-Page Hero
 */

$content = new Content_Sections();

?>
<section class="hero d-flex flex-column justify-content-center" id="hero">
	<?php
	$hero = get_field( 'hero', get_the_ID() );
	extract( $hero );
	$headline = empty( $alternate_headline ) ? get_the_title( $post_id ) : $alternate_headline;
	echo $content->get_hero_background( $has_background_image, $color, $color_direction, $background_image );
	echo $content->get_hero_content( $headline, $subheadline, false );
	?>
	<div class="container my-5">
		<div class="row position-relative z-3">
			<div class="col-1"></div>
			<div class="col-lg-11">
				<?php $content->cta_button(); ?>
				<?php
				$content->cta_button(
					array(
						'text'       => 'Learn More',
						'link'       => '#',
						'html_class' => 'btn__white--outline mx-5',
					)
				);
				?>
			</div>
		</div>
	</div>
</section>