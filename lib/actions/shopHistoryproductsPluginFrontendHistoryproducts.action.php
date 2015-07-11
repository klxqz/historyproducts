<?php

class shopHistoryproductsPluginFrontendHistoryproductsAction extends shopFrontendAction {

    public function execute() {
        $app_settings_model = new waAppSettingsModel();
        $settings = $app_settings_model->get(shopHistoryproductsPlugin::$plugin_id);

        if (empty($settings['status'])) {
            throw new waException(_ws("Page not found"), 404);
        }

        $collection = new shopHistoryproductsProductsCollection();
        $collection->historyproductsFilter();
        $this->setCollection($collection);

        $this->getResponse()->setTitle($settings['page_title']);
        $this->getResponse()->setMeta('keywords', $settings['meta_keywords']);
        $this->getResponse()->setMeta('description', $settings['meta_description']);

        $this->view->assign('title', $settings['page_title']);
        $this->view->assign('frontend_search', wa()->event('frontend_search'));
        $this->setThemeTemplate('search.html');
    }

}
