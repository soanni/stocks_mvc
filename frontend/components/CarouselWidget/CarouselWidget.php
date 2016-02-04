<?php

namespace frontend\components\CarouselWidget;

use Yii;
use yii\base\Widget;

class CarouselWidget extends Widget
{
    public $carouselId = 'carouselWidget_0';
    public $models = [];
    public $options = [];

    private $carouselItemsContent;

    public function init(){
        $this->carouselItemsContent = [];
        foreach($this->models as $model){
            $caption = sprintf('<h1>Rate #%d</h1>',$model->rateid);
            $diff = $model->getDiffFromTheDayBefore();
            $content = sprintf('%s %s RUB %s',$model->quote->shortname,Yii::$app->formatter->asDecimal($model->lastdeal),($diff < 0) ? '-'.$diff.'%' : '+'.$diff.'%');
            $itemContent = ['content' => $content, 'caption' => $caption];
            $this->carouselItemsContent[] = $itemContent;
        }
    }

    public function run(){
        return $this->render('carousel',['carouselItemsContent' => $this->carouselItemsContent]);
    }
}