<?php

class HomeController extends BaseController {
    public function onInit() {
        $this->redirect("questions");
    }
}