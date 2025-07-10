<?php
/* Template Name: Thank You / Confirmation */
get_header();
?>

<section>
  <div class="page-content" style="margin-top:100px;">
    <div class="section page-content-first">
      <div class="container">
        <?php the_content(); ?>
      </div>
      <div class="container">
        <div class="row">
          <div class="col text-center">
            <div class="cta-book mb-5">
              <a class="btn-main fx-slide btn-outline-white" href="<?php echo esc_url(home_url()); ?>">
                <span>Back to Homepage</span>
              </a>
            </div>
          </div>
        </div>
      </div>

</div>
  </div>
</section>

<div class="backToTop js-backToTop">
  <i class="icon icon-up-arrow"></i>
</div>

<?php get_footer(); ?>
