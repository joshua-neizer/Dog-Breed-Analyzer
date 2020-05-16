import sys

if __name__ == "__main__":
    fileName = str(sys.argv[1]) 
    fileIn = open(fileName, 'r')
    fileOut = open(fileName[:-4] + "_New.txt", 'w')

    fileIn.readline()
    for line in fileIn:
        temp = []
        line = line.rstrip().split(" ")
        line = list(filter(lambda a: a != "", line))
        for name in line [1].split("_"):
            name = name [0].upper() + name [1:]
            temp.append(name)
        line [1] = (" ").join(temp)
        line [2] = str(round(float(line [2]) * 100, 2)) + "%"

        fileOut.write(line[1] + " " + line [2] + "\r\n")


    

