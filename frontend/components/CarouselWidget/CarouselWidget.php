<?php

namespace frontend\components\CarouselWidget;

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
            $content = sprintf('%s %0.2f RUB %s',$model->quote->shortname,$model->closerate,$model->getDiffFromTheDayBefore());
            $itemContent = ['content' => $content, 'caption' => $caption];
            $this->carouselItemsContent[] = $itemContent;
        }
    }

    public function run(){
        return $this->render('carousel',['carouselItemsContent' => $this->carouselItemsContent]);
    }
}