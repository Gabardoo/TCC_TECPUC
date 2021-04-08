<?php

require_once __DIR__ . "/../modules/base/BaseController.php";


class UsuarioController extends BaseController {
    public function login(Request $request){
        $fieldRules = [
            "login" => ["required", "max:45", "type:text"],
            "senha" => ["required", "max:255", "type:text"],
        ];

        $response = $request->validateRequestData($fieldRules);

        if($response->isSuccess()){

            $response = $this->redirect($request, $this->model);
            $response = $this->auth->login($request, $response, 'senha');

            if($response->isSuccess()){
                header('Location: /public/main.php');
                exit;
            }
        }
        return $response;
    }


    public function verify_auth(Request $request){
        $response = new Response();
        if(!$request->isValidAuth() || !$request->isValidProfile()){
            header('Location: /public/index.php');
            exit;
        }
        else {
            $response->setResponseContent('SUCCESS');
        }
        return $response;
    }


    public function logout(Request $request){
        $response = $this->auth->logout();
        if($response->isSuccess()){
            header('Location: /public/index.php');
            exit;
        }
    }


    public function insert(Request $request){
        $fieldRules = [
            "login" => ["required", "max:45", "type:text"],
            "senha" => ["required", "max:255", "type:text"],
            "nome" => ["required", "max:45", "type:text"],
            "sobrenome" => ["required", "max:45", "type:text"],
            "cpf" => ["required", "type:integer"],
            "telefone" => ["required", "max:90", "type:text"],
            "email" => ["required", "max:90", "type:text"],
            "cep" => ["required", "max:45", "type:text"],
            "logradouro" => ["required", "max:45", "type:text"],
            "numero" => ["required", "type:integer"],
            "complemento" => ["required", "max:45", "type:text"],
        ];

        $response = $request->validateRequestData($fieldRules);

        if($response->isSuccess()){

            $senha = $request->toHash('data', 'senha');
            $request->setData('senha', $senha);

            $response = $this->redirect($request, $this->model);
        }
        else{
            $response->setResponseContent(null, null, $request->getData());
        }
        return $response;
    }


    public function delete(Request $request){
        $request->setData('idcliente', $_SESSION['idcliente']);
        $response = $this->redirect($request, $this->model);

        if($response->isSuccess()){
            $this->logout($request);
            header('Location: /public/index.php');
            exit;
        }
        return $response;
    }


    public function view(Request $request){
        $request->setData('idcliente', $_SESSION['idcliente']);
        $response = $this->redirect($request, $this->model);
        return $response;
    }


    public function edit(Request $request){
        $fieldRules = [
            "senha" => ["max:255", "type:text"],
            "telefone" => ["required", "max:90", "type:text"],
            "email" => ["required", "max:90", "type:text"],
            "cep" => ["required", "max:45", "type:text"],
            "logradouro" => ["required", "max:45", "type:text"],
            "numero" => ["required", "type:integer"],
            "complemento" => ["required", "max:45", "type:text"],
        ];

        $response = $request->validateRequestData($fieldRules);

        if($response->isSuccess()){
            if(!empty($request->getData('senha'))){
                $senha = $request->toHash('data', 'senha');
                $request->setData('senha', $senha);
            }

            $request->setData('idcliente', $_SESSION['idcliente']);
            $request->setData('idusuario', $_SESSION['idusuario']);

            $response = $this->redirect($request, $this->model);
        }
        else{
            $response->setResponseContent(null, null, $request->getData());
        }
        return $response;
    }
}