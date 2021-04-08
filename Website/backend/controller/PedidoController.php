<?php

require_once __DIR__ . "/../modules/base/BaseController.php";


class PedidoController extends BaseController {
    public function insert(Request $request){
        $fieldRules = [
            "idcliente" => ["required", "type:integer", "min:0"],
            "idstatuspedido" => ["required", "type:integer", "min:0"],
            "idformapagamento" => ["required", "type:integer", "min:0"],
        ];

        $response = $request->validateRequestData($fieldRules);

        if($response->isSuccess()){
            $request->setData('idstatuspedido', 2);
            $response = $this->redirect($request, $this->model);
        }
        return $response;
    }


    public function delete(Request $request){
        $fieldRules = [
            "idpedido" => ["required", "type:integer", "min:0"],
        ];

        $response = $request->validateRequestData($fieldRules);

        if($response->isSuccess()){
            $request->setData('idstatuspedido', 6);
            $response = $this->redirect($request, $this->model);
        }
        return $response;
    }


    public function delete_from_cart(Request $request){
        $fieldRules = [
            "iditem" => ["required", "type:integer", "min:0"],
        ];

        $response = $request->validateRequestData($fieldRules);

        if($response->isSuccess()){
            $response = $this->cart->delete($request, 'iditem');
        }
        return $response;
    }


    public function list(Request $request){
        $request->setData('idcliente', $_SESSION['idcliente']);
        return $this->redirect($request, $this->model);
    }


    public function list_by_status(Request $request){
        $request->setData('idstatuspedido', 4);
        return $this->redirect($request, $this->model);
    }


    public function list_cart(Request $request){
        return $this->cart->list();
    }


    public function list_itens_pedido(Request $request){
        return $this->redirect($request, $this->model);
    }


    public function view(Request $request){
        return $this->redirect($request, $this->model);
    }


    public function edit_status(Request $request){
        $fieldRules = [
            "idpedido" => ["required", "type:integer", "min:0"],
            "cpf" => ["required", "type:integer"],
        ];

        $response = $request->validateRequestData($fieldRules);

        if($response->isSuccess()){

            $_GET['action'] = 'view';
            $request2 = new Request("sync");

            $response = $this->view($request2);

            $cpf_inserido = $request->getData('cpf');
            $cpf_cadastro = $response->getData('cpf');

            if($cpf_inserido == $cpf_cadastro){

                $request->setData('idstatuspedido', 5);
                $response = $this->redirect($request, $this->model);

                if(!$response->isSuccess()){
                    header('Location: confirmar_retirada.php');
                }
            }
            else{
                $response->setResponseContent('INVALID_REQUEST_DATA', ['cpf'], []);
                header('Location: confirmar_retirada.php');
            }
        }
        return $response;
    }


    public function edit_cart(Request $request){
        $fieldRules = [
            "iditem" => ["required", "type:integer", "min:0"],
            "quantidade" => ["required", "type:integer", "min:0"],
        ];

        $response = $request->validateRequestData($fieldRules);

        if($response->isSuccess()){
            $response = $this->redirect($request, $this->model);
            $response = $this->cart->edit($request, $response, 'iditem', 'quantidade');
        }
        return $response;
    }
}