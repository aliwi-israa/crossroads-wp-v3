<?php 
$page_link = get_sub_field('page_link');
?>

<section id="section-intro" class="text-light no-top no-bottom relative overflow-hidden">
  <div class="relative">
    <div class="swiper" id="homeSwiper">
      <div class="swiper-wrapper">
        <?php if (have_rows('slides')) : while (have_rows('slides')) : the_row();
          $img = get_sub_field('image');
          $heading = get_sub_field('heading');
          $subheading = get_sub_field('sub_heading');
        ?>
          <?php if ($img) : ?>
            <div class="swiper-slide">
              <div class="swiper-inner" style="background-image: url('<?php echo esc_url($img['url']); ?>');">
                <div class="sw-overlay op-5"></div>
                <div class="gradient-edge-left z-2"></div>
                <div class="abs abs-centered w-100 z-2">
                  <div class="container">
                    <div class="row g-4 align-items-center justify-content-between">
                      <div class="col-lg-6">
                        <div class="spacer-single sm-hide"></div>
                        <?php if ($subheading) : ?>
                          <div class="subtitle intro"><?php echo esc_html($subheading); ?></div>
                        <?php endif; ?>
                        <?php if ($heading) : ?>
                          <h1><?php echo esc_html($heading); ?></h1>
                        <?php endif; ?>
                        <?php if ($page_link) : ?>
                          <a class="btn-main fx-slide menu_side_area m-0" 
                            href="<?php echo esc_url($page_link['url']); ?>" 
                            <?php echo $page_link['target'] ? 'target="' . esc_attr($page_link['target']) . '" rel="noopener"' : ''; ?>>
                            <span><?php echo esc_html($page_link['title']); ?></span>
                          </a>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
        <?php endwhile; endif; ?>
      </div>
    </div>
  </div>
</section>
