<?php foreach($this->groups as $group_id => $group_item):?>
    <section class="filter-form">
            <div class="filter-block">
                <h4><?=$group_item;?></h4>
                <ul class="filter-list">
                    <?php foreach($this->attrs[$group_id] as $attr_id => $value):?>
                        <li>
                            <label class="checkbox">
                                <input type="checkbox" name="checkbox" value="<?=$attr_id?>"><?=$value?>
                            </label>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
    </section>
<?php endforeach;?>