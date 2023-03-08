<?php

namespace App\Models;

use Core\Database;
use App\Helpers\Helper;

class Comments
{
    public ?int $uid = null;
    public ?int $news_id = null;
    public ?int $cid = null;
    public ?string $cusername = null;
    public ?string $comment = null;
    public ?string $date = null;

    public function load($data)
    {
        $this->uid = $data['uid'] ?? null;
        $this->news_id = $data['news_id'] ?? null;
        $this->cusername = $data['cusername'] ?? null;
        $this->cid = $data['cid'] ?? null;
        $this->date = $data['date'] ?? null;
        $this->comment = htmlspecialchars(trim($data['comment']));
    }

    public function save()
    {
        $helper = new Helper;
        $db = Database::$db;
        $errors = [];
        if (!$this->comment) {
            $errors[] = 'Yorum Girmeniz Gerekiyor.';
        }
        if ($this->comment && !$helper->lengthValidation($this->comment, 1, 450)) {
            $errors[] = 'Yorum 450 karakterden fazla olamaz!';
        }

        if (empty($errors)) {
            $db->createComment($this);
        }
        return $errors;
    }

}