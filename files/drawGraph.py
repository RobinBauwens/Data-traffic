import matplotlib.pyplot as plt
import matplotlib.animation as animation
import time
import random #
import re
from datetime import datetime, date, time


fig = plt.figure()
ax1 = fig.add_subplot(1,1,1)

def animate(i): # let op met function call

    with open("sampleText.txt","r") as f:
    
        xar=[]
        yar=[]
    
    
        for line in f:
            line=line.replace(' Bps','') # vergeet niet om ook de waarde effectief te setten  
            line=line.replace('\n','')
            line=re.sub('\s{2,}',' ',line) # sommige zijn  4 spaties groot, andere 3 

            print(line)
        
            a=line.split('\n')
            for newLine in a:
                print(newLine)
                #print(type(newLine))
                if len(newLine)>1:
                    x,y,z = newLine.split(' ')
                    
                    dArray= x.split("/") # date array
                    d=date(int(dArray[0]), int(dArray[2]), int(dArray[1]))
                    print(d)
                    
                    tArray= y.split(":") # time array                    
                    t = time(int(tArray[0]), int(tArray[1]), int(tArray[2]))
                    print(t)
                    
                    datetime.datetime.strptime(x+y, '%Y/%b%Y')
                    print('x: ',x,'y: ',y,'z: ',z)
                    xar.append(x)                   
                    #dates=plt.dates.date2num(xar)
                    yar.append(float(y))
            ax1.clear()
            ax1.plot(xar,yar)
ani = animation.FuncAnimation(fig, animate, interval=1000)
plt.show()
#print(xar,yar)
        
        