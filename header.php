<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="screen-reader-text" href="#primary"><?php _e( 'Skip to content', 'brewhaus' ); ?></a>

<header id="masthead" class="site-header<?php echo brewhaus_has_transparent_header() ? ' site-header--transparent' : ''; ?>" role="banner">
    <div class="container">
        <div class="site-header__inner">

            <!-- Logo -->
            <?php brewhaus_logo(); ?>

            <!-- Primary Nav -->
            <nav class="main-nav" id="main-nav" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'brewhaus' ); ?>">
                <?php
                wp_nav_menu( [
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'fallback_cb'    => 'brewhaus_fallback_menu',
                ] );
                ?>
            </nav>

            <!-- CTA -->
            <div class="header-cta">
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'order' ) ) ?: '#order' ); ?>"
                   class="btn btn--primary">
                    <?php _e( 'Order Now', 'brewhaus' ); ?>
                </a>
            </div>

            <!-- Mobile Toggle -->
            <button class="nav-toggle" id="nav-toggle" aria-expanded="false" aria-controls="main-nav" aria-label="<?php esc_attr_e( 'Toggle navigation', 'brewhaus' ); ?>">
                <span></span>
                <span></span>
                <span></span>
            </button>

        </div><!-- .site-header__inner -->
    </div><!-- .container -->
</header><!-- #masthead -->

<?php
function brewhaus_fallback_menu() {
    echo '<ul>';
    echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . __( 'Home', 'brewhaus' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/menu' ) ) . '">' . __( 'Menu', 'brewhaus' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/about' ) ) . '">' . __( 'About', 'brewhaus' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/contact' ) ) . '">' . __( 'Contact', 'brewhaus' ) . '</a></li>';
    echo '</ul>';
}
