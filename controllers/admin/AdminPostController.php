<?php
// Котрроллер Городов
class AdminPostController extends AdminBase{

    /**
     * Просмотр всех отделений почты по городам
     * @return bool
     */
    public function actionIndex () {
        //проверка доступа
        if(!self::checkAdmin())
            exit("У вас нет доступа к этому разделу!");

        //выводим список всех городов
        $posts = PostOffice::getPostList();

        require_once ROOT . "/views/admin_post/index.php";
        return true;
    }
    //Добавление новых отделений почты
    public function actionAdd () {
        //проверка доступа
        if(!self::checkAdmin())
            exit("У вас нет доступа к этому разделу!");
        //Принимаем данные из формы
        if (isset($_POST) and !empty($_POST)) {
            $city = City::getCityByName(trim(strip_tags($_POST['city_id'])));
            $options['city_id'] = $city['id'];
            $options['name'] = trim(strip_tags($_POST['name']));
            $options['location'] = trim(strip_tags($_POST['location']));
            $options['postcode'] = trim(strip_tags($_POST['postcode']));
            //Если все ок, записываем новый товар
            PostOffice::addPost($options);
            header('Location: /admin/post');
        }
        require_once ROOT . '/views/admin_post/add.php';
        return true;
    }
    //Редактирование отделения почты
    public function actionEdit ($postId) {
        //проверка доступа
        if(!self::checkAdmin())
            exit("У вас нет доступа к этому разделу!");

        $post = PostOffice::getPostById($postId);
        //Принимаем данные из формы
        if (isset($_POST) and !empty($_POST)) {
            $city = City::getCityById($_POST['city_id']);
            $options['city_id'] = $city['id'];
            $options['name'] = trim(strip_tags($_POST['name']));
            $options['location'] = trim(strip_tags($_POST['location']));
            $options['postcode'] = trim(strip_tags($_POST['postcode']));
            //Если все ок, записываем новый товар
            PostOffice::editPost($postId,$options);
            header('Location: /admin/post');
        }
        require_once ROOT . '/views/admin_post/edit.php';
        return true;
    }
    // Удаление отделения почты
    public function actionDelete($cityId){
        //проверка доступа
        if(!self::checkAdmin())
            exit("У вас нет доступа к этому разделу!");

        //Проверяем форму
        if (isset($_POST['submit'])) {
            //Если отправлена, то удаляем нужный товар
            City::deleteCity($cityId);
            //и перенаправляем на страницу товаров
            header('Location: /admin/city');
        }

        require_once ROOT . '/views/admin_post/delete.php';
        return true;
    }

}