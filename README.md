# keyhub

![keyhublogo](/docpics/keyhub_logo_white.png)

IM4 Projekt von Livia Vogt und Cédric Züllig. **keyhub** ermöglicht es Familien schnell und einfach zu checken wer zuhause ist. Die smarte Magnetwand fliesst reibungslos in das Familienleben ein ohne gross seine Gewohnheiten anpassen zu müssen.

## Inhaltsverzeichnis

- [1. UX-Konzeption](#ux-konzeption)
  - [1.1 Idee](#idee)
  - [1.2 Designentscheid](#designentscheid)
  - [1.3 Vorgehensweise](#vorgehensweise)
  - [1.4 Flussdiagramm](#flussdiagramm)
- [2. Technische Dokumentation](#technische-dokumentation)
  - [2.1 Verbindungsschema](#verbindungsschema)
  - [2.2 Komponentenplan](#komponentenplan)
  - [2.3 Kommunikationsprozess](#kommunikationsprozess)
  - [2.4 Umsetzungsprozess](#umsetzungsprozess)
  - [2.5 Lernerfolg](#lernerfolg)
- [3. Video-Dokumentation](#video-dokumentation)
- [4. Aufgabenteilung](#aufgabenteilung)
- [5. Learnings & Herausforderungen](#learnings-und-herausforderungen)

## UX-Konzeption

### Idee (Livia)

Hier schreiben wir über das.

### Designentscheid (Livia)

Hier schreiben wir über das.

### Vorgehensweise (Livia)

Dieser Abschnitt ist Unterkapitel A.

### Flussdiagramm

Dieser Abschnitt ist Unterkapitel A.

## Technische Dokumentation

### Verbindungsschema

![Verbindungsschema](/docpics/Verbingunsschema_keyhub.png)

| Komponente         | GPIO (ESP32C6) |
| ------------------ | -------------- |
| Reed-Schalter 1    | GPIO 4         |
| Reed-Schalter 2    | GPIO 5         |
| Reed-Schalter 3    | GPIO 6         |
| PIR-Sensor (SR602) | GPIO 7         |
| LED 1              | GPIO 10        |
| LED 2              | GPIO 11        |
| LED 3              | GPIO 12        |
| LED 3              | GPIO 12        |
| VCC (PIR)          | 3.3V           |
| GND                | GND            |

### Komponentenplan

![Komponentenplan](/docpics/komponentenplan_keyhub.png)

### Kommunikationsprozess

1. Schlüssel wird zurückgegeben: Reed-Switch wird aktiviert
2. Wenn PIR-Sensor aktiv: LED leuchtet (5s keine Bewegung LED geht aus)
3. Datenbank erfasst neuen Eintrag
4. Website zeigt die Person als zu hause an.

<br>

1. Statistik oder History Seite wird aufgerufen
2. DB wird abgefragt und Daten der letzten 7 Tagen dargestellt.

### Umsetzungsprozess

1. Hardware-Einrichtung:

   - Verkabelung der Reed-Switch.
   - Ergänzung der LED's und PIR Sensor.

2. Software-Entwicklung:
   - WiFi-Einrichtung für die Web-Kommunikation.
   - Programmierung der Reedschalter.
   - Programmierung der Datenbank kommunkikation mit Website
   - Programmierung des PIR Sensor und LED's
   - Styling mit CSS
3. Testing
   - Testläufe zur Datenübertragung und Fehlersuche.
   - Durchführen von Testwoche

### Lernerfolg (Jede:r selber)

Cédric:<br>
Ich habe das erstemal mit einem Arduino MC gearbeitet deshalb war alles damit verbunden neu für mich. Zudem konnte ich viele neuen Learning im bezug auf Datenbanken SQL/PHP machen. Auf folgende zwei Learnings möchte ich gerne tiefer eingehen:<br>

1. Passwort schutz durch PHP

```
<?php
 session_start();

require_once("db_config.php");
// Passwort für den Zugang zur Website

if (!isset($_SESSION["eingeloggt"])) {
  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["pw"])) {
    if ($_POST["pw"] === $passwort) {
      $_SESSION["eingeloggt"] = true;
      header("Location: index.php");
      exit;
    } else {
      $fehler = "Falsches Passwort.";
    }
  }
  ?>
```

## Video-Dokumentation

Dieser Abschnitt ist Unterkapitel A.

## Aufgabenteilung (Livia)

Dieser Abschnitt ist Kapitel 1.

## Learnings und Herausforderungen

Dieser Abschnitt ist Kapitel 1.
