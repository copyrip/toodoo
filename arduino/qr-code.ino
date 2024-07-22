#include "qrprint.h"
#include <SoftwareSerial.h>

const byte pin = 6;                      // the pin that will be sending signals to the thermalPrinterPrinter printer (connected to printer's rx)
const byte printHeat = 8;                // 7 is the printer default. Controls number of heating dots, higher = hotter, darker, and more current draw
const byte printSpeed = 110;             // 80 is the printer default. Controls speed of printing (and darkness) higher = slower
SoftwareSerial thermalPrinter(99, pin);  // set rx to a non-existant pin, because we don't need rx just tx

void setup() {
  
  thermalPrinter.begin(19200);
  
  //Modify the print speed and heat
  thermalPrinter.write(27);
  thermalPrinter.write(55);
  thermalPrinter.write(printHeat);
  thermalPrinter.write(printSpeed);
  thermalPrinter.write((byte)0);
  // print "Hello, world!" as text and then a QR code.
  thermalPrinter.print("copyright.rip");
  printQR("copyright.rip");
  
}

void loop() { }


