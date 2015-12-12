<?php
namespace Mrakoton\Orm\Tool;

class Tool {
  /**
   * Retrieve accessors from field name
   */
  public static function getAccessor($prefix, $snake) {
    $camelCase = str_replace(' ', '', ucwords(str_replace('_', ' ', $snake)));

    return $prefix . $camelCase;
  }

  public static function snakeToCamelCase($str) {
    return preg_replace('/(^|_)([a-z])/e', 'strtoupper("\\2")', $str);
  }

  public static function camelCaseToSnakeCase($str) {
    return @preg_replace(
      '/(^|[a-z])([A-Z])/e',
      'strtolower(strlen("\\1") ? "\\1_\\2" : "\\2")',
      $str
    );
  }

  /**
   * Parse value depending on provided type
   * (DB -> Model)
   */
  public static function convertValue($val, $type) {
    switch($type) {
      case 'Float':
        return floatval($val);
      case 'Int':
        return intval($val);
      case 'Boolean':
        return boolval($val);
      case 'String':
        return (string)($val);
      case 'DateTime':
        return new \DateTime($val);
      default:
        return $val;
    }
  }

  /**
   * Parse value to SQL format
   * (Model -> DB) 
   */
  public static function getSqlValue($val, $type) {
    switch($type) {
      case 'Float':
        return floatval($val);
      case 'Int':
        return intval($val);
      case 'Boolean':
        return boolval($val);
      case 'String':
        return (string)$val;
      case 'DateTime':
        return $val instanceof \DateTime?$val->format('Y-m-d H:i:s'):'';
      default:
        return $val;
    }
  }
}
