<?php

namespace fall\context\annotation;

use fall\core\lang\reflection\ExtendedReflector;

/**
 * @author Angelis <angelis@users.noreply.github.com>
 */
interface AnnotationConfigRegistryInterface
{
  function register(ExtendedReflector ...$extendedReflectors);
  function scan(string ...$basePackages);
}
