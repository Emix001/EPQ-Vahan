<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

$commentsFile = __DIR__ . '/../data/comments.json';
$dataDir = __DIR__ . '/../data';

if (!file_exists($dataDir)) {
    mkdir($dataDir, 0755, true);
}

if (!file_exists($commentsFile)) {
    file_put_contents($commentsFile, json_encode([], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

function getComments() {
    global $commentsFile;
    $data = file_get_contents($commentsFile);
    return json_decode($data, true) ?? [];
}

function saveComments($comments) {
    global $commentsFile;
    file_put_contents($commentsFile, json_encode($comments, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $comments = getComments();
    echo json_encode([
        'success' => true,
        'comments' => $comments
    ], JSON_UNESCAPED_UNICODE);
    
} elseif ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (isset($input['action']) && $input['action'] === 'add') {
        if (empty($input['name']) || empty($input['comment'])) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Անունը և կարծիքը պարտադիր են'
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }
        
        $comments = getComments();
        
        $newComment = [
            'id' => uniqid('comment_', true),
            'name' => htmlspecialchars(trim($input['name']), ENT_QUOTES, 'UTF-8'),
            'comment' => htmlspecialchars(trim($input['comment']), ENT_QUOTES, 'UTF-8'),
            'date' => date('Y-m-d H:i:s'),
            'timestamp' => time()
        ];
        
        array_unshift($comments, $newComment);
        saveComments($comments);
        
        echo json_encode([
            'success' => true,
            'message' => 'Կարծիքը հաջողությամբ ավելացվեց',
            'comment' => $newComment
        ], JSON_UNESCAPED_UNICODE);
        
    } elseif (isset($input['action']) && $input['action'] === 'delete') {
        if (empty($input['id']) || empty($input['password'])) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'ID և գաղտնաբառը պարտադիր են'
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }
        
        if ($input['password'] !== 'Armidas') {
            http_response_code(403);
            echo json_encode([
                'success' => false,
                'message' => 'Սխալ գաղտնաբառ'
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }
        
        $comments = getComments();
        $newComments = array_filter($comments, function($comment) use ($input) {
            return $comment['id'] !== $input['id'];
        });
        
        $newComments = array_values($newComments);
        saveComments($newComments);
        
        echo json_encode([
            'success' => true,
            'message' => 'Կարծիքը հաջողությամբ ջնջվեց'
        ], JSON_UNESCAPED_UNICODE);
        
    } else {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Անհայտ գործողություն'
        ], JSON_UNESCAPED_UNICODE);
    }
    
} else {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Չթույլատրված մեթոդ'
    ], JSON_UNESCAPED_UNICODE);
}
?>
