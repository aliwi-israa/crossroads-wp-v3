<?php
$current_id     = get_the_ID();
$current_url    = trailingslashit($_SERVER['REQUEST_URI']);
$is_service     = is_singular('service');
$current_term   = get_queried_object();
$categories     = get_terms([
  'taxonomy'   => 'service-category',
  'hide_empty' => true,
]);

if (!empty($categories)) :
?>
<div class="col-md d-none d-md-block sidebar">
  <ul class="services-nav flex-column flex-nowrap d-none d-md-block">
    <?php foreach ($categories as $index => $term) :
      $slug       = $term->slug;
      $name       = $term->name;
      $submenu_id = 'submenu' . ($index + 1);

      $child_services = get_posts([
        'post_type'   => 'service',
        'numberposts' => -1,
        'orderby'     => 'menu_order',
        'order'       => 'ASC',
        'tax_query'   => [[
          'taxonomy' => 'service-category',
          'field'    => 'term_id',
          'terms'    => $term->term_id,
        ]],
      ]);

      // Detect if current page is parent term or child service
      $is_term_page        = is_tax('service-category', $term);
      $has_current_service = $is_service && has_term($term->term_id, 'service-category', $current_id);

      // Parent is always marked active on term or child pages
      $parent_class = ($is_term_page || $has_current_service) ? 'active-parent' : '';

      // Expand submenu only if on child page
      $toggle_class = $has_current_service ? 'show' : '';
    ?>
    <li class="nav-item">
      <a class="nav-link parent-category <?php echo $parent_class; ?>"
         href="#<?php echo esc_attr($submenu_id); ?>"
         data-toggle="collapse"
         data-target="#<?php echo esc_attr($submenu_id); ?>"
         aria-expanded="<?php echo $has_current_service ? 'true' : 'false'; ?>">
        <span><?php echo esc_html($name); ?></span>
        <i class="fas fa-chevron-down rotate-icon"></i>
      </a>

      <?php if (!empty($child_services)) : ?>
      <div class="collapse <?php echo $toggle_class; ?>" id="<?php echo esc_attr($submenu_id); ?>">
        <ul class="flex-column nav">
          <?php foreach ($child_services as $service) :
            $link   = get_permalink($service);
            $active = ($is_service && ($service->ID == $current_id || trailingslashit($link) === $current_url)) ? 'active' : '';
          ?>
          <li class="nav-item">
            <a class="nav-link <?php echo esc_attr($active); ?>" href="<?php echo esc_url($link); ?>">
              <i class="fas fa-arrow-right"></i> <?php echo esc_html(get_the_title($service)); ?>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endif; ?>
    </li>
    <?php endforeach; ?>

    <?php
    // Hardcoded top-level services
    $solo_services = [
      'Invisalign'       => '/services/invisalign/',
      'Dental Implants'  => '/services/dental-implants/',
      'Emergency Care'   => '/services/emergency-dentistry/',
    ];
    foreach ($solo_services as $label => $path) :
      $active = (trailingslashit($current_url) === trailingslashit($path)) ? 'active' : '';
    ?>
    <li class="nav-item">
      <a class="nav-link <?php echo esc_attr($active); ?>" href="<?php echo esc_url(home_url($path)); ?>">
        <?php echo esc_html($label); ?>
      </a>
    </li>
    <?php endforeach; ?>
  </ul>

<?php
if (! wp_is_mobile()) {
    get_template_part('partials/contact-form-desktop');
}
?>

<?php get_template_part('partials/office-hours'); ?>

</div>
<?php endif; ?>
