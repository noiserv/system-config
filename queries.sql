-- Query 1

  SELECT res.numProcessoSocorro FROM(
    SELECT * FROM (
        (SELECT Max(numacion.total) AS total FROM
  	 	     (SELECT numProcessoSocorro,COUNT(*) AS total FROM acciona GROUP BY numProcessoSocorro ) numacion
        )aciontotal
    NATURAL JOIN
        (SELECT numProcessoSocorro,COUNT(*) AS total FROM acciona GROUP BY numProcessoSocorro)nnumacion
    )maxi
  )res;


-- Query 2
  
    SELECT nomeEntidade FROM (
        SELECT instanteChamada, Max(cnt) AS cntmax FROM (
          SELECT instanteChamada, COUNT(instanteChamada) AS cnt  FROM (
            SELECT * FROM eventoEmergencia NATURAL JOIN acciona  WHERE instanteChamada BETWEEN '2018-06-01 00:00:00' AND '2018-09-23 01:54:00'
          ) AS a  GROUP BY instanteChamada)  AS numsTel GROUP BY instanteChamada
         ) as numTelFilt
        NATURAL JOIN EventoEmergencia NATURAL JOIN acciona NATURAL JOIN meio;

-- Query 3

  SELECT numProcessoSocorro FROM (
  SELECT numProcessoSocorro,numMeio FROM (
    SELECT numProcessoSocorro,numMeio FROM eventoEmergencia NATURAL JOIN acciona WHERE moradaLocal='Oliveira do Hospital' AND instanteChamada BETWEEN '2018-01-01 00:00:00' AND '2018-12-31 23:59:59'
  ) as evento
    EXCEPT (SELECT numProcessoSocorro,numMeio FROM audita)
  	) as res;

-- Query 4

SELECT COUNT(*) AS segmentos_video FROM segmentoVideo NATURAL JOIN video NATURAL JOIN vigia WHERE moradaLocal='Monchique' AND dataHoraInicio >='2018-08-01 00:00:00' AND dataHoraFim<='2018-08-31 23:59:59' AND duracao>'00:01:00';

-- Query 5

  SELECT nummeio, nomeentidade FROM (
  SELECT nummeio, nomeentidade FROM meioCombate
  ) as meiosCombate
  EXCEPT (SELECT nummeio, nomeentidade FROM meioApoio NATURAL JOIN acciona);

-- Query 6

SELECT nomeEntidade FROM (acciona NATURAL JOIN meioCombate)
	WHERE numProcessoSocorro IN(
 	SELECT numProcessoSocorro FROM acciona
		WHERE nomeEntidade NOT IN (
		SELECT nomeEntidade FROM meioCombate)) ;