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
                        global $post; // Declare the global $post variable

                        // Store the original global $post object to restore it later
                        $original_post = $post; 

                        foreach ($faqs as $faq_post_object) : // Renamed loop variable for clarity (avoiding $faq_post if it's not the actual $post)
                            if ($count >= 5) break;
                            $count++;
                            
                            // Set the global $post object to the current FAQ post
                            $post = $faq_post_object;
                            
                            // Setup postdata for the current FAQ post
                            setup_postdata($post);
                        ?>
                            <div class="accordion-section-title" data-tab="#accordion-<?php echo $count; ?>">
                                <?php 
                                // get_the_title() is fine, but the_title() is also available after setup_postdata()
                                the_title(); 
                                ?>
                            </div>
                            <div class="accordion-section-content" id="accordion-<?php echo $count; ?>">
                                <?php 
                                // This will now correctly display the main content of the current FAQ post
                                the_content(); 
                                ?>
                            </div>
                        <?php endforeach; ?>
                        
                        <?php 
                        // IMPORTANT: Restore the original global $post object after the loop
                        $post = $original_post;
                        wp_reset_postdata(); 
                        ?>

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