<?php
/**
 * Модель для работы с юзером
 */
class User
{

	/**
	 * Принимаем данные из контроллера и записываем в БД
	 * @param $name имя
	 * @param $email email
	 * @param $password пароль
	 * @return bool  возвращает true/false
	 */
	public static function register($firstName,$lastName, $email, $phone, $password, $city_id, $postoffice_id)
	{

		$conn = Db::getConnect();
		# закрывает подключение
		# $conn = null;

		$sql = "
                INSERT INTO users(first_name, last_name, email, phone, password, city_id, postoffice_id)
                VALUES(:first_name, :last_name, :email, :phone, :password, :city_id, :postoffice_id)
                "; # имена placeholder`ов
		#stmt - Statemate
		$stmt = $conn->prepare($sql);
		# назначаем переменные каждому placeholder
		# привязывает параметр запроса к переменным по ссылке
		$stmt->bindParam(':first_name', $firstName, PDO::PARAM_STR);
		$stmt->bindParam(':last_name', $lastName, PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
		$stmt->bindParam(':password', $password, PDO::PARAM_STR);
		$stmt->bindParam(':city_id', $city_id, PDO::PARAM_INT);
		$stmt->bindParam(':postoffice_id', $postoffice_id, PDO::PARAM_INT);

		return $stmt->execute();
	}


	/**
	 * Проверяем поле Имя на корректность
	 * @param $name
	 * @return bool
	 */
	public static function checkFirstName($firstName)
	{
		if (strlen($firstName) < 20 and strlen($firstName) > 3)
			return true;
		return false;
	}

	public static function checkLastName($lastName)
	{
		if (strlen($lastName) < 20 and strlen($lastName) > 2)
			return true;
		return false;
	}
	//Проверка строки на наличие символов/чисел
	public static function checkLine($text)
	{
		if (preg_match("/[^a-zа-яё ]/iu", $text))
			return false;
		return true;
	}

	/**
	 * Проверяем инпут на наличие эл.почты или телефона
	 * @param $logib
	 * @return bool||String
	 */
	public static function checkLoginType($login)
	{
		$emailPattern = "~^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$~i";
		$phonePattern = "~^\d{10}$~";
		if(preg_match($emailPattern, $login))
			return $type = 'email';
		elseif(preg_match($phonePattern, $login))
			return $type = 'phone';
		else return false;
	}

	/**
	 * Проверяем поле Email на корректность
	 * @param $email
	 * @return bool
	 */
	public static function checkEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL))
			return true;
		return false;
	}

    /**
     * Проверяем поле Телефон на корректность
     * @param $phone
     * @return bool
     */
	 public static function checkPhone ($phone) {
        if (strlen($phone) == 10)
            return true;
        return false;
    }

	/**
	 * Проверяем поле Город на корректность
	 * @param $password
	 * @return bool
	 */
	public static function checkCity($city)
	{
		if ($city != 0)
			return true;
		return false;
	}

	/**
	 * Проверяем поле Почта на корректность
	 * @param $password
	 * @return bool
	 */
	public static function checkPostal($post)
	{
		if (strlen($post) != 0)
			return true;
		return false;
	}

	/**
	 * Проверяем поле Пароль на корректность
	 * @param $password
	 * @return bool
	 */
	public static function checkPassword($password)
	{
		if (strlen($password) >= 6)
			return true;
		return false;
	}


	/**
	 * Проверяем email на доступность
	 * @param $email
	 * @return bool
	 */
	public static function checkEmailExists($email)
	{
		$conn = Db::getConnect();
		$sql = "
                SELECT count(*) FROM users
                    WHERE email = :email
                ";

		$stmt = $conn->prepare($sql);

		$stmt->bindParam(':email', $email, PDO::PARAM_STR);

		$stmt->execute();//запуск запроса

		if ($stmt->fetchColumn())//если не найдена строка с email - true
			return false;
		return true;
	}


	/**
	 * Проверяем номер телефона на доступность
	 * @param $email
	 * @return bool
	 */
	public static function checkPhoneExists($phone)
	{
		$conn = Db::getConnect();

		$sql = "
                SELECT count(*) FROM users
                    WHERE phone = :phone
                ";

		$stmt = $conn->prepare($sql);

		$stmt->bindParam(':phone', $phone, PDO::PARAM_STR);

		$stmt->execute();//запуск запроса

		if ($stmt->fetchColumn())//если найдена строка с phone - return false
			return false;

		return true;
	}

	/**
	 * Поиск в БД введенных данных при авторизации
	 * @param $email
	 * @param $password
	 * @return bool
	 */
	public static function checkUserData($login, $password)
	{

		$conn = Db::getConnect();

		$sql = "
                SELECT id, first_name, last_name, email, phone, password, city_id, postoffice_id, role
					FROM users
				WHERE email = :login
					OR phone = :login
                ";

		$res = $conn->prepare($sql);

		$res->bindParam(':login', $login, PDO::PARAM_STR);

		$res->execute();

		$user = $res->fetch();

		if (password_verify($password, $user['password'])) {
			return $user['id'];
		}

		return false;
	}

	/**
	 * Получение всей инфы о юзере через его id()
	 */
	public static function getUserById($userId){

		$conn = Db::getConnect();

		$sql = "
			SELECT id, first_name, last_name, email, phone, password, city_id, postoffice_id, role
				FROM users
			WHERE id = :id
				";

		$res = $conn->prepare($sql);

		$res->bindParam(':id', $userId);

		$res->execute();

		return $res->fetch(PDO::FETCH_ASSOC);

	}

	/**
     *Запись id юзера в сессию
     * @param $userId
     */
	public static function userIntoSession($userId){
		$_SESSION['user'] = $userId;
	}

	 /**
     * Проверяем, авторизован ли пользователь при переходе в личный кабинет
     * @return mixed
     */
	 public static function checkLog(){

		//Если сессия есть, то возвращаем id пользователя
		if(isset($_SESSION['user']))
			return $_SESSION['user'];
		else
			header('Location: user/login');
	 }

	/**
	 * Проверяем наличие открытой сессии у пользователя для
	 * отображения на сайте необходимой информации
	 * @return bool
	 */
	public static function isGuest()
	{

		if (isset($_SESSION['user'])) {
			return false;
		}
		return true;
	}

	/**
	 * Принимаем данные из контроллера и записываем в БД
	 * @return bool  возвращает true/false
	 */
	public static function editUserInfo($id, $firstName, $lastName, $email, $phone, $city_id, $postoffice_id){
		$db = Db::getConnect();

        $sql = "
            UPDATE users
            SET
                first_name = :firstName,
                last_name = :lastName,
                email = :email,
                phone = :phone,
                password = :password,
				city_id =  :city_id,
				postoffice_id =  :postoffice_id
            WHERE id = :id
            ";
		$res = $db->prepare($sql);
        $res -> bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $res -> bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $res -> bindParam(':email', $email, PDO::PARAM_STR);
        $res -> bindParam(':phone', $phone, PDO::PARAM_STR);
        $res -> bindParam(':password', $password, PDO::PARAM_STR);
        $res -> bindParam(':city_id', $city_id, PDO::PARAM_INT);
		$res -> bindParam(':postoffice_id', $postoffice_id, PDO::PARAM_INT);
		$res -> bindParam(':id', $id, PDO::PARAM_INT);

        return $res->execute();
	}

	/**
	* Принимаем данные из контроллера и изменяем пароль юзера
	* @return bool  возвращает true/false
	*/
	public static function editUserPassword($id, $password){

		$db = Db::getConnect();

        $sql = "
            UPDATE users
            SET
                password = :password
            WHERE id = :id
            ";
		$res = $db->prepare($sql);
        $res -> bindParam(':password', $password, PDO::PARAM_STR);
		$res -> bindParam(':id', $id, PDO::PARAM_INT);

        return $res->execute();
	}

}