<?php get_header(); ?>

<main id="primary" class="site-main">

    <div class="page-hero">
        <div class="container">
            <?php if ( is_category() ) : ?>
                <span class="label"><?php _e( 'Category', 'brewhaus' ); ?></span>
                <h1><?php single_cat_title(); ?></h1>
            <?php elseif ( is_tag() ) : ?>
                <span class="label"><?php _e( 'Tag', 'brewhaus' ); ?></span>
                <h1><?php single_tag_title(); ?></h1>
            <?php elseif ( is_author() ) : ?>
                <span class="label"><?php _e( 'Author', 'brewhaus' ); ?></span>
                <h1><?php the_author(); ?></h1>
            <?php elseif ( is_search() ) : ?>
                <span class="label"><?php _e( 'Search Results', 'brewhaus' ); ?></span>
                <h1><?php printf( __( 'Results for: %s', 'brewhaus' ), get_search_query() ); ?></h1>
            <?php else : ?>
                <span class="label"><?php _e( 'The Journal', 'brewhaus' ); ?></span>
                <h1><?php _e( 'Notes on Coffee', 'brewhaus' ); ?></h1>
            <?php endif; ?>
        </div>
    </div>

    <div class="section">
        <div class="container">

            <?php if ( have_posts() ) : ?>
                <div class="post-grid">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="post-card__thumb">
                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'brewhaus-card' ); ?></a>
                                </div>
                            <?php endif; ?>
                            <p class="post-card__meta"><?php echo get_the_date(); ?> &middot; <?php the_category( ', ' ); ?></p>
                            <h2 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p class="post-card__excerpt"><?php the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>" class="post-card__link"><?php _e( 'Read More', 'brewhaus' ); ?></a>
                        </article>
                    <?php endwhile; ?>
                </div>

                <div style="text-align:center;margin-top:3rem;">
                    <?php the_posts_pagination( [
                        'prev_text' => '← ' . __( 'Newer', 'brewhaus' ),
                        'next_text' => __( 'Older', 'brewhaus' ) . ' →',
                    ] ); ?>
                </div>

            <?php else : ?>
                <div style="text-align:center;padding:4rem 0;">
                    <p><?php _e( 'Nothing found. Try a different search?', 'brewhaus' ); ?></p>
                    <?php get_search_form(); ?>
                </div>
            <?php endif; ?>

        </div>
    </div>

</main>

<?php get_footer(); ?>
