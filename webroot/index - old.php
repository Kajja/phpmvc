<?php

// Bootstrapping (i.e. configurations, create framework object etc.)
require __DIR__ . '/config_with_app.php';

// Creating a controller service for comments
$di->set('CommentController', function() use ($di) {
    $controller = new Phpmvc\Comment\CommentController();
    $controller->setDI($di);
    return $controller;
});

// Creating a model service for comments
$di->set('comments', function() use ($di) {
    $comments = new \Phpmvc\Comment\CommentsInSession();
    $comments->setDI($di);
    $comments->setContext($di->request->getCurrentUrl());
    return $comments;
});


// Defining routes
$app->router->add('', function() use ($app) {

    $app->theme->setTitle('Lite om mig');
    $app->views->add('me/page', [
    	'content' => $app->textFilter->doFilter($app->fileContent->get('about.md'), 'shortcode, markdown'),
        'byline' => $app->textFilter->doFilter($app->fileContent->get('byline.md'), 'shortcode, markdown'),
    ]);

    // Adds the possibility to post comments on the page
    \mife\Comment\CommentSetup::initComments($app);

});

$app->router->add('redovisning/kmom1', function() use ($app) {

    $app->theme->setTitle('Redovisning');
    $app->views->add('me/page', [
        'content' => $app->textFilter->doFilter($app->fileContent->get('kmom1.md'), 'shortcode, markdown'),
        'byline' => $app->textFilter->doFilter($app->fileContent->get('byline.md'), 'shortcode, markdown'),
    ]);

    // Adds the possibility to post comments on the page
    \mife\Comment\CommentSetup::initComments($app);

});

$app->router->add('redovisning/kmom2', function() use ($app) {

    $app->theme->setTitle('Redovisning');
    $app->views->add('me/page', [
        'content' => $app->textFilter->doFilter($app->fileContent->get('kmom2.md'), 'shortcode, markdown'),
        'byline' => $app->textFilter->doFilter($app->fileContent->get('byline.md'), 'shortcode, markdown'),
    ]);

    // Adds the possibility to post comments on the page
    \mife\Comment\CommentSetup::initComments($app);
    
});

$app->router->add('source', function() use ($app) {

    $app->theme->setTitle('Källkod');
    $app->theme->addStylesheet('css/source.css');
    $source = new \Mos\Source\CSource([
    	'secure_dir' => '..',
    	'base_dir' => '..',
    	'add_ignore' => ['.htaccess'],
    ]);
    $app->views->add('me/source', ['content' => $source->View(),]);
});

// Using a app-specific theme configuration (overrides any earlier config-file specified)
$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');

// Using a app-specific navbar configuration
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');

//Configuring how generated URLs vill look like
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);

// Handling request
$app->router->handle();

// Rendering the response
$app->theme->render();