<?php

namespace fall\context\support;

use fall\beans\factory\BeanFactoryInterface;
use fall\beans\factory\NoSuchBeanDefinitionException;
use fall\beans\factory\NoUniqueBeanDefinitionException;
use fall\context\ConfigurableApplicationContextInterface;

/**
 * @author Angelis <angelis@users.noreply.github.com>
 */
abstract class AbstractApplicationContext implements ConfigurableApplicationContextInterface
{
  public function __construct()
  {
    $this->registerBean($this, 'applicationContext');
  }

  public function containsBean(string $beanName): bool
  {
    return $this->getBeanFactory()->containsBean($beanName);
  }

  public function containsBeanDefinition(string $beanName): bool
  {
    return $this->getBeanFactory()->containsBeanDefinition($beanName);
  }

  public function getBeanByType(string $requiredType)
  {
    $beanNames = $this->getBeanNamesForType($requiredType);
    if (empty($beanNames)) {
      throw new NoSuchBeanDefinitionException($requiredType);
    }
    if (count($beanNames) > 1) {
      throw new NoUniqueBeanDefinitionException($requiredType);
    }

    return $this->getBeanByName($beanNames[0]);
  }

  public function getBeanByName(string $beanName): object
  {
    return $this->getBeanFactory()->getBeanByName($beanName);
  }

  public function getBeanNamesForType(string $beanType): array
  {
    return $this->getBeanFactory()->getBeanNamesForType($beanType);
  }

  public abstract function getBeanFactory(): BeanFactoryInterface;
}
