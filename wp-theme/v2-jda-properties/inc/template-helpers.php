<?php
/**
 * Template helpers used across the theme.
 *
 * @package V2JDA
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Render a project card. $project can be a WP_Post or post ID.
 */
function v2jda_render_project_card( $project, $delay = 0 ) {
	$post = get_post( $project );
	if ( ! $post ) { return; }

	setup_postdata( $post );
	$id      = $post->ID;
	$status  = wp_get_post_terms( $id, 'project_status', array( 'fields' => 'names' ) );
	$status  = ! empty( $status ) ? $status[0] : 'Ongoing';
	$cls     = 'project-badge';
	if ( strtolower( $status ) === 'completed' ) { $cls .= ' completed'; }
	elseif ( strtolower( $status ) === 'upcoming' ) { $cls .= ' upcoming'; }

	$thumb = get_the_post_thumbnail_url( $id, 'v2jda-card' );
	if ( ! $thumb ) {
		$thumb = 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=900&q=80';
	}

	$address = v2jda_project_meta( 'address', $id );
	$area    = v2jda_project_meta( 'area', $id );
	?>
	<article class="project-card" data-aos="fade-up" data-delay="<?php echo (int) $delay; ?>"
	         data-category="<?php echo esc_attr( strtolower( $status ) ); ?>">
		<a href="<?php echo esc_url( get_permalink( $id ) ); ?>" class="project-thumb">
			<img src="<?php echo esc_url( $thumb ); ?>"
			     alt="<?php echo esc_attr( get_the_title( $id ) ); ?>"
			     loading="lazy" />
			<span class="<?php echo esc_attr( $cls ); ?>"><?php echo esc_html( $status ); ?></span>
		</a>
		<div class="project-body">
			<h3><a href="<?php echo esc_url( get_permalink( $id ) ); ?>"><?php echo esc_html( get_the_title( $id ) ); ?></a></h3>
			<p><?php echo esc_html( wp_trim_words( get_the_excerpt( $id ), 18 ) ); ?></p>
			<div class="project-meta">
				<?php if ( $address ) : ?>
					<span><i class="fa-solid fa-location-dot"></i> <?php echo esc_html( $address ); ?></span>
				<?php endif; ?>
				<?php if ( $area ) : ?>
					<span><i class="fa-solid fa-ruler-combined"></i> <?php echo esc_html( $area ); ?></span>
				<?php endif; ?>
			</div>
		</div>
	</article>
	<?php
	wp_reset_postdata();
}

/**
 * Render the floating WhatsApp + Call buttons.
 */
function v2jda_floating_cta() {
	$wa    = v2jda_opt( 'social_whatsapp', 'https://wa.me/917597961878' );
	$phone = v2jda_opt( 'phone_e164', '917597961878' );
	?>
	<div class="float-cta" aria-hidden="false">
		<?php if ( $wa ) : ?>
			<a class="wa" href="<?php echo esc_url( $wa ); ?>" target="_blank" rel="noopener" aria-label="Chat on WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
		<?php endif; ?>
		<?php if ( $phone ) : ?>
			<a class="call" href="tel:+<?php echo esc_attr( preg_replace( '/\D/', '', $phone ) ); ?>" aria-label="Call now"><i class="fa-solid fa-phone"></i></a>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Render the lead capture form. Pass $args['interest'] to pre-select.
 */
function v2jda_lead_form( $args = array() ) {
	$args = wp_parse_args( $args, array(
		'interest' => '',
		'class'    => '',
	) );
	?>
	<form id="leadForm" class="form <?php echo esc_attr( $args['class'] ); ?>" novalidate>
		<input type="hidden" name="action" value="v2jda_submit_lead" />
		<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'v2jda_lead' ) ); ?>" />
		<input type="hidden" name="source" value="<?php echo esc_url( home_url( $_SERVER['REQUEST_URI'] ?? '/' ) ); ?>" />
		<!-- honeypot -->
		<input type="text" name="website" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px;height:0;width:0" aria-hidden="true" />

		<div class="row-2">
			<div class="field">
				<label for="lf_name"><?php esc_html_e( 'Full Name', 'v2jda' ); ?>*</label>
				<input id="lf_name" name="name" type="text" required />
			</div>
			<div class="field">
				<label for="lf_phone"><?php esc_html_e( 'Phone Number', 'v2jda' ); ?>*</label>
				<input id="lf_phone" name="phone" type="tel" required pattern="[0-9+ \-()]{7,}" />
			</div>
		</div>

		<div class="row-2">
			<div class="field">
				<label for="lf_email"><?php esc_html_e( 'Email', 'v2jda' ); ?></label>
				<input id="lf_email" name="email" type="email" />
			</div>
			<div class="field">
				<label for="lf_interest"><?php esc_html_e( 'I am interested in', 'v2jda' ); ?></label>
				<select id="lf_interest" name="interest">
					<option value="">-- Select --</option>
					<option <?php selected( $args['interest'], 'Residential Plot' ); ?>>Residential Plot</option>
					<option <?php selected( $args['interest'], 'Villa' ); ?>>Villa</option>
					<option <?php selected( $args['interest'], 'Farm House Land' ); ?>>Farm House Land</option>
					<option <?php selected( $args['interest'], 'Commercial' ); ?>>Commercial</option>
					<option <?php selected( $args['interest'], 'Site Visit' ); ?>>Site Visit</option>
				</select>
			</div>
		</div>

		<div class="field">
			<label for="lf_message"><?php esc_html_e( 'Message', 'v2jda' ); ?></label>
			<textarea id="lf_message" name="message" rows="4" placeholder="Tell us a bit about what you're looking for..."></textarea>
		</div>

		<button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i> <?php esc_html_e( 'Send Enquiry', 'v2jda' ); ?></button>
		<div class="form-status" role="status" aria-live="polite"></div>
	</form>
	<?php
}
