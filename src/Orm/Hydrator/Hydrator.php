<?php
namespace Mrakoton\Orm\Hydrator;

use Mrakoton\Orm\Tool\Tool;
use Mrakoton\Orm\Annotation\Reader;

class Hydrator {
  public static function hydrate($data, $class) {
    // Retrieve mapping config for class
    $mapping = Reader::getMappedAttributeData($class);
    $object = new $class();

    foreach($data as $propName => $propValue) {
      if(isset($mapping[$propName])) {
        $convertedValue = Tool::convertValue($propValue, $mapping[$propName]['datatype']);
        $setter = $mapping[$propName]['setter'];

        try {
          $object->$setter($convertedValue);
        }
        catch(\Exception $e) {
          error_log('Hydratation error: ' . $e->getMessage());
        }
      }
    }

    return $object;
  }
}
