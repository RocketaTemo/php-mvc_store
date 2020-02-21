<?php
class Breadcrumbs{

public static function getBreadcrumbs($current_category_id, $name = ''){

    $cats= Category::getCategories();//получаем список вcех категорий

    $breadcrumbs_array = self::getParts($cats, $current_category_id);

    $breadcrumbs = "<a href='\'><span>ГЛАВНАЯ </span></a>";

    if($breadcrumbs_array){
        foreach($breadcrumbs_array as $alias => $title){
             $breadcrumbs .= "<li><a href='/category/{$alias}'>{$title}</a></li> ";
        }
    }
    if($name){
        $breadcrumbs .= "<li>$name</li>";
    }

    return $breadcrumbs;
}
/**
 *@param $cats - все категории
 *@param $id - текущая категория
 */
private static function getParts($cats, $id){

    if(!$id) return false;

    $breadcrumbs = [];

    foreach($cats as $k => $v){
        if(isset($cats[$id])){
            $breadcrumbs[$cats[$id]['alias']] = $cats[$id]['name'];
            $id = $cats[$id]['parent_id'];
        }else break;
    }

    return array_reverse($breadcrumbs, true);
}

}