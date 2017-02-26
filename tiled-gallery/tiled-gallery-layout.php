<?php
abstract class Jetpack_Tiled_Gallery_Layout {
	// Template whitelist
	private static $templates = array( 'carousel-container', 'circle-layout', 'rectangular-layout', 'square-layout' );
	private static $partials = array( 'carousel-image-args', 'item' );

	protected $type; // Defined in child classes
	public $attachments;
	public $size;
	public $link;
	public $columns;
	public function __construct( $attachments, $size, $link, $columns ) {

		$this->attachments = $attachments;
		$this->size = $size;
		$this->link = $link;
		$this->needs_attachment_link = ! ( isset( $link ) && $link == 'file' );
		$this->columns = $columns;
	}

	public function HTML( $context = array() ) {
		// Render the carousel container template, which will take the
		// appropriate strategy to fill it
		ob_start();
		$this->template( 'carousel-container', array_merge( $context, array(
			'attachments' => $this->attachments,
			'size' => $this->size,
			'link' => $this->link,
			'needs_attachment_link' => $this->needs_attachment_link
		) ) );
		$html = ob_get_clean();

		return $html;
	}

	private function template( $name, $context = null ) {
		if ( ! in_array( $name, self::$templates ) ) {
			return;
		}

		if ( isset( $context ) ) {
			extract( $context );
		}

		/**
		 * Filters the Tiled Gallery template path
		 *
		 * @module tiled-gallery
		 * @since 4.4.0
		 *
		 * @param string $path Template path.
		 * @param string $path Template name.
		 * @param array $context Context array passed to the template.
		 */
		require apply_filters( 'jetpack_tiled_gallery_template', dirname( __FILE__ ) . "/templates/$name.php", $name, $context ) ;
	}

	private function partial( $name, $context = null ) {
		if ( ! in_array( $name, self::$partials ) ) {
			return;
		}

		if ( isset( $context ) ) {
			extract( $context );
		}

		/**
		 * Filters the Tiled Gallery partial path
		 *
		 * @module tiled-gallery
		 * @since 4.4.0
		 *
		 * @param string $path Partial path.
		 * @param string $path Partial name.
		 * @param array $context Context array passed to the partial.
		 */
		require apply_filters( 'jetpack_tiled_gallery_partial', dirname( __FILE__ ) . "/templates/partials/$name.php", $name, $context ) ;
	}
}

