<?php
namespace common\models;
/**
 * The followings are the available columns in table 'tbl_comment':
 * @property integer $id
 * @property string $content
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property string $author_name
 */
class Comment extends \CActiveRecord
{
    const STATUS_CHECK = 'check';
    const STATUS_APPROVED = 'approved';
    const STATUS_DECLINED = 'declined';

    /**
     * Returns the static model of the specified AR class.
     * @return static the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{comment}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('content, author_name', 'required'),
            array('author_name', 'length', 'max' => 128),
            array('content, author_name, create_time, update_time, state', 'safe'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'Id',
            'content' => 'Comment',
            'state' => 'State',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'author_name' => 'Author name',
        );
    }

    /**
     * Approves a comment.
     */
    public function approve()
    {
        $this->state = Comment::STATUS_APPROVED;
        $this->update([
            'state'
        ]);
    }

    /**
     * Declines a comment.
     */
    public function decline()
    {
        $this->state = Comment::STATUS_DECLINED;
        $this->update([
            'state'
        ]);
    }

    /**
     * @param Post the post that this comment belongs to. If null, the method
     * will query for the post.
     * @return string the permalink URL for this comment
     */
    public function getUrl($post = null)
    {
        if ($post === null)
            $post = $this->post;
        return $post->url . '#c' . $this->id;
    }

    /**
     * @return string the hyperlink display for the current comment's author
     */
    public function getAuthorLink()
    {
        if (!empty($this->url))
            return \CHtml::link(\CHtml::encode($this->author), $this->url);
        else
            return \CHtml::encode($this->author);
    }

    /**
     * @return integer the number of comments that are check approval
     */
    public function getCheckCommentCount()
    {
        return $this->count('state=' . self::STATUS_CHECK);
    }

    /**
     * @param integer the maximum number of comments that should be returned
     * @return array the most recently added comments
     */
    public function findCheckComments($limit = 50)
    {
        return $this->findAll(array(
            'condition' => 't.state=\'' . self::STATUS_CHECK . '\'',
            'order' => 't.create_time DESC',
            'limit' => $limit,
        ));
    }

    /**
     * @param integer the maximum number of comments that should be returned
     * @return array the most recently added comments
     */
    public function findApprovedComments($limit = 50)
    {
        return $this->findAll(array(
            'condition' => 't.state=\'' . self::STATUS_APPROVED . '\'',
            'order' => 't.create_time DESC',
            'limit' => $limit,
        ));
    }
}