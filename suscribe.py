#import context  
import paho.mqtt.client as mqtt

def on_message(mosq, obj, msg):
    print(msg.topic + " " + str(msg.qos) + " " + str(msg.payload))

mqttc = mqtt.Client()

# Configuración de credenciales
username = "admin"
password = "1234"
mqttc.username_pw_set(username, password)

mqttc.on_message = on_message
mqttc.connect("34.32.221.100", 1883, 60)
mqttc.subscribe("#", 0)

mqttc.loop_forever()
