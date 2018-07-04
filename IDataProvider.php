<?php

namespace src\Integration;

interface IDataProvider
{
  public function getResponse(array $request);
}
