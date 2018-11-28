-- Query 1
  -- Qual e o processo de socorro que envolveu maior número de meios distintos;

  SELECT e.numProcessoSocorro FROM(
    SELECT * FROM (
        (SELECT Max(a.total) AS total FROM
  	 	     (SELECT numProcessoSocorro,COUNT(*) AS total FROM acciona GROUP BY numProcessoSocorro )a --tabela a= num processo e o numero de meios distintos que o processo correspondente acionou
        )b --tabela b= maximo valor de meios distitntos de um processo
    NATURAL JOIN
        (SELECT numProcessoSocorro,COUNT(*) AS total FROM acciona GROUP BY numProcessoSocorro)c--tabela c==a-- nao consegui ir buscar a a
    )d--tabela d= contem o valor max e o processo correspondente
  )e;--tabela e=contem o numero do processo com mais meios distintos

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

SELECT numProcessoSocorro FROM (
  SELECT numProcessoSocorro FROM eventoEmergencia NATURAL JOIN acciona WHERE moradaLocal='Oliveira do Hospital' AND instanteChamada BETWEEN '2018-01-01 00:00:00' AND '2018-12-31 23:59:59'
) as evento
  EXCEPT(SELECT numProcessoSocorro FROM audita);

-- Query 4
  -- Quantos segmentos de vídeo com duração superior a 60 segundos, foram gravados
  -- em câmeras de vigilância de Monchique durante o mês de Agosto de 2018;

SELECT COUNT(*) AS segmentos_video FROM segmentoVideo NATURAL JOIN video NATURAL JOIN vigia WHERE moradaLocal='Monchique' AND dataHoraInicio >='2018-08-01 00:00:00' AND dataHoraFim<='2018-08-31 23:59:59' AND duracao='00:01:00';

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

-- Query 6
  --Liste as entidades que forneceram meios de combate a todos os Processos de socorro que acionaram meios;
  --Vi pelos slides mas ainda nao esta correto

SELECT nomeEntidade FROM (acciona NATURAL JOIN meioCombate)
	WHERE numProcessoSocorro IN(
 	SELECT numProcessoSocorro FROM acciona
		WHERE nomeEntidade NOT IN (
		SELECT nomeEntidade FROM meioCombate)) ;
	/*
EXCEPT
SELECT nomeEntidade FROM (acciona NATURAL JOIN meioCombate) ma WHERE ma.numProcessoSocorro=a.numProcessoSocorro);*/
