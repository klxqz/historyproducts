<?php

class shopHistoryproductsPlugin extends shopPlugin {

    public static $plugin_id = array('shop', 'historyproducts');
    public static $tmp_path = 'plugins/historyproducts/templates/Historyproducts.html';

    public function frontendProduct($product) {
        $this->addProduct($product->id);
    }

    public function frontendNav() {
        if ($this->getSettings('default_output')) {
            return self::display();
        }
    }

    public static function products($count = null) {
        $app_settings_model = new waAppSettingsModel();
        $settings = $app_settings_model->get(self::$plugin_id);

        if ($count) {
            $count = $settings['count'];
        }

        $collection = new shopHistoryproductsProductsCollection();
        $collection->historyproductsFilter();
        $products = $collection->getProducts('*', 0, $count);
        return $products;
    }

    public function addProduct($product_id) {
        $session = wa()->getStorage();
        $history_products = $session->read('history_products');

        if (empty($history_products) || !is_array($history_products)) {
            $history_products = array();
        }

        if (($key = array_search($product_id, $history_products)) !== FALSE) {
            unset($history_products[$key]);
        }
        array_push($history_products, $product_id);

        $session->write('history_products', $history_products);
        $session->close();
    }

    public static function display() {


        $app_settings_model = new waAppSettingsModel();
        $settings = $app_settings_model->get(self::$plugin_id);

        if (empty($settings['status'])) {
            return;
        }

        $products = shopHistoryproductsPlugin::products($settings['count']);
        $view = wa()->getView();
        $view->assign('settings', $settings);
        $view->assign('h_products', $products);

        $template_path = wa()->getDataPath(shopHistoryproductsPlugin::$tmp_path, false, 'shop', true);
        if (!file_exists($template_path)) {
            $template_path = wa()->getAppPath(shopHistoryproductsPlugin::$tmp_path, 'shop');
        }

        $html = $view->fetch($template_path);
        return $html;
    }

    public function routing($route = array()) {

        return array(
            $this->getSettings('page_url') => 'frontend/historyproducts',
            'historyproducts/clearlist/' => 'frontend/clearlist',
        );
    }

}
