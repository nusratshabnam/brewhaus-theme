<?php
/**
 * Brewhaus Theme Functions
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'BREWHAUS_VERSION', '1.0.0' );
define( 'BREWHAUS_DIR', get_template_directory() );
define( 'BREWHAUS_URI', get_template_directory_uri() );

/* =========================================================
   THEME SETUP
   ========================================================= */
function brewhaus_setup() {
    load_theme_textdomain( 'brewhaus', BREWHAUS_DIR . '/languages' );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'responsive-embeds' );

    add_theme_support( 'custom-logo', [
        'height'      => 80,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ] );

    // Image sizes
    add_image_size( 'brewhaus-hero',    1920, 1080, true );
    add_image_size( 'brewhaus-card',    800,  600,  true );
    add_image_size( 'brewhaus-thumb',   400,  300,  true );
    add_image_size( 'brewhaus-gallery', 600,  600,  true );
    add_image_size( 'brewhaus-wide',    1400, 600,  true );

    // Navigation menus
    register_nav_menus( [
        'primary'  => __( 'Primary Navigation', 'brewhaus' ),
        'footer-1' => __( 'Footer Column 1', 'brewhaus' ),
        'footer-2' => __( 'Footer Column 2', 'brewhaus' ),
    ] );
}
add_action( 'after_setup_theme', 'brewhaus_setup' );

/* =========================================================
   ENQUEUE SCRIPTS & STYLES
   ========================================================= */
function brewhaus_scripts() {
    wp_enqueue_style(
        'brewhaus-style',
        get_stylesheet_uri(),
        [],
        BREWHAUS_VERSION
    );

    wp_enqueue_script(
        'brewhaus-main',
        BREWHAUS_URI . '/assets/js/main.js',
        [],
        BREWHAUS_VERSION,
        true
    );

    wp_localize_script( 'brewhaus-main', 'BrewhausData', [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'brewhaus_nonce' ),
    ] );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'brewhaus_scripts' );

/* =========================================================
   CONTENT WIDTH
   ========================================================= */
function brewhaus_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'brewhaus_content_width', 1280 );
}
add_action( 'after_setup_theme', 'brewhaus_content_width', 0 );

/* =========================================================
   REGISTER WIDGET AREAS
   ========================================================= */
function brewhaus_widgets_init() {
    register_sidebar( [
        'name'          => __( 'Sidebar', 'brewhaus' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here.', 'brewhaus' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title label">',
        'after_title'   => '</h2>',
    ] );

    register_sidebar( [
        'name'          => __( 'Footer Widget Area', 'brewhaus' ),
        'id'            => 'footer-widget',
        'description'   => __( 'Footer widgets.', 'brewhaus' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title label">',
        'after_title'   => '</h4>',
    ] );
}
add_action( 'widgets_init', 'brewhaus_widgets_init' );

/* =========================================================
   CUSTOM POST TYPES
   ========================================================= */
function brewhaus_register_post_types() {

    // Menu Items
    register_post_type( 'menu_item', [
        'labels'             => [
            'name'               => __( 'Menu Items', 'brewhaus' ),
            'singular_name'      => __( 'Menu Item', 'brewhaus' ),
            'add_new'            => __( 'Add Menu Item', 'brewhaus' ),
            'add_new_item'       => __( 'Add New Menu Item', 'brewhaus' ),
            'edit_item'          => __( 'Edit Menu Item', 'brewhaus' ),
        ],
        'public'             => true,
        'has_archive'        => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-coffee',
        'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
        'rewrite'            => [ 'slug' => 'menu' ],
    ] );

    // Testimonials
    register_post_type( 'testimonial', [
        'labels'             => [
            'name'          => __( 'Testimonials', 'brewhaus' ),
            'singular_name' => __( 'Testimonial', 'brewhaus' ),
            'add_new_item'  => __( 'Add New Testimonial', 'brewhaus' ),
        ],
        'public'             => false,
        'show_ui'            => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-star-filled',
        'supports'           => [ 'title', 'editor', 'custom-fields' ],
    ] );

    // Specials / Offers
    register_post_type( 'special', [
        'labels'             => [
            'name'          => __( 'Specials', 'brewhaus' ),
            'singular_name' => __( 'Special', 'brewhaus' ),
            'add_new_item'  => __( 'Add New Special', 'brewhaus' ),
        ],
        'public'             => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-tag',
        'supports'           => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
        'rewrite'            => [ 'slug' => 'specials' ],
    ] );
}
add_action( 'init', 'brewhaus_register_post_types' );

/* =========================================================
   CUSTOM TAXONOMIES
   ========================================================= */
function brewhaus_register_taxonomies() {

    // Menu Category (Espresso, Drip, Cold Brew, Food, etc.)
    register_taxonomy( 'menu_category', 'menu_item', [
        'labels'            => [
            'name'          => __( 'Menu Categories', 'brewhaus' ),
            'singular_name' => __( 'Menu Category', 'brewhaus' ),
        ],
        'hierarchical'      => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'rewrite'           => [ 'slug' => 'menu-category' ],
    ] );
}
add_action( 'init', 'brewhaus_register_taxonomies' );

/* =========================================================
   CUSTOM META BOXES
   ========================================================= */
function brewhaus_add_meta_boxes() {

    add_meta_box(
        'brewhaus_menu_item_details',
        __( 'Menu Item Details', 'brewhaus' ),
        'brewhaus_menu_item_meta_box',
        'menu_item',
        'normal',
        'high'
    );

    add_meta_box(
        'brewhaus_testimonial_details',
        __( 'Testimonial Details', 'brewhaus' ),
        'brewhaus_testimonial_meta_box',
        'testimonial',
        'normal',
        'high'
    );

    add_meta_box(
        'brewhaus_page_settings',
        __( 'Page Settings', 'brewhaus' ),
        'brewhaus_page_settings_meta_box',
        'page',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'brewhaus_add_meta_boxes' );

function brewhaus_menu_item_meta_box( $post ) {
    wp_nonce_field( 'brewhaus_menu_item_nonce', 'brewhaus_menu_item_nonce' );
    $price       = get_post_meta( $post->ID, '_menu_item_price', true );
    $price_small = get_post_meta( $post->ID, '_menu_item_price_small', true );
    $price_large = get_post_meta( $post->ID, '_menu_item_price_large', true );
    $badge       = get_post_meta( $post->ID, '_menu_item_badge', true );
    $featured    = get_post_meta( $post->ID, '_menu_item_featured', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="menu_item_price"><?php _e( 'Price', 'brewhaus' ); ?></label></th>
            <td><input type="text" id="menu_item_price" name="menu_item_price" value="<?php echo esc_attr( $price ); ?>" class="regular-text" placeholder="e.g. $4.50" /></td>
        </tr>
        <tr>
            <th><label for="menu_item_price_small"><?php _e( 'Price (Small)', 'brewhaus' ); ?></label></th>
            <td><input type="text" id="menu_item_price_small" name="menu_item_price_small" value="<?php echo esc_attr( $price_small ); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="menu_item_price_large"><?php _e( 'Price (Large)', 'brewhaus' ); ?></label></th>
            <td><input type="text" id="menu_item_price_large" name="menu_item_price_large" value="<?php echo esc_attr( $price_large ); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="menu_item_badge"><?php _e( 'Badge', 'brewhaus' ); ?></label></th>
            <td>
                <select id="menu_item_badge" name="menu_item_badge">
                    <option value=""><?php _e( 'None', 'brewhaus' ); ?></option>
                    <option value="new" <?php selected( $badge, 'new' ); ?>><?php _e( 'New', 'brewhaus' ); ?></option>
                    <option value="popular" <?php selected( $badge, 'popular' ); ?>><?php _e( 'Popular', 'brewhaus' ); ?></option>
                    <option value="seasonal" <?php selected( $badge, 'seasonal' ); ?>><?php _e( 'Seasonal', 'brewhaus' ); ?></option>
                    <option value="vegan" <?php selected( $badge, 'vegan' ); ?>><?php _e( 'Vegan', 'brewhaus' ); ?></option>
                </select>
            </td>
        </tr>
        <tr>
            <th><?php _e( 'Featured', 'brewhaus' ); ?></th>
            <td><label><input type="checkbox" name="menu_item_featured" value="1" <?php checked( $featured, '1' ); ?> /> <?php _e( 'Show on homepage', 'brewhaus' ); ?></label></td>
        </tr>
    </table>
    <?php
}

function brewhaus_testimonial_meta_box( $post ) {
    wp_nonce_field( 'brewhaus_testimonial_nonce', 'brewhaus_testimonial_nonce' );
    $author  = get_post_meta( $post->ID, '_testimonial_author', true );
    $rating  = get_post_meta( $post->ID, '_testimonial_rating', true );
    $source  = get_post_meta( $post->ID, '_testimonial_source', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="testimonial_author"><?php _e( 'Customer Name', 'brewhaus' ); ?></label></th>
            <td><input type="text" id="testimonial_author" name="testimonial_author" value="<?php echo esc_attr( $author ); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="testimonial_rating"><?php _e( 'Rating (1–5)', 'brewhaus' ); ?></label></th>
            <td>
                <select id="testimonial_rating" name="testimonial_rating">
                    <?php for ( $i = 5; $i >= 1; $i-- ) : ?>
                        <option value="<?php echo $i; ?>" <?php selected( $rating, $i ); ?>><?php echo $i; ?> ★</option>
                    <?php endfor; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="testimonial_source"><?php _e( 'Source', 'brewhaus' ); ?></label></th>
            <td>
                <select id="testimonial_source" name="testimonial_source">
                    <option value="google" <?php selected( $source, 'google' ); ?>>Google</option>
                    <option value="yelp" <?php selected( $source, 'yelp' ); ?>>Yelp</option>
                    <option value="tripadvisor" <?php selected( $source, 'tripadvisor' ); ?>>TripAdvisor</option>
                    <option value="direct" <?php selected( $source, 'direct' ); ?>>Direct</option>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

function brewhaus_page_settings_meta_box( $post ) {
    wp_nonce_field( 'brewhaus_page_nonce', 'brewhaus_page_nonce' );
    $transparent_header = get_post_meta( $post->ID, '_transparent_header', true );
    $hero_subtitle      = get_post_meta( $post->ID, '_hero_subtitle', true );
    ?>
    <p>
        <label><strong><?php _e( 'Transparent Header', 'brewhaus' ); ?></strong></label><br>
        <input type="checkbox" name="transparent_header" value="1" <?php checked( $transparent_header, '1' ); ?> />
        <?php _e( 'Enable on this page', 'brewhaus' ); ?>
    </p>
    <p>
        <label for="hero_subtitle"><strong><?php _e( 'Page Subtitle / Eyebrow', 'brewhaus' ); ?></strong></label><br>
        <input type="text" id="hero_subtitle" name="hero_subtitle" value="<?php echo esc_attr( $hero_subtitle ); ?>" style="width:100%" />
    </p>
    <?php
}

/* =========================================================
   SAVE META BOXES
   ========================================================= */
function brewhaus_save_meta_boxes( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    // Menu item
    if ( isset( $_POST['brewhaus_menu_item_nonce'] ) && wp_verify_nonce( $_POST['brewhaus_menu_item_nonce'], 'brewhaus_menu_item_nonce' ) ) {
        $fields = [ 'menu_item_price', 'menu_item_price_small', 'menu_item_price_large', 'menu_item_badge' ];
        foreach ( $fields as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[ $field ] ) );
            }
        }
        update_post_meta( $post_id, '_menu_item_featured', isset( $_POST['menu_item_featured'] ) ? '1' : '0' );
    }

    // Testimonial
    if ( isset( $_POST['brewhaus_testimonial_nonce'] ) && wp_verify_nonce( $_POST['brewhaus_testimonial_nonce'], 'brewhaus_testimonial_nonce' ) ) {
        $fields = [ 'testimonial_author', 'testimonial_rating', 'testimonial_source' ];
        foreach ( $fields as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[ $field ] ) );
            }
        }
    }

    // Page settings
    if ( isset( $_POST['brewhaus_page_nonce'] ) && wp_verify_nonce( $_POST['brewhaus_page_nonce'], 'brewhaus_page_nonce' ) ) {
        update_post_meta( $post_id, '_transparent_header', isset( $_POST['transparent_header'] ) ? '1' : '0' );
        if ( isset( $_POST['hero_subtitle'] ) ) {
            update_post_meta( $post_id, '_hero_subtitle', sanitize_text_field( $_POST['hero_subtitle'] ) );
        }
    }
}
add_action( 'save_post', 'brewhaus_save_meta_boxes' );

/* =========================================================
   CUSTOMIZER SETTINGS
   ========================================================= */
function brewhaus_customize_register( $wp_customize ) {

    // ── Coffee Shop Info ──
    $wp_customize->add_section( 'brewhaus_info', [
        'title'    => __( 'Coffee Shop Info', 'brewhaus' ),
        'priority' => 30,
    ] );

    $info_fields = [
        'address'     => [ 'label' => 'Address',       'default' => '123 Bean Street, Portland OR 97201' ],
        'phone'       => [ 'label' => 'Phone',         'default' => '(503) 555-0142' ],
        'email'       => [ 'label' => 'Email',         'default' => 'hello@brewhaus.com' ],
        'hours_text'  => [ 'label' => 'Hours Summary', 'default' => 'Mon–Fri 6am–8pm · Sat–Sun 7am–7pm' ],
        'tagline'     => [ 'label' => 'Hero Tagline',  'default' => 'Brewed with intention, served with care.' ],
        'story_quote' => [ 'label' => 'Story Quote',   'default' => 'Every cup tells the story of its origin.' ],
    ];

    foreach ( $info_fields as $id => $args ) {
        $wp_customize->add_setting( "brewhaus_{$id}", [
            'default'           => $args['default'],
            'sanitize_callback' => 'sanitize_text_field',
        ] );
        $wp_customize->add_control( "brewhaus_{$id}", [
            'label'   => __( $args['label'], 'brewhaus' ),
            'section' => 'brewhaus_info',
            'type'    => 'text',
        ] );
    }

    // ── Social Links ──
    $wp_customize->add_section( 'brewhaus_social', [
        'title'    => __( 'Social Links', 'brewhaus' ),
        'priority' => 35,
    ] );

    foreach ( [ 'instagram', 'facebook', 'twitter', 'tiktok' ] as $platform ) {
        $wp_customize->add_setting( "brewhaus_{$platform}", [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ] );
        $wp_customize->add_control( "brewhaus_{$platform}", [
            'label'   => ucfirst( $platform ) . ' URL',
            'section' => 'brewhaus_social',
            'type'    => 'url',
        ] );
    }

    // Story Image Section
    $wp_customize->add_section( 'brewhaus_story_image_add', array(
        'title'    => 'Brewhaus Story Image',
        'priority' => 30,
    ));

    // Add Setting
    $wp_customize->add_setting( 'brewhaus_story_image', array(
        'default' => '',
        'sanitize_callback' => 'absint'
    ));

    // Add Control (Upload Image)
    $wp_customize->add_control(
        new WP_Customize_Media_Control(
            $wp_customize,
            'brewhaus_story_image',
            array(
                'label' => 'Story Image',
                'section' => 'brewhaus_story_image_add',
                'mime_type' => 'image',
            )
        )
    );

// ── Gallery Images ──
$wp_customize->add_section( 'brewhaus_gallery', [
    'title'    => __( 'Gallery Images', 'brewhaus' ),
    'priority' => 45,
] );

// Gallery image slots (up to 5)
for ( $i = 1; $i <= 5; $i++ ) :
    $wp_customize->add_setting( "brewhaus_gallery_image_{$i}", [
        'default'           => '',
        'sanitize_callback' => 'absint',
    ] );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "brewhaus_gallery_image_{$i}", [
        'label'     => sprintf( __( 'Gallery Image %d', 'brewhaus' ), $i ),
        'section'   => 'brewhaus_gallery',
        'mime_type' => 'image',
    ] ) );
endfor;


    // ── Homepage Sections ──
    $wp_customize->add_section( 'brewhaus_homepage', [
        'title'    => __( 'Homepage Settings', 'brewhaus' ),
        'priority' => 40,
    ] );

    $wp_customize->add_setting( 'brewhaus_show_newsletter', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ] );
    $wp_customize->add_control( 'brewhaus_show_newsletter', [
        'label'   => __( 'Show Newsletter Section', 'brewhaus' ),
        'section' => 'brewhaus_homepage',
        'type'    => 'checkbox',
    ] );

    $wp_customize->add_setting( 'brewhaus_show_gallery', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ] );
    $wp_customize->add_control( 'brewhaus_show_gallery', [
        'label'   => __( 'Show Gallery Section', 'brewhaus' ),
        'section' => 'brewhaus_homepage',
        'type'    => 'checkbox',
    ] );
}
add_action( 'customize_register', 'brewhaus_customize_register' );



/* =========================================================
   TEMPLATE TAGS / HELPERS
   ========================================================= */

/**
 * Get customizer option with fallback.
 */
function brewhaus_option( $key, $fallback = '' ) {
    return get_theme_mod( "brewhaus_{$key}", $fallback );
}

/**
 * Render star rating HTML.
 */
function brewhaus_stars( $rating = 5 ) {
    $stars = '';
    for ( $i = 0; $i < 5; $i++ ) {
        $stars .= $i < (int) $rating ? '★' : '☆';
    }
    return '<span class="testimonial__stars" aria-label="' . esc_attr( $rating ) . ' out of 5">' . $stars . '</span>';
}

/**
 * Output the site logo or text fallback.
 */
function brewhaus_logo() {
    if ( has_custom_logo() ) {
        the_custom_logo();
    } else {
        echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="site-logo" rel="home">';
        echo '<span class="site-logo__name">' . esc_html( get_bloginfo( 'name' ) ) . '</span>';
        $desc = get_bloginfo( 'description' );
        if ( $desc ) {
            echo '<span class="site-logo__tagline">' . esc_html( $desc ) . '</span>';
        }
        echo '</a>';
    }
}

/**
 * Return menu items for a given category slug.
 */
function brewhaus_get_menu_items( $category_slug = '', $limit = -1 ) {
    $args = [
        'post_type'      => 'menu_item',
        'posts_per_page' => $limit,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ];
    if ( $category_slug ) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'menu_category',
                'field'    => 'slug',
                'terms'    => $category_slug,
            ],
        ];
    }
    return new WP_Query( $args );
}

/**
 * Check if current page should have a transparent header.
 */
function brewhaus_has_transparent_header() {
    if ( is_front_page() ) return true;
    if ( is_singular() ) {
        return get_post_meta( get_the_ID(), '_transparent_header', true ) === '1';
    }
    return false;
}

/* =========================================================
   EXCERPT LENGTH
   ========================================================= */
function brewhaus_excerpt_length( $length ) {
    return is_admin() ? $length : 22;
}
add_filter( 'excerpt_length', 'brewhaus_excerpt_length' );

function brewhaus_excerpt_more( $more ) {
    return '&hellip;';
}
add_filter( 'excerpt_more', 'brewhaus_excerpt_more' );

/* =========================================================
   AJAX: NEWSLETTER SIGNUP
   ========================================================= */
function brewhaus_newsletter_signup() {
    check_ajax_referer( 'brewhaus_nonce', 'nonce' );

    $email = sanitize_email( $_POST['email'] ?? '' );

    if ( ! is_email( $email ) ) {
        wp_send_json_error( [ 'message' => __( 'Please enter a valid email address.', 'brewhaus' ) ] );
    }

    // Hook into your preferred email service here (Mailchimp, etc.)
    // For now, store in options as a simple CSV list.
    $subscribers = get_option( 'brewhaus_subscribers', [] );
    if ( ! in_array( $email, $subscribers ) ) {
        $subscribers[] = $email;
        update_option( 'brewhaus_subscribers', $subscribers );
    }

    wp_send_json_success( [ 'message' => __( 'Thank you! You\'re on the list.', 'brewhaus' ) ] );
}
add_action( 'wp_ajax_brewhaus_newsletter',        'brewhaus_newsletter_signup' );
add_action( 'wp_ajax_nopriv_brewhaus_newsletter', 'brewhaus_newsletter_signup' );

/* =========================================================
   ADMIN: COLUMN TWEAKS
   ========================================================= */
function brewhaus_menu_item_columns( $columns ) {
    return array_merge(
        array_slice( $columns, 0, 2, true ),
        [ 'price' => __( 'Price', 'brewhaus' ), 'featured' => __( 'Featured', 'brewhaus' ) ],
        array_slice( $columns, 2, null, true )
    );
}
add_filter( 'manage_menu_item_posts_columns', 'brewhaus_menu_item_columns' );

function brewhaus_menu_item_column_content( $column, $post_id ) {
    if ( $column === 'price' ) {
        echo esc_html( get_post_meta( $post_id, '_menu_item_price', true ) ?: '—' );
    }
    if ( $column === 'featured' ) {
        echo get_post_meta( $post_id, '_menu_item_featured', true ) === '1' ? '✓' : '—';
    }
}
add_action( 'manage_menu_item_posts_custom_column', 'brewhaus_menu_item_column_content', 10, 2 );
