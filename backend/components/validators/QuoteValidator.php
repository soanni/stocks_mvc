<?php

namespace app\components\validators;

use yii\validators\Validator;
use common\models\company\Company;

class QuoteValidator extends Validator
{
    public function init()
    {
        parent::init();
        $this->message = 'Quote doesn\'t belong to the company.';
    }

    public function validateAttribute($model, $attribute)
    {
        $company = new Company();
        $company->companyid = $model->companyid;
        if(!$company->hasQuote($model->$attribute))
        {
            $model->addError($attribute,$this->message);
        }
    }
}