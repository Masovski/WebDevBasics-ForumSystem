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
            ORDER BY created_at DESC");
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

    // Not sure if this should be here or I have to make a new instance of CategoriesModel
    public function getAllCategories() {
        $statement = self::$db->query("SELECT id, name FROM categories");
        return $statement->fetch_all(MYSQLI_ASSOC);
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

    public function createQuestion($title, $content, $owner_username, $category_id, $tags) {
        $userStatement = self::$db->prepare(
            "SELECT id FROM users WHERE username = ?");
        $userStatement->bind_param("s", $owner_username);
        $userStatement->execute();
        $owner_id = $userStatement->get_result()->fetch_assoc()['id'];
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

        return $statement->insert_id;
    }

    public function editQuestion() {
        // TODO
    }

    public function deleteQuestion() {
        // TODO
    }

    public function linkQuestionTags($questionId, $tags) {
        foreach ($tags as $tag) {
            $createTagStatement = self::$db->prepare(
                "INSERT IGNORE INTO tags SET name=?");
            $createTagStatement->bind_param("s", $tag);
            $createTagStatement->execute();
            $tagId = $createTagStatement->insert_id;

            if($tagId == 0) {
                $getTagIdStatement = self::$db->prepare(
                    "SELECT id FROM tags WHERE name = ?");
                $getTagIdStatement->bind_param("s", $tag);
                $getTagIdStatement->execute();
                $tagId = $getTagIdStatement->get_result()->fetch_assoc()['id'];
            }

            $linkStatement = self::$db->prepare(
                "INSERT INTO questions_tags (question_id, tag_id)
                VALUES (?, ?)");
            $linkStatement->bind_param("ii", $questionId, $tagId);
            $linkStatement->execute();
        }
    }
}