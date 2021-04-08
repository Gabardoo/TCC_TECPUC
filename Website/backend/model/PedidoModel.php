<?php

require_once __DIR__ . "/../modules/base/BaseModel.php";


class PedidoModel extends BaseModel {
    public function insert(Request $request){
        $statement = "
            insert into pedido (idcliente, idstatuspedido, idformapagamento)
            values (:idcliente, :idstatuspedido, :idformapagamento)
        ";

        return $this->databaseHandler->executeQuery($statement, $request->getData());
    }


    public function list(Request $request){
        $statement = "
                select idcliente, idpedido, idstatuspedido, idformapagamento, ifnull(sum(valor_total_produto), 0) as valor_total, status_pedido from
	                (select idcliente, idpedido, idstatuspedido, idformapagamento, quantidade * preco as valor_total_produto, status_pedido from 
		                (select pedido.idcliente, pedido.idpedido, pedido.idstatuspedido, pedido.idformapagamento, itempedido.quantidade, item.preco, statuspedido.nome as status_pedido from
                         pedido inner join statuspedido on pedido.idstatuspedido = statuspedido.idstatuspedido left join 
                         itempedido on pedido.idpedido = itempedido.idpedido left join 
                         item on itempedido.iditem = item.iditem) as r) as s
                  where idcliente = :idcliente
                  group by idpedido
          ";

        return $this->databaseHandler->executeQuery($statement, $request->getData());
    }


    public function list_by_status(Request $request){
        $statement = "
                select idpedido, cpf from pedido left join cliente on
                pedido.idcliente = cliente.idcliente
                where idstatuspedido = :idstatuspedido;
          ";

        return $this->databaseHandler->executeQuery($statement, $request->getData());
    }


    public function list_itens_pedido(Request $request){
        $statement = "
                select itempedido.iditem, nome, itempedido.quantidade from
                pedido right join itempedido on
                pedido.idpedido = itempedido.idpedido
                right join item on
                itempedido.iditem = item.iditem
                where pedido.idpedido = :idpedido;
          ";

        return $this->databaseHandler->executeQuery($statement, $request->getData());
    }


    public function view(Request $request){
        $statement = "
                select idpedido, cpf from pedido left join cliente on
                pedido.idcliente = cliente.idcliente
                where idpedido = :idpedido;
          ";

        return $this->databaseHandler->executeQuery($statement, $request->getData());
    }


    public function view_item(Request $request){
        $statement = "
            select iditem, nome, preco, quantidade from item
            where iditem = :iditem;
        ";

        return $this->databaseHandler->executeQuery($statement, $request->getData());
    }


    public function edit(Request $request){
        $response = $this->view_item($request);

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
            update item set nome = :nome, quantidade = quantidade - :modificador, idcategoria = :idcategoria
            where iditem = :iditem;
        ";

        $response = $this->databaseHandler->executeQuery($statement, $request->getData());

        if($response->isSuccess()){
            $response = $this->view_item($request);
        }
        return $response;
    }


    public function edit_cart(Request $request){
        return $this->view_item($request);
    }


    public function edit_status(Request $request){
        $statement = "
            update pedido set idstatuspedido = :idstatuspedido where idpedido = :idpedido
        ";

        return $this->databaseHandler->executeQuery($statement, $request->getData());
    }
}