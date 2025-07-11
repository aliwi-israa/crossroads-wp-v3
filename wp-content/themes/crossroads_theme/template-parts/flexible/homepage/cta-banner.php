<?php 
$heading = get_sub_field('heading');
$page_link = get_sub_field('page_link');
?>
<section class="bg-color text-light pt-40 pb-40">
<div class="container">
    <div class="row g-4">
    <div class="col-md-9">
        <?php if ($heading) : ?>
        <h3 class="mb-0 fs-32"><?php echo esc_html($heading); ?></h3>
        <?php endif; ?>
    </div>
    <div class="col-lg-3 text-lg-end">
        <?php if ($page_link) : ?>
            <a class="btn-main btn-line fx-slide"
            href="<?php echo esc_url($page_link['url']); ?>" 
            <?php echo $page_link['target'] ? 'target="' . esc_attr($page_link['target']) . '" rel="noopener"' : ''; ?>>
            <span><?php echo esc_html($page_link['title']); ?></span>
            </a>
        <?php endif; ?>
    </div>
    </div>
</div>
</section>