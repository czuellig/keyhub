#include <WiFi.h>
#include <HTTPClient.h>
#include <Arduino_JSON.h> 

#define REED_PIN_1 4
#define REED_PIN_2 5
#define REED_PIN_3 6
#define PIR_PIN 7

#define LED1_PIN 10
#define LED2_PIN 11
#define LED3_PIN 15

unsigned long lastTime = 0;
unsigned long timerDelay = 500;

unsigned long lastMotionTime = 0;
const unsigned long motionTimeout = 10000; // 10 Sekunden

bool motionDetected = false;

int lastStatus1 = 0;
int lastStatus2 = 0;
int lastStatus3 = 0;

int reedStatus1 = 0;
int reedStatus2 = 0;
int reedStatus3 = 0;

const char* ssid     = "tinkergarden";
const char* pass     = "strenggeheim";
const char* serverURL = "https://keyhub.cedriczuellig.ch/load.php";

void setup() {
  Serial.begin(115200);

  WiFi.begin(ssid, pass);
  Serial.println("Connecting");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.printf("\nWiFi connected: SSID: %s, IP Address: %s\n", ssid, WiFi.localIP().toString().c_str());

  pinMode(REED_PIN_1, INPUT_PULLUP);
  pinMode(REED_PIN_2, INPUT_PULLUP);
  pinMode(REED_PIN_3, INPUT_PULLUP);

  pinMode(PIR_PIN, INPUT);
  
  pinMode(LED1_PIN, OUTPUT);
  pinMode(LED2_PIN, OUTPUT);
  pinMode(LED3_PIN, OUTPUT);

  digitalWrite(LED1_PIN, LOW);
  digitalWrite(LED2_PIN, LOW);
  digitalWrite(LED3_PIN, LOW);
}

void loop() {
  int pirValue = digitalRead(PIR_PIN);
  if (pirValue == HIGH) {
    motionDetected = true;
    lastMotionTime = millis();
  } else if (motionDetected && (millis() - lastMotionTime > motionTimeout)) {
    motionDetected = false;
  }

  if ((millis() - lastTime) > timerDelay) {
    lastTime = millis();

    checkReedSwitch(REED_PIN_1, lastStatus1, reedStatus1, 1);
    checkReedSwitch(REED_PIN_2, lastStatus2, reedStatus2, 2);
    checkReedSwitch(REED_PIN_3, lastStatus3, reedStatus3, 3);

    updateLEDs();
  }
}

void checkReedSwitch(int pin, int &lastStatus, int &reedStatus, int sensorID) {
  int status = digitalRead(pin);
  int wert = (status == LOW) ? 1 : 0;

  reedStatus = wert;

  if (lastStatus != wert) {
    lastStatus = wert;

    Serial.printf("Sensor %d -> Status: %d -> %s\n", sensorID, status,
                  (wert == 1) ? "Magnet erkannt" : "Kein Magnet");

    JSONVar dataObject;
    dataObject["wert"] = wert;
    dataObject["sensor_id"] = sensorID;

    String jsonString = JSON.stringify(dataObject);

    if (WiFi.status() == WL_CONNECTED) {
      HTTPClient http;
      http.begin(serverURL);
      http.addHeader("Content-Type", "application/json");
      int httpResponseCode = http.POST(jsonString);

      if (httpResponseCode > 0) {
        String response = http.getString();
        Serial.printf("HTTP Response code: %d\n", httpResponseCode);
        Serial.println("Response: " + response);
      } else {
        Serial.printf("Error on sending POST: %d\n", httpResponseCode);
      }
      http.end();
    } else {
      Serial.println("WiFi Disconnected");
    }
  }
}

void updateLEDs() {
  digitalWrite(LED1_PIN, (reedStatus1 == 1 && motionDetected) ? HIGH : LOW);
  digitalWrite(LED2_PIN, (reedStatus2 == 1 && motionDetected) ? HIGH : LOW);
  digitalWrite(LED3_PIN, (reedStatus3 == 1 && motionDetected) ? HIGH : LOW);
}
