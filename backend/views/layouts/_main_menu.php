<?php
    use yii\helpers\Html;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;

    NavBar::begin([
        'brandLabel' => \Yii::$app->settings->site_name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [];
    $Menus = \common\models\Menus::find()
                ->joinWith('menusTranslations')
                ->where(['active'=>1,'is_backend'=>1])
                ->orderBy(['order'=>SORT_ASC])
                ->all();
    //echo"<pre>";print_r($Menus);die;
    if($Menus)
        foreach ($Menus as $Menu) {
           $linkArraY = [];
           $linkArraY['label']= $Menu->menusTranslations->name;
           $linkArraY['url'] = [$Menu->route];

           $menuItems[] = $linkArraY;
        }
    /*$menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];*/
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
?>