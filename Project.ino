/*
 * PIR sensor tester
 */
#include <Time.h>
#include <TimeLib.h>
#include <SPI.h>
#include <Ethernet.h>
byte mac[] = {
  0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED
};

//IPAddress ip(172, 16, 68, 192); //College IP. change this according to your network. ipconfig and then determine gateway.

IPAddress ip(169, 254, 18, 192);

//EthernetServer server(80);

EthernetClient client;

int x=0;
//int ledPin = 13;                // choose the pin for the LED
int inputPin1 = 2;              // choose the input pin (for PIR sensor)
int inputPin2 = 8;
int pirState1 = LOW;             // we start, assuming no motion detected
int pirState2 = LOW;
int val1 = 0;                    // variable for reading the pin status
int val2 = 0;
int timea,timeb,suma=0,sumb=0;

void setup() {
  
  Ethernet.begin(mac, ip);
  //server.begin();

  //pinMode(ledPin, OUTPUT);      // declare LED as output
  pinMode(inputPin1, INPUT);     // declare sensor as input
  pinMode(inputPin2, INPUT);
  
  Serial.begin(9600);
  delay(1000);
  

  // start the Ethernet connection and the server:
  Serial.print("My IP is:  ");
  Serial.println(Ethernet.localIP());

  delay(10000);

  connectClient();

  

  
}
 
void loop(){
  
  val1 = digitalRead(inputPin1);  // read input value
  if (val1 == HIGH) {            // check if the input is HIGH
    //digitalWrite(ledPin, HIGH);  // turn LED ON
    if (pirState1 == LOW) {
      // we have just turned on
      //Serial.println("Motion detected on sensor 1!");
      // We only want to print on the output change, not state
      time_t t=now();
      timea=hour(t)*60*60+minute(t)*60+second(t);
//      Serial.print("timea-");
//      Serial.println(timea);
      pirState1 = HIGH;
    }
  } else {
   // digitalWrite(ledPin, LOW); // turn LED OFF
    if (pirState1 == HIGH){
      // we have just turned of
      //Serial.println("Motion ended on sensor 1!");
      // We only want to print on the output change, not state
      time_t t=now();
      //Serial.println(hour(t)*60*60+minute(t)*60+second(t));
      int total=hour(t)*60*60+minute(t)*60+second(t)-timea;
      suma=suma+total;
      //Serial.print("total-");
      //Serial.println(total);
      //Serial.print("suma-");
      //Serial.println(suma);
      pirState1 = LOW;
    }
  }

  //For Sensor 2

  val2 = digitalRead(inputPin2);  // read input value
  if (val2 == HIGH) {            // check if the input is HIGH
   // digitalWrite(ledPin, HIGH);  // turn LED ON
    if (pirState2 == LOW) {
      // we have just turned on
      //Serial.println("Motion detected on sensor 2!");
      // We only want to print on the output change, not state
      time_t t=now();
      timeb=hour(t)*60*60+minute(t)*60+second(t);
      //Serial.print("timeb-");
      //Serial.println(timeb);
      pirState2 = HIGH;
    }
  } else {
    //digitalWrite(ledPin, LOW); // turn LED OFF
    if (pirState2 == HIGH){
      // we have just turned of
      //Serial.println("Motion ended on sensor 2!");
      // We only want to print on the output change, not state
      time_t t=now();
      //Serial.println(hour(t)*60*60+minute(t)*60+second(t));
      int total=hour(t)*60*60+minute(t)*60+second(t)-timeb;
      sumb=sumb+total;
      //Serial.print("total-");
      //Serial.println(total);
      //Serial.print("sumb-");
      //Serial.println(sumb);
      pirState2 = LOW;
    }
  }
  time_t t=now();
  int total=hour(t)*60*60+minute(t)*60+second(t);
  if(total%60==0 && total!=0)
  {
     Serial.println("Over seconds-");
     Serial.println(total);
     Serial.println(suma);
     Serial.println(sumb);

//     listenForEthernetClients();

     //send data to PHP then to mysql database.
     Serial.println("Posting Data..");
     postData();
     
     suma=0;
     sumb=0;
     delay(1500);
  }

  
    if (client.available()) {
      //Serial.println("CLinet available");
      char c = client.read();
      Serial.print(c);
    }
    else
    {
      //Serial.println("Client not available");
    }

    if (!client.connected()) 
    {
     //Serial.println();
      //Serial.println("disconnecting.");
      client.stop();
      //Serial.println("Disconnected");
      connectClient();
    }
}

void postData()
{
  
   String data = "";

   String sumA = String(suma);
   String sumB = String(sumb);

   data = "sumA=" + sumA + "&sumB=" + sumB;

   Serial.println(data);
   
    // client connection to server
      byte no = client.println("POST /arduinoproject/getData.php HTTP/1.0");
      //Serial.println(no);
      client.println("HOST: 169.254.18.196");
      //client.println("HOST: localhost");
      client.println("Content-Type: application/x-www-form-urlencoded");
      client.print("Content-Length: ");
      client.println(data.length());
      client.println();
      byte ko = client.print(data); 
      //Serial.println(ko);

}

// Client Connection! 

void connectClient()
{
    if(client.connect("169.254.18.196",80))
    {
      //Serial.println("Conected"); 
    }
    else
    {
      Serial.println("Not Conected");
    }
}

//}
