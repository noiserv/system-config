-- Camaras de Vigilancia
INSERT INTO camara VALUES ('0');
INSERT INTO camara VALUES ('1');
INSERT INTO camara VALUES ('2');

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


-- Segmentos de Video
INSERT INTO segmentoVideo VALUES ('0', '0', '2018-11-18 10:00:00');
  /* there seems to be kind of a designflaw here, because we can only have segments that
  match the exact time of a video and not inbetween videos FIXME */
