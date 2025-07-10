<?php
return [
  'title'       => __('Why Choose Us (Image + Text)', 'crossroads_theme'),
  'categories'  => ['custom'],
  'keywords'    => ['features', 'image', 'cta'],
  'content'     => '
<!-- wp:group {"className":"section bg-color-op-1","layout":{"type":"constrained"}} -->
<div class="wp-block-group section bg-color-op-1">

  <!-- wp:html -->
  <div class="container">
  <!-- /wp:html -->

    <!-- wp:columns {"className":"flipped-section"} -->
    <div class="wp-block-columns flipped-section">
    
      <!-- wp:column -->
      <div class="wp-block-column">
        <!-- wp:heading {"level":2,"className":"wow fadeInUp"} -->
        <h2 class="wow fadeInUp">Why Choose Us?</h2>
        <!-- /wp:heading -->

        <!-- wp:list {"className":"ul-check text-dark fw-600 wow fadeInUp"} -->
        <ul class="ul-check text-dark fw-600 wow fadeInUp">
          <li class="mb-4"><strong>Comprehensive Services for All Ages</strong><br><span class="fw-normal">From preventive cleanings and cosmetic enhancements to root canals and emergencies, our skilled team is equipped to meet all your oral health needs.</span></li>
          <li class="mb-4"><strong>Extended Hours for Your Convenience</strong><br><span class="fw-normal">We’re open 7 days a week from 9 AM to 9 PM so you can prioritize your dental care—on your schedule.</span></li>
          <li class="mb-4"><strong>Warm, Stress-Free Environment</strong><br><span class="fw-normal">Our clinic is designed to make you feel at ease. We combine modern technology with a friendly, compassionate approach.</span></li>
        </ul>
        <!-- /wp:list -->

        <!-- wp:buttons {"className":"wow fadeInUp"} -->
        <div class="wp-block-buttons wow fadeInUp">
          <!-- wp:button {"className":"btn-main fx-slide"} -->
          <div class="wp-block-button btn-main fx-slide">
            <a class="wp-block-button__link" href="#">Book Appointment</a>
          </div>
          <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
      </div>
      <!-- /wp:column -->

      <!-- wp:column -->
      <div class="wp-block-column">
        <!-- wp:image {"sizeSlug":"large","className":"w-100 wow scaleIn responsive-img"} -->
        <figure class="wp-block-image size-large w-100 wow scaleIn responsive-img">
          <img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/placeholder.webp" alt="Why Choose Crossroads Dental Clinic" />
        </figure>
        <!-- /wp:image -->
      </div>
      <!-- /wp:column -->

    </div>
    <!-- /wp:columns -->

  <!-- wp:html -->
  </div>
  <!-- /wp:html -->

</div>
<!-- /wp:group -->
'
];
