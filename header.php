<!doctype html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
    <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php wp_title('&mdash;', true, 'right'); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <!-- <meta name="viewport" content="width=device-width"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <?php wp_head(); ?>
        <script src="<?php bloginfo('template_url'); ?>/js/leaflet.js"></script>
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/leaflet.css">
        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/angular-leaflet-directive.min.js"></script>


        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/menu.css">
        <script src="<?php bloginfo('template_url'); ?>/js/menu.js"></script>
        
        
    </head>

    <body <?php body_class(); ?>>
    
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.4";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        window.___gcfg = {lang: 'pt-BR'};

          (function() {
                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                po.src = 'https://apis.google.com/js/platform.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
          })();
        </script>

        <?php do_action('before'); ?>

        <header class="site-header wrap">
            <a href="#main" title="<?php esc_attr_e('Ir para o conteúdo', 'cultural'); ?>" class="assistive-text"><?php _e('Ir para o conteúdo', 'cultural'); ?></a>

            <ul class="toggle-bar">
                <li><a href="#tabs-1" class="current main-toggle" data-tab="tab-1"><i class="fa fa-list-ul"></i></a></li>
                <?php if (is_active_sidebar('header-widget-area')) : ?>
                    <li><a href="#tab-2" class="highlights-toggle" data-tab="tab-2"><i class="fa fa-search"></i></a></li>
                <?php endif; ?>
                <li><a href="#tab-3" class="calendar-toggle" data-tab="tab-3"><i class="fa fa-calendar"></i></a></li>
                

                <div id="cssmenu">
                    <ul>
                        <li><a href="http://emcartaz.prefeitura.sp.gov.br/category/cinema/">CINEMA</a></li>
                        <li><a href="http://emcartaz.prefeitura.sp.gov.br/category/teatro-e-circo/">TEATRO E CIRCO</a></li>
                        <li><a href="http://emcartaz.prefeitura.sp.gov.br/category/musica/">MÚSICA</a></li>
                        <li><a href="http://emcartaz.prefeitura.sp.gov.br/category/exposicoes/">EXPOSIÇÕES</a></li>
                        <li><a href="http://emcartaz.prefeitura.sp.gov.br/category/garotada/">GAROTADA</a></li>
                        <li><a href="http://emcartaz.prefeitura.sp.gov.br/category/danca/">DANÇA</a></li>
                        <li><a href="http://emcartaz.prefeitura.sp.gov.br/category/palestras-debates-e-encontros/">PALESTRAS, DEBATES E ENCONTROS</a></li>
                        <li><a href="http://emcartaz.prefeitura.sp.gov.br/category/cursos-e-oficinas/">CURSOS E OFICINAS</a></li>
                        <li><a href="http://emcartaz.prefeitura.sp.gov.br/eventos/programacao-geral/">PROGRAMAÇÃO GERAL</a></li>
                        <li><a href="http://emcartaz.prefeitura.sp.gov.br/expediente/">QUEM SOMOS</a></li>
                        <li><a href="https://issuu.com/emcartaz/docs/emcartazmaio2016">REVISTA EM CARTAZ</a></li>
                        <li><a href="http://emcartaz.prefeitura.sp.gov.br/nossos-enderecos-3/">NOSSOS ENDEREÇOS</a></li>
                    </ul>
                </div>
            </ul>









            <div id="tabs" class="toggle-tabs">
                <div class="site-header-inside">
                    <!-- Logo, description and main navigation -->
                    <div id="tab-1" class="tab-content current animated fadeIn">
                        <div class="branding">
                            <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
                                <?php
                                $logo = get_theme_mod('site_logo');
                                if ($logo == ''):
                                    ?>
                                    <h1 class="site-title"><?php bloginfo('name'); ?></h1>
                                <?php else: ?>
                                    <img src="<?php echo esc_url($logo); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" />
                                <?php endif; ?>
                            </a>
                        </div>
                        <nav class="access cf js-access" role="navigation">
                            <?php
                            if (wp_is_mobile()) :
                                wp_nav_menu(array('theme_location' => 'mobile', 'container' => false, 'menu_class' => 'menu--mobile  menu', 'fallback_cb' => false));
                            else :
                                wp_nav_menu(array('theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu--main  menu', 'fallback_cb' => 'default_menu'));
                                wp_nav_menu(array('theme_location' => 'secondary', 'container' => false, 'menu_class' => 'menu--sub  menu', 'fallback_cb' => false));
                                ?>
                            <?php endif; ?>
                        </nav>
                    </div>



<?php 
                    $widgetNL = new WYSIJA_NL_Widget(true);
echo $widgetNL->widget(array('form' => 1, 'form_type' => 'php'));
?>


                    <div id="share-buttons">
                        <br>

                        <span>Redes Sociais:</span>
			

                        <a href="#" title="Facebook">
                        <a href="https://www.facebook.com/SaoPauloCultura" target="_blank">
                        <img src="http://emcartaz.prefeitura.sp.gov.br/arte/face.png" alt="Facebook">
                        </a>
                    <a href="#" title="Twitter">
                    <a href="https://twitter.com/smcsp" target="_blank">
                    <img src="http://emcartaz.prefeitura.sp.gov.br/arte/twi.png" alt="Twitter">
                    </a>
			<a href="https://www.instagram.com/smculturasp/" target="_blank">
 	 <img src="http://emcartaz.prefeitura.sp.gov.br/wp-content/themes/cultural-master/images/icon-instagram.png" alt="insta"/>
	 </a>
                    </div>

                    <?php if (is_active_sidebar('header-widget-area')) : ?>
                        <div id="tab-2" class="tab-content animated fadeIn">
                            <?php dynamic_sidebar('header-widget-area'); ?>
                        </div>
                    <?php endif; ?>

                    <div id="tab-3" class="tab-content animated fadeIn">
                        <?php get_template_part('inc/featured-posts'); ?>
                        <div class="tab__description">
                            <a href="#"><i class="fa fa-arrow-right"></i> Ver mais eventos</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="main  cf">
