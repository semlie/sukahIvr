<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Admin
 */
interface ICaller_manager {
    //put your code here
    
    public function GetCallerIdByNumber($number);
    public function GetCallerItem($number);
    
}
