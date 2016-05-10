<?php
/**
 * Created by PhpStorm.
 * User: FRESHIELD
 * Date: 2016/5/9
 * Time: 21:52
 */
function replace_commas($str){
    $new_str = str_replace(',',' ',$str);
    return $new_str;
}

function build_query($user_search){
    $search_query = "select * from riskyjobs";

    $clean_search = replace_commas($user_search);
    $search_words = explode(' ',$clean_search);
    $final_search_words = array();
    if(count($search_words) > 0){
        foreach ($search_words as $word){
            if(!empty($word)){
                $final_search_words[] = $word;
            }
        }
    }
    $where_list = array();
    if(count($final_search_words) > 0){
        foreach ($final_search_words as $word){
            $where_list[] = " description like '%$word%'";
        }
    }

    $where_clause = implode(' OR ',$where_list);

    if(!empty($where_clause)){
        $search_query .= " where $where_clause ";
    }
    return $search_query;
}

?>