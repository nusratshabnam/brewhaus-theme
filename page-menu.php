<?php
/**
 * Template Name: Full Menu Page
 */
get_header();
?>

<main id="primary">

    <div class="page-hero grain-overlay section--dark">
        <div class="container">
            <span class="label"><?php _e( 'Brewhaus', 'brewhaus' ); ?></span>
            <h1 style="margin-top:.75rem;color:var(--cream);"><?php the_title(); ?></h1>
            <p style="color:rgba(245,239,224,0.7);max-width:50ch;margin-top:1rem;">
                <?php _e( 'Everything sourced with intent. Brewed to order. Seasonally inspired.', 'brewhaus' ); ?>
            </p>
        </div>
    </div>

    <?php
    $categories = get_terms( [ 'taxonomy' => 'menu_category', 'hide_empty' => true ] );

    if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) :
        foreach ( $categories as $cat ) :
            $items = brewhaus_get_menu_items( $cat->slug );
            if ( ! $items->have_posts() ) continue;
    ?>
    <section class="section" style="padding-bottom:0;">
        <div class="container">
            <div class="divider" style="margin-bottom:2rem;">
                <span class="divider-icon">◆</span>
            </div>
            <h2 style="margin-bottom:0.5rem;"><?php echo esc_html( $cat->name ); ?></h2>
            <?php if ( $cat->description ) : ?>
                <p style="color:var(--caramel);font-style:italic;margin-bottom:2rem;"><?php echo esc_html( $cat->description ); ?></p>
            <?php endif; ?>

            <div class="menu-panel active" style="display:grid;">
                <?php while ( $items->have_posts() ) : $items->the_post();
                    $price    = get_post_meta( get_the_ID(), '_menu_item_price', true );
                    $badge    = get_post_meta( get_the_ID(), '_menu_item_badge', true );
                ?>
                    <div class="menu-item">
                        <div>
                            <span class="menu-item__name"><?php the_title(); ?></span>
                            <?php if ( $badge ) : ?>
                                <span style="display:inline-block;margin-left:.5rem;font-family:var(--font-mono);font-size:.55rem;letter-spacing:.12em;text-transform:uppercase;padding:.2em .6em;background:var(--gold);color:var(--espresso);">
                                    <?php echo esc_html( $badge ); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <span class="menu-item__price"><?php echo esc_html( $price ); ?></span>
                        <span class="menu-item__desc"><?php the_excerpt(); ?></span>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endforeach;

    else : // No CPT — show static full menu ?>

    <?php
    $full_menu = [
        'Espresso Bar' => [
            [ 'name' => 'Espresso',         'desc' => 'Double shot, grown in Ethiopia Yirgacheffe',    'price' => '$3.50' ],
            [ 'name' => 'Ristretto',        'desc' => 'Short and concentrated, intense sweetness',     'price' => '$3.75' ],
            [ 'name' => 'Americano',        'desc' => 'Espresso with hot water, 8oz or 12oz',          'price' => '$3.75' ],
            [ 'name' => 'Cortado',          'desc' => 'Equal parts espresso and steamed milk',         'price' => '$4.00' ],
            [ 'name' => 'Flat White',       'desc' => 'Velvety microfoam, 5oz double ristretto',       'price' => '$4.75' ],
            [ 'name' => 'Cappuccino',       'desc' => 'Classic Italian — choose wet or dry foam',      'price' => '$4.50' ],
            [ 'name' => 'Latte',            'desc' => 'House milk or seasonal alternative, 12oz',      'price' => '$5.25' ],
            [ 'name' => 'Seasonal Latte',   'desc' => 'Ask your barista — changes weekly',             'price' => '$5.75' ],
            [ 'name' => 'Mocha',            'desc' => 'Single-origin cacao from Oaxaca',               'price' => '$5.50' ],
            [ 'name' => 'Macchiato',        'desc' => 'Espresso with a touch of steamed milk',         'price' => '$4.25' ],
        ],
        'Drip & Filter' => [
            [ 'name' => 'House Drip',       'desc' => 'Rotating single-origin, brewed fresh every hour','price' => '$3.25' ],
            [ 'name' => 'Pour Over (V60)',   'desc' => 'Choose your origin — 10 min preparation',      'price' => '$5.50' ],
            [ 'name' => 'Pour Over (Chemex)','desc' => 'Larger, clean and bright — great for sharing', 'price' => '$6.00' ],
            [ 'name' => 'AeroPress',        'desc' => 'Smooth, low-acid, 4-minute brew',               'price' => '$5.00' ],
            [ 'name' => 'French Press',     'desc' => 'Full body, bold flavour, 4-minute steep',       'price' => '$4.75' ],
            [ 'name' => 'Drip Refill',      'desc' => 'Free for the first two hours',                  'price' => '$1.00' ],
        ],
        'Cold & Iced' => [
            [ 'name' => 'Cold Brew',        'desc' => '18-hour slow-steep, smooth and chocolatey',    'price' => '$5.00' ],
            [ 'name' => 'Nitro Cold Brew',  'desc' => 'Creamy cascading nitrogen draft — no milk needed','price' => '$5.75' ],
            [ 'name' => 'Iced Latte',       'desc' => 'Double espresso over ice with your choice of milk','price' => '$5.25' ],
            [ 'name' => 'Cold Brew Tonic',  'desc' => 'Cold brew + tonic water + orange zest',        'price' => '$5.75' ],
            [ 'name' => 'Iced Matcha',      'desc' => 'Ceremonial grade, oat milk, dash of vanilla',  'price' => '$5.50' ],
            [ 'name' => 'Cold Brew Float',  'desc' => 'Cold brew + house-made vanilla bean ice cream', 'price' => '$7.00' ],
        ],
        'Non-Coffee' => [
            [ 'name' => 'Matcha Latte',     'desc' => 'Ceremonial grade, choose your milk',           'price' => '$5.00' ],
            [ 'name' => 'Chai Latte',       'desc' => 'House-blend spiced chai, oat milk',            'price' => '$4.75' ],
            [ 'name' => 'Turmeric Latte',   'desc' => 'Golden milk with ginger and black pepper',     'price' => '$5.00' ],
            [ 'name' => 'Hot Chocolate',    'desc' => 'Single-origin cacao, whole milk',              'price' => '$4.50' ],
            [ 'name' => 'Sparkling Water',  'desc' => 'San Pellegrino, 500ml',                        'price' => '$3.00' ],
        ],
        'Food' => [
            [ 'name' => 'Avocado Toast',    'desc' => 'Sourdough, smashed avo, pickled onion, dukkah','price' => '$12.00' ],
            [ 'name' => 'Granola Bowl',     'desc' => 'House-toasted granola, yogurt, seasonal fruit','price' => '$9.50' ],
            [ 'name' => 'Egg & Cheese Bagel','desc' => 'Everything bagel, scrambled eggs, aged cheddar','price' => '$8.50' ],
            [ 'name' => 'Butter Croissant', 'desc' => 'From local bakery, baked fresh each morning',  'price' => '$4.25' ],
            [ 'name' => 'Banana Bread',     'desc' => 'House-baked, walnut and dark chocolate chips', 'price' => '$4.00' ],
            [ 'name' => 'Seasonal Muffin',  'desc' => 'Ask your barista for today\'s flavour',        'price' => '$3.75' ],
            [ 'name' => 'Seasonal Salad',   'desc' => 'Market-driven, changes with the season',       'price' => '$11.00' ],
            [ 'name' => 'Soup of the Day',  'desc' => 'Served with house sourdough bread',            'price' => '$10.00' ],
        ],
    ];

    foreach ( $full_menu as $section => $items ) : ?>
    <section class="section" style="padding-bottom:1rem;">
        <div class="container">
            <div class="divider" style="margin-bottom:2rem;"><span class="divider-icon">◆</span></div>
            <h2 style="margin-bottom:2rem;"><?php echo esc_html( $section ); ?></h2>
            <div class="menu-panel active" style="display:grid;">
                <?php foreach ( $items as $item ) : ?>
                    <div class="menu-item">
                        <span class="menu-item__name"><?php echo esc_html( $item['name'] ); ?></span>
                        <span class="menu-item__price"><?php echo esc_html( $item['price'] ); ?></span>
                        <span class="menu-item__desc"><?php echo esc_html( $item['desc'] ); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endforeach;
    endif; ?>

    <div class="section" style="padding-top:2rem;">
        <div class="container" style="text-align:center;">
            <p style="font-family:var(--font-mono);font-size:0.7rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--caramel);">
                <?php _e( 'Prices include tax. Allergen info available on request. We can accommodate most dietary requirements — just ask.', 'brewhaus' ); ?>
            </p>
        </div>
    </div>

</main>

<?php get_footer(); ?>
