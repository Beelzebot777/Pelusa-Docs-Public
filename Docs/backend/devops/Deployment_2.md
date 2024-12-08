# 📖 Table of Contents

1. **DNS Configuration and Diagnostics**
   - 1.1. Troubleshooting slow DNS resolution.
   - 1.2. Verification of `A` records.
   - 1.3. DNS propagation checks.
   - 1.4. Setting TTL to improve response times.
   - 1.5. Tools for DNS diagnostics: `nslookup`, `dig`, and DNS Checker.

2. **Using Public DNS (Google DNS and Others)**
   - 2.1. Local configuration of Google DNS for testing.
   - 2.2. Limitations of this solution for end users.

3. **Infrastructure and Speed Optimization**
   - 3.1. Infrastructure evaluation:
     - Frontend hosted on SiteGround Texas.
     - Backend hosted on EC2 Stockholm.
     - User location in Iceland.
   - 3.2. Factors affecting speed: latency, distance, TLS, and caching.
   - 3.3. Best configurations to reduce latency and improve speed.

4. **CDN Activation and Configuration**
   - 4.1. CDN activation for the primary domain (`beelzebot.com`).
   - 4.2. Activating the CDN for the backend (`api.beelzebot.com`).
   - 4.3. Cache policies in the CDN for dynamic and static data.
   - 4.4. Verifying cache status with `curl`.

5. **HTTP/2 and HTTP/3 Configuration**
   - 5.1. Enabling HTTP/2 in Uvicorn.
   - 5.2. Using a reverse proxy for HTTP/3 (NGINX or Caddy).
   - 5.3. SSL certificate configuration for HTTP/2 and HTTP/3.

6. **Backend Caching and Optimization**
   - 6.1. Using CDN caching for static responses.
   - 6.2. Backend caching implementation with Redis and FastAPI.
   - 6.3. Strategies to bypass caching for dynamic endpoints.

7. **Security and Best Practices**
   - 7.1. HTTPS for both frontend and backend.
   - 7.2. CDN security configuration (DDoS protection).
   - 7.3. Enabling Keep-Alive for persistent connections.

---

# 📘 **1. DNS Configuration and Diagnostics**

## 1.1 **Troubleshooting slow DNS resolution**
Slow DNS resolution occurs when there is a delay in converting the domain name (e.g., `api.beelzebot.com`) into its corresponding IP address. This can result in slow page loads, delays in API requests, and degraded user experience.

### **Causes of slow DNS resolution**
- **DNS Propagation Issues**: Changes to DNS records may take time (24-72 hours) to propagate across the internet.
- **Multiple A Records**: If a domain points to multiple IPs, DNS servers may take longer to select the correct one.
- **High TTL (Time To Live)**: If the DNS record has a high TTL, servers keep outdated IPs cached for longer.
- **Slow DNS Provider**: If your DNS provider (like SiteGround) is slow, it will take longer to resolve the IP.

### **How to identify slow DNS resolution**
1. Use tools like `nslookup`, `dig`, or **dnschecker.org** to see if the IP resolution is delayed.
2. Check if the propagation of the domain is complete using **dnschecker.org**.
3. Identify if the DNS server being used is caching an old IP address.

---

## 1.2 **Verification of A records**
An A record (Address Record) maps a domain name to an IPv4 address. It is essential to ensure that **only one IP address** is associated with the domain to avoid confusion or delays in resolution.

### **How to verify A records**
- **Using SiteGround**: 
  - Access the **SiteGround DNS Zone Editor**.
  - Verify that the A record for `api.beelzebot.com` points to the correct IP (`16.16.213.253`).
  - Remove any extra IPs associated with this record.
  
- **Using Online Tools**: 
  - Use **dnschecker.org** to verify if only the correct IP is listed.
  
- **Command-line tools**:
  - Use `nslookup api.beelzebot.com` to check if multiple IPs are listed.
  - Use `dig api.beelzebot.com +trace` to trace DNS lookup from root servers to authoritative DNS servers.

### **What to look for**
- Make sure only one IP is listed for the A record.
- Verify that the IP is correct and points to the **AWS EC2 instance**.

---

## 1.3 **DNS propagation checks**
DNS propagation refers to the process where DNS changes (like updating the A record) are distributed globally to all DNS servers.

### **Why DNS propagation matters**
When a new A record is added or modified, it takes time for DNS servers around the world to recognize the change. During this period, users may receive incorrect IP addresses, leading to slower page loads or failed connections.

### **How to check DNS propagation**
- **Online Tools**: 
  - Use [dnschecker.org](https://dnschecker.org) to view the DNS status for different global locations.
  
- **Manual Verification**:
  - Use `nslookup api.beelzebot.com` or `dig api.beelzebot.com` to check the IP your system resolves to.
  
### **Common issues with DNS propagation**
- **Partial propagation**: Some servers may have updated IPs while others still cache the old IP.
- **Cached entries**: Browsers, ISPs, and local networks cache DNS entries and may not recognize the new IP.

---

## 1.4 **Setting TTL to improve response times**
The TTL (Time To Live) defines how long a DNS server should cache an IP address for a domain. A high TTL means slower updates after DNS changes, while a low TTL ensures faster updates.

### **Recommended TTL values**
- **300 seconds (5 minutes)**: Ideal for development or when testing new configurations.
- **3600 seconds (1 hour)**: Good for production when DNS changes are rare.

### **How to configure TTL**
- **SiteGround DNS Zone Editor**:
  - Go to the DNS editor.
  - Look for the A record for `api.beelzebot.com`.
  - Change the TTL value to **300 seconds** to allow for quicker updates.
  
- **Check current TTL**:
  - Use `dig api.beelzebot.com` and check for the "ANSWER SECTION" to view the current TTL.

---

## 1.5 **Tools for DNS diagnostics**
Several tools can help diagnose DNS resolution issues and verify if DNS propagation is complete.

### **1. nslookup**
- **What it does**: Resolves a domain name to an IP address.  
- **How to use**: 
  - Run the command: `nslookup api.beelzebot.com`
  - The output should display the **server** being used and the **IP addresses**.  
  - If multiple IPs appear, you may have extra A records.  

### **2. dig**
- **What it does**: Provides a more detailed view of the DNS query and allows tracing the DNS lookup process.  
- **How to use**: 
  - Run: `dig api.beelzebot.com +trace`  
  - It will trace DNS lookup from root servers to authoritative DNS servers.  

### **3. dnschecker.org**
- **What it does**: Shows if DNS changes have propagated globally.  
- **How to use**: 
  - Go to [dnschecker.org](https://dnschecker.org).  
  - Enter `api.beelzebot.com` and check if the IP is consistent across locations.  

---

# 📘 **2. Using Public DNS (Google DNS and Others)**

## 2.1 **Local configuration of Google DNS for testing**
Using public DNS servers, like **Google DNS (8.8.8.8, 8.8.4.4)** or **Cloudflare DNS (1.1.1.1, 1.0.0.1)**, can improve DNS resolution speeds and avoid issues caused by slow ISP-provided DNS servers. This configuration is useful for testing, especially when you want to see if a new DNS record has propagated globally.

### **Why use Google DNS for testing?**
- **Faster resolution**: Google's DNS servers are globally distributed and faster than most ISP DNS servers.
- **Avoid cached results**: Some ISPs cache DNS entries for longer than necessary. Google DNS ensures up-to-date results.
- **Diagnose propagation issues**: If you update a DNS record and still see the old IP, using Google DNS avoids cached data.

---

### **How to configure Google DNS on different operating systems**

#### **Windows**
1. Open **Control Panel** > **Network and Sharing Center**.
2. Click on **Change adapter settings** on the left-hand side.
3. Right-click on the active connection (Wi-Fi or Ethernet) and select **Properties**.
4. Select **Internet Protocol Version 4 (TCP/IPv4)** and click **Properties**.
5. Select **Use the following DNS server addresses** and enter:
   - Preferred DNS server: **8.8.8.8**
   - Alternate DNS server: **8.8.4.4**
6. Click **OK** to save the changes.

#### **Linux**
1. Open the terminal.
2. Edit the file `/etc/resolv.conf` using a text editor:
   - Run: `sudo nano /etc/resolv.conf`
3. Add the following lines to the file:
   - nameserver 8.8.8.8
   - nameserver 8.8.4.4
4. Save and close the file.
5. Restart the network manager:
   - Run: `sudo systemctl restart NetworkManager`

#### **MacOS**
1. Open **System Preferences** > **Network**.
2. Select your active network (Wi-Fi or Ethernet) and click **Advanced**.
3. Go to the **DNS** tab.
4. Click the **+** button and add the following DNS addresses:
   - **8.8.8.8**
   - **8.8.4.4**
5. Click **OK** and then **Apply** to save the changes.

#### **Android**
1. Open **Settings** > **Wi-Fi**.
2. Tap and hold on the active Wi-Fi network and select **Modify network**.
3. Set **IP settings** to **Static**.
4. Scroll down and enter:
   - DNS 1: **8.8.8.8**
   - DNS 2: **8.8.4.4**
5. Save the changes.

#### **iOS (iPhone/iPad)**
1. Go to **Settings** > **Wi-Fi**.
2. Tap the **i** icon next to the active Wi-Fi network.
3. Scroll down to **DNS** and tap **Configure DNS**.
4. Select **Manual** and remove the existing DNS entries.
5. Add:
   - **8.8.8.8**
   - **8.8.4.4**
6. Tap **Save** to apply the changes.

---

### **How to verify if Google DNS is active**
- Run the following command on your device to check the DNS server in use:
  - **Windows**: `ipconfig /all`
  - **Linux/MacOS**: `cat /etc/resolv.conf`
  - **Android/iOS**: Verify DNS in **Wi-Fi settings**.

- Check if the DNS server listed is **8.8.8.8** or **8.8.4.4**.

---

## 2.2 **Limitations of this solution for end users**
While configuring Google DNS is helpful for local testing, it is **not a solution for end users**. Here’s why:

### **Why it is not a good idea for end users**
1. **Users won't modify their DNS settings**:
   - It is unrealistic to expect end users to configure their devices to use Google DNS. Most users rely on their ISP's default DNS.

2. **Limited control over user networks**:
   - Since end users use various ISPs with their own DNS caching rules, there is no way to enforce DNS changes on the client side.

3. **Not a global solution**:
   - Even if you configure Google DNS on your system, users in other countries or regions may continue using ISP-provided DNS.

---

### **What to do instead?**
1. **Use a CDN (like Cloudflare or AWS CloudFront)**:
   - CDNs have a globally distributed DNS infrastructure, ensuring faster DNS resolution for all users.
   - By enabling a CDN for your backend (like `api.beelzebot.com`), users are connected to the closest server.

2. **Reduce the TTL (Time To Live) of your DNS records**:
   - This ensures that all DNS changes propagate quickly across global servers.
   - Configure a TTL of **300 seconds (5 minutes)** for your A records in SiteGround.

3. **Use Cloudflare DNS (1.1.1.1) as a DNS resolver for your domain**:
   - If your current DNS provider (like SiteGround) is slow, use **Cloudflare DNS** to manage DNS globally.
   - Cloudflare has faster DNS resolution and better caching rules than most ISPs.

---

# 📘 **3. Infrastructure and Speed Optimization**

## 3.1 **Infrastructure Evaluation**
To understand how to optimize speed, it is essential to evaluate the current infrastructure and identify potential bottlenecks. The infrastructure currently consists of the following components:

- **Frontend**: Hosted on **SiteGround** in **Texas, USA**.  
- **Backend**: Hosted on an **AWS EC2 instance** in **Stockholm, Sweden**.  
- **User Location**: The user is in **Iceland**.

This setup introduces potential latency due to the geographic distance between the user, frontend, and backend.

---

### **Flow of a User Request**
1. **User in Iceland** makes a request to **beelzebot.com**.  
2. **beelzebot.com** is hosted on **SiteGround Texas**, so the request travels from Iceland to Texas.  
3. The frontend at SiteGround makes a request to the backend **api.beelzebot.com**, which is located on **AWS EC2 in Stockholm, Sweden**.  
4. The response from the backend is returned to SiteGround, and then SiteGround returns it to the user in Iceland.  

This flow introduces unnecessary network hops, especially between **Texas and Stockholm**, and can be optimized.

---

## 3.2 **Factors Affecting Speed**
Several factors contribute to the speed and performance of the current infrastructure. Each of these factors can be optimized.

### **1. Latency**
- **Problem**: The physical distance between Iceland, Texas, and Stockholm introduces network delays.  
- **Solution**: Use a **CDN (Content Delivery Network)** to serve content from servers closer to the user.  

### **2. Number of network hops**
- **Problem**: Requests from the frontend (Texas) to the backend (Stockholm) introduce additional delays.  
- **Solution**: Use a **reverse proxy** at SiteGround or enable **AWS Global Accelerator** to reduce the number of hops.  

### **3. TLS/SSL Handshake**
- **Problem**: TLS handshake occurs every time a new connection is made, which can take 100-300ms.  
- **Solution**: Enable **HTTP/2** to reuse connections and avoid renegotiating TLS for every request.  

### **4. DNS Resolution**
- **Problem**: Slow DNS lookup can add 200-500ms of delay if the record is not cached properly.  
- **Solution**: Use **Cloudflare DNS** and **reduce TTL** for faster record propagation.  

### **5. Server response time**
- **Problem**: If the backend takes too long to process a request, it adds to the overall response time.  
- **Solution**: Implement **caching** at multiple levels (CDN, backend, and database) to reduce the load.  

### **6. File size and payload**
- **Problem**: Large payloads (like JSON responses) take longer to transfer.  
- **Solution**: Enable **Gzip or Brotli compression** on SiteGround and the backend.  

---

## 3.3 **Best Configurations to Reduce Latency and Improve Speed**
To improve the speed of the infrastructure, the following configurations are recommended. These changes address the primary issues of latency, unnecessary hops, and long DNS lookups.

---

### **1. Enable a CDN for the Frontend and Backend**
A **CDN (Content Delivery Network)** stores copies of static files (like HTML, CSS, JavaScript) in multiple locations worldwide. When a user from Iceland makes a request, they are connected to a nearby server (not necessarily Texas). This reduces the latency caused by long-distance connections.  

#### **How to implement it**
- Enable **Cloudflare CDN** for **beelzebot.com** and **api.beelzebot.com**.  
- In **SiteGround**, go to the **CDN section** and activate the CDN for these subdomains.  
- Ensure the CDN is caching static assets (CSS, JS) and that only dynamic API calls are sent to the backend.  

#### **Benefits**
- Faster load times for users in Iceland, as they will be connected to the closest CDN server.  
- Fewer requests need to travel to SiteGround Texas, reducing overall latency.  

---

### **2. Use a Reverse Proxy for the Backend**
Instead of allowing the frontend to call **api.beelzebot.com** directly, a **reverse proxy** can reduce the network hops. By adding a reverse proxy at **SiteGround**, requests from the frontend to the backend will be routed internally, rather than forcing them to go from Texas to Sweden.  

#### **How to implement it**
- Configure **SiteGround** to act as a **reverse proxy** for **api.beelzebot.com**.  
- Requests will be sent to **localhost:8000** instead of routing them to AWS EC2.  
- Alternatively, use **NGINX** as a proxy for both SiteGround and AWS EC2.  

#### **Benefits**
- Reduced network hops (request stays internal between SiteGround and EC2).  
- Faster response times because requests don’t have to travel long distances.  

---

### **3. Use AWS Global Accelerator**
AWS Global Accelerator optimizes the path from the user's device to AWS by using AWS’s global edge locations. This ensures that users from Iceland are connected to the closest AWS edge location, which then routes the request to **EC2 Stockholm**.  

#### **How to implement it**
- In the AWS Management Console, configure **Global Accelerator** for your EC2 instance.  
- Attach an **Elastic IP** to the instance.  
- Route **api.beelzebot.com** through **Global Accelerator**, so users always connect to the nearest edge location.  

#### **Benefits**
- Reduces latency for users accessing the backend API.  
- Uses AWS’s internal network, which is faster than public internet routing.  

---

### **4. Enable HTTP/2 or HTTP/3**
HTTP/2 and HTTP/3 allow **multiple requests** to be sent in a single connection, unlike HTTP/1.1, which requires multiple TCP connections. This is crucial to avoid repeated TLS negotiations.  

#### **How to implement it**
- For **HTTP/2**:  
  - In **Uvicorn**, enable HTTP/2 by specifying the **h11** protocol.  
  - Run the server with the following options:  
    - http="h11"  
    - ssl_keyfile="path/to/key.pem"  
    - ssl_certfile="path/to/cert.pem"  

- For **HTTP/3**:  
  - Use **NGINX or Caddy** as a proxy.  
  - Configure it to support **QUIC/HTTP3**.  

#### **Benefits**
- Faster request processing and reuse of connections.  
- No need to renegotiate TLS connections.  

---

### **5. Use Cache at Multiple Levels**
To speed up requests and reduce backend load, use **caching** at multiple levels:  
- **CDN cache**: Cache responses at Cloudflare to avoid hitting the backend for every request.  
- **Redis or Memcached**: Store frequently used data in Redis to avoid hitting the database.  
- **FastAPI cache**: Use FastAPI's in-memory cache for frequently accessed endpoints.  

#### **How to implement it**
- Use **Redis** as a caching layer in the backend (FastAPI).  
- Use Cloudflare cache rules to cache API responses.  
- Use FastAPI middleware to cache specific endpoints.  

#### **Benefits**
- Faster API responses since data is fetched from cache.  
- Reduces CPU usage and load on the backend (EC2).  

---

### **6. Optimize DNS Configuration**
Slow DNS lookups can cause delays in the initial connection.  
To fix this:  
- Reduce **TTL** on SiteGround to **300 seconds**.  
- Use **Cloudflare DNS** (1.1.1.1) instead of SiteGround DNS for faster lookups.  
- Use **Google DNS (8.8.8.8)** locally to avoid using slow ISP-provided DNS servers.  

#### **Benefits**
- Faster DNS lookups, which means faster page loads.  
- Ensures users get the most up-to-date IP addresses after a DNS change.  

---

## 📜 **Summary of Improvements**
| **Action**          | **Solution**                | **Benefit**                  |
|---------------------|----------------------------|------------------------------|
| **Use CDN**         | Cloudflare for `beelzebot.com` | Serve static content faster  |
| **Use Reverse Proxy**| Proxy for `api.beelzebot.com` | Fewer network hops          |
| **Use Global Accelerator** | AWS Global Accelerator    | Route traffic faster         |
| **Enable HTTP/2**    | Run Uvicorn with HTTP/2      | Faster API requests          |
| **Enable Cache**     | Redis, Cloudflare cache      | Faster response times        |
| **Optimize DNS**     | Cloudflare DNS, lower TTL    | Faster DNS lookups           |


---

# 📘 **4. CDN Activation and Configuration**

## 4.1 **CDN activation for the primary domain (`beelzebot.com`)**
A **CDN (Content Delivery Network)** is a system of distributed servers that delivers web content to users based on their geographical location. By activating a CDN for `beelzebot.com`, you ensure that static files like **HTML, CSS, JavaScript, and images** are delivered from servers closest to the user.

### **Why activate a CDN for `beelzebot.com`?**
- **Faster load times**: Users connect to the closest server rather than SiteGround in Texas.  
- **Reduced latency**: By serving files from locations close to Iceland, users will experience much faster load times.  
- **Improved scalability**: If traffic increases, the CDN can handle more concurrent users.  
- **Global availability**: Users from different parts of the world get the same fast experience.  

### **How to activate the CDN for `beelzebot.com`**
1. **Enable Cloudflare CDN in SiteGround**:
   - Log in to your SiteGround account.
   - Go to the **Site Tools** section for your domain.
   - Click on the **Speed** section, then **Cloudflare**.
   - Activate Cloudflare for `beelzebot.com`.

2. **Verify CDN status**:
   - Use **dnschecker.org** to ensure the CNAME record points to Cloudflare.  
   - Check that **Cloudflare Proxy (orange cloud icon)** is enabled.  

3. **Test with curl or browser**:
   - Check the response headers for **cf-cache-status: HIT**.  
   - If you see **cf-cache-status: MISS**, it means the file was not served from the cache.  

4. **Optional configurations**:
   - **Cache static files**: Enable caching for static assets like JavaScript, CSS, and images.  
   - **Force HTTPS**: Ensure all requests to **http://beelzebot.com** are redirected to **https://beelzebot.com**.  

---

## 4.2 **Activating the CDN for the backend (`api.beelzebot.com`)**
Unlike the frontend, the backend requires careful configuration to ensure dynamic API calls are not cached incorrectly. Activating a CDN for **api.beelzebot.com** ensures that requests from users in Iceland are routed to the closest server, reducing the time to establish a connection.

### **Why activate a CDN for `api.beelzebot.com`?**
- **Faster API responses**: Requests are routed to the closest server, reducing connection time.  
- **Reduced latency**: User requests don't have to travel to Stockholm.  
- **Security**: Cloudflare CDN acts as a shield, protecting your EC2 instance from DDoS attacks.  

### **How to activate the CDN for `api.beelzebot.com`**
1. **Add DNS record for `api.beelzebot.com`**:
   - Log in to SiteGround.  
   - Go to **Site Tools** > **DNS Zone Editor**.  
   - Add a **CNAME record** or **A record** pointing `api.beelzebot.com` to the IP address of your AWS EC2 instance.  

2. **Enable Cloudflare CDN**:
   - Go to **SiteGround** > **CDN**.  
   - Activate the CDN for **api.beelzebot.com**.  
   - Ensure the orange Cloudflare icon is active (proxy is enabled).  

3. **Set Cache Rules for the Backend**:
   - By default, you should avoid caching dynamic responses from the backend.  
   - Use **Bypass Cache** rules for paths like `/api/*` where the data changes frequently.  

4. **Test CDN activation**:
   - Use **curl** to test if Cloudflare is being used.  
   - Check the response headers for **cf-cache-status: MISS or HIT**.  
   - Check if the **server header** shows Cloudflare as the proxy.  

5. **Optional configuration**:
   - **Use cache headers**: Control what gets cached by using the **Cache-Control** header in your API responses.  
   - **Rate limiting**: Limit how many requests a user can make to prevent abuse of the API.  

---

## 4.3 **Cache policies in the CDN for dynamic and static data**
When configuring a CDN, it's important to control how long content is stored in the cache. Cache policies define how the CDN handles **static** and **dynamic** data.

### **Static Data (HTML, CSS, JS, images)**
- **What to cache**: Static files like CSS, JavaScript, and images (PNG, JPG, GIF).  
- **Cache time**: These files change rarely, so they can be cached for **30 days or more**.  
- **How to implement**:
  - In **Cloudflare**, configure a **"Cache Everything"** rule for paths like `/static/*`.  
  - Set a **browser cache TTL** for these files (30 days or more).  

### **Dynamic Data (API responses)**
- **What not to cache**: API responses like JSON from `api.beelzebot.com`.  
- **Why?**: These responses change frequently, so caching them may cause outdated data to be served.  
- **How to bypass cache**:
  - Create a rule in Cloudflare to **Bypass Cache** for URLs like `/api/*`.  
  - Alternatively, configure the **Cache-Control: no-store** header in the API responses.  

---

## 4.4 **Verifying cache status with curl**
After activating the CDN, it’s essential to verify if the cache is working correctly. Here’s how to do it using **curl**.

### **How to verify the cache status**
1. **Run curl to request the resource**:
   - For the frontend:  
     curl -I https://beelzebot.com  
   - For the backend API:  
     curl -I https://api.beelzebot.com/api/v1/resource  

2. **Check the response headers**:
   - **cf-cache-status: HIT** — The file was served from Cloudflare's cache.  
   - **cf-cache-status: MISS** — The file was not in the cache and had to be fetched from the origin server.  
   - **server: cloudflare** — Indicates that the request was handled by Cloudflare.  

3. **Common issues**:
   - If **cf-cache-status: MISS** is always returned, it means that Cloudflare is not caching the content.  
   - Ensure caching rules are set for static content but bypass cache for API endpoints.  

---

## 📜 **Summary of CDN Configuration**
| **Action**              | **Solution**                          | **Benefit**                     |
|------------------------|----------------------------------------|-----------------------------------|
| **Enable CDN**          | Enable Cloudflare for `beelzebot.com`  | Faster delivery of static files  |
| **Use CDN for API**     | Enable Cloudflare for `api.beelzebot.com` | Faster API responses             |
| **Cache Static Files**  | Cache CSS, JS, images for 30 days     | Faster load times for users      |
| **Bypass Cache for API**| Bypass cache for `/api/*` endpoints   | Serve dynamic data correctly     |
| **Use Headers**         | Use `Cache-Control` and `ETag` headers| Better control of cache behavior|

---

## 📘 **5. Best Practices for CDN Usage**
- **Cache Static Files Aggressively**: Cache static files (CSS, JS) for at least **30 days**.  
- **Avoid Caching Dynamic Data**: Bypass cache for API responses (`/api/*`).  
- **Use Cache-Control Headers**: Control caching by sending headers like `Cache-Control: no-store`.  
- **Enable Gzip/Brotli Compression**: Compress HTML, CSS, and JS files to reduce payload size.  
- **Enforce HTTPS**: Redirect all traffic to HTTPS to protect user data and enable **HTTP/2**.  
- **Set a Low TTL**: Use a low TTL (300 seconds) for dynamic DNS records.  
- **Use Rate Limiting**: Protect the backend from DDoS attacks by limiting the number of requests.  

---

# 📘 **HTTP/2 and HTTP/3 Configuration**

## 5.1 **Enabling HTTP/2 in Uvicorn**
HTTP/2 allows multiple requests to be sent over a single TCP connection, unlike HTTP/1.1, where each request needs a new connection. This results in **faster load times**, **reduced latency**, and **better performance**.

### **Why enable HTTP/2?**
- **Multiplexing**: Multiple requests are processed simultaneously over a single TCP connection.  
- **Faster response times**: No need to create a new TCP connection for each request.  
- **Better performance**: Reduces the need for "connection pooling" and avoids "head-of-line blocking."  

---

### **How to enable HTTP/2 in Uvicorn**
1. **Install Uvicorn and required dependencies**:
   - Ensure you are using the latest version of Uvicorn.  
   - Make sure you have **h11** installed since Uvicorn uses **h11** to enable HTTP/2.  

2. **Generate SSL/TLS certificates**:
   - If you don’t have an SSL certificate, generate one using **Let's Encrypt** or create a self-signed certificate for development.  
   - Files required:  
     - **key.pem** (private key)  
     - **cert.pem** (SSL certificate)  

3. **Modify the `run.py` file to enable HTTP/2**:
   - Add `http="h11"` to specify the HTTP/2 protocol.  
   - Pass the **ssl_keyfile** and **ssl_certfile** parameters to enable HTTPS.  

4. **Example configuration in `run.py`**:
```python
   import uvicorn
   import signal
   import sys
   from loguru import logger

   def signal_handler(sig, frame):
       logger.info('Shutting down gracefully...')
       sys.exit(0)

   signal.signal(signal.SIGINT, signal_handler)

   if __name__ == "__main__":
       try:
           uvicorn.run(
               "app.main:app",
               host="0.0.0.0",
               port=8000,
               reload=True,
               ssl_keyfile="C:/certs/key.pem",
               ssl_certfile="C:/certs/cert.pem",
               http="h11"  # Enables HTTP/2 support
           )
       except KeyboardInterrupt:
           logger.info("Server stopped by user (Ctrl+C)")
       except ConnectionResetError as e:
           logger.warning(f"Connection was reset: {e}")
   ```

5. **Test if HTTP/2 is working**:
   - Use `curl --http2 -I https://api.beelzebot.com` to check if HTTP/2 is enabled.
   - Check for the **HTTP/2 200 OK** status.

## 5.2 Using a reverse proxy for HTTP/3 (NGINX or Caddy)
Unlike HTTP/2, **HTTP/3** is not directly supported by Uvicorn. To enable HTTP/3, 
you need to set up a reverse proxy using **NGINX** or **Caddy**. HTTP/3 is based on **QUIC** (UDP), 
making it faster for users on mobile and unstable networks.

### **Why enable HTTP/3?**
- **Faster load times**: Works over **UDP**, which is faster than TCP.
- **Zero-RTT**: Reduces connection setup time, even on the first request.
- **Improves mobile experience**: Better performance on mobile and flaky networks.

---

### How to enable HTTP/3 using NGINX
1. Install NGINX with QUIC/HTTP3 support:
   - Install the latest version of NGINX with HTTP/3 support.
   - You may need to compile NGINX with quiche or use a pre-built version.

2. Update NGINX configuration:
   - Add the following configuration to enable QUIC and HTTP/3.
   - Add the listen 443 quic reuseport directive to support HTTP/3.
   - Specify the ALPN protocols (h3-29, h2, http/1.1) to ensure backward compatibility.

```perl
   server {
      listen 443 ssl http2;
      listen [::]:443 ssl http2;
      listen 443 quic reuseport; 
      listen [::]:443 quic reuseport; 
      http3 on;

      server_name api.beelzebot.com;

      ssl_certificate /path/to/fullchain.pem;
      ssl_certificate_key /path/to/privkey.pem;

      ssl_protocols TLSv1.2 TLSv1.3;
      ssl_prefer_server_ciphers off;

      add_header Alt-Svc 'h3-29=":443"; ma=86400'; # HTTP/3 advertisement

      location / {
         proxy_pass http://127.0.0.1:8000;
         proxy_http_version 1.1;
         proxy_set_header Upgrade $http_upgrade;
         proxy_set_header Connection "upgrade";
         proxy_set_header Host $host;
      }
   }

```

3. **Restart NGINX**:
   - Run sudo systemctl restart nginx.

4. **Verify if HTTP/3 is enabled**:
- Use **curl** to check HTTP/3 support:
curl -v --http3 https://api.beelzebot.com
- Check if the request was handled using **HTTP/3**.
- Verify that **h3-29** or **h3** appears in the **Alt-Svc header**.





### **How to enable HTTP/3 using Caddy**
Caddy is an easier alternative to NGINX, as it supports HTTP/3 out of the box.

1. **Install Caddy**:
   -  Download and install Caddy on your server.

2. **Configure Caddy to enable HTTP/3**:
```css
api.beelzebot.com {
    reverse_proxy 127.0.0.1:8000

    tls {
        protocols tls1.2 tls1.3
        alpn http/1.1 h2 h3
    }
}
```

3. **Restart Caddy**:
   - Run sudo systemctl restart caddy.

4. **Verify if HTTP/3 is enabled**:
   - Use curl -v --http3 https://api.beelzebot.com to verify.
   - Check for Alt-Svc headers and h3-29 support.


## **5.3 SSL Certificate Configuration for HTTP/2 and HTTP/3**
To enable **HTTP/2** and **HTTP/3**, you must have a valid **SSL/TLS certificate**. The certificate ensures that connections are encrypted and prevents "man-in-the-middle" attacks.

### How to obtain an SSL/TLS certificate
   - Use **Let's Encrypt** to generate a free certificate for api.beelzebot.com.
   - Place the generated **key.pem** and **cert.pem** files on your server.

### How to configure SSL for Uvicorn (HTTP/2)
1. Pass the SSL certificate paths to **uvicorn.run()**:
   - ssl_keyfile: Path to the private key (key.pem).
   - ssl_certfile: Path to the SSL certificate (cert.pem).

2. **Example configuration for Uvicorn**:
```python
   uvicorn.run(
      "app.main:app",
      host="0.0.0.0",
      port=8000,
      ssl_keyfile="/path/to/key.pem",
      ssl_certfile="/path/to/cert.pem",
      http="h11"
   )
```
### How to configure SSL for NGINX (HTTP/3)
1. **Add SSL parameters to NGINX configuration**:
```vbnet
   ssl_certificate /path/to/fullchain.pem;
   ssl_certificate_key /path/to/privkey.pem;
   ssl_protocols TLSv1.2 TLSv1.3;
   ssl_prefer_server_ciphers off;
   
```
2. **Test SSL with online tools**:
   - Use SSL Labs to test SSL implementation.

## 📜 **Summary of HTTP/2 and HTTP/3 Configuration**

| **Feature**         | **Solution**                  | **Benefit**                    |
|---------------------|--------------------------------|----------------------------------|
| **HTTP/2**           | Enable in Uvicorn via h11      | Multiplex requests               |
| **HTTP/3**           | Use NGINX or Caddy as proxy    | Faster load times, Zero-RTT      |
| **SSL for Uvicorn**  | Add SSL certs in `run.py`      | Encrypts data in transit         |
| **SSL for NGINX**    | Configure cert in NGINX        | Supports TLS 1.2, 1.3            |


# 📘 **6. Backend Caching and Optimization**

## 6.1 **Using CDN Caching for Static Responses**
Caching static files at the CDN level reduces the number of requests that hit your backend, improving response time and overall performance. This is particularly useful for **CSS, JS, images, and other static files**.

### **Why cache static files at the CDN?**
- **Faster load times**: Files are served from the closest CDN location, not from SiteGround or AWS EC2.  
- **Reduced server load**: Your backend doesn't need to handle requests for static files.  
- **Global performance**: Users in any location get fast, consistent load times.  

### **What should be cached?**
- **CSS, JS, images, fonts, and static files**.  
- Any **file that rarely changes** (versioned assets like `main.js?v=1.2.3`).  

### **How to configure CDN caching**
1. **Enable Cloudflare caching for static files**:  
   - Log in to **Cloudflare** or **SiteGround** (if SiteGround uses Cloudflare as a CDN).  
   - Enable caching for file extensions like **.css, .js, .png, .jpg, .svg, .webp, .woff2, etc.**  
   - Set a **cache expiration** (TTL) of **30 days or more** for static files.  

2. **Verify caching**:
   - Use `curl -I https://beelzebot.com/static/file.js` to see if **cf-cache-status: HIT** is returned.  
   - If you see **cf-cache-status: MISS**, the file was not cached.  

3. **Best practices**:
   - Use **versioned file names** like `main.js?v=1.2.3` to force cache refreshes when the file changes.  
   - Enable **Brotli or Gzip compression** to reduce file size and speed up transfers.  

---

## 6.2 **Backend Caching with Redis and FastAPI**
Backend caching reduces database queries and improves response times. Instead of fetching the same data repeatedly, the backend stores results in a cache.

### **Why use Redis for backend caching?**
- **Faster responses**: Cached data is served instantly from memory.  
- **Reduces database load**: Instead of querying the database, results are fetched from Redis.  
- **Supports TTL (Time-to-Live)**: Cached results expire after a set time to prevent stale data.  

---

### **How to set up Redis for caching**
1. **Install Redis** on the AWS EC2 instance:
   - Run `sudo apt-get update && sudo apt-get install redis`.  
   - Start Redis with `sudo systemctl start redis`.  

2. **Install Redis client for Python**:
   - Install the Python library: `pip install redis`.  

3. **Connect Redis to FastAPI**:
   - Import Redis in your **FastAPI** project.  
   - Create a **Redis connection pool** and use it in your routes.  

4. **Example of Redis caching in FastAPI**:
```python
   if cached_data:
       return {"source": "cache", "data": cached_data.decode('utf-8')}
   
   # Simulate slow database query
   data = "This is fresh data from the database."
   redis_client.setex(cache_key, 60, data)  # Cache for 60 seconds
   return {"source": "database", "data": data}
```

5. **Best practices for Redis caching**:
- Set **TTL** to prevent stale data (for example, cache for 60 seconds).  
- Cache **only GET requests** (POST, PUT, DELETE should not use cached data).  
- Cache large, frequently accessed queries like **API results, charts, or large lists**.  

---

## 6.3 **Strategies to Bypass Caching for Dynamic Endpoints**
While caching can greatly improve performance, there are some cases where caching must be bypassed. For example, **dynamic endpoints** (like APIs that return user-specific data) should not use cache.

---

### **When should you bypass caching?**
- **Dynamic data**: If the response depends on user-specific data (e.g., user balance, user dashboard).  
- **Authentication requests**: Never cache authentication requests to prevent sensitive data from being leaked.  
- **POST, PUT, DELETE requests**: These modify data and should never be cached.  

---

### **How to bypass cache in Cloudflare (CDN)**
1. **Create Cache Rules for Dynamic URLs**:
- Go to **Cloudflare Rules**.  
- Create a rule for **api.beelzebot.com/api/***.  
- Set **Cache Level: Bypass** for this path.  

2. **Use Cache-Control headers in FastAPI**:
- Send headers like `Cache-Control: no-store` to force Cloudflare to bypass cache.  
- Example of how to send this in FastAPI:  
  ```
  from fastapi import FastAPI, Response

  app = FastAPI()

  @app.get("/dynamic-data")
  async def dynamic_data(response: Response):
      response.headers["Cache-Control"] = "no-store"
      return {"message": "This is dynamic data"}
  ```

---

### **How to bypass cache in Redis**
1. **Use cache keys that include user-specific information**:  
- Instead of caching data with a general key like `user:profile`, include the **user ID** in the cache key:  
  `user:profile:12345`  

2. **Use dynamic cache keys** for specific requests:  
- Example: For user data at `/profile/123`, the cache key should be `profile:123`.  

3. **Clear cache on data changes**:  
- When a user updates their profile, clear the cache entry:  
  `redis_client.delete("profile:123")`  

---

### **Best practices for bypassing cache**
- Use **ETags** or **Last-Modified headers** to tell the client if the resource has changed.  
- For dynamic user-specific data, avoid general keys like `user:data`. Use `user:data:{user_id}` instead.  
- Make sure Cloudflare is not caching API responses that change frequently.  

---

## 📜 **Summary of Caching and Optimization**

| **Action**              | **Solution**                        | **Benefit**                     |
|------------------------|-------------------------------------|----------------------------------|
| **CDN Cache**           | Cache static files (CSS, JS, images) | Faster load times, reduced server load |
| **Redis Caching**       | Use Redis for caching API responses | Faster response times, less DB load |
| **Bypass Cache**        | Use Cache-Control: no-store header   | Prevent outdated dynamic data  |
| **Cache-Control Header**| Set Cache-Control on FastAPI routes | Control which routes are cached |
| **Bypass CDN Cache**    | Set Cloudflare bypass cache rule    | Ensure dynamic API data is fresh |

---

## 📘 **Best Practices for Caching and Optimization**
- **Use CDN Cache**: Cache static files for 30 days or more using Cloudflare.  
- **Avoid Caching Dynamic Data**: Avoid caching user-specific data like **user profile, balance, dashboard**.  
- **Use Redis Caching for API Data**: Cache API calls that have a high read frequency (like price data).  
- **Set Cache TTLs**: Set appropriate **TTL (time-to-live)** values for Redis and Cloudflare.  
- **Control API Cache Using Headers**: Use headers like `Cache-Control: no-store` or `ETag` to manage cache freshness.  
- **Use Versioned Static Files**: Use versioning for static files (like `main.js?v=2.0.1`) to prevent stale cache issues.  
- **Monitor Cache Usage**: Monitor **Redis memory usage** to avoid overloading Redis with unnecessary data.  

---




# 📘 **7. Security and Best Practices**

## 7.1 **IP Whitelisting and Restriction**
IP whitelisting restricts access to your backend to specific IP addresses. This is useful to control which users, servers, or services can connect to your backend.

### **Why use IP whitelisting?**
- **Restrict unauthorized access**: Only approved IPs can access the backend.  
- **Prevent DDoS attacks**: Requests from unknown IPs are automatically blocked.  
- **Enhanced security**: Blocks requests from IPs that are not on the "allowlist."  

---

### **How to configure IP whitelisting in AWS Security Groups**
1. **Access AWS Security Groups**:
   - Log in to AWS.  
   - Go to **EC2 Dashboard** > **Security Groups**.  

2. **Add a security rule to allow access**:
   - Select the security group attached to your **EC2 instance**.  
   - Add a new inbound rule:  
     - **Type**: Custom TCP Rule  
     - **Port Range**: 8000 (or the port your API listens on)  
     - **Source**: Your allowed IP address (e.g., **157.97.6.174/32** for a single IP).  

3. **Test the connection**:
   - Try accessing your API from the allowed IP.  
   - Verify that requests from other IPs are blocked.  

---

### **How to configure IP whitelisting in FastAPI**
1. **Use a middleware to check the client IP**.  
2. **Reject requests** from IPs not in the allowed list.  
3. **Example of IP whitelisting middleware**:

```python
   from fastapi import FastAPI, Request, HTTPException

   app = FastAPI()

   ALLOWED_IPS = ["157.97.6.174", "34.174.168.65"]

   @app.middleware("http") async def ip_whitelisting_middleware(request: Request, call_next): client_ip = request.client.host if client_ip not in ALLOWED_IPS: raise HTTPException(status_code=403, detail="Forbidden") return await call_next(request)
```


---

## 7.2 **Rate Limiting**
Rate limiting controls how many requests a user can make to the backend in a given period. This prevents abuse and ensures **fair usage**.

### **Why use rate limiting?**
- **Prevent abuse**: Blocks users who make too many requests.  
- **Protect against DDoS attacks**: Limits the number of requests from a single IP.  
- **Improve stability**: Prevents server overload caused by excessive requests.  

---

### **How to implement rate limiting**
1. **Use Cloudflare Rate Limiting**:
- Log in to Cloudflare.  
- Go to **Security** > **Tools** > **Rate Limiting**.  
- Create a rule to **allow only 100 requests per minute** for `/api/*` paths.  

2. **Use FastAPI middleware for rate limiting**:
- Install the `slowapi` library:  
  pip install slowapi  

- **Example of rate limiting with FastAPI**:
  ```
  from fastapi import FastAPI, Request
  from slowapi import Limiter
  from slowapi.util import get_remote_address

  app = FastAPI()
  limiter = Limiter(key_func=get_remote_address)

  @app.get("/api/endpoint")
  @limiter.limit("100/minute")
  async def endpoint(request: Request):
      return {"message": "This is a rate-limited endpoint"}
  ```

3. **Monitor rate limits**:
- Use logs to track blocked IPs.  
- Adjust limits as needed to prevent false positives.  

---

## 7.3 **CORS (Cross-Origin Resource Sharing)**
CORS controls which domains are allowed to send requests to your backend.

### **Why configure CORS?**
- **Prevent unauthorized domains** from sending requests to your backend.  
- **Control cross-origin requests** from browsers.  
- **Restrict frontend-backend access** to trusted domains.  

---

### **How to configure CORS in FastAPI**
1. **Install CORSMiddleware**:
- Install it with pip:  
  pip install fastapi  

2. **Add CORSMiddleware to FastAPI**:
```python
   from fastapi import FastAPI from fastapi.middleware.cors import CORSMiddleware

   app = FastAPI()

   app.add_middleware( CORSMiddleware, allow_origins=["https://beelzebot.com"], allow_credentials=True, allow_methods=[""], allow_headers=[""], )
```


3. **Best practices for CORS**:
- **Restrict allow_origins** to only trusted domains.  
- Do not use `allow_origins=["*"]` in production, as it allows all domains.  

---

## 7.4 **SSL/TLS Encryption**
SSL (Secure Sockets Layer) encrypts data between the browser and the server, preventing **MITM (man-in-the-middle) attacks**.

### **Why use SSL/TLS?**
- **Encrypts all traffic** between client and server.  
- **Prevents data interception** (passwords, tokens, and user data).  
- **SEO benefits**: Google ranks HTTPS sites higher than HTTP sites.  

---

### **How to enable SSL in FastAPI**
1. **Get an SSL certificate**:
- Use **Let's Encrypt** for free certificates.  
- Generate a **key.pem** and **cert.pem** for your domain.  

2. **Configure Uvicorn to use SSL**:
```python
   import uvicorn

   if name == "main": uvicorn.run( "app.main:app", host="0.0.0.0", port=8000, ssl_keyfile="/path/to/key.pem", ssl_certfile="/path/to/cert.pem" )
```


---

## 7.5 **Security Headers**
Adding security headers to HTTP responses protects against **XSS, clickjacking, and data leaks**.

### **Important security headers**
- **Strict-Transport-Security (HSTS)**: Forces HTTPS connections only.  
- **Content-Security-Policy (CSP)**: Prevents inline scripts from running.  
- **X-Frame-Options**: Prevents clickjacking attacks.  
- **X-Content-Type-Options**: Prevents browsers from interpreting files as a different MIME type.  

---

### **How to add security headers in FastAPI**
1. **Add headers in FastAPI responses**:
```python
   from fastapi import FastAPI, Response

   app = FastAPI()

   @app.middleware("http") async def add_security_headers(request, call_next): response = await call_next(request) response.headers["Strict-Transport-Security"] = "max-age=63072000; includeSubDomains" response.headers["Content-Security-Policy"] = "default-src 'self'" response.headers["X-Frame-Options"] = "DENY" response.headers["X-Content-Type-Options"] = "nosniff" return response
```


---

## 📜 **Summary of Security and Best Practices**

| **Feature**            | **Solution**                          | **Benefit**                     |
|------------------------|----------------------------------------|-----------------------------------|
| **IP Whitelisting**    | Restrict access to known IPs only      | Prevent unauthorized access       |
| **Rate Limiting**      | Limit 100 requests per minute          | Avoid DDoS attacks, limit abuse   |
| **CORS**               | Restrict to trusted domains only       | Block unauthorized cross-origin requests |
| **SSL/TLS**            | Use HTTPS (Let's Encrypt certificate)  | Encrypts data in transit          |
| **Security Headers**   | Add HSTS, CSP, X-Frame-Options headers | Protect against XSS, clickjacking |

---

## 📘 **Best Practices for Backend Security**
- **Use IP whitelisting**: Restrict access to known IPs.  
- **Enable HTTPS**: Always use **SSL/TLS** for encrypted connections.  
- **Limit login attempts**: Lock accounts after too many failed logins.  
- **Implement rate limiting**: Limit the number of API requests.  
- **Add security headers**: Use **Strict-Transport-Security, X-Frame-Options, CSP, X-Content-Type-Options**.  
- **Keep dependencies updated**: Regularly check for security patches for FastAPI, Uvicorn, and Python libraries.  
- **Enable logging**: Log all failed login attempts and suspicious activity.  
- **Protect against injection attacks**: Use parameterized queries for SQL statements.  

---






