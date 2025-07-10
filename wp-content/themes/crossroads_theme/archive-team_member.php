<?php get_header(); ?>

<div id="wrapper">
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <?php get_template_part('partials/hero-archive'); ?>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3 text-center">
                        <p class="wow fadeInUp">  
                          <?php echo esc_html(get_field('team_members_desc', 'option'));?>
                        </p>
                        <div class="spacer-single"></div>
                    </div>
                </div>

                <div class="row g-4">
                    <?php if (have_posts()): while (have_posts()): the_post();

                        // ACF Fields
                        $display_name = get_field('name') ?: get_the_title();
                        $job_title    = get_field('job_title');
                        $image_field  = get_field('image');
                        $profile_url  = get_permalink();

                        // Handle image URL based on ACF return format
                        if (is_array($image_field) && isset($image_field['url'])) {
                            $image_url = $image_field['url'];
                        } elseif (is_numeric($image_field)) {
                            $image_url = wp_get_attachment_image_url($image_field, 'large');
                        } else {
                            $image_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                        }

                        ?>
                        <div class="col-lg-3 col-md-6">
                            <a href="<?php echo esc_url($profile_url); ?>">
                                <div class="relative rounded-1 overflow-hidden">
                                    <div class="rounded-1 overflow-hidden wow fadeIn zoomIn">
                                        <?php if ($image_url): ?>
                                            <picture>
                                                <source srcset="<?php echo esc_url($image_url); ?>" media="(max-width: 600px)">
                                                <source srcset="<?php echo esc_url($image_url); ?>" media="(max-width: 992px)">
                                                <img src="<?php echo esc_url($image_url); ?>" class="w-100 wow scaleIn" loading="lazy" alt="<?php echo esc_attr($display_name); ?>">
                                            </picture>
                                        <?php endif; ?>
                                    </div>

                                    <div class="abs w-100 start-0 bottom-0 z-3">
                                        <div class="p-2 rounded-10 m-3 text-center bg-white wow fadeInDown">
                                            <h4 class="mb-0"><?php echo esc_html($display_name); ?></h4>
                                            <?php if ($job_title): ?>
                                                <p class="mb-2"><?php echo esc_html($job_title); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; else: ?>
                        <p>No team members found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

    </div>
</div>

<?php get_footer(); ?>
