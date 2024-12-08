# 📢 **Beelzebot Project Configuration Documentation** 📢

---

## 🟢 **1. Full User Flow: From Entry to Final Response**

1. **User Access**:  
   - The user accesses `https://beelzebot.com/pelusa-trader` (hosted on **SiteGround**).  
   
2. **Frontend Rendering**:  
   - **SiteGround** delivers the webpage files to the user's browser.  
   - The frontend is configured with a `config.js` file where the API URL is set: 
     ```javascript
     const config = {
         apiURL: 'https://api.beelzebot.com:8000'
     };
     export default config;
     ```

3. **Data Request**:  
   - The frontend sends a **GET** request to `https://api.beelzebot.com:8000`.  
   - The DNS resolution converts `api.beelzebot.com` into the public IP of the AWS EC2 instance (16.16.213.253).  

4. **Security Validation**:  
   - The browser verifies that the URL has a valid SSL certificate for `api.beelzebot.com`.  
   - The **AWS Security Group Rules** only allow requests from:  
     - SiteGround IP (`34.174.168.65/32`).  
     - Local development IP (`157.97.6.174/32`).  
   - IPs are also validated in FastAPI middleware.  

5. **Request Processing**:  
   - **Uvicorn** receives the request and forwards it to **FastAPI**.  
   - FastAPI processes the request, applies business logic, and queries the database if necessary.  
   - The server responds with the requested data.  

6. **Response to Frontend**:  
   - The response is sent back to **SiteGround** and then to the user's browser.  
   - The browser dynamically renders the information.  

---


## 🌐 **2. DNS Configuration**
- **Subdomain Setup**: Configured `api.beelzebot.com` to point to the public IP of the AWS EC2 instance (16.16.213.253).  
- **DNS Propagation Check**: Verified DNS propagation using [whatsmydns.net](https://www.whatsmydns.net/).  
- **Propagation Time**: DNS propagation can take **24 to 72 hours**.  
- **Issue Resolution**: Identified and resolved conflicts between IPs (**34.174.168.65 and 16.16.213.253**).  

---

## 🔐 **3. Security Configuration**
- **AWS Security Groups**:  
  - **Port Rules**:  
    - Port `8000` for the Uvicorn backend.  
    - Port `22` for SSH access.  
  - **Allowed IPs**:  
    - **SiteGround**: `34.174.168.65/32`.  
    - **Local development**: `157.97.6.174/32`.  
  - **Log Review**: Tracked incoming IPs to ensure only authorized IPs were accessing the server.  

---

## 🖥️ **4. Backend Configuration (FastAPI + Uvicorn)**
- **Server Setup**: Configured **FastAPI** with **Uvicorn** on the AWS EC2 instance.  
- **SSL Certificate**: Configured SSL certificates for `api.beelzebot.com`.  
- **Error Resolution**: Addressed SSL certificate issues such as **ERR_CERT_COMMON_NAME_INVALID**.  
- **Log Review**: Monitored Uvicorn logs to identify the following:  
  - **Successful connections**: Indicated by `200 OK` messages.  
  - **Connection errors**: Monitored for **ConnectionResetError: [WinError 10054]**, **ERR_TIMED_OUT**, and other errors.  

---

## 💻 **5. Configuración del Frontend (React)**
- **API URL Setup**: Configured the API URL in the frontend to point to `https://api.beelzebot.com:8000`:   
```javascript
    const config = {
        apiURL: 'https://api.beelzebot.com:8000'
    };
    export default config;    
```

- **Error Handling**:  
  - **ERR_NAME_NOT_RESOLVED**: Fixed after DNS propagation.  
  - **ERR_CERT_COMMON_NAME_INVALID**: Fixed by configuring the correct SSL certificate.  
  - **ERR_TIMED_OUT**: Resolved by updating AWS **Security Group Rules** to allow necessary IPs.  

---

## 🕒 **6. DNS Propagation**
- **Verification**: Used [whatsmydns.net](https://www.whatsmydns.net/) to track DNS propagation.  
- **Propagation Time**: The propagation process can take **24 to 72 hours**.  
- **Issues Identified**:  
  - **IP Conflicts**: Found conflicting IPs (**16.16.213.253 and 34.174.168.65**).  
  - **Resolution**: Corrected the DNS records to point exclusively to **16.16.213.253**.  

---

## 🔐 **7. SSL Configuration (Let's Encrypt)**
- **SSL Certificate**: Generated an SSL certificate using **Let's Encrypt**.  
- **Domains Secured**:  
  - **beelzebot.com**  
  - **api.beelzebot.com**  
- **Purpose**: Secure communication between the frontend and backend using HTTPS.  
- **Error Resolution**: Resolved the **ERR_CERT_COMMON_NAME_INVALID** issue.  

---

## 🛠️ **8. Reverse Proxy**
- **Objective**: Redirect requests to `api.beelzebot.com` to the AWS EC2 instance.  
- **Configuration Location**: Placed the **.htaccess** file in the **public_html** directory on SiteGround.  
```apacheconf
  RewriteEngine On
  RewriteCond %{HTTP_HOST} ^api\.beelzebot\.com$ [NC]
  RewriteRule ^(.*)$ http://16.16.213.253:8000/$1 [P,L]
```

- **Explanation**:
  - **RewriteEngine On**: Activates the URL rewrite engine.
  - **RewriteCond**: Condition to check if the URL contains api.beelzebot.com.
  - **RewriteRule**: Redirects requests to the EC2 instance at IP 16.16.213.253:8000.

---

## 🔍 **9. Log Analysis and Debugging**

### 📋 **Log Review**
- Logs from **Uvicorn** and **FastAPI** were analyzed for debugging purposes.  

### 🔍 **Identified Issues**
- **ConnectionResetError: [WinError 10054]**: Unexpected disconnection.  
- **ERR_NAME_NOT_RESOLVED**: Detected before DNS propagation was complete.  
- **ERR_CERT_COMMON_NAME_INVALID**: SSL certificate did not match the requested URL.  
- **ERR_TIMED_OUT**: API connection failed due to security and DNS propagation issues.  

### 🛠️ **Solutions Applied**
- **DNS Propagation**: Waited **24 to 72 hours** for complete DNS propagation.  
- **SSL Certificate**: Used a **Wildcard SSL** to cover subdomains.  
- **Security Rules**: Adjusted AWS **Security Group Rules** to allow connections only from trusted IPs.  

---

## ⚠️ **Errors Identified and Resolutions**

| **Error**                         | **Cause**                          | **Resolution**                                |
|-----------------------------------|-------------------------------------|---------------------------------------------|
| **ERR_NAME_NOT_RESOLVED**         | DNS propagation not completed       | Wait for DNS propagation (24-72 hours)       |
| **ERR_CERT_COMMON_NAME_INVALID**  | Invalid SSL certificate             | Use a Let's Encrypt wildcard SSL            |
| **ERR_TIMED_OUT**                 | Connection issues                   | Update AWS security rules                   |
| **ConnectionResetError: [WinError 10054]** | Unexpected connection closure   | Improve error handling logic                |

---

## 📈 **Next Steps**

- 🕒 **Monitor DNS propagation** (24-72 hours).  
- 🔄 **Test connections from mobile devices**.  
- 🔐 **Review SSL certificates** to ensure API security.  
- 📄 **Publish the final LinkedIn post** with the title:  
  **🚀 Overcoming Challenges: From Frontend to Backend with Beelzebot**.  
- ⚙️ **Review Uvicorn logs** to ensure system stability.  