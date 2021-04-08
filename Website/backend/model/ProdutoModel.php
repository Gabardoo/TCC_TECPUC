<?php

require_once __DIR__ . "/../modules/base/BaseModel.php";


class ProdutoModel extends BaseModel {
    public function insert(Request $request){
        $statement = "
            insert into item (nome, preco, quantidade, idcategoria)
            values (:nome, :preco, :quantidade, :idcategoria)
        ";

        return $this->databaseHandler->executeQuery($statement, $request->getData());
    }


    public function delete(Request $request){
        $statement = "
            delete from item where iditem = :iditem
        ";

        $response = $this->databaseHandler->executeQuery($statement, $request->getData());

        if(!$response->isSuccess()){
            return $response;
        }
        return $this->list($request);
    }


    public function list(Request $request){
        $statement = "
            select iditem, nome, quantidade, preco from item
        ";

        return $this->databaseHandler->executeQuery($statement, $request->getData());
    }


    public function view(Request $request){
        $statement = "
            select iditem, nome, quantidade, preco, idcategoria from item where iditem = :iditem
        ";

        return $this->databaseHandler->executeQuery($statement, $request->getData());
    }


    public function edit(Request $request){
        $response = $this->view($request);

        if(!$response->isSuccess()){
            return $response;
        }

        $quantidade = $response->getData('quantidade');
        $modificador = $request->getData('modificador');

        if($quantidade + $modificador < 0){
            $response->setResponseContent('INVALID_REQUEST_DATA', ['modificador']);
            return $response;
        }

        $statement = "
            update item set nome = :nome, preco = :preco, quantidade = quantidade + :modificador, idcategoria = :idcategoria
            where iditem = :iditem;
        ";
        return $this->databaseHandler->executeQuery($statement, $request->getData());
    }
}