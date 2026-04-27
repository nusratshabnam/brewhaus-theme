<?php get_header(); ?>

<main id="primary" class="site-main">

    <?php while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="page-hero<?php echo has_post_thumbnail() ? ' grain-overlay' : ''; ?>">
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="page-hero__bg" style="background-image:url('<?php the_post_thumbnail_url( 'brewhaus-hero' ); ?>');" aria-hidden="true"></div>
            <?php endif; ?>
            <div class="container">
                <span class="label">
                    <?php echo get_the_date(); ?>
                    <?php $cats = get_the_category(); if ( $cats ) echo ' &middot; ' . esc_html( $cats[0]->name ); ?>
                </span>
                <h1 style="margin-top:0.75rem;"><?php the_title(); ?></h1>
                <p style="color:rgba(245,239,224,0.7);margin-top:1rem;">
                    <?php printf( __( 'By %s', 'brewhaus' ), get_the_author() ); ?>
                    &middot; <?php echo esc_html( ceil( str_word_count( get_the_content() ) / 200 ) ); ?> <?php _e( 'min read', 'brewhaus' ); ?>
                </p>
            </div>
        </div>

        <div class="post-content">
            <?php the_content(); ?>
            <?php
            wp_link_pages( [
                'before' => '<div class="page-links">' . __( 'Pages:', 'brewhaus' ),
                'after'  => '</div>',
            ] );
            ?>
        </div>

        <div style="max-width:720px;margin:0 auto;padding:0 clamp(1.25rem,5vw,3rem) 3rem;border-top:1px solid var(--cream-dark);padding-top:2rem;">
            <?php the_tags( '<div style="display:flex;gap:.5rem;flex-wrap:wrap;align-items:center;"><span class="label" style="margin-right:.5rem;">Tags</span>', '', '</div>' ); ?>

            <div style="display:flex;justify-content:space-between;margin-top:2rem;">
                <?php previous_post_link( '<div>← %link</div>' ); ?>
                <?php next_post_link( '<div>%link →</div>' ); ?>
            </div>
        </div>

        <?php if ( comments_open() || get_comments_number() ) : ?>
            <div style="max-width:720px;margin:0 auto;padding:0 clamp(1.25rem,5vw,3rem) 4rem;">
                <?php comments_template(); ?>
            </div>
        <?php endif; ?>

    </article>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>
