import sys, mysql.connector
import Adafruit_DHT
import os, time
from decimal import *

#read Temperature and Humidity from DHT22 sensor
sensor = Adafruit_DHT.DHT22
pin = 4
humidity, temp = Adafruit_DHT.read_retry(sensor, pin)
humidity = "{0:0.1f}".format(humidity)
temp = '{0:0.1f}'.format(temp)
wind = 138.00

#check if the Temperature and Humidity could be read
if humidity is not None and temp is not None:
    print("Humidity: " + str(humidity) + "%" + '\n' + "Temp: " + str(temp) + "*")
else:
    print ("Failed to get data from DHT22. Try again!")
    sys.exit(0)

#save data into the database
try:
    connection = mysql.connector.connect(host = "localhost", user = "logger", passwd = "reggol", db = "weatherstation")
except:
    print("Verbindung Fehlgeschlagen!")
    sys.exit(0)

cursor = connection.cursor()

#sql = "INSERT INTO weather VALUES(" + str(temp) + "," + str(humidity) + "," + str(wind) + ")"
#cursor.execute(sql)

cursor.execute ("""UPDATE weather SET temp=%s, humidity=%s, wind=%s""", (temp, humidity, wind))

connection.commit()
connection.close()
