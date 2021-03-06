<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page while offline.
 *
 * All the available variables are mirrored in page.tpl.php. Some may be left
 * blank but they are provided for consistency.
 *
 * @see template_preprocess()
 * @see template_preprocess_maintenance_page()
 */
global $base_url;
 
drupal_add_html_head(array(
	'#tag' => 'meta',
	'#attributes' => array(
		'property' => 'og:title',
		'content' => $site_name,
	),
), $site_name . '_og_title');
drupal_add_html_head(array(
    '#tag' => 'meta',
    '#attributes' => array(
      'property' => 'og:site_name”',
			'content' => $site_name,
    ),
  ), $site_name . '_site_name”');
drupal_add_html_head(array(
	'#tag' => 'meta',
	'#attributes' => array(
		'property' => 'og:description',
		'content' => "Bienvenue au Bistro32, le bistro à vins à la Garenne Colombes. Venez découvrir notre sélection de vins, nos planches de charcuterie ou fromages dans une ambiance conviviale",
    ),
), $site_name . '_og_description');
drupal_add_html_head(array(
	'#tag' => 'meta',
	'#attributes' => array(
		'property' => 'description',
		'content' => "Bienvenue au Bistro32, le bistro à vins à la Garenne Colombes. Venez découvrir notre sélection de vins, nos planches de charcuterie ou fromages dans une ambiance conviviale",
    ),
), $site_name . '_description');
drupal_add_html_head(array(
	'#tag' => 'meta',
	'#attributes' => array(
		'property' => 'og:image',
		'content' => $base_url . '/sites/all/themes/bistro32/images/logo-685x685.png',
		),
), $site_name . '_og_image');
drupal_add_html_head(array(
    '#tag' => 'meta',
    '#attributes' => array(
      'property' => 'og:url',
			'content' => $base_url,
    ),
  ), $site_name . '_url');
?>
<!DOCTYPE html>
<html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">

<head>
  <?php //print $head; ?>
  <?php drupal_set_title(t('Home')); ?>
  <?php //print $styles; ?>
  <?php //print $scripts; ?>
  <!--[if lt IE 9]><script src="<?php print base_path() . drupal_get_path('theme', 'impact_theme') . '/js/html5.js'; ?>"></script><![endif]-->
</head>

<body class="<?php print $classes; ?>" <?php print $attributes;?>>


<div id="wrapper" class="maintenance-page">
  <header id="header" class="clearfix">
    <?php if (theme_get_setting('image_logo','impact_theme')): ?>
      <?php if ($logo): ?><div id="site-logo">
        <img src="sites/all/themes/bistro32/images/logo-685x685.png" alt="<?php print t('Home'); ?>" />
      </div><?php endif; ?>
    <?php else: ?>
      <hgroup id="site-name-wrap">
        <h1 id="site-name">
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
            <span><?php print $site_name; ?></span>
          </a>
        </h1>
        <?php if ($site_slogan): ?><h2 id="site-slogan"><?php print $site_slogan; ?></h2><?php endif; ?>
      </hgroup>
    <?php endif; ?>
  </header>

  <div id="main" class="clearfix">
    <div id="primary">
      <section id="content" role="main">
        <div id="content-wrap">
          <?php print $messages; ?>
          <a id="main-content"></a>
          <h1 class="title" id="page-title"><?php print t('Bienvenue sur le site du Bistro32') ?></h1>
					<p>Le site ouvrira bientôt ses portes, mais vous pouvez nous contacter par téléphone au <strong>09 53 11 85 75</strong></p>
					<p>Vous pouvez également nous retrouver sur la <a href="https://fr-fr.facebook.com/bistro32lagarenne" target="_blank">page Facebook</a>.</p>
          <?php //print $content; ?><br/><br/>
        </div>
      </section> <!-- /#main -->
    </div>
  </div>
  
</div>

</body>
</html>
