<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package crossroads_theme
 */

get_header();
$booking_link = get_field('ClinicBookingLink', 'option');

?>

	<main id="primary" class="site-main">
			<section> 
	<div class="page-content" style="margin-top:100px;">
		<div class="section page-content-first">
			<div class="container">
				<div class="text-center mb-2  mb-md-3 mb-lg-4 mt-5">
					<div class="h-sub text-blue">Page Not Found</div>
					<h1 class="orange-color">Oops! We cannot find the page you were looking for.</h1>
					<div class="text-blue">Please click on the link below to go back to the homepage or use the menu above.
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col text-center">
						<p class="mb-4">
							<div class="cta-book mb-5">
     							<a class="btn-main fx-slide btn-outline-white"  href="<?php echo esc_url(home_url()); ?>"><span>Back to Homepage</span></a>								
								<a class="btn-main fx-slide menu_side_area m-0" href="<?php  echo $booking_link ?>"><span>Book Appointment</span></a>
							</div>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	</section>
	 <div class="backToTop js-backToTop">
		<i class="icon icon-up-arrow"></i>
	</div>
	</main><!-- #main -->

<?php
get_footer();
