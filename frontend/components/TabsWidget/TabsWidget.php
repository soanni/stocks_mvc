<?php

namespace frontend\components\TabsWidget;

use yii\base\Widget;
use yii\helpers\Html;
use yii;

class TabsWidget extends Widget
{
    public $tabId = 'tabWidget_0';
    public $models = [];
    public $options = [];

    private $items;

    public function init()
    {
        $items = array();
        $countries = [];
        $indeces_content = [];
        foreach($this->models as $model){
            if(!empty($model->quote->indeces)){
                foreach($model->quote->indeces as $index){
                    $name = $index->exchange->country->countryname;
                    if(!array_key_exists($name,$countries)){
                        $countries[$name] = array();
                        $countries[$name][] = $index->indname;
                    }else{
                        if(!in_array($index->indname,$countries[$name])){
                            $countries[$name][] = $index->indname;
                        }
                    }
                    // fill content for widget
                    if(!array_key_exists($index->indname,$indeces_content)){
                        $indeces_content[$index->indname] = array();
                        $indeces_content[$index->indname][] = $model;
                    }else{
                        $indeces_content[$index->indname][] = $model;
                    }
                }
            }
        }

        foreach($countries as $key => $value){
            $items[] = array('label' => $key, 'items' => array());
            $content = '';
            foreach($value as $item){
                if(!empty($indeces_content[$item])){
                    $content .= Html::beginTag('table',['class' => ['table','table-condensed','table-striped','table-responsive']]);
                    foreach($indeces_content[$item] as $rate){
                        $shortname = $rate->quote->shortname;
                        $qid = $rate->quote->qid;
                        $diff = $rate->getDiffFromTheDayBefore() . '%';
                        $lastdeal = Yii::$app->formatter->asDecimal($rate->lastdeal);
                        //$lastdeal = rtrim($rate->lastdeal,'\0');
                        $content .= $this->makeRow($qid,$rate->ratedate,$shortname,$lastdeal,$diff);
                    }
                    $content .= Html::endTag('table');
                }
                $items[count($items)-1]['items'][] = array('label' => $item,'content' => $content);
                $content = '';
            }
        }
        $this->items = $items;
    }

    public function run(){
        return $this->render('tabs',['items' => $this->items]);
    }

    private function makeRow($qid,$date,$name,$last,$diff){
        $stylePositive = 'color: green';
        $styleNegative = 'color: red';

//        $row = Html::beginTag('div',['id' => 'chart']);
            $row = Html::beginTag('tr',['id' => $qid]);
                $row .= Html::beginTag('td');
                $row .= Html::encode($date);
                $row .= Html::endTag('td');

                $row .= Html::beginTag('td');
                $row .= Html::a(Html::encode($name),null,['class' => 'chart-anchor']);
                $row .= Html::endTag('td');

                $row .= Html::beginTag('td');
                $row .= Html::encode($last);
                $row .= Html::endTag('td');

                $row .= Html::beginTag('td',['style' => ($diff > 0) ? $stylePositive: $styleNegative]);
                $row .= Html::encode($diff);
                $row .= Html::endTag('td');

            $row .= Html::endTag('tr');
//        $row .= Html::endTag('div');
        return $row;
    }
}