<?php

namespace Decorator;

abstract class DataProviderDecorator implements IDataProvider
{
  private $dataProvider;

  /**
   * DataProviderDecorator constructor.
   * @param IDataProvider $dataProvider
   */
  public function __construct(DataProvider $dataProvider)
  {
    $this->dataProvider = $dataProvider;
  }

  /**
   * @return DataProvider
   */
  protected function getDataProvider()
  {
    return $this->dataProvider;
  }

  /**
   * {@inheritdoc}
   */
  abstract public function getResponse(array $input);
}
