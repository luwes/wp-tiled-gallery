<?php
$add_link = 'none' !== $this->link;

// We do this for accessibility.  Titles without alt's break screen readers.
if ( empty( $item->image_alt ) && ! empty( $item->image_title ) ) {
	$item->image_alt = $item->image_title;
}
?>
<div class="tiled-gallery-item<?php if ( isset( $item->size ) ) echo " tiled-gallery-item-$item->size"; ?>" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
	<?php if ( $add_link ): ?>
	<a href="<?php echo $item->link; ?>" data-srcset="<?php echo wp_get_attachment_image_srcset( $item->image->ID, 'large' ); ?>" itemprop="url" data-fancybox="gallery">
	<?php endif; ?>
		<meta itemprop="width" content="<?php echo esc_attr( $item->image->width ); ?>">
		<meta itemprop="height" content="<?php echo esc_attr( $item->image->height ); ?>">
		<img
			<?php $this->partial( 'carousel-image-args', array( 'item' => $item ) ); ?>
			data-original="<?php echo esc_url( $item->img_src ); ?>"
			data-original-set="<?php echo wp_get_attachment_image_srcset( $item->image->ID, $item->size ); ?>"
			width="<?php echo esc_attr( $item->image->width ); ?>"
			height="<?php echo esc_attr( $item->image->height ); ?>"
			data-original-width="<?php echo esc_attr( $item->image->width ); ?>"
			data-original-height="<?php echo esc_attr( $item->image->height ); ?>"
			itemprop="http://schema.org/image"
			title="<?php echo esc_attr( $item->image_title ); ?>"
			alt="<?php echo esc_attr( $item->image_alt ); ?>"
			style="width: <?php echo esc_attr( $item->image->width ); ?>px; height: <?php echo esc_attr( $item->image->height ); ?>px;">
	<?php if ( $add_link ): ?>
	</a>
	<?php endif; ?>

	<?php if ( trim( $item->image->post_excerpt ) ): ?>
		<div class="tiled-gallery-caption" itemprop="caption description">
			<?php echo wptexturize( $item->image->post_excerpt ); ?>
		</div>
	<?php endif; ?>
</div>
