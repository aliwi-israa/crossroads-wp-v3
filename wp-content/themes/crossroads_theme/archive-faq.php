<?php get_header(); ?>
<div id="wrapper">
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <?php get_template_part('partials/hero-archive'); ?>
<section>
  <div class="container mb-4">
    <input type="text" id="faqSearch" class="form-control" placeholder="Search for a service">
  </div>

  <div class="container">
    <div class="row g-4 gx-5 justify-content-center wow fadeInUp">
      <div class="col-lg-12">

        <?php
        $terms = get_terms([
          'taxonomy'   => 'service-category',
          'hide_empty' => false,
          'orderby'    => 'name',
        ]);

        foreach ($terms as $term) :

          $services = get_posts([
            'post_type'      => 'service',
            'tax_query'      => [[
              'taxonomy' => 'service-category',
              'field'    => 'term_id',
              'terms'    => $term->term_id,
            ]],
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
          ]);

          if (!$services) continue;
        ?>

        <div class="subcategory-section">
          <h3 class="subcategory-title"><?php echo esc_html($term->name); ?></h3>

          <?php foreach ($services as $service) :
            $faqs = new WP_Query([
              'post_type'      => 'faq',
              'posts_per_page' => -1,
              'meta_query'     => [[
                'key'     => 'service',
                'value'   => $service->ID,
                'compare' => '=',
              ]]
            ]);
            if (!$faqs->have_posts()) continue;
          ?>

          <div class="subcategory-sub">
            <h4 class="subcategory-subtitle id-color mt-4" style="margin-left: 20px;"><?php echo esc_html($service->post_title); ?></h4>
            <div class="accordion-section" style="margin-left: 20px;">
              <?php while ($faqs->have_posts()) : $faqs->the_post();
                $faq_id = 'faq-' . sanitize_title_with_dashes($service->post_name) . '-' . get_the_ID();
              ?>
              <div class="accordion-section-title" data-tab="#<?php echo esc_attr($faq_id); ?>">
                <?php the_title(); ?>
              </div>
              <div class="accordion-section-content" id="<?php echo esc_attr($faq_id); ?>">
                <?php the_content(); ?>
              </div>
              <?php endwhile; wp_reset_postdata(); ?>
            </div>
          </div>

          <?php endforeach; ?>
        </div>

        <?php endforeach; ?>

      </div>
    </div>
  </div>
</section>
        </div>

</div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.d-tab-nav li');
            const contents = document.querySelectorAll('.d-tab-content li');
            tabs.forEach((tab, index) => {
                tab.addEventListener('click', () => {
                    tabs.forEach(t => t.classList.remove('active-tab'));
                    tab.classList.add('active-tab');
                    contents.forEach(c => c.style.display = 'none');
                    if (contents[index]) {
                        contents[index].style.display = 'block';
                    }
                });
            });
            contents.forEach((c, i) => {
                c.style.display = i === 0 ? 'block' : 'none';
            });
        });
        //filter results
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('faqSearch');
            const sections = document.querySelectorAll('.subcategory-section');

            searchInput.addEventListener('input', function () {
                const query = this.value.toLowerCase().trim();

                sections.forEach(section => {
                    const categoryTitle = section.querySelector('.subcategory-title');
                    const subcategorySubs = section.querySelectorAll('.subcategory-sub');

                    let matchFound = false;

                    // Check if parent category matches
                    const categoryMatches = categoryTitle && categoryTitle.textContent.toLowerCase().includes(query);

                    subcategorySubs.forEach(sub => {
                        const subtitle = sub.querySelector('.subcategory-subtitle');
                        const subMatches = subtitle && subtitle.textContent.toLowerCase().includes(query);

                        sub.style.display = subMatches ? '' : 'none';
                        if (subMatches) matchFound = true;
                    });

                    // Show whole section if parent category matches
                    if (categoryMatches) {
                        section.style.display = '';
                        subcategorySubs.forEach(sub => sub.style.display = '');
                        matchFound = true;
                    } else {
                        // If no subcategories match, hide section
                        section.style.display = matchFound || query === '' ? '' : 'none';
                    }
                });
            });
        });
    </script>
<?php get_footer(); ?>
