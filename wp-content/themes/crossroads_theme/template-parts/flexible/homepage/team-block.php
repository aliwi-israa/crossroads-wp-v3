<?php if (get_row_layout() === 'team_block') : ?>
    <?php 
    $heading = get_sub_field('heading');
    $subheading = get_sub_field('subheading');
    $description = get_sub_field('description');
    ?>
    
    <section class="bg-color-op-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 text-center">
                    <?php if ($subheading) : ?>
                        <div class="subtitle wow fadeInUp mb-3"><?php echo esc_html($subheading); ?></div>
                    <?php endif; ?>

                    <?php if ($heading) : ?>
                        <h2 class="wow fadeInUp" data-wow-delay=".2s"><?php echo esc_html($heading); ?></h2>
                    <?php endif; ?>

                    <?php if ($description) : ?>
                        <p class="wow fadeInUp"><?php echo esc_html($description); ?></p>
                    <?php endif; ?>

                    <div class="spacer-single"></div>
                </div>
            </div>

            <div class="row g-4">
                <?php
                $team_query = new WP_Query(array(
                    'post_type'      => 'team_member',
                    'posts_per_page' => 4,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                    'no_found_rows'  => true,
                ));

                if ($team_query->have_posts()) :
                    while ($team_query->have_posts()) : $team_query->the_post();
                        $position = get_field('position');
                        $image    = get_field('image');
                        $permalink = get_permalink();
                ?>
                        <div class="col-lg-3 col-md-6">
                            <a href="<?php echo esc_url($permalink); ?>" class="d-block text-decoration-none text-dark">
                                <div class="relative rounded-1 overflow-hidden h-100">
                                    <div class="rounded-1 overflow-hidden wow fadeIn zoomIn doctors-imgs">
                                        <?php if ($image) : ?>
                                            <picture>
                                                <source srcset="<?php echo esc_url($image['sizes']['medium']); ?>" media="(max-width: 600px)">
                                                <source srcset="<?php echo esc_url($image['sizes']['large']); ?>" media="(max-width: 992px)">
                                                <img src="<?php echo esc_url($image['url']); ?>" class="w-100 wow scaleIn" loading="lazy" alt="<?php the_title(); ?>" width="1280" height="auto" style="width: 100%; height: auto;">
                                            </picture>
                                        <?php endif; ?>
                                    </div>

                                    <div class="abs w-100 start-0 bottom-0 z-3">
                                        <div class="p-2 rounded-10 m-3 text-center bg-white wow fadeInDown">
                                            <h4 class="mb-0"><?php the_title(); ?></h4>
                                            <?php if ($position) : ?>
                                                <p class="mb-2"><?php echo esc_html($position); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>
<?php endif; ?>
