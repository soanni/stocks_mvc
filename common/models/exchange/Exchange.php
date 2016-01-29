<?php

namespace common\models\exchange;

use Yii;

/**
 * This is the model class for table "exchange".
 *
 * @property integer $exchid
 * @property string $exchname
 * @property string $web
 *
 * @property Quotes[] $quotes
 */
class Exchange extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exchange';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exchname','web'], 'required'],
            [['exchname'], 'unique'],
            [['exchname', 'web'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'exchid' => 'Exchange Id',
            'exchname' => 'Exchange',
            'web' => 'Web',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuotes()
    {
        return $this->hasMany(Quotes::className(), ['exchid' => 'exchid']);
    }
}
