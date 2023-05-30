import paho.mqtt.publish as publish

# Configuración de autenticación
username = "admin"
password = "1234"

# Publicar mensajes con autenticación
publish.single("boton_bool", "1", hostname="34.32.221.100", auth={'username': username, 'password': password})
publish.single("valor_analog", "357", hostname="34.32.221.100", auth={'username': username, 'password': password})
