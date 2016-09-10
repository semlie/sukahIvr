<?php

require_once realpath(dirname(__FILE__)) . '/iproduct_manager.php';
require_once realpath(dirname(__FILE__)) . '/product_dataService.php';
require_once realpath(dirname(__FILE__)) . '/../models/product.php';

class product_manager implements iproduct_manager {

    private $productDataService;

    function __construct() {
        $this->productDataService = new product_dataService();
    }

    public function getProbuctById($productId) {
        $result = $this->productDataService->getById($productId);
        if (!empty($result)) {
            return $result;
        }
        return '';
    }
    
        public function GetProductByCatalogNumber($catalogNumber) {
        $result = $this->productDataService->GetProductByCatalogNumber($catalogNumber);
        Return $result;
    }

    public function mapProductToArray(product $product) {
        $row = array();
        $row[] = $product->CatalogNumber;

        if (!empty($product->Price)) {
            $row[] = 'price';
            $row[] = $product->Price;
        }
        return $row;
    }

//put your code here
}
