<?php

namespace Decorator;

use DateTime;
use Exception;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use src\Integration\DataProvider;

class DataProviderManager extends DataProviderDecorator
{
  private $cache;
  private $logger;

  /**
   * @param string $host
   * @param string $user
   * @param string $password
   * @param CacheItemPoolInterface $cache
   */
  public function __construct(IDataProvider $dataProvider, CacheItemPoolInterface $cache, LoggerInterface $logger)
  {
    parent::__construct($dataProvider);
    $this->cache = $cache;
    $this->logger = $logger;
  }

  /**
   * @param array $request
   * @return array
   *
   * {@inheritdoc}
   */
  public function getResponse(array $request)
  {
    try {
      $cacheKey = $this->getCacheKey($request);
      $cacheItem = $this->cache->getItem($cacheKey);
      if ($cacheItem->isHit()) {
        return $cacheItem->get();
      }

      $result = $this->getDataProvider()->getResponse($request);

      $cacheItem
        ->set($result)
        ->expiresAt(
          (new DateTime())->modify('+1 day')
        );

      return $result;
    } catch (Exception $e) {
        $this->logger->critical($e->getMessage());
    }

    return [];
  }

  /**
   * @param array $input
   * @return string
   */
  private function getCacheKey(array $input)
  {
    $result = json_encode($input);
    if ($result === FALSE) {
      throw new Exception(json_last_error());
    }

    return $result;
  }
}
