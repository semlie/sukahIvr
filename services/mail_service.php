<?php

require_once realpath(dirname(__FILE__)) . '/../models/order_item.php';
require_once realpath(dirname(__FILE__)) . '/../models/order_item_print.php';
require_once realpath(dirname(__FILE__)) . '/../models/order.php';
require_once realpath(dirname(__FILE__)) . '/order_manager.php';

class mail_service {

    private $orderManager;

    function __construct() {
        $this->orderManager = new order_manager();
    }

    //put your code here

    public function sendOrderToAdmin($cidNumber, $order, $orderItems, $area) {
        $msg = $this->msgTemplate($cidNumber, $order, $orderItems, $area);
        
        $email = $this->GetRegionAdmin($area);
        $this->sendEmail($email, "israellieb@gmail.com", "new order {$order->Id}", $msg);
        $this->sendEmail("israellieb@gmail.com", "israellieb@gmail.com", "new order {$order->Id}", $msg);
        $this->sendEmail("arieh.global4less@gmail.com", "israellieb@gmail.com", "new order {$order->Id}", $msg);
    }

    private function msgTemplate($cidNumber, order $order, $orderItems, $area = "9") {
        $mapItems = array_map(array($this, 'msgOrderItemArrayTemplate'), $orderItems);
        $msgHeader = sprintf('<h1>order from line : %1$s </h1><hr> <p> total order : %2$s</p>'
                . '<p> total items : %3$s</p>'
                . '<p> total quntity : %4$s</p>'
                . '<p> Area : %5$s</p>', $cidNumber['PhoneNumber'], $order->TotalPrice, $order->TotalItems, $order->TotalQuantity, $area);
        $msg = sprintf('<table border="1" style="width:100%%">
            <tr>
              <td>Product CatalogNumber</td>
              <td>Product Name</td>
              <td>Quntitny</td> 
              <td>Unit Price</td>
              <td>Price</td>
            </tr>
            %1$s
          </table>', implode(" ", $mapItems));
        return $msgHeader . $msg;
    }

    private function msgOrderItemArrayTemplate(order_item_print $orderItem) {
        $arr = sprintf('<tr>
              <td>%1$s</td>
              <td>%2$s</td> 
              <td>%3$s</td>
              <td>%4$s</td>
              <td>%5$s</td>
            </tr>', $orderItem->ProductId, $orderItem->ProductName, $orderItem->Quantity, $orderItem->PriceUnit, $orderItem->PriceOrderItem);
        return $arr;
    }

    private function sendEmail($to, $from, $subject, $msg) {
        $message = "
            <html>
            <head>
            <title>new order</title>
            </head>
            <body>
            {$msg}
            </body>
            </html>
            ";

// Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
        $headers .= "From: " . $from . "\r\n";
        mail($to, $subject, $message, $headers);
    }

    private function GetRegionAdmin($area) {
        $email = '';
        switch ($area) {
            case "1"://ofakim
                $email = 'israellieb@gmail.com';
                break;

            case "2"://ashdod
                $email = 'israellieb@gmail.com';
                break;

            case "3"://beni brak
                $email = 'israellieb@gmail.com';
                break;

            case "4"://bitar
                $email = 'arieh.global4less@gmail.com';
                break;

            case "5"://bait shmes
                $email = 'yonizeavi11@gmail.com';
                break;

            case "6"://jerusalem
                $email = 'yoseflekach@gmail.com';
                break;

            case "7"://modien
                $email = 'israellieb@gmail.com';
                break;

            case "8": //elad
                $email = 'israellieb@gmail.com';
                break;

            default://other
                $email = 'israellieb@gmail.com';

            // code to be executed if n is different from all labels;
        }
        return $email;
    }

}
