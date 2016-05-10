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

function build_query($user_search,$sort){
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

    switch ($sort){
        case 1:
            $search_query .= " order by title";
            break;
        case 2:
            $search_query .= " order by title desc";
            break;
        case 3:
            $search_query .= " order by state";
            break;
        case 4:
            $search_query .= " order by state desc";
            break;
        case 5:
            $search_query .= " order by date_posted";
            break;
        case 6:
            $search_query .= " order by date_posted desc";
            break;
        default:
            break;

    }
    return $search_query;
}

function generate_sort_links($user_search,$sort){
    $sort_links = '';

    switch ($sort){
        case 1:
            $sort_links .= '<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=2">Job Title</a></td>
<td>Description</td>
<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=3">State</a></td>
<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=5">Date Posted</a></td>';
            break;
        case 3:
            $sort_links .= '<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=1">Job Title</a></td>
<td>Description</td>
<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=4">State</a></td>
<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=5">Date Posted</a></td>';
            break;
        case 5:
            $sort_links .= '<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=1">Job Title</a></td>
<td>Description</td>
<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=3">State</a></td>
<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=6">Date Posted</a></td>';
            break;
        default:
            $sort_links .= '<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=1">Job Title</a></td>
<td>Description</td>
<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=3">State</a></td>
<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=5">Date Posted</a></td>';
            break;

    }
    return $sort_links;

}

?>