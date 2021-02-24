<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <link rel="stylesheet" href="/node_modules/angular-material/angular-material.css">

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css?1111" . />

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <script src="/node_modules/angular/angular.js"></script>
    <script src="/node_modules/angular-aria/angular-aria.js"></script>
    <script src="/node_modules/angular-animate/angular-animate.js"></script>
    <script src="/node_modules/angular-messages/angular-messages.js"></script>
    <script src="/node_modules/angular-material/angular-material.js"></script>
</head>

<body ng-app="AdminPanel">

<div class="container" id="page">
    <div ng-controller="AdminPanelController">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2 class="md-flex"><?= CHtml::encode(Yii::app()->name) ?></h2>
            </div>

            <section layout="row" layout-sm="column" layout-align="left left" layout-wrap>
                <div ng-repeat="item in mainMenus">
                    <md-button ng-if="item.visible === 1" ng-href="{{item.url}}">{{item.label}}</md-button>
                </div>
            </section>
        </md-toolbar>
        <?php echo $content; ?>
    </div>
    <script type="application/javascript">
        var mainMenus = [
            {
                label: 'Home',
                url: '/',
                visible: 1,
            },
            {
                label: 'Comments',
                url: '/comments/',
                visible: <?= (int)!Yii::app()->user->isGuest ?>,
            },
            {
                label: 'Login',
                url: '/site/login',
                visible: <?= (int)Yii::app()->user->isGuest ?>,
            },
            {
                label: 'Logout (<?= Yii::app()->user->name ?>)',
                url: '/site/logout',
                visible: <?= (int)!Yii::app()->user->isGuest ?>,
            },
        ];
    </script>
    <script src="/js/app/main.js?11111111111"></script>
    <section layout="row" layout-sm="column" layout-align="center center" layout-wrap>
        <?= Yii::app()->params->copyrightInfo ?>
        <?= Yii::powered() ?>
    </section>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
</div><!-- page -->

</body>
</html>