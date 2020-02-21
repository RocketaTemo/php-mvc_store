<?php
/**
 * Контроллер для работы с личным кабинетом
 */
class CabinetController
{
    /**
     * Основная страница личного кабинета
     * @return bool
     */
     public function actionIndex(){

        //Получаем id пользователя из сессии
        $userId =  User::checkLog();
        //Получаем всю информацию о пользователе из БД
        $userInfo = User::getUserById($userId);
        require_once ROOT . '/views/cabinet/index.php';
        return true;
    }

    public function actionEditPassword (){

        //Получаем инфу о юзере из сессии
        $userId = User::checkLog();
        $userInfo = User::getUserById($userId);
        $res = '';

        if(isset($_POST) and !empty($_POST))
        {
            $currentPass = trim(strip_tags($_POST['current_pass']));
            $newPass1 = trim(strip_tags($_POST['new_pass1']));
            $newPass2 = trim(strip_tags($_POST['new_pass2']));

            $errors = false;

            if ($newPass1 != $newPass2)
                $errors[] = "Введенные новые пароли не совпадают";

            if(!User::checkPassword($newPass1))
                $errors[] = "Пароль не может быть короче 6-ти символов.";

            if(!User::checkUserData($userInfo['phone'], $currentPass))
                $errors[] = "Неверный текущий пароль";

            if ($errors == false) {
                $password = $newPass1;
                $res = User::editUserPassword($userId, password_hash($password, PASSWORD_DEFAULT));
            }
        }

        require_once ROOT . '/views/cabinet/edit_password.php';
        return true;
    }
    //Изменить контактные данные юзера
    public function actionEdit (){

        $cities = City::getCitiesList();
		$postoffices = PostOffice::getPostList();
        //Получаем инфу о юзере из сессии
        $userId = User::checkLog();
        $userInfo = User::getUserById($userId);
        $res = false;

        if (isset($_POST) and !empty($_POST)){

            //Удаляем теги, пробелы и сохраняем в переменные для проверки
			$firstName = trim(strip_tags($_POST['first_name']));
			$lastName = trim(strip_tags($_POST['last_name']));
			$email = trim(strip_tags($_POST['email']));
			$phone = trim(strip_tags($_POST['phone']));
			$city = trim(strip_tags($_POST['city_id']));
            $postal = trim(strip_tags($_POST['postoffice_id']));

            //Флаг ошибок
            $errors = false;

            //Валидация полей
			if (!User::checkFirstName($firstName))
                $errors[] = "Имя должно быть длиннее 4 символов.";

			if (!User::checkLastName($lastName))
                $errors[] = "Фамилия должна быть длиннее 3 символов.";

            if(!User::checkLine($firstName) || !User::checkLine($lastName))
                $errors[] = "Ваши имя и фамилия не могут содержать символы или числа";

			if (!User::checkCity($city))
				$errors[] = "Введите Ваш город!";

			if (!User::checkPostal($postal))
                $errors[] = "Укажите отделение Новой Почты!";

            if($email != $userInfo['email'] )
                if (!User::checkEmailExists($email))
                        $errors[] = "Этот e-mail уже используется.";
            if($phone != $userInfo['phone'] )
            if (!User::checkPhoneExists($phone))
                        $errors[] = "Этот номер уже используется.";

        if ($errors == false) {
            $res = User::editUserInfo($userId, $firstName, $lastName, $email, $phone, $city, $postal);
        }
        else header('cabinet/edit');
        }
            require_once ROOT . '/views/cabinet/edit.php';
            return true;
    }

    public function actionOrdersHistory()
    {
        //Получаем инфу о юзере из сессии
        $userId = User::checkLog();
        $orders = false;

        $orders = Order::getOrderByUserId($userId);

        require_once ROOT . '/views/cabinet/orders_history.php';
        return true;
    }

}