<?php
/**
 * Title: Welcome Section (Image + Text)
 * Slug: crossroads_theme/welcome-section
 * Categories: custom, layout
 * Keywords: welcome, image, text, cta
 * Inserter: true
 */

return [
  'title'      => __('Welcome Section (Image + Text)', 'crossroads_theme'),
  'categories' => ['custom'],
  'keywords'   => ['welcome', 'image', 'cta'],
  'content'    => '
<!-- wp:group {"className":"section","layout":{"type":"constrained"}} -->
<div class="wp-block-group section">
  <!-- wp:html -->
  <div class="container">
  <!-- /wp:html -->

    <!-- wp:columns {"className":"align-items-center"} -->
    <div class="wp-block-columns align-items-center">

      <!-- wp:column -->
      <div class="wp-block-column">
        <!-- wp:image {"sizeSlug":"large","className":"w-100 wow scaleIn responsive-img"} -->
        <figure class="wp-block-image size-large w-100 wow scaleIn responsive-img">
          <img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/placeholder.webp" alt="Healthy Smiles Start Here" />
        </figure>
        <!-- /wp:image -->
      </div>
      <!-- /wp:column -->

      <!-- wp:column -->
      <div class="wp-block-column">
        <!-- wp:paragraph {"className":"subtitle s2 mb-3 wow fadeInUp"} -->
        <p class="subtitle s2 mb-3 wow fadeInUp">Healthy Smiles Start Here</p>
        <!-- /wp:paragraph -->

        <!-- wp:heading {"level":2,"className":"wow fadeInUp"} -->
        <h2 class="wow fadeInUp">Welcome to Crossroads Dental Clinic</h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"className":"wow fadeInUp"} -->
        <p class="wow fadeInUp">Your trusted dental care partner in the heart of Toronto, located at the crossroads of Dundas Street West and Bloor Street West. At Crossroads Dental, we believe every smile tells a story and we’re here to help yours shine. Proudly serving the vibrant Toronto community, we offer complete dental care for all ages in a modern, welcoming environment focused on comfort, technology, and results.</p>
        <!-- /wp:paragraph -->

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

    </div>
    <!-- /wp:columns -->

  <!-- wp:html -->
  </div>
  <!-- /wp:html -->
</div>
<!-- /wp:group -->
'
];
