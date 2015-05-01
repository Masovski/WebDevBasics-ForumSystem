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
        $this->db->addVisit($questionId);
        $this->tags = $this->db->getTags($questionId);
    }

    public function create() {
        if ($this->isPost) {
            // TODO: Validation
            var_dump($_POST);
            if ($_POST['title'] == '') {
                $this->addErrorMessage("This is my name is, kukundrela, ale-lela");
            }
        }
    }
}