from flask import Flask
import requests

app = Flask(__name__)

@app.route('/')
def send_webhook():
    # URL del webhook
    url = 'https://beelzebot.com/webhook/'

    # Encabezados y datos de la solicitud
    headers = {
        'Content-Type': 'text/plain; charset=utf-8'
    }
    payload = 'BTCUSD Greater Than 9001'

    # Realizar la solicitud POST
    response = requests.post(url, headers=headers, data=payload)

    # Registrar la solicitud y respuesta para depuración
    app.logger.info(f'Request URL: {url}')
    app.logger.info(f'Request Headers: {headers}')
    app.logger.info(f'Request Payload: {payload}')
    app.logger.info(f'Response Status Code: {response.status_code}')
    app.logger.info(f'Response Text: {response.text}')

    # Verificar la respuesta del webhook
    if response.status_code == 200:
        return f'Webhook sent successfully! Response: {response.json()}', 200
    else:
        return f'Failed to send webhook: {response.status_code} - {response.text}', response.status_code

if __name__ == '__main__':
    app.run(debug=True)
