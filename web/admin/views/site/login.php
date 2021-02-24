<?php
$this->pageTitle = Yii::app()->name . ' - Login';
?>
<section ng-controller="LoginController" layout="row" layout-lg="column" layout-align="center center" layout-wrap  layout-padding layout-margin="">
    <md-card>
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'login-form',
            'enableAjaxValidation' => true,
        )); ?>
        <md-card-title>
            <md-card-title-text>
                <span class="md-headline">Login</span>
                <span class="md-subhead">Please fill out the following form with your login credentials:</span>
            </md-card-title-text>
        </md-card-title>

        <md-card-content>
            <div layout="column">
                <md-input-container>
                    <?= $form->labelEx($model, 'username') ?>
                    <?= $form->textField($model, 'username') ?>
                    <?= $form->error($model, 'username') ?>
                </md-input-container>

                <md-input-container>
                    <?= $form->labelEx($model, 'password') ?>
                    <?= $form->passwordField($model, 'password') ?>
                    <?php if ($model->hasErrors('password')) : ?>
                        <md-error><?= $model->getError('password') ?></md-error>
                    <?php endif; ?>
                </md-input-container>
                <div layout="row">
                    <?= $form->checkBox($model, 'rememberMe') ?>
                    <?= $form->label($model, 'rememberMe') ?>
                    <?= $form->error($model, 'rememberMe') ?>
                </div>
                <section layout="row" layout-sm="column" layout-align="center center" layout-margin="" layout-wrap>
                    <md-button type="submit" class="md-raised md-primary">Login</md-button>
                </section>
            </div>
        </md-card-content>
        <?php $this->endWidget(); ?>
    </md-card>
</section>
