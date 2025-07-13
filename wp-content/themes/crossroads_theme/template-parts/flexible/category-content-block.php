  <div class="title-wrap">
    <div class="subtitle id-color wow fadeInUp" data-wow-delay=".2s">
      <a href="<?php echo home_url('/services'); ?>" class="text-blue">
        <i class="fa-solid fa-arrow-left-long"></i> Services
      </a>
    </div>
    <?php if ($title): ?>
    <h2 class="id-color service-header"><?php echo esc_html($title); ?></h2>
    <?php endif; ?>
    <?php if ($intro): ?>
    <p><?php echo esc_html($intro); ?></p>
    <?php endif; ?>
  </div>

  <?php if ($video_title && $video_url): ?>
  <div class="educational-video single mb-4">
    <h3><?php echo esc_html($video_title); ?></h3>
    <div class="video-container">
      <div class="video">
        <?php echo $video_url; ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <?php if (have_rows('category_body')): ?>
  <section class="pt-0 pb-0">
    <div class="service-items">
      <?php while (have_rows('category_body')) : the_row();
          $section_title = get_sub_field('title');
          $section_desc  = get_sub_field('desc');
        ?>
      <?php if ($section_title): ?>
      <h3 class="wow fadeInUp" data-wow-delay=".2s"><?php echo esc_html($section_title); ?></h3>
      <?php endif; ?>
      <?php if ($section_desc): ?>
      <p><?php echo wp_kses_post($section_desc); ?></p>
      <?php endif; ?>
      <?php endwhile; ?>
      <?php $services_query_args=array('post_type'=> 'service', 'posts_per_page'=> -1, 'tax_query'=> array(array('taxonomy'=> 'service-category', 'field'=> 'term_id', 'terms'=> $term->term_id, 'include_children'=> true, ), ), 'orderby'=> 'title', 'order'=> 'ASC', 'post_status'=> 'publish', );
      $services=new WP_Query($services_query_args);
      if ($services->have_posts()) : ?><ul class="fw-500 mb-4 wow fadeInUp services-icon-list" data-wow-delay=".6s">

        <?php while ($services->have_posts()) : $services->the_post();
        $service_title=get_the_title();
        $service_desc=get_the_excerpt();
        $service_icon=get_field('service_icon');
        $service_link=get_permalink();
        $icon_url='';

        if (is_array($service_icon) && isset($service_icon['url'])) {
          $icon_url=$service_icon['url'];
        }

        elseif (is_string($service_icon)) {
          $icon_url=$service_icon;
        }
        ?>

        <li class="mb-4">
          <a href="<?php echo esc_url($service_link); ?>">
            <div class="services-icons">
              <?php if ($icon_url): ?>
                  <img src="<?php echo esc_url($icon_url); ?>"
                class="w-100 wow scaleIn" alt="<?php echo esc_attr($service_title); ?>">
                <?php else: ?>
                  <img
                  src="https://placehold.co/60x60/cccccc/333333?text=No+Icon" alt="No Icon"><?php endif;
                  ?>
                  <strong><?php echo esc_html($service_title);?></strong>
                  </div><br><?php echo esc_html($service_desc);
                  ?>
            </a></li><?php endwhile;
            ?>
            </ul>
          <?php endif;
        wp_reset_postdata();
        ?>
    </div>
  </section>
  <?php endif; ?>