<?php

return array(
    'name' => _wp('History of visited products'),
    'description' => _wp('List of items that the buyer was looking'),
    'vendor' => '985310',
    'version' => '2.0.0',
    'img' => 'img/historyproducts.png',
    'shop_settings' => true,
    'frontend' => true,
    'handlers' => array(
        'frontend_nav' => 'frontendNav',
        'frontend_product' => 'frontendProduct',
        'routing' => 'routing',
    ),
);
//EOF
