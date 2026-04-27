<?php
/**
 * Template Name: Front Page
 * The homepage template for Brewhaus.
 */
get_header();
?>

<!-- =========================================================
     HERO
     ========================================================= -->
<section class="hero grain-overlay" id="hero">

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="hero__bg loaded" style="background-image: url('<?php the_post_thumbnail_url( 'brewhaus-hero' ); ?>');" aria-hidden="true"></div>
    <?php else : ?>
        <div class="hero__bg" id="heroBg" aria-hidden="true"></div>
    <?php endif; ?>

    <div class="hero__content">
        <p class="hero__eyebrow"><?php echo esc_html( brewhaus_option( 'address', 'Portland, Oregon' ) ); ?></p>

        <h1 class="hero__headline">
            <?php the_title(); ?>
            <?php if ( get_post_meta( get_the_ID(), '_hero_headline_em', true ) ) : ?>
                <em><?php echo esc_html( get_post_meta( get_the_ID(), '_hero_headline_em', true ) ); ?></em>
            <?php endif; ?>
        </h1>

        <p class="hero__sub">
            <?php echo esc_html( brewhaus_option( 'tagline', 'Specialty coffee roasted in-house. Seasonal menus. A place to slow down.' ) ); ?>
        </p>

        <div class="hero__actions">
            <a href="#menu" class="btn btn--primary"><?php _e( 'View Menu', 'brewhaus' ); ?></a>
            <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="btn btn--outline-light"><?php _e( 'Our Story', 'brewhaus' ); ?></a>
        </div>
    </div>

    <div class="hero__scroll">
        <div class="hero__stats">
            <div>
                <div class="hero__stat-num">2011</div>
                <div class="hero__stat-label"><?php _e( 'Founded', 'brewhaus' ); ?></div>
            </div>
            <div>
                <div class="hero__stat-num">18+</div>
                <div class="hero__stat-label"><?php _e( 'Origins', 'brewhaus' ); ?></div>
            </div>
            <div>
                <div class="hero__stat-num">4.9★</div>
                <div class="hero__stat-label"><?php _e( 'Google Rating', 'brewhaus' ); ?></div>
            </div>
        </div>
    </div>

</section>

<!-- =========================================================
     INTRO STRIP
     ========================================================= -->
<section class="intro section">
    <div class="container">
        <div class="intro__inner">
            <h2 class="intro__heading fade-up">
                <em>More than</em>
                <strong>a coffee shop.</strong>
            </h2>
            <div class="intro__text fade-up">
                <?php
                if ( have_posts() ) {
                    the_post();
                    the_excerpt();
                    rewind_posts();
                } else {
                    echo '<p>' . __( 'We source exceptional single-origin beans, roast them in small batches, and brew every cup with attention to craft and technique. Come for the coffee — stay for the community.', 'brewhaus' ) . '</p>';
                }
                ?>
                <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="btn btn--outline" style="margin-top:1.5rem;">
                    <?php _e( 'Learn More', 'brewhaus' ); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================
     MENU SECTION
     ========================================================= -->
<section class="menu-section section" id="menu">
    <div class="container">

        <div class="section-header fade-up">
            <span class="label"><?php _e( 'What We Serve', 'brewhaus' ); ?></span>
            <h2><?php _e( 'The Menu', 'brewhaus' ); ?></h2>
        </div>

        <?php
        // Get menu categories
        $menu_cats = get_terms( [
            'taxonomy'   => 'menu_category',
            'hide_empty' => true,
            'orderby'    => 'term_order',
        ] );

        // Fallback static categories if no CPT data yet
        if ( empty( $menu_cats ) || is_wp_error( $menu_cats ) ) :
        ?>

        <div class="menu-tabs">
            <button class="menu-tab active" data-panel="espresso"><?php _e( 'Espresso', 'brewhaus' ); ?></button>
            <button class="menu-tab" data-panel="drip"><?php _e( 'Drip & Pour', 'brewhaus' ); ?></button>
            <button class="menu-tab" data-panel="cold"><?php _e( 'Cold Brew', 'brewhaus' ); ?></button>
            <button class="menu-tab" data-panel="food"><?php _e( 'Food', 'brewhaus' ); ?></button>
        </div>

        <?php
        $static_menu = [
            'espresso' => [
                [ 'name' => 'Espresso',            'desc' => 'Double shot, bright and complex',     'price' => '$3.50' ],
                [ 'name' => 'Cortado',              'desc' => 'Equal parts espresso and milk',       'price' => '$4.00' ],
                [ 'name' => 'Flat White',           'desc' => 'Velvety microfoam, rich crema',       'price' => '$4.75' ],
                [ 'name' => 'Cappuccino',           'desc' => 'Classic Italian, dry or wet',         'price' => '$4.50' ],
                [ 'name' => 'Americano',            'desc' => 'Espresso with hot water',             'price' => '$3.75' ],
                [ 'name' => 'Latte',                'desc' => 'House or seasonal flavours',          'price' => '$5.25' ],
                [ 'name' => 'Macchiato',            'desc' => 'Espresso marked with a touch of foam','price' => '$4.25' ],
                [ 'name' => 'Mocha',                'desc' => 'Single-origin cacao, house espresso', 'price' => '$5.50' ],
            ],
            'drip' => [
                [ 'name' => 'House Drip',           'desc' => 'Rotating single-origin, daily fresh', 'price' => '$3.25' ],
                [ 'name' => 'Pour Over',            'desc' => 'Chemex or V60, your choice',          'price' => '$5.50' ],
                [ 'name' => 'French Press',         'desc' => 'Full-body, 4-minute steep',           'price' => '$4.75' ],
                [ 'name' => 'Aeropress',            'desc' => 'Smooth, low acidity',                 'price' => '$5.00' ],
            ],
            'cold' => [
                [ 'name' => 'Cold Brew',            'desc' => '18-hour steep, served over ice',     'price' => '$5.00' ],
                [ 'name' => 'Nitro Cold Brew',      'desc' => 'Creamy cascading nitrogen draft',    'price' => '$5.75' ],
                [ 'name' => 'Iced Latte',           'desc' => 'Espresso, milk, ice — done right',   'price' => '$5.25' ],
                [ 'name' => 'Cold Brew Tonic',      'desc' => 'Light, bright, effervescent',        'price' => '$5.75' ],
            ],
            'food' => [
                [ 'name' => 'Avocado Toast',        'desc' => 'Sourdough, pickled onion, chilli',   'price' => '$12.00' ],
                [ 'name' => 'Granola Bowl',         'desc' => 'House granola, yogurt, seasonal fruit','price' => '$9.50' ],
                [ 'name' => 'Butter Croissant',     'desc' => 'Freshly baked, all-butter pastry',   'price' => '$4.25' ],
                [ 'name' => 'Banana Bread',         'desc' => 'Walnut & dark chocolate',            'price' => '$4.00' ],
                [ 'name' => 'Egg & Cheese Bagel',   'desc' => 'Toasted everything bagel',           'price' => '$8.50' ],
                [ 'name' => 'Seasonal Salad',       'desc' => 'Ask your barista for today\'s',      'price' => '$11.00' ],
            ],
        ];

        foreach ( $static_menu as $panel => $items ) :
        ?>
        <div class="menu-panel<?php echo $panel === 'espresso' ? ' active' : ''; ?>" id="panel-<?php echo $panel; ?>">
            <?php foreach ( $items as $item ) : ?>
                <div class="menu-item">
                    <span class="menu-item__name"><?php echo esc_html( $item['name'] ); ?></span>
                    <span class="menu-item__price"><?php echo esc_html( $item['price'] ); ?></span>
                    <span class="menu-item__desc"><?php echo esc_html( $item['desc'] ); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?>

        <?php else : // Dynamic CPT menus ?>

        <div class="menu-tabs">
            <?php $first = true; foreach ( $menu_cats as $cat ) : ?>
                <button class="menu-tab<?php echo $first ? ' active' : ''; ?>"
                        data-panel="cat-<?php echo esc_attr( $cat->slug ); ?>">
                    <?php echo esc_html( $cat->name ); ?>
                </button>
            <?php $first = false; endforeach; ?>
        </div>

        <?php $first = true; foreach ( $menu_cats as $cat ) :
            $items_query = brewhaus_get_menu_items( $cat->slug );
        ?>
        <div class="menu-panel<?php echo $first ? ' active' : ''; ?>" id="panel-cat-<?php echo esc_attr( $cat->slug ); ?>">
            <?php if ( $items_query->have_posts() ) :
                while ( $items_query->have_posts() ) : $items_query->the_post(); ?>
                    <div class="menu-item">
                        <span class="menu-item__name"><?php the_title(); ?></span>
                        <span class="menu-item__price"><?php echo esc_html( get_post_meta( get_the_ID(), '_menu_item_price', true ) ); ?></span>
                        <span class="menu-item__desc"><?php the_excerpt(); ?></span>
                    </div>
                <?php endwhile; wp_reset_postdata();
            endif; ?>
        </div>
        <?php $first = false; endforeach; ?>

        <?php endif; ?>

        <div style="text-align:center;margin-top:3rem;">
            <a href="<?php echo esc_url( home_url( '/menu' ) ); ?>" class="btn btn--outline">
                <?php _e( 'Full Menu & Allergens', 'brewhaus' ); ?>
            </a>
        </div>

    </div>
</section>

<!-- =========================================================
     STORY
     ========================================================= -->
<section class="story" id="story">
    <div class="story__grid">
        <div class="story__image-col">
            <?php
            $story_img_id = get_theme_mod( 'brewhaus_story_image', 0 );
            if ( $story_img_id ) {
                echo wp_get_attachment_image( $story_img_id, 'brewhaus-wide', false, [ 'alt' => 'Our story' ] );
            } else {
                echo '<div style="width:100%;height:100%;background:var(--roast);display:flex;align-items:center;justify-content:center;">';
                // echo '<span style="font-family:var(--font-display);font-size:5rem;color:rgba(245,239,224,0.2);">☕</span>';
                echo '<img src="' . get_template_directory_uri() . '/assets/images/pexels-furknsaglam-1596977-7709077.jpg" alt="Story Image" style="width:100%;height:100%;object-fit:cover;">';
                echo '</div>';
            }
            ?>
        </div>
        <div class="story__content-col">
            <span class="label"><?php _e( 'Our Story', 'brewhaus' ); ?></span>
            <h2 style="margin-top:0.75rem;"><?php _e( 'Born from a passion for the perfect cup.', 'brewhaus' ); ?></h2>

            <blockquote class="story__quote">
                <?php echo esc_html( brewhaus_option( 'story_quote', 'Every cup tells the story of its origin.' ) ); ?>
            </blockquote>

            <p><?php _e( 'We started in 2011 with a single espresso machine, a handful of green beans, and a stubborn belief that great coffee should be accessible to everyone. Today we roast weekly, source directly from farms across Ethiopia, Colombia, Guatemala, and Indonesia, and pour every cup with the same care we had on day one.', 'brewhaus' ); ?></p>

            <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="btn btn--outline-light" style="margin-top:1.5rem;">
                <?php _e( 'Read the Full Story', 'brewhaus' ); ?>
            </a>
        </div>
    </div>
</section>

<!-- =========================================================
     SPECIALS
     ========================================================= -->
<?php
$specials_query = new WP_Query( [
    'post_type'      => 'special',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
] );

$static_specials = [
    [ 'num' => '01', 'icon' => '☀', 'title' => 'Seasonal Latte',   'desc' => 'Our ever-changing signature latte follows the seasons. Ask your barista what\'s on today.', 'price' => 'From $5.50' ],
    [ 'num' => '02', 'icon' => '⬡', 'title' => 'Single Origin',    'desc' => 'Each week we spotlight a new single-origin pour-over, with tasting notes on the chalkboard.', 'price' => '$5.50' ],
    [ 'num' => '03', 'icon' => '◑', 'title' => 'Cold Brew Flights', 'desc' => 'Three cold brews, three origins — side by side. Available Fridays through Sundays.', 'price' => '$12.00' ],
];
?>
<section class="specials section">
    <div class="container">
        <div class="section-header fade-up">
            <span class="label"><?php _e( 'Right Now', 'brewhaus' ); ?></span>
            <h2><?php _e( "Today's Specials", 'brewhaus' ); ?></h2>
        </div>

        <div class="specials-grid fade-up">
            <?php if ( $specials_query->have_posts() ) :
                while ( $specials_query->have_posts() ) : $specials_query->the_post();
                    $idx   = $specials_query->current_post + 1;
                    $price = get_post_meta( get_the_ID(), '_menu_item_price', true );
                    ?>
                    <div class="special-card">
                        <span class="special-card__num"><?php printf( '%02d', $idx ); ?></span>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="special-card__icon"><?php the_post_thumbnail( [48, 48] ); ?></div>
                        <?php endif; ?>
                        <h3 class="special-card__title"><?php the_title(); ?></h3>
                        <p class="special-card__desc"><?php the_excerpt(); ?></p>
                        <?php if ( $price ) : ?>
                            <span class="special-card__price"><?php echo esc_html( $price ); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endwhile; wp_reset_postdata();
            else :
                foreach ( $static_specials as $s ) : ?>
                    <div class="special-card">
                        <span class="special-card__num"><?php echo esc_html( $s['num'] ); ?></span>
                        <span class="special-card__icon"><?php echo $s['icon']; ?></span>
                        <h3 class="special-card__title"><?php echo esc_html( $s['title'] ); ?></h3>
                        <p class="special-card__desc"><?php echo esc_html( $s['desc'] ); ?></p>
                        <span class="special-card__price"><?php echo esc_html( $s['price'] ); ?></span>
                    </div>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>

<!-- =========================================================
     GALLERY
     ========================================================= -->
<?php if ( get_theme_mod( 'brewhaus_show_gallery', true ) ) : ?>
<section class="gallery">
    <div class="gallery__header fade-up">
        <span class="label" style="color:var(--gold-light);"><?php _e( 'The Atmosphere', 'brewhaus' ); ?></span>
        <h2><?php _e( 'Come As You Are', 'brewhaus' ); ?></h2>
    </div>
    <div class="gallery__grid">
        <?php
        $gallery_images = [];
for ( $i = 1; $i <= 5; $i++ ) {
    $img_id = get_theme_mod( "brewhaus_gallery_image_{$i}", 0 );
    if ( $img_id ) $gallery_images[] = $img_id;
}

if ( ! empty( $gallery_images ) ) :
    foreach ( $gallery_images as $img_id ) :
        echo '<div class="gallery__item">';
        echo wp_get_attachment_image( $img_id, 'brewhaus-gallery', false, [ 'loading' => 'lazy' ] );
        echo '</div>';
    endforeach;
else :
    for ( $i = 1; $i <= 5; $i++ ) : ?>
        <div class="gallery__item">
            <div style="width:100%;height:100%;background:var(--roast);opacity:<?php echo 0.4 + $i * 0.1; ?>;"></div>
        </div>
    <?php endfor;
endif;
        ?>
    </div>
</section>
<?php endif; ?>

<!-- =========================================================
     TESTIMONIALS
     ========================================================= -->
<section class="testimonials section" id="reviews">
    <div class="container">
        <div class="section-header fade-up" style="color:var(--cream);">
            <span class="label"><?php _e( 'What People Say', 'brewhaus' ); ?></span>
            <h2 style="color:var(--cream);"><?php _e( 'Loved by the community.', 'brewhaus' ); ?></h2>
        </div>

        <?php
        $testimonials_query = new WP_Query( [
            'post_type'      => 'testimonial',
            'posts_per_page' => 3,
            'post_status'    => 'publish',
        ] );

        $static_testimonials = [
            [ 'stars' => 5, 'text' => 'The best flat white I\'ve had outside of Melbourne. Creamy, balanced, and the atmosphere is absolutely wonderful.', 'author' => 'Sarah T. — Google Review' ],
            [ 'stars' => 5, 'text' => 'I come here every morning before work. The baristas know everyone by name. It feels like home.', 'author' => 'Marcus R. — Yelp' ],
            [ 'stars' => 5, 'text' => 'Their seasonal cold brew is something else. I drove 45 minutes just to try the summer citrus version. Worth it.', 'author' => 'Jamie L. — TripAdvisor' ],
        ];
        ?>

        <div class="testimonials-grid fade-up">
            <?php if ( $testimonials_query->have_posts() ) :
                while ( $testimonials_query->have_posts() ) : $testimonials_query->the_post();
                    $rating = get_post_meta( get_the_ID(), '_testimonial_rating', true ) ?: 5;
                    $author = get_post_meta( get_the_ID(), '_testimonial_author', true );
                    ?>
                    <div class="testimonial">
                        <?php echo brewhaus_stars( $rating ); ?>
                        <p class="testimonial__text"><?php echo wp_kses_post( get_the_content() ); ?></p>
                        <?php if ( $author ) : ?>
                            <span class="testimonial__author"><?php echo esc_html( $author ); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endwhile; wp_reset_postdata();
            else :
                foreach ( $static_testimonials as $t ) : ?>
                    <div class="testimonial">
                        <?php echo brewhaus_stars( $t['stars'] ); ?>
                        <p class="testimonial__text"><?php echo esc_html( $t['text'] ); ?></p>
                        <span class="testimonial__author"><?php echo esc_html( $t['author'] ); ?></span>
                    </div>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>

<!-- =========================================================
     BLOG POSTS
     ========================================================= -->
<?php
$blog_query = new WP_Query( [
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
] );

if ( $blog_query->have_posts() ) :
?>
<section class="blog-section section">
    <div class="container">
        <div class="section-header fade-up">
            <span class="label"><?php _e( 'From the Journal', 'brewhaus' ); ?></span>
            <h2><?php _e( 'Notes on Coffee', 'brewhaus' ); ?></h2>
        </div>

        <div class="post-grid">
            <?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
                <article class="post-card fade-up">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-card__thumb">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'brewhaus-card' ); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <p class="post-card__meta">
                        <?php echo get_the_date(); ?> &middot; <?php the_category( ', ' ); ?>
                    </p>
                    <h3 class="post-card__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <p class="post-card__excerpt"><?php the_excerpt(); ?></p>
                    <a href="<?php the_permalink(); ?>" class="post-card__link"><?php _e( 'Read More', 'brewhaus' ); ?></a>
                </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <div style="text-align:center;margin-top:3rem;">
            <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>" class="btn btn--outline">
                <?php _e( 'All Journal Entries', 'brewhaus' ); ?>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- =========================================================
     HOURS & LOCATION
     ========================================================= -->
<section class="location-section section" id="visit">
    <div class="container">
        <div class="section-header fade-up">
            <span class="label"><?php _e( 'Find Us', 'brewhaus' ); ?></span>
            <h2><?php _e( 'Hours & Location', 'brewhaus' ); ?></h2>
        </div>

        <div class="location-grid">
            <div class="fade-up">
                <p style="font-size:1.1rem;color:var(--roast);margin-bottom:2rem;">
                    <?php echo esc_html( brewhaus_option( 'address', '123 Bean Street, Portland OR 97201' ) ); ?>
                </p>
                <table class="hours-table">
                    <tbody>
                        <tr class="<?php echo date('N') <= 5 ? 'today' : ''; ?>">
                            <td><?php _e( 'Monday – Friday', 'brewhaus' ); ?></td>
                            <td>6:00am – 8:00pm</td>
                        </tr>
                        <tr class="<?php echo date('N') == 6 ? 'today' : ''; ?>">
                            <td><?php _e( 'Saturday', 'brewhaus' ); ?></td>
                            <td>7:00am – 8:00pm</td>
                        </tr>
                        <tr class="<?php echo date('N') == 7 ? 'today' : ''; ?>">
                            <td><?php _e( 'Sunday', 'brewhaus' ); ?></td>
                            <td>7:00am – 6:00pm</td>
                        </tr>
                        <tr>
                            <td><?php _e( 'Public Holidays', 'brewhaus' ); ?></td>
                            <td>8:00am – 4:00pm</td>
                        </tr>
                    </tbody>
                </table>
                <a href="https://maps.google.com/?q=<?php echo urlencode( brewhaus_option( 'address', '123 Bean Street Portland' ) ); ?>"
                   target="_blank" rel="noopener noreferrer"
                   class="btn btn--outline" style="margin-top:2rem;">
                    <?php _e( 'Get Directions', 'brewhaus' ); ?>
                </a>
            </div>

            <div class="map-placeholder fade-up">
                <?php
                $embed = get_theme_mod( 'brewhaus_map_embed', '' );
                if ( $embed ) {
                    echo wp_kses( $embed, [ 'iframe' => [ 'src' => [], 'width' => [], 'height' => [], 'style' => [], 'allowfullscreen' => [], 'loading' => [], 'referrerpolicy' => [] ] ] );
                } else {
                    echo '<span>' . __( 'Map Embed Here', 'brewhaus' ) . '</span>';
                }
                ?>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================
     NEWSLETTER
     ========================================================= -->
<?php if ( get_theme_mod( 'brewhaus_show_newsletter', true ) ) : ?>
<section class="newsletter section">
    <div class="container">
        <div class="newsletter__inner fade-up">
            <span class="label"><?php _e( 'Stay in the Loop', 'brewhaus' ); ?></span>
            <h2 style="margin-top:0.75rem;"><?php _e( 'New roasts. Seasonal menus. Events.', 'brewhaus' ); ?></h2>
            <p><?php _e( 'Join our community and be the first to know what\'s brewing.', 'brewhaus' ); ?></p>

            <div class="newsletter__form" id="newsletter-form">
                <input type="email"
                       class="newsletter__input"
                       id="newsletter-email"
                       placeholder="<?php esc_attr_e( 'your@email.com', 'brewhaus' ); ?>"
                       required>
                <button type="button" class="newsletter__submit" id="newsletter-submit">
                    <?php _e( 'Subscribe', 'brewhaus' ); ?>
                </button>
            </div>
            <p id="newsletter-msg" style="font-family:var(--font-mono);font-size:0.7rem;letter-spacing:0.1em;margin-top:0.75rem;min-height:1.2em;"></p>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
