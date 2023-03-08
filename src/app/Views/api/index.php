<?php

use App\Exceptions\ForbiddenException;

try {
    if (isset($news)) {
        echo is_string($news) ? $news : throw new ForbiddenException();
    }

} catch (Exception $e) {

    $message = array([
        'message' => $e->getMessage(),
        'code' => $e->getCode()
    ]);
    echo json_encode($message);

}

