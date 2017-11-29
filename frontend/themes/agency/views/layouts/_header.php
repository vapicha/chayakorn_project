   <!-- Navigation -->
   <?php
   use yii\helpers\Html;
   use yii\bootstrap\Nav;
   use yii\bootstrap\NavBar;
   use yii\helpers\ArrayHelper;
    $class = !isset($class)?'':$class;
    if(Yii::$app->layout == 'homepage'){
        $menus = [
            ['label' => 'Home', 'url' => ['/site/index']],
            // ['label' => 'Service', 'url' =>'#services','linkOptions'=>['class'=>'page-scroll']],
            // ['label' => 'กิจกรรม', 'url' =>'#portfolio','linkOptions'=>['class'=>'page-scroll']],
            ['label' => 'About', 'url' =>'#about','linkOptions'=>['class'=>'page-scroll']],
            //['label' => 'Team', 'url' =>'#team','linkOptions'=>['class'=>'page-scroll']],
            ['label' => 'Contact', 'url' =>'#contact','linkOptions'=>['class'=>'page-scroll']],
        ];
        if(!Yii::$app->user->isGuest){
            $menus[] = ['label' => 'กิจกรรม', 'url' =>'#portfolio','linkOptions'=>['class'=>'page-scroll']];
        }
    }else{
          $menus = [
            ['label' => 'Home', 'url' => ['/site/index']],
            // ['label' => 'Service', 'url' =>['index','#'=>'services'],'linkOptions'=>['class'=>'page-scroll']],
            // ['label' => 'กิจกรรม', 'url' =>['index','#'=>'portfolio'],'linkOptions'=>['class'=>'page-scroll']],
            ['label' => 'About', 'url' =>['site/index','#'=>'about'],'linkOptions'=>['class'=>'page-scroll']],
            //['label' => 'Team', 'url' =>['index','#'=>'team'],'linkOptions'=>['class'=>'page-scroll']],
            ['label' => 'Contact', 'url' =>['site/index','#'=>'contact'],'linkOptions'=>['class'=>'page-scroll']],
        ];
        if(!Yii::$app->user->isGuest){
            $menus[] = ['label' => 'กิจกรรม', 'url' =>['site/index','#'=>'portfolio'],'linkOptions'=>['class'=>'page-scroll']];
        }
    }
   ?>

<?php
    $options = ['navbar','navbar-default','navbar-fixed-top'];
    NavBar::begin([
        'brandLabel' => 'Ladlhumkeaw Meditation Center',
        'brandUrl' => Yii::$app->homeUrl,
        'brandOptions'=>[
            'class'=>'navbar-header page-scroll'
        ],
        'options' => [
            'class' => 'navbar navbar-default navbar-fixed-top '.$class,
        ],
    ]);
    // $item_plus = ['label' => 'Demo', 'items'=>[
    //                 ['label' => 'About', 'url' => ['/site/about']],
    //                 ['label' => 'Contact', 'url' => ['/site/contact']],
    //             ]];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' =>ArrayHelper::merge($menus,
           [ 
            
            Yii::$app->user->isGuest ?
                ['label' => 'Login', 'url' => ['/site/login']] :
                ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']],
        ]),
    ]);
    NavBar::end();
?>
