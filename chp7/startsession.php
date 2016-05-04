<?php
/**
 * Created by PhpStorm.
 * User: FRESHIELD
 * Date: 2016/5/3
 * Time: 20:25
 */
session_start();

if(!isset($_SESSION['user_id'])){
    //echo "1<br>";
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])){
        //echo "2<br>";
        $_SESSION['user_id'] = $_COOKIE['user_id'];
        $_SESSION['username'] = $_COOKIE['username'];
    }
}

?>