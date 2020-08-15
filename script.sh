#!/bin/bash

fullFN=$1
shortFN=$2
echo $fullFN $shortFN
cd ~/html/.MLApp
pwd
python3 imageConverter.py ${fullFN}
echo $? 
cd dogMLModel 
python3 -m src.inference.MLModel file ../DogInfoFolders/${shortFN}/${fullFN}
echo $? 
cd ../DogInfoFolders/${shortFN}
python3 ../../cleanFile.py ${shortFN}.txt
echo $? 

# cd /home/pi/html/.MLApp && python3 imageConverter.py \"" . $fileName . "\" && cd dogMLModel && python3 -m src.inference.MLModel file ../DogInfoFolders/" . substr($fileName, 0, -4) . "/" . $fileName . " && cd ../DogInfoFolders/" . substr($fileName, 0, -4) . " && python3 ../../  