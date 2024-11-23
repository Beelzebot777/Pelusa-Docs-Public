1. # SiteGround Access to beelzebot account
   1. Just the server is OK, No Python, No Flake, No MySQL at this time
   1. Special thanks to Vladislav R., the siteground hardworker, who manually enabled the offer for 5 $e$ per mounth if we pay 12 mounths.

   1. ## Access to Web Hosting
      1. ## Access to LUKAS
         1. URL: https://login.siteground.com/login?lang=en
         2. User: ***********
         3. Password: ***********
         1. email: ***********
      2. ## Access to Canito
         1. URL: https://login.siteground.com/login?lang=en
         2. User: ***********
         3. Password: ***********
         1. email: ***********
   2. # Access to SSL remote console
      1. ## On SiteGround
         - Key
            |Key Name |Password |ssh type | IP Allowed |
            |---------|-|--------|---------|
            |******** |********** |ssh-rsa |all  | 
         - SSH Credentials
            |Host Name | User Name | Port | Passphrase|
            |---------|---------|---------|--|
            |ssh.beelzebot.com | ******* |  ******* | ********** |

      2. ## At Linux Laptop
         - Add the Private Key to OS system:
           - `ssh-add ./beelzebot.pem`
         - Connect
           - `ssh {User Name}@ssh.beelzebot.com -{PORT SSH Credentials}`
