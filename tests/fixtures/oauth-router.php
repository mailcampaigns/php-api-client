<?php

// Local-only OAuth/API fixture. No production credentials or requests are used.
$stateFile = getcwd() . '/state.json';
$state = json_decode(file_get_contents($stateFile), true);
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
header('Content-Type: application/json');

if ($path === '/oauth/v2/token') {
    ++$state['tokens'];
    file_put_contents($stateFile, json_encode($state));
    if (!empty($state['reject_tokens'])) {
        http_response_code(400);
        echo json_encode(['error' => 'invalid_client', 'error_description' => 'Fixture refresh failed']);
    } else {
        echo json_encode(['access_token' => 'token-' . $state['tokens'], 'expires_in' => 36000]);
    }
    return;
}

$state['requests'][] = [
    'method' => $_SERVER['REQUEST_METHOD'],
    'uri' => $_SERVER['REQUEST_URI'],
    'authorization' => $_SERVER['HTTP_AUTHORIZATION'] ?? '',
    'test_header' => $_SERVER['HTTP_X_TEST'] ?? '',
    'body' => file_get_contents('php://input')
];
file_put_contents($stateFile, json_encode($state));

if ($path === '/forbidden') {
    http_response_code(403);
} elseif ($path === '/server-error') {
    http_response_code(500);
} elseif ($path === '/always-unauthorized' || ($_SERVER['HTTP_AUTHORIZATION'] ?? '') === 'Bearer token-1') {
    http_response_code(401);
}

echo json_encode(['ok' => http_response_code() === 200]);
