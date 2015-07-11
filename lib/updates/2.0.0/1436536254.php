<?php

$plugin_id = array('shop', 'historyproducts');
$app_settings_model = new waAppSettingsModel();
$app_settings_model->set($plugin_id, 'page_url', 'historyproducts/');
$app_settings_model->set($plugin_id, 'meta_keywords', '');
$app_settings_model->set($plugin_id, 'meta_description', '');
$app_settings_model->set($plugin_id, 'img_size', '200');
$app_settings_model->set($plugin_id, 'title', _wp('You viewed'));
$app_settings_model->set($plugin_id, 'clearlist', '1');
$app_settings_model->set($plugin_id, 'use_slider', '0');
$app_settings_model->set($plugin_id, 'summary', '1');


