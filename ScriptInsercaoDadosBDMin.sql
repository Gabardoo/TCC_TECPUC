use sistemacontrolepedidos;

# Perfis de Usuario
insert into perfil values (1, "Cliente");
insert into perfil values (2, "Balconista");

# Status de Pedido
insert into statuspedido values (1, "Em Aberto");
insert into statuspedido values (2, "Aguardando Pagamento");
insert into statuspedido values (3, "Pagamento Confirmado");
insert into statuspedido values (4, "Pronto para Retirada");
insert into statuspedido values (5, "Retirado");
insert into statuspedido values (6, "Cancelado");

# Categorias
insert into categoria values (1, "Salgados");
insert into categoria values (2, "Doces");
insert into categoria values (3, "Bebidas");

# Usuarios do Perfil Balconista
insert into usuario values (1, "admin", "$2y$04$jcWOI/JnrtKE1uLsl0HjzO4YG0gFcuFVOxBdLkSR/nGYZo2raHnbC", 2);

# Usuarios do Perfil Cliente
insert into usuario values (2, "jgabardo", "$2y$04$LeD9YApp6zyuc4wksLTeeOdLqKlvLlE9zaiXbt.Tm4sVjFgkU5/mW", 1);
insert into usuario values (3, "asantos", "$2y$04$2yLvggfdpMgFRJLnw55GH.2jElhG/JbuiSS70tKsHHJAvgMD4Yrt.", 1);
insert into usuario values (4, "gdouglas", "$2y$04$tamTVg7rSWWLyRMfYu.ll.OEjMc8kkgOb2PHNpMhxgPnc1ullWvue", 1);

# Clientes
INSERT INTO `sistemacontrolepedidos`.`cliente` (`idCliente`, `cpf`, `nome`, `sobrenome`, `email`, `telefone`, `cep`, `logradouro`, `numero`, `complemento`, `idUsuario`) VALUES ('1', '123456789-01', 'André Felipe', 'Pereira dos Santos', 'andre.p@tecpuc.com.br', '4133333333', '12345678', 'Rua Iapo', '111', 'Casa', '3');
INSERT INTO `sistemacontrolepedidos`.`cliente` (`idCliente`, `cpf`, `nome`, `sobrenome`, `email`, `telefone`, `cep`, `logradouro`, `numero`, `complemento`, `idUsuario`) VALUES ('2', '234567890-12', 'Guilherme', 'Douglas Beitum', 'gdouglas@tecpuc.com.br', '4133333333', '12345678', 'Rua Iapo', '111', 'Casa', '4');
INSERT INTO `sistemacontrolepedidos`.`cliente` (`idCliente`, `cpf`, `nome`, `sobrenome`, `email`, `telefone`, `cep`, `logradouro`, `numero`, `complemento`, `idUsuario`) VALUES ('3', '345678901-23', 'João', 'Gabardo', 'jgabardo@tecpuc.com.br', '4133333333', '12345678', 'Rua Iapo', '111', 'Casa', '2');