<?php


require realpath(dirname(__FILE__)) .'/services/product_manager.php';



$a = new product_manager();

$b = $a->GetProductByCatalogNumber('101');
$b = $a->GetProductByCatalogNumber('145');

var_dump($b);


