<?php 
/**
 * This is a Anax pagecontroller.
 *
 */
// Include the essential settings.
require __DIR__.'/config.php'; 


// Create services and inject into the app. 
$di  = new \Anax\DI\CDIFactoryDefault();

$di->set('CommentController', function() use ($di) {
    $controller = new Phpmvc\Comment\CommentController();
    $controller->setDI($di);
    return $controller;
});

$di->set('comments', function() use ($di) {
    $comments = new \Phpmvc\Comment\CommentsInSession();
    $comments->setDI($di);
    $comments->setContext($di->url->create(''));
    return $comments;
});

/*
//Test
echo 'BaseUrl: ' . $di->request->getBaseUrl() . '<br>';
echo 'SiteUrl: ' . $di->request->getSiteUrl() . '<br>';
echo 'Route: ' . $di->request->getRoute() . '<br>';
echo 'CurrentUrl: ' . $di->request->getCurrentUrl() . '<br>';
echo 'Url-asset: ' . $di->url->asset('kommentarssida') . '<br>';
echo 'Url-create: ' . $di->url->create('');
*/

$app = new \Anax\Kernel\CAnax($di);

// Home route
$app->router->add('', function() use ($app) {

    $app->theme->setTitle("Welcome to Anax Guestbook");
    $app->views->add('comment/index');

    $app->theme->addStylesheet('css/comments.css');

    $app->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'view',
    ]);

    $app->views->add('comment/form', [
        'mail'      => null,
        'web'       => null,
        'name'      => null,
        'content'   => null,
        'output'    => null,
        'fieldlabel'=> 'Kommentera',
        'update'    => false
    ]);
});


// Check for matching routes and dispatch to controller/handler of route
$app->router->handle();

// Render the page
$app->theme->render();
