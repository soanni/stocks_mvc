<?php

namespace common\helpers;


use yii\grid\DataColumn;

class LimitedWidthColumn extends DataColumn
{
    public $contentOptions = ['style'=>'max-width:90px;'];
}