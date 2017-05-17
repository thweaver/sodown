<?php 
	/* Template Name: Contact */
?>
<?php get_header(); ?>
	<section>
		<div class="container contact-container">
			<h2 class="section-title">
				<span>Contact</span>
			</h2>
			<div class="content">
				<div class="contact-top">
					<?php
						$contact_photo = get_field( 'contact_photo','option' );
						$contact_photo = $contact_photo['sizes']['page_img'];
					?>
					<img src="<?php echo $contact_photo; ?>">
					<div class="newsletter-container">
						<form action="//ImSoDown.us10.list-manage.com/subscribe/post?u=036d5e962bf299fc3b5d1f0a7&amp;id=ef258b5804" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate newsletter" target="_blank" novalidate>
							<input type="text" class="newsletter-input required" id="mce-EMAIL" value="Sign up for my newsletter" onblur="if (this.value == '') {this.value = 'Sign up for my newsletter';}"
	 onfocus="if (this.value == 'Sign up for my newsletter') {this.value = '';}">
							<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_036d5e962bf299fc3b5d1f0a7_ef258b5804" tabindex="-1" value=""></div>
							<input type="submit" class="newsletter-submit" value="Join" id="mc-embedded-subscribe">
						</form>



						<form action="//ImSoDown.us10.list-manage.com/subscribe/post?u=036d5e962bf299fc3b5d1f0a7&amp;id=d589f5903d" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate newsletter" target="_blank" novalidate>
							<input type="text" class="newsletter-input required" id="mce-EMAIL" value="Street Team Sign-Up" onblur="if (this.value == '') {this.value = 'Street Team Sign-Up';}"
	 onfocus="if (this.value == 'Street Team Sign-Up') {this.value = '';}">
							<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_036d5e962bf299fc3b5d1f0a7_ef258b5804" tabindex="-1" value=""></div>
							<input type="submit" class="newsletter-submit" value="Join" id="mc-embedded-subscribe">
						</form>

						<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>


					</div>
				</div>
				<div class="contact-emails">
				<?php if( have_rows('contact_email','option') ): ?>
					<?php while( have_rows('contact_email','option') ): the_row(); ?>
					<div class="contact-email-group">
						<h3 class="contact-email-label">
							<?php the_sub_field('contact_title','option') ?>
						</h3>
						<a href="<?php echo antispambot(get_sub_field('contact_email_address','option')); ?>" class="contact-email-address"><?php echo antispambot(get_sub_field('contact_email_address','option')); ?></a>
					</div>
					<?php endwhile; ?>
				<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="container about-container">
			<h2 class="section-title">
				<span><?php the_field('bio_headline','option') ?></span>
			</h2>
			<div class="content">
				<div class="about-bio">
					<?php the_field('bio','option') ?>
				</p>
			</div>
		</div>
	</section>
<?php get_footer(); ?>