<?php 
$heading = get_sub_field('heading');
$btn_text = get_sub_field('button_text');
$is_external = get_sub_field('is_external_link');
$internal_link = get_sub_field('button_link');
$external_link = get_sub_field('external_link');
$final_link = $is_external ? $external_link : $internal_link;
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
        <?php if ($btn_text && $final_link) : ?>
        <a class="btn-main btn-line fx-slide" href="<?php echo esc_url($final_link); ?>" <?php echo $is_external ? 'target="_blank" rel="noopener"' : ''; ?>>
            <span><?php echo esc_html($btn_text); ?></span>
        </a>
        <?php endif; ?>
    </div>
    </div>
</div>
</section>