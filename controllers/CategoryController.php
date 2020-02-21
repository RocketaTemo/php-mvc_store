<?php
/*
 * Class CategoryController
 * Контроллер для работы с каталогом товаров
 */
class CategoryController {

    /*
     * Просмотр товаров по выбранной категории
     * @param $categoryName название категории
     * @return bool
     */
    public function actionCategory($categoryAlias){
        $item_tpl = '/views/catalog/item_tpl.php';
        $category = Category::getCategoryByAlias($categoryAlias);
        $errors='';
        //хлебные крошки
        $breadcrumbs = Breadcrumbs::getBreadcrumbs($category['id']);
        if(!empty($_POST['filter']))
        {
            $filter = Filter::getFilter();

            if($filter){
                $count = Filter::getCountGroups($filter);
                $sql_part = "AND id IN (SELECT product_id FROM attribute_product WHERE attr_id IN ($filter) GROUP BY product_id HAVING COUNT(product_id) = $count)";
                $products = Product::getProductListByCatId($category['id'], $sql_part, strip_tags($_POST['sort']));
                exit( require_once ROOT.$item_tpl );
            }
        }

        elseif(!empty($_POST['sort'])){
            $products = Product::getProductListByCatId($category['id'], '', strip_tags($_POST['sort']));
            exit( require_once ROOT.$item_tpl );
        }

        $products = Product::getProductListByCatId($category['id'], '', '');
        //Товары из категории
        require_once ROOT . '/views/catalog/category.php';
        return true;
    }
}