<?php

namespace mife\Comment;

class CommentSetup 
{
	/**
	 * Bootstrap for comments
	 *
	 *
	 */
	public static function initComments($app) 
	{
		 // Activate controller for comments
	    $app->dispatcher->forward([
	        'controller' => 'comment',
	        'action'     => 'view',
	    ]);

	    // Adds comment form view
	    $app->views->add('comment/form', [
	        'mail'      => null,
	        'web'       => null,
	        'name'      => null,
	        'content'   => null,
	        'output'    => null,
	        'fieldlabel'=> 'Kommentera',
	        'update'    => false,
	    ]);

	    // Adds comment styling
	    $app->theme->addStylesheet('css/comments.css');

	    // Sets context
	    $app->session->set('context', $app->request->getCurrentUrl());
	}
}