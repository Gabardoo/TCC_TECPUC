<?php

require_once __DIR__ . "/../modules/base/BaseModel.php";


class UsuarioModel extends BaseModel {
    public function login(Request $request){
        $statement = "
            select usuario.idusuario, idperfil, idcliente, senha from 
            usuario left join cliente on usuario.idusuario = cliente.idusuario 
            where login = :login
        ";

        return $this->databaseHandler->executeQuery($statement, $request->getData());
    }


    public function insert(Request $request){
        $statement = "
            insert into usuario (idperfil, login, senha) values (1, :login, :senha)
        ";

        $response = $this->databaseHandler->executeQuery($statement, $request->getData());

        if(!$response->isSuccess()){
            return $response;
        }

        $idusuario = $this->databaseHandler->getLastInsertedKey();
        $statement = "
            insert into cliente (idusuario, cpf, nome, sobrenome, email, telefone, cep, logradouro, numero, complemento) 
            values ($idusuario, :cpf, :nome, :sobrenome, :email, :telefone, :cep, :logradouro, :numero, :complemento)
        ";

        return $this->databaseHandler->executeQuery($statement, $request->getData());
    }


    public function delete(Request $request){
        $statement = "
            delete from usuario where idusuario = :idusuario
        ";

        return $this->databaseHandler->executeQuery($statement, $request->getData());
    }


    public function view(Request $request){
        $statement = "
            select email, telefone, cep, logradouro, numero, complemento from cliente 
            where idcliente = :idcliente
        ";
        return $this->databaseHandler->executeQuery($statement, $request->getData());
    }


    public function edit(Request $request){
        $statement = "
            update cliente set 
            email = :email, 
            telefone = :telefone, 
            cep = :cep, 
            logradouro = :logradouro, 
            numero = :numero, 
            complemento = :complemento
            where idcliente = :idcliente
        ";

        $response = $this->databaseHandler->executeQuery($statement, $request->getData());

        if(!$response->isSuccess()){
            return $response;
        }

        $statement = "
            update usuario set 
            senha = case when :senha = '' then senha else :senha end
            where idusuario = :idusuario
        ";

        $response = $this->databaseHandler->executeQuery($statement, $request->getData());

        if(!$response->isSuccess()){
            return $response;
        }

        return $this->view($request);
    }
}