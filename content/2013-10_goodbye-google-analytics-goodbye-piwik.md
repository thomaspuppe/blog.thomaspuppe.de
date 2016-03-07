---
title: Good bye Google Analytics! Good bye Piwik! Hallo AWStats!
date: 2013-10-22
tags: [Web-Entwicklung]
permalink: goodbye-google-analytics-goodbye-piwik
draft: false
description: Warum ich mein Website-Tracking von Google Analytics über Piwik zu AWStats zurück entwickelte und trotzdem nichts vermisse.
---

Warum ich mein Website-Tracking von Google Analytics über Piwik zu AWStats zurück entwickelte und trotzdem nichts vermisse.

<p><img src="/images/2013/10/tracking_graphen.png"></p>

Im Juli 2013 wurde das Besuchertracking bei Bundestwitter umgestellt von Google Analytics (mit IP-Anonymisierung) auf Piwik. Das ist ein OpenSource Tracking-Dienst den man sich selbst hosten kann. Wenn der eigene Server geschont werden soll, kann man das auch auf seinem eigenen Cloud-Rechner installieren. Eine schöne Anleitung dazu gibt es <a href="http://dicasdolampada.wordpress.com/2013/07/22/goodbye-google-analytics-hello-piwik/">hier</a> und <a href="https://github.com/openshift/piwik-openshift-quickstart/">hier</a>.

Piwik war mir wichtig, um vom Platzhirschen Google Analytcis loszukommen. Kleiner paranoider Exkurs:

<blockquote>Man muss sich das mal auf der Zunge zergehen lassen: ich zwinge den Besucher meiner Seite, Code vom Server des profitorientierten Unternehmen Google aus den USA herunterzuladen. Dieser Code wird im Browser meines Besuchers ausgeführt und sendet dann seine Erkenntnisse an seinen Herkunftsserver: Google in den USA.</blockquote>

Mit der Nutzung von Google Analytics leistet man Google Beihilfe zur Erstellung von Nutzerprofilen. Mit Piwik werden die User-Daten auf dem eigenen Server gehostet. Damit klinkt man seine eigene Website aus dem Google-Netzwerk aus. (Das Gleiche gilt für die Nicht-Nutzung von Facebook- oder Twitter-Widgets.)

Daher wollte ich herausfinden, ob man wirklich auf die Features von Google Analytics angewiesen ist. Sicher: das Tool ist das beste kostenlose Tracking-Tool auf dem Markt. Aber solang man auf die Integration mit Google AdWords verzichten kann, braucht man die Funktionen vielleicht nicht alle?

Nachdem ich ein paar Monate völlig zufrieden war mit Piwik, entschloss ich mich, noch einen "Schritt zurück" zu gehen und die serverseitige Software AWStats zu testen. Die wertet die Apache Logfiles aus (welche standardmäßig sowieso angelegt werden), und stellt die Ergebnisse dar. AWStats ist bei vielen Hostings inklusive und von Anfang an installiert.

Die Kernfunktionen, die ich nutze, bieten tatsächlich alle 3 Systeme:

 - Besucher pro Tag, Monat
 - Besucherquelle: Referrer-Website bzw. Suchmaschine
 - Suchbegriffe, über die Besucher auf die Seite kamen
 - Mobile Nutzer
 - Verweildauer

AWStats zeigt nicht den Anteil neuer bzw. wiederkehrender Besucher an. Google Analytics hat zudem eine "Trackback"-Übersicht mit Seiten, die auf Bundestwitter verlinken (auch ohne dass Besucher darüber kamen). Dafür gibt es aber auch Dienste, und die Google-Suche lässt sich entsprechend nutzen (<a href="https://www.google.com/search?q=link%3A+%22bundestwitter.de%22+-site%3Abundestwitter.de">link: "bundestwitter.de" -site:bundestwitter.de</a> sucht Seiten, die auf bundestwitter.de verlinken und schließt dabei bundestwitter.de aus).

Ein weiteres Alleinstellungsmerkmal von Google Analytics ist die Messung der Website Performance. Diese Funktion finde ich sehr stark, aber auch sie lässt sich ersetzen durch andere Dienste wie Pingdom RUM (die man auch temporär nutzen kann, und nicht ständig aktiv haben muss).

Dafür bietet AWStats sogar Vorteile, die die anderen Tools nicht bieten:

 - Der Client muss kein JS laden und ausführen.
 - Ich habe die Rohdaten und kann sie herunterladen.
 - Liste von 404 Responses. Ich sehe also, auf welche Seiten fehlerhaft verlinkt wird.
 - Anzeige der verbrauchten Bandbreite pro Ressource. Nicht wichtig bei meinem Hosting, aber für die Performance-Optimierung nützlich.

Interessant ist auch, dass die Anzahl der gezählten Besucher stark variiert. AWStats zeigt ca. doppelt so viele Besucher an wie Piwik (für Google Analytics habe ich keinen Vergleich, weil dies nicht parallel installiert war). Daher genieße ich die Zahlen aller Dienste mit Vorsicht, und achte eher auf Auf- und Abwärtstrends statt absolute Zahlen.

**Fazit: für den normalen Gebrauch bietet AWStats alles, was der Website-Betreiber begehrt. Wer auf clientseitiges Tracking von Google Analytics oder Piwik verzichtet, tut seinem Besucher etwas Gutes ohne auf Besucherstatistiken verzichten zu müssen. Mit der Liste von 404 Fehlern verfügt AWStats sogar über ein nützliches Alleinstellungsmerkmal.**
