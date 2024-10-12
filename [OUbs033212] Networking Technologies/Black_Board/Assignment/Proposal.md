To design the "Secure Company Network System" in Cisco Packet Tracer, you would follow these key steps based on the provided network diagram:

1. **Network Topology Setup**:
   - **Core Switches**: You need to set up core switches with redundancy using Layer 3 switches that support protocols like HSRP (Hot Standby Router Protocol) and LACP (Link Aggregation Control Protocol) as seen in the image. Configure them for load balancing and failover.
   - **Distribution and Access Layers**: Create the connection between the core switches and access switches for different departments (Sales, HR, Finance, IT, etc.) across multiple floors.
   - **VLANs**: Define VLANs for each department as shown (e.g., VLAN 10 for Sales, VLAN 20 for HR, etc.). Assign corresponding IP ranges.
   - **Routing**: Configure the appropriate routing protocols (like OSPF or static routing) to ensure communication between different VLANs and with external networks.

2. **DMZ and Firewall Setup**:
   - Place the servers in the DMZ section as represented (WEB, EMAIL, APP, NAS/STORAGE servers).
   - Use firewalls to secure traffic between the internal network and the DMZ.

3. **Servers**:
   - Add different servers like DNS, FTP, and storage servers in the specified sections of the diagram.
   - Ensure that these servers are properly connected to the internal network via switches and VLANs.

4. **End Devices**:
   - Connect end-user devices (PCs, printers) in each department to the switches and assign them IP addresses based on their VLAN/subnet.
   - Use DHCP to dynamically assign IP addresses as indicated.

5. **External Network Access**:
   - Create external network links to branch offices (e.g., USA, China) and internet service providers (ISPs) using routers.
   - Use NAT and ACLs for securing external communication.

6. **Security Features**:
   - Implement Access Control Lists (ACLs) to manage traffic between departments and restrict access where needed.
   - Configure VPN or other secure protocols for remote users accessing the network.

7. **Wireless Network**:
   - Set up wireless access points (WAP) and controllers, as depicted in the design, to provide Wi-Fi access.

8. **Backup and Redundancy**:
   - Configure redundancy for core switches and servers using techniques like Active/Standby or LACP.
   - Use dual connections where applicable to avoid single points of failure.

### Tools in Cisco Packet Tracer:
- **Switches and Routers**: Use Layer 2/3 switches and routers to simulate core, distribution, and access layers.
- **Firewalls**: You can implement a basic firewall configuration for DMZ security.
- **VLANs**: Assign VLANs to ports based on department/segment needs.
- **End Devices**: Use PCs, laptops, and servers to populate the departments and test connectivity.
  
Once you set up the network, you can simulate traffic between departments, test ACLs, firewalls, and routing configurations to ensure the network works securely and efficiently.


---

For your **Cytonn Innovation Ltd** project, you will need to design and implement a secure, scalable, and redundant network architecture using **Cisco Packet Tracer**. Here are the key steps and considerations to align with the case study requirements:

### 1. **Hierarchical Network Design**
   - **Core Layer**: 
     - Deploy **multilayer switches** for both switching and routing.
     - Assign IP addresses to these multilayer switches to enable Inter-VLAN routing.
     - Use **HSRP** (Hot Standby Router Protocol) to ensure high availability and redundancy at the core layer.
     - Implement **OSPF** for routing between VLANs and to external networks.
  
   - **Distribution Layer**: 
     - Place **Cisco ASA Firewalls (5500-X series)** at this layer.
     - Establish connection redundancy by configuring dual paths between the core and distribution layers.

   - **Access Layer**: 
     - Use **Catalyst 2960 48-Port switches** for end-user devices, IP phones, and access points.
     - Enable **STP PortFast** and **BPDUguard** on access switches to ensure quick port transitions and prevent loops.
     - Configure VLANs for different departments (VLAN 10 for Management, VLAN 20 for LAN, VLAN 50 for WLAN, VLAN 70 for VoIP).

### 2. **VLAN and Subnetting**
   - Allocate IP ranges to VLANs:
     - **Management Network**: 192.168.10.0/24
     - **WLAN**: 10.20.0.0/16
     - **LAN**: 172.16.0.0/16
     - **VoIP**: 172.30.0.0/16
     - **DMZ**: 10.11.11.0/27
   - Use **subnetting** to divide these networks and efficiently manage the IP address space.

### 3. **Security and Firewalls**
   - **ASA Firewall**: 
     - Configure three zones: **outside (internet-facing)**, **inside (internal network)**, and **DMZ (server farm)**.
     - Place servers such as **FTP, Web, Email, APP, and NAS storage** in the DMZ.
     - Inside zone should include **DHCP, DNS, and AD servers**.
     - Define policies and ACLs on the ASA firewall to control access between zones.
     - Use **Static routing** to route traffic between the internal network and the outside world.

### 4. **Wireless Network**:
   - Install **Cisco Wireless LAN Controllers (WLCs)** for centralized Wi-Fi management.
   - Ensure that each department is equipped with **Lightweight Access Points (LAPs)** for wireless connectivity.
   - The **WLAN** network will use the IP range **10.20.0.0/16**.

### 5. **VoIP Implementation**:
   - Deploy **Cisco IP Phones** for each department using VLAN 70 for **VoIP** communication.
   - Configure a **Cisco Voice Gateway** to support telephony services within the network.

### 6. **DHCP and IP Addressing**:
   - Set up two **DHCP servers** for redundancy and to provide dynamic IP addressing for devices in the network.
   - Use **static IP addressing** for critical devices such as servers, switches, firewalls, and routers.

### 7. **Link Aggregation and LACP**:
   - Use **EtherChannel** with **LACP** to bundle multiple physical links into one logical link for redundancy and load balancing.

### 8. **Testing and Validation**:
   - Perform **thorough testing** to ensure proper connectivity and redundancy:
     - Check inter-VLAN communication and routing.
     - Validate that all devices are receiving dynamic IPs from the DHCP servers.
     - Test failover mechanisms like HSRP and link aggregation.
     - Ensure firewall policies and ACLs are working as expected.

### 9. **Management and Remote Access**:
   - Implement **SSH** for secure remote management of the network.
   - Configure a **Standard ACL** on the VTY lines to allow only specific management devices to access the network remotely.

### 10. **Future-Proofing**:
   - Design the network to scale easily as Cytonn Innovation expands.
   - Use **modular designs** and ensure ample IP space in each VLAN for future growth.
   - Implement **cloud integration** as the company leverages cloud-based services for global clients.

----



Cisco Packet Tracer does not directly support scripting for full network deployments in the same way that a live network environment or network simulation tools like GNS3 with automation capabilities (e.g., using Ansible or Python scripts) would allow. However, you can semi-automate the configuration process in Cisco Packet Tracer using configuration templates or by pre-configuring devices in a template network, which you can copy as needed.

Here's a general approach you can take to streamline your network setup in Cisco Packet Tracer:

1. **Create Configuration Templates**: Write standard configuration sets for routers, switches, and other devices. You can use a text editor to prepare these configurations. For example, create templates for different device roles like Core Switch, Access Switch, Firewall, DHCP Server, etc.

2. **Use Partial Automation Features**: Cisco Packet Tracer allows for the import of configuration files into devices. You can prepare these configurations beforehand and load them into the respective devices within your Packet Tracer network. This reduces repetitive tasks and potential errors.

3. **Bulk Device Configuration**:
   - Prepare device configurations in a text format.
   - Open the device in Cisco Packet Tracer.
   - Import the configuration via the CLI tab by copying and pasting the pre-written configurations.

### Example Configuration Template for a Core Switch:
```plaintext
! Core Switch Configuration Template
enable
configure terminal
hostname CoreSwitch
! Configure VLANs
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
! Configure Trunk Ports
interface range gig0/1 - 2
 switchport mode trunk
 switchport trunk allowed vlan 10,20,50,70,199
! Configure HSRP for VLAN 10 (Management VLAN)
interface vlan 10
 ip address 192.168.10.2 255.255.255.0
 standby 1 ip 192.168.10.1
 standby 1 priority 110
 standby 1 preempt
! Configure OSPF
router ospf 1
 network 192.168.10.0 0.0.0.255 area 0
 network 172.16.0.0 0.0.255.255 area 0
 network 172.30.0.0 0.0.255.255 area 0
 default-information originate
! Save Configuration
end
write memory
```

### Steps to Apply Configurations:
1. **Prepare Configuration**: Write the configurations for all device types based on your network design requirements.
2. **Start Cisco Packet Tracer**: Launch your project and place the necessary devices.
3. **Open Device CLI**: Double-click on a device to open it, go to the CLI tab, and enter the global configuration mode.
4. **Paste Configuration**: Copy the configuration from your template and paste it into the CLI of the device.

This method can speed up the process significantly, although it’s not as automated as scripting in a more dynamic simulation environment. For more complex automation, consider using network simulators that support integration with network automation tools. If you're preparing for real-world applications, learning to use tools like Ansible for network configuration might be highly beneficial.

---- 

Certainly! To configure each of the devices for the **Cytonn Innovation Ltd** project in Cisco Packet Tracer, I'll walk you through the configuration of key devices step by step. We'll cover:

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

This set of configurations should allow you to establish the core, access, and security features of your network as outlined in the project requirements. Let me know if you need additional configurations for other components like **VoIP Gateway**, **WLC** (Wireless LAN Controller), or specific features like **SSH** ACLs.


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

---

To adapt your network to use the **IP range 192.168.200.0/23** and allocate IPs for **three branches** with the four given departments (**Accounts, Administrator, Marketing, Sales**) based on the specified quantities, you will need to **subnet** the IP range to efficiently allocate IP addresses.

Here’s a step-by-step breakdown of how to approach this:

### 1. **Determine the IP Requirements for Each Department**
You have the following departments with the given number of devices:
- **Accounts**: 59 devices
- **Administrator**: 69 devices
- **Marketing**: 119 devices
- **Sales**: 249 devices

For each department, we need to create subnets that can accommodate at least the specified number of devices, while keeping room for growth and adhering to network best practices.

### 2. **Subnet the Network 192.168.200.0/23**
The IP range **192.168.200.0/23** provides **512 total IP addresses** (including network and broadcast addresses). We can break this down into smaller subnets for each department. Since **/23** provides more than 512 IP addresses, we can work with **/24**, **/25**, **/26**, etc., to divide the network accordingly.

Let’s calculate the required subnets:

| Department     | Qty  | Required Hosts  | Recommended Subnet Mask  | Total Usable IPs  |
|----------------|------|-----------------|--------------------------|-------------------|
| **Accounts**    | 59   | At least 62     | **/26** (255.255.255.192) | 62 usable IPs     |
| **Administrator**| 69   | At least 70     | **/25** (255.255.255.128) | 126 usable IPs    |
| **Marketing**   | 119  | At least 126    | **/25** (255.255.255.128) | 126 usable IPs    |
| **Sales**       | 249  | At least 254    | **/24** (255.255.255.0)   | 254 usable IPs    |

### 3. **Subnet Assignment**
Here’s how you can divide the **192.168.200.0/23** network into multiple subnets based on the departments and their requirements:

#### a. **Sales Department (249 devices)**: 
   - **Subnet**: 192.168.200.0/24
   - **Subnet Mask**: 255.255.255.0
   - **Usable IPs**: 192.168.200.1 to 192.168.200.254
   - This provides **254 usable IP addresses**, which is enough for 249 devices.

#### b. **Marketing Department (119 devices)**:
   - **Subnet**: 192.168.201.0/25
   - **Subnet Mask**: 255.255.255.128
   - **Usable IPs**: 192.168.201.1 to 192.168.201.126
   - This provides **126 usable IP addresses**, which is enough for 119 devices.

#### c. **Administrator Department (69 devices)**:
   - **Subnet**: 192.168.201.128/25
   - **Subnet Mask**: 255.255.255.128
   - **Usable IPs**: 192.168.201.129 to 192.168.201.254
   - This provides **126 usable IP addresses**, which is enough for 69 devices.

#### d. **Accounts Department (59 devices)**:
   - **Subnet**: 192.168.200.128/26
   - **Subnet Mask**: 255.255.255.192
   - **Usable IPs**: 192.168.200.129 to 192.168.200.190
   - This provides **62 usable IP addresses**, which is enough for 59 devices.

### 4. **Network Overview**
After subnetting, here’s the breakdown:

| Department     | Subnet Address        | Subnet Mask          | Usable IP Range                    | Total Usable IPs |
|----------------|-----------------------|----------------------|------------------------------------|------------------|
| **Sales**      | 192.168.200.0/24      | 255.255.255.0        | 192.168.200.1 – 192.168.200.254    | 254              |
| **Marketing**  | 192.168.201.0/25      | 255.255.255.128      | 192.168.201.1 – 192.168.201.126    | 126              |
| **Administrator**| 192.168.201.128/25   | 255.255.255.128      | 192.168.201.129 – 192.168.201.254  | 126              |
| **Accounts**   | 192.168.200.128/26    | 255.255.255.192      | 192.168.200.129 – 192.168.200.190  | 62               |

### 5. **VLAN Configuration for Each Department**
You can now assign each department a VLAN and link it to the corresponding subnet. Here’s how you could assign VLANs to the subnets:

| Department     | VLAN ID  | Subnet Address        |
|----------------|----------|-----------------------|
| **Sales**      | VLAN 10  | 192.168.200.0/24      |
| **Marketing**  | VLAN 20  | 192.168.201.0/25      |
| **Administrator**| VLAN 30| 192.168.201.128/25    |
| **Accounts**   | VLAN 40  | 192.168.200.128/26    |

### 6. **Routing between Branches**
Since you have multiple branches, you'll need to implement **inter-VLAN routing** using a **Layer 3 Switch** or **Router**. The switch or router will route traffic between the VLANs for intra-branch communication, and to the WAN link for inter-branch communication.

### 7. **Sample VLAN and IP Configuration for Core Switch**

```plaintext
! Core Switch Configuration (Assuming Layer 3 switch for routing)
enable
configure terminal
hostname CoreSwitch

! Create VLANs for each department
vlan 10
 name Sales
vlan 20
 name Marketing
vlan 30
 name Administrator
vlan 40
 name Accounts

! Assign IP addresses to VLAN interfaces (SVIs) for inter-VLAN routing
interface vlan 10
 ip address 192.168.200.1 255.255.255.0  ! Sales Default Gateway

interface vlan 20
 ip address 192.168.201.1 255.255.255.128  ! Marketing Default Gateway

interface vlan 30
 ip address 192.168.201.129 255.255.255.128  ! Admin Default Gateway

interface vlan 40
 ip address 192.168.200.129 255.255.255.192  ! Accounts Default Gateway

! Enable OSPF (Optional)
router ospf 1
 network 192.168.200.0 0.0.1.255 area 0

! Save configuration
end
write memory
```

### 8. **Connecting the Branches**

For communication between branches, you can establish **VPNs** (for secure connectivity over the internet) or **dedicated leased lines** (for direct communication). If you have a **WAN router** connecting to all three branches, use routing protocols like **OSPF** or **BGP** depending on your WAN setup to ensure smooth routing across branches.

### Conclusion

By following these steps, you've:
1. Subnetted the **192.168.200.0/23** network to suit your departmental needs.
2. Assigned **VLANs** for departmental segregation.
3. Set up **inter-VLAN routing** using a Layer 3 device.
4. Provided a scalable and efficient design that fits the current requirements and allows for future expansion.

