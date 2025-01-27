DELIMITER //

CREATE PROCEDURE migracao(
    IN dominio VARCHAR(255),
    IN dominio_novo VARCHAR(255),
    IN banco VARCHAR(255)
)
BEGIN
  DECLARE done INT DEFAULT FALSE;
  DECLARE logs TEXT DEFAULT '';
  DECLARE tabela_nome VARCHAR(255);
  DECLARE coluna_nome VARCHAR(255);

  DECLARE cursorColunas CURSOR FOR 
    SELECT COLUMN_NAME, TABLE_NAME FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = banco
      AND DATA_TYPE IN ('char', 'varchar', 'text', 'tinytext', 'mediumtext', 'longtext');

  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

  OPEN cursorColunas;

  -- Loop para percorrer os dados do cursor
  COLUNAS_LOOP: LOOP
    FETCH cursorColunas INTO coluna_nome, tabela_nome;
    IF done THEN
      LEAVE COLUNAS_LOOP;
    END IF;

    SET qntd = qntd + 1;
    SET logs = CONCAT(logs, tabela_nome, '\n');

    SET @sql = CONCAT(
      'UPDATE ', tabela_nome,
      ' SET ', coluna_nome, ' = REPLACE(CONVERT(', coluna_nome, ' USING utf8mb4),',
      ' CONVERT("', dominio, '" USING utf8mb4),',
      ' CONVERT("', dominio_novo, '" USING utf8mb4))'
    );

    BEGIN
      DECLARE CONTINUE HANDLER FOR SQLEXCEPTION   
      BEGIN 
        SET logs = CONCAT(logs, 'Erro na tabela: ', tabela_nome, ', coluna: ', coluna_nome, '\n');
      END; 
      PREPARE stmt FROM @sql;
      EXECUTE stmt;
      DEALLOCATE PREPARE stmt;
    END;

  END LOOP;
  CLOSE cursorColunas;

  SELECT logs AS LOGS;
END //

DELIMITER ;

CALL migracao('testes.com.br', 'test2.com.br', DATABASE());
DROP PROCEDURE IF EXISTS migracao;
