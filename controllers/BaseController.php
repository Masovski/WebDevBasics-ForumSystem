<?php
abstract class BaseController {
    protected $controllerName;
    protected $actionName;
    protected $title;
    protected $layoutName = DEFAULT_LAYOUT;
    protected $isViewRendered = false;
    protected $isPost = false;

    function __construct($controllerName, $actionName) {
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->isPost = true;
        }

        $this->onInit();
    }

    public function onInit() {
        // Implement init logic in the subclasses
    }

    public function index() {
        // Implement the default action in the subclasses
    }

    public function renderView($viewName = null, $includeLayout = true) {
        if (!$this->isViewRendered) {
            if ($viewName == null) {
                $viewName = $this->actionName;
            }
            $viewFileName = 'views/' . $this->controllerName . '/' . $viewName . '.php';
            if ($includeLayout) {
                $headerViewFile = 'views/layouts/' . $this->layoutName . '/header.php';

                include_once($headerViewFile);
            }
            include_once($viewFileName);
            if ($includeLayout) {
                $footerViewFile = 'views/layouts/' . $this->layoutName . '/footer.php';
                include_once($footerViewFile);
            }
            $this->isViewRendered = true;
        }
    }

    public function redirectToUrl($url) {
        header("Location: " . $url);
        die;
    }

    public function redirect($controllerName, $actionName = null, $params = null) {
        $url = '/' . urlencode($controllerName);
        if ($actionName != null) {
            $url .= '/' . urlencode($actionName);
        }
        if ($params != null) {
            $encodedParams = array_map('urlencode', $params);
            $url .= '/' . implode('/', $encodedParams);
        }
        $this->redirectToUrl($url);
    }

    public function addMessage($msg, $type) {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = array();
        }
        array_push($_SESSION['messages'], array('text' => $msg, 'type' => $type));
    }

    function showMessages() {
        // TODO: Implement later using noty.
    }

    function addInfoMessage($msg) {
        $this->addMessage($msg, 'info');
    }

    function addErrorMessage($msg) {
        $this->addMessage($msg, 'error');
    }

    function addSuccessMessage($msg) {
        $this->addMessage($msg, 'success');
    }
}