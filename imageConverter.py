
import base64
import sys
import os
import shutil

def decoder(image, imageName, fileType=".jpg"):
    image = base64.b64decode(image)

    with open(imageName + fileType, "wb") as fh:
        fh.write(image)
    fh.close()


    # with open(imageName+".txt", "wb") as fh:
        # fh.write(image)
    # fh.close()

def cleanup(imageName, fileType=".jpg"):
    os.mkdir(imageName)
    shutil.move(imageName + fileType, imageName+"/"+ imageName + fileType)
    shutil.move(imageName, "DogInfoFolders")
    # shutil.move(imageName+".txt", imageName+"/"+ imageName+".txt")

if __name__ == "__main__":
    try:
        image = open(sys.argv[1], 'r').read()  
        imageName = str(sys.argv[2])
        decoder(image, imageName)
    except: 
        oldName = str(sys.argv[1]) 
        imageName = ("").join(oldName.split(" "))
        os.rename(oldName, imageName)
    cleanup(imageName [:-4], imageName [-4:])
    
