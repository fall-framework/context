<?php

namespace fall\context\stereotype;

use fall\core\lang\Annotation;
use fall\core\lang\annotation\DefaultValue;

/**
 * @author Angelis <angelis@users.noreply.github.com>
 */
interface Component extends Annotation
{
  /**
   * @DefaultValue("%target.class.short.name")
   */
  public function value();
}
