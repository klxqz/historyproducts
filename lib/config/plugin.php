<?php

return array(
    'name' => 'История просмотренных товаров',
    'description' => 'История просмотренных товаров',
    'vendor' => '985310',
    'version' => '1.0.4',
    'img' => 'img/historyproducts.png',
    'shop_settings' => true,
    'frontend' => true,
    'icons' => array(
        16 => 'img/historyproducts.png',
    ),
    'handlers' => array(
        'frontend_nav' => 'frontendNav',
        'frontend_product' => 'frontendProduct'
    ),
);
//EOF
