<?php
/**
*Дерево категорий
**/
class Menu{
    protected $data;
    protected $tree=[];//дерево категорий
    protected $menuHtml;

    public function __construct(){
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);
    }

    protected function getTree(){
		// Список категорий
		$data = Category::getCategories();
        foreach ($data as $id => &$node) {
            if(!$node['parent_id'])
                $tree[$id] = &$node;
            else
                $data[$node['parent_id']]['childs'][$id]=&$node;
		}
        return $tree;
    }

    /**
    * Дерево в строку HTML
    */
    protected function getMenuHtml($tree){
        $str = '';
        foreach ($tree as $id => $category) {
            $str.= $this->catToTemplate($category, $id);
        }
            echo $str;
        return $str;
    }

    /**
    * Шаблон вывода категорий
    */
    protected function catToTemplate($category){
        ob_start();
        require ROOT . '/widgets/menu/menu_template.php';
        return ob_get_clean();
    }
}