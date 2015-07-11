<?php

class shopHistoryproductsPluginBackendSaveController extends waJsonController {

    public function execute() {
        try {
            $app_settings_model = new waAppSettingsModel();
            $shop_historyproducts = waRequest::post('shop_historyproducts');

            foreach ($shop_historyproducts as $key => $value) {
                $app_settings_model->set(shopHistoryproductsPlugin::$plugin_id, $key, $value);
            }


            if (isset($shop_historyproducts['reset_tpl']) && $shop_historyproducts['reset_tpl']) {
                $template_path = wa()->getDataPath(shopHistoryproductsPlugin::$tmp_path, false, 'shop', true);
                @unlink($template_path);
            } else {
                $post_template = waRequest::post('template');
                if (!$post_template) {
                    throw new waException(_wp('Do not defined template'));
                }

                $template_path = wa()->getDataPath(shopHistoryproductsPlugin::$tmp_path, false, 'shop', true);
                if (!file_exists($template_path)) {
                    $template_path = wa()->getAppPath(shopHistoryproductsPlugin::$tmp_path, 'shop');
                }

                $template = file_get_contents($template_path);
                if ($template != $post_template) {
                    $template_path = wa()->getDataPath(shopHistoryproductsPlugin::$tmp_path, false, 'shop', true);

                    $f = fopen($template_path, 'w');
                    if (!$f) {
                        throw new waException(_wp('Unable to save the template. Check the write permissions ') . $template_path);
                    }
                    fwrite($f, $post_template);
                    fclose($f);
                }
            }

            $this->response['message'] = _wp('Saved');
        } catch (Exception $e) {
            $this->setError($e->getMessage());
        }
    }

}
