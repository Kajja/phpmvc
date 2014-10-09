<?php

// Bootstrapping (i.e. configurations, create framework object etc.)
require __DIR__ . '/config_with_app.php';


// Defining routes
$app->router->add('', function() use ($app) {

    $app->theme->setTitle('Lite om mig');
    $app->views->add('me/page', [
    	'content' => $app->textFilter->doFilter($app->fileContent->get('about.md'), 'shortcode, markdown'),
        'byline' => $app->textFilter->doFilter($app->fileContent->get('byline.md'), 'shortcode, markdown'),
    ]);

});

$app->router->add('regioner', function() use ($app) 
    {
 
    $app->theme->addStylesheet('css/anax-grid/regions_demo.css');
    $app->theme->setTitle("Regioner");
 
    $app->views->addString('flash', 'flash')
               ->addString('featured-1', 'featured-1')
               ->addString('featured-2', 'featured-2')
               ->addString('featured-3', 'featured-3')
               ->addString('main', 'main')
               ->addString('sidebar', 'sidebar')
               ->addString('triptych-1', 'triptych-1')
               ->addString('triptych-2', 'triptych-2')
               ->addString('triptych-3', 'triptych-3')
               ->addString('footer-col-1', 'footer-col-1')
               ->addString('footer-col-2', 'footer-col-2')
               ->addString('footer-col-3', 'footer-col-3')
               ->addString('footer-col-4', 'footer-col-4');

    $app->views->add('fonttest/page', []);
});

$app->router->add('typsnitt', function() use ($app) 
    {
        $app->theme->setTitle("Typsnittstest");
        $app->views->add('fonttest/lydia', [], 'main');
        $app->views->add('fonttest/lydia', [], 'sidebar');

    });

// Using a app-specific theme configuration (overrides any earlier config-file specified)
$app->theme->configure(ANAX_APP_PATH . 'config/theme-grid.php');

// Using a app-specific navbar configuration
//$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');

//Configuring how generated URLs vill look like
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);

// Handling request
$app->router->handle();

// Rendering the response
$app->theme->render();