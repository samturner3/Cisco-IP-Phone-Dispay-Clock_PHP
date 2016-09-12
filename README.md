Readme

CC Sam Turner 2016

This php / xml script was designed to show the time on LCD Cisco IP Phones. 
Models include the cisco 7970 and more...

![alt tag](CLockOnPhone.jpg)

Inside pushClock.php there is a function called drawClock. This will output a png file of text of whatever you input (ie. the $time)

You then define the ip addresses of the IP Phones on the network.

The data packet to be pushed to the phones is then defined. See http://www.cisco.com/c/en/us/td/docs/voice_ip_comm/cuipph/all_models/xsi/8_0_1/xsi_dev_guide/xmlobjects.html

The data is then pushed to each ip phone via a for each (ip address).



The data packet contains the command to display the png of the current time (CiscoIPPhoneStatusFile), along with the location on screen.

It is then sent via xml which includes a POST command including authentication of the phones.
