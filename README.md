# comp2322
project

Assessment
  For both parts, you must be able to set up the networks in order to answer the follow-ing questions. If you are unable to set it up correctly, you may lose all the marks in that section. For each part, the same rubrics for the assignments and tests available in Blackboard apply. You must answer the questions clearly with sufficient evidence based on Wireshark captures, measurement tools and other references. The 15-minute demonstration will be treated as a question with a weight of 1 in section II.

Instructions:
  1.	Create a folder named project_group_"Your Group Number". Please do not leave any space in the folder’s name. For example, project_group_1. The group number can be found from docs.google.com. Please put the following files in the folder:
    •	The report in the pdf file. Please find the format of the report in the next item.
    •	All the .ngpcap/.pcap files obtained for answering the questions in the project. Please label these files meaningfully for associating these files with the questions. Using a README would also be a good idea.
    •	Each group will be given 15 minutes to demonstrate your networks and to answer questions in the week of 7 May. Please return to me the Pi, the WiFi dongle (if any), the network cable, and the power cord immediately after the demo.
  2.	The format of the report:
    •	No limit on the page number. One inch on all margins and Times New Roman font with 11pt and single space.
    •	All the diagrams will have captions and figure numbering which starts from 1.
    •	On the cover page, come up a creative name for the project and include the names and student numbers of all the active members.
    •	On the next page, list the tasks done by each member. Please be as specific as possible. Please have all members sign at the bottom of this page to confirm that all members agree to the contributions stated in this page. In case of dispute, please come to see me.
    •	Starting from the next page, you will detail your answers to the questions.
    •	Wherever you have used others’ information, you must make a reference to them and include them in the bibliography at the end of the report.
  3.	Compress the folder as a rar/zip file. Its name is project_group_"Your Group Number". For example, project_group_1.rar.
  4.	Submit the rar/zip file to Blackboard. You can upload it an unlimited number of times, but only the last one will be graded (I may change to github for the submission).
  5.	Observe the penalty for late submissions and plagiarism.
  6.	Failure of following the submission instructions will have the overall mark deducted by at most 20%.


Part I: Setting up a WiFi router with Internet connection (65%)

1.	(Weight = 4) [Network setup] Set up the network in Figure 1. Include (a) the network and node configurations, and (b) the services provided by this network. For (a), you could briefly recap the main installation steps but skip all the nitty-gritty details. Moreover, you should point out any incorrect/missing information in the references you base on for the installations (e.g., the setup procedure in www.raspberrypi.org, and the installation of the driver of the WiFi dongle given in Blackboard). You must include a drawing of the network configuration similar to Figure 1 but with more detailed information, such as the MAC and IP addresses, the host’s and router’s routing tables, and the hardware used. For (b), you should point out what kind of services provided by this network on different layers (datalink, IP, transport and application) of the TCP/IP stack.

2.	(Weight = 1) [Tshark] Install Wireshark and Tshark in the Pi. Tshark is the command line version of Wireshark, and it is more handy than Wireshark for our purposes. Run Tshark to capture frames for both the Ethernet and WiFi network interfaces. A simple command for doing that is tshark -i wlan0 -i eth0 -w filename.ngpcap. The two i options specify the two network interfaces, while the w option specifies the name of the output file. You could terminate the capture by other option or just killing it. The .ngpcap file could be opened by Wireshark for analysis. A useful reference for installing Tshark is www.iwan.wiki. In this part, you will submit a screenshot of the packet trace obtained by Tshark.

3.	(Weight = 1) [DHCP] Describe how the Dynamic Host Configuration Protocol (DHCP) is used to assign IP address, subnet mask and default router to a host. To this end, you will capture the DHCP packets when you reset your WiFi connection. This will trigger a new procedure of configuring the host’s IP settings. Besides the IP address, subnet mask and default router, discover other information provided by the DHCP server. Also include the routing table of the host that will show these IP settings. You may also release the IP address by ipconfig /release to see the effect of this action to your WiFi connection.

4.	(Weight = 1) [Intra-subnet communication] Issue a ping from a wireless host to another wireless host. Describe how the ping packets and the response packets are delivered, starting from using the ARP to obtain the MAC address. You need to first empty the arp cache in your host by arp -a * for Win10 (this requires the administrator right), and there is a similar sudo command for MacOS. This will cause the sending host to arp for the receiving host’s IP address. Explain in detail the packet deliveries based on the routing tables in both the hosts and router, and the MAC addresses in the frame headers and the IP addresses in the IP packets.

5.	(Weight = 1) [Internet communication] Traceroute learn.polyu.edu.hk from a wireless host. You don’t need to perform the entire traceroute, because we are not interested in finding the routes here. Describe how the ping packets and the response packets are delivered, starting from resolving the IP address of the domain. First of all, you should empty the DNS cache in the sending host before the traceroute. In this case, the packets will be sent on both the Ethernet and WiFi interfaces of the wireless router. Therefore, you must capture the frames using Tshark in the Pi. Since Tshark capture the packets seen on both interfaces, you need to distinguish which packets seen from which interface. It may be instructive to draw up a diagram to illustrate your findings.

6.	(Weight = 1) [NAT] Explain how the Network Address Translation (NAT) works. All the IP addresses configured in the network are private addresses which cannot be sent out to the public Internet. The IP address of the Pi’s external interface is public, because it is connected to the Internet. Therefore, there is a need to connect a private IP network with the public Internet. A prominent solution is using NAT which translates a private IP address to a public IP address, and vice versa. You could use the packet capture from the last part to illustrate how NAT works in our network setting.

7.	(Weight = 1) [TCP throughput measurement] Measure the TCP throughput (in Mbps) from a wireless host to another host on the campus. We use iPerf for this measurement. iPerf uses a client-server model to measure the throughput. The idea is simple: the client sending a certain amount of data according to UDP or TCP (or SCTP) to a server, and the server will calculate the amount of time needed for receiving the data). We have set up a iPerf server on campus for this purpose (IP address: 158.132.255.31, TCP port: 25009). You may issue this iPerf command: iperf -c 158.132.255.31 -p 25009 to measure the throughput. As the network condition (and also the iPerf server’s) varies over time, it is normal that you get different measurement results. Since we are interested in the bottleneck bandwidth which should be the wireless link (and/or the wireless router), you are advised to conduct the measurement on campus, so that there won’t be other “weaker” links on the path.

Part II: Setting up a WiFi bridge and a router with Internet connection (35%)


1.	(Weight = 0) [Flashing the SD card] Only after finishing part I, you will flash the SD card to install the Raspian for the second part of the project. Useful resources for this very first step are given below. You also need a SD card reader if it is not available in your notebook/PC.
(a)	Flashing software recommended in the Raspberry Pi website: https://etcher.io.
(b)	Installing operating system images on Mac OS: www.raspberrypi.org
(c)	Installing operating system images using Windows: www.raspberrypi.org

2.	(Weight = 3) [Network setup] Set up the network in Figure 2. You need to set up the Raspberry Pi as a bridge and your Win/MacOS notebook as a router which serves the same role as the Raspberry Pi Part I but with a landline.
(a)	(The bridge) The setup procedure is given in the second part at www.raspberrypi.org. However, do not run sudo apt-get upgrade. Note that the Raspberry Pi, being a bridge, does not have IP addresses configured for its interfaces.
(b)	(The router) Win notebook or MacBook could be configured as a router. You need two Ethernet interfaces for the router. If you already have an Ethernet interface in your notebook, you will need an Ethernet dongle. Else, you will need both.
  •	For Win notebook, you must first check whether your notebook supports Hosted Network by NETSH WLAN show drivers. If all of your notebooks do not support it, you could borrow a Fujitsu notebook which supports Hosted Network from the COMP’s counter. www.windowscentral.com gives useful information.
  •	For MacBook, www.macinstruct.com gives useful information.
Include (a) the network and node configurations, and (b) the services provided by this network. For (a), you could briefly recap the main installation steps but skip all the nitty-gritty details. Moreover, you should point out any incorrect/missing information in the references you base on for the installations. You must include a drawing of the network configuration similar to Figure 2 but with more detailed information, such as the MAC and IP addresses, the host’s and router’s routing tables, and the hardware used. For (b), you should point out what kind of services provided by this network on different layers (datalink, IP, transport and application) of the TCP/IP stack.

3.	(Weight = 1) [Bridging] Describe the functions of the Raspberry Pi in this network configu-ration. Capture the frames on both interfaces to support your answer.

4.	(Weight = 1) [IP configuration] How does the router connected to the Internet know its default router and subnet mask?

5.	(Weight = 1) [Network reachability] Issue a ping from a host in the wireless LAN to a host in the Internet. Describe how the ping packets and the response packets are delivered, starting from using the ARP to obtain the MAC address.

6.	(Weight = 1) [Resolving IP address] Set the DNS server in the client host properly, so that it could ping to a domain name.

7.	(Weight = 1) [TCP throughput measurement for landline] Measure the TCP throughput from the wireless router to the iPerf server mentioned in Part I.

8.	(Weight = 1) [TCP throughput measurement for wireless link] Measure the TCP through-put from a wireless host to the iPerf server. Compare the result with the throughput obtained in the last part.
