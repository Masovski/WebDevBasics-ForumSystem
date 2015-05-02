<?php

class QuestionsController extends BaseController {
    private $db;

    public function onInit() {
        $this->title = "Questions";
        $this->db = new QuestionsModel();
    }

    public function index() {
        $this->questions = $this->db->getAll();
        $this->categories = $this->db->getAllCategories();
    }

    public function view($questionId) {
        $this->question = $this->db->getQuestionDetails($questionId);
        $this->title = $this->question['title'];
        $this->db->addVisit($questionId);
        $this->tags = $this->db->getTags($questionId);
    }

    public function create() {
        $this->authorize();
        $this->title = 'Create new question';
        $this->categories = $this->db->getAllCategories();

        if ($this->isPost) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $categoryId = $_POST['categoryId'];
            $matches = array();
            preg_match_all('/([a-zA-Z])+/i', $_POST['tags'], $matches, PREG_SPLIT_NO_EMPTY);
            $tags = $matches[0];

            if ($title == '' || strlen($title) < 3) {
                $this->addErrorMessage("The title should be at least 3 characters long.");
                return;
            }
            if ($content == '' || strlen($content) < 10) {
                $this->addErrorMessage("The question should be at least 10 characters long.");
                return;
            }

            $questionCreated = $this->db->createQuestion($title, $content, $_SESSION['username'], $categoryId);
            if ($questionCreated) {
                $this->db->linkQuestionTags($questionCreated, $tags);
                $this->addSuccessMessage("You have successfully created a question!");
                $this->redirect("questions", "view", array($questionCreated));
            }
        }
    }
}