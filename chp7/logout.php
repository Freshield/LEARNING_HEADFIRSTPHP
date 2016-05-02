<?php
/**
 * Created by PhpStorm.
 * User: FRESHIELD
 * Date: 2016/5/2
 * Time: 16:28
 */

if(isset($_COOKIE['user_id'])){

    setcookie('username','',time()-1000);
    setcookie('user_id','',time()-1000);

}

$home_url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php';
header('Location: '.$home_url);

?>