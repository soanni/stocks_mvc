<?php

namespace common\models;

use yii\base\Event;
use yii\behaviors\AttributeBehavior;
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
                    ActiveRecord::EVENT_BEFORE_DELETE => ['ChangeDate'],
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
            ],
            'attribute' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['ActiveFlag']
                ],
                'value' => function($event){ return 1;}
            ]
        ];
    }

    /**
     * Event handler for events SoftDeleteBehavior::EVENT_BEFORE_SOFT_DELETE, SoftDeleteBehavior::EVENT_BEFORE_RESTORE
     * Event handlers are attached in corresponding controller actions
     * @param Event $event
     */
    protected function updateChangeDateOnRestoreAndSoftDelete(Event $event)
    {
        $event->sender->owner->updateAttributes(['ChangeDate' => new Expression('NOW()')]);
    }
}