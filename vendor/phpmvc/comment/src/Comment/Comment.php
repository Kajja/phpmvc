<?php

namespace Phpmvc\Comment;

use \Anax\MVC\CDataBaseModel;

/**
 * Model class representing Comment(s)
 *
 */
class Comment extends CDataBaseModel
{
    
    /**
     * Returns the comment with the specified id.
     * This is an "adapter" for the class in the parent, since
     * the CommentController class expects an array and not an object.
     * The model object is still populated with the values from
     * the database, since this is done in the parent method.
     *
     * @return comment as array
     */

    public function find($commentId = null)
    {
        return parent::find($commentId)->getProperties();     
    }


    /**
     * Find and return all comments for the specific page/context.
     *
     * @return array with all comments.
     */
    public function findAllinContext($pageId)
    {
        return $this->query()->where('page = ?')
            ->execute([$pageId]);
    }


    /**
     * Delete all comments in a specific page/context.
     *
     * @return void
     */
    public function deleteAll($pageId)
    {
        $this->deleteWhere('page = ?')->execute([$pageId]);
    }
}