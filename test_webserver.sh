#!/bin/bash
set -e
echo ==== password da Mad ====
scp web/* ist186474@sigma.tecnico.ulisboa.pt:~/web/testing

if [ $? -eq 0 ]; then
    echo testing server updated
else
    echo FAILED updating testing server
fi
