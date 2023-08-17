<?php
include_once __DIR__ . "/../vendor/db.php";
class Reviews
{
    private $connection = "";
    function __construct()
    {
        $this->connection = Database::connect();
    }

    function upload_review($userId, $content, $BookList)
    {
        $sql = "SELECT id
        FROM user_review
        ORDER BY id DESC
        LIMIT 1;";
        $LastIndex_statement = $this->connection->prepare($sql);
        $LastIndex_statement->execute();
        $LastIndex = $LastIndex_statement->fetch(PDO::FETCH_ASSOC);
        $UserReview_id = $LastIndex['id'] + 2;

        $insert_to_userReview_sql = "INSERT INTO `user_review`(`id`, `user_id`, `content`) VALUES (:id,:userId,:content)";
        $insert_to_userReview_statement = $this->connection->prepare($insert_to_userReview_sql);
        $insert_to_userReview_statement->bindParam(":id", $UserReview_id);
        $insert_to_userReview_statement->bindParam(":userId", $userId);
        $insert_to_userReview_statement->bindParam(":content", $content);
        if (
            $insert_to_userReview_statement->execute()
        ) {
            foreach ($BookList as $Book) {
                $sql = "INSERT INTO `review_book`( `user_review_id`, `book_id`) VALUES (:userReviewId,:BookId)";
                $statement = $this->connection->prepare($sql);
                $statement->bindParam(":userReviewId", $UserReview_id);
                $statement->bindParam(":BookId", $Book);
                $statement->execute();
            }
            return true;
        } else {
            return false;
        }



    }
    function get_all_review()
    {
        $sql = "SELECT * FROM `user_review`";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

    function get_review_with_limit_offset($limit, $offset)
    {
        $sql = "SELECT * FROM `user_review` ORDER BY date DESC LIMIT :limit_num OFFSET :offset_num ";
        $statement = $this->connection->prepare($sql);

        $statement->bindValue(':limit_num', $limit, PDO::PARAM_INT);
        $statement->bindValue(':offset_num', $offset, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_review_book($review_id)
    {
        $sql = "SELECT * FROM `review_book` WHERE `user_review_id`=:id";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":id", $review_id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_bookinfo_by_id($id)
    {
        $sql = "SELECT * FROM `book` WHERE `id` = :id";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_userinfo_by_id($id)
    {
        $sql = "SELECT name,image FROM `user` WHERE `id` = :id";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_author_by_id($id)
    {
        $sql = "SELECT * FROM `auther` WHERE `id` = :id";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_review_by_userId($id)
    {
        $sql = "SELECT * FROM `user_review` WHERE `user_id` = :id order by date desc";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_review_reacts($Review_id)
    {
        $sql = "SELECT COUNT(*) AS user_react
        FROM review_react
        WHERE review_book_id = :id";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":id", $Review_id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_review_comments($Review_id)
    {
        $sql = "SELECT * FROM `review_comment` WHERE `review_book_id` = :id ORDER BY date DESC";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":id", $Review_id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function create_review_react($Review_id, $userId)
    {
        $sql = "INSERT INTO `review_react`(`user_id`, `review_book_id`, `love`) VALUES (:user_id,:review_id,1)";
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(":review_id", $Review_id);
        $statement->bindValue(":user_id", $userId);
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function delete_review_react($Review_id, $user_id)
    {
        $sql = "DELETE FROM `review_react` WHERE user_id = :user_id and review_book_id = :review_id";
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(":review_id", $Review_id);
        $statement->bindValue(":user_id", $user_id);
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function is_react($Review_id, $user_id)
    {
        $sql = "SELECT love FROM `review_react` WHERE user_id = :user_id and review_book_id = :review_id";
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(":review_id", $Review_id);
        $statement->bindValue(":user_id", $user_id);
        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }
    
    function create_comment($Review_id, $userId,$comment)
    {
        $sql = "INSERT INTO `review_comment`(`user_id`, `review_book_id`, `comment`) VALUES (:user_id,:review_id,:comment)";
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(":review_id", $Review_id);
        $statement->bindValue(":user_id", $userId);
        $statement->bindValue(":comment", $comment);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

$reviews_model = new Reviews();
// $result = $reviews_model->is_react(1,1);
// var_dump($result);
?>