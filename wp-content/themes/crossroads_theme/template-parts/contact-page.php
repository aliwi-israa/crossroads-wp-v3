<?php

$contact_title       = get_field('title');
$contact_subtitle    = get_field('subtitle');
$contact_description = get_field('description');
$contact_form_embed  = get_field('form');
?>
   <section>
        <div class="container">
            <div class="row g-4">
                <!-- Contact Info -->
                <div class="col-lg-6">
                    <?php if ($contact_subtitle): ?>
                    <div class="subtitle"><?php echo esc_html($contact_subtitle); ?></div>
                    <?php endif; ?>

                    <?php if ($contact_title): ?>
                    <h2 class="wow fadeInUp"><?php echo esc_html($contact_title); ?></h2>
                    <?php endif; ?>

                    <?php if ($contact_description): ?>
                    <p><?php echo esc_html($contact_description); ?></p>
                    <?php endif; ?>

                    <div class="row g-4 gx-5">
                        <?php
                        $address = get_field('ClinicAddress', 'option') ?: '2384 Dundas St W';
                        $map_link = get_field('ClinicMapLink', 'option') ?: 'https://www.google.com/maps';
                        $phone = get_field('ClinicPhoneNumber', 'option') ?: '(+1) 234-5678';
                        $email = get_field('ClinicEmail', 'option') ?: 'info@crossroadsdental.ca'; ?>

                        <div class="col-lg-6 office-hours-block">
                            <div class="fw-bold text-dark">
                                <i class="fs-14 id-color fa-solid fa-clock me-2"></i>Opening Hours
                            </div>
                            <?php if (have_rows('office_hours', 'option')) : ?>
                            <?php while (have_rows('office_hours', 'option')) : the_row(); 
                            $day = get_sub_field('days');
                            $hours = get_sub_field('hours');
                        ?>
                            <p><?php echo esc_html($day); ?>: <?php echo esc_html($hours); ?></p>
                            <?php endwhile; ?>
                            <?php else : ?>
                            <p>Mon to Sat 09:00 - 18:00</p>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-6">
                            <a href="<?php echo esc_url($map_link); ?>" target="_blank"
                                class="text-decoration-none d-block fw-bold">
                                <i class="fa-solid fa-location-dot me-2 id-color fs-14"></i>
                                <span class="text-dark">Clinic Location</span>
                                <div class="fw-normal ms-4"><?php echo esc_html($address); ?></div>
                            </a>
                        </div>

                        <div class="col-lg-6">
                            <div class="fw-bold text-dark">
                                <i class="fa-solid fa-phone me-2 id-color fs-14"></i>Call Us Directly
                            </div>
                            <a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a>
                        </div>

                        <div class="col-lg-6">
                            <a href="mailto:<?php echo esc_attr($email); ?>"
                                class="text-dark text-decoration-none d-block fw-bold">
                                <i class="fa fa-envelope me-2 id-color fs-14"></i>Send a Message
                                <div class="fw-normal ms-4"><?php echo esc_html($email); ?></div>

                            </a>
                        </div>

                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-6">
                    <div class="p-40 bg-color-op-1 rounded-1">
                        <h3>Get In Touch</h3>
                        <?php if ($contact_form_embed): ?>
                        <?php echo $contact_form_embed; ?>
                        <?php else: ?>
                        <p>Form is not available at the moment.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script src="https://link.msgsndr.com/js/form_embed.js"></script>