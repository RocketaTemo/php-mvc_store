<?php
Class Filter{
    public $groups;
    public $attrs;

    public function __construct($categoryAlias){
        $this->groups = $this->getGroups($categoryAlias);
        $this->attrs = self::getAttrs();
        $this->run();
    }

    public function run(){
        $filters = $this->getHtml();
        echo $filters;
    }

    //получаем группы фильтров
    protected function getGroups($category){
        $db = DB::getConnect();
        $sql = "SELECT id_attribute, name_attribute
                    FROM attribute_group
                        WHERE alias = :category";
        $res = $db->prepare($sql);
        $res->bindParam(':category', $category, PDO::PARAM_STR);
        $res->execute();
        $data = $res->fetchAll(PDO::FETCH_ASSOC);
        debug($data);
        $groups=[];
        foreach ($data as $key => $value) {
            $groups[$value['id_attribute']] = $value['name_attribute'];
        }

        return $groups;
    }

    protected static function getAttrs(){

        $db = DB::getConnect();
        $sql = "SELECT * FROM attribute_value";
        $res = $db->query($sql);
        $data = $res->fetchAll(PDO::FETCH_UNIQUE);
        $attrs=[];
        foreach ($data as $key => $value) {
            $attrs[$value['id_attr_group']][$key] = $value['value'];
        }
        return $attrs;
    }

    protected function getHtml(){
        ob_start();
        require ROOT . '/widgets/filter/filter_template.php';
        return ob_get_clean();
    }

    public static function getFilter()
    {
        $filter = null;
        if(!empty($_POST['filter'])){
            $filter = preg_replace("#[^\d,]+#", '', $_POST['filter']);
            $filter = rtrim($filter, ',');
        }
        return $filter;
    }

    public static function getCountGroups($filter)
    {
        $filters = explode(',', $filter);
        $attrs = self::getAttrs();
        $data = [];
        foreach ($attrs as $key => $item){
            foreach ($item as $k => $v){
                if(in_array($k, $filters)){
                    $data[] = $key;
                }
            }
        }
        return count($data);
    }
}