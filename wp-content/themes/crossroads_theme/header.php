<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<a href="#" id="back-to-top"></a>
<div id="de-loader"></div>

<header class="transparent scroll-light">
  <div class="container p-0">
    <div class="row">
      <div class="col-md-12">
        <div class="de-flex sm-pt10 wrapper">

          <!-- ✅ Logo -->
          <div class="de-flex-col">
            <div id="logo">
              <a href="<?php echo home_url(); ?>">
                <img class="logo-main" src="<?php echo get_template_directory_uri(); ?>/assets/images/crosroads-dental-clinic-logo-white.webp" alt="Logo" width="595" height="170">
                <img class="logo-scroll" src="<?php echo get_template_directory_uri(); ?>/assets/images/crosroads-dental-clinic-logo.webp" alt="Logo Scroll" width="480" height="138">
                <img class="logo-mobile" src="<?php echo get_template_directory_uri(); ?>/assets/images/crosroads-dental-clinic-logo-white.webp" alt="Logo Mobile" width="595" height="170">
              </a>
            </div>
          </div>

          <!-- ✅ Navigation -->
          <div class="de-flex-col header-col-mid">
            <?php
            wp_nav_menu([
              'theme_location' => 'main_menu',
              'menu_id'        => 'mainmenu',
              'container'      => false,
              'walker'         => new Services_Menu_Walker()
            ]);
            $phone = get_field('phone_number', 'option');
            $booking_link = get_field('booking_link', 'option');
            ?>
          </div>

          <!-- ✅ CTA Buttons -->
          <div class="de-flex-col">
            <div class="menu_side_area d-flex gap-3 align-items-center">
              <a href="<?php echo esc_attr($booking_link); ?>" class="btn-main fx-slide">
                <span>Book Appointment</span>
              </a>
              <a href="tel:<?php echo esc_attr($phone); ?>" class="btn-main fx-slide btn-outline-white">
                <span>Call: <?php echo esc_attr($phone); ?></span>
              </a>
              <div class="d-flex d-md-none mobile-cta">
                <a href="<?php echo esc_attr($booking_link); ?>" class="btn-cta-green" aria-label="Book Appointment">
                  <i class="fs-30 id-color fa-solid fas fa-calendar-alt"></i>
                </a>
                <a href="tel:<?php echo esc_attr($phone); ?>" class="btn-cta-blue" aria-label="Call Us">
                  <i class="fs-30 id-color fa-solid fa-phone"></i>
                </a>
              </div>
              <span id="menu-btn"></span>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</header>
