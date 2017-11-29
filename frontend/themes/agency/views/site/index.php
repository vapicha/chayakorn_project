    <?php

    Yii::$app->layout='homepage';
    $this->title = 'Lalhumkeaw meditation center';
   $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@agency/dist');
   ?>
   <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Welcome to Ladlumkeaw</div>
                <div class="intro-heading">The place to train people to be good.</div>
                <a href="#services" class="page-scroll btn btn-xl">เรียนรู้เพิ่มเติม</a>
            </div>
        </div>
    </header>

    <?php //echo $this->render('_service.php',['directoryAsset'=>$directoryAsset ]) ?>
    <?php
        if(!Yii::$app->user->isGuest){
            echo $this->render('_portfolio.php',['directoryAsset'=>$directoryAsset ]);
        }
    ?>
    <?= $this->render('_about.php',['directoryAsset'=>$directoryAsset ]) ?>
    <?php //echo $this->render('_team.php',['directoryAsset'=>$directoryAsset ]) ?>
    <?= $this->render('_client.php',['directoryAsset'=>$directoryAsset ]) ?>
    <?= $this->render('_contact.php',['directoryAsset'=>$directoryAsset ]) ?>
    