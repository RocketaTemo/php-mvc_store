<?php include (ROOT . '/views/parts/header.php'); ?>
<section>
    <div class="container">
        <ul class="breadcrumbs"><?=$breadcrumbs?></ul>
        <div class="content">
            <div class="filter"><?php new Filter($categoryAlias) ?></div>
            <div id="product_list_block">
                <h1><?=$category['name']?></h1>
                <div class="user_settings">
                    <div class="user_sort">
                        <label for="user_pref">Сортировка по:</label>
                        <select id="user_pref" name="user_pref">
                            <option value="price-asc" selected="">От дешевых к дорогим</option>
                            <option value="price-desc">От дорогих к дешевым</option>
                            <option value="popular">Популярности</option>
                            <option value="newest">Новинкам</option>
                        </select>
                    </div>
                </div>
                <div class="box_items">
                    <?php require_once ROOT.$item_tpl?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="appendix"></div>
<?php include (ROOT . '/views/parts/footer.php'); ?>