<?php
class QuestionsModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query(
            "SELECT
                q.id,
                q.title,
                q.content,
                u.username AS owner_username,
                c.name AS category_name,
                q.created_at,
                q.visits
            FROM questions q
            JOIN users u
                ON q.owner_id = u.id
            JOIN categories c
                ON q.category_id = c.id
            ORDER BY q.created_at DESC, q.id DESC");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getByCategory($categoryId) {
        $statement = self::$db->prepare(
            "SELECT
                q.id,
                q.title,
                q.content,
                u.username AS owner_username,
                c.name AS category_name,
                q.created_at,
                q.visits
            FROM questions q
            JOIN users u
                ON q.owner_id = u.id
            JOIN categories c
                ON q.category_id = c.id AND c.id = ?
            ORDER BY created_at DESC, q.id DESC");
        $statement->bind_param('i', $categoryId);
        $statement->execute();

        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllByTag($tagName) {
        $statement = self::$db->prepare(
            "SELECT DISTINCT
                q.id,
                q.title,
                q.content,
                u.username AS owner_username,
                c.name AS category_name,
                q.created_at,
                q.visits
            FROM questions q
                JOIN questions_tags qt
                    ON qt.question_id = q.id
                JOIN tags t
                    ON qt.tag_id = t.id AND t.name = ?
                JOIN users u
                    ON q.owner_id = u.id
                JOIN categories c
                    ON q.category_id = c.id
            ORDER BY q.created_at DESC, q.id DESC");
        $statement->bind_param('s', $tagName);
        $statement->execute();

        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllByQuestionTitle($questionTitle) {
        $questionTitleQueryParam = '%' . $questionTitle . '%';
        $statement = self::$db->prepare(
            "SELECT DISTINCT
                q.id,
                q.title,
                q.content,
                u.username AS owner_username,
                c.name AS category_name,
                q.created_at,
                q.visits
            FROM questions q
            JOIN users u
                ON q.owner_id = u.id
            JOIN categories c
                ON q.category_id = c.id
            WHERE q.title LIKE ?
            ORDER BY created_at DESC, q.id DESC");
        $statement->bind_param('s', $questionTitleQueryParam);
        $statement->execute();

        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllByAnswerContent($answerContent) {
        $answerContentQueryParam = '%' . $answerContent . '%';
        $statement = self::$db->prepare(
            "SELECT DISTINCT
                q.id,
                q.title,
                q.content,
                u.username AS owner_username,
                c.name AS category_name,
                q.created_at,
                q.visits
            FROM questions q
            JOIN users u
                ON q.owner_id = u.id
            JOIN categories c
                ON q.category_id = c.id
            JOIN answers a
              ON a.question_id = q.id
            WHERE a.text LIKE ?
            ORDER BY created_at DESC, q.id DESC");
        $statement->bind_param('s', $answerContentQueryParam);
        $statement->execute();

        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getQuestionDetails($questionId) {
        $statement = self::$db->prepare(
            "SELECT
                q.id,
                q.title,
                q.content,
                u.username AS owner_username,
                c.name AS category_name,
                q.created_at,
                q.visits
            FROM questions q
            JOIN users u
                ON q.owner_id = u.id
            JOIN categories c
                ON q.category_id = c.id
            WHERE q.id = ?");
        $statement->bind_param("i", $questionId);
        $statement->execute();

        return $statement->get_result()->fetch_assoc();
    }

    public function addVisit($questionId) {
        $statement = self::$db->prepare(
            "UPDATE questions SET visits = visits + 1 WHERE id = ?");
        $statement->bind_param("i", $questionId);
        $statement->execute();
        return;
    }

    public function createQuestion($title, $content, $ownerId, $categoryId) {
        $currentDateTime = date("c");
        $statement = self::$db->prepare(
            "INSERT INTO questions (title, content, owner_id, category_id, created_at)
            VALUES (?, ?, ?, ?, ?)");
        $statement->bind_param(
            "ssiis",
            $title,
            $content,
            $ownerId,
            $categoryId,
            $currentDateTime
        );
        $statement->execute();

        return $statement->insert_id;
    }

    public function editQuestion() {
        // TODO
    }

    public function deleteQuestion() {
        // TODO
    }
}