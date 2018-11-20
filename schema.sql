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

CREATE TABLE zona (
    moradaLocal VARCHAR(255) unique,
    PRIMARY KEY(moradaLocal)
);

CREATE TABLE vigia (
  moradaLocal VARCHAR(255) NOT NULL, --tem de ser UNIQUE??
  camNum VARCHAR(255) ,
  PRIMARY KEY(moradaLocal,camNum),
  -- a camNUm e uma FUNCTION?
  FOREIGN KEY(moradaLocal) REFERENCES zona(moradaLocal) -- ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE processoSocorro (
    numProcessoSocorro NUMERIC(255) unique,
    PRIMARY KEY(numProcessoSocorro)
);

CREATE TABLE eventoEmergencia (
  nomePessoa VARCHAR(255) NOT NULL,
  moradaLocal VARCHAR(255) NOT NULL,
  numProcessoSocorro NUMERIC(255) , --e um varchar ou inteiro?
  numTelefone NUMERIC(255) unique,
  instanteChamada VARCHAR(255) unique,
  -- duration FIXME, -- defnir o formato
  PRIMARY KEY(numTelefone, nomePessoa),
  FOREIGN KEY(moradaLocal) REFERENCES zona(moradaLocal),
  FOREIGN KEY(numProcessoSocorro) REFERENCES processoSocorro(numProcessoSocorro)  ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE entidadeMeio (
    nomeEntidade VARCHAR(255) unique,
    PRIMARY KEY(nomeEntidade)
);

CREATE TABLE meio(
  numMeio NUMERIC(255) NOT NULL unique,
  nomeMeio VARCHAR(255) NOT NULL,
  nomeEntidade VARCHAR(255) NOT NULL,
  PRIMARY KEY(numMeio, nomeEntidade),
  FOREIGN KEY(nomeEntidade) REFERENCES entidadeMeio(nomeEntidade)
);

CREATE TABLE meioCombate(
  numMeio NUMERIC(255) NOT NULL,
  nomeEntidade VARCHAR(255) NOT NULL,
  PRIMARY KEY(numMeio, nomeEntidade),
  FOREIGN KEY(numMeio,nomeEntidade) REFERENCES meio(numMeio, nomeEntidade) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE meioApoio(
  numMeio NUMERIC(255) NOT NULL,
  nomeEntidade VARCHAR(255) NOT NULL,
  PRIMARY KEY(numMeio, nomeEntidade),
  FOREIGN KEY(numMeio,nomeEntidade) REFERENCES meio(numMeio, nomeEntidade) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE meioSocorro(
  numMeio NUMERIC(255) NOT NULL,
  nomeEntidade VARCHAR(255) NOT NULL,
  PRIMARY KEY(numMeio, nomeEntidade),
  FOREIGN KEY(numMeio,nomeEntidade) REFERENCES meio(numMeio, nomeEntidade) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE transporta(
  numMeio NUMERIC(255) NOT NULL,
  nomeEntidade VARCHAR(255) NOT NULL,
  numProcessoSocorro NUMERIC(255) ,
  numVitimas NUMERIC(255) NOT NULL,
  PRIMARY KEY(numMeio, nomeEntidade,numProcessoSocorro),
  FOREIGN KEY(numProcessoSocorro) REFERENCES processoSocorro(numProcessoSocorro),
  FOREIGN KEY(numMeio,nomeEntidade) REFERENCES meioSocorro(numMeio, nomeEntidade)
);

CREATE TABLE alocado(
  numMeio NUMERIC(255) NOT NULL,
  nomeEntidade VARCHAR(255) NOT NULL,
  numProcessoSocorro NUMERIC(255) ,
  numHoras NUMERIC(255) NOT NULL,
  PRIMARY KEY(numMeio, nomeEntidade,numProcessoSocorro),
  FOREIGN KEY(numProcessoSocorro) REFERENCES processoSocorro(numProcessoSocorro),
  FOREIGN KEY(numMeio,nomeEntidade) REFERENCES meioApoio(numMeio, nomeEntidade)
);

CREATE TABLE acciona(
  numMeio NUMERIC(255) NOT NULL,
  nomeEntidade VARCHAR(255) NOT NULL,
  numProcessoSocorro NUMERIC(255) ,
  PRIMARY KEY(numMeio, nomeEntidade,numProcessoSocorro),
  FOREIGN KEY(numProcessoSocorro) REFERENCES processoSocorro(numProcessoSocorro),
  FOREIGN KEY(numMeio,nomeEntidade) REFERENCES meio(numMeio, nomeEntidade)
);

CREATE TABLE coordenador (
    idCoordenador NUMERIC(255) NOT NULL unique,
    PRIMARY KEY(idCoordenador)
);

CREATE TABLE audita(
  idCoordenador NUMERIC(255) NOT NULL ,
  numMeio NUMERIC(255) NOT NULL,
  nomeEntidade VARCHAR(255) NOT NULL,
  numProcessoSocorro NUMERIC(255) ,
  datahoraInicio timestamp NOT NULL,
  datahoraFim timestamp NOT NULL,
  PRIMARY KEY(idCoordenador, numMeio, nomeEntidade,numProcessoSocorro),
  FOREIGN KEY(idCoordenador) REFERENCES coordenador(idCoordenador),
  FOREIGN KEY(numMeio,nomeEntidade,numProcessoSocorro) REFERENCES acciona(numMeio, nomeEntidade,numProcessoSocorro)
);

CREATE TABLE solicita(
    idCoordenador NUMERIC(255) NOT NULL ,
    dataHoraInicioVideo TIMESTAMP NOT NULL,
    camNum VARCHAR(255) NOT NULL,
    dataHoraInicio TIMESTAMP NOT NULL,
    dataHoraFim TIMESTAMP NOT NULL,
    PRIMARY KEY(idCoordenador,dataHoraInicioVideo,camNum),
    FOREIGN KEY(idCoordenador) REFERENCES coordenador(idCoordenador),
    FOREIGN KEY(dataHoraInicioVideo,camNum) REFERENCES video(dataHoraInicio,camNum)
);
