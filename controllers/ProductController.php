<?php

class ProductController
{
    public function actionView($productAlias){

        $categories = Category::getCategories();
        $product = Product::getProductByAlias($productAlias);

        //хлебные крошки
        $breadcrumbs = Breadcrumbs::getBreadcrumbs($product['cat_id'], $product['name']);

        //получаем последнии 2 отзыва товара
        $reviews = Review::getTopReviewListByProductId($product['id']);

        //поулучаем кол-во отзывов товара
        $qtyReviews = count(Review::getReviewListByProductId($product['id']));

        require_once ROOT . '/views/single_item/index.php';
        return true;
    }
}