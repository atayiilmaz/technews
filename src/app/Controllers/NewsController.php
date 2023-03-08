<?php

namespace App\Controllers;

use App;
use Core\Database;
use App\Models\Comments;
use App\Models\News;
use Core\Controller;
use Core\Router;


class NewsController extends Controller
{

    public static function index(Router $router)
    {

        $search = $_GET['search'] ?? '';

        if ($search) {
            $search = htmlspecialchars($search);
        }

        $news = $router->db->getNews($search);
        $router->view('news/index', [
            'news' => $news,
            'search' => $search
        ]);
    }

    public static function viewNewsDetails(Router $router)
    {
        $db = Database::$db;
        $news_id = $_GET['id'] ?? null;
        if (!$news_id) {
            header('Location: /news');
            exit;
        }
        $news = $db->getSingleNews($news_id);

        if (!$news) {
            header('Location: /news');
            exit;
        }

        //Show comments
        $comments = $db->getComments($news_id);

        //Create comment
        $err = [];
        $commentData = [
            'news_id' => "",
            'uid' => "",
            'cusername' => "",
            'comment' => ""
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $commentData['news_id'] = $news['id'];
            $commentData['uid'] = $_SESSION['id'];
            $commentData['cusername'] = $_SESSION['username'];
            $commentData['comment'] = $_POST['comment'];

            $add_comments = new Comments();
            $add_comments->load($commentData);
            $err = $add_comments->save();
            if (empty($err)) {
                header("Refresh:0");
                exit;
            }
        }
        //Create comment end

        $comments_count = count($comments);
        $router->view("news/details", [
            'news' => $news,
            'comments' => $comments,
            'comments_count' => $comments_count,
            'add_comments' => $commentData,
            'errors' => $err
        ]);
    }

    public static function createNews(Router $router) //Admin
    {
        $success = 0;
        $err = [];
        $newsData = [
            'title' => "",
            'details' => "",
            'poster_link' => ""
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newsData['title'] = htmlspecialchars($_POST['title']);
            $newsData['details'] = htmlspecialchars($_POST['details']);
            $newsData['poster_link'] = htmlspecialchars($_POST['poster_link']);

            $news = new News();
            $news->load($newsData);
            $err = $news->save();
            if (empty($err)) {

                $success = 1;
                $newsData = [
                    'title' => "",
                    'details' => "",
                    'poster_link' => ""
                ];
            }

        }
        $router->view('news/create', [
            'news' => $newsData,
            'errors' => $err,
            'success' => $success
        ]);
    }

    public static function editNews(Router $router) //Admin
    {
        $id = $_GET['id'] ?? null;
        $warning = 0;
        $success = 0;

        if (!$id) {
            $warning = 1;
        } else {
            $id = htmlspecialchars($id);
        }

        $err = [];
        $newsData = $router->db->getSingleNews($id, true);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['delete'])) {
                $router->db->deleteNews($id);
            } elseif (isset($_POST['edit'])) {
                $router->db->editNewsById($id);
            } else {
                $newsData['title'] = htmlspecialchars($_POST['title']);
                $newsData['details'] = htmlspecialchars($_POST['details']);
                $newsData['poster_link'] = $_POST['poster_link'];

                $news = new News();
                $news->load($newsData);
                $errors = $news->save();
            }

            if (empty($errors)) {
                $success = 1;
                $newsData = $router->db->getSingleNews($id, true);
            }
        }

        $router->view('admin/update_news', [
            'news' => $newsData,
            'errors' => $err,
            'id' => $id,
            'warning' => $warning,
            'success' => $success
        ]);
    }

    /*public static function getNewsAction($readDB,$writeDB)
    {
        if (array_key_exists("newsid", $_GET)) {
            $news_id = $_GET['newsid'];

            if ($news_id == '' || !is_numeric($news_id)) {
                $response = new Response();
                $response->setHttpStatusCode(400);
                $response->setSuccess(false);
                $response->addMessage("News ID cannot be blank or must be numeric");
                $response->send();
                exit;
            }

            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                // attempt to query the database
                try {
                    $query = $readDB->prepare('SELECT id, title, details, poster_link from news where id = :id');
                    $query->bindParam(':id', $news_id, PDO::PARAM_INT);
                    $query->execute();

                    $rowCount = $query->rowCount();

                    $newsArr = [];

                    if ($rowCount === 0) {
                        // set up response for unsuccessful return
                        $response = new Response();
                        $response->setHttpStatusCode(404);
                        $response->setSuccess(false);
                        $response->addMessage("News not found");
                        $response->send();
                        exit;
                    }

                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        $news = new News($row['id'], $row['title'], $row['details'], $row['poster_link']);

                        $newsArr[] = $news->returnNewsAsArray();
                    }

                    $returnData = [];
                    $returnData['rows_returned'] = $rowCount;
                    $returnData['news'] = $newsArr;

                    // set up response for successful return
                    $response = new Response();
                    $response->setHttpStatusCode(200);
                    $response->setSuccess(true);
                    $response->setData($returnData);
                    $response->send();
                    exit;
                } // if error with sql query return a json error
                catch (NewsException $ex) {
                    $response = new Response();
                    $response->setHttpStatusCode(500);
                    $response->setSuccess(false);
                    $response->addMessage($ex->getMessage());
                    $response->send();
                    exit;
                } catch (PDOException $ex) {
                    error_log("Database Query Error: " . $ex, 0);
                    $response = new Response();
                    $response->setHttpStatusCode(500);
                    $response->setSuccess(false);
                    $response->addMessage("Failed to get news");
                    $response->send();
                    exit;
                }
            } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                try {
                    $query = $writeDB->prepare('DELETE from news where id = :id');
                    $query->bindParam(':id', $news_id, PDO::PARAM_INT);
                    $query->execute();

                    $rowCount = $query->rowCount();

                    if ($rowCount === 0) {
                        // set up response for unsuccessful return
                        $response = new Response();
                        $response->setHttpStatusCode(404);
                        $response->setSuccess(false);
                        $response->addMessage("News not found");
                        $response->send();
                        exit;
                    }
                    // set up response for successful return
                    $response = new Response();
                    $response->setHttpStatusCode(200);
                    $response->setSuccess(true);
                    $response->addMessage("News deleted");
                    $response->send();
                    exit;
                } // if error with sql query return a json error
                catch (PDOException $ex) {
                    $response = new Response();
                    $response->setHttpStatusCode(500);
                    $response->setSuccess(false);
                    $response->addMessage("Failed to delete news");
                    $response->send();
                    exit;
                }
            } elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
                try {
                    if ($_SERVER['CONTENT_TYPE'] !== 'application/json') {
                        // set up response for unsuccessful request
                        $response = new Response();
                        $response->setHttpStatusCode(400);
                        $response->setSuccess(false);
                        $response->addMessage("Content Type header not set to JSON");
                        $response->send();
                        exit;
                    }

                    $rawPatchData = file_get_contents('php://input');

                    if (!$jsonData = json_decode($rawPatchData)) {
                        $response = new Response();
                        $response->setHttpStatusCode(400);
                        $response->setSuccess(false);
                        $response->addMessage("Request body is not valid JSON");
                        $response->send();
                        exit;
                    }

                    $title_updated = false;
                    $details_updated = false;
                    $poster_link_updated = false;

                    $queryFields = "";

                    if (isset($jsonData->title)) {
                        $title_updated = true;
                        $queryFields .= "title = :title, ";
                    }

                    if (isset($jsonData->details)) {
                        $details_updated = true;
                        $queryFields .= "details = :details, ";
                    }

                    if (isset($jsonData->poster_link)) {
                        // set deadline field updated to true
                        $poster_link_updated = true;
                        // add deadline field to query field string
                        $queryFields .= "poster_link = :poster_link, ";
                    }

                    $queryFields = rtrim($queryFields, ", ");

                    // check if any news fields supplied in JSON
                    if ($title_updated === false && $details_updated === false && $poster_link_updated === false) {
                        $response = new Response();
                        $response->setHttpStatusCode(400);
                        $response->setSuccess(false);
                        $response->addMessage("No news fields provided");
                        $response->send();
                        exit;
                    }

                    $query = $writeDB->prepare('SELECT id, title, details, poster_link from news where id = :id');
                    $query->bindParam(':id', $news_id, PDO::PARAM_INT);
                    $query->execute();

                    $rowCount = $query->rowCount();

                    if ($rowCount === 0) {
                        $response = new Response();
                        $response->setHttpStatusCode(404);
                        $response->setSuccess(false);
                        $response->addMessage("No news found to update");
                        $response->send();
                        exit;
                    }

                    // for each row returned - should be just one
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        // create new news object
                        $news = new News($row['id'], $row['title'], $row['details'], $row['poster_link']);
                    }

                    $queryString = "UPDATE news set " . $queryFields . " where id = :id";
                    $query = $writeDB->prepare($queryString);

                    // if title has been provided
                    if ($title_updated === true) {
                        $news->setTitle($jsonData->title);
                        $up_title = $news->getTitle();
                        $query->bindParam(':title', $up_title, PDO::PARAM_STR);
                    }

                    // if description has been provided
                    if ($details_updated === true) {
                        $news->setDetails($jsonData->details);
                        $up_details = $news->getDetails();
                        // bind the parameter of the new value from the object to the query (prevents SQL injection)
                        $query->bindParam(':details', $up_details, PDO::PARAM_STR);
                    }

                    // if deadline has been provided
                    if ($poster_link_updated === true) {
                        $news->setPosterLink($jsonData->poster_link);
                        $up_poster_link = $news->getPosterLink();
                        // bind the parameter of the new value from the object to the query (prevents SQL injection)
                        $query->bindParam(':poster_link', $up_poster_link, PDO::PARAM_STR);
                    }


                    $query->bindParam(':id', $news_id, PDO::PARAM_INT);
                    $query->execute();

                    $rowCount = $query->rowCount();


                    if ($rowCount === 0) {
                        // set up response for unsuccessful return
                        $response = new Response();
                        $response->setHttpStatusCode(400);
                        $response->setSuccess(false);
                        $response->addMessage("News not updated - given values may be the same as the stored values");
                        $response->send();
                        exit;
                    }

                    $query = $writeDB->prepare('SELECT id, title, details,poster_link from news where id = :id');
                    $query->bindParam(':id', $news_id, PDO::PARAM_INT);
                    $query->execute();

                    // get row count
                    $rowCount = $query->rowCount();

                    if ($rowCount === 0) {
                        // set up response for unsuccessful return
                        $response = new Response();
                        $response->setHttpStatusCode(404);
                        $response->setSuccess(false);
                        $response->addMessage("No news found");
                        $response->send();
                        exit;
                    }
                    $newsArr = [];

                    // for each row returned
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        $news = new News($row['id'], $row['title'], $row['details'], $row['poster_link']);

                        $newsArr[] = $news->returnNewsAsArray();
                    }

                    $returnData = [];
                    $returnData['rows_returned'] = $rowCount;
                    $returnData['news'] = $newsArr;

                    // set up response for successful return
                    $response = new Response();
                    $response->setHttpStatusCode(200);
                    $response->setSuccess(true);
                    $response->addMessage("News updated");
                    $response->setData($returnData);
                    $response->send();
                    exit;
                } catch (NewsException $ex) {
                    $response = new Response();
                    $response->setHttpStatusCode(400);
                    $response->setSuccess(false);
                    $response->addMessage($ex->getMessage());
                    $response->send();
                    exit;
                } // if error with sql query return a json error
                catch (PDOException $ex) {
                    error_log("Database Query Error: " . $ex, 0);
                    $response = new Response();
                    $response->setHttpStatusCode(500);
                    $response->setSuccess(false);
                    $response->addMessage("Failed to update news - check your data for errors");
                    $response->send();
                    exit;
                }
            } // if any other request method apart from GET, PATCH, DELETE is used then return 405 method not allowed
            else {
                $response = new Response();
                $response->setHttpStatusCode(405);
                $response->setSuccess(false);
                $response->addMessage("Request method not allowed");
                $response->send();
                exit;
            }
        } // handle getting all news page of 20 at a time
        elseif (array_key_exists("page", $_GET)) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {

                // get page id from query string
                $page = $_GET['page'];

                //check to see if page id in query string is not empty and is number, if not return json error
                if ($page == '' || !is_numeric($page)) {
                    $response = new Response();
                    $response->setHttpStatusCode(400);
                    $response->setSuccess(false);
                    $response->addMessage("Page number cannot be blank and must be numeric");
                    $response->send();
                    exit;
                }

                // set limit to 20 per page
                $limitPerPage = 20;

                // attempt to query the database
                try {
                    $query = $readDB->prepare('SELECT count(id) as totalNoOfNews from news');
                    $query->execute();

                    // get row for count total
                    $row = $query->fetch(PDO::FETCH_ASSOC);

                    $newsCount = intval($row['totalNoOfNews']);

                    // get number of pages required for total results use ceil to round up
                    $numOfPages = ceil($newsCount / $limitPerPage);

                    // if no rows returned then always allow page 1 to show a successful response with 0 news
                    if ($numOfPages == 0) {
                        $numOfPages = 1;
                    }

                    // if passed in page number is greater than total number of pages available or page is 0 then 404 error - page not found
                    if ($page > $numOfPages || $page == 0) {
                        $response = new Response();
                        $response->setHttpStatusCode(404);
                        $response->setSuccess(false);
                        $response->addMessage("Page not found");
                        $response->send();
                        exit;
                    }

                    // set offset based on current page, e.g. page 1 = offset 0, page 2 = offset 20
                    $offset = ($page == 1 ? 0 : (20 * ($page - 1)));

                    // get rows for page
                    // create db query
                    $query = $readDB->prepare('SELECT id, title, details, poster_link from news limit :pglimit OFFSET :offset');
                    $query->bindParam(':pglimit', $limitPerPage, PDO::PARAM_INT);
                    $query->bindParam(':offset', $offset, PDO::PARAM_INT);
                    $query->execute();

                    // get row count
                    $rowCount = $query->rowCount();

                    // create news array to store returned news
                    $newsArr = [];

                    // for each row returned
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        $news = new News($row['id'], $row['title'], $row['details'], $row['poster_link']);

                        $newsArr[] = $news->returnNewsAsArray();
                    }

                    $returnData = [];
                    $returnData['rows_returned'] = $rowCount;
                    $returnData['total_rows'] = $newsCount;
                    $returnData['total_pages'] = $numOfPages;
                    // if passed in page less than total pages then return true
                    ($page < $numOfPages ? $returnData['has_next_page'] = true : $returnData['has_next_page'] = false);
                    // if passed in page greater than 1 then return true
                    ($page > 1 ? $returnData['has_previous_page'] = true : $returnData['has_previous_page'] = false);
                    $returnData['news'] = $newsArr;

                    // set up response for successful return
                    $response = new Response();
                    $response->setHttpStatusCode(200);
                    $response->setSuccess(true);
                    $response->setData($returnData);
                    $response->send();
                    exit;
                } // if error with sql query return a json error
                catch (NewsException $ex) {
                    $response = new Response();
                    $response->setHttpStatusCode(500);
                    $response->setSuccess(false);
                    $response->addMessage($ex->getMessage());
                    $response->send();
                    exit;
                } catch (PDOException $ex) {
                    error_log("Database Query Error: " . $ex, 0);
                    $response = new Response();
                    $response->setHttpStatusCode(500);
                    $response->setSuccess(false);
                    $response->addMessage("Failed to get news");
                    $response->send();
                    exit;
                }
            } // if any other request method apart from GET is used then return 405 method not allowed
            else {
                $response = new Response();
                $response->setHttpStatusCode(405);
                $response->setSuccess(false);
                $response->addMessage("Request method not allowed");
                $response->send();
                exit;
            }
        } elseif (empty($_GET)) {

            if ($_SERVER['REQUEST_METHOD'] === 'GET') {

                // attempt to query the database
                try {
                    // create db query
                    $query = $readDB->prepare('SELECT id, title, details, poster_link from news');
                    $query->execute();

                    // get row count
                    $rowCount = $query->rowCount();

                    $newsArr = array();

                    // for each row returned
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        $news = new News($row['id'], $row['title'], $row['details'], $row['poster_link']);

                        $newsArr[] = $news->returnNewsAsArray();
                    }

                    $returnData = array();
                    $returnData['rows_returned'] = $rowCount;
                    $returnData['news'] = $newsArr;

                    // set up response for successful return
                    $response = new Response();
                    $response->setHttpStatusCode(200);
                    $response->setSuccess(true);
                    $response->setData($returnData);
                    $response->send();
                    exit;
                } // if error with sql query return a json error
                catch (NewsException $ex) {
                    $response = new Response();
                    $response->setHttpStatusCode(500);
                    $response->setSuccess(false);
                    $response->addMessage($ex->getMessage());
                    $response->send();
                    exit;
                } catch (PDOException $ex) {
                    error_log("Database Query Error: " . $ex, 0);
                    $response = new Response();
                    $response->setHttpStatusCode(500);
                    $response->setSuccess(false);
                    $response->addMessage("Failed to get news");
                    $response->send();
                    exit;
                }
            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

                // create news
                try {
                    // check request's content type header is JSON
                    if ($_SERVER['CONTENT_TYPE'] !== 'application/json') {
                        // set up response for unsuccessful request
                        $response = new Response();
                        $response->setHttpStatusCode(400);
                        $response->setSuccess(false);
                        $response->addMessage("Content Type header not set to JSON");
                        $response->send();
                        exit;
                    }

                    // get POST request body as the POSTed data will be JSON format
                    $rawPostData = file_get_contents('php://input');

                    if (!$jsonData = json_decode($rawPostData)) {
                        // set up response for unsuccessful request
                        $response = new Response();
                        $response->setHttpStatusCode(400);
                        $response->setSuccess(false);
                        $response->addMessage("Request body is not valid JSON");
                        $response->send();
                        exit;
                    }

                    // check if post request contains title and completed data in body as these are mandatory
                    if (!isset($jsonData->title)) {
                        $response = new Response();
                        $response->setHttpStatusCode(400);
                        $response->setSuccess(false);
                        $response->send();
                        exit;
                    }

                    // create new news with data, if non mandatory fields not provided then set to null
                    $newNews = new News(null, $jsonData->title, $jsonData->details, $jsonData->poster_link);
                    // get title, description, deadline, completed and store them  in variables
                    $title = $newNews->getTitle();
                    $description = $newNews->getDetails();
                    $poster_link = $newNews->getPosterLink();

                    // create db query
                    $query = $writeDB->prepare('INSERT into news (title, details, poster_link) values (:title, :details, :poster_link)');
                    $query->bindParam(':title', $title, PDO::PARAM_STR);
                    $query->bindParam(':details', $details, PDO::PARAM_STR);
                    $query->bindParam(':poster_link', $poster_link, PDO::PARAM_STR);
                    $query->execute();

                    // get row count
                    $rowCount = $query->rowCount();

                    // check if row was actually inserted, PDO exception should have caught it if not.
                    if ($rowCount === 0) {
                        // set up response for unsuccessful return
                        $response = new Response();
                        $response->setHttpStatusCode(500);
                        $response->setSuccess(false);
                        $response->addMessage("Failed to create news");
                        $response->send();
                        exit;
                    }

                    $lastNewsID = $writeDB->lastInsertId();
                    $query = $writeDB->prepare('SELECT id, title, details,poster_link from news where id = :id');
                    $query->bindParam(':id', $lastNewsID, PDO::PARAM_INT);
                    $query->execute();

                    // get row count
                    $rowCount = $query->rowCount();

                    if ($rowCount === 0) {
                        // set up response for unsuccessful return
                        $response = new Response();
                        $response->setHttpStatusCode(500);
                        $response->setSuccess(false);
                        $response->addMessage("Failed to retrieve news after creation");
                        $response->send();
                        exit;
                    }

                    $newsArr = [];

                    // for each row returned - should be just one
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        $news = new News($row['id'], $row['title'], $row['details'], $row['poster_link']);

                        $newsArr[] = $news->returnNewsAsArray();
                    }
                    $returnData = [];
                    $returnData['rows_returned'] = $rowCount;
                    $returnData['news'] = $newsArr;

                    //set up response for successful return
                    $response = new Response();
                    $response->setHttpStatusCode(201);
                    $response->setSuccess(true);
                    $response->addMessage("News created");
                    $response->setData($returnData);
                    $response->send();
                    exit;
                } catch (NewsException $ex) {
                    $response = new Response();
                    $response->setHttpStatusCode(400);
                    $response->setSuccess(false);
                    $response->addMessage($ex->getMessage());
                    $response->send();
                    exit;
                } // if error with sql query return a json error
                catch (PDOException $ex) {
                    error_log("Database Query Error: " . $ex, 0);
                    $response = new Response();
                    $response->setHttpStatusCode(500);
                    $response->setSuccess(false);
                    $response->addMessage("Failed to insert news into database - check submitted data for errors" . $ex->getMessage());
                    $response->send();
                    exit;
                }
            } // if any other request method apart from GET or POST is used then return 405 method not allowed
            else {
                $response = new Response();
                $response->setHttpStatusCode(405);
                $response->setSuccess(false);
                $response->addMessage("Request method not allowed");
                $response->send();
                exit;
            }
        } // return 404 error if endpoint not available
        else {
            $response = new Response();
            $response->setHttpStatusCode(404);
            $response->setSuccess(false);
            $response->addMessage("Endpoint not found");
            $response->send();
            exit;
        }



    }*/
}