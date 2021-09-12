<?php
$blog_info    = get_bloginfo('name');
$description  = get_bloginfo('description', 'display');
?>
<!doctype html>
<html <?php language_attributes(); ?> >
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="<?php echo $description ?>">
    <title><?php echo $blog_info ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header class="container mt-2">
        <div class="row align-items-center">
            <div class="site-branding col col-md-2 text-center">
                <div class="site-logo">
                    <?php if ( has_custom_logo() ) : ?>
                            <?php the_custom_logo(); ?>
                    <?php endif; ?>
                    <?php if ( $blog_info ) : ?>
                        <h1 class="text-center m-0">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-dark text-decoration-none">
                                <?php echo esc_html( $blog_info ); ?>
                            </a>
                        </h1>
                    <?php endif; ?>
                    <?php if ( $description && true === get_theme_mod( 'display_title_and_tagline', true ) ) : ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-dark text-decoration-none">
                            <p class="site-description text-center">
                                <?php echo $description; // phpcs:ignore WordPress.Security.EscapeOutput ?>
                            </p>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ( has_nav_menu( 'primary' ) ) : ?>
                <nav id="site-navigation" class="primary-navigation navbar navbar-expand-lg navbar-light col col-md-8" role="navigation" aria-label="<?php esc_attr_e( 'Primary menu', 'ourlabtheme' ); ?>">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPrimary" aria-controls="navbarPrimary" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location'  => 'primary',
                            'menu_class'      => 'menu-wrapper navbar-nav',
                            'container_class' => 'primary-menu-container collapse navbar-collapse justify-content-md-center',
                            'container_id'    => 'navbarPrimary',
                            'item_class'    => 'nav-item',
                            'link_class'  => 'nav-link text-dark',
                            'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
                            'fallback_cb'     => false,
                        )
                    );
                    ?>
                </nav><!-- #site-navigation -->
            <?php endif; ?>
            <div class="col col-md-2 d-none d-md-block">
                <div>
                    <?php if (get_theme_mod('secondary_theme_logo')): ?>
                    <img src="<?php echo get_theme_mod( 'secondary_theme_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" >
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    <main id="content" class="site-content container">