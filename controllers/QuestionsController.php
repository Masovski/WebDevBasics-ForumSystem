<?php

class QuestionsController extends BaseController {
    private $questionsDao;
    private $categoriesDao;
    private $answersDao;
    private $tagsDao;

    public function onInit() {
        $this->title = "Questions";
        $this->questionsDao = new QuestionsModel();
        $this->categoriesDao = new CategoriesModel();
        $this->answersDao = new AnswersModel();
        $this->tagsDao = new TagsModel();
    }

    public function index() {
        $this->questions = $this->questionsDao->getAll();
        $this->categories = $this->categoriesDao->getAll();
    }

    public function view($questionId) {
        $this->question = $this->questionsDao->getQuestionDetails($questionId);
        $this->title = $this->question['title'];
        $this->answers = $this->answersDao->getAll($questionId);
        $this->questionsDao->addVisit($questionId);
        $this->tags = $this->tagsDao->getAll($questionId);
    }

    public function create() {
        $this->authorize();
        $this->title = 'Create new question';
        $this->categories = $this->categoriesDao->getAll();

        if ($this->isPost) {
            if (!isset($_POST['formToken']) || $_POST['formToken'] != $_SESSION['formToken']) {
                throw new Exception('Invalid request!');
                exit;
            }

            $title = $_POST['title'];
            $content = $_POST['content'];
            $categoryId = $_POST['categoryId'];
            $tagMatches = array();
            preg_match_all('/([a-zA-Z])+/i', $_POST['tags'], $tagMatches, PREG_SPLIT_NO_EMPTY);

            if (count($tagMatches[0]) < 1) {
                $this->addErrorMessage("Questions must have tags.");
                return;
            }

            $this->validateInputLength($title, 3, "The title should be at least 3 characters long.");
            $this->validateInputLength($content, 10, "The question should be at least 10 characters long.");

            $questionCreated = $this->questionsDao->createQuestion($title, $content, $_SESSION['id'], $categoryId);
            if ($questionCreated) {
                $this->tagsDao->linkToQuestion($questionCreated, $tagMatches[0]);
                $this->addSuccessMessage("You have successfully created a question!");
                $this->redirect("questions", "view", array($questionCreated));
            }
        }

        $_SESSION['formToken'] = uniqid(mt_rand(), true);
    }

    public function answer($questionId) {
        if ($this->isPost) {
            if (!isset($_POST['formToken']) || $_POST['formToken'] != $_SESSION['formToken']) {
                throw new Exception('Invalid request!');
                exit;
            }
            if (isset($_POST['anonymousName']) && $_POST['anonymousEmail']) {
                $anonymousName = $_POST['anonymousName'];
                $anonymousEmail = $_POST['anonymousEmail'];

                $this->validateInputLength($anonymousName, 2, "Your name should be at least 2 characters long.");
                $this->validateInputLength($anonymousEmail, 8, "Your email should be at least 8 characters long.");
            }

            $this->validateInputLength(
                $_POST['answerContent'],
                2,
                "Your answer should be at least 2 characters long");
            $answerContent = $_POST['answerContent'];

            if (!$this->isLoggedIn) {
                $answerCreated = $this->answersDao->createAnonymousAnswer($anonymousName, $answerContent, $anonymousEmail, $questionId);
            } else {
                $answerCreated = $this->answersDao->createUserAnswer($answerContent, $questionId, $_SESSION['id']);
            }

            if ($answerCreated) {
                $this->addSuccessMessage("You successfully added your comment.");
            } else {
                $this->addErrorMessage("Oops! Something went wrong while adding your comment. Try again later.");
            }

            $this->redirect("questions", "view", array($questionId));
        }

        $_SESSION['formToken'] = uniqid(mt_rand(), true);
    }

    // Search questions by category
    public function categories($categoryId) {
        $this->questions = $this->questionsDao->getByCategory($categoryId);
        $this->categories = $this->categoriesDao->getAll();
        $this->renderView('index');
    }
}