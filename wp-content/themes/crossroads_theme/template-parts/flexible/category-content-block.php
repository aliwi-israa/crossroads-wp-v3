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

             <?php
              $services = get_sub_field('services');
              if ($services): ?>
                <ul class="fw-500 mb-4 wow fadeInUp services-icon-list" data-wow-delay=".6s">
                  <?php foreach ($services as $service):
                    $service_title = get_the_title($service->ID);
                    $service_desc = get_the_excerpt($service->ID);
                    $service_icon = get_field('service_icon', $service->ID);
                    $service_link = get_permalink($service->ID);
                  ?>
                    <li class="mb-4">
                      <a href="<?php echo esc_url($service_link); ?>">
                        <div class="services-icons">
                          <?php if ($service_icon): ?>
                            <img src="<?php echo esc_url($service_icon['url']); ?>" class="w-100 wow scaleIn" alt="<?php echo esc_attr($service_title); ?>">
                          <?php endif; ?>
                          <strong><?php echo esc_html($service_title); ?></strong>
                        </div><br>
                        <?php echo esc_html($service_desc); ?>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>
        <?php endwhile; ?>
      </div>
    </section>
  <?php endif; ?>
