<?php

class shopHistoryproductsProductsCollection extends shopProductsCollection {

    public function historyproductsFilter() {

        $session = wa()->getStorage();
        $history_products = $session->read('history_products');
        $history_products = array_reverse($history_products);

        if (!empty($history_products)) {
            $this->where[] = "`p`.`id` IN (" . implode(',', $history_products) . ")";
            $this->order_by = "FIELD(`id`," . implode(',', $history_products) . ")";
        } else {
            $this->where[] = "`p`.`id` IN (NULL)";
        }

        $this->prepared = true;
        $this->filtered = true;
    }

}
