<?php
/**
 * determine variables $host, $user, $password, $cache, $logger, $request.
 */
$dataProvider = new DataProvider($host, $user, $password);
$dataProvider = new DataProviderManager($dataProvider, $cache, $logger);
$dataProvider->getResponse($request);
