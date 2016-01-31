<?php
    $styleOption = isset($this->context->options['style'])?$this->context->options['style']:'';
?>
<div id="<?php echo $this->context->carouselId;?>" style="<?php echo $styleOption;?>">
    <?php
        echo \yii\bootstrap\Carousel::widget([
            'id' => $this->context->carouselId,
            'items' => $carouselItemsContent
        ]);
    ?>
</div>