<?php

// Bootstrapping (configurations, create framework object etc.)
require __DIR__ . '/config_with_app.php';

//$app->theme->setTitle('Välkommen');

// Defining routes

$app->router->add('', function() use ($app) {

    $app->theme->setTitle('Lite om mig');

    $app->views->add('me/page', [
    	'content' => $app->textFilter->doFilter($app->fileContent->get('about.md'), 'shortcode, markdown'),
       	]);

});
/*
$app->router->add('redovisning', function() use ($app) {

    $app->views->add('me/redovisning');
    $app->theme->setTitle('Redovisning')
});
*/

$app->router->add('source', function() use ($app) {

    $app->theme->setTitle('Källkod');

    $source = new \Mos\Source\CSource([
    	'secure_dir' => '..',
    	'base_dir' => '..',
    	'add_ignore' => ['.htaccess'],
    ]);

    $app->views->add('me/source', ['content' => $source->View(),]);
});

// Using a app-specific theme configuration (overrides any earlier config-file specified)
$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');

//
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');

// Handling request
$app->router->handle();

// Rendering the response
$app->theme->render();