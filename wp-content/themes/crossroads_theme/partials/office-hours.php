<div class="office-hours mt-3">
  <div class="contact-box contact-box-1">
    <h5 class="contact-box-title"><i class="icon-clock"></i> Office Hours</h5>
    <table class="row-table">
      <tbody>
        <?php if (have_rows('office_hours', 'option')): ?>
          <?php while (have_rows('office_hours', 'option')): the_row();
            $day = get_sub_field('day');
            $time = get_sub_field('hours');
          ?>
            <tr>
              <td><i><?php echo esc_html($day); ?></i></td>
              <td><?php echo esc_html($time); ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="2">Office hours not set</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
