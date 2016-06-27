<?php

namespace app\components\validators;

use yii\validators\Validator;
use common\models\country\Country;

class ExchangeValidator extends Validator
{
    public function init()
    {
        parent::init();
        $this->message = 'Exchange doesn\'t belong to the country.';
    }

    public function validateAttribute($model, $attribute)
    {
        $country = new Country();
        $country->countryid = $model->country;
        if(!$country->hasExchange($model->$attribute))
        {
            $model->addError($attribute, $this->message);
        }
    }
}