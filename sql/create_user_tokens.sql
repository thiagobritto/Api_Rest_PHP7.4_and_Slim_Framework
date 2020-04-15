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