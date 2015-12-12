<?php
namespace Mrakoton\Orm\Base;

use Mrakoton\Orm\Hydrator\Hydrator;
use Mrakoton\Orm\Base\Query;
use Mrakoton\Orm\Tool\Tool;
use Mrakoton\Orm\Annotation\Reader;

/**
 * Base class for Model classes
 * Automatically generate model related queries
 */
class Model {
  public function __construct() {
    $this->className = (new \ReflectionClass(get_called_class()))->getShortName();
  }

  public static function findAll() {
    $className = (new \ReflectionClass(get_called_class()))->getShortName();
    $q = new Query("SELECT * FROM $className");
    $res = $q->execute();

    return self::getResultSet($res);
  }

  /**
   * Retrieve real model from PDO result set
   */
  private static function getResultSet(\PDOStatement $set) {
    return array_map(function($datum) {
      return Hydrator::hydrate($datum, get_called_class());
    }, $set->fetchAll(\PDO::FETCH_OBJ));
  }

  public function save() {
    $mapping = Reader::getMappedAttributeData(get_called_class());
    $fieldDef = [];
    $fieldVals = [];

    foreach($mapping as $propName => $propData) {
      if($propName !== 'id') {
        $fieldDef[] = $propName;
        $getter = $propData['getter'];
        $fieldVals[] = Tool::getSqlValue($this->$getter(), $propData['datatype']);
      }
    }

    if(!$this->getId()) {
      $rq = 'INSERT INTO ' . Tool::camelCaseToSnakeCase($this->className) . ' (' . implode(',', $fieldDef) . ') VALUES (' . implode(',', array_fill(0, count($fieldDef), '?')) . ')';

      $q = new Query($rq);
      $res = $q->execute($fieldVals);

      $this->setId($q->lastInsertedId());

      return $res;
    }
    else {
      $rq = 'UPDATE ' . Tool::camelCaseToSnakeCase($this->className) . ' SET ';

      $modifiers = [];
      foreach($fieldDef as $field) {
        $modifiers[] = "$field = ?";
      }

      $rq .= implode(', ', $modifiers) . ' WHERE id = ' . $this->getId();

      $q = new Query($rq);
      $res = $q->execute($fieldVals);

      return $res;
    }
  }

  public function delete() {
    $rq = "DELETE FROM " . $this->className . " WHERE id = ? LIMIT 1";
    $q = new Query($rq);
    $res = $q->execute([$this->getId()]);

    return $res;
  }
}
