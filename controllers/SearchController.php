<?php
class SearchController extends BaseController {
    private $questionsDao;
    private $categoriesDao;
    private $tagsDao;

    public function onInit() {
        $this->title = 'Search questions';
        $this->questionsDao = new QuestionsModel();
        $this->categoriesDao = new CategoriesModel();
        $this->tagsDao = new TagsModel();
    }

    public function index() {
        if ($this->isPost) {
            $this->validateInputLength(
                $_POST['searchPhrase'],
                1,
                "You cannot search 'nothing'. Are you insane or something ?");

            $searchPhrase = $_POST['searchPhrase'];
            $searchBy = $_POST['searchBy'];

            switch($searchBy) {
                case 'tag':
                    $this->redirect('search', 'tag', array($searchPhrase));
                    break;
                case 'questionTitle':
                    $this->redirect('search', 'question', array($searchPhrase));
                    break;
                case 'answerContent':
                    $this->redirect('search', 'answer', array($searchPhrase));
                    break;
                default:
                    $this->addErrorMessage("Invalid search option.");
                    $this->renderView('index', 'questions');
                    break;
            }
        }
    }

    // Search questions by tag name.
    public function tag($tagName) {
        $this->processSearch('getAllByTag', $tagName);
    }

    // Search questions by question title.
    public function question($questionTitle) {
        $this->processSearch('getAllByQuestionTitle', $questionTitle);
    }

    // Search questions by answers content.
    public function answer($answerContent) {
        $this->processSearch('getAllByAnswerContent', $answerContent);
    }

    private function processSearch($questionsDaoFunction, $questionDaoArgument) {
        $this->questions = $this->questionsDao->$questionsDaoFunction($questionDaoArgument);
        $this->categories = $this->categoriesDao->getAll();
        $this->renderView('index', 'questions');
    }
}