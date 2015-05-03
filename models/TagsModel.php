<?php

class TagsModel extends BaseModel{
    public function getAll($questionId) {
        $statement = self::$db->prepare(
            "SELECT t.name
            FROM tags t
            JOIN questions_tags qt
                ON qt.tag_id = t.id AND qt.question_id = ?
            ORDER BY t.name");
        $statement->bind_param("i", $questionId);
        $statement->execute();

        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function linkToQuestion($questionId, $tags) {
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