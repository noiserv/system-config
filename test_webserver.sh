#!/bin/bash
set -e
#echo "running: scp web/* ist186474@sigma.tecnico.ulisboa.pt:~/web/" $1

if [ "$#" -eq  "0" ]; then # if argument not set
  echo "./test-webserver [user]"
  echo "    Users: mad, noiserv, smurf"
  exit
fi

# login and upload file
echo ==== password da Mad ====
scp web/* ist186474@sigma.tecnico.ulisboa.pt:~/web/$1

if [ $? -eq 0 ]; then
    echo testing server updated
    echo visit https://web.ist.utl.pt/ist186474/$1
else
    echo FAILED updating testing server
fi
