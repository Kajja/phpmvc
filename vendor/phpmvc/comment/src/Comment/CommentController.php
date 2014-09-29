<?php

namespace Phpmvc\Comment;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class CommentController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;


    /**
     * View all comments.
     *
     * @return void
     */
    public function viewAction()
    {
        // Interface towards comments data
        $comments = $this->di->comments;

        $all = $comments->findAll();

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

        $comment = [
            'content'   => $this->request->getPost('content'),
            'name'      => $this->request->getPost('name'),
            'web'       => $this->request->getPost('web'),
            'mail'      => $this->request->getPost('mail'),
            'timestamp' => time(),
            'ip'        => $this->request->getServer('REMOTE_ADDR'),
        ];

        // Interface towards comments data
        $comments = $this->di->comments;
        $comments->setContext($this->session->get('context'));
        $comments->add($comment);

        $this->response->redirect($this->request->getPost('redirect'));
    }


    /**
     * Display comment info for editing
     *
     *  @return void
     */
    public function editAction($commentId)
    {

        // Collect data from model
        $comments = $this->di->comments;
        $comments->setContext($this->di->session->get('context'));
        $comment = $comments->find($commentId);

        $this->theme->setTitle('Uppdatera kommentar');

        // Add view with the fetched information
        $this->di->views->add('comment/form', [
            'mail'      => $comment['mail'],
            'web'       => $comment['web'],
            'name'      => $comment['name'],
            'content'   => $comment['content'],
            'output'    => null,
            'fieldlabel'=> 'Kommentera',
            'update'    => true,
            'id'        => $commentId
        ]);

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
            'name'      => $this->request->getPost('name'),
            'web'       => $this->request->getPost('web'),
            'mail'      => $this->request->getPost('mail'),
            'timestamp' => time(),
            'ip'        => $this->request->getServer('REMOTE_ADDR'),
        ];

        $comments = $this->di->comments;
 
        $comments->setContext($this->session->get('context'))->updateComment($commentId, $comment);

        // Reloads the page to display changes
        $this->response->redirect($this->session->get('context'));
    }



    /**
     * Remove a specific comment.
     *
     * @return void
     */
    public function removeAction($commentId) 
    {

        // Interface towards comments data
        $comments = $this->di->comments;

        $comments->setContext($this->request->getPost('redirect'));

        $comments->setContext($this->session->get('context'));
        $comments->deleteComment($commentId);

        $this->response->redirect($this->session->get('context'));

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

        // Interface towards comments data
        $comments = $this->di->comments;

        $comments->setContext($this->session->get('context'));
        $comments->deleteAll();

        $this->response->redirect($this->request->getPost('redirect'));
    }
}
