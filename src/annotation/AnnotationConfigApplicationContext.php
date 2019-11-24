<?php

namespace fall\context\annotation;

use fall\beans\factory\annotation\AnnotatedGenericBeanDefinition;
use fall\context\annotation\AnnotationConfigRegistryInterface;
use fall\context\stereotype\Component;
use fall\context\support\GenericApplicationContext;
use fall\core\lang\reflection\ExtendedReflector;
use fall\core\utils\AnnotationUtils;
use fall\core\utils\ClassUtils;

class AnnotationConfigApplicationContext extends GenericApplicationContext implements AnnotationConfigRegistryInterface
{

  private $beanNameGenerator;

  public function __construct()
  {
    parent::__construct();
    $this->beanNameGenerator = new AnnotationBeanNameGenerator();
  }

  public function register(ExtendedReflector ...$extendedReflectors)
  {
    foreach ($extendedReflectors as $extendedReflector) {
      $beanDefinition = new AnnotatedGenericBeanDefinition($extendedReflector);
      $beanName = $this->beanNameGenerator->generateBeanName($beanDefinition, $this);
      $this->registerBeanDefinition($beanName, $beanDefinition);
    }
  }

  public function setBeanNameGenerator(BeanNameGeneratorInterface $beanNameGenerator)
  {
    $this->beanNameGenerator = $beanNameGenerator;
  }

  public function scan(string ...$basePackages)
  {
    // TODO
    $stack = debug_backtrace();
    $firstFrame = $stack[count($stack) - 1];
    ClassUtils::loadAllClassInDirectory(dirname($firstFrame['file']), true);

    foreach (AnnotationUtils::getAllExtendedReflectionClassesHavingAnnotation(Component::class) as $extendedReflectionClass) {
      $this->register($extendedReflectionClass);
    }

    foreach (AnnotationUtils::getAllExtendedReflectionClassesHavingAnnotation(Configuration::class) as $extendedReflectionClass) {
      foreach ($extendedReflectionClass->getMethodsAnnotatedWith(Bean::class) as $extendedReflectionMethod) {
        $this->register($extendedReflectionMethod);
      }
    }
  }
}
