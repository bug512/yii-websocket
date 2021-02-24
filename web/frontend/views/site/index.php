<?php
/**
 * @var \common\models\Comment $model
 * @var bool $duplicate
 */
$this->pageTitle = Yii::app()->name . ' - Main';
?>
<script>
    var modelComment = <?=json_encode($model)?>;
</script>
<md-content style="min-height: 600px" flex layout-padding flex="25">
    <h1>Frontend panel</h1>

    <p>Panel for writing comments and reading comments from feed.</p>


    <section ng-controller="WriteCommentController" layout="row" layout-lg="column" layout-align="center center"
             layout-wrap
             layout-padding layout-margin="">
        <md-card>
            <?php $form = $this->beginWidget('CActiveForm', [
                'id' => 'login-form',
                'enableAjaxValidation' => true,
                'htmlOptions' => [
                    'ng-submit' => 'beforeSubmit()',
                    'onsubmit' => 'return false;',
                ],
            ]); ?>
            <md-card-title>
                <md-card-title-text>
                    <?php if ($model === 'saved') : ?>
                        <span class="md-headline">Your comment has been saved</span>
                    <?php else : ?>
                        <span class="md-headline">Write comment</span>
                        <?php if (isset($duplicate) && $duplicate === true) : ?>
                            <span class="error">Your comment is dublicated.</span>
                        <?php endif; ?>
                    <?php endif; ?>
                    <span class="md-subhead">After the comment is approved, you can see it on the page <a
                                ng-href="/comments/">comments feed</a>.</span>
                </md-card-title-text>
            </md-card-title>

            <md-card-content>
                <?php if ($model !== 'saved') : ?>
                    <div layout="column">
                        <md-input-container>
                            <?= $form->labelEx($model, 'author_name') ?>
                            <?= $form->textField($model, 'author_name', [
                                'ng-model' => 'author_name'
                            ]) ?>
                            <?= $form->error($model, 'author_name') ?>
                        </md-input-container>

                        <md-input-container>
                            <?= $form->labelEx($model, 'content') ?>
                            <?= $form->textField($model, 'content', [
                                'ng-model' => 'content'
                            ]) ?>
                            <?= $form->error($model, 'content') ?>
                        </md-input-container>

                        <section layout="row" layout-sm="column" layout-align="center center" layout-margin=""
                                 layout-wrap>
                            <md-button type="submit" class="md-raised md-primary">
                                Save
                            </md-button>
                        </section>
                    </div>
                <?php endif; ?>
            </md-card-content>
            <?php $this->endWidget(); ?>
        </md-card>
    </section>
</md-content>