<?php
$careers_title        = get_field('careers_title');
$careers_description  = get_field('careers_description');
$benefits_title       = get_field('benefits_title');
$benefits_description = get_field('benefits_description');
$benefits_repeater    = get_field('benefits');
?>
<div class="text-center mb-2 mb-md-3 mb-lg-4">
  <div class="h-decor"></div>
  <?php if ($careers_description): ?>
    <p><?php echo esc_html($careers_description); ?></p>
  <?php endif; ?>
</div>
  <?php if ($careers_title): ?>
<div class="container aos-init aos-animate text-center" data-aos="fade-up">
    <h2 class="wow fadeInUp"><?php echo esc_html($careers_title); ?></h2>
<div class="row">
    <div class="col">
        <h2 id="job-title"></h2>
        <div id="all-jobs"></div>
    </div>
</div>
</div>
  <?php endif; ?>

<div class="text-center mb-2 mb-md-3 mb-lg-4">
  <?php if ($benefits_title): ?>
    <h2 class="wow fadeInUp"><?php echo esc_html($benefits_title); ?></h2>
  <?php endif; ?>
  <div class="h-decor"></div>
  <?php if ($benefits_description): ?>
    <p class="wow fadeInUp"><?php echo esc_html($benefits_description); ?></p>
  <?php endif; ?>
</div>

<div class="row g-4">
  <?php if ($benefits_repeater): ?>
    <?php foreach ($benefits_repeater as $item): ?>
      <div class="col-lg-4 col-md-6">
        <div class="border-gray p-40 h-100 rounded-1">
          <div class="relative wow fadeInUp career-icon">
            <?php if (!empty($item['icon']['url'])): ?>
              <img src="<?php echo esc_url($item['icon']['url']); ?>" alt="<?php echo esc_attr($item['title']); ?>">
            <?php endif; ?>
            <h4><?php echo esc_html($item['title']); ?></h4>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>
  <script>
  jQuery(document).ready(function ($) {
    const jobBoardName = 'crossroads-dental';
    const apiEndpoint = `https://api.greenhouse.io/v1/boards/${jobBoardName}/jobs`;

    function fetchAndDisplayJobs() {
      $.get(apiEndpoint, function (data) {
        const jobs = data.jobs;
        if (jobs.length === 0) {
          $('#all-jobs').html('<p>No jobs available at the moment.</p>');
        } else {
          const jobListHtml = '<ul>' +
            jobs.map(job =>
              `<li><a class="text-blue" href="${job.absolute_url}"><strong>${job.title}</strong></a> <a class="view-job-link id-color" href="${job.absolute_url}">View Job &#8594;</a></li>`
            ).join('') +
            '</ul>';
          $('#all-jobs').html(jobListHtml);
        }
      }).fail(function () {
        $('#all-jobs').html('<p>Failed to fetch jobs.</p>');
      });
    }

    function getGhJnParameter() {
      const urlParams = new URLSearchParams(window.location.search);
      return urlParams.get('gh_jn');
    }

    const ghJn = getGhJnParameter();
    if (ghJn) {
      $('#job-title').text(ghJn);
    }

    fetchAndDisplayJobs();
  });
</script>
