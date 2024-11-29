1. # SiteGround Server
   1. Just the server is OK, No Python, No Flake, No MySQL at this time
   1. Special thanks to Vladislav R., the siteground hardworker, who manually enabled the offer for 5 $e$ per mounth if we pay 12 mounths.

   1. ## SiteGround Account

      1. URL: https://login.siteground.com/login?lang=en
      1. User: rene.astudillo.bgl@gmail.com
      1. Password: **********

      1. ## Cuenta correo asociada:
         1. email: rene.astudillo.bgl@gmail.com 

1. # Domain
   1. ## beelzebot.com

1. # Sites

    |Req. | CMD | URL | Descripción|
    |-----------|----|---|----------------------|
    |RAN-XXX | N.A  | https://beelzebot.com/webhook/ | Process alarms generated by HTTPS POST Method from TradingView   |

1. # Beelzebot - HTTP Request Method supported 

    |# |Method | URL | CMD | Answer| Description|
    |--| -----------|----|---|---|-------------------|
    |PTV |POST | https://beelzebot.com/webhook/ | - | json | See PTV Description |
    |PTV |POST | https://34.174.168.65/webhook/ | - | json | See PTV Description |    
    |GAB |GET | https://beelzebot.com/webhook/ | GET_ALL| Plain Text |  |

    The traderview IP is: 18.164.21.80

   1. ## PTV description:  POST from TradingView 
      1. ### Usage
         - URL: https://beelzebot.com/webhook/
         - Configuration: 
           - As is required in TradingView
           - This is testing etage
             - So feel free for using Free Format Text for the params and values you want to process.
             - If is possible, no least 5 minutes between alarms
      2. ### Answer
         - Into TradingView
            I thing so TradingView no process answers to his alarms, so a general answer was configured at beelzebot:\
            ```
            {"success":true,"message":"ACK","data":{"Crypto":"BTC","ORDER":"01010101L"}}
            ```
      1. ### Internal task triggered when an alarms is received
         - File log
            - aaFor each alarm received a row is added into: ~/public_html/webhook/log_alarms/alarms.log
            - The format of this log is:<span style="font-size:0.7em;">
              - 2024-05-02 22:39:10 - 186.105.26.180 - Crypto: BTC; ORDER: 01010101J; \
               2024-05-03 06:23:49 - 186.105.26.180 - Crypto: BTC; ORDER: 01010101K; \
               2024-05-03 07:01:50 - 186.105.26.180 - Crypto: BTC; ORDER: 01010101L; </span>
            - This file could be possible to see in a browser under this URL:
               - https://beelzebot.com/webhook/log_alarms/alarms.log
               **ISSUE 000001:**  
               First time work fine ... second time work fine is it is after 12 hours.  
               The problem is in the cache configuration at SiteGround.  
               I am working to fix it, the solutions suggested by the IA and technicians at SiteGround no worked. So today it is necessary to go ahead with the samething.  
   
   1. ## GAB description:  GET alarms log from any browse 
      1. ### Usage
         - URL: https://beelzebot.com/webhook/?CMD=GET_ALL
         - Configuration: 
           - No configuration is required, just type the before URL in your browser
      2. ### Answer
         - You should see some like to this one in your browser:
            ```
            2024-05-02 18:25:48 - 186.105.26.180 - Crypto: USDC; ORDER: 10101010;
            2024-05-02 18:28:00 - 186.105.26.180 - Crypto: USDC; ORDER: 01010101;
            2024-05-02 18:29:08 - 186.105.26.180 - Crypto: BTC; ORDER: 01010101;
            2024-05-02 18:44:15 - 186.105.26.180 - Crypto: BTC; ORDER: 01010101A;
            2024-05-02 18:46:15 - 186.105.26.180 - Crypto: BTC; ORDER: 01010101B;
            2024-05-02 18:49:54 - 186.105.26.180 - Crypto: BTC; ORDER: 01010101B;
            2024-05-02 19:08:04 - 186.105.26.180 - Crypto: BTC; ORDER: 01010101C;
            2024-05-02 19:10:13 - 186.105.26.180 - Crypto: BTC; ORDER: 01010101D;
            2024-05-02 19:21:12 - 186.105.26.180 - Crypto: BTC; ORDER: 01010101E;
            2024-05-02 20:04:19 - 186.105.26.180 - Crypto: BTC; ORDER: 01010101F;
            2024-05-02 20:08:05 - 186.105.26.180 - Crypto: BTC; ORDER: 01010101G;
            2024-05-02 20:10:22 - 186.105.26.180 - Crypto: BTC; ORDER: 01010101H;
            2024-05-02 20:13:41 - 186.105.26.180 - Crypto: BTC; ORDER: 01010101H;  
            ```
             **ISSUE 000001:**  
               Same issue described above ... we are workining for you ... but first time work, please try and comment.  

1. # Issues
   1. # Beelzebot.com/webhook no receive the post sent by TradingView 
        - 2024.04.05 18:35 chilean time
            Thank you for your patience. The ticket has been submitted and the ID is **4651394**. You can view it from here: 

            https://my.siteground.com/support/history


            Our seniors will look into this and will update you as soon as possible

        - Other tests/
            **Test 1**
            ```
            - test 1 
            $ curl -H 'Content-Type: text/plain; charset=utf-8' -d 'BTCUSD Greater Than 9000' -X POST https://beelzebot.com/webhook/
            No data received in POST request.<br>

            The POST is received by the index.php file in this way:
            if (!empty($_POST)) {
                    foreach ($_POST as $key => $value) {
                    $logEntry .= htmlspecialchars($key) . ": " . htmlspecialchars($value) . "; ";
            }
            The POSTMAN utility sent the POST as if it were being sent by a form, that is, keys and values. TradingView sent the POST as TEXT, this is de -d flag.

            This is the reazon why this script "do nothing" when the POST is sent by TradingView.
            ```
            **Test 2**
            ```
            - test 2
            $ curl -H 'Content-Type: text/plain; charset=utf-8' -H 'User-Agent: Go-http-client/1.1' -d 'BTCUSD Greater Than 9001' -X POST https://beelzebot.com/webhook/
            
            Answer:
            403 - Forbidden | Access to this page is forbidden.
            ```

            **The soluction is in test 3 below.**
            **Test 3**
            ```
            - test 3
            $ curl -H 'Content-Type: text/plain; charset=utf-8' -d 'BTCUSD Greater Than 9000' -X POST https://beelzebot.com/webhook/
            {"success":true,"message":"ACK","data":[]}

            <?php

            //header('Access-Control-Allow-Headers: token, Content-Type');
            //header('Access-Control-Max-Age: 5');

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $postData = file_get_contents('php://input');
                if (!empty($postData)) {
                    logfile( $postData );
                }

                if (!empty($_POST)) {
                    logfile_POST();
                }

                $responseData = [
                        'success' => true,
                        'message' => 'ACK',
                        'data' => $_POST // You might want to sanitize or process this data before sending it back
                ];
                echo json_encode($responseData);

            }elseif( isset($_GET['CMD']) ){

                $cmd = $_GET['CMD'];

                showout_alarms( $cmd);

            }else{

                echo "01: HTTP Request you sent is not a POST Request<br>";
                echo "02: HTTP Request you sent is not a GET Request<br>";
                echo "03: Try: '''https://beelzebot.com/webhook?CMD=GET_ALL''' for getting all alarms received... be carefull<br>";
            }

            function showout_alarms( $cmd){

                $filePath = "./log_alarms/alarms.log";

                if (file_exists($filePath) && is_readable($filePath)) {

                    $file = fopen($filePath, 'r');

                    if ($file) {
                        // Loop through each line in the file
                        while (($line = fgets($file)) !== false) {
                            echo htmlspecialchars($line) . "<br>";
                        }
                        // Close the file
                        fclose($file);
                    } else {
                        echo "Unable to open file.<br>";
                    }
                } else {
                    echo "File does not exist or cannot be read.</br>";
                }

            }

            /* ------------------------------------------- *
                write down a file 
            * ------------------------------------------- */
            function logfile( $szLine ){
            /* ------------------------------------------- */

                $clientIP = $_SERVER['REMOTE_ADDR'];
                if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $clientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
                }

                date_default_timezone_set('America/Santiago');
                
                $timeStamp = date('Y-m-d H:i:s');
                $logEntry = $timeStamp . " - ";

                $logEntry .= $clientIP . " - ";

                $logEntry .= htmlspecialchars($szLine);

                // Add a new line at the end of each entry
                $logEntry .= PHP_EOL;

                $file = fopen("./log_alarms/alarms.log", "a");
                fwrite($file, $logEntry);
                fclose($file);
            }



            /* ------------------------------------------- *
                write down a file 
            * ------------------------------------------- */
            function logfile_POST(){
            /* ------------------------------------------- */

                $clientIP = $_SERVER['REMOTE_ADDR'];
                if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $clientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
                }

                date_default_timezone_set('America/Santiago');
                
                $timeStamp = date('Y-m-d H:i:s');
                $logEntry = $timeStamp . " - ";

                $logEntry .= $clientIP . " - ";

                // Append each key and value from the POST data to the log entry
                foreach ($_POST as $key => $value) {
                    // Encode the value to ensure it's safe for logging
                    $logEntry .= htmlspecialchars($key) . ": " . htmlspecialchars($value) . "; ";
                }

                // Add a new line at the end of each entry
                $logEntry .= PHP_EOL;

                $file = fopen("./log_alarms/alarms.log", "a");
                fwrite($file, $logEntry);
                fclose($file);
            }

            ?>

            ```

            ```
            The curl is test 1 is processed in this way:

            The second curl is processed using:
            $postData = file_get_contents('php://input');
            ```
1. # Pythonanywhere
   1. # Account
      - Username: rene.astudillo.bgl@gmail.com
      - Email: rene.astudillo.bgl@gmail.com
      - Password: **********
    ELIMINAR, DB ?, scripts in the console, are permanents ?

2. # TradingView, Alert with Email configuration
    ```
    https://www.tradingview.com/support/solutions/43000531021-how-to-use-a-variable-value-in-alert/  
    ```
   1.  # Setting
        - Conditions
          - BTCUSDT.PS
          - Crossing
          - Price  63750.39
        - Trigger
          - Every Time
        - Expiration: May 31, 2024 at 1741
        - Alert name SG01
        - Message
          - BTCUSDT.PS Crossing 63702.76##
            {{exchange}}:{{ticker}}, price = {{close}}, volume = {{volume}}
    1. # Notifications
        - Notification in app: actived
        - Show pop-up: actived
        - Send email: no actived
        - Webhook URL: no actived
        - Play sound: no actived
        - Send plain text: actived into alert@beelzebot.com
          - When activing, it send a code to alert@beelzebot.com.
          - For connecting to alert@beelzebot.com from any where use:
          - URL : https://beelzebot.com/webmail/log-in
          - Email: ***********
          - Password: **********

3. # SiteGround, Email Filters
    ```
    https://my.siteground.com/support/kb/how_to_pipe_an_email_to_a_php_script/
    ```
   1. ## Email Account
    - alert@beelzebot.com / 99Cft_6_yhn99
   2. ## Pipe email Configuration
        Filter name: tradingview
        - Rule: ifany
            from does not contains ENDOFTIME
            Perform the following actions:
            Pipe to a Program: /home/customer/www/beelzebot.com/public_html/pipescript.php

4. # SSL remote console
   1. ## Key Pair
    - At SiteGround:
       - key name: beelzebot
       - Cft_6_yhn
       - Save Private Key to local folder

        - Credentials:
          - Hostname: ssh.beelzebot.com
          - Username: u2131-lihxrceukjko
          - Port: 18765

    - Al Linux:
      - ssh-add ./beelzebot.pem
      - ssh u2131-lihxrceukjko@ssh.beelzebot.com -p18765