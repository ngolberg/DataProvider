<?php

namespace Integration;

class DataProvider implements IDataProvider
{
  private $host;
  private $user;
  private $password;

  /**
   * @param $host
   * @param $user
   * @param $password
   */
  public function __construct($host, $user, $password)
  {
    $this->host = $host;
    $this->user = $user;
    $this->password = $password;
  }

  /**
   * @param array $request
   *
   * @return array
   */
  public function getResponse(array $request)
  {
    // returns a response from external service
  }
}
