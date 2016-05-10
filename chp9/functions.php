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

function generate_sort_links($user_search,$sort,$cur_page){
    $sort_links = '';

    switch ($sort){
        case 1:
            $sort_links .= '<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=2&page='.$cur_page.'">Job Title</a></td>
<td>Description</td>
<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=3&page='.$cur_page.'">State</a></td>
<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=5&page='.$cur_page.'">Date Posted</a></td>';
            break;
        case 3:
            $sort_links .= '<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=1&page='.$cur_page.'">Job Title</a></td>
<td>Description</td>
<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=4&page='.$cur_page.'">State</a></td>
<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=5&page='.$cur_page.'">Date Posted</a></td>';
            break;
        case 5:
            $sort_links .= '<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=1&page='.$cur_page.'">Job Title</a></td>
<td>Description</td>
<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=3&page='.$cur_page.'">State</a></td>
<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=6&page='.$cur_page.'">Date Posted</a></td>';
            break;
        default:
            $sort_links .= '<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=1&page='.$cur_page.'">Job Title</a></td>
<td>Description</td>
<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=3&page='.$cur_page.'">State</a></td>
<td><a href="'.$_SERVER['PHP_SELF'].'?usersearch='.$user_search.'&sort=5&page='.$cur_page.'">Date Posted</a></td>';
            break;

    }
    return $sort_links;

}

function generate_page_links($user_search,$sort,$cur_page,$num_page){
    $page_link = '';

    if($cur_page != 1){
        $page_link .= "<a href='{$_SERVER['PHP_SELF']}?usersearch=$user_search&sort=$sort&page=".($cur_page-1)."'><-</a>";
    }
    else{
        $page_link .= "<- ";
    }

    for($i = 1;$i <= $num_page;$i++){
        if($i == $cur_page){
            $page_link .= ' '.$i;
        }
        else{
            $page_link .="<a href='{$_SERVER['PHP_SELF']}?usersearch=$user_search&sort=$sort&page=$i'> 
$i</a>";
        }
    }

    if($cur_page != $num_page){
        $page_link .= "<a href='{$_SERVER['PHP_SELF']}?usersearch=$user_search&sort=$sort&page=".($cur_page+1)."'>-></a>";
    }
    else{
        $page_link .= ' ->';
    }
    return $page_link;
}

?>