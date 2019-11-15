import datetime
f = open("update.txt","w+")
f.write("This file is updated at " + str(datetime.datetime.now()) + ".\n")
f.close()