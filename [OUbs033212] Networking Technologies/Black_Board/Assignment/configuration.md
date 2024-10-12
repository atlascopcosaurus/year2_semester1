To configure each of the devices for the **Cytonn Innovation Ltd** project in Cisco Packet Tracer, I'll walk you through the configuration of key devices step by step. We'll cover:

1. **Core Switches** (with HSRP and VLANs)
2. **Distribution Layer** (with VLANs and routing)
3. **Cisco ASA Firewalls** (with inside, outside, DMZ zones)
4. **Access Layer Switches** (with VLANs and basic security features)
5. **DHCP Servers**
6. **Wireless LAN Controllers and Access Points**
7. **VoIP Gateway and Phones**
8. **Redundant Internet Connectivity via two ISPs**

Let’s start step by step with each component. I'll give you the CLI configuration that you can paste into the devices on Cisco Packet Tracer.

---

### 1. **Core Switches Configuration (HSRP and VLANs)**

We will configure the core switches for redundancy using **HSRP**, VLANs, and inter-VLAN routing.

#### **Core Switch 1** (Primary)
```plaintext
enable
configure terminal
hostname CoreSwitch1

! Create VLANs for different departments
vlan 10
 name Management
vlan 20
 name LAN
vlan 50
 name WLAN
vlan 70
 name VoIP
vlan 199
 name Blackhole

! Assign IP addresses to the VLAN interfaces for inter-VLAN routing
interface vlan 10
 ip address 192.168.10.2 255.255.255.0
 standby 1 ip 192.168.10.1
 standby 1 priority 110
 standby 1 preempt

interface vlan 20
 ip address 172.16.0.1 255.255.0.0
 standby 2 ip 172.16.0.254
 standby 2 priority 110
 standby 2 preempt

interface vlan 50
 ip address 10.20.0.1 255.255.0.0
 standby 3 ip 10.20.0.254
 standby 3 priority 110
 standby 3 preempt

interface vlan 70
 ip address 172.30.0.1 255.255.0.0
 standby 4 ip 172.30.0.254
 standby 4 priority 110
 standby 4 preempt

! Configure trunk links to distribution switches
interface range gigabitEthernet 0/1 - 2
 switchport mode trunk
 switchport trunk allowed vlan 10,20,50,70,199

! Enable OSPF for inter-VLAN routing
router ospf 1
 network 192.168.10.0 0.0.0.255 area 0
 network 172.16.0.0 0.0.255.255 area 0
 network 10.20.0.0 0.0.255.255 area 0
 network 172.30.0.0 0.0.255.255 area 0

! Save Configuration
end
write memory
```

#### **Core Switch 2** (Secondary)
```plaintext
enable
configure terminal
hostname CoreSwitch2

! Create VLANs for different departments
vlan 10
 name Management
vlan 20
 name LAN
vlan 50
 name WLAN
vlan 70
 name VoIP
vlan 199
 name Blackhole

! Assign IP addresses to the VLAN interfaces for inter-VLAN routing
interface vlan 10
 ip address 192.168.10.3 255.255.255.0
 standby 1 ip 192.168.10.1
 standby 1 priority 100
 standby 1 preempt

interface vlan 20
 ip address 172.16.0.2 255.255.0.0
 standby 2 ip 172.16.0.254
 standby 2 priority 100
 standby 2 preempt

interface vlan 50
 ip address 10.20.0.2 255.255.0.0
 standby 3 ip 10.20.0.254
 standby 3 priority 100
 standby 3 preempt

interface vlan 70
 ip address 172.30.0.2 255.255.0.0
 standby 4 ip 172.30.0.254
 standby 4 priority 100
 standby 4 preempt

! Configure trunk links to distribution switches
interface range gigabitEthernet 0/1 - 2
 switchport mode trunk
 switchport trunk allowed vlan 10,20,50,70,199

! Enable OSPF for inter-VLAN routing
router ospf 1
 network 192.168.10.0 0.0.0.255 area 0
 network 172.16.0.0 0.0.255.255 area 0
 network 10.20.0.0 0.0.255.255 area 0
 network 172.30.0.0 0.0.255.255 area 0

! Save Configuration
end
write memory
```

---

### 2. **Access Layer Switches Configuration**

Access layer switches connect the end devices to the network and handle VLAN assignments and basic port security features like **PortFast** and **BPDUguard**.

```plaintext
enable
configure terminal
hostname AccessSwitchX

! Create VLANs for department segregation
vlan 10
 name Management
vlan 20
 name LAN
vlan 50
 name WLAN
vlan 70
 name VoIP
vlan 199
 name Blackhole

! Configure trunk link to the core switches
interface gigabitEthernet 0/1
 switchport mode trunk
 switchport trunk allowed vlan 10,20,50,70,199

! Assign Access Ports to VLANs for end devices
interface range gigabitEthernet 0/2 - 10
 switchport mode access
 switchport access vlan 20
 spanning-tree portfast
 spanning-tree bpduguard enable

! Save Configuration
end
write memory
```

---

### 3. **ASA Firewall Configuration**

Configure the **ASA Firewall** with three zones: **outside**, **inside**, and **DMZ**. The firewall will handle NAT, access control, and static routing.

```plaintext
! Basic firewall configuration
enable
configure terminal
hostname ASA1

! Assign interfaces to zones
interface gigabitEthernet 0/0
 nameif outside
 security-level 0
 ip address 105.100.50.2 255.255.255.252
 no shutdown

interface gigabitEthernet 0/1
 nameif inside
 security-level 100
 ip address 192.168.10.254 255.255.255.0
 no shutdown

interface gigabitEthernet 0/2
 nameif dmz
 security-level 50
 ip address 10.11.11.1 255.255.255.224
 no shutdown

! Define static routes for internal and external traffic
route outside 0.0.0.0 0.0.0.0 105.100.50.1
route inside 172.16.0.0 255.255.0.0 192.168.10.1
route dmz 10.11.11.0 255.255.255.224 10.11.11.2

! Enable NAT
nat (inside,outside) dynamic interface

! Apply security policies
access-list OUTSIDE_IN extended permit tcp any any eq www
access-list OUTSIDE_IN extended permit tcp any any eq https
access-group OUTSIDE_IN in interface outside

! Save Configuration
end
write memory
```

---

### 4. **DHCP Server Configuration**

Configure DHCP on a dedicated server to provide dynamic IP addresses to all devices in the internal network.

```plaintext
enable
configure terminal
hostname DHCP_Server

! Configure DHCP for the LAN
ip dhcp pool LAN
 network 172.16.0.0 255.255.0.0
 default-router 172.16.0.1
 dns-server 192.168.10.10

! Configure DHCP for WLAN
ip dhcp pool WLAN
 network 10.20.0.0 255.255.0.0
 default-router 10.20.0.1
 dns-server 192.168.10.10

! Configure DHCP for VoIP
ip dhcp pool VoIP
 network 172.30.0.0 255.255.0.0
 default-router 172.30.0.1
 dns-server 192.168.10.10

! Save Configuration
end
write memory
```

---

Here’s the continuation of the network setup for **Cytonn Innovation Ltd** project. We will cover additional configurations for the **Wireless LAN Controller (WLC)**, **Lightweight Access Points (LAPs)**, **VoIP Gateway**, and the **SSH ACL** for secure remote management.

---

### 5. **Wireless LAN Controller (WLC) Configuration**

The **Wireless LAN Controller (WLC)** will manage all the Lightweight Access Points (LAPs) deployed in different departments. The WLC will handle WLAN configuration, security policies, and dynamic IP addressing for wireless devices.

```plaintext
enable
configure terminal
hostname WLC1

! Set the management interface for the WLC
interface vlan 50
 ip address 10.20.0.2 255.255.0.0
 no shutdown

! Define the Wireless LAN (WLAN) for employees and guests
wlan Employees 1
 ssid Employees_SSID
 security wpa wpa2
 authentication wpa-psk ascii Employee_Password123

wlan Guests 2
 ssid Guests_SSID
 security wpa wpa2
 authentication wpa-psk ascii Guest_Password123

! Set DHCP relay to the DHCP server
ip helper-address 192.168.10.10

! Apply to the physical interfaces (Ethernet port connected to core switch)
interface gigabitEthernet 0/0
 switchport mode access
 switchport access vlan 50
 no shutdown

! Save configuration
end
write memory
```

---

### 6. **Lightweight Access Points (LAPs) Configuration**

**Lightweight Access Points** (LAPs) are centrally managed by the WLC. They don’t require complex configuration since most of the configurations will be handled by the WLC.

To set up LAPs:

```plaintext
enable
configure terminal
hostname LAP1

! Configure basic settings for LAP
interface gigabitEthernet 0/0
 switchport mode access
 switchport access vlan 50
 no shutdown

! Define controller IP
wlc ip 10.20.0.2

! Save configuration
end
write memory
```

Repeat this configuration for each Lightweight Access Point (LAP) in the building.

---

### 7. **VoIP Gateway and IP Phone Configuration**

The **VoIP Gateway** enables communication between IP phones in the building using VLAN 70 for **VoIP**. The VoIP gateway connects to the Public Switched Telephone Network (PSTN) for external calls.

#### **VoIP Gateway Configuration**:

```plaintext
enable
configure terminal
hostname VoIP_Gateway

! Configure IP address for VoIP gateway in VLAN 70
interface vlan 70
 ip address 172.30.0.10 255.255.0.0
 no shutdown

! Define a dial-peer for internal VoIP calls
dial-peer voice 1000 voip
 destination-pattern 1...
 session target ipv4:172.30.0.10
 codec g711ulaw

! Define a dial-peer for external PSTN calls
dial-peer voice 2000 pots
 destination-pattern 9T
 port 0/0/0:15

! Save configuration
end
write memory
```

#### **IP Phone Configuration**:

1. Connect the **IP phones** to the access switches in the relevant department.
2. Assign VLAN 70 for **VoIP** communication on the switch ports.

```plaintext
enable
configure terminal
interface gigabitEthernet 0/2
 switchport mode access
 switchport access vlan 70
 no shutdown

! Save configuration
end
write memory
```

3. Configure the IP phone to automatically obtain its IP address from the DHCP server in VLAN 70.

---

### 8. **SSH ACL Configuration for Secure Remote Management**

To allow only the **Senior Network Security Engineer's PC** to access the core switches and firewalls via SSH, we will configure an ACL and apply it to the **VTY lines**.

#### **Core Switch 1**:

```plaintext
enable
configure terminal

! Define an access control list (ACL) to allow only the security engineer’s PC (e.g., 192.168.10.5)
access-list 10 permit 192.168.10.5

! Apply the ACL to VTY lines
line vty 0 4
 access-class 10 in
 transport input ssh
 login local
 password Cisco123

! Enable SSH on the device
ip domain-name cytonn.local
crypto key generate rsa
 modulus 1024

! Save configuration
end
write memory
```

Repeat the same configuration for **Core Switch 2** and the **ASA Firewall** with similar SSH ACL rules.

---

### 9. **Redundant ISP Configuration**

In this setup, Cytonn Innovation Ltd uses two ISPs for internet redundancy, **SEACOM** and **Safaricom**. We will configure static routes and load balancing for redundancy.

#### **ASA Firewall Configuration** (continued):

```plaintext
enable
configure terminal

! Define static routes for SEACOM and Safaricom ISPs
route outside 105.100.50.0 255.255.255.252 105.100.50.1
route outside 197.200.100.0 255.255.255.252 197.200.100.1

! Use equal-cost load balancing between the two ISPs
ip route 0.0.0.0 0.0.0.0 105.100.50.1
ip route 0.0.0.0 0.0.0.0 197.200.100.1

! Save configuration
end
write memory
```

This setup ensures that if one ISP connection fails, the other takes over seamlessly, providing continuous internet access.

---

### 10. **Final Testing Checklist**

- **HSRP** and **LACP** on core switches for redundancy and load balancing.
- **VLANs** are properly configured for each department.
- **Inter-VLAN routing** through OSPF.
- **ASA Firewall** zones and security rules are correctly applied.
- **Wireless connectivity** managed by the **WLC** with centralized control.
- **VoIP** services operational through the **VoIP Gateway** and IP phones.
- **SSH access** restricted to specific management PCs.
- **Redundant ISP connections** established for high availability.

---

This set of configurations will fully implement the network infrastructure for Cytonn Innovation Ltd based on the project requirements. Let me know if you need any specific adjustments or deeper insights into certain sections!


--- 

I didn’t explicitly provide a configuration for the **Cisco 2960-24TT switch in the DMZ** (DMZ-SW), but I can certainly help with that. The **DMZ-SW** in the Demilitarized Zone (DMZ) will connect the DMZ servers (like FTP, Web, Email, and NAS) to the network and isolate these servers from both the internal network and the outside world.

Here’s the proposed configuration for the **DMZ-SW**:

---

### **Cisco 2960-24TT DMZ-SW Configuration**

This switch will handle VLANs specific to the **DMZ zone** and connect to the firewall for controlled access to both the internal network (inside) and external network (outside).

```plaintext
enable
configure terminal
hostname DMZ-SW

! Create VLAN for the DMZ servers (VLAN 100 for DMZ)
vlan 100
 name DMZ_Servers

! Assign interfaces to VLAN 100 (DMZ Servers)
interface gigabitEthernet 0/1
 switchport mode access
 switchport access vlan 100
 description Connection to FTP Server

interface gigabitEthernet 0/2
 switchport mode access
 switchport access vlan 100
 description Connection to Web Server

interface gigabitEthernet 0/3
 switchport mode access
 switchport access vlan 100
 description Connection to Email Server

interface gigabitEthernet 0/4
 switchport mode access
 switchport access vlan 100
 description Connection to NAS Storage

! Trunk link to ASA Firewall
interface gigabitEthernet 0/24
 switchport mode trunk
 switchport trunk allowed vlan 100
 description Trunk to ASA Firewall DMZ Interface

! Basic Security Settings
spanning-tree portfast edge
spanning-tree bpduguard enable

! Save configuration
end
write memory
```

---

### **Explanation of Configuration**:
1. **VLAN 100 (DMZ)**: A dedicated VLAN is created for the DMZ servers. Each server (FTP, Web, Email, NAS) is connected to the switch via its own access port assigned to VLAN 100.
   
2. **Trunk Link to ASA Firewall**: The switch is connected to the **DMZ interface of the ASA Firewall** (on GigabitEthernet 0/24) using a trunk link. This allows the firewall to manage traffic between the DMZ and other zones (inside and outside).

3. **PortFast and BPDUguard**: These settings are applied to prevent potential loops and expedite the port status from blocking to forwarding for end devices (servers).

---

### **Connecting to the ASA Firewall**:
Ensure that the **ASA Firewall** has the appropriate configuration for its **DMZ interface** (as I mentioned earlier in the ASA configuration section). The **GigabitEthernet 0/2** interface on the firewall should be assigned to VLAN 100 and connected to the **DMZ-SW**.

---

This configuration secures the DMZ, allows it to interface with the firewall, and isolates DMZ traffic while enabling proper management of services like FTP, Web, and Email. Let me know if you need further adjustments or more specific configurations!

--- 

## Core-SW1 and Core-SW2

In your network design, the **core switches (Core-SW1 and Core-SW2)** are configured with **HSRP (Hot Standby Router Protocol)** to provide redundancy. If **Core-SW2** goes down, here’s what will happen, and how traffic will be handled:

### **1. HSRP for Gateway Redundancy**
HSRP creates a **virtual IP address** and **virtual MAC address** that act as the default gateway for devices on the network. Here’s how it ensures continuity:

- **Primary/Active Role**: In this case, **Core-SW1** has been configured with a higher priority (110) than **Core-SW2** (100). So, by default, **Core-SW1** will act as the **active router** (the primary default gateway) for all VLANs.
  
- **Standby Role**: **Core-SW2** acts as the **standby router**. If Core-SW1 goes down, Core-SW2 would take over the default gateway role for each VLAN.

- **Preemption**: Since **HSRP preemption** is enabled, Core-SW1 will automatically reclaim the active role once it comes back online after a failure.

#### **HSRP Configuration for VLAN 10 on Both Switches (example)**:
- **Core-SW1 (Active)**:
  ```plaintext
  interface vlan 10
   ip address 192.168.10.2 255.255.255.0
   standby 1 ip 192.168.10.1
   standby 1 priority 110
   standby 1 preempt
  ```
- **Core-SW2 (Standby)**:
  ```plaintext
  interface vlan 10
   ip address 192.168.10.3 255.255.255.0
   standby 1 ip 192.168.10.1
   standby 1 priority 100
   standby 1 preempt
  ```

In this scenario, if **Core-SW2** goes down, **Core-SW1** is already acting as the **active router**, so there will be no disruption in the network since **Core-SW1** continues to act as the default gateway.

### **2. EtherChannel and LACP for Redundant Links**
You are also using **EtherChannel** with **LACP (Link Aggregation Control Protocol)** for link redundancy and load balancing between the **core switches** and the **access/distribution layer switches**. This creates bundled links that ensure continuous connection even if one or more links fail.

#### **EtherChannel Example on Access Layer Switch**:
```plaintext
interface range gigabitEthernet 0/1 - 2
 channel-group 1 mode active
!
interface port-channel 1
 switchport mode trunk
 switchport trunk allowed vlan 10,20,50,70,199
```

If **Core-SW2** goes down, traffic will continue to flow through the **remaining links** that are connected to **Core-SW1**, ensuring there is no break in connectivity between the core and access layers.

### **3. OSPF Routing Redundancy**
You are using **OSPF** for routing between VLANs and external networks. If **Core-SW2** goes down, **OSPF** will automatically reroute traffic through **Core-SW1**.

- **OSPF** is designed to detect failures in adjacent routers and links. If **Core-SW2** fails, **OSPF** will immediately reconverge and reroute traffic through **Core-SW1**. This ensures that VLANs and external connectivity remain operational.

### **4. Impact on DMZ-SW and ASA Firewall**
The **DMZ-SW** is connected to the **ASA firewall** which is also dual-homed (connected to both **Core-SW1** and **Core-SW2**). Since the **ASA firewall** is connected to both core switches via **EtherChannel**, if **Core-SW2** goes down, all traffic will automatically be routed through **Core-SW1**.

### **Summary of Handling the Core-SW2 Shutdown**:
- **HSRP**: Ensures that **Core-SW1** remains as the active router for the network. No disruption in gateway availability occurs since **Core-SW1** is already the active router.
- **EtherChannel (LACP)**: If **Core-SW2** goes down, the **EtherChannel** automatically shifts all traffic to the **Core-SW1** links without interruption.
- **OSPF**: Routes are dynamically adjusted so that all traffic flows through **Core-SW1** if **Core-SW2** fails.
- **DMZ-SW and ASA**: Traffic from the **DMZ** will continue to flow through the **ASA firewall** to **Core-SW1**, ensuring uninterrupted access to DMZ resources.

### In Conclusion:
The network will **seamlessly continue to operate** if **Core-SW2** is shut down, with **Core-SW1** taking over all responsibilities. The combination of **HSRP**, **EtherChannel**, and **OSPF** provides **full redundancy** and ensures that there is no single point of failure in your design.

Let me know if you need further clarification or a specific scenario elaborated!