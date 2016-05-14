<?php
/**
 * Created by PhpStorm.
 * User: FRESHIELD
 * Date: 2016/5/14
 * Time: 14:50
 */

class Song{
    var $title;
    var $lyrice;

    function __construct($title,$lyrics){
        $this->title = $title;
        $this->lyrice = $lyrics;
    }

    function sing(){
        echo "This is called ".$this->title."<br>";
        echo "One, two, three...".$this->lyrice;
    }
}

$shoes_song = new Song('Blue Suede Shoes',"Well it's one for the money...");
$shoes_song->sing();

?>