import sys
import os
import shutil

def cleanup(imageName, fileType=".jpg"):
    os.mkdir(imageName)
    shutil.move(imageName + fileType, imageName +"/"+ imageName + fileType)
    shutil.move(imageName, "DogInfoFolders")

if __name__ == "__main__":
    oldName = str(sys.argv[1]) 
    imageName = ("").join(oldName.split(" "))
    os.rename(oldName, imageName)
    cleanup(imageName [:-4], imageName [-4:])
    
