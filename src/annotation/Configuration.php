<?php

namespace fall\context\annotation;

use fall\context\stereotype\Component;
use fall\core\lang\Annotation;
use fall\core\lang\annotation\DefaultValue;

/**
 * @Component()
 * @author Angelis <angelis@users.noreply.github.com>
 */
interface Configuration extends Annotation
{
  /**
   * @DefaultValue("%target.class.short.name")
   */
  public function value();
}
