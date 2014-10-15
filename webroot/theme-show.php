<?php

// Bootstrapping (i.e. configurations, create framework object etc.)
require __DIR__ . '/config_with_app.php';

// Creating a controller service for testing the theme
$di->set('ThemeController', function() use ($di) {
    $controller = new \mife\Theme\ThemeController();
    $controller->setDI($di);
    return $controller;
});

// Default route
$app->router->add('', function() use ($app) {

    $app->theme->setTitle('Välkommen');
    $app->theme->setVariable('bodyClasses', 'page-container');

	$app->views->addString('header', 'header');
    $app->views->add('me/page', ['content' => 'Välj i menyn vilken del av temat du är intresserad av.'], 'main');

});

// Using a app-specific theme configuration (overrides any earlier config-file specified)
$app->theme->configure(ANAX_APP_PATH . 'config/theme-kajja-show.php');

// Using a app-specific navbar configuration
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_theme_show.php');

//Configuring how generated URLs vill look like
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);

// Handling request
$app->router->handle();

// Rendering the response
$app->theme->render();