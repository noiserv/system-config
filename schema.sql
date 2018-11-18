DROP TABLE IF EXISTS camara cascade;
DROP TABLE IF EXISTS video cascade;
DROP TABLE IF EXISTS segmentoVideo cascade;

CREATE TABLE camara (
    camNum VARCHAR(255) unique,
    PRIMARY KEY(camNum)
);

CREATE TABLE video (
    camNum VARCHAR(255) NOT NULL, -- duvida? isto nao tem que ser unique FIXME
    dataHoraInicio timestamp NOT NULL,
    dataHoraFim timestamp NOT NULL,
    PRIMARY KEY(camNum, dataHoraInicio),
    FOREIGN KEY(camNum) REFERENCES camara(camNum) ON DELETE CASCADE ON UPDATE CASCADE -- perceber isto FIXME
);

CREATE TABLE segmentoVideo (
  camNum VARCHAR(255) unique,
  segmentNum VARCHAR(255) unique,
  dataHoraInicio timestamp NOT NULL unique,
  -- duration FIXME, -- defnir o formato
  PRIMARY KEY(camNum, dataHoraInicio, segmentNum),
  FOREIGN KEY(camNum,dataHoraInicio) REFERENCES video(camNum, dataHoraInicio) ON DELETE CASCADE ON UPDATE CASCADE
);
