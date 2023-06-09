<?php
/**
 * A Component Class that displays content a few different ways. All methods have an $args bypass and an $echo control where `false` returns the markup and `true` echoes the markup. The $args array also shows expected parameters.
 *
 * @param bool $acf class-wide control to use acf fields or standard WordPress field lookups (e.g. `get_field` vs `get_the_excerpt`). If true, excerpt will be set with `get_field('archive_content',$id)`. Defaults `true`
 *
 * @author KJ Roelke
 * @version 1.0.0
 */

require_once get_template_directory() . '/inc/component-classes/class-content-components.php';
class Content_Sections extends Content_Components {
	/**
	 * Gets the Hero `<section>` with class 'hero'. Optional Background Image or color.
	 *
	 * @param array $args Expects an associative array:
	 * ```
	 * $args = array(
	 * 'has_background_image' => bool,
	 * 'background_image' => ?string the URL for CSS `background-image`,
	 * 'headline' => string,
	 * 'subheadline' => ?string,
	 * 'has_cta' => bool,
	 * 'cta_link' => ?string the url
	 * 'cta_text' => string
	 * );
	 * ```
	 */
	public function hero_section( int $post_id = null, $echo = true, array $args = array() ) {
		if ( empty( $post_id ) ) {
			extract( $args );
		} else {
			$hero = get_field( 'hero', $post_id );
			extract( $hero );
		}
		$headline      = $alternate_headline ?? get_the_title( $post_id );
		$markup_start  = $has_background_image ? "<section id='hero' class='hero w-100 py-5' style='background-image:url({$background_image})'>" : "<section id='hero' class='w-100 py-5' style='background-color:var(--color-primary--dark);'>";
		$markup_start .= "
        <div class='hero__content container d-flex align-items-center'>
            <div class='row my-5'>
                <div class='col py-5'>";
		$markup_inner  = $this->headline(
			$headline,
			false,
			array(
				'headline_element'    => 'h1',
				'headline_class'      => 'hero__content--headline headline mb-5',
				'subheadline_content' => $subheadline,
				'subheadline_class'   => 'hero__content--subheadline subheadline white-stroke',
			)
		);

		if ( $has_cta ) {
			$markup_inner .= $this->cta_button(
				array(
					'text'       => $cta_options['cta_text'],
					'link'       => $cta_options['cta_link'],
					'html_class' => 'hero__content--btn btn__primary--fill mt-5',
				),
				false,
			);
		}
		$markup_end = '</div></div></div></section>';
		$markup     = "{$markup_start}{$markup_inner}{$markup_end}";

		if ( $echo ) {
			echo $markup;
		} else {
			return $markup;
		}
	}


	/**
	 * Generate two-column layout with text and media
	 *
	 * @param array $options {
	 *     The options for the two-column layout
	 *
	 *     @var string $headline        (required) The headline text
	 *     @var string $content         (required) The content text
	 *     @var string $content_wrapper The wrapper element for the content (default: 'p')
	 *     @var string $content_class   The CSS class for the content (default: 'text-content')
	 *     @var string|null $cta_text   The call-to-action button text (optional)
	 *     @var string|null $cta_link   The call-to-action button link (optional)
	 *     @var string $media_type      The type of media ('photo' or 'video') (default: 'photo')
	 *     @var bool $reverse           Whether to reverse the order of columns (default: false)
	 *     @var string|null $image_src  The image source URL (only used for 'photo' media_type) (optional)
	 * }
	 * @param bool  $echo Whether to echo or return the markup (default: true)
	 *
	 * @return string The markup for the two-column layout
	 */
	public function two_col_text_and_media( array $options, bool $echo = true ) {
		$default = array(
			'headline'        => '',
			'content'         => '',
			'content_wrapper' => 'p',
			'content_class'   => 'text-content mb-5',
			'cta_text'        => null,
			'cta_link'        => null,
			'cta_external'    => false,
			'cta_class'       => 'cta__btn btn__primary--fill mt-5 align-self-start',
			'media_type'      => 'photo',
			'reverse'         => false,
			'image_src'       => null,
		);

		$options = array_merge( $default, $options );

		extract( $options );

		$container_start = $reverse ? '<div class="row flex-row-reverse two-col">' : '<div class="row two-col">';
		$div_end         = '</div>';
		$col_start_1     = '<div class="col-lg-6 two-col__media">';
		$col_start_2     = '<div class="col-lg-6 two-col__content">';
		$col_1_content   = '';
		if ( $media_type === 'photo' && $image_src ) {
			$col_1_content = "<figure class='two-col__media--container'><img src={$image_src} /></figure>";
		} elseif ( $media_type === 'video' ) {
			$col_1_content = "<figure class='two-col__media--container'>Video!</figure>";
		}
		$headline_args = array(
			'subheadline_content' => $content,
			'subheadline_element' => $content_wrapper,
			'subheadline_class'   => $content_class,
		);
		$col_2_content = $this->headline( $headline, false, $headline_args );

		if ( ! empty( $cta_text ) ) {
			$btn_options    = array(
				'text'        => $cta_text,
				'link'        => $cta_link,
				'is_external' => $cta_external,
				'html_class'  => $cta_class,
			);
			$col_2_content .= $this->cta_button( $btn_options, false );
		}
		$markup = "
        {$container_start}
            {$col_start_1}{$col_1_content}{$div_end}
            {$col_start_2}{$col_2_content}{$div_end}
        {$div_end}";

		if ( $echo ) {
			echo $markup;
		} else {
			return $markup;
		}
	}

	/**
	 * Vertical Card Layout with an image. $args overrides the `headline` settings
	 *
	 * @param array $args Expects an associative array:
	 * ```php
	 * $headline_args = array(
	 * 'headline_element'        => ?string default "h2",
	 * 'headline_class'          => ?string default "vertical-card__title",
	 * 'subheadline_element'     => ?string default 'p');
	 * 'subheadline_class'       => ?string default 'vertical-card__excerpt');
	 * 'subheadline_content'     => ?string the subheadline content,
	 * ```
	 */
	public function vertical_card( string $image_src, string $headline, string $excerpt, bool $echo = true, array ...$args ) {
		$headline_args = array(
			'headline_class'      => 'vertical-card__title',
			'subheadline_element' => 'p',
			'subheadline_class'   => 'vertical-card__excerpt',
			'subheadline_content' => $excerpt,
		);

		$options = array_merge( $headline_args, ...$args );
		extract( $options );
		$card_image        = "<figure class='vertical-card__image'><img src={$image_src} /></figure>";
		$card_text_content = "<div class='vertical-card__content'>{$this->headline($headline, false,$options)}</div>";
		$markup            = "<div class='vertical-card'>{$card_image}{$card_text_content}</div>";
		if ( $echo ) {
			echo $markup;
		} else {
			return $markup;
		}
	}
}