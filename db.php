<?php
function opendb(){
    $link = mysqli_connect("localhost","root","") or die("Connection failure" . mysqli_error($link));
    mysqli_select_db($link,"hf");
    mysqli_query($link, "set character_set_results='utf-8'");
    return $link;
}
#inicializalja az adatbazist, ha meg nem letezik.
function init_db(){
    $link = mysqli_connect("localhost","root","") or die("Connection failure" . mysqli_error($link));
    mysqli_select_db($link,"hf");
    $statement = "#tabla az alap adatokhoz
    CREATE TABLE if not exists telefonkonyv_base(
        id int primary key auto_increment,
        nev varchar(100),
        szam varchar(100)
    );
    
    #itt kerul be a cim
    CREATE TABLE if not exists telefonkonyv_ext(
        cim varchar(200),
        telefonkonyv_base_id int NOT NULL,
        FOREIGN KEY (telefonkonyv_base_id) REFERENCES telefonkonyv_base(id)
    );
    
    #view a ket tabla miatt
    CREATE OR REPLACE VIEW telefonkonyv
    AS
    SELECT tb.id, tb.nev, tb.szam, cim 
    FROM telefonkonyv_base tb 
    LEFT OUTER JOIN telefonkonyv_ext te ON te.telefonkonyv_base_id = tb.id;
    
    DROP PROCEDURE IF EXISTS ADD_ENTRY;
    DROP PROCEDURE IF EXISTS DELETE_ENTRY;
    
    DELIMITER $$
    #procedura a ket tablas beszurashoz (view miatt)
    CREATE PROCEDURE ADD_ENTRY(IN Pnev varchar(100),IN Pszam varchar(100),IN Pcim varchar(200))
    BEGIN
    DECLARE temp_id INT DEFAULT 0;
    
    #ha megszakad a procedure akkor ezzel az error handlerrel rollbackel
    DECLARE EXIT HANDLER FOR SQLEXCEPTION 
        BEGIN
              ROLLBACK;
        END;
    
    #tranzakcioval lekezeljuk ha nem sikerul valami
    START TRANSACTION;
    SET autocommit = 0;
    INSERT INTO telefonkonyv_base(nev,szam) VALUES(Pnev, Pszam);
    SELECT id INTO temp_id FROM telefonkonyv_base tb WHERE nev=Pnev AND tb.szam=Pszam ;
    INSERT INTO telefonkonyv_ext(telefonkonyv_base_id,cim) VALUES(temp_id, Pcim);
    SET autocommit = 1;
    COMMIT;
    END$$
    
    #torleshez is letrehozunk proceduret mert ket tabla van
    CREATE PROCEDURE DELETE_ENTRY(IN Pid INT)
    BEGIN
    
    #ha megszakad a procdeure akkor ezzel az error handlerrel rollbackel
    DECLARE EXIT HANDLER FOR SQLEXCEPTION 
        BEGIN
              ROLLBACK;
        END;
    
    #tranzakcioval lekezeljuk ha nem sikerul valami
    START TRANSACTION;
    DELETE FROM telefonkonyv_ext WHERE telefonkonyv_base_id = Pid;
    DELETE FROM telefonkonyv_base WHERE id=Pid;
    COMMIT;
    END$$
    
    DELIMITER ;
    
    ";
    mysqli_query($link, $statement);
    mysqli_close($link);

}
?>