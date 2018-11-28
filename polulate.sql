-- Camaras de Vigilancia
INSERT INTO camara VALUES ('0');
INSERT INTO camara VALUES ('1');
INSERT INTO camara VALUES ('2');
INSERT INTO camara VALUES ('3');

-- video
INSERT INTO video VALUES ('0', '2018-11-18 10:00:00', '2018-11-18 10:59:59');
INSERT INTO video VALUES ('0', '2018-11-18 11:00:00', '2018-11-18 11:59:59');
INSERT INTO video VALUES ('0', '2018-11-18 12:00:00', '2018-11-18 12:59:59');

INSERT INTO video VALUES ('1', '2018-11-18 10:00:00', '2018-11-18 10:59:59');
INSERT INTO video VALUES ('1', '2018-11-18 11:00:00', '2018-11-18 11:59:59');
INSERT INTO video VALUES ('1', '2018-11-18 12:00:00', '2018-11-18 12:59:59');

INSERT INTO video VALUES ('2', '2018-11-18 10:00:00', '2018-11-18 10:59:59');
INSERT INTO video VALUES ('2', '2018-11-18 11:00:00', '2018-11-18 11:59:59');
INSERT INTO video VALUES ('2', '2018-11-18 12:00:00', '2018-11-18 12:59:59');
INSERT INTO video VALUES ('2', '2018-08-01 00:00:00', '2018-08-31 23:59:59');
INSERT INTO video VALUES ('3', '2018-08-02 00:00:00', '2018-08-31 23:59:59');


-- Segmentos de Video
INSERT INTO segmentoVideo VALUES ('0', '0', '2018-11-18 10:00:00','00:00:50');
INSERT INTO segmentoVideo VALUES ('2', '2', '2018-08-01 00:00:00', '00:01:00');
INSERT INTO segmentoVideo VALUES ('3', '3', '2018-08-02 00:00:00', '00:01:00');
  /* there seems to be kind of a designflaw here, because we can only have segments that
  match the exact time of a video and not inbetween videos FIXME */
--INSERT INTO segmentoVideo VALUES ('0', '0', '2018-11-18 10:00:00','00:00:50');

INSERT INTO zona VALUES ('Rua Joao Chagas 12,Lisboa');
INSERT INTO zona VALUES('Rua Alves Redol 2,Lisboa');
INSERT INTO zona VALUES ('Rua das Caracoletas, Lisboa');
INSERT INTO zona VALUES ('Rua Joao CShagas 12, Lisboa');
INSERT INTO zona VALUES ('Rua das Nikolettas 1Dto, Lisboa');
INSERT INTO zona VALUES ('Monchique');

INSERT INTO vigia VALUES('Rua Alves Redol 2,Lisboa','0');
INSERT INTO vigia VALUES ('Rua Joao Chagas 12,Lisboa','1');
INSERT INTO vigia VALUES ('Monchique','2');
INSERT INTO vigia VALUES ('Monchique','3');


--INSERT INTO processoSocorro VALUES ('') como por NULL no numProcesso?
INSERT INTO processoSocorro VALUES ('0');
INSERT INTO processoSocorro VALUES ('1');

INSERT INTO eventoEmergencia VALUES ('MARIA DUARTE','Rua Joao Chagas 12,Lisboa','0','926678868','2018-11-18 10:00:00');
INSERT INTO eventoEmergencia VALUES ('PEDRO','Rua das Caracoletas, Lisboa',NULL,'926679868','2018-10-19 10:00:00');
INSERT INTO eventoEmergencia VALUES ('Soraia','Rua Joao CShagas 12, Lisboa',NULL,'926670868','2018-12-18 10:00:00');
INSERT INTO eventoEmergencia VALUES ('Nika','Rua das Nikolettas 1Dto, Lisboa',NULL,'921552918','2018-11-18 20:00:00');

INSERT INTO entidadeMeio VALUES ('primeiro');
INSERT INTO entidadeMeio VALUES ('segundo');
INSERT INTO entidadeMeio VALUES ('terceiro');
INSERT INTO entidadeMeio VALUES ('quarto');
INSERT INTO entidadeMeio VALUES ('quinto');

INSERT INTO meio VALUES ('0','red','primeiro');
INSERT INTO meio VALUES ('1','blue','segundo');
INSERT INTO meio VALUES ('2','geen','terceiro');
INSERT INTO meio VALUES ('3','black','quarto');

INSERT INTO meioCombate VALUES ('3','quarto');
INSERT INTO meioCombate VALUES ('0','primeiro');
INSERT INTO meioApoio VALUES ('2','terceiro');
INSERT INTO meioSocorro VALUES ('1','segundo');

INSERT INTO transporta VALUES ('1','segundo','0','7');

INSERT INTO alocado VALUES ('2','terceiro','1','12');

INSERT INTO acciona VALUES ('0','primeiro','1');
INSERT INTO acciona VALUES ('2','terceiro','1');
INSERT INTO acciona VALUES ('1','segundo','0');


INSERT INTO coordenador VALUES ('0');
INSERT INTO coordenador VALUES ('1');

INSERT INTO audita VALUES ('0','0','primeiro','1','2018-12-20 10:00:00', '2018-12-20 22:00:00', '2018-12-20 09:00:00','quero auditar');

INSERT INTO solicita VALUES ('0','2018-11-18 10:00:00','0','2018-11-21 10:00:00','2018-11-22 10:00:00');


-- EDGE CASES

-- Edge case for query 5
INSERT INTO meio VALUES ('666','useless','quarto');
<<<<<<< HEAD
INSERT INTO meioCombate VALUES ('666','quarto');
-- For query 6
INSERT INTO processoSocorro VALUES ('2');
INSERT INTO acciona VALUES ('666','quarto','2');
INSERT INTO entidadeMeio VALUES('seis');
INSERT INTO meio VALUES ('55','now','seis');
INSERT INTO acciona VALUES ('55','seis','2');


=======
INSERT INTO meioCombate VALUES ('666','quarto')
>>>>>>> d4130e3fd3e4f81fe31e0ce32b22faaa1f25a437
