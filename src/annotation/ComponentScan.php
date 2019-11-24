<?php

namespace fall\context\annotation;

use fall\core\lang\Annotation;

/**
 * @author Angelis <angelis@users.noreply.github.com>
 */
interface ComponentScan extends Annotation
{
  public function basePackage();
}
