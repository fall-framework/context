<?php

namespace fall\context\stereotype;

use fall\context\stereotype\Component;
use fall\core\lang\Annotation;
use fall\core\lang\annotation\DefaultValue;

/**
 * @author Angelis <angelis@users.noreply.github.com>
 * @Component()
 */
interface Controller extends Annotation
{
  /**
   * @DefaultValue("%class.short.name")
   */
  public function value();
}
