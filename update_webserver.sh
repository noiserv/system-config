#!/bin/bash
set -e
echo ==== password da Mad ====
ssh ist186474@sigma.tecnico.ulisboa.pt "cd proj-bd; git pull; cp web/* ~/web/"

if [ $? -eq 0 ]; then
    echo server updated
else
    echo FAILED updating server
fi
