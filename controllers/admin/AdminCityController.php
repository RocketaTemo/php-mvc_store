<?php
// Котрроллер Городов
class AdminCityController extends AdminBase{

    /**
     * Просмотр всех городов
     * @return bool
     */
    public function actionIndex () {
        //проверка доступа
        if(!self::checkAdmin())
            exit("У вас нет доступа к этому разделу!");

        //выводим список всех городов
        $cities = City::getCitiesList();

        require_once ROOT . "/views/admin_city/index.php";
        return true;
    }
    //Добавление новых городов
    public function actionAdd () {
        //проверка доступа
        if(!self::checkAdmin())
            exit("У вас нет доступа к этому разделу!");
        //Принимаем данные из формы
        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
            $options['region'] = trim(strip_tags($_POST['region']));
            $options['postcode'] = trim(strip_tags($_POST['postcode']));
            //Если все ок, записываем новый товар
            City::addCity($options);
            header('Location: /admin/city');
        }
        require_once ROOT . '/views/admin_city/add.php';
        return true;
    }
    //Редактирование города
    public function actionEdit ($cityId) {
        //проверка доступа
        if(!self::checkAdmin())
            exit("У вас нет доступа к этому разделу!");

        $city = City::getCityById($cityId);
        //Принимаем данные из формы
        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
            $options['region'] = trim(strip_tags($_POST['region']));
            $options['postcode'] = trim(strip_tags($_POST['postcode']));
            //Если все ок, записываем новый товар
            City::editCity($cityId,$options);
            header('Location: /admin/city');
        }
        require_once ROOT . '/views/admin_city/edit.php';
        return true;
    }
    // Удаление города
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

        require_once ROOT . '/views/admin_city/delete.php';
        return true;
    }

}