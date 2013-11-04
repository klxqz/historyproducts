<?php


class shopHistoryproductsPlugin extends shopPlugin
{
    protected $plugin_id = array('shop', 'historyproducts');
    
    public function frontendProduct($product)
    {
        $this->addHistoryproduct($product->id);
    }
    
    public function frontendNav()
    {
        if($this->getSettings('default_output')) {
            return self::display();
        }
    }
    
    public static function getHistoryproducts($sort = null, $count = 5)
    {
        $products=array();
        $session=wa()->getStorage();
        $history_products = $session->read('history_products');
        
        if($history_products) {
            
            if($sort) {
                $history_products = array_reverse($history_products);
            }
            
            if($count) {
                $history_products=array_slice($history_products,0,$count);
            }
            
            foreach($history_products as $product_id) {
                $product_model = new shopProductModel();
                $product = $product_model->getById($product_id);
                $product['frontend_url'] = wa()->getRouteUrl('/frontend/product', array('product_url' => $product['url']));
                $products[] = $product;
            }            
        }
        
        return $products;
    }
    
    public function addHistoryproduct($product_id)
    {
        $session = wa()->getStorage();   
        $history_products = $session->read('history_products');       
                
        if(!$history_products || !is_array($history_products)) {
            $history_products = array();
        }
        
        if(!in_array($product_id,$history_products)) {               
            array_push($history_products,$product_id);
        }
            
        $session->write('history_products',$history_products);
        $session->close();
    }
    
    public static function display()
    {
        $plugin_id = array('shop', 'historyproducts');
        $tmp_path = 'plugins/historyproducts/templates/Historyproducts.html';
        
        $app_settings_model = new waAppSettingsModel();
        $status = $app_settings_model->get($plugin_id,'status');

        if(!$status) {
            return;
        }
        
        $sort = $app_settings_model->get($plugin_id, 'sort');
        $count = $app_settings_model->get($plugin_id, 'count');
            
        $products = shopHistoryproductsPlugin::getHistoryproducts($sort, $count);

        $view = wa()->getView();
        $view->assign('h_products', $products);
        
        $template_path = wa()->getDataPath($tmp_path, false, 'shop', true);
        if(!file_exists($template_path)) {
            $template_path =wa()->getAppPath($tmp_path,  'shop');
        }
        
		$html = $view->fetch($template_path);
        return $html;
    }
}

