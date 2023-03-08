<?php

namespace App\Models;

use App\Helpers\Helper;
use Core\Database;

class News
{

    public $id;
    public $title;
    public $details;
    public $poster_link;

    public function load($data)
    {

        $this->id = $data['id'] ?? null;
        $this->title = $data['title'];
        $this->details = $data['details'];
        $this->poster_link = $data['poster_link'];
    }

    public function save()
    {
        $helper = new Helper;
        $err = [];
        if (!$this->title) {
            $err[] = 'Haber Başlığı Zorunlu';
        }
        if (!$this->details) {
            $err[] = 'Haber Detayı Zorunlu';
        }
        if (!$this->poster_link) {
            $err[] = 'Resim Zorunlu';
        }
        if ($this->title && !$helper->lengthValidation($this->title, 1, 200)) {
            $err[] = "Haber başlığı 200 karakterden fazla olamaz!";
        }

        $db = Database::$db;
        if ($this->id) {
            $db->updateNews($this);
        } else {
            $db->createNews($this);
        }
        return $err;
    }

    /*    public function __construct($id, $title, $details, $poster_link)
        {
            $this->setID($id);
            $this->setTitle($title);
            $this->setDetails($details);
            $this->setPosterLink($poster_link);
        }

        public function getID()
        {
            return $this->id;
        }

        public function getTitle()
        {
            return $this->title;
        }

        public function getDetails()
        {
            return $this->details;
        }

        public function getPosterLink()
        {
            return $this->poster_link;
        }

        public function setID($id)
        {

            if (($id !== null) && (!is_numeric($id) || $id <= 0 || $id > 9223372036854775807 || $this->id !== null)) {
                throw new NewsException("News ID error");
            }
            $this->id = $id;
        }

        public function setTitle($title)
        {

            if (strlen($title) < 1 || strlen($title) > 255) {
                throw new NewsException("News title error");
            }
            $this->title = $title;
        }

        public function setDetails($details)
        {

            if (($details !== null) && (strlen($details) == 0 || strlen($details) > 16777215)) {
                throw new NewsException("News details error");
            }
            $this->details = $details;
        }

        public function setPosterLink($poster_link)
        {

            $this->poster_link = $poster_link;
        }


        public function returnNewsAsArray()
        {
            $news = [];
            $news['id'] = $this->getID();
            $news['title'] = $this->getTitle();
            $news['details'] = $this->getDetails();
            $news['poster_link'] = $this->getPosterLink();
            return $news;
        }
    */
}
