<?php
/**
 * Created by PhpStorm.
 * User: FRESHIELD
 * Date: 2016/5/14
 * Time: 14:46
 */

function checkBalance($balance){
    if($balance < 1000){
        throw new Exception("Balance is less than $1000");
    }

    return true;
}

try{
    checkBalance(999);
    echo "Balance is above $1000";
}
catch(Exception $e){
    echo "Error: ".$e->getMessage();
}

?>