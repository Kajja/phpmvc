<?php

namespace Phpmvc\Comment;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class CommentsInSession implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    private $key = 'comment';

    /**
     * Add a new comment.
     *
     * @param array $comment with all details.
     * 
     * @return void
     */
    public function add($comment)
    {

        $comments = $this->session->get($this->key, []);
        $comments[] = $comment;
        $this->session->set($this->key, $comments);

    }


    /**
     * Update a comment
     *
     * @param $commentId
     * @param $comment
     *
     * @return void
     */

    public function updateComment($commentId, $comment)
    {

        $comments = $this->session->get($this->key, []);
        $comments[$commentId] = $comment;
        $this->session->set($this->key, $comments);
    }


    /**
     * Resturns the comment with the specified id.
     *
     * @return comment
     */

    public function find($commentId)
    {
        $comments = $this->session->get($this->key, []);

        return $comments[$commentId]; //Bättre ids, inte förlita sig på plats
    }


    /**
     * Find and return all comments.
     *
     * @return array with all comments.
     */
    public function findAll()
    {

        return $this->session->get($this->key, []);
    }


    /**
     * Delete a specific comment.
     *
     * @return void
     */
    public function deleteComment($commentId) 
    {

        $comments = $this->session->get($this->key, []);
        unset($comments[$commentId]);
        $this->session->set($this->key, $comments);
    }


    /**
     * Delete all comments.
     *
     * @return void
     */
    public function deleteAll()
    {
        $this->session->set($this->key, []);
    }

    /**
     * Sets the context
     *
     * @return void
     */

    public function setContext($context) {

        $this->key = $context . '-comment';
        
        return $this;
    }
}
