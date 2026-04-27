<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="container">

        <div class="footer-top">

            <!-- Brand Column -->
            <div class="footer-brand">
                <div class="site-logo">
                    <span class="site-logo__name"><?php bloginfo( 'name' ); ?></span>
                    <span class="site-logo__tagline"><?php bloginfo( 'description' ); ?></span>
                </div>
                <p><?php echo wp_kses_post( brewhaus_option( 'tagline', 'Specialty coffee roasted with care. Brewed with precision. Served with warmth.' ) ); ?></p>

                <!-- Social Links -->
                <div class="social-links" style="margin-top:1.5rem;">
                    <?php foreach ( [ 'instagram', 'facebook', 'twitter', 'tiktok' ] as $platform ) :
                        $url = brewhaus_option( $platform );
                        if ( $url ) : ?>
                            <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer">
                                <?php echo esc_html( ucfirst( $platform ) ); ?>
                            </a>
                        <?php endif;
                    endforeach; ?>
                </div>
            </div>

            <!-- Visit Column -->
            <div class="footer-col">
                <h4><?php _e( 'Visit Us', 'brewhaus' ); ?></h4>
                <ul>
                    <li style="font-size:0.9rem;color:rgba(245,239,224,0.6);line-height:1.6;">
                        <?php echo nl2br( esc_html( brewhaus_option( 'address', '123 Bean Street' ) ) ); ?>
                    </li>
                    <li style="margin-top:1rem;">
                        <a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', brewhaus_option( 'phone', '' ) ) ); ?>">
                            <?php echo esc_html( brewhaus_option( 'phone', '(503) 555-0142' ) ); ?>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:<?php echo esc_attr( brewhaus_option( 'email', 'hello@brewhaus.com' ) ); ?>">
                            <?php echo esc_html( brewhaus_option( 'email', 'hello@brewhaus.com' ) ); ?>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Hours Column -->
            <div class="footer-col">
                <h4><?php _e( 'Hours', 'brewhaus' ); ?></h4>
                <ul style="font-size:0.85rem;color:rgba(245,239,224,0.6);line-height:2;">
                    <li><?php _e( 'Mon – Fri', 'brewhaus' ); ?> <br><span style="color:var(--gold-light);">6:00am – 8:00pm</span></li>
                    <li><?php _e( 'Saturday', 'brewhaus' ); ?> <br><span style="color:var(--gold-light);">7:00am – 8:00pm</span></li>
                    <li><?php _e( 'Sunday', 'brewhaus' ); ?> <br><span style="color:var(--gold-light);">7:00am – 6:00pm</span></li>
                </ul>
            </div>

            <!-- Links Column -->
            <div class="footer-col">
                <h4><?php _e( 'Explore', 'brewhaus' ); ?></h4>
                <?php
                wp_nav_menu( [
                    'theme_location' => 'footer-1',
                    'container'      => false,
                    'depth'          => 1,
                    'fallback_cb'    => function() {
                        echo '<ul>';
                        $pages = [ 'Menu' => '/menu', 'About' => '/about', 'Blog' => '/blog', 'Contact' => '/contact', 'Order Online' => '/order' ];
                        foreach ( $pages as $label => $path ) {
                            echo '<li><a href="' . esc_url( home_url( $path ) ) . '">' . esc_html( $label ) . '</a></li>';
                        }
                        echo '</ul>';
                    },
                ] );
                ?>
            </div>

        </div><!-- .footer-top -->

        <div class="footer-bottom">
            <span>
                &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>.
                <?php _e( 'All rights reserved.', 'brewhaus' ); ?>
            </span>
            <span><?php _e( 'Crafted with care.', 'brewhaus' ); ?></span>
        </div>

    </div><!-- .container -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>
</body>
</html>
