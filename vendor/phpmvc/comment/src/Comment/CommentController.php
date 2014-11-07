<?php

namespace Phpmvc\Comment;

use \Anax\DI\IInjectionAware,
    \Anax\DI\TInjectable,
    \Phpmvc\Comment\CommentForm;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class CommentController implements IInjectionAware
{
    use TInjectable;


    public function initialize()
    {
        // Acquiring comment model (i.e. interface towards comment data)
        $this->commentModel = $this->di->comments;

        // Start the session
        $this->session();

        // Retrieves the page context saved in the session
        $this->context = $this->di->session->get('context'); //Carefully used global 'context'

        // Creates a pageId, used to locate the comments for the page
        $this->pageId = hash('md5', $this->context);
    }


    /**
     *  Set up a comment database table (to simplify testing)
     *
     */
    public function setUpAction()
    {
        // Drop existing table
        $this->db->dropTableIfExists('comment')->execute();

        $this->db->createTable('comment', [
            'id'        => ['integer', 'primary key', 'not null', 'auto_increment'],
            'content'   => ['text'],
            'creator'   => ['varchar(80)', 'not null'],
            'website'   => ['varchar(80)'],
            'email'     => ['varchar(80)'],
            'created'   => ['datetime', 'not null'],
            'edited'    => ['datetime'],
            'deleted'   => ['datetime'],
            'ip'        => ['varchar(80)'],
            'page'      => ['varchar(80)']
        ])->execute();
    }


    /**
     * View all comments.
     *
     * @return void
     */
    public function viewAction()
    {

        $all = $this->commentModel->findAllinContext($this->pageId);

        $all = $this->infoBuilder($all);

        $this->views->add('comment/comments', [
            'comments' => $all,
        ]);
    }


    /**
     * Add a comment.
     *
     * @return void
     */
    public function addAction()
    {
        $isPosted = $this->request->getPost('doCreate');

        if (!$isPosted) {
            $this->response->redirect($this->request->getPost('redirect'));
        }

        // Creates an id for the page that the comment belongs to
        $pageId = hash('md5', $this->request->getPost('redirect')); //Borde inte behövas

        $comment = [
            'content'   => $this->request->getPost('content'),
            'creator'   => $this->request->getPost('name'),
            'website'   => $this->request->getPost('web'),
            'email'     => $this->request->getPost('mail'),
            'created'   => time(),
            'ip'        => $this->request->getServer('REMOTE_ADDR'),
            'page'      => $pageId
        ];

        $this->commentModel->save($comment);

        // Redirect to the page where the new comment will be displayed
        $this->response->redirect($this->request->getPost('redirect'));
    }


    /**
     * Display comment info for editing
     *
     *  @return void
     */
    public function editAction($commentId)
    {
        // Retrieve data from the model as an array
        $comment = $this->commentModel->find($commentId);

        $this->theme->setTitle('Uppdatera kommentar');

        // Add view with the fetched information
/*        $this->di->views->add('comment/form', [
            'mail'      => $comment['email'],
            'web'       => $comment['website'],
            'name'      => $comment['creator'],
            'content'   => $comment['content'],
            'output'    => null,
            'fieldlabel'=> 'Kommentera',
            'update'    => true,
            'id'        => $commentId
        ]);
*/
        $form = new CommentForm();
        $form->setDI($this);
        $form->createForm('update', $this->translate($comment));
        $form->check();
        $this->views->add('me/page', [
            'content' => $form->getHTML()]
        );

        $this->theme->setVariable('bodyClasses', 'page-container');
    }


    /**
     * Update a comment
     *
     * @return void
     */

    public function updateAction($commentId)
    {
        $comment = [
            'content'   => $this->request->getPost('content'),
            'creator'   => $this->request->getPost('name'),
            'website'   => $this->request->getPost('web'),
            'email'     => $this->request->getPost('mail'),
            'edited'    => time(),
            'ip'        => $this->request->getServer('REMOTE_ADDR'),
        ];

        // Populates the model with values
        $this->commentModel->find($commentId);

        // Saves the new data
        $this->commentModel->save($comment);

        // Redirects to the page where the comment belongs
        $this->response->redirect($this->context);
    }


    /**
     * Remove a specific comment.
     *
     * @return void
     */
    public function removeAction($commentId) 
    {
        $this->commentModel->delete($commentId);

        $this->response->redirect($this->context);
    }


    /**
     * Remove all comments.
     *
     * @return void
     */
    public function removeAllAction()
    {
        $isPosted = $this->request->getPost('doRemoveAll');

        if (!$isPosted) {
            $this->response->redirect($this->request->getPost('redirect'));
        }
        $this->commentModel->deleteAll($this->pageId);

        $this->response->redirect($this->request->getPost('redirect'));
    }


// Borde göra om så att metoden nedan inte behövs

    /**
     * Formats comment information to be displayed in view
     *
     * @param array with Comment-objects
     *
     * @return array with formatted information
     */
    public function infoBuilder($comments)
    {
        $formattedInfo = [];
        foreach ($comments as $key => $comment) {

            $properties = $comment->getProperties();

            $formattedInfo[$key]['id']          = $properties['id'];
            $formattedInfo[$key]['name']        = $properties['creator'];
            $formattedInfo[$key]['web']         = $properties['website'];
            $formattedInfo[$key]['mail']        = $properties['email'];
            $formattedInfo[$key]['content']     = $properties['content'];
            $formattedInfo[$key]['timestamp']   = $properties['created'];
        }
        return $formattedInfo;
    }

// Borde göra om så att metoden nedan inte behövs
    /**
     * Translates from db names to names in the form
     *
     */
    public function translate($comment) {

        return [
            'mail'      => $comment['email'],
            'web'       => $comment['website'],
            'name'      => $comment['creator'],
            'content'   => $comment['content'],
            'id'        => $comment['id']
        ];
    }
}
