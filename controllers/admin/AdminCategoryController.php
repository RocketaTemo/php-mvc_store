<?php
/**
 *Контроллер для управления категроиями
 */
class AdminCategoryController extends AdminBase
{
    public function actionIndex()
    {
        //проверка доступа
        if (!self::checkAdmin()) {
            exit("У вас нет доступа к этому разделу!");
        }

        $categories = Category::getCategoryListAdmin();
        require_once ROOT . '/views/admin_category/index.php';
    }

    public function actionAdd()
    {
        //проверка доступа
        if (!self::checkAdmin()) {
            exit("У вас нет доступа к этому разделу!");
        }
        //Принимаем данные из формы
        if (isset($_POST) and !empty($_POST)) {
            $options['id'] = trim(strip_tags($_POST['id']));
            $options['name'] = trim(strip_tags($_POST['name']));

            Category::addCategory($options);

            header('Location: /admin/category');
        }

        require_once ROOT . '/views/admin_category/add.php';
        return true;
    }
    public function actionDelete ($id) {

        //проверка доступа
        self::checkAdmin();

        //Проверяем форму
        if (isset($_POST['submit'])) {
            //Если отправлена, то удаляем нужный товар
            Category::deleteCategoryById($id);
            //и перенаправляем на страницу товаров
            header('Location: /admin/category');
        }

        require_once ROOT . '/views/admin_category/delete.php';
        return true;
    }
}