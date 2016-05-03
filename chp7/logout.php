<?php
/**
 * Created by PhpStorm.
 * User: FRESHIELD
 * Date: 2016/5/2
 * Time: 16:28
 */
session_start();

if(isset($_SESSION['user_id']) || isset($_SESSION['username'])){
    $_SESSION = array();

    if(isset($_COOKIE[session_name()])){


        setcookie(session_name(),'',time()-1000);

    }
    
    session_destroy();
    
}


setcookie('user_id','',time()-(30*60*60));
setcookie('username','',time()-(30*60*60));

$home_url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'index.php';
header('Location: '.$home_url);

?>