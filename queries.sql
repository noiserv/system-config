-- Query 1
  -- Qual e o processo de socorro que envolveu maior número de meios distintos;

  -- PARECIDO A PERGUNTA 3 DO ENUNCIADO PASSADO


-- Query 2
  -- Qual a entidade fornecedora de meios que participou em mais processos de
  -- socorro no Verao de 2018;

  -- FIXME verificar isto
  SELECT moradalocal FROM (
  	SELECT numtelefone FROM (
  		SELECT numtelefone, COUNT(numtelefone) AS cnt  FROM (
  			SELECT * FROM eventoEmergencia NATURAL JOIN acciona
  		) AS a GROUP BY numtelefone) as numsTel
  	WHERE cnt >= 2 ) as numTelFilt
  	NATURAL JOIN EventoEmergencia



-- Query 3
  -- Quais sao os processos de socorro, referente a eventos de emergencia em 2018
  -- de Oliveira do Hospital, onde existe pelo menos um acionamento de meios que
  -- não foi alvo de auditoria;

  -- PARECIDO A PERGUNTA 5 DO ENUNCIADO PASSADO


-- Query 4
  -- Quantos segmentos de vídeo com duração superior a 60 segundos, foram gravados
  -- em câmeras de vigilância de Monchique durante o mês de Agosto de 2018;

  -- PARECIDO A PERGUNTA 6 DO ENUNCIADO PASSADO


-- Query 5
  -- Liste os Meios de combate que não foram usados como Meios de Apoio em nenhum
  -- processo de socorro;

  -- FIXME verificar isto
SELECT nummeio, nomeentidade FROM (
  SELECT nummeio, nomeentidade FROM meioCombate NATURAL JOIN meio
  ) as meiosCombate
  EXCEPT (SELECT nummeio, nomeentidade FROM meioCombate NATURAL JOIN meio NATURAL JOIN acciona)

  -- Liste as entidades que forneceram meios de combate a todos os Processos de
  -- socorro que acionaram meios;

  -- PARECIDO A PERGUNTA 8 DO ENUNCIADO PASSADO
