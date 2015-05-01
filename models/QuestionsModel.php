<?php


class QuestionsModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query(
            "SELECT * FROM questions ORDER BY id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getTags($questionId) {
        $statement = self::$db->prepare(
            "SELECT t.name
            FROM tags t
            JOIN questions_tags qt
                ON qt.tag_id = t.id AND qt.question_id = ?
            ORDER BY t.name");
        $statement->bind_param("i", $questionId);
        $statement->execute();

        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getQuestionDetails($questionId) {
        $statement = self::$db->prepare(
            "SELECT * FROM questions WHERE id = ?");
        $statement->bind_param("i", $questionId);
        $statement->execute();
        $result = $statement->get_result();
        $questionDetails = $result->fetch_assoc();

        return $questionDetails;
    }

    public function addVisit($questionId) {
        $statement = self::$db->prepare(
            "UPDATE questions SET visits = visits + 1 WHERE id = ?");
        $statement->bind_param("i", $questionId);
        $statement->execute();
        return;
    }

    public function createQuestion($title, $content, $owner_id, $category_id) {
        $currentDateTime = date("c");
        $statement = self::$db->prepare(
            "INSERT INTO questions (title, content, owner_id, category_id, created_at)
            VALUES (?, ?, ?, ?, ?)");
        $statement->bind_param(
            "ssiis",
            $title,
            $content,
            $owner_id,
            $category_id,
            $currentDateTime
        );
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function editQuestion() {

    }

    public function deleteQuestion() {

    }
}