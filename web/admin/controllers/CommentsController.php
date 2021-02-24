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
        if (Yii::app()->user->isGuest) {
            $this->redirect('/site/login');
        }

        $modelComments = Comment::model()->findCheckComments();

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
        if (Yii::app()->user->isGuest) {
            $this->redirect('/site/login');
        }

        $modelComments = Comment::model()->findCheckComments();

        $comments = $this->toArrayFromAR($modelComments);

        $this->jsonResponse($comments);
    }

    /**
     * @param $id
     */
    public function actionEdit($id)
    {
        if (Yii::app()->user->isGuest) {
            $this->redirect('/site/login');
        }

        $modelComment = Comment::model()->findByPk($id);

        if (!$modelComment) {
            $this->render('error', Yii::t(null, 'Error editing comment.'));
        }
        $model = new EditCommentForm;

        $model->attributes = $modelComment->attributes;

        if (isset($_POST['EditCommentForm'])) {
            $model->attributes = $_POST['EditCommentForm'];
            if ($model->validate()) {
                $modelComment->attributes = $model->attributes;
                $modelComment->save();
            }
        }

        $this->render('edit', array('model' => $model));
    }

    /**
     * @param $id
     */
    public function actionApprove($id)
    {
        $status = StatusResponseEnum::SUCCESS;

        if (Yii::app()->user->isGuest) {
            $status = StatusResponseEnum::ERROR;
        }

        $modelComment = Comment::model()->findByAttributes([
            'state' => Comment::STATUS_CHECK,
            'id' => $id,
        ]);

        if (!$modelComment) {
            $status = StatusResponseEnum::ERROR;
        }

        if ($status === StatusResponseEnum::ERROR) {
            $this->jsonResponse(Yii::t(null, 'Error approving comment.'), $status);
        }

        try {
            $modelComment->approve();
        } catch (Throwable $error) {
            Yii::log($error->getMessage());
            $this->jsonResponse(Yii::t(null, 'Error update approving comment.'), $status);
        }
        $this->jsonResponse(Yii::t(null, 'The comment was successfully approved.'), $status);
    }

    /**
     * @param $id
     */
    public function actionDelete($id)
    {
        $status = StatusResponseEnum::SUCCESS;

        if (Yii::app()->user->isGuest) {
            $status = StatusResponseEnum::ERROR;
        }

        $modelComment = Comment::model()->findByPk($id);

        if (!$modelComment) {
            $status = StatusResponseEnum::ERROR;
        }

        if ($status === StatusResponseEnum::ERROR) {
            $this->jsonResponse(Yii::t(null, 'Error deleting comment.'), $status);
        }

        try {
            $modelComment->delete();
        } catch (Throwable $error) {
            Yii::log($error->getMessage());
            $this->jsonResponse(Yii::t(null, 'Error delete comment from database.'), $status);
        }

        $this->jsonResponse(Yii::t(null, 'The comment was successfully deleted.'), $status);
    }

    /**
     * @param $id
     */
    public function actionDecline($id)
    {
        $status = StatusResponseEnum::SUCCESS;

        if (Yii::app()->user->isGuest) {
            $status = StatusResponseEnum::ERROR;
        }

        $modelComment = Comment::model()->findByAttributes([
            'state' => Comment::STATUS_CHECK,
            'id' => $id,
        ]);

        if (!$modelComment) {
            $status = StatusResponseEnum::ERROR;
        }

        if ($status === StatusResponseEnum::ERROR) {
            $this->jsonResponse(Yii::t(null, 'Error declining comment.'), $status);
        }

        try {
            $modelComment->decline();
        } catch (Throwable $error) {
            $this->jsonResponse(Yii::t(null, 'Error update declining comment.'), $status);
        }

        $this->jsonResponse(Yii::t(null, 'The comment was successfully declined.'), $status);
    }
}
