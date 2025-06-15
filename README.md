# keyhub

![keyhublogo](/docpics/keyhub_logo_white.png)

IM4 Projekt von Livia Vogt und Cédric Züllig. <br>
**keyhub** ermöglicht es Familien schnell und einfach zu checken wer zuhause ist. Die smarte Magnetwand fliesst reibungslos in das Familienleben ein ohne gross seine Gewohnheiten anpassen zu müssen.

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
  - [2.5 3D Druck](#3d-druck)
- [3. Video-Dokumentation](#video-dokumentation)
- [4. Aufgabenteilung](#aufgabenteilung)
- [5. Relexion](#reflexion)
  - [5.1 Herausforderungen](#herausforderungen)
  - [5.2 Learnings](#learnings)

## UX-Konzeption

### Idee

Wir haben für unsere IM-Vertiefung „Physical Computing“ eine einfache und praktische Lösung für den Familien- & Wohngemeinschaftsalltag entwickelt: eine Magnetwand am Wohnungseingang, an der jede Person beim Nach-Hause-Kommen ihren persönlichen Magneten (am Schlüsselbund) befestigt. Über eine App bzw. Website wird in Echtzeit erkannt, wer aktuell zuhause ist - oder kürzlich war usw.

Die Idee ist aus ganz normalen Alltagssituationen entstanden.
Wir kommen aus Grossfamilien (mit jeweils sieben Personen) und kennen das „Problem“ daher nur zu gut. Die am häufigsten gestellte Frage im Familienchat ist: „Wer ist zuhause?" Bisher muss man Nachrichten in den Familienchat schicken, warten, wer antwortet, oder gleich alle anschreiben (Zum Beispiel: "Ist jemand daheim und könnte kurz den Einkaufszettel fotografieren, den ich vergessen habe?"). Mit unserer Lösung muss niemand warten, weil auf einen Blick ersichtlich ist, wer zuhause und wer abwesend ist. So wird das Zusammenleben etwas direkter und weniger abhängig von Nachrichten in der Familiengruppe.

Wie wir aus unseren Interviews mit der Zielgruppe herausgefunden haben, haben die Probanden oft gar keine Ahnung, wer aktuell von ihren Schützlingen vor Ort ist. Sie wünschen sich mehr Übersicht, um den Alltag besser planen zu können, ohne die einzelnen Mitglieder überwachen zu müssen.

Unsere Familien sind nur ein Beispiel. Wir sehen zahlreiche weitere Verwendungszwecke für das Gerät. Z.B. für Familien mit Teenagern könnte das Gerät weitere Sicherheit und Komfort bieten: Eltern wüssten, wann ihre Kinder (spät am Abend) nach Hause gekommen sind, ohne gleich anrufen oder Nachrichten schicken zu müssen. Ausserdem hilft das Gerät dabei, dass weniger Schlüssel im Haus verloren gehen. Die Schlüssel hängen ab sofort immer am selben Ort.

### Designentscheid

Bei der Gestaltung haben wir uns für eine schlichte, schwarze Box entschieden. Sie soll sich optisch zurücknehmen, modern wirken und in verschiedene Wohnungen, Häuser oder Gemeinschaftsräume passen. Gleichzeitig muss sie robust und standhaft sein, weil sie täglich benutzt wird.

Die Box kann in beliebiger Höhe montiert werden – passend zum Eingangsbereich. In unserem Fall ist das Design so ausgelegt, drei Reed-Sschalter, drei Lichter, unser Logo und einen Bewegungssensor aufzunehmen. Das lässt jedoch beliebig auf die Anzahl der Mitglieder anpassen (pro Mitglied je ein Licht und Magnetsensor). Der Bewegungssensor hat die Funktion, die besetzten Lichter zum Leuchten zu bringen, sobald jemand sich davor befindet. So wird zum einen visuell noch mehr verstärkt, wer zuhause ist. Zum andern gibt es direktes optisches Feedback, dass das Gerät aktiv ist (und zum Beispiel das Einhängen eines Schlüssels erkannt hat).

Unsere Box wurde mit einem 3D-Drucker hergestellt. Dafür haben wir das Gerät zunächst in der Software "Onshape" entworfen – für uns etwas ganz neues, weil wir bisher keine Erfahrungen mit 3D-Druck hatten. So konnten wir das Gerät vollständig nach eigenen Vorstellungen gestalten und an unsere Zwecke anpassen.

_Gestaltung der Website_

Bei der Gestaltung der Website stand für uns Bedienungsfreundlichkeit an ersterstelle – insbesondere weil unsere Hauptzielgruppe ü50 ist. Daher haben wir grossen Wert darauf gelegt, das Design klar, übersichtlich und leicht nachvollziehbar aufzubereiten.

Überall werden Informationen bei uns klar ausgeschrieben.
So muss man sich nicht allein auf Farben verlassen, um den Inhalt sofort zu verstehen – das ist gerade für Nutzer mit einer Rot-Grün-Schwäche hilfreich. Farben setzen wir daher als zusätzliche Unterstützung ein, um Informationen optisch zu unterstreichen. Zum Beispiel wird der Status einer Person mit klaren Farben dargestellt – Grün für „Zuhause“, Rot für „Nicht da“ – jedoch immer unterstützt durch den zusätzlichen Text „zuhause“ oder „nicht da“. So sind Informationen für alle klar, nachvollziehbar und leicht wahrnehmbar.

Auch bei den Buttons wurde auf Bedienbarkeit geachtet. Sie werden zum Beispiel beim Hovern etwas dunkler, um deutlich anzuzeigen, dass sie anklickbar sind. Diese kleinen Interaktionen machen die Seite lebendig, intuitiv und für alle Altersgruppen leicht bedienbar.

Trotz dieser einfachen und funktionalen Herangehensweise muss das Design nicht langweilig wirken. Unsere Website ist ebenso für jüngere Nutzer ansprechend, weil sie modern, ruhig und geschmackvoll ist. So fügt sich das Gerät als Teil eines Smart Homes ebenso harmonische in das Zuhause seiner Nutzer ein.

### Vorgehensweise

Am Anfang stand die Ideenfindung. In einem ersten Brainstorming haben wir verschiedene Ideen zusammengetragen und geprüft, welches am besten zum Thema „Physical Computing“ und zu uns passt. Bereits früh sind wir auf unsere Idee mit der Magnetwand gekommen und waren begeistert.

Wir haben kurze Interviews mit potenziellen Nutzern geführt – in diesem Fall mit Livias Mutter und Cédrics Vater (beide in der definierten Zielgruppe ü50). Daraus wurde deutlich, welchen Nutzen das Gerät für den Alltag hat und wir konnten einige Anpassungen für die Bedienbarkeit vornehmen. Unsere Grundidee wurde allerdings bestätigt und musste daher nicht grundlegend geändert werden.

Anschliessend haben wir ein Figma-Design erstellt, um die App zunächst visuell darzustellen und die Anordnung der verschiedenen Funktionen sinnvoll zu planen.

Jetzt durften wir das Makerkit kennenlernen. Vor allem für Livia war dieser Abschnitt technisches Neuland, Cédric hatte aus seiner Lehre einige Erfahrungen mit einfachen Schaltungen, aber für das weitere Vorgehen waren wir auf neues Know-how angewiesen. Zum Glück wurde im Unterricht mit Wolfgang, Jan, Jasper und Siro das passende Werkzeug bereitgestellt, um für unser Gerät relevante Bauteile auszuwählen – für uns waren das Bewegungssensoren, LED-Lampen und Reed-Schalter (Magnetsensoren).

Mit dieser Grundlage begannen wir mit der Programmierung in HTML und der Verkabelung. Dafür wurde zunächst das Schaltboard aufgebaut, verdrahtet und Schritt für Schritt getestet. Hier holten wir bei Schwierigkeiten Unterstützung im Unterricht oder bei ChatGPT, um zum Beispiel einige Anschluss-, Schalt-, oder Code-Probleme zu beheben. Bei jedem dieser Arbeitsschritte haben wir das Gerät mehrfach getestet, um sicherzustellen, dass alles weiterhin funktionierte. Weitere Informationen hierzu sind weiter unten ausgeführt.

Sobald unser Code gelungen war, ging es weiter zum technischen Ausbau. Hier wurde das Gehäuse für den 3D-Druck entworfen. Dafür haben wir das vorhandene Schaltboard als Referenz benutzt, mit dem Lineal ausgemessen und passend zum Gerät das Box-Design erstellt. Mit Onshape (CAD-Software) wurde das 3D-Model für den Druck ausgegeben und im Anschluss ausgedruckt. Der Druck dauerte um die 24 Stunden.

Sobald alle Teile fertig waren, wurde das Gerät vollständig zusammengebaut. Hier kamen Tätigkeiten wie Löten, Heisskleben und Basteln zum Einsatz.

Zum Schluss wurde die Dokumentation ausformuliert und das Gerät für die Präsentation in einer Videodokumentation zusammengefasst. So konnten wir den gesamten Ablauf nachvollziehbar darstellen und für künftige Nachbauer zugänglich machen.

### Flussdiagramm (Cédric)

![Flussdiagramm_1](/docpics/Flussdiagramm_1.png)

Das sind die ursprünglich von uns erstellten Flussdiagramme. Die fertigen Lösungen sehen jedoch deutlich anders aus. Anstelle einer UPDATE-Funktion, die die Zeit in eine bestehende Zeile einträgt, wenn der Schlüssel entnommen wird, haben wir uns dazu entschieden, für jedes „Event” eine neue Zeile zu erstellen. Das ist einfacher zu programmieren und erleichtert die Auswertung der Statistiken.

![Flussdiagramm_2](/docpics/Flussdiagramm_2.png)

Auch beim Passwortschutz konnten wir dank PHP viel Code einsparen, da wir kein komplettes Login mit Accounts etc. benötigen.

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
| LED 3              | GPIO 15        |
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

### 3D Druck

Der 3D-Druck spielte bei der Verwirklichung unseres Prototyps eine entscheidende Rolle. Unsere Box musste verschiedene Bauteile aufnehmen — das Schaltboard, den Bewegungssensor, die Reed-Schalter und einige LED-Lämpchen — und zugleich robust, funktional und optisch passend für den Alltagseinsatz sein. Dafür haben wir einige Handskizzen angefertigt, um unsere Ideen zu sammeln. Wir haben zunächst das vorhandene Schaltboard ausgemessen. Dazu kommen die weiteren Elemente:  Öffnungen für die Kabel, Einführungen für den Bewegungssensor und Reed-Schalter usw.

_Design mit Onshape_

Zunächst haben wir das Gehäuse in der CAD-Software Onshape entworfen. Onshape ermöglicht das vollständig individuelle Konstruieren von Objekten in 3D. Wir haben uns an unseren detailreichen Handskizzen orientiert. Für die Wand haben wir eine Dicke von 3mm ausgewählt.

![3D-Druck 1](/docpics/3d_druck_1.jpeg)
![3D-Druck 2](/docpics/3d_druck_2.jpeg)


_Fertigung mit UltiMaker Cura_

Nachdem das 3D-Design in Onshape ausgelegt und als STL-Datei exportiert wurde, wurde es in UltiMaker Cura geöffnet. Hier werden einige entscheidende Parameter für den 3D-Druck festgelegt — zum Beispiel die Druckauflösung, Füllung und Support-Strukturen — damit das Gerät am Ende stabil, passgenau und zugleich materialsparend ist.

_Zusammenbau_

Sobald der 3D-Druck fertiggestellt wurde, wurde das Gerät von der Druckplatte gelöst, gereinigt und für den Einbau der technischen Bauteile vorbereitet. Anschliessend wurde das zuvor zusammengebaute Schaltboard mit Bewegungsmelder, Reed-Schalter und LED-Lichtern in das Gerät eingefügt. Zum Schluss wurde alles passend gemacht, gelötet, mit (Heiss)Kleber fixiert und geprüft.

_Tests und Fertigstellung_

Vor der finalen Fertigstellung wurde das Gerät mehrfach getestet, um sicherzustellen, dass sämtliche Sensoren und Leuchten funktionieren, die Box robust ist und alle Teile passend sitzen. So wurde aus einer einfachen 3D-Zeichnung in Onshape und einigen technischen Bauteilen das fertige Gerät, das nun im Alltag zum Einsatz kommt. Die fertige STL-Datei ist ebenso auf Github zu finden.

![3D-Druck 3](/docpics/3d_druck_3.jpeg)


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

## Reflexion

### Herausforderungen

Dieser Abschnitt ist Kapitel 1.

### Learnings

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