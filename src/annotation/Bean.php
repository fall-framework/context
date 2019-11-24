<?php

namespace fall\context\annotation;

use fall\context\stereotype\Component;
use fall\core\lang\Annotation;

/**
 * @author Angelis <angelis@users.noreply.github.com>
 */
interface Bean extends Annotation
{
  public function name();
}
