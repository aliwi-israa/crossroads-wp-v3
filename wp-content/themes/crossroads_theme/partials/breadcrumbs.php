<div class="section m-3">
  <div class="breadcrumbs-wrap">
    <div class="container">
      <div class="breadcrumbs">
        <ul class="crumb wow fadeInDown">
          <li><a href="<?php echo esc_url(home_url()); ?>">Home</a></li>

          <?php
          if (is_singular('page')) {
              // Static page
              $ancestors = array_reverse(get_post_ancestors(get_the_ID()));
              foreach ($ancestors as $ancestor_id) {
                  echo '<li><a href="' . get_permalink($ancestor_id) . '">' . get_the_title($ancestor_id) . '</a></li>';
              }
              echo '<li class="active">' . get_the_title() . '</li>';

          } elseif (is_singular('post')) {
              // Blog post
              $category = get_the_category();
              if (!empty($category)) {
                  $cat = $category[0];
                  echo '<li><a href="' . get_category_link($cat->term_id) . '">' . esc_html($cat->name) . '</a></li>';
              }
              echo '<li class="active">' . get_the_title() . '</li>';

          } elseif (is_singular('service')) {
              // Custom post type: service
              $terms = get_the_terms(get_the_ID(), 'service-category');
              if ($terms && !is_wp_error($terms)) {
                  $term = $terms[0];
                  echo '<li><a href="' . get_term_link($term) . '">' . esc_html($term->name) . '</a></li>';
              }
              echo '<li class="active">' . get_the_title() . '</li>';

          } 
          elseif (is_post_type_archive('service')) {
                echo '<li class="active">Our Services</li>';
            }

            elseif (is_tax('service-category')) {
              // Taxonomy archive
              $term = get_queried_object();
              if ($term->parent) {
                  $parent = get_term($term->parent, 'service-category');
                  echo '<li><a href="' . get_term_link($parent) . '">' . esc_html($parent->name) . '</a></li>';
              }
              echo '<li class="active">' . esc_html($term->name) . '</li>';

          } elseif (is_post_type_archive('team_member')) {
              echo '<li class="active">Our Team</li>';

          } elseif (is_post_type_archive('faq')) {
              echo '<li class="active">FAQs</li>';

          } elseif (is_home()) {
              echo '<li class="active">Blog</li>';

          } elseif (is_category()) {
              $cat = get_queried_object();
              echo '<li class="active">' . esc_html($cat->name) . '</li>';

          } elseif (is_search()) {
              echo '<li class="active">Search results for: ' . get_search_query() . '</li>';

          } elseif (is_404()) {
              echo '<li class="active">Page Not Found</li>';
          }
          ?>
        </ul>
      </div>
    </div>
  </div>
</div>
