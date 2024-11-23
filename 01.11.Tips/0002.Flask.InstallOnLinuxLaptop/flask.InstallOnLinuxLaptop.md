1.  # Objective
    - Install flask on a Linux Laptop Machine
2. ## Steps
    1. Install python and pip
       1. Update packages 
           ```
           sudo apt update
           sudo apt upgrade
           ```
       2. Install if is necessary
           ```
           python3 --version
           pip3 --version
           sudo apt install python3
           sudo apt install python3-pip
           ```
    2. Crear a Virtual Environment named **acme**
        ```
        sudo apt install python3-venv
        python3 -m venv acme
        ```
    3. Instalar Flask en el entorno virtual
        ```
        $ source acme/bin/activate
        (acme) $ pip3 install Flask
        ```
    4.  Create an app that say 
        ```
        from flask import Flask

        app = Flask(__name__)

        @app.route('/')
        def hello_world():
            return 'Hello, World!'

        if __name__ == '__main__':
            app.run()
        ```
    5.  Start the app as web server
        ```
        $ source acme/bin/activate
        $ python3 app.py
        * Serving Flask app 'app'
        * Debug mode: off
        WARNING: This is a development server. Do not use it in a production deployment. Use a production WSGI server instead.
        * Running on http://127.0.0.1:5000
        Press CTRL+C to quit
        ```
    6.  Connect to app
        ```
        http://127.0.0.1:5000/
        ```
        You should see the message "Hello, World!"
