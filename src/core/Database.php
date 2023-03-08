<?php

namespace Core;

use App\Models\Comments;
use App\Models\User;
use PDO;
use App\Models\News;

require_once __DIR__ . '/config.php';

class Database
{

    public static Database $db;

    private string $host = DBHOST;
    private string $port = DBPORT;
    private string $dbname = DBNAME;
    private string $username = DBUSERNAME;
    private string $password = DBPASSWORD;

    //private ?PDO $pdo = null;

    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbname", $this->username, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        self::$db = $this;
    }

    /*private function getDb(): PDO
    {
        if (!$this->pdo) {
            $this->pdo = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbname", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $this->pdo;
    }*/

    public function isExist($table, $row, $data): bool
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . $table . " WHERE " . $row . " = :data");
        $statement->bindValue(':data', $data);
        $statement->execute();
        $count = $statement->rowCount();
        if ($count > 0) {
            return True;
        } else {
            return False;
        }
    }

    public function getData($table, $row, $data, $value)
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . $table . " WHERE " . $row . " = :data");
        $statement->bindValue(':data', $data);
        $statement->execute();
        while ($assoc = $statement->fetch(PDO::FETCH_ASSOC)) {
            return $assoc[$value];
        }
    }

    public function getNews($search = "", $admin = false, $api = false): bool|array
    {
        if ($admin) {
            if ($search) {
                $statement = $this->pdo->prepare('SELECT * FROM news WHERE title LIKE :title');
                $statement->bindValue(':title', "%$search%");
            } else {
                $statement = $this->pdo->prepare('SELECT * FROM news');
            }

        } elseif ($api) {
            $statement = $this->pdo->prepare('SELECT id, title, details, poster_link FROM news');
        } else {
            if ($search) {
                $statement = $this->pdo->prepare('SELECT id, title, details, poster_link FROM news WHERE title LIKE :title');
                $statement->bindValue(':title', "%$search%");
            } else {
                $statement = $this->pdo->prepare('SELECT id, title, details, poster_link FROM news');
            }
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSingleNews($id, $admin = false, $api = false)
    {
        if ($admin) {
            $statement = $this->pdo->prepare('SELECT * FROM news WHERE id= :id');
        } elseif ($api) {
            $statement = $this->pdo->prepare('SELECT id, title, details, poster_link FROM news WHERE id= :id');
        } else {
            $statement = $this->pdo->prepare('SELECT id, title, details, poster_link FROM news WHERE id= :id');
        }
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function createNews(News $news): void
    {

        $statement = $this->pdo->prepare("INSERT INTO news (title, details, poster_link)
        VALUES (:title, :details, :poster_link)");
        $statement->bindValue(':title', $news->title);
        $statement->bindValue(':details', $news->details);
        $statement->bindValue(':poster_link', $news->poster_link);

        $statement->execute();
    }

    public function deleteNews($id): void
    {
        //$statement = $this->getDb()->prepare('DELETE FROM news WHERE id= :id');
        $statement = $this->pdo->prepare('DELETE FROM news WHERE id= :id');
        $statement->bindValue(':id', $id);
        $statement->execute();
    }

    public function updateNews(News $news): void
    {
        $statement = $this->pdo->prepare("UPDATE news SET title = :title, 
                    details = :details, poster_link= :poster_link WHERE id= :id");

        $statement->bindValue(':title', $news->title);
        $statement->bindValue(':details', $news->details);
        $statement->bindValue(':poster_link', $news->poster_link);
        $statement->bindValue(':id', $news->id);
        $statement->execute();
    }

    public function getUsers($search = ""): bool|array
    {
        if ($search) {
            $statement = $this->pdo->prepare('SELECT * FROM users WHERE username LIKE :username');
            $statement->bindValue(':username', "%$search%");
        } else {
            $statement = $this->pdo->prepare('SELECT * FROM users');
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsersById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE id= :id');
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser(User $user): void
    {
        $statement = $this->pdo->prepare("INSERT INTO users (username, password) 
        VALUES (:username, :password)");
        $statement->bindValue(':username', $user->username);
        $statement->bindValue(':password', password_hash($user->password, PASSWORD_DEFAULT));
        $statement->execute();
    }

    public function deleteUser($id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM users WHERE id= " . $id . "");
        $statement2 = $this->pdo->prepare("DELETE FROM comments WHERE uid = " . $id . "");
        $statement->execute();
        $statement2->execute();
    }

    public function deleteUserAction($id, $uid): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id= :id");
        $stmt2 = $this->pdo->prepare("DELETE FROM comments WHERE uid= :uid");
        $stmt->bindValue(":id", $id);
        $stmt2->bindValue(":uid", $uid);
        $stmt->execute();
        $stmt2->execute();
    }

    public function getComments($news_id, $admin = false): bool|array
    {
        if ($admin) {
            $statement = $this->pdo->prepare("SELECT * FROM comments ORDER BY `date` DESC");
        } else {
            $statement = $this->pdo->prepare("SELECT * FROM comments WHERE news_id = :news_id ORDER BY `date` DESC");
            $statement->bindValue(':news_id', $news_id);
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommentsByUserId($id, $search = ""): bool|array
    {
        if ($search) {
            $statement = $this->pdo->prepare("SELECT news.title, comments.uid, comments.news_id, comments.comment,
       comments.date FROM comments LEFT JOIN news ON news.id = comments.news_id WHERE comments.uid = $id AND 
        news.title LIKE :title ORDER BY comments.date DESC");
            $statement->bindValue(':title', "%$search%");
        } else {
            $statement = $this->pdo->prepare("SELECT news.title, comments.uid, comments.news_id, comments.comment,
       comments.date FROM comments LEFT JOIN news ON news.id = comments.news_id WHERE comments.uid = $id ORDER BY comments.date DESC");
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createComment(Comments $comments): void
    {
        $statement = $this->pdo->prepare("INSERT INTO comments (news_id, uid, cusername, comment)
        VALUES (:news_id, :uid, :cusername, :comment)");
        $statement->bindValue(':news_id', $comments->news_id);
        $statement->bindValue(':uid', $comments->uid);
        $statement->bindValue(':cusername', $comments->cusername);
        $statement->bindValue(':comment', $comments->comment);
        $statement->execute();
    }

    public function loginCheck($username, $password): bool
    {
        $hashed_pass = $this->getData('users', 'username', $username, 'password');
        $verify = password_verify($password, $hashed_pass);

        if ($verify == true) {
            return true;
        } else {
            return false;
        }

    }

    public function deleteUsers($id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id= :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

}