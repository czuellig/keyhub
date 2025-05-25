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

### Flussdiagramm (Cédric)

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

### Lernerfolg

Wir haben beide das erste Mal mit einem Arduino MC gearbeitet deshalb war alles damit verbunden neu für mich. Zudem konnte ich viele neuen Learning im bezug auf Datenbanken SQL/PHP machen. Auf folgende zwei Learnings möchte ich gerne tiefer eingehen:<br>

**1. Passwort schutz durch PHP**

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

Damit potenzielle Einbrecher nicht sehen können ob jemand zuhause ist, haben wir die Website mit php Passwort geschüzt. Diese Möglichkeit war mir davor nicht bekannt (Wurde durch Beni darauf aufmerksamgemacht). Diese Einfach Möglichkeit seine Projkete zuschützen werde ich aufjedenfall in Zukunft wieder verwenden. (Das Passwort befindet sich in der db_config Datei damit es nicht auf Github landet)

**2. Relationale datenbank**

```
SELECT
            s1.id,
            s1.wert,
            s1.zeit,
            s1.sensor_id,
            n.name AS name
        FROM
            sensordata s1
        INNER JOIN (
            SELECT sensor_id, MAX(id) AS max_id
            FROM sensordata
            GROUP BY sensor_id
        ) s2 ON s1.sensor_id = s2.sensor_id AND s1.id = s2.max_id
        LEFT JOIN
            namen n ON s1.sensor_id = n.id
        ORDER BY
            s1.sensor_id ASC
```

Das war das erste Mal das ich mit einer relationalen Datebank gearbeitet habe, und dank ChatGTP war es relativ einfachen. In diesem Fall ist es nötigt damit wir die Namen über die Website ganz einfach updaten können.

Livia ergänzt (mit 3D Drucker), korrigiert

## Video-Dokumentation

Dieser Abschnitt ist Unterkapitel A.

## Aufgabenteilung (Livia)

| Aufgabe          | Wer?   |
| ---------------- | ------ |
| Ideenfindung     | beide  |
| UX-Design        | Livia  |
| Hardware testing | beide  |
| Backend          | Cédric |
| Frontend         | Livia  |
| 3D Druck         | beide  |
| Zusammenbau      | Cédric |
| Video            | Livia  |
| Dokumentation    | beide  |
|                  |        |

## Herausforderungen

Dieser Abschnitt ist Kapitel 1.
