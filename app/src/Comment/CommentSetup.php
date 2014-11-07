<?php

namespace mife\Comment;

use \Phpmvc\Comment\CommentForm;

class CommentSetup 
{
	/**
	 * Bootstrap for comments
	 *
	 *
	 */
	public static function initComments($app) 
	{
	    // Sets context (should only be set here, globals can be dangerous)
	    $app->session->set('context', $app->request->getCurrentUrl());

		 // Activate controller to show comments
	    $app->dispatcher->forward([
	        'controller' => 'comment',
	        'action'     => 'view',
	    ]);

	    // Create HTML form that lets the user create comments
		$form = new CommentForm();
		$form->setDI($app);
		$form->createForm();
		$form->check();

		$app->views->add('me/page',[
			'content' => $form->getHTML()
		]);

/*
	    // Adds comment form view
	    $app->views->add('comment/form', [
	        'mail'      => null,
	        'web'       => null,
	        'name'      => null,
	        'content'   => null,
	        'output'    => null,
	        'fieldlabel'=> 'Kommentera',
	        'update'    => false
	    ]);
*/
	    // Adds comment styling
	    $app->theme->addStylesheet('css/comments.css');
	}
}