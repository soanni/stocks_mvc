<?php

namespace common\models;

use yii\base\Event;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

// parent class for those tables that have ChangeDate and ActiveFlag columns

class ActiveRecordTimestamp extends ActiveRecord
{
    // automatic timestamp ChangeDate after creating/updating record
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['ChangeDate'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['ChangeDate'],
                    SoftDeleteBehavior::EVENT_AFTER_RESTORE => ['ChangeDate']
                ],
                'value' => new Expression('NOW()')
            ],
            'softDelete' => [
                'class' => SoftDeleteBehavior::className(),
                 'softDeleteAttributeValues' => [
                      'ActiveFlag' => 0
                 ],
                'restoreAttributeValues' => [
                    'ActiveFlag' => 1
                ],
                'replaceRegularDelete' => true
            ]
        ];
    }

    /**
     * override beforeSave() to automatically set the ActiveFlag attribute
     */
    public function beforeSave($insert)
    {
        $return = parent::beforeSave($insert);
        if($this->isNewRecord){
            $this->ActiveFlag = 1;
        }

        return $return;
    }
}