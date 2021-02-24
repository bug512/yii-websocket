<?php
$this->pageTitle = Yii::app()->name . ' - Error';
?>
<md-content flex layout-padding flex="25">
    <h1>Error <?= $code ?></h1>

    <div class="error">
        <?= CHtml::encode($message) ?>
    </div>
</md-content>