import matplotlib.pyplot as plt
import matplotlib.animation as animation
import time
import random #
import re
from datetime import datetime, date, time
import os
import subprocess





def animate(i): # let op met function call
    #os.system("./collectData.py")
    subprocess.call("/home/pi/data_traffic/collectData.py", shell=True)
    with open("sampleText.txt","r") as f:
    
        xar=[]
        yar=[]
    
    
        for line in f:
            line=line.replace(' Bps','') # vergeet niet om ook de waarde effectief te setten  
            line=line.replace('\n','')
            line=re.sub('\s{2,}',' ',line) # sommige zijn  4 whitespaces groot, andere 3; tussen date en time staat er maar 1 whitespace

            #print(line)
        
            a=line.split('\n')
            for newLine in a:
                #print(newLine)
                #print(type(newLine))
                if len(newLine)>1:
                    x,y,z = newLine.split(' ') #x = date;y= time; z= Bps
                    # print('x: ',x,'y: ',y,'z: ',z)
                    
                    dArray= x.split("/") # date array
                    d=date(int(dArray[0]), int(dArray[2]), int(dArray[1]))
                    #print(d)
                    
                    tArray= y.split(":") # time array                    
                    t = time(int(tArray[0]), int(tArray[1]), int(tArray[2]))
                    #print(t)
                    
                    newDate=datetime.combine(d,t)
                    #print(newDate)                               
                    
                    xar.append(newDate)                   
                    #dates=plt.dates.date2num(xar)
                    yar.append(float(z))
        
#print(xar,yar)
        
        
