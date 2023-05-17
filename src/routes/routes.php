<?php

use Slim\Routing\RouteCollectorProxy;

require_once __DIR__ . '/../models/MessageModel.php';
require_once __DIR__ . '/../models/GroupModel.php';


$app->group('/groups', function (RouteCollectorProxy $group) {
    $group->get('', 'getGroups');
    $group->post('', 'createGroup');
    $group->get('/{id}', 'getGroupMessages');
    $group->post('/{id}', 'sendMessageToGroup');
});

