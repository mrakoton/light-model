<?php
namespace Mrakoton\Orm\Annotation;

use Mrakoton\Orm\Tool\Tool;

/**
 * This class read DocComment which define types on entities
 *
 * @todo Cache Annotations per class
 */
class Reader {
  /**
   * Get database mapping for provided class
   */
  public static function getMappedAttributeData($class) {
    $mapping = [];
    $reflectedClass = new \ReflectionClass($class);

    foreach($reflectedClass->getProperties() as $prop) {
      $propName = $prop->getName();

      // Look for annoration Type:<datatype>
      preg_match("#@Type:(.*?)\n#", $prop->getDocComment(), $typeAnnotation);

      if(isset($typeAnnotation[1])) {
        $type = trim($typeAnnotation[1]);
        $mapping[$propName] = [
            'datatype' => $type,
            // store accessor function names
            'setter' => Tool::getAccessor('set', $propName),
            'getter' => Tool::getAccessor('get', $propName)
        ];
      }
    }

    return $mapping;
  }
}
