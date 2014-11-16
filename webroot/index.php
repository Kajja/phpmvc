<?php

// Bootstrapping (i.e. configurations, create framework object etc.)
require __DIR__ . '/config_with_app.php';


// Creating a controller service for testing the theme
$di->set('ThemeController', function() use ($di) {
    $controller = new \mife\Theme\ThemeController();
    $controller->setDI($di);
    return $controller;
});

// Starts the session
$app->session;

// Saving Http request info
$app->recorder->save(['/Anax-MVC/webroot/records']);


// Defining routes

// Default route
$app->router->add('', function() use ($app) {

    $app->theme->setTitle('Välkommen');
    $app->theme->setVariable('bodyClasses', 'front');

    $app->views->add('me/headerthin', [
            'logo' => $app->url->asset('img/kaja.png'),
            'text' => '-< -< -<'], 
        'header');

    $app->views->add('jumbotron/jumbotron', [
            'header' => 'Välkommen',
            'content' =>  $app->textFilter->doFilter($app->fileContent->get('welcome-text.md'), 'shortcode, markdown')],
        'flash');

    $app->views->add('content/panel', [
            'route' => 'about', 
            'iconClasses' => 'fa fa-smile-o fa-align-center fa-fw', 
            'text' => 'Lite om mig'], 
        'panel-col-1');
    
    $app->views->add('content/panel', [
            'route' => 'redovisning/kmom1', 
            'iconClasses' => 'fa fa-pencil fa-align-center fa-fw', 
            'text' => 'Mina redovisningar'], 
        'panel-col-2');
    
    $app->views->add('content/panel', [
        'route' => 'theme-show.php', 
        'iconClasses' => 'fa fa-sitemap fa-align-center fa-fw', 
        'text' => 'Temat'], 
    'panel-col-3');

    $app->views->add('content/panel', [
        'route' => 'source', 
        'iconClasses' => 'fa fa-code fa-align-center fa-fw', 
        'text' => 'Koden'], 
   'panel-col-4');

});

// 'About' route
$app->router->add('about', function() use ($app) {

    $app->theme->setTitle('Välkommen!');
    $app->theme->setVariable('bodyClasses', 'page-container');

    $app->views->add('me/page', [
        'content' => $app->textFilter->doFilter($app->fileContent->get('about.md'), 'shortcode, markdown'),
        'byline' => $app->textFilter->doFilter($app->fileContent->get('byline.md'), 'shortcode, markdown'),
    ]);
});

// 'Redovisning/Kmom1' route
$app->router->add('redovisning/kmom1', function() use ($app) {

    $app->theme->setTitle('Redovisning');
    $app->theme->setVariable('bodyClasses', 'page-container');

    $app->views->add('me/page', [
        'content' => $app->textFilter->doFilter($app->fileContent->get('kmom1.md'), 'shortcode, markdown'),
        'byline' => $app->textFilter->doFilter($app->fileContent->get('byline.md'), 'shortcode, markdown'),
    ]);

    // Adds the possibility to post comments on the page
    \mife\Comment\CommentSetup::initComments($app);

});

// 'Redovisning/Kmom2' route
$app->router->add('redovisning/kmom2', function() use ($app) {

    $app->theme->setTitle('Redovisning');
    $app->theme->setVariable('bodyClasses', 'page-container');

    $app->views->add('me/page', [
        'content' => $app->textFilter->doFilter($app->fileContent->get('kmom2.md'), 'shortcode, markdown'),
        'byline' => $app->textFilter->doFilter($app->fileContent->get('byline.md'), 'shortcode, markdown'),
    ]);

    // Adds the possibility to post comments on the page
    \mife\Comment\CommentSetup::initComments($app);
    
});

// 'Redovisning/Kmom3' route
$app->router->add('redovisning/kmom3', function() use ($app) {

    $app->theme->setTitle('Redovisning');
    $app->theme->setVariable('bodyClasses', 'page-container');

    $app->views->add('me/page', [
        'content' => $app->textFilter->doFilter($app->fileContent->get('kmom3.md'), 'shortcode, markdown'),
        'byline' => $app->textFilter->doFilter($app->fileContent->get('byline.md'), 'shortcode, markdown'),
    ]);

    // Adds the possibility to post comments on the page
    \mife\Comment\CommentSetup::initComments($app);
    
});

// 'Redovisning/Kmom4' route
$app->router->add('redovisning/kmom4', function() use ($app) {

    $app->theme->setTitle('Redovisning');
    $app->theme->setVariable('bodyClasses', 'page-container');

    $app->views->add('me/page', [
        'content' => $app->textFilter->doFilter($app->fileContent->get('kmom4.md'), 'shortcode, markdown'),
        'byline' => $app->textFilter->doFilter($app->fileContent->get('byline.md'), 'shortcode, markdown'),
    ]);

    // Adds the possibility to post comments on the page
    \mife\Comment\CommentSetup::initComments($app);
    
});

// 'Redovisning/Kmom5' route
$app->router->add('redovisning/kmom5', function() use ($app) {

    $app->theme->setTitle('Redovisning');
    $app->theme->setVariable('bodyClasses', 'page-container');

    $app->views->add('me/page', [
        'content' => $app->textFilter->doFilter($app->fileContent->get('kmom5.md'), 'shortcode, markdown'),
        'byline' => $app->textFilter->doFilter($app->fileContent->get('byline.md'), 'shortcode, markdown'),
    ]);

    // Adds the possibility to post comments on the page
    \mife\Comment\CommentSetup::initComments($app);
    
});

// 'Kod' route
$app->router->add('source', function() use ($app) {

    $app->theme->setTitle('Källkod');
    $app->theme->setVariable('bodyClasses', 'page-container');
    $app->theme->addStylesheet('css/source.css');

    $source = new \Mos\Source\CSource([
        'secure_dir' => '..',
        'base_dir' => '..',
        'add_ignore' => ['.htaccess'],
    ]);

    $app->views->add('me/source', ['content' => $source->View(),]);
});

$app->router->add('records', function() use ($app){

    $app->theme->setTitle('Sparade requests');
    $app->theme->setVariable('bodyClasses', 'page-container');



    $res = $app->recorder->getRecords();

    $url = $app->url->create('records/clear');
    $res = "<a href='$url'>Ta bort sparade requests</a>" . $res;
 
    $app->views->add('me/page', [
        'content' => $res
    ]);
});

$app->router->add('records/clear', function() use ($app){

    $app->recorder->clearRecords();
    $app->response->redirect($app->url->create('records'));
});

// Using a app-specific theme configuration (overrides any earlier config-file specified)
$app->theme->configure(ANAX_APP_PATH . 'config/theme-kajja.php');

// Using a app-specific navbar configuration
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');

//Configuring how generated URLs vill look like
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);

// Handling request
$app->router->handle();

// Rendering the response
$app->theme->render();