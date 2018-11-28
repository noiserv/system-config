#!/usr/bin/env python
# with open("populate.sql","w") as f:
import random, datetime
""" it can either accept
        - function  -- random() for example\n
        - file      -- containing an entry per line
        """
#def populate_sql():

def populate_camara():
    for i in range(0,100):
        print("INSERT INTO camara VALUES ('%d') " % (i))

def populate_video():
    """ videos de hora em hora para 5 camaras"""
    # em monchique agosto 2018-08-12 10:00:00 -> 2018-08-13 15:59:59
    populate_video_aux(45, datetime.datetime(2018, 8, 12, 10,0,0), 30)

    # Largo do Carmo, agosto 2018-08-12 10:00:00 ->
    populate_video_aux(5, datetime.datetime(2018, 8, 12, 10,0,0), 10)

    # Campo Pequeno, agosto 2018-08-12 09:00:00 ->
    populate_video_aux(19, datetime.datetime(2018, 8, 12, 9,0,0), 10)

    # Campo dos Martires da Patria, agosto 2018-08-11 09:00:00 ->
    populate_video_aux(43, datetime.datetime(2018, 8, 11, 9,0,0), 30)

    # Campo Grande, agosto 2018-08-11 09:00:00 ->
    populate_video_aux(94, datetime.datetime(2018, 8, 11, 9,0,0), 50)


def populate_video_aux(cam_num, begin_time, n):
    """ generates n hourly videos for the specified time """
    date  = begin_time
    hour  = datetime.timedelta(hours=1)
    end   = datetime.timedelta(minutes=59, seconds=59)
    for i in range(0,n):
        print("INSERT INTO video VALUES ('%d','%s','%s')" % (cam_num, date, date+end))
        date += hour


def populate_segmentoVideo():
    """ we have video segements """

    # monchique 45 30 segmentos
    begin_time = datetime.datetime(2018, 8, 12, 10,0,0)
    end_time   = datetime.datetime(2018, 8, 12, 11,0,0)
    split_into_segments(12, 60, begin_time, end_time)

    # largo carmo 5 40 segmentos
    begin_time = datetime.datetime(2018, 8, 12, 10,0,0)
    end_time   = datetime.datetime(2018, 8, 12, 10,30,0)
    split_into_segments(5, 30, begin_time, end_time)

def split_into_segments(cam_num, n, begin_time, end_time):
    """ we split a video into n segments from a given time till a given end time, the segments have a variable length """

    # average time of each segment
    delta = (end_time - begin_time) / n
    print("delta. %s" % (delta))
    cumulative_time = begin_time

    while cumulative_time < end_time:
        # segment time = delta +- 20s
        duration = delta + datetime.timedelta(seconds=int (random.uniform(-20,20)))
        print("INSERT INTO segmentoVideo VALUES ('%s','%s','%s', '%s')" %  (cam_num,str(cumulative_time),str(cumulative_time+ duration), duration))

        cumulative_time += duration






def populate_zona():
    for morada in moradas:
        print("INSERT INTO zona VALUES ('%s');" % (morada))

def populate_vigia():
    """ cameras numbered from 0 to 99
        cameras assigned to random zones
        some zones are not watched
        some zones are watched by many cameras  """
    for i in range(0,100):
        print("INSERT INTO vigia VALUES ('%s', '%s');" % (i, random.choice(moradas)))

def populate_processoSocorro():
    """ processos de socorro numerados de 0 a 99 """
    for i in range(0,100):
        print("INSERT INTO processoSocorro VALUES ('%d'); " % (i))

def populate_eventoEmergencia():
    """ nome, morada e telefone da linha j do respetivo ficheiro para garantir
    que cada pessoa tem esses dados

    uma pessoa pode ligar varias vezes para criar eventos de emergencia

    eventos de emergencia ficam associados a processos de socorro em 75% das vezes
    c.c. fica a NULL """
    for i in range(0,100):
        j = random.randint(0,99)
        print("INSERT INTO eventoEmergencia VALUES ('%s','%s',%s,'%s','%s')" % \
         (nomes[j],moradas[j],str(random.choice(["NULL",i,i,i])),phones[j][:-1], "instnatechamada"))


def populate_entidadeMeio():
    """ nome da entidade vem da lista de nomes de entidades """
    for i in range(0,100):
        print("INSERT INTO entidadeMeio VALUES ('%s')" % (entidades[i]))

def populate_meio():
    """ numMeio de 0 a 99
        nomeMeio vem da lista de nomesMeios
        entidades vem da lista de entidade """
    for i in range(0,100):
        print("INSERT INTO meio VALUES ('%s','%s','%s')" % (i, nomesMeios[i], entidades[i]))

        # Choose the type of meio that it is
        if (i%3==0):
            print("INSERT INTO meioCombate VALUES ('%s','%s')" % (i, nomesMeios[i]))

        if (i%3==1):
            print("INSERT INTO meioApoio VALUES ('%s','%s')" % (i, nomesMeios[i]))

        if (i%3==2):
            print("INSERT INTO meioSocorro VALUES ('%s','%s')" % (i, nomesMeios[i]))

def populate_transporta():
    """ todos os meios de Socorro sao alocados por uma entidade qualquer e
    com um numero de vitimas entre 0 e 5 """
    for i in range(0,100):
        if (i%3==2): # se for meio Socorro
            print("INSERT INTO transporta VALUES ('%s','%s','%s','%s')" % (i, entidades[i], random.randint(0,5), random.randint(0,99)))

def populate_alocado():
    """ todos os meios de Apoio sao alocados por uma entidade qualquer """
    for i in range(0,100):
        if (i%3==1): # se for meio Apoio
            print("INSERT INTO alocado VALUES ('%s','%s','%s','%s')" % (i, entidades[i], random.randint(0,5), random.randint(0,99)))


def populate_acciona():
    """ cada meio e acionado por um processo qualquer sempre """
    for i in range(0,100):
        if (i%3==2): # se for meio Socorro
            print("INSERT INTO acciona VALUES ('%s','%s','%s')" % (i, entidades[i], random.randint(0,99)))

def populate_coordenador():
    """ coordenadores numerados de 0 a 99 """
    for i in range(0,100):
        print("INSERT INTO coordenador VALUES ('%d'); " % (i))

def populate_audita():
    """
      idCoordenador NUMERIC(255) NOT NULL ,
      numMeio NUMERIC(255) NOT NULL,
      nomeEntidade VARCHAR(255) NOT NULL,
      numProcessoSocorro NUMERIC(255) ,
      datahoraInicio TIMESTAMP NOT NULL,
      datahoraFim TIMESTAMP NOT NULL,
      dataAuditoria TIMESTAMP NOT NULL,
      texto VARCHAR(255) , --texto pode ser null?
       """
    for i in range(0,100):
        print("INSERT INTO coordenador VALUES ('%d'); " % (i))


""" Funcoes Auxiliares """

def randchar():
    """ generates a random UPPERCASE char """
    return chr(random.randint(65,90))

def randstring():
    """ generates a random UPPERCASE string of 9 characters """
    return "".join([ randchar() for i in range(0,10)])

def genPhoneNumber():
    """ generates a random portuguese like number """
    return "".join(["9"]+[str(random.choice([6,2,3]))]+[str(random.randint(0,9)) for i in range(7)])

def readFile(filename):
    """ reads a file and return a list of the lines, removing the trailing \n """
    with open(filename, "r") as file:
        lines = file.readlines()
        return [ line[:-1] for line in lines ] # remove the trailing "\n"


""" Files -> Lists """
moradas = readFile("moradas.txt")
phones  = readFile("phones.txt")
nomes   = readFile("nomes.txt")
nomesMeios   = readFile("nomes-estranhos.txt")
entidades    = readFile("entidades.txt")

""" populate """
populate_segmentoVideo()
print("")
populate_camara()
print("")
populate_video()
print("")
populate_segmentoVideo()
print("")
populate_zona()
print("")
populate_vigia()
print("")
populate_processoSocorro()
print("")
populate_eventoEmergencia()
print("")
populate_entidadeMeio()
print("")
populate_meio()
print("")
populate_transporta()
print("")
populate_alocado()
print("")
populate_coordenador()
"""
