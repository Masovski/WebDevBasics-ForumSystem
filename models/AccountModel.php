<?php

class AccountModel extends BaseModel {
    public function register($username, $password, $email) {
        $statement = self::$db->prepare(
            "SELECT COUNT(id) FROM users WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        if($result['COUNT(id)']) {
            return false;
        }

        $pass_salt = mcrypt_create_iv(32, MCRYPT_DEV_URANDOM);
        $hash_pass = password_hash($password . $pass_salt, PASSWORD_BCRYPT);
        $registerDateTime = date("c");

        $registerStatement = self::$db->prepare(
            "INSERT INTO users (username, password_hashed, password_salt, email_address, register_date)
            VALUES (?, ?, ?, ?, ?)");
        $registerStatement->bind_param(
            "sssss",
            $username,
            $hash_pass,
            $pass_salt,
            $email,
            $registerDateTime);
        $registerStatement->execute();

        return true;
    }

    public function login($username, $password) {
        // Get the user from the database.
        $statement = self::$db->prepare(
            "SELECT username, password_hashed, password_salt FROM users WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();

        // Check user's password and return true if correct
        if (password_verify($password . $result['password_salt'], $result['password_hashed'])) {
            return true;
        }

        return false;
    }
}