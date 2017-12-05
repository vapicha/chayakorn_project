<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@agency' => '@app/themes/agency',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'th',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'image' => [  
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD',  //GD or Imagick
        ],
        'qr' => [
            'class' => '\Da\QrCode\Component\QrCodeComponent',
            // 'label' => 'llk med center',
            'size' => 50 // big and nice :D
            // ... you can configure more properties of the component here
        ]
    ],
];
