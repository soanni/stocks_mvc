<?php
    $styleOption = isset($this->context->options['style'])?$this->context->options['style']:'';
?>
<div id="<?php echo $this->context->tabId;?>" style="<?php echo $styleOption;?>">
    <?php echo \yii\bootstrap\Tabs::widget(
        [
            'id' => $this->context->tabId,
            'items' => $items
        ]);
    ?>
</div>