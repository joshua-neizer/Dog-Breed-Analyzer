import os
import sys
import shutil

path = '/home/pi/html/.MLApp/DogInfoFolders'

folders =  [d for d in os.listdir(path) if os.path.isdir(os.path.join(path, d))]

for folder in folders:
    try:
        shutil.rmtree(path + "/" + folder)
    except OSError as e:
        print ("Error: %s - %s." % (e.filename, e.strerror))
