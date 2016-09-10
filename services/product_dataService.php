<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of orderInfo_dataService
 *
 * @author Admin
 */
require_once  realpath(dirname(__FILE__)) . '/data_service.php';
require_once  realpath(dirname(__FILE__)) . '/../models/product.php';
require_once  realpath(dirname(__FILE__)) . '/../models/sql_model.php';
require_once  realpath(dirname(__FILE__)) . '/../config.php';

class product_dataService extends DataService implements sqlModel {



    public function __construct() {
        parent::__construct(Config::getConttext(), "products");
    }

    public function Add(product $product) {

        $result = parent::Add($product);
        $product->Id = $result;
    }

    public function mapToModel($row) {
        $result = new product;
        $result->Id = $row['Id'];
        $result->Name = $row['Name']; 
        $result->CatalogNumber = $row['CatalogNumber'];
        $result->Category = $row['Category'];
        $result->Size = $row['Size'];
        $result->Price = $row['Price'];
        $result->RegularPrice = $row['RegularPrice'];
        $result->TimeStamp = $row['TimeStamp'];

        return $result;
    }
    
    function GetProductByCatalogNumber($catalogNumber) {
        $sql = " SELECT * FROM `ivr_sukkah`.`products` WHERE `products`.`CatalogNumber` = '".$catalogNumber."'";

        $result = $this->selectQuery($sql);
        $row = ($result != FALSE) ? mysqli_fetch_assoc($result) : '';
        $modelResult = ($row > 0) ? $this->mapToModel($row) : '';
        return $modelResult;
        
    }
    public function GetInsertString($product) {
        $sql = "INSERT INTO `ivr_sukkah`.`products`(`Id`,`CatalogNumber`,`Category`,`Size`,`Price`,`RegularPrice`,`Name`)VALUES('',"
        . "'".$product->CatalogNumber."','".$product->Category."','".$product->Size."','".$product->Price."','".$product->RegularPrice."','".$product->Name."');";
        return $sql;
    }

    public function GetUpdateString($callerItem) {
        $sql = "update `OrderItems` set `OrderId` = '" . $callerItem->OrderId . "', `ProductId`='" . $callerItem->ProductId . "', `CollerId` = '" . $callerItem->CollerId . "', `Quantity` ='" . $callerItem->Quantity . "' WHERE `Id` = '" . $callerItem->Id . "'";
        return $sql;
    }

}
