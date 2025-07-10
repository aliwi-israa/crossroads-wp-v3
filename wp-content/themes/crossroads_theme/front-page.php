<?php get_header(); ?>
<?php $home_id = get_option('page_on_front'); ?>

<style>
  .slider-contact .text h2 {
    font-size: 20px;
  }

  .swiper-inner {
    aspect-ratio: 16 / 9;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
  }
  .img-container {
    aspect-ratio: 4 / 3;
    overflow: hidden;
  }
  .img-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }
  .swiper {
    width: 100%;
    height: 100vh;
    max-height: 900px;
    min-height: 800px;
    position: relative;
    overflow: hidden;
  }
  .swiper-wrapper {
    display: flex;
    transition-property: transform;
    box-sizing: content-box;
  }
  .swiper-slide {
    flex-shrink: 0;
    width: 100%;
    height: 100%;
    position: relative;
  }
  @media (max-width: 1024px) {
    .swiper { height: 800px; }
  }
  @media (max-width: 768px) {
    .swiper { height: 800px; }
  }
  @media (max-width: 480px) {
    .swiper { height: 40vh; }
  }
</style>

<div id="wrapper">
  <div class="no-bottom no-top" id="content">
    <div id="top"></div>
    <?php if (have_rows('flexible_content_home')): ?>
      <?php while (have_rows('flexible_content_home')): the_row(); ?>

        <?php if (get_row_layout() === 'hp_hero'): ?>
          <?php get_template_part('template-parts/flexible/homepage/hero'); ?>
        <?php endif; ?>

      <?php endwhile; ?>
    <?php endif; ?>

    <?php if (have_rows('flexible_content_home')): ?>
      <?php while (have_rows('flexible_content_home')): the_row(); ?>

        <?php if (get_row_layout() === 'hp_info_block'): ?>
          <?php get_template_part('template-parts/flexible/homepage/info-block'); ?>
        <?php endif; ?>

      <?php endwhile; ?>
    <?php endif; ?>
    <?php if (have_rows('flexible_content_home')): ?>
      <?php while (have_rows('flexible_content_home')): the_row(); ?>

        <?php if (get_row_layout() === 'content_block'): ?>
          <?php get_template_part('template-parts/flexible/homepage/content-block'); ?>
        <?php endif; ?>

        <?php if (get_row_layout() === 'services_block'): ?>
          <?php get_template_part('template-parts/flexible/homepage/services-block'); ?>
        <?php endif; ?>
        <?php if (get_row_layout() === 'team_block'): ?>
          <?php get_template_part('template-parts/flexible/homepage/team-block'); ?>
        <?php endif; ?>
        <?php if (get_row_layout() === 'faqs'): ?>
          <?php get_template_part('template-parts/flexible/homepage/faqs'); ?>
        <?php endif; ?>  
        <?php if (get_row_layout() === 'cta_banner'): ?>
          <?php get_template_part('template-parts/flexible/homepage/cta-banner'); ?>
        <?php endif; ?>

      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    new Swiper('#homeSwiper', {
      loop: false,
      autoplay: { delay: 3000 },
      slidesPerView: 1,
      effect: 'slide',
      pagination: { el: '.swiper-pagination', clickable: true }
    });
  });
</script>

<?php get_footer(); ?>