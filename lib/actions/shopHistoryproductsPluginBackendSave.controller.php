<?php

class shopHistoryproductsPluginBackendSaveController extends waJsonController {

    protected $tmp_path = 'plugins/historyproducts/templates/Historyproducts.html';
    protected $plugin_id = array('shop', 'historyproducts');
    
    public function execute()
    {
        try {
            $app_settings_model = new waAppSettingsModel();
            $shop_historyproducts = waRequest::post('shop_historyproducts');
            
            $app_settings_model->set($this->plugin_id, 'status', (int) $shop_historyproducts['status']);
            $app_settings_model->set($this->plugin_id, 'default_output', (int) $shop_historyproducts['default_output']);
            $app_settings_model->set($this->plugin_id, 'count', (int) $shop_historyproducts['count']);
            $app_settings_model->set($this->plugin_id, 'sort', (int) $shop_historyproducts['sort']);
            $app_settings_model->set($this->plugin_id, 'page_title', $shop_historyproducts['page_title']);
            
            
            if(isset($shop_historyproducts['reset_tpl']) &&  $shop_historyproducts['reset_tpl']) {
                $template_path =wa()->getDataPath($this->tmp_path, false, 'shop', true);
                @unlink($template_path);
            } else {
                $post_template = waRequest::post('template');
                if(!$post_template) {
                    throw new waException('Не определён шаблон');
                } 
                
                $template_path = wa()->getDataPath($this->tmp_path, false, 'shop', true);
                if(!file_exists($template_path)) {
                    $template_path = wa()->getAppPath($this->tmp_path, 'shop');
                }
                
                $template = file_get_contents($template_path);
                if($template != $post_template) {
                    $template_path = wa()->getDataPath($this->tmp_path, false, 'shop', true);
                    
                    $f = fopen($template_path, 'w');
                    if(!$f) {
                        throw new waException('Не удаётся сохранить шаблон. Проверьте права на запись '.$template_path);
                    } 
                    fwrite($f, $post_template);
                    fclose($f);
                } 
                
            }

            $this->response['message'] = "Сохранено";
        } catch (Exception $e) {
            $this->setError($e->getMessage());
        }
    }
}