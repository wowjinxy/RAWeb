<?php
/**
 * exit early - no more feeds in v1
 */
echo json_encode(['success' => false]);
return;

require_once __DIR__ . '/../../lib/bootstrap.php';

runPublicApiMiddleware();

$user = seekGET('u', null);
$friends = seekGET('f', null);
$count = seekGET('c', 10);
$offset = seekGET('o', 0);

//	Sensible caps
if ($count > 100) {
    $count = 100;
}

$type = 'global';

if (isset($user)) {
    if (isset($friends)) {
        $type = 'friends';
    } else {
        $type = 'individual';
    }
}

getFeed($user, $count, $offset, $feedData, 0, $type);

echo json_encode($feedData);
