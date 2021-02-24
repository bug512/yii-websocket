<?php

use common\models\Comment;
use common\components\enums\StatusResponseEnum;

class CommentsController extends Controller
{
    public $layout = 'column1';

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return [];
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionIndex()
    {
        $modelComments = Comment::model()->findApprovedComments();

        $comments = $this->toArrayFromAR($modelComments);

        $this->render('list', [
            'comments' => $comments
        ]);
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionList()
    {
        $modelComments = Comment::model()->findApprovedComments();

        $comments = $this->toArrayFromAR($modelComments);

        $this->jsonResponse($comments);
    }
}
