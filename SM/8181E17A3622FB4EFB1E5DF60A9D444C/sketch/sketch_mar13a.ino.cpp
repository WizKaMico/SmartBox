#include <Arduino.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <ESP32Servo.h>
#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>  

#define SERVO_PIN 13  

LiquidCrystal_I2C lcd(0x27, 16, 2);  
Servo lockServo;  // Servo motor
bool isLocked = false;  // Start with the lock as unlocked
bool lastLockState = false;  // Variable to remember the last state of the lock

// Wi-Fi credentials
const char* ssid = "[Your wifi display name]";
const char* password = "[Your wifi password]";

// API URL (with the query parameter "id=1 change 2 if the next smartbox")
const char* apiUrl = "https://gmfworks.tech/SmartBox/WAPI/api/status.php?id=1";  
// const char* apiUrl = "https://gmfworks.tech/SmartBox/WAPI/api/status.php?id=2";  

void setup() {
    Serial.begin(115200);  // Start the serial communication
    
    // Connect to Wi-Fi
    WiFi.begin(ssid, password);
    while (WiFi.status() != WL_CONNECTED) {
        delay(1000);
        Serial.println("Connecting to WiFi...");
    }
    Serial.println("Connected to WiFi");

    // Initialize I2C communication and LCD
    Wire.begin(4, 5);  
    lcd.init();
    lcd.backlight(); 
    
    // Set up the servo motor
    lockServo.setPeriodHertz(50);
    lockServo.attach(SERVO_PIN, 500, 2400);  // Attach the servo to the correct pin

    // Display welcome message on LCD
    lcd.setCursor(0, 0);
    lcd.print("SmartBox 001");
    // lcd.print("SmartBox 002");
}

void sendLockStatusToAPI() {
    HTTPClient http;
    
    http.begin(apiUrl);  
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    // Send GET request to the API
    int httpResponseCode = http.GET();
    
    if (httpResponseCode == 200) {
      
        String payload = http.getString();
        
        
        DynamicJsonDocument doc(1024);
        
       
        deserializeJson(doc, payload);
        
     
        const char* access = doc["data"][0]["access"];
        
        // Update the lock status based on the "access" value
        if (strcmp(access, "Unlock") == 0) {
            isLocked = false;  // Unlock the box
        } else if (strcmp(access, "Lock") == 0) {
            isLocked = true;   // Lock the box
        }

        // Log the access status
        Serial.print("Locker Access: ");
        Serial.println(access);
    } else {
        // If the request failed, print the error code
        Serial.print("Error on sending GET: ");
        Serial.println(httpResponseCode);
    }

    http.end();  // End the HTTP request
}

void updateServo() {
    
    if (isLocked && !lastLockState) {
        lockServo.attach(SERVO_PIN);  
        lockServo.write(0);  
        delay(500);  
        lockServo.detach(); 
        lastLockState = true; 
        lcd.setCursor(0, 1);
        lcd.print("Status: LOCKED  ");
        lcd.backlight(); 
    } else if (!isLocked && lastLockState) {
        lockServo.attach(SERVO_PIN);  
        lockServo.write(45);  
        delay(500);  
        lockServo.detach(); 
        lastLockState = false;  
        lcd.setCursor(0, 1);
        lcd.print("Status: UNLOCKED");
        lcd.backlight();  
        
       
        delay(1000); 
        lockServo.attach(SERVO_PIN);
        lockServo.write(0); 
        delay(500);
        lockServo.detach();  
    }
}

void loop() {
    // Send the lock status request to the API every 1 second
    sendLockStatusToAPI();

    // Update the servo position only when the lock status changes
    updateServo();

    delay(1000);  // Delay for 1 second before the next API call
}

