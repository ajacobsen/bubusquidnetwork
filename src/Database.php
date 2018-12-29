<?php

namespace App;

use \PDO;
use Noodlehaus\Config;
use Noodlehaus\Parser\Json;



class Database {

    private static $instance;
    private $pdo;

	private function __construct() {
		$conf = Config::load( __DIR__ . '/config/config.json');
		$dsn = 'mysql:host='.$conf['db']['host'].';dbname='.$conf['db']['dbname'].';charset=utf8mb4';
		$options = [
		    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		    PDO::ATTR_EMULATE_PREPARES   => false,
		];
		try {
		     $this->$pdo = new PDO($dsn, $conf['db']['user'], $conf['db']['password'], $options);
		} catch (\PDOException $e) {
		     throw new \PDOException($e->getMessage(), (int)$e->getCode());
		}
	}

	private function __clone() {}
	private function __wakeup() {}

	public static function getInstance() {
	    if (is_null(static::$instance)) {
	        static::$instance = new static();
	    }
	    return static::$instance;
	}

	public function getShow($name) {
		$sql = 'SELECT * FROM shows WHERE name = :name';
		$stmt = $this->$pdo->prepare($sql);
		$stmt->execute(['name' => $name]);
		return $stmt->fetch();
	}

	public function getCharacters($ids) {
		$inQuery = implode(',', array_fill(0, count($ids), '?'));
		$stmt = $this->$pdo->prepare(
		    'SELECT *
		     FROM characters
		     WHERE id IN(' . $inQuery . ')'
		);

		// bindvalue is 1-indexed, so $k+1
		foreach ($ids as $k => $id)
		    $stmt->bindValue(($k+1), $id);

		$stmt->execute();
		return $stmt->fetchAll();
	}
}