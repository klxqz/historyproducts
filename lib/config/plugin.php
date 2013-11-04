<?php

return array(
    'name' => 'История просмотренных товаров',
    'description' => 'История просмотренных товаров',
    'vendor'=>903438,
    'version'=>'1.0.3',
    'img'=>'img/historyproducts.png',
    'shop_settings' => true,
    'frontend'    => true,
    'icons'=>array(
        16=>'img/historyproducts.png',
    ),
    'handlers' => array(
        'frontend_nav' => 'frontendNav',
        'frontend_product' => 'frontendProduct'
    ),

);
//EOF
