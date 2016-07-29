<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property integer $menu_id
 * @property string $menu_name
 * @property integer $parent_id
 * @property integer $sort
 * @property integer $is_static
 * @property string $url
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'sort', 'is_static'], 'integer'],
            [['menu_name'], 'string', 'max' => 145],
            [['url'], 'string', 'max' => 245]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'menu_id' => 'Menu ID',
            'menu_name' => 'Menu Name',
            'parent_id' => 'Parent ID',
            'sort' => 'Sort',
            'is_static' => 'Is Static',
            'url' => 'Url',
        ];
    }
}
