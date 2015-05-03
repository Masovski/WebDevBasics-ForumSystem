<?php

class AnswersModel extends BaseModel {
    public function getAll($questionId) {
        $statement = self::$db->prepare(
            "SELECT a.text, u.username, a.created_at, a.anonymous_name
            FROM answers a
            LEFT JOIN users u
                ON u.id = a.owner_id
            JOIN questions q
                ON q.id = a.question_id AND q.id = ?
            ORDER BY a.created_at DESC, a.id DESC");
        $statement->bind_param("i", $questionId);
        $statement->execute();

        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function createUserAnswer($content, $questionId, $ownerId) {
        $currentDateTime = date("c");

        $statement = self::$db->prepare(
            "INSERT INTO answers (text, question_id, owner_id, created_at)
            VALUES (?, ?, ?, ?)");
        $statement->bind_param("siis", $content, $questionId, $ownerId, $currentDateTime);
        $statement->execute();

        return $statement->affected_rows > 0;
    }

    public function createAnonymousAnswer($visitorName, $content, $visitorEmail, $questionId) {
        $currentDateTime = date("c");

        $statement = self::$db->prepare(
            "INSERT INTO answers (text, question_id, anonymous_name, anonymous_email, created_at)
            VALUES (?, ?, ?, ?, ?)");
        $statement->bind_param("sisss", $content, $questionId, $visitorName, $visitorEmail, $currentDateTime);
        $statement->execute();

        return $statement->affected_rows > 0;
    }
}