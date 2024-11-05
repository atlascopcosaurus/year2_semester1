### a) Using the help of a diagram, explain the key differences between the OSI 7 Layer model and the TCP/IP Reference model.

**OSI 7 Layer Model:**
- **Layers:**
  1. Physical
  2. Data Link
  3. Network
  4. Transport
  5. Session
  6. Presentation
  7. Application

**TCP/IP 4 Layer Model:**
- **Layers:**
  1. Network Interface (or Link)
  2. Internet
  3. Transport
  4. Application

**Key Differences:**
1. **Number of Layers:**
   - OSI Model: 7 layers.
   - TCP/IP Model: 4 layers.
2. **Layer Functions:**
   - OSI separates presentation and session layers, which are part of the application layer in TCP/IP.
   - OSI’s data link and physical layers are combined into the network interface layer in TCP/IP.
3. **Usage:**
   - OSI is a theoretical framework; TCP/IP is a practical framework used in real-world networking.

**Diagram:**

```
OSI Model:                  TCP/IP Model:
+-----------+               +-----------+
| Application| <---> Application
+-----------+               +-----------+
| Presentation|
+-----------+
|    Session  |
+-----------+
|  Transport  | <---> Transport
+-----------+               +-----------+
|    Network  | <---> Internet
+-----------+               +-----------+
|  Data Link | <---> Network Interface
+-----------+               +-----------+
|   Physical  |
+-----------+
```

### b) Which network devices operate at the following layers of the OSI Model?

i. **Layer 1 (Physical Layer):**
   - Devices: Hubs, Repeaters, Physical cables (Ethernet cables, fiber optics)

ii. **Layer 2 (Data Link Layer):**
   - Devices: Switches, Bridges, Network Interface Cards (NICs)

iii. **Layer 3 (Network Layer):**
   - Devices: Routers, Layer 3 Switches

iv. **Layer 1 up to Layer 7:**
   - Devices: Firewalls (Layer 3 to 7), Gateways (Layer 7), Network Management Systems

### c) Indicate the Protocol Data Unit (PDU) used at each layer of the OSI Layer Model.

1. **Physical Layer:** Bits
2. **Data Link Layer:** Frames
3. **Network Layer:** Packets
4. **Transport Layer:** Segments (TCP) / Datagrams (UDP)
5. **Session Layer:** Data
6. **Presentation Layer:** Data
7. **Application Layer:** Data

### d) Using a diagram, describe data encapsulation/de-encapsulation within the OSI Reference Model.

**Data Encapsulation Process:**
1. **Application Layer:** Data is created.
2. **Presentation Layer:** Data is formatted and encrypted.
3. **Session Layer:** Data is added with session information.
4. **Transport Layer:** Data is segmented and headers are added.
5. **Network Layer:** Data is encapsulated into packets with network headers.
6. **Data Link Layer:** Data is encapsulated into frames with MAC headers and trailers.
7. **Physical Layer:** Data is converted into bits for transmission.

**Data De-encapsulation Process:**
1. **Physical Layer:** Bits are received.
2. **Data Link Layer:** Frames are processed and headers/trailers are removed.
3. **Network Layer:** Packets are processed and headers are removed.
4. **Transport Layer:** Segments are processed and headers are removed.
5. **Session Layer:** Session information is processed.
6. **Presentation Layer:** Data is decrypted and formatted.
7. **Application Layer:** Data is delivered to the application.

**Diagram:**

```
Sender:                                             Receiver:
[Application] --- Data --->                         [Application]
[Presentation] --- Data --->                        [Presentation]
[Session] --- Data --->                             [Session]
[Transport] --- Segment --->                        [Transport]
[Network] --- Packet --->                           [Network]
[Data Link] --- Frame --->                          [Data Link]
[Physical] --- Bits --->                            [Physical]
```
