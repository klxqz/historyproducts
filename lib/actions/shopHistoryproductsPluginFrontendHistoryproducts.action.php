<?php

class shopHistoryproductsPluginFrontendHistoryproductsAction extends shopFrontendAction
{
    protected $plugin_id = array('shop', 'historyproducts');
    
    public function execute()
    {
        $app_settings_model = new waAppSettingsModel();
        $status = $app_settings_model->get($this->plugin_id, 'status');
        
        if(!$status) {
            throw new waException(_ws("Page not found"),404);
        }
        
        $sort = $app_settings_model->get($this->plugin_id, 'sort');
        $page_title = $app_settings_model->get($this->plugin_id, 'page_title');

        
        $products=shopHistoryproductsPlugin::getHistoryproducts($sort);
        $this->view->assign('products',$products);
        wa()->getResponse()->setTitle($page_title);
        $this->setThemeTemplate('search.html');
    }
}