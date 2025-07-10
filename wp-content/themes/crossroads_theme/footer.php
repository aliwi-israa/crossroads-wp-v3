<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package crossroads_theme
 */

?>

<footer class="section-dark">
  <div class="container">
    <div class="row gx-5 align-items-start">
      <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
		<?php
		$footer_logo = get_field('footer_logo', 'option');
		if ($footer_logo):
		?>
		<img src="<?php echo esc_url($footer_logo['url']); ?>" class="logo-footer" alt="<?php echo esc_attr($footer_logo['alt']); ?>">
		<?php endif; ?>

        <div class="spacer-20"></div>
		<p><?php the_field('footer_paragraph', 'option'); ?></p>

		<?php
    $social_fields = [
      'facebook'  => 'fa-brands fa-facebook',
      'x'         => 'fa-solid fa-x fa-brands',
      'instagram' => 'fa-brands fa-instagram',
      'youtube'   => 'fa-brands fa-youtube',
      'watsapp'   => 'fa-brands fa-whatsapp'
    ];
    ?>

    <div class="social-icons mb-sm-30">
      <?php foreach ($social_fields as $field => $icon_class):
        $url = get_field($field, 'option');
        if ($url): ?>
          <a href="<?php echo esc_url($url); ?>" target="_blank" aria-label="<?php echo ucfirst($field); ?>">
            <i class="<?php echo esc_attr($icon_class); ?>"></i>
          </a>
      <?php endif; endforeach; ?>
    </div>

      </div>
      <div class="col-lg-4 col-md-8">
        <div class="widget">
          <?php
          wp_nav_menu([
            'theme_location' => 'footer_menu',
            'menu_class'     => 'footer-nav list-unstyled',
            'container'      => false
          ]);
          ?>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-12 mt-4 mt-md-0">
        <div class="widget text-md-start text-center">
          <h5>Contact Us</h5>
          <?php $map = get_field('map_link', 'option'); ?>
          <?php $address = get_field('address', 'option'); ?>
          <?php if ($map && $address): ?>
            <a href="<?php echo esc_url($map); ?>" target="_blank" class="text-white text-decoration-none d-block fw-bold">
              <i class="fa-solid fa-location-dot me-2 id-color fs-14"></i> Clinic Location
              <div class="fw-normal text-white ms-4"><?php echo esc_html($address); ?></div>
            </a>
            <div class="spacer-20"></div>
          <?php endif; ?>
          <?php $phone = get_field('phone_number', 'option'); ?>
          <?php if ($phone): ?>
            <a href="tel:<?php echo esc_attr($phone); ?>" class="text-white text-decoration-none d-block fw-bold">
              <i class="fa-solid fa-phone me-2 id-color fs-14"></i> Call Us
              <div class="fw-normal text-white ms-4"><?php echo esc_html($phone); ?></div>
            </a>
            <div class="spacer-20"></div>
          <?php endif; ?>
          <?php $email = get_field('email', 'option'); ?>
          <?php if ($email): ?>
            <a href="mailto:<?php echo esc_attr($email); ?>" class="text-white text-decoration-none d-block fw-bold">
              <i class="fa fa-envelope me-2 id-color fs-14"></i> Send a Message
              <div class="fw-normal text-white ms-4"><?php echo esc_html($email); ?></div>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <div class="subfooter">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="de-flex">
            <div class="de-flex-col">
				<?php
				$name = get_field('name', 'option');
				echo 'Copyright ' . date('Y') . ' - ' . esc_html($name);
				?>
            </div>
            <ul class="menu-simple">
              <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('terms-and-conditions'))); ?>">Terms &amp; Conditions</a></li>
              <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('privacy-policy'))); ?>">Privacy Policy</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>


<?php wp_footer(); ?>

</body>
</html>
