<?php

require_once __DIR__ . "/../modules/base/BaseController.php";


class ProdutoController extends BaseController {
    public function insert(Request $request){
        $fieldRules = [
            "nome" => ["required", "max:45", "type:text"],
            "preco" => ["required", "type:money"],
            "quantidade" => ["required", "type:integer", "min:0"],
            "idcategoria" => ["required", "type:integer"],
        ];

        $response = $request->validateRequestData($fieldRules);

        if($response->isSuccess()){
            $response = $this->redirect($request, $this->model);
        }
        return $response;
    }


    public function delete(Request $request){
        $fieldRules = [
            "iditem" => ["required", "type:integer", "min:0"]
        ];

        $response = $request->validateRequestData($fieldRules);

        if($response->isSuccess()){
            $response = $this->redirect($request, $this->model);
        }
        return $response;
    }


    public function list(Request $request){
        $response = $this->redirect($request, $this->model);
        return $response;
    }


    public function view(Request $request){
        $fieldRules = [
            "iditem" => ["required", "type:integer", "min:0"]
        ];

        $response = $request->validateRequestData($fieldRules);

        if($response->isSuccess()){
            $response = $this->redirect($request, $this->model);
        }

        return $response;
    }


    public function edit(Request $request){
        $fieldRules = [
            "nome" => ["required", "max:45", "type:text"],
            "preco" => ["required", "type:money"],
            "modificador" => ["required", "type:integer"],
            "idcategoria" => ["required", "type:text"],
            "iditem" => ["required", "type:integer", "min:0"],
        ];

        $response = $request->validateRequestData($fieldRules);

        if($response->isSuccess()){
            $response = $this->redirect($request, $this->model);
        }
        return $response;
    }
}