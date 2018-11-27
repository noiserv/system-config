#!/usr/bin/env python
# with open("populate.sql","w") as f:
import random
""" it can either accept
        - function  -- random() for example\n
        - file      -- containing an entry per line
        """
#def populate_sql():

def populate_camara():
    i=0
    while i<100:
        print("INSERT INTO camara VALUES " + "('" + str(i) + "');")
        i+=1

def populate_video():
    i=0
    j=10
    w = 18
    print("\n")
    while i<100:
        if j<24:
            print("INSERT INTO video VALUES " + "('" + str(i) + "', '2018-11-" + str(w) + " " + str(j) + ":00:00', '2018-11-" + str(w) + " " + str(j) + ":59:59');")
        else:
            w+=1
            j=10
            print("INSERT INTO video VALUES " + "('" + str(i) + "', '2018-11-" + str(w) + " " + str(j) + ":00:00', '2018-11-" + str(w) + " " + str(j) + ":59:59');")
        i+=1
        j+=1

def populate_segmentoVideo():
    """ we have video segements from 2018-11-18 10:00:10
                               until 2018-11-18 11:00:60 """
    i=0
    j=10
    w = 18
    s= 10
    print("\n")
    while i<100/6:
        if j<24:
            print("INSERT INTO segmentoVideo VALUES " + "('" + str(i) + "', '" + str(i) + "', '2018-11-" + str(w) + " " + str(j) + ":00:" + str(s) + "', '00:00:" + str(s) + "');")
        else:
            j=10
            print("INSERT INTO segmentoVideo VALUES " + "('" + str(i) + "', '" + str(i) + "', '2018-11-" + str(w) + " " + str(j) + ":00:00', '00:00:50');")
        if s>=60:
          j+=1
          i+=1
          s=0
        s+=10


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
