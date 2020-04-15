CREATE TABLE lojas(
	id INT(11) NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    endereco VARCHAR(200) NOT NULL,
    PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

CREATE TABLE produtos(
	id INT(11) NOT NULL AUTO_INCREMENT,
    id_loja INT(11) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    quantidade INT UNSIGNED NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_produtos_loja_id_loja_id
		FOREIGN KEY (id_loja) REFERENCES lojas(id)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

CREATE TABLE usuarios(
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(200) NOT NULL,
  email VARCHAR(200) UNIQUE NOT NULL,
  senha VARCHAR(200) NOT NULL,
  PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

CREATE TABLE tokens(
  id INT NOT NULL AUTO_INCREMENT,
  usuarios_id INT NOT NULL,
  token VARCHAR(1000) NOT NULL,
  refresh_token VARCHAR(1000) NOT NULL,
  expired_at DATETIME NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_token_usuarios_id_usuarios_id
	FOREIGN KEY (usuarios_id) REFERENCES usuarios(id) 
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

INSERT INTO lojas (
  nome, 
  telefone, 
  endereco
) VALUES (
  'bshoes', 
  '999999999', 
  'Rua RN'
);

INSERT INTO produtos (
  id_loja, 
  nome, 
  preco, 
  quantidade
) VALUES (
  1, 
  'teclado', 
  40.00, 
  20
);

INSERT INTO usuarios (
  nome,
  email,
  senha
) VALUES (
  'user1',
  'user1@gmail.com',
  'password_hash()'
);