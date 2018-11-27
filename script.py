
with open("populate.sql","w") as f:

    i=0
    while i<100:
        f.write("INSERT INTO camara VALUES " + "('" + str(i) + "');\n")
        i+=1

    i=0
    j=10
    w = 18
    f.write("\n")
    while i<100:
        if j<24:
            f.write("INSERT INTO video VALUES " + "('" + str(i) + "', '2018-11-" + str(w) + " " + str(j) + ":00:00', '2018-11-" + str(w) + " " + str(j) + ":59:59');\n")
        else:
            w+=1
            j=10
            f.write("INSERT INTO video VALUES " + "('" + str(i) + "', '2018-11-" + str(w) + " " + str(j) + ":00:00', '2018-11-" + str(w) + " " + str(j) + ":59:59');\n")
        i+=1
        j+=1

    i=0
    j=10
    w = 18
    s= 10
    f.write("\n")
    while i<100/6:
        if j<24:
            f.write("INSERT INTO segmentoVideo VALUES " + "('" + str(i) + "', '" + str(i) + "', '2018-11-" + str(w) + " " + str(j) + ":00:" + str(s) + "', '00:00:" + str(s) + "');\n")
        else:
            j=10
            f.write("INSERT INTO segmentoVideo VALUES " + "('" + str(i) + "', '" + str(i) + "', '2018-11-" + str(w) + " " + str(j) + ":00:00', '00:00:50');\n")
        if s>=60:
          j+=1
          i+=1
          s=0
        s+=10

    f.write("\n")
    i=0
    with open("moradas.txt","r") as file:
        for line in file:
            f.write("INSERT INTO zona VALUES " + "('" + line.rstrip() + "');\n")   
    
    f.write("\n")
    i=0
    with open("moradas.txt","r") as file:
        for line in file:
            f.write("INSERT INTO vigia VALUES " + "('" + line.rstrip() + "', '" + str(i) + "');\n")
            i+=1  

    f.write("\n")
    i=0
    while i<100:
        f.write("INSERT INTO processoSocorro VALUES " + "('" + str(i) + "');\n")
        i+=1
    
    nomes=[]
    alb = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','X','W','Z']
    i=0
    with open("names.txt","r") as file:
        for line in file:
            if i<len(alb):
                nomes.append(line.rstrip() + " " + alb[i] + ".")
            else:
                i=1
            i+=1
    i=0
    j=0
    with open("moradas.txt","r") as file:
        for line in file:
            f.write("INSERT INTO eventoEmergencia VALUES " + "('" + nomes[i] + "', '" + line.rstrip() + "', '" + str(i) + "', " +  str(916123850 + i) + "', 2018-11-" 00:");\n") 
            i+=1
            j+=1







    


