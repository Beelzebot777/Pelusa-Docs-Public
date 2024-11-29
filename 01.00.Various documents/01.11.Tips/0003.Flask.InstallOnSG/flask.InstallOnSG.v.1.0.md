1. # Install Flask on SG
   1. ## Objective
        - How to deploy a Flask application SiteGround hosting
   2. # General Steps
      1. Check that the hosting environment supports Python and that you have SSH access to install Flask and its dependencies. Here's what you can do:

         1. Access your hosting account via SSH.
         2. Create a virtual environment for your Flask application.
         3. Activate the virtual environment and install Flask using pip.
         4. Upload your Flask application files to your hosting account.
         5. Set up your application to run with a web server. We typically recommend using Gunicorn in combination with Nginx.

1. # Flask working with apache
   1. ## Install Flask and mod_wsgi
      1. - sudo apt update
      1. - //sudo apt install apache2 libapache2-mod-wsgi-py3 python3-pip
      1. - Check if mod-wsgi is installed
         ```
         $ apache2ctl -M | grep wsgi
         AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 127.0.1.1. Set the 'ServerName' directive globally to suppress this message
         wsgi_module (shared)
         ``` 
         This case is installed:`wsgi_module (shared)`
      1. - If wsgi is not installed: 
           - Install the module wsgi in Apache:
               `sudo apt install libapache2-mod-wsgi-py3`
           - Enable module wsgi
               `sudo a2enmod wsgi`
           - Restart Apache2
               `sudo systemctl restart apache2`
           - Check error:
               ```
               $ sudo tail -f /var/log/apache2/error.log
                  [Mon May 20 16:26:02.654630 2024] [core:notice] [pid 8738] AH00094: Command line: '/usr/sbin/apache2'
                  [Mon May 20 16:27:10.539085 2024] [mpm_prefork:notice] [pid 8738] AH00170: caught SIGWINCH, shutting down gracefully
                  [Mon May 20 16:27:10.680208 2024] [mpm_prefork:notice] [pid 8790] AH00163: Apache/2.4.52 (Ubuntu) mod_wsgi/4.9.0 Python/3.10 configured -- resuming normal operations
                  [Mon May 20 16:27:10.680356 2024] [core:notice] [pid 8790] AH00094: Command line: '/usr/sbin/apache2'
                  [Mon May 20 16:34:38.758451 2024] [mpm_prefork:notice] [pid 8790] AH00170: caught SIGWINCH, shutting down gracefully
                  [Mon May 20 16:34:38.898483 2024] [mpm_prefork:notice] [pid 9046] AH00163: Apache/2.4.52 (Ubuntu) mod_wsgi/4.9.0 Python/3.10 configured -- resuming normal operations
                  [Mon May 20 16:34:38.898579 2024] [core:notice] [pid 9046] AH00094: Command line: '/usr/sbin/apache2'
                  [Mon May 20 16:50:24.399584 2024] [mpm_prefork:notice] [pid 9046] AH00170: caught SIGWINCH, shutting down gracefully
                  [Mon May 20 16:50:53.012022 2024] [mpm_prefork:notice] [pid 1006] AH00163: Apache/2.4.52 (Ubuntu) mod_wsgi/4.9.0 Python/3.10 configured -- resuming normal operations
                  [Mon May 20 16:50:53.012498 2024] [core:notice] [pid 1006] AH00094: Command line: '/usr/sbin/apache2'
               ``` 
      1. Create the WSGI File `/var/www/html/flaskapache/app.wsgi` with this content:
         ```
         import sys
         import logging

         # Set up logging
         logging.basicConfig(stream=sys.stderr)

         # Ensure the app directory is in the path
         sys.path.insert(0, "/var/www/html/flaskapache")

         from app import app as application
         ```
         **Fig.: app.wsgi file**
      2. Create a new virtual apache server for the `/var/www/html/flaskapache/app.py` aplication.
         - Create file **`/etc/apache2/sites-available/flaskapache.conf`** with the following content:
            ```
            <VirtualHost *:8080>
               ServerName 127.0.0.1

               WSGIDaemonProcess flaskapp threads=5
               WSGIScriptAlias / /var/www/html/flaskapache/app.wsgi

               <Directory /var/www/html/flaskapache>
                  Require all granted
               </Directory>

               Alias /static /var/www/html/flaskapache/static
               <Directory /var/www/html/flaskapache/static/>
                  Require all granted
               </Directory>

               ErrorLog /var/www/html/flaskapache/flaskapp_error.log
               CustomLog /var/www/html/flaskapache/flaskapp_access.log combined
            </VirtualHost>
            ```
         - Enable the virtual server
            ```
            $ sudo a2ensite flaskapache
            $ sudo systemctl restart apache2
            ```
      1. Check the app:
         `http://192.168.1.162:8080/`
         Answer:
         ```
         Firefox can’t establish a connection to the server at 192.168.1.162:8080.
         ``` 
2.  # These steps NO WORK: Detailed step-by-step install guide:
    1. # For first time:
        1. Connect to the SiteGround account with SSH.
        2. Create a Virtual Environment:
           - Navigate to the directory where you want to deploy your Flask app.
           - Run `python3 -m venv acme` to create a virtual environment named **acme**.
        3. Activate the Virtual Environment:
           - Activate it by running `source acme/bin/activate`.
        4. Install Flask:
           - With the virtual environment activated, install Flask using pip by running `pip install Flask`.
        5. Install your Flask Application:
           - Upload your Flask application files to the chosen directory in your hosting account using SFTP or SCP.
        6. Configure Your Application:
           - Make sure your Flask application has a proper WSGI entry point, typically named `wsgi.py` or **`app.py`**.

        7. Install Gunicorn:
           - Install Gunicorn within your virtual environment by running `pip install gunicorn`.
        8. Run the Application with Gunicorn:
           - Start your Flask application with Gunicorn by running a command similar to
                ```gunicorn --workers 3 myapp:app``` 
                where `myapp` is the name of your Python module that contains the Flask application instance and `app` is the name of the instance.

        9. Set Up a Web Server:
           - Configure a web server like Nginx to act as a reverse proxy to forward requests to Gunicorn. You might need to edit configuration files and set up server blocks.

        10. Persistent Application Running:
            - To keep your application running persistently, consider using a process manager like Supervisor.

         Please note that the exact commands and configurations may vary based on your application's specific requirements and the server environment. If you need assistance with any of these steps or have specific requirements, let us know, and we can provide more tailored guidance.

    2. # Steps
         - `connect to SH'Account`
         - `$ cd /home/u2131-lihxrceukjko/www/beelzebot.com/public_html/dev`
         - `$ python3 -m venv acme`
         - `$ source acme/bin/activate`
         - `$ pip install gunicorn`
         - `$ pip install Flask`
         - `$ gunicorn --workers 3 app:app`


    3. # Questions
         1. Q1
            I want to install and deploy a flask app
            I Followed the steps suggested by the SG's IA:
            - `$ cd /home/u2131-lihxrceukjko/www/beelzebot.com/public_html/dev`
            - `$ python3 -m venv acme`
            - `$ source acme/bin/activate`
            - `$ pip install gunicorn`
            - `$ pip install Flask`
            - The path for the app.py is `/home/u2131-lihxrceukjko/www/beelzebot.com/public_html/dev/app.py`
            - The app.py is:
               ```
               from flask import Flask

               app = Flask(__name__)
               @app.route('/')
               def hello_acme():
                  return 'hello to acme'

               if __name__ == '__main__':
                  app.run(debug=True)
               ``` 
            - `$ gunicorn --workers 3 app:app`
               ***This is what gunicorn says when start:***

               ```
               [2024-05-20 15:34:20 +0000] [4727] [INFO] Starting gunicorn 22.0.0
               [2024-05-20 15:34:20 +0000] [4727] [INFO] Listening at: http://127.0.0.1:8000 (4727)
               [2024-05-20 15:34:20 +0000] [4727] [INFO] Using worker: sync
               [2024-05-20 15:34:20 +0000] [4728] [INFO] Booting worker with pid: 4728
               [2024-05-20 15:34:20 +0000] [4729] [INFO] Booting worker with pid: 4729
               [2024-05-20 15:34:20 +0000] [4730] [INFO] Booting worker with pid: 4730

               ```




    4. # Some Digressions
        - About step 9, why not to use the standard webserver apache used by siteground ?
            - You can certainly use Apache, which is the standard web server provided by SiteGround, to serve your Flask application. 
            - Apache can be configured with mod_wsgi to serve Python applications.
              - You would need to install mod_wsgi
              - Configure an Apache virtual host for your application
              - Be ensure that the WSGIDaemonProcess and WSGIScriptAlias directives are set up correctly to point to your Flask application.
          - _If you need assistance with configuring Apache with mod_wsgi for your Flask application, please let us know, and we can provide further guidance._ 
        - Here's why you might consider using Gunicorn in combination with Nginx as an alternative:
          - Performance: Gunicorn is a WSGI HTTP Server for UNIX, designed to serve fast clients or behind a buffering reverse proxy like Nginx. It can offer better performance for WSGI-compliant Python applications.
          - Simplicity: Gunicorn is relatively easy to set up and run, and it's often used in conjunction with Flask applications.
          - Nginx as a Reverse Proxy: Nginx can handle static assets more efficiently and can also act as a buffer for slow clients. This setup can improve the overall performance and scalability of your application.

       - The server will follow running when I close the remote concole ?
            When you start a process in the remote console (SSH session), such as running your Flask application with Gunicorn, the process will terminate once you close the console or SSH session. 
            - To keep the server running after you close the remote console, you should use a process manager. A process manager will ensure that your Flask application continues to run in the background even after the SSH session has ended. 
            - Here are two common process managers you can use:
                - Supervisor: This is a client/server system that allows you to monitor and control a number of processes on UNIX-like operating systems.
                - systemd: If your hosting environment uses systemd, you can create a service file to manage your Flask application.

            - For example, with Supervisor, you would:
              - Install Supervisor (if it's not already installed).
              - Create a configuration file for your Flask application in the `/etc/supervisor/conf.d/` directory.
              - Run `supervisorctl reread` and `supervisorctl update` to apply the changes.
              - Start your application with `supervisorctl start yourapp`.

           - With systemd, you would:
             - Create a `.service` file in `/etc/systemd/system/`.
             - Define the service configuration, including the command to start your Flask application.
             - Enable the service with `systemctl enable yourapp.service`.
             - Start the service with `systemctl start yourapp.service`.

            Using a process manager will ensure that your Flask application remains active and can restart automatically in case of a server reboot or if the application crashes for some reason. If you need specific instructions on setting up a process manager, please let us know, and we can provide more detailed guidance.
