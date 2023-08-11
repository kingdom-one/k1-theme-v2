<?php
/**
 * Page: About
 */

k1_enqueue_page_assets( 'k1About' );
$content = new Content_Sections();
?>
<section class="empathy">
	<!-- TODO: #36 talk to tim about photo display -->
	<div class="container">
		<?php
		$content->two_col_text_and_media(
			array(
				'split'          => array( 4, 8 ),
				'headline'       => 'we understand',
				'headline_class' => 'headline text-primary',
				'media_type'     => 'svg',
				'image'          => k1_get_svg_asset( 'leaves-4', false, false ),
				'content'        => '<p><b>Leading a ministry is complex and high stakes. A few wrong decisions can lead to organizational stall-out and frustration.</b></p><p>Leading a ministry is complex and high stakes. A few wrong decisions can lead to organizational stall-out and frustration.</p>',
				'cta'            => array(
					'title' => 'Get Started',
					'url'   => '/get-started',
				),
			)
		);
		?>
	</div>
</section>
<section class="authority">
	<div class="container">
		<?php
		$args             = array(
			'split'          => array( 4, 8 ),
			'reverse'        => true,
			'headline'       => "the numbers don't lie",
			'headline_class' => 'headline text-primary',
			'media_type'     => 'svg',
			'image'          => k1_get_svg_asset( 'leaves-4', false, false ),
		);
		$args['content']  = "<p><b>The church should be the healthiest, safest and most courageous organization on the planet, <span class='color-primary'>and it's not.</span></b></p>";
		$args['content'] .= $content->bulleted_list(
			array(
				'70% of Pastors have lower self-esteem since joining the ministry',
				'70% of Pastors fight depression',
				"50% of Ministry Leaders would leave the ministry but can't find another job",
				'80% of Pastors believe ministry has a negative effect on family, and 33% siting the occupation as hazardous to overall well-being',
				'80% of Ministry spouses feel neglected and underappreciated',
				'70% of Pastors don’t have a good marriage, 38% are divorced or in the process of divorce.',
				'41% of Pastors display anger problems reported by spouses',
				'50% of Pastors watch pornography',
				'50% of Pastors report inappropriate sexual behavior with someone in the church.',
			),
			'',
			'ul',
			false
		);
		$content->two_col_text_and_media( $args );
		?>
		<div class="row my-5">
			<h2 class="headline text-lg-center">Pastors and Ministry Leaders are not the Problems</h2>
			<p class="text-lg-center">The American Church is suffering from an unhealthy understanding of organizational structure. The Kingdom One method has helped over 65 ministries,
				camps, schools, and non-profits find courage, health & effectiveness in ministry. </p>
		</div>
	</div>
</section>
<section class="choose-one">
	<?php $content->get_color_background_layers( 'choose-one', 'zig-zag-right', array( 'about-choose-one-bg', 'webp' ) ); ?>
	<div class="choose-one__content position-relative z-2">
		<div class="container">
			<div class="row align-items-end">
				<div class="col-lg-3">
					<?php k1_get_svg_asset( 'icon-status-quo-sign' ); ?>
				</div>
				<div class="col position-relative">
					<h2 class="text-primary">You can only choose one.</h2>
					<p class="text-white">We find that ministry leaders often suffer from overwhelm, exhaustion & lack of clarity. Imagine receiving help from other ministry leaders you
						trust; how would that shape your ministry? Our people, knowledge, and tools are ministry-tested and pastor approved. </p>
					<?php k1_get_svg_asset( 'leaves-3' ); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="ministry-plan">
	<div class="ministry-plan__content container">
		<div class="row justify-content-center">
			<h2 class='headline mt-5 text-center'>Your Healthy Ministry Plan <span class="text-primary">Starts Here</span></h2>
		</div>
		<div class="ministry-plan__steps row justify-content-evenly my-5">
			<?php
			$default_steps = array(
				array(
					'svg'         => 'icon-checklist-step-1',
					'headline'    => 'Take Our Assessment',
					'subheadline' => 'Take our Healthy Ministry Assessment today to find your ministry quality score.',

				),
				array(
					'svg'         => 'icon-handshake-step-2',
					'headline'    => 'Meet with a Ministry Partner',
					'subheadline' => 'Meet with a Kingdom One ministry partner to review your assessment and build a custom plan to grow your ministry efforts.',

				),
				array(
					'svg'         => 'icon-growth-step-3',
					'headline'    => 'Build Towards Health',
					'subheadline' => 'Build your ministry towards health with our team, training, and tools, so you can get back to the ministry you love.',

				),
			);
			?>
			<?php foreach ( $default_steps as $index => $step ) : ?>
			<?php $step_level = $index + 1; ?>
			<div class="<?php echo "ministry-plan__steps--step-{$step_level}"; ?> col-lg-4 my-5 my-lg-0 d-flex flex-column align-items-center text-primary--dark">
				<?php k1_get_svg_asset( $step['svg'] ); ?>
				<h3 class="text-poppins text-center align-self-stretch mt-5 mb-3"><?php echo $step['headline']; ?></h3>
				<span class="subheadline text-center align-self-stretch"><?php echo $step['subheadline']; ?></span>
			</div>
			<?php endforeach; ?>
		</div>
		<div class="row flex-column justify-content-center align-items-center">
			<?php $content->cta_button(); ?>
		</div>
	</div>
</section>
<section class="values">
	<?php $content->get_color_background_layers( 'values', 'zig-zag-left', array( 'values-bg', 'webp' ) ); ?>
	<div class="container py-5 my-5 values__content z-2">
		<div class="row justify-content-center">
			<div class="values__content--header text-center position-relative my-5">
				<h2 class="h1 headline text-primary">our values</h2>
				<?php k1_get_svg_asset( 'leaves-3' ); ?>
			</div>
		</div>
		<?php
		// TODO: #35 Debug first icon
		$values = array(
			array(
				'svg'         => 'relationship-first',
				'headline'    => 'Relationship First',
				'subheadline' => 'We invested deeply & intentionally to grow relationships that generate trust & transparency.',
			),
			array(
				'svg'         => 'ready-to-grow',
				'headline'    => 'Ready To Grow',
				'subheadline' => 'We attract, develop, disciple and train the current and future church. Actively develop and refine tools, materials, networks and resources that are helpful to church leaders both inside and outside of Kingdom One.',
			),
			array(
				'svg'         => 'deep-work',
				'headline'    => 'Deep Work',
				'subheadline' => 'We roll up our sleeves and step into the trenches with ministry teams. The quality and excellence of our work is matched by our willingness to challenge the status quo and do the hard work that produces lasting health.',
			),
			array(
				'svg'         => 'health',
				'headline'    => 'In Pursuit of Health',
				'subheadline' => 'We seek to overcome distraction, burnout and the superficial. We cultivate organizational and personal health to run with perseverance the race marked out for us, fixing our eyes on Jesus.',
			),
			array(
				'svg'         => 'no-silos',
				'headline'    => 'No Silos, Egos or Turf Wars',
				'subheadline' => 'We refuse to let pride ruin our ministry or Christ’s church. We collaborate to bring harmony, humility, and unity because we are better together.',
			),
			array(
				'svg'         => 'fun',
				'headline'    => 'Fans of Fun',
				'subheadline' => 'Fun is non-negotiable. We foster an environment where we can keep levity and fun at the heart of what we do.',
			),
		);
		foreach ( $values as $index => $value ) :
			$is_even   = 0 === $index % 2;
			$row_class = $is_even ? 'row' : 'row flex-row-reverse';
			echo "<div class='{$row_class} justify-content-center my-5'>";
			echo "<div class='col-lg-2'>" . k1_get_svg_asset( 'values-' . $value['svg'], false, false ) . '</div>';
			$col_class = ! $is_even ? 'text-lg-end' : '';
			?>
		<div class="<?php echo $col_class; ?> mt-5 mt-lg-0 col-lg-8 d-flex flex-column justify-content-center">
			<h3 class="text-white">
				<?php echo $value['headline']; ?>
			</h3>
			<span class="h4 text-primary">
				<?php echo $value['subheadline']; ?>
			</span>
		</div>
		<?php echo '</div>'; ?>
		<?php endforeach; ?>
	</div>
</section>
<section class="staff">
	<div class="container">
		<div class="row justify-content-center">
			<?php k1_get_svg_asset( 'leaves-3' ); ?>
			<h2 class="display-1 w-auto headline text-primary my-5 text-center">our leadership team</h2>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row my-5 py-5">
			<div class="swiper" id="staff-swiper">
				<div class="swiper-wrapper">
					<?php
					$staff = array(
						array( 'img' => k1_get_image_asset_url( 'tester', 'png', 'staff', false ) ),
						array( 'img' => k1_get_image_asset_url( 'tester', 'png', 'staff', false ) ),
						array( 'img' => k1_get_image_asset_url( 'tester', 'png', 'staff', false ) ),
						array( 'img' => k1_get_image_asset_url( 'tester', 'png', 'staff', false ) ),
					);
					foreach ( $staff as $person ) {
						echo "<div class='swiper-slide'><img class='ratio ratio-1x1' src='{$person['img']}' /></div>";
					}
					?>
				</div>
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
			</div>
		</div>
		<div class="row py-5">
			<div class="swiper-pagination"></div>
		</div>
	</div>
</section>
<section class="final-cta">
	<?php $content->get_color_background_layers( 'final-cta', 'left-top', array( 'final-cta-bg', 'webp' ) ); ?>
	<div class="container">
		<div class="final-cta__content d-flex row justify-content-center">
			<div class="d-none d-lg-flex col-2 align-items-center">
				<?php k1_get_svg_asset( 'leaves-3' ); ?>
			</div>
			<div class="col text-center py-5">
				<h2 class="text-white">Your Healthy Ministry Plan Starts Here</h2>
				<span class="subheadline white-stroke my-5 d-block">Join our team</span>
				<p class="text-white">Our greatest asset is our people. Are you looking to join a courageous team who wants to bring ministry health to the globe? We are looking for
					tenacious, loving, and agile leaders to join the disruption…it’s a healthy one, we promise 😉</p>
				<?php $content->cta_button( array( 'text' => 'Join Our Team' ) ); ?>
			</div>
		</div>
	</div>
</section>