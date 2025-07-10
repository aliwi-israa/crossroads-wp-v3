<?php
// Step 1: Get the queried object
$real_object = get_queried_object();

if (is_singular('service')) {
    // For single service posts, walk up to the top-level parent
    $top_level_post = $real_object;
    while ($top_level_post->post_parent != 0) {
        $top_level_post = get_post($top_level_post->post_parent);
    }
    $top_level_id = $top_level_post->ID;

} elseif (is_tax('service-category')) {
    // For taxonomy term archives, use the term ID to get ACF fields
    $top_level_id = $real_object->term_id;
    $is_term = true;

} else {
    // Fallback for other contexts
    $top_level_id = get_the_ID();
}

// Step 2: Pull ACF fields
if (!empty($is_term)) {
    // For taxonomy term, use term-specific ACF functions
    $show_banner = get_field('show_banner', 'service-category_' . $top_level_id);
    $title       = get_field('title', 'service-category_' . $top_level_id);
    $body        = get_field('body', 'service-category_' . $top_level_id);
    $booking     = get_field('ClinicBookingLink', 'service-category_' . $top_level_id) ?: get_theme_mod('booking_link', '#');
    $phone       = get_field('ClinicPhoneNumber', 'service-category_' . $top_level_id) ?: get_theme_mod('clinic_phone', '+1 234-5678');
} else {
    // For posts
    $show_banner = get_field('show_banner', $top_level_id);
    $title       = get_field('title', $top_level_id);
    $body        = get_field('body', $top_level_id);
    $booking     = get_field('ClinicBookingLink', $top_level_id) ?: get_theme_mod('booking_link', '#');
    $phone       = get_field('ClinicPhoneNumber', $top_level_id) ?: get_theme_mod('clinic_phone', '+1 234-5678');
}

// Exit early if banner is not enabled
if (!$show_banner) {
    echo '<!-- Banner not enabled -->';
    return;
}
?>

<section class="text-dark no-bottom overflow-hidden ad-section">
  <div class="col-lg-12">
    <div class="me-lg-3">
      <div class="my-5 me-lg-3 content">

        <?php if ($title): ?>
          <h2 class="wow fadeInUp animated text-center" data-wow-delay=".2s">
            <?php echo esc_html($title); ?>
          </h2>
        <?php endif; ?>

        <div class="banner-center-caption text-center">
          
          <?php if ($body): ?>
            <div class="banner-center-text2 mb-4 line-height">
              <?php echo wp_kses_post($body); ?>
            </div>
          <?php endif; ?>

          <div class="buttons">
            <?php if ($booking): ?>
              <a href="<?php echo esc_url($booking); ?>" class="btn-main fx-slide" data-hover="Book Appointment">
                <span>Book Appointment</span>
              </a>
            <?php endif; ?>

            <?php if ($phone): ?>
              <a href="tel:<?php echo esc_attr($phone); ?>" class="btn-main fx-slide btn-outline-white">
                <span>Call: <?php echo esc_html($phone); ?></span>
              </a>
            <?php endif; ?>
          </div>

        </div>

      </div>
    </div>
  </div>
</section>
