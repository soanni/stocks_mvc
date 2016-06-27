<?php

namespace app\components\validators;

use common\models\exchange\Exchange;
use yii\validators\Validator;

class CompanyValidator extends Validator
{
    public function init()
    {
        parent::init();
        $this->message = 'Company doesn\'t belong to the exchange.';
    }

    public function validateAttribute($model, $attribute)
    {
        $exchange = new Exchange();
        $exchange->exchid = $model->exchid;
        if(!$exchange->hasCompany($model->$attribute))
        {
            $model->addError($attribute,$this->message);
        }
    }
}