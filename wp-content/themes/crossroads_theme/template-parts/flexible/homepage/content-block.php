<?php
$sub = get_sub_field('subheading');
$heading = get_sub_field('heading');
$description = get_sub_field('description');
$page_link = get_sub_field('page_link');
$show_rating = get_sub_field('show_google_rating');
$rating = get_sub_field('google_ratings') ?: '5.0';
$show_features = get_sub_field('show_features');
$image = get_sub_field('image');
$image_direction = get_sub_field('image_direction');
?>
<section>
    <div class="container">
        <div
            class="row g-4 gx-5 align-items-center <?php echo ($image_direction === 'isImgRight') ? 'content-block-right' : 'content-block-left'; ?>">
            <div class="col-lg-6">
                <div class="img-container rounded-1 overflow-hidden wow zoomIn">
                    <?php if ($image) : ?>
                    <img src="<?php echo esc_url($image['url']); ?>"
                        alt="<?php echo esc_attr($image['alt']); ?>">
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="me-lg-3">
                    <?php if ($sub) : ?><div class="subtitle s2 mb-3 wow fadeInUp"><?php echo esc_html($sub); ?></div>
                    <?php endif; ?>
                    <?php if ($heading) : ?><h2 class="wow fadeInUp" data-wow-delay=".2s"><?php echo esc_html($heading); ?></h2><?php endif; ?>
                    <?php if ($description) : ?><p class="wow fadeInUp" data-wow-delay=".4s"><?php echo strip_tags($description, '<ul><li>');?></p>
                    <?php endif; ?>
                    <?php if ($show_features || $show_rating) : ?>
                        <div class="border-bottom mb-4"></div>
                        <div class="row g-4">
                            <?php if (have_rows('features')) : ?>
                            <?php while (have_rows('features')) : the_row(); ?>
                            <div class="col-sm-6">
                                <h5><?php echo esc_html(get_sub_field('title')); ?></h5>
                                <p><?php echo esc_html(get_sub_field('description')); ?></p>
                            </div>
                            <?php endwhile; ?>
                            <?php endif; ?>

                            <?php if ($show_rating) : ?>
                            <div class="col-sm-12">
                                <h5>Google Rating</h5>
                                <div class="d-flex align-items-center">
                                <div class="fw-bold me-2"><?php echo esc_html($rating); ?></div>
                                    <div class="d-flex fs-14">
                                        <?php for ($i = 0; $i < 5; $i++) : ?>
                                            <?php if ($i < $rating): ?>
                                                <i class="fas fa-star text-warning<?php echo $i < 4 ? ' me-1' : ''; ?>"></i>
                                            <?php else: ?>
                                                <i class="far fa-star text-muted<?php echo $i < 4 ? ' me-1' : ''; ?>"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($page_link) : ?>
                        <a class="btn-main fx-slide" 
                        href="<?php echo esc_url($page_link['url']); ?>" 
                        <?php echo $page_link['target'] ? 'target="' . esc_attr($page_link['target']) . '" rel="noopener"' : ''; ?>>
                        <span><?php echo esc_html($page_link['title']); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>