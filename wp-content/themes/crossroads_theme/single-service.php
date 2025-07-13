<?php get_header(); ?>
<div id="wrapper">
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <div class="entry-content">
            <?php get_template_part('partials/hero-archive'); ?>
            <section class="pb-0">
                <div class="container mb-4">
                    <div class="row">
                        <?php get_template_part('partials/sidebar-services'); ?>
                        <div class="col-md-9 main-content">
                            <section class="pt-0 pb-0" style="background-size: cover; background-repeat: no-repeat;">
                                <?php
                                if (have_posts()) :
                                    while (have_posts()) : the_post();
                                        $service_videos_section_title = get_field('service_videos_title'); 
                                        $service_videos_rows = get_field('service_videos');
                                        $display_video_section_title = $service_videos_section_title ? esc_html($service_videos_section_title) : 'Educational Videos';

                                        // Get the parent category
                                        $categories = get_the_terms(get_the_ID(), 'service-category');
                                        $parent_category = null;

                                        // Find the parent category (if any)
                                        if ($categories) {
                                            foreach ($categories as $category) {
                                                if ($category->parent == 0) {  // If it's a top-level category
                                                    $parent_category = $category;
                                                    break;
                                                }
                                            }
                                        }
                                        // Display the link to the parent category if it exists
                                        if ($parent_category) :
                                            ?>
                                            <div class="title-wrap">
                                                <div class="subtitle id-color wow fadeInUp" data-wow-delay=".2s">
                                                    <a href="<?php echo esc_url(get_term_link($parent_category)); ?>" class="text-blue">
                                                        <i class="fa-solid fa-arrow-left-long"></i> <?php echo esc_html($parent_category->name); ?>
                                                    </a>
                                                </div>
                                            </div>

                                        <?php endif; ?>
                                        <div><?php the_content(); ?></div>
                                    <?php endwhile;
                                else :
                                    echo 'Service not found.';
                                endif;
                                ?>
                                <?php
                                if ($service_videos_rows && is_array($service_videos_rows) && count($service_videos_rows) > 0):
                                    $video_count = count($service_videos_rows);
                                    ?>
                                    <?php if ($video_count === 1): // Layout for a single video ?>
                                        <?php
                                        // Get the single video's data
                                        $first_video = $service_videos_rows[0];
                                        // Correct: video_embed is a sub-field of the repeater row,
                                        // so you access it directly from the $first_video array.
                                        $video_popover_embed = $first_video['video_embed'];
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
                                              <div class="video-container">
                                                  <?php foreach ($service_videos_rows as $video_row): ?>
                                                      <?php
                                                      // Correct: video_embed is a sub-field of the repeater row,
                                                      // so you access it directly from the $video_row array.
                                                      $video_popover_embed = $video_row['video_embed'];
                                                      ?>
                                                      <?php if ($video_popover_embed): // Only render if embed code exists ?>
                                                          <div class="video">
                                                              <?php // No individual video title here ?>
                                                              <?php echo $video_popover_embed; // Output the full Wistia popover HTML ?>
                                                          </div>
                                                      <?php endif; ?>
                                                  <?php endforeach; ?>
                                              </div>
                                          </div>
                                      <?php endif; ?>
                                <?php endif; ?>
                            </section>
                            <?php
                            $faq_posts = get_field('services_faqs'); // Returns array of post objects (FAQ posts)
                            if (!empty($faq_posts)) :
                            ?>
                            <section class="bg-light faq-list" style="background-size: cover; background-repeat: no-repeat;">
                            <div class="container" style="background-size: cover; background-repeat: no-repeat;">
                                <div class="row g-4" style="background-size: cover; background-repeat: no-repeat;">
                                <div class="col-lg-5" style="background-size: cover; background-repeat: no-repeat;">
                                    <div class="subtitle id-color wow fadeInUp animated" data-wow-delay=".0s" style="background-size: cover; background-repeat: no-repeat; visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">
                                    Everything You Need to Know
                                    </div>
                                    <h2 class="wow fadeInUp animated" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                    Frequently Asked Questions
                                    </h2>
                                </div>
                                <div class="col-lg-7" style="background-size: cover; background-repeat: no-repeat;">
                                    <div class="accordion s2 wow fadeInUp animated" style="background-size: cover; background-repeat: no-repeat; visibility: visible; animation-name: fadeInUp;">
                                    <div class="accordion-section" style="background-size: cover; background-repeat: no-repeat;">
                                        <?php
                                        $i = 1;
                                        foreach ($faq_posts as $faq) :
                                        $faq_id = $faq->ID;
                                        $faq_question = get_the_title($faq_id);
                                        $faq_answer = get_the_content(null, false, $faq_id);
                                        $accordion_id = 'accordion-f' . $i;
                                        ?>
                                        <div class="accordion-section-title" data-tab="#<?php echo esc_attr($accordion_id); ?>" style="background-size: cover; background-repeat: no-repeat;">
                                            <?php echo $i . '. ' . esc_html($faq_question); ?>
                                        </div>
                                        <div class="accordion-section-content" id="<?php echo esc_attr($accordion_id); ?>" style="background-size: cover; background-repeat: no-repeat;">
                                            <?php echo wp_kses_post($faq_answer); ?>
                                        </div>
                                        <?php
                                        $i++;
                                        endforeach;
                                        ?>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </section>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            if (wp_is_mobile()) {
                get_template_part('partials/contact-form-mobile');
            }
            get_template_part('partials/banner-section');
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>