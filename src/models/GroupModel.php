<?php

use Slim\Psr7\Request;
use Slim\Psr7\Response;

// Get all groups
function getGroups(Request $request, Response $response, $args)
{
    $db = getDatabaseConnection();
    $statement = $db->prepare("SELECT * FROM groups");
    $statement->execute();
    $groups = $statement->fetchAll(PDO::FETCH_ASSOC);
    $response->getBody()->write(json_encode($groups));
    return $response->withHeader('Content-Type', 'application/json');
}

// Create a new group
function createGroup(Request $request, Response $response, $args)
{
    $data = $request->getParsedBody();
    $db = getDatabaseConnection();

    $groupName = isset($data['name']) ? $data['name'] : '';

    $db->beginTransaction();

    $statement = $db->prepare('INSERT INTO groups (name) VALUES (:name)');
    $statement->bindParam(':name', $groupName);
    $statement->execute();

    $groupId = $db->lastInsertId();

    if (empty($groupName)) {
        $groupName = 'group' . $groupId;

        $updateStatement = $db->prepare('UPDATE groups SET name = :name WHERE id = :id');
        $updateStatement->bindParam(':name', $groupName);
        $updateStatement->bindParam(':id', $groupId);
        $updateStatement->execute();
    }

    $db->commit();

    $group = [
        'id' => $groupId,
        'name' => $groupName
    ];

    $response->getBody()->write(json_encode($group));
    return $response->withHeader('Content-Type', 'application/json');
}

