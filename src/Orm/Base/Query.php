<?php
namespace Mrakoton\Orm\Base;

/**
 * Responsible for database processing
 */
final class Query {
  private static $dbHandler = null;
  private static $host = 'localhost';
  private static $db = 'orm';
  private static $user = 'root';
  private static $pwd = '';
  private $statement;

  public function __construct($statement) {
    $this->statement = $statement;
  }

  /**
   * Return last inserted id (retrieve new id right after insert)
   */
  public function lastInsertedId() {
    return intval($this->getHandler()->lastInsertId());
  }

  private static function getHandler() {
    try {
      if(!self::$dbHandler) {
        self::$dbHandler = new \PDO('mysql:host=' . self::$host . ';dbname=' . self::$db,
          self::$user,
          self::$pwd,
          [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]
        );
        self::$dbHandler->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      }

      return self::$dbHandler;
    }
    catch(\Exception $e) {
      error_log($e->getMessage());
      die('Broken');
    }
  }

  public function execute(array $data = []) {
    $sth = self::getHandler()->prepare($this->statement);
    $sth->execute($data);
    return $sth;
  }
}
