<?php

namespace fall\context\annotation;

use fall\beans\factory\annotation\AnnotatedGenericBeanDefinition;
use fall\beans\factory\annotation\Qualifier;
use fall\beans\factory\config\BeanDefinitionInterface;
use fall\beans\factory\support\BeanNameGeneratorInterface;
use fall\beans\factory\support\BeanDefinitionRegistryInterface;
use fall\context\annotation\Bean;
use fall\context\stereotype\Component;
use fall\core\lang\reflection\ExtendedReflectionClass;

/**
 * @author Angelis <angelis@users.noreply.github.com>
 */
class AnnotationBeanNameGenerator implements BeanNameGeneratorInterface
{
  public function generateBeanName(BeanDefinitionInterface $beanDefinition, BeanDefinitionRegistryInterface $beanDefinitionRegistry)
  {
    if ($beanDefinition instanceof AnnotatedGenericBeanDefinition) {
      foreach ($beanDefinition->getMetadata() as $annotationMetadata) {
        if ($annotationMetadata->getAnnotationExtendedReflectionClass()->hasMethod('value')) {
          return $annotationMetadata->build()->value();
        }
      }

      /*if ($extendedReflectionClass->isAnnotationPresent(Qualifier::class)) {
      $qualifier = $extendedReflectionClass->getAnnotation(Qualifier::class);
      return $qualifier->value();
      }

      if ($extendedReflectionClass->isAnnotationPresent(Bean::class)) {
        $bean = $extendedReflectionClass->getAnnotation(Bean::class);
        return $bean->name();
      }

      if ($extendedReflectionClass->isAnnotationPresent(Component::class)) {
        $component = $extendedReflectionClass->getAnnotation(Component::class);
        return $component->value();
      }*/
    }

    return $this->buildDefaultBeanName($beanDefinition);
  }

  private function buildDefaultBeanName(BeanDefinitionInterface $beanDefinition): string
  {
    return $beanDefinition->getBeanClassName();
  }
}
