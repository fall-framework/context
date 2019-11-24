<?php

namespace fall\context\support;

use fall\beans\factory\BeanFactoryInterface;
use fall\beans\factory\config\BeanDefinitionInterface;
use fall\beans\factory\support\GenericBeanDefinition;
use fall\beans\factory\support\BeanDefinitionRegistryInterface;
use fall\beans\factory\support\DefaultListableBeanFactory;

/**
 * @author Angelis <angelis@users.noreply.github.com>
 */
class GenericApplicationContext extends AbstractApplicationContext implements BeanDefinitionRegistryInterface
{

  protected $beanFactory;

  public function __construct()
  {
    $this->beanFactory = new DefaultListableBeanFactory();
  }

  public function containsBeanDefinition(string $beanName): bool
  {
    // TODO
    return false;
  }

  public function getBeanDefinition(string $beanName): BeanDefinitionInterface
  {
    return $this->beanFactory->getBeanDefinition($beanName);
  }

  public function getBeanFactory(): BeanFactoryInterface
  {
    return $this->beanFactory;
  }

  public function registerAlias(string $beanName, string $alias)
  {
    $bean = $this->getBeanByName($beanName);
    $this->registerBean($bean, $alias);
  }

  public function registerBean($bean, string $beanName)
  {
    $this->registerBeanDefinition($beanName, new GenericBeanDefinition($bean));
  }

  public function registerBeanDefinition(string $beanName, BeanDefinitionInterface $beanDefinition)
  {
    $this->beanFactory->registerBeanDefinition($beanName, $beanDefinition);
  }
}
