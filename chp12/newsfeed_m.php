<?php header('Content-Type: text/xml'); ?>
<?php
/**
 * Created by PhpStorm.
 * User: FRESHIELD
 * Date: 2016/5/13
 * Time: 20:03
 */
echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<rss version="2.0">
    <channel>
        <title>Aliens Abducted Me - Newsfeed</title>
        <link>http://127.0.0.1</link>
        <description>Alien abduction reports from around the world courtesy of Owen and his abducted dog Fang.</description>
        <language>en-us</language>
        <?php
        require_once ('connectvars.php');
        $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

        $query = "select abduction_id,first_name,last_name,
        DATE_FORMAT(when_it_happened,'%a, %d %b %Y %T') as when_it_happened_rfc,
        alien_description, what_they_did
        from aliens_abduction order by when_it_happened desc";

        $data = mysqli_query($dbc,$query);

        while($row = mysqli_fetch_array($data)){
            echo "
<item>
    <title>{$row['first_name']} {$row['last_name']}-".substr($row['alien_description'],0,32)."...</title>
    <link>http://127.0.0.1/index.php?abduction_id={$row['abduction_id']}</link>
    <pubDate>{$row['when_it_happened_rfc']} ".date('T')."</pubDate>
    <description>{$row['what_they_did']}</description>
</item>";
        }
        ?>
    </channel>
</rss>
