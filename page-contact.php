<?php
/**
 * Template Name: Contact Page
 */
get_header();
?>

<main id="primary">

    <div class="page-hero section--dark">
        <div class="container">
            <span class="label"><?php _e( 'Get In Touch', 'brewhaus' ); ?></span>
            <h1 style="margin-top:.75rem;color:var(--cream);"><?php the_title(); ?></h1>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="contact-grid">

                <!-- Contact Form -->
                <div>
                    <span class="label" style="display:block;margin-bottom:1.5rem;"><?php _e( 'Send Us a Message', 'brewhaus' ); ?></span>

                    <?php if ( function_exists( 'wpcf7_contact_form' ) ) :
                        // Contact Form 7 integration
                        echo do_shortcode( '[contact-form-7 id="contact-form" title="Contact"]' );
                    else : ?>

                    <form class="contact-form" id="contact-form" novalidate>
                        <?php wp_nonce_field( 'brewhaus_contact', 'brewhaus_contact_nonce' ); ?>

                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0 1.5rem;">
                            <div>
                                <label for="cf-name"><?php _e( 'Your Name', 'brewhaus' ); ?></label>
                                <input type="text" id="cf-name" name="name" required placeholder="<?php esc_attr_e( 'Jane Smith', 'brewhaus' ); ?>">
                            </div>
                            <div>
                                <label for="cf-email"><?php _e( 'Email Address', 'brewhaus' ); ?></label>
                                <input type="email" id="cf-email" name="email" required placeholder="<?php esc_attr_e( 'jane@example.com', 'brewhaus' ); ?>">
                            </div>
                        </div>

                        <label for="cf-subject"><?php _e( 'Subject', 'brewhaus' ); ?></label>
                        <select id="cf-subject" name="subject">
                            <option value=""><?php _e( 'Choose a topic', 'brewhaus' ); ?></option>
                            <option value="general"><?php _e( 'General Enquiry', 'brewhaus' ); ?></option>
                            <option value="catering"><?php _e( 'Catering & Events', 'brewhaus' ); ?></option>
                            <option value="wholesale"><?php _e( 'Wholesale Coffee', 'brewhaus' ); ?></option>
                            <option value="press"><?php _e( 'Press & Media', 'brewhaus' ); ?></option>
                            <option value="feedback"><?php _e( 'Feedback', 'brewhaus' ); ?></option>
                        </select>

                        <label for="cf-message"><?php _e( 'Your Message', 'brewhaus' ); ?></label>
                        <textarea id="cf-message" name="message" required placeholder="<?php esc_attr_e( 'Tell us what\'s on your mind...', 'brewhaus' ); ?>"></textarea>

                        <button type="submit" class="btn btn--primary"><?php _e( 'Send Message', 'brewhaus' ); ?></button>
                        <p id="cf-response" style="font-family:var(--font-mono);font-size:.7rem;letter-spacing:.1em;margin-top:.75rem;min-height:1.2em;"></p>
                    </form>

                    <?php endif; ?>
                </div>

                <!-- Info Column -->
                <div>
                    <span class="label" style="display:block;margin-bottom:1.5rem;"><?php _e( 'Visit or Call', 'brewhaus' ); ?></span>

                    <div style="display:flex;flex-direction:column;gap:2rem;">
                        <div>
                            <h4 style="font-family:var(--font-mono);font-size:.65rem;letter-spacing:.15em;text-transform:uppercase;color:var(--caramel);font-style:normal;margin-bottom:.5rem;">
                                <?php _e( 'Address', 'brewhaus' ); ?>
                            </h4>
                            <p style="color:var(--roast);">
                                <?php echo nl2br( esc_html( brewhaus_option( 'address', "123 Bean Street\nPortland, OR 97201" ) ) ); ?>
                            </p>
                        </div>

                        <div>
                            <h4 style="font-family:var(--font-mono);font-size:.65rem;letter-spacing:.15em;text-transform:uppercase;color:var(--caramel);font-style:normal;margin-bottom:.5rem;">
                                <?php _e( 'Phone', 'brewhaus' ); ?>
                            </h4>
                            <p><a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', brewhaus_option( 'phone', '' ) ) ); ?>" style="color:var(--roast);">
                                <?php echo esc_html( brewhaus_option( 'phone', '(503) 555-0142' ) ); ?>
                            </a></p>
                        </div>

                        <div>
                            <h4 style="font-family:var(--font-mono);font-size:.65rem;letter-spacing:.15em;text-transform:uppercase;color:var(--caramel);font-style:normal;margin-bottom:.5rem;">
                                <?php _e( 'Email', 'brewhaus' ); ?>
                            </h4>
                            <p><a href="mailto:<?php echo esc_attr( brewhaus_option( 'email' ) ); ?>" style="color:var(--roast);">
                                <?php echo esc_html( brewhaus_option( 'email', 'hello@brewhaus.com' ) ); ?>
                            </a></p>
                        </div>

                        <div>
                            <h4 style="font-family:var(--font-mono);font-size:.65rem;letter-spacing:.15em;text-transform:uppercase;color:var(--caramel);font-style:normal;margin-bottom:.75rem;">
                                <?php _e( 'Opening Hours', 'brewhaus' ); ?>
                            </h4>
                            <table class="hours-table">
                                <tr><td><?php _e( 'Monday – Friday', 'brewhaus' ); ?></td><td>6:00am – 8:00pm</td></tr>
                                <tr><td><?php _e( 'Saturday', 'brewhaus' ); ?></td><td>7:00am – 8:00pm</td></tr>
                                <tr><td><?php _e( 'Sunday', 'brewhaus' ); ?></td><td>7:00am – 6:00pm</td></tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
