<?php

use Bitrix\Main\Routing\RoutingConfigurator;
use Bitrix\Main\Engine\Response\Json;
use Bitrix\Vebinar\VebinarController;
use \Bitrix\Main\HttpRequest;

/**
 * @param RoutingConfigurator $routes
 */
return function (RoutingConfigurator $routes) {
    $routes->get('/api/', function(HttpRequest $request) {
        return VebinarController::includeTemplate('main');
    });

    $routes->post('/api/vebinar/json/', function(HttpRequest $request) {
        $response = VebinarController::getVebinar($request->getPost('data'));
        $json = new \Bitrix\Main\Engine\Response\Json($response);
        $json->send();
    });

    $routes->post('/api/vebinar/html/', function(HttpRequest $request) {
        $arResult = VebinarController::getVebinar($request->getPost('data'));
        return VebinarController::includeTemplate('vebinarView', $arResult);
    });
};