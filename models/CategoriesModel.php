<?php
class CategoriesModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query(
            "SELECT c.id, c.name, COUNT(q.id) AS questions_count
            FROM categories c
                LEFT JOIN questions q
                    ON q.category_id = c.id
            GROUP BY c.name
            ORDER BY c.name");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
}