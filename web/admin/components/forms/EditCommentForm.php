<?php

/**
 * Class EditCommentForm
 */
class EditCommentForm extends CFormModel
{
    public $author_name;
    public $content;
    public $state;
    public $create_time;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return [
            [
                'author_name,content',
                'required'
            ],
            [
                'author_name, content, state, create_time',
                'safe'
            ],
        ];
    }
}
