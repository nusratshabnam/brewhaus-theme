<?php get_header(); ?>

<main id="primary" class="site-main">

    <?php while ( have_posts() ) : the_post(); ?>

    <div class="page-hero<?php echo has_post_thumbnail() ? ' grain-overlay' : ''; ?>">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="page-hero__bg" style="background-image:url('<?php the_post_thumbnail_url( 'brewhaus-hero' ); ?>');" aria-hidden="true"></div>
        <?php endif; ?>
        <div class="container">
            <?php
            $subtitle = get_post_meta( get_the_ID(), '_hero_subtitle', true );
            if ( $subtitle ) echo '<span class="label">' . esc_html( $subtitle ) . '</span>';
            ?>
            <h1 style="margin-top:.75rem;"><?php the_title(); ?></h1>
        </div>
    </div>

    <article id="page-<?php the_ID(); ?>" <?php post_class( 'post-content' ); ?>>
        <?php the_content(); ?>
        <?php wp_link_pages(); ?>
    </article>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>
