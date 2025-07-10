<?php 
// Flexible Content Block: FAQs
$faqs = get_sub_field('faqs'); // Post Object field (multiple select)
?>

<?php if ($faqs) : ?>
<section>
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="subtitle id-color wow fadeInUp" data-wow-delay=".0s">Everything You Need to Know</div>
                <h2 class="wow fadeInUp" data-wow-delay=".2s">Frequently Asked Questions</h2>
            </div>
            <div class="col-lg-7">
                <div class="accordion s2 wow fadeInUp">
                    <div class="accordion-section">

                        <?php 
                        $count = 0;
                        foreach ($faqs as $faq_post) :
                            if ($count >= 5) break;
                            $count++;
                            $question = get_the_title($faq_post->ID);
                            $answer = get_field('answer', $faq_post->ID); // Assuming you have an ACF field called 'answer'
                        ?>
                            <div class="accordion-section-title" data-tab="#accordion-<?php echo $count; ?>">
                                <?php echo esc_html($question); ?>
                            </div>
                            <div class="accordion-section-content" id="accordion-<?php echo $count; ?>">
                                <?php echo wp_kses_post($answer); ?>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>

                <?php if (count($faqs) > 5) : ?>
                    <div class="mt-4">
                        <a href="<?php echo get_post_type_archive_link('faq'); ?>" class="btn-main fx-slide">
                            <span>View More FAQs</span>
                        </a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>
<?php endif; ?>
