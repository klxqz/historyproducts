<?php

class shopHistoryproductsPluginSettingsAction extends waViewAction {

    public function execute() {
        $app_settings_model = new waAppSettingsModel();
        $settings = $app_settings_model->get(shopHistoryproductsPlugin::$plugin_id);

        $change_tpl = false;

        $template_path = wa()->getDataPath(shopHistoryproductsPlugin::$tmp_path, false, 'shop', true);
        if (file_exists($template_path)) {
            $change_tpl = true;
        } else {
            $template_path = wa()->getAppPath(shopHistoryproductsPlugin::$tmp_path, 'shop');
        }

        $template = file_get_contents($template_path);

        $this->view->assign('settings', $settings);
        $this->view->assign('template', $template);
        $this->view->assign('change_tpl', $change_tpl);
    }

}
