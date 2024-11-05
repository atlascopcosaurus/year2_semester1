Understanding DHCP and Its Functionality
========================================

Overview
--------

What is DHCP?
-------------

Components of DHCP
------------------

### 1\. DHCP Server: A server or router that stores network configuration information.

### 2\. DHCP Client: The device (e.g., computer, mobile) that receives configuration info from the server.

### 3\. DHCP Relay Agent: For networks with multiple LANs, this forwards DHCP requests to the server.

### 4\. IP Address Pool: A list of available IP addresses for assignment to clients.

### 5\. Subnet Mask: Indicates the network to which the host belongs.

### 6\. Lease Time: Duration for which the IP address is available to the client; it must be renewed after this time.

### 7\. Gateway Address: Informs the host where to connect to the internet.

How Does DHCP Work?
-------------------

### DHCP Discovery: The DHCP client broadcasts messages to find DHCP servers.

#### It sends a packet to the broadcast address (255.255.255.255) or a specific subnet address.

### DHCP Offer: Upon receiving a Discovery message, the DHCP server sends an Offer message with a proposed IP address and other details such as subnet mask and default gateway.

### DHCP Request: The client may receive multiple offers but will choose one and send a Request to that server, rejecting other offers.

### DHCP Acknowledgment: The server sends an Acknowledgment to confirm the lease of the IP address, completing the IP configuration.

Advantages of DHCP
------------------

### 1\. Easy implementation with automatic IP address assignment ensures accuracy.

### 2\. No manual configuration is needed, saving time for network administrators.

### 3\. Eliminates duplicate or invalid IP assignments, preventing conflicts.

### 4\. Mobile users benefit as they automatically acquire new configurations when changing networks.

Disadvantages of DHCP
---------------------

### 1\. Lack of secure client authentication can lead to unauthorized access and IP address depletion.

### 2\. A single DHCP server poses a risk of being a single point of failure in a network.