<?php

namespace Integration;

interface IDataProvider
{
  public function getResponse(array $request);
}
