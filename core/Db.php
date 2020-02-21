<?php
/**
 * Подключение к БД
 */
class Db
{
	public static function getConnect()
	{
		$params = include(ROOT . '/config/db_connect.php');
		$dsn = "mysql:host={$params['host']};dbname={$params['db_name']}";
		$conn = new PDO($dsn, $params['user'], $params['pass']);

		return $conn;
	}
}