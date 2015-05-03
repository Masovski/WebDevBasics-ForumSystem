<?php

class AccountController extends BaseController {
    private $db;

    public function onInit() {
        $this->title = 'Account';
        $this->db = new AccountModel();
    }

    public function index() {
        $this->redirect("questions");
    }

    public function register() {
        $this->hideFromLoggedInUser();
        $this->title = 'Register new account';
        if ($this->isPost) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];

            // TODO: Fields validation.
            if ($username == '') {
                $this->addErrorMessage("Username cannot be blank");
            }

            if ($password == '') {
                $this->addErrorMessage("Password cannot be blank");
            }

            if ($email == '') {
                $this->addErrorMessage("Email cannot be blank");
            }

            if (isset($_SESSION['messages'])) {
                return;
            }

            $registeredUserId = $this->db->register($username, $password, $email);
            // This is zero if it can't register
            if ($registeredUserId) {
                $_SESSION['id'] = $registeredUserId;
                $_SESSION['username'] = $username;
                $this->addSuccessMessage("Registration successful!");
                $this->redirect("questions");
            } else {
                $this->addErrorMessage("Registration failed!");
                $this->redirect("account", "register");
            }
        }
    }

    public function login() {
        $this->hideFromLoggedInUser();
        $this->title = 'Login';
        if ($this->isPost) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if ($username == '') {
                $this->addErrorMessage("Username field is required.");
                return;
            }

            if ($password == '') {
                $this->addErrorMessage("Password field is required.");
                return;
            }

            $loggedInUserId = $this->db->login($username, $password);
            if ($loggedInUserId) {
                $_SESSION['id'] = $loggedInUserId;
                $_SESSION['username'] = $username;
                $this->addSuccessMessage("You got in. Nice one, little hacker.");
                $this->redirect("questions");
            } else {
                $this->addErrorMessage("Login failed!");
                $this->redirect("account", "login");
            }
        }
    }

    public function logout() {
        $this->authorize();
        unset($_SESSION['username']);
        $this->redirect("questions");
    }


}