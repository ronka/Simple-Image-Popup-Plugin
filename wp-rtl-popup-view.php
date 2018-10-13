<?php

$image_url = get_theme_mod('wp-rtl-popup--image', false);

// if no image uploaded, dont load view
if($image_url === false){
    return;
}

// get attachment id by url
$image_id = attachment_url_to_postid($image_url);

// get attachment alt field if id found
if($image_id !== 0){
    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
}

$link_url = get_theme_mod('wp-rtl-popup--url', false);

?>

<div id="wprtl-popup" class="wprtl-popup__wrapper" aria-hidden="true" role="dialog">
    <div class="wprtl-popup__inner">
        <?php if( $link_url ): ?> <a href="<?php echo esc_url( $link_url ); ?>"> <?php endif; ?>
        
        <img class="wprtl-popup__image" src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">

        <?php if( $link_url ): ?> </a> <?php endif; ?>

        <button id="wprtl-popup__close" type="button" aria-label="<?php _e('Close popup', 'wp-rtl-popup'); ?>">&times;</button>
    </div><!-- .popup__inner -->
</div><!-- #popup_window -->