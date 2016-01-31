<?php

namespace frontend\components\TabsWidget;

use yii\base\Widget;

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
                    $name = $index->country->countryname;
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
                    $content = '<table>';
                    foreach($indeces_content[$item] as $rate){
                        $shortname = $rate->quote->shortname;
                        $diff = $rate->getDiffFromTheDayBefore();
                        $content .= "<tr>
                        <td>$rate->ratedate</td>
                        <td>$shortname</td>
                        <td>$rate->lastdeal</td>
                        <td>$diff</td>
                        </tr>";
                    }
                    $content .= '</table>';
                }
                $items[count($items)-1]['items'][] = array('label' => $item,'content' => $content);
            }
        }
        $this->items = $items;
    }

    public function run(){
        return $this->render('tabs',['items' => $this->items]);
    }
}