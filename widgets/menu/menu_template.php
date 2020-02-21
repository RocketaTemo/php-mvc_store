
<li>
<a href="<?= "/category/".$category['alias']?>"><span><img src="<?=$category['img']?>"/><?= $category['name']?></a></span>

        <?php if(isset($category['childs'])): ?>
            <ul>
                <? $this->getMenuHtml($category['childs']); ?>
            </ul>
        <?php endif;?>
</li>