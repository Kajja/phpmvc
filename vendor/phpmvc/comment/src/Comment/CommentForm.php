<?php

namespace Phpmvc\Comment;

use Mos\HTMLForm\CForm,
	Anax\DI\IInjectionAware,
	Anax\DI\TInjectionAware;


/**
 * Class for comment form
 *
 *
 */
class CommentForm extends CForm implements IInjectionAware
{
	use TInjectionAware;

	public function __construct()
	{
		parent::__construct();
	}


	/**
	 * Creates form used for adding new comments and
	 * to update existing comments
	 *
	 * @param boolean if a normal or a update form is to be created
	 *
	 */
	public function createForm($type = 'create', $values = []) {

		$this->create([], [

	    	'redirect'	=> [
	    		'type'			=> 'hidden',
	    		'value'			=> $this->di->request->getCurrentUrl()
	    	],
	    	'content' => [
	    		'type' 			=> 'textarea',
	    		'label'			=> 'Kommentar:',
	    		'required' 		=> false,
//	    		'validation'	=> ['not_empty'],
	    		'value'			=> isset($values['content']) ? $values['content'] : ''
	    	],
	    	'name'	=> [
	    		'type'			=> 'text',
	    		'label'			=> 'Namn:',
	    		'required'		=> false,
//	    		'validation'	=> ['not_empty'],
	    		'value'			=> isset($values['name']) ? $values['name'] : ''
	    	],
	    	'web'	=> [
	    		'type' 			=> 'text',
	    		'label'			=> 'Hemsida:',
	    		'required' 		=> false,
	    		'value'			=> isset($values['web']) ? $values['web'] : ''
	    	],
	    	'mail'	=> [
	    		'type'			=> 'text',
	    		'label'			=> 'Epost:',
	    		'required'		=> false,
//	    		'validation'	=> ['email_adress'],
	    		'value'			=> isset($values['mail']) ? $values['mail'] : ''
	    	],
	    	'id'	=> [
	    		'type'			=> 'hidden',
	    		'value'			=> isset($values['id']) ? $values['id'] : ''
	    		]
	    ]);

		// Buttons when a new comment is to be created or comments deleted
		if ($type == 'create') {

		    $this->create([], [
				'doCreate' => [
		    		'type'			=> 'submit',
		    		'value'			=> 'Lägg till',
		    		'callback'		=> 	function($form) {
		    			$this->di->dispatcher->forward([
	        				'controller' => 'comment',
	        				'action'     => 'add',
	    				]);
	            		return true;
		    		}
		    	],
		    	'rensa' => [
		    		'type'			=> 'reset',
		    	],
		    	'doRemoveAll' => [
		    		'type'			=> 'submit',
		    		'value'			=> 'Ta bort alla',
		    		'callback'		=> function($form) {
		    			$this->di->dispatcher->forward([
	        				'controller' => 'comment',
	        				'action'     => 'removeAll',
	    				]);
	            		return true;
		    		}
		    	]
		    ]);
		} 

		// Buttons when a comment is to be updated
		if ($type == 'update') {
			
			$this->create([], [
		    	'update' => [
		    		'type'			=> 'submit',
		    		'value'			=> 'Uppdatera',
		    		'callback'		=> function($form) {
		    			$this->di->dispatcher->forward([
	        				'controller' => 'comment',
	        				'action'	 => 'update',
	        				'params'	 => [$form->Value('id')]
	    				]);
	            		return true;
	            	}
		    	],
		    	'cancel' => [
		    		'type'			=> 'submit',
		    		'value'			=> 'Avbryt',
		    		'callback'		=> function($form) {
		    			$this->di->response->redirect($this->di->session->get('context'));
		    			return true;
		    		}
		    	]
		    ]);
		}

	}

}