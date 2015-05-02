<?php

class QuestionsController extends BaseController {
    private $db;

    public function onInit() {
        $this->title = "Questions";
        $this->db = new QuestionsModel();
    }

    public function index() {
        $this->questions = $this->db->getAll();
    }

    public function view($questionId) {
        $this->question = $this->db->getQuestionDetails($questionId);
        $this->title = $this->question['title'];
        $this->db->addVisit($questionId);
        $this->tags = $this->db->getTags($questionId);
    }

    public function create() {
        $this->title = 'Create new question';
        if ($this->isPost) {
            var_dump($_POST);
            if ($_POST['title'] == '') {
                $this->addErrorMessage("Are you insane? You can't submit a question without title.");
                return;
            }
            if ($_POST['content'] == '') {
                $this->addErrorMessage("Are you insane? You can't submit a question without content.");
                return;
            }

            $questionCreated = $this->db->createQuestion($_POST['title'], $_POST['content'], 1, 1);
            if ($questionCreated) {
                $this->addSuccessMessage("You have successfully created a question!");
            }
        }
    }
}