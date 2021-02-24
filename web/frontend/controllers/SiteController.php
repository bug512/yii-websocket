<?php

use  common\models\Comment;

class SiteController extends Controller
{
    const SAVED = 'saved';

    public $layout = 'column1';

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * This is the action to open main page
     */
    public function actionIndex()
    {
        $model = new WriteCommentForm();

        if (isset($_POST['WriteCommentForm'])) {
            $model->attributes = $_POST['WriteCommentForm'];
            $duplicateComment = Comment::model()->findByAttributes([
                'author_name' => $model->author_name,
                'content' => $model->content,
            ]);

            if ($duplicateComment) {
                $this->render('index', [
                    'model' => $model,
                    'duplicate' => true
                ]);

                \Yii::app()->end();
            }


            if ($model->validate()) {
                $modelComment = new Comment();
                $modelComment->author_name = $model->author_name;
                $modelComment->content = $model->content;
                $modelComment->create_time = date("Y-m-d H:i:s");
                $modelComment->save();
                $model = self::SAVED;
            }
        }

        $this->render('index', [
            'model' => $model
        ]);
    }

}
