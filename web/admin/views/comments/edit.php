<?php
$this->pageTitle = Yii::app()->name . ' - Edit';
?>
<section ng-controller="EditCommentController" layout="row" layout-lg="column" layout-align="center center" layout-wrap  layout-padding layout-margin="">
    <md-card style="width: 50%">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'edit-comment-form',
            'enableAjaxValidation' => true,
        )); ?>
        <md-card-title>
            <md-card-title-text>
                <span class="md-headline">Edit comment</span>
            </md-card-title-text>
        </md-card-title>

        <md-card-content>
            <div layout="column">
                <md-input-container>
                    <?= $form->labelEx($model, 'author_name') ?>
                    <?= $form->textField($model, 'author_name') ?>
                    <?= $form->error($model, 'author_name') ?>
                </md-input-container>

                <md-input-container>
                    <?= $form->labelEx($model, 'create_time') ?>
                    <?= $form->textField($model, 'create_time') ?>
                    <?php if ($model->hasErrors('create_time')) : ?>
                        <md-error><?= $model->getError('create_time') ?></md-error>
                    <?php endif; ?>
                </md-input-container>

                <md-input-container>
                    <?= $form->labelEx($model, 'content') ?>
                    <?= $form->textField($model, 'content') ?>
                    <?= $form->error($model, 'content') ?>
                </md-input-container>

                <section layout="row" layout-sm="column" layout-align="center center" layout-margin="" layout-wrap>
                    <md-button type="submit" class="md-raised md-primary">
                        Save
                    </md-button>
                </section>
            </div>
        </md-card-content>
        <?php $this->endWidget(); ?>
    </md-card>
</section>
