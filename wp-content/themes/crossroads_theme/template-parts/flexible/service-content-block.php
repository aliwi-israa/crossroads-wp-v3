<?php
// Get the current service's ID
$current_service_id = get_the_ID();

// Get the terms associated with the current service
$current_service_terms = get_the_terms($current_service_id, 'service-category');

// Determine the active category for accordion expansion
$active_category_id = null;
if (!empty($current_service_terms) && !is_wp_error($current_service_terms)) {
    foreach ($current_service_terms as $term) {
        // Find the top-level parent if the current service is assigned to a child
        if ($term->parent == 0) {
            $active_category_id = $term->term_id;
            break; // Found a direct parent, use it
        } else {
            // If assigned to a child, get the parent of that child
            $parent_term = get_term($term->parent, 'service-category');
            if ($parent_term) {
                $active_category_id = $parent_term->term_id;
                break;
            }
        }
    }
}

// Retrieve all top-level (parent) categories in the 'service-category' taxonomy, ordered by ACF field
$parent_categories = get_terms(array(
    'taxonomy'   => 'service-category',
    'hide_empty' => false, // We will check for services manually
    'parent'     => 0, // Get only top-level categories
    'orderby'    => 'meta_value_num', // Order by custom field value
    'meta_key'   => 'service_position', // Specify the ACF custom field to order by
    'order'      => 'ASC', // or 'DESC'
));

if (!empty($parent_categories)) :
    echo '<div class="accordion service-catagery-list wow fadeInUp" id="servicesAccordion">';

    foreach ($parent_categories as $parent_index => $parent_category) :
        // Collect all term IDs (parent + children) to query services efficiently
        $terms_to_query_for_services = [$parent_category->term_id];

        $child_categories = get_terms(array(
            'taxonomy'   => 'service-category',
            'hide_empty' => false,
            'parent'     => $parent_category->term_id,
            'orderby'    => 'name', // Order child categories by name or other preference
            'order'      => 'ASC',
        ));

        if (!empty($child_categories) && !is_wp_error($child_categories)) {
            foreach ($child_categories as $child_term) {
                $terms_to_query_for_services[] = $child_term->term_id;
            }
        }

        // Query for services associated with this parent category OR any of its children
        $services_query = new WP_Query(array(
            'post_type'      => 'service', // Ensure this is 'service' (singular)
            'posts_per_page' => -1, // Get all services
            'tax_query'      => array(
                array(
                    'taxonomy'         => 'service-category',
                    'field'            => 'term_id',
                    'terms'            => $terms_to_query_for_services,
                    'include_children' => false, // We've already included children IDs
                ),
            ),
            'orderby'        => 'title', // Order services by title
            'order'          => 'ASC',
        ));

        // Only display this category if it has associated services (including those in its children)
        if ($services_query->have_posts()) :
            $is_active_parent = ($active_category_id === $parent_category->term_id);
            $collapse_id = 'collapseCategory' . $parent_index . '-' . $parent_category->term_id; // Make ID more robust

            // Get the current page URL for comparison (for highlighting active service)
            $current_page_url = get_permalink($current_service_id);
            ?>

            <div class="accordion-item">
                <h3 class="accordion-header" id="heading<?php echo esc_attr($collapse_id); ?>">
                    <button class="accordion-button <?php echo $is_active_parent ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr($collapse_id); ?>" aria-expanded="<?php echo $is_active_parent ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr($collapse_id); ?>">
                        <a href="<?php echo esc_url(get_term_link($parent_category)); ?>" class="<?php echo ($active_category_id === $parent_category->term_id) ? 'active-bolder' : ''; ?>">
                            <?php echo esc_html($parent_category->name); ?>
                        </a>
                    </button>
                </h3>

                <div id="<?php echo esc_attr($collapse_id); ?>" class="accordion-collapse collapse <?php echo $is_active_parent ? 'show' : ''; ?>" aria-labelledby="heading<?php echo esc_attr($collapse_id); ?>" data-bs-parent="#servicesAccordion">
                    <div class="accordion-body service-catagery-list wow fadeInUp">
                        <ul>
                            <?php
                            // Loop through all services found for this parent category and its children
                            while ($services_query->have_posts()) : $services_query->the_post();
                                $service_permalink = get_permalink();
                                $is_current_service = ($current_service_id === get_the_ID()); // Check if this is the currently viewed service
                                ?>
                                <li>
                                    <a href="<?php echo esc_url($service_permalink); ?>" class="<?php echo $is_current_service ? 'active' : ''; ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </li>
                            <?php
                            endwhile;
                            wp_reset_postdata(); // Reset post data after the custom query
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php
        endif; // End if ($services_query->have_posts())
    endforeach; // End foreach ($parent_categories as $parent_category)
    echo '</div>'; // Close #servicesAccordion
endif; // End if (!empty($parent_categories))
?>