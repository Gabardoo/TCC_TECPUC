<?php

require_once "BaseComponent.php";

require_once __DIR__ . '/../controller/modules/Auth.php';
require_once __DIR__ . '/../controller/modules/Cart.php';


abstract class BaseController extends BaseComponent {
    protected $model;

    protected $auth;
    protected $cart;

    public function __construct($name) {
        $this->model = $this->getComponent($name, "Model");
        $this->auth = new Auth();
        $this->cart = new Cart();
    }

    public function commit(){
        $this->model->do_commit();
    }
}