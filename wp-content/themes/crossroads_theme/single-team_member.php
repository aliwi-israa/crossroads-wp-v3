<?php get_header(); ?>

<?php
// ACF fields
$display_name = get_the_title();
$job_title    = get_field('job_title');
$bio          = get_field('bio');
$image_field = get_field('image');
$image_url = '';
$image_direction = get_field('image_direction') ?: 'isImgRight';
if (is_array($image_field) && isset($image_field['url'])) {
    $image_url = $image_field['url'];
} elseif (is_numeric($image_field)) {
    $image_url = wp_get_attachment_image_url($image_field, 'large');
} else {
    $image_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
}
// Clinic Settings (from ACF Options Page)
$clinic_name  = get_field('ClinicName', 'option');
$booking_link = get_field('ClinicBookingLink', 'option');
$phone        = get_field('ClinicPhoneNumber', 'option');
?>

<div id="wrapper">
  <div class="no-bottom no-top" id="content">
    <div id="top"></div>
    <div class="entry-content">
        <?php get_template_part('partials/hero-archive'); ?>
        <?php get_template_part('partials/breadcrumbs'); ?>
        <section>
          <div class="container mt-6">
            <div class="row  <?php echo ($image_direction === 'isImgRight') ? 'content-block-right' : 'content-block-left'; ?>">
              <div class="col-md">
                <div class="rounded-1 overflow-hidden wow zoomIn image-container animated" style="background-size: cover; background-repeat: no-repeat; visibility: visible; animation-name: zoomIn;">
                  <?php if ($image_url): ?>
                    <img src="<?php echo esc_url($image_url); ?>" class="img-fluid" alt="<?php echo esc_attr($display_name); ?>">
                  <?php endif; ?>
                </div>

                <div class="mt-4 text-center">
                  <?php if ($booking_link): ?>
                    <a class="btn-main fx-slide wow fadeInUp" data-wow-delay=".8s" href="<?php echo esc_url($booking_link); ?>">
                      <span>Book Appointment</span>
                    </a>
                  <?php endif; ?>
                  <?php if ($phone): ?>
                    <p class="wow fadeInUp mb-4" data-wow-delay=".5s">
                      or call <a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a>
                    </p>
                  <?php endif; ?>
                </div>
              </div>

              <div class="col-lg-8 mt-4 mt-lg-0">
                <div class="doctor-info mb-3 mb-lg-4">
                  <div class="doctor-info-name">
                    <h3><?php echo esc_html($display_name); ?></h3>
                    <?php if ($job_title): ?>
                      <div class="subtitle s2 mb-3 wow fadeInUp animated" data-wow-delay=".0s">
                        <h6><?php echo esc_html($job_title); ?></h6>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>

                <?php if ($bio): ?>
                  <div class="team-bio">
                    <?php echo wp_kses_post($bio); ?>
                  </div>
                <?php else: ?>
                  <?php the_content(); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </section>
    </div>
  </div>
</div>

<?php get_footer(); ?>