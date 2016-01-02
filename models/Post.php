<?php

namespace app\models;

/**
 * This is the model class for table "tbl_post".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $url
 * @property string $tags
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $author_id
 *
 * @property Comment[] $comments
 * @property User $author
 */
class Post extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'tbl_post';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['title', 'content', 'status', 'author_id'], 'required'],
			[['content', 'tags'], 'string'],
			[['status', 'create_time', 'update_time', 'author_id'], 'integer'],
			[['title', 'url'], 'string', 'max' => 128]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'title' => 'Title',
			'content' => 'Content',
			'url' => 'Url',
			'tags' => 'Tags',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'author_id' => 'Author ID',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getComments()
	{
		return $this->hasMany(Comment::className(), ['post_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getAuthor()
	{
		return $this->hasOne(User::className(), ['id' => 'author_id']);
	}
}
