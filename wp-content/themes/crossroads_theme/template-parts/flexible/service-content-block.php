<?php
// Retrieve ACF fields for the current service.
$title          = get_sub_field('title');
$info_paragraph = get_sub_field('info_paragraph');
$image          = get_sub_field('image');
$button_label   = get_sub_field('button_label');
$button_link    = get_sub_field('button_link');
$service_body   = get_sub_field('service_body');

// Get the top-level repeater field for service videos
$service_videos_rows = get_sub_field('service_videos'); // Get all rows as an array

// Get the video section title. If not set, use a default.
$service_videos_section_title = get_sub_field('service_videos_title');
$display_video_section_title = $service_videos_section_title ? esc_html($service_videos_section_title) : 'Educational Videos'; // Default title if field is empty

// Get parent category (service-category) link
$parent_link = '';
$parent_name = '';

$terms = get_the_terms(get_the_ID(), 'service-category');
if ($terms && !is_wp_error($terms)) {
    $parent_term = $terms[0];
    $parent_link = home_url('/services/' . $parent_term->slug . '/');
    $parent_name = $parent_term->name;
}
?>

<div class="col-md-9 main-content">
  <section class="pt-0 pb-0" style="background-size: cover; background-repeat: no-repeat;">

    <div class="title-wrap">
        
        <?php if ($parent_link && $parent_name): ?>
            <div class="subtitle id-color wow fadeInUp" data-wow-delay=".2s">
                <a href="<?php echo esc_url($parent_link); ?>" class="text-blue">
                    <i class="fa-solid fa-arrow-left-long"></i> <?php echo esc_html($parent_name); ?>
                </a>
            </div>
        <?php endif; ?>

        <?php if ($title): ?>
            <h2 class="id-color service-header"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>

        <?php if ($info_paragraph): ?>
            <p><?php echo wp_kses_post($info_paragraph); ?></p>
        <?php endif; ?>
    </div>

    <?php if ($image): ?>
        <div class="service-img mb-4">
            <picture style="width: 100%; height: 100%; object-fit: cover; display: block;">
                <source srcset="<?php echo esc_url($image['sizes']['medium']); ?>" media="(max-width: 600px)">
                <source srcset="<?php echo esc_url($image['sizes']['large']); ?>" media="(max-width: 992px)">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" loading="lazy" class="img-fluid">
            </picture>
        </div>
    <?php endif; ?>

    <?php if (have_rows('service_body')): ?>
        <section class="pt-0 pb-0">
            <div class="service-items">
                <?php while (have_rows('service_body')): the_row(); ?>
                    <?php
                    $section_title       = get_sub_field('title');
                    $section_description = get_sub_field('desc');
                    $section_video_embed = get_sub_field('video_embed'); // Video field within this content block
                    ?>
                    
                    <?php if ($section_title): ?>
                        <h3 class="wow fadeInUp" data-wow-delay=".2s"><?php echo esc_html($section_title); ?></h3>
                    <?php endif; ?>

                    <?php if ($section_description): ?>
                        <div class="wow fadeInUp" data-wow-delay=".2s">
                            <?php echo wp_kses_post($section_description); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($section_video_embed): ?>
                        <div class="educational-video single mb-4 wow fadeInUp" data-wow-delay=".2s">
                            <?php echo $section_video_embed; ?>
                        </div>
                    <?php endif; ?>

                <?php endwhile; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php
    // Conditional rendering for the service videos section
    if ($service_videos_rows && is_array($service_videos_rows) && count($service_videos_rows) > 0):
        $video_count = count($service_videos_rows);
    ?>
      <?php if ($video_count === 1): // Layout for a single video ?>
          <?php
          // Get the single video's data
          $first_video = $service_videos_rows[0];
          $video_popover_embed = $first_video['video_embed']; // Corrected sub-field name
          ?>
          <div class="educational-video single mb-4">
              <h3><?php echo $display_video_section_title; ?></h3>
              <?php if ($video_popover_embed): ?>
                  <?php echo $video_popover_embed; // Output the full Wistia popover HTML ?>
              <?php endif; ?>
          </div>
      <?php else: // Layout for multiple videos ?>
          <div class="educational-video single mb-4">
              <h3><?php echo $display_video_section_title; ?></h3>
                  <?php foreach ($service_videos_rows as $video_row): ?>
                      <?php
                      $video_popover_embed = $video_row['video_embed']; // Corrected sub-field name
                      ?>
                      <?php if ($video_popover_embed): // Only render if embed code exists ?>
                          <div class="video">
                              <?php // No individual video title here ?>
                              <?php echo $video_popover_embed; // Output the full Wistia popover HTML ?>
                          </div>
                      <?php endif; ?>
                  <?php endforeach; ?>
          </div>
      <?php endif; ?>
    <?php endif; ?>

    <?php if ($button_label && $button_link): ?>
        <a class="btn-main fx-slide wow fadeInUp" data-wow-delay=".8s" href="<?php echo esc_url($button_link); ?>">
            <span><?php echo esc_html($button_label); ?></span>
        </a>
    <?php endif; ?>

    <?php
    $service_id = get_the_ID();
    $faqs = new WP_Query([
        'post_type'      => 'faq',
        'posts_per_page' => 5,
        'meta_query'     => [[
            'key'     => 'service',
            'value'   => $service_id,
            'compare' => '='
        ]]
    ]);?>
</section>
    <?php if ($faqs->have_posts()) : ?>
        <section class="bg-light faq-list" style="background-size: cover; background-repeat: no-repeat;">
            <div class="container" style="background-size: cover; background-repeat: no-repeat;">
                <div class="row g-4" style="background-size: cover; background-repeat: no-repeat;">
                    <div class="col-lg-5" style="background-size: cover; background-repeat: no-repeat;">
                        <div class="subtitle id-color wow fadeInUp animated" data-wow-delay=".0s">
                            Everything You Need to Know
                        </div>
                        <h2 class="wow fadeInUp animated" data-wow-delay=".2s">Frequently Asked Questions</h2>
                    </div>

                    <div class="col-lg-7" style="background-size: cover; background-repeat: no-repeat;">
                        <div class="accordion s2 wow fadeInUp animated">
                            <div class="accordion-section">
                                <?php $i = 1; while ($faqs->have_posts()) : $faqs->the_post(); 
                                    $accordion_id = 'accordion-' . $service_id . '-' . $i;
                                ?>
                                    <div class="accordion-section-title" data-tab="#<?php echo esc_attr($accordion_id); ?>">
                                        <?php the_title(); ?>
                                    </div>
                                    <div class="accordion-section-content" id="<?php echo esc_attr($accordion_id); ?>">
                                        <?php the_content(); ?>
                                    </div>
                                <?php $i++; endwhile; wp_reset_postdata(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

</div>
                                        <script charset="ISO-8859-1"
                                            src="//fast.wistia.com/assets/external/popover-v1.js"></script>
