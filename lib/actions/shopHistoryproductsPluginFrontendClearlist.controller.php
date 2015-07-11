<?php

class shopHistoryproductsPluginFrontendClearlistController extends waJsonController {

    public function execute() {
        $session = wa()->getStorage();
        $session->write('history_products', array());
        $session->close();
    }

}
