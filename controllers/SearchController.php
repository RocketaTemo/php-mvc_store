<?php
class SearchController
{
    public function actionIndex($keywords){

    if (isset($keywords) and !empty($keywords))
        $productList = Product::findProductsByKeywords(urldecode($keywords));
        foreach ($productList as $product) {
            echo "<li><a href=/product/".$product['id'].">";
            echo $product['name']."</a></li>";
        }
        return true;
    }
}