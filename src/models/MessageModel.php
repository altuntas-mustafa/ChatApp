<?php

use Slim\Psr7\Request;
use Slim\Psr7\Response;

// Get messages of a specific group
function getGroupMessages(Request $request, Response $response, $args)
{
    $groupId = $args['id'];
    $db = getDatabaseConnection();
    $statement = $db->prepare('SELECT * FROM messages WHERE group_id = :groupId');
    $statement->bindParam(':groupId', $groupId);
    $statement->execute();
    $messages = $statement->fetchAll(PDO::FETCH_ASSOC);
    $response->getBody()->write(json_encode($messages));
    return $response->withHeader('Content-Type', 'application/json');
}


// Send a message to a group
function sendMessageToGroup(Request $request, Response $response, $args)
{
    $groupId = $args['id'];
    $data = $request->getParsedBody();

    $db = getDatabaseConnection();

    // Check if the group exists
    $groupStatement = $db->prepare('SELECT * FROM groups WHERE id = :groupId');
    $groupStatement->bindParam(':groupId', $groupId);
    $groupStatement->execute();

    $group = $groupStatement->fetch(PDO::FETCH_ASSOC);

    if (!$group) {
        // Group doesn't exist, return an error response
        $error = [
            'message' => 'Group does not exist'
        ];
        $response->getBody()->write(json_encode($error));
        return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
    }

    // Insert the message into the database
    $messageStatement = $db->prepare('INSERT INTO messages (group_id, user_id, messages) VALUES (:groupId, :userId, :messages)');
    $messageStatement->bindParam(':groupId', $groupId);
    $messageStatement->bindParam(':userId', $data['user_id']);
    $messageStatement->bindParam(':messages', $data['messages']);
    $messageStatement->execute();

    $message = [
        'id' => $db->lastInsertId(),
        'group_id' => $groupId,
        'user_id' => $data['user_id'],
        'messages' => $data['messages']
    ];

    $response->getBody()->write(json_encode($message));
    return $response->withHeader('Content-Type', 'application/json');
}
