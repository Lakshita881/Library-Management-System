<?php

App::uses('AppController', 'Controller');

class HelloController extends AppController {

    public function index() {
        $message = "Hello, CakePHP!";
        $this->set('message', $message);
    }

}
