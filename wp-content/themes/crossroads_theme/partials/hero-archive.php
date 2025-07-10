<?php
/**
 * Global Hero Section for Archives and Singular Pages
 */

$heading = '';
$subheading = '';
$description = '';

// Detect context
if (is_singular()) {
    $heading = get_the_title();

    if (is_singular('service')) {
        $subheading = 'Services'; // Hardcoded for single service pages
    } else if (is_singular('faq')) {
        // Assuming 'faq_subheading' is a field on the individual FAQ post
        $subheading = get_field('faq_subheading');
        // If it's a global option for all FAQs, use:
        // $subheading = get_field('faq_subheading', 'option');
    } else {
        // For all other singular pages (standard Pages, custom post types not explicitly handled)
        // Use the new 'hero_subheading' field from the page's ACF.
        $subheading = get_field('hero_subheading');
    }

    // Assuming hero_description is a field on the individual page/post
    $description = get_field('hero_description');

} elseif (is_archive() || is_tax()) {
    // Detect post type or taxonomy archive and load corresponding fields
    if (is_post_type_archive('team_member')) {
        $heading = post_type_archive_title('', false);
        // Assuming 'team_members_subheading' is a global option for the archive page
        $subheading = get_field('team_members_subheading', 'option');
    } elseif (is_post_type_archive('service')) {
        $heading = post_type_archive_title('', false);
        $subheading = 'Discover our treatment options'; // Hardcoded for service archive
    } elseif (is_tax('service-category')) {
        $term = get_queried_object();
        $heading = $term->name;
        $subheading = 'Services'; // Hardcoded for service category archives
    } elseif (is_post_type_archive('faq')) {
        $heading = post_type_archive_title('', false);
        // Assuming 'faq_subheading' is a global option for the archive page
        $subheading = get_field('faq_subheading', 'option');
    } else {
        // For other archives (e.g., blog posts archive, default archives)
        // You might want a default subheading or an option for general archives
        $heading = get_the_archive_title(); // Gets the default archive title (e.g., "Archives: Category Name")
        $subheading = 'Our Latest Posts'; // Example default for blog archive
    }
}

// Output Hero if heading or subheading exist
?>

<?php if ($heading || $subheading): ?>
<section id="subheader" class="bg-color-op-1 text-center">
    <div class="container relative z-2">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <?php if ($subheading): ?>
                    <h3 class="wow fadeInUp subheader"><?php echo esc_html($subheading); ?></h3>
                <?php endif; ?>
                <?php if ($heading): ?>
                    <h1 class="wow fadeInUp"><?php echo esc_html($heading); ?></h1>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
