---
title: Progressive Web App erstellen
date: 2017-03-15
datelabel: 15. März 2017
language: de
tags: [Webentwicklung]
permalink: progressive-web-app-meetingtimer
draft: false
description:
---


# Progressive Web App -- was ist das?

Progressive Web Apps sind der (mittlerweile nicht mehr ganz so) heiße Scheiß im mobilen Internet. Normale Websites und -apps werden mit bestimmten Features angereichert, um am Ende App-like benutzbar zu sein. Allerdings als richtiges HTML im richtigen (auch älteren) Browser, ohne Lock-In eines App Stores.

Das Smashing Magazine behandelt Progressive Web Apps in einer sehr guten [drei](https://www.smashingmagazine.com/2016/08/a-beginners-guide-to-progressive-web-apps/)-[teiligen](https://www.smashingmagazine.com/2016/09/the-building-blocks-of-progressive-web-apps/)-[Serie](https://www.smashingmagazine.com/2016/12/progressive-web-amps/).

Von einer Progressive Web App spricht man, wenn sie folgende zehn Kriterien erfüllt:

* Progressive, Responsive, Discoverable (crawlbar), Linkable

Den Anspruch stelle ich an alles im Internet. Ist das nicht erfüllt, hast du keine Website. Haken wir hier mal ab.

* Fresh, Re-engageable, App-like

Ist etwas schwammig. Sagen wir, die App soll Spaß machen.

* **Safe, Installable, Connectivity-independent**

Um diese drei Punkte wird es in diesem Blog-Post gehen. Ich möchte meine bereits existierende [kleine App](https://blog.thomaspuppe.de/single-page-apps-minimieren-mit-gulp) sicher (per SSL) ausliefern, auf Smartphones installierbar und offline nutzbar machen.

Die anderen genannten Kriterien sind zum Teil etwas vage und abstrakt, und müssen nicht alle erfüllt werden. So kann die App auch nicht-fresh oder gar unresponsiv sein, und sich dennoch installieren lassen. Andere Dinge bauen aufeinander auf: so gibt es zum Beispiel keine Offline-Unterstützung, wenn die App nicht via SSL ausgeliefert wird.

Und damit sind wir direkt im Thema, um eine Progressive Web App zu bauen...

# Schritt 1: SSL

Die Auslieferung per SSL ist eine der Voraussetzungen, dass eine Website als Progressive Web App funktioniert. Gleichzeitig ist sie die größte Hürde. Während man den Code beliebig selbst schreiben kann, und das nicht besonders schwer ist (wie wir gleich sehen), ist die Einrichtung von SSL komplizierter, und meist mit Kosten verbunden.

Zum Glück gibt es [Letsencrypt](https://letsencrypt.org/), eine Zertifizierungsstelle die kostenlose Zertifikate ausstellt und bei der Einrichtung unterstützt. Auf einem Server mit SSH-Zugriff ist es superleicht, mittels [Letsencrypt und Certbot](https://certbot.eff.org/) SSL-Zertifikate zu erzeugen. Das funktionier auch, wenn mehrere Domains auf diesem Server liegen. Nach der (systemspezifischen) Installation reicht ein Befehl zum Erzeugen eines Zertifikats:

<pre>$ ./certbot-auto certonly --webroot -w /var/www/www_meetingtimer_biz/ -d www.meetingtimer.biz</pre>

Der Certbot gibt aus, wo das neu erzeugte Zertifikat liegt. Diesen Pfad benutze ich nun zur Konfiguration meines nginX Webservers:

<pre>server {
    listen 443;

    ssl on;
    ssl_certificate /etc/letsencrypt/live/www.meetingtimer.biz/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/www.meetingtimer.biz/privkey.pem ;

    server_name www.meetingtimer.biz;
    root /var/www/www_meetingtimer_biz;
    index index.html;
}</pre>

Die drei ssl-Zeilen sind im Prinzip alles, was es zum Verschlüsseln braucht. Man kann das ganze optimieren: für eine Weiterleitung von nicht-www auf www braucht man zum Beispiel noch ein Zertifikat, wenn die Weiterleitung auch durch den Webserver erfolgen soll. Außerdem kann man die Verschlüsselung noch verbessern, laut einem Test von [SSL Labs](https://www.ssllabs.com/ssltest/) erreichen das Zertifikat und die Server-Konfiguration noch nicht die volle Punktzahl. Aber für den Einstieg sind wir sehr gut versorgt.

Eine andere Möglichkeit, eigene Inhalte kostenlos und einfach über eine HTTPS-Verbindung auszuliefern, sind [GitHub Pages](https://pages.github.com/).

Auch wenn Verschlüsselung an sich schon ein Wert ist, war sie hier nur die notwenige Vorbedingung für den nächsten Schritt:

# Schritt 2: Ein Manifest erstellen, um die App "installieren" zu können



<pre>{
  "lang": "en",
  "background_color": "#232323",
  "name": "How Much does this meeting cost?",
  "short_name": "MeetingTimer",
  "display": "standalone",
  "icons": [
    {
      "src": "icon_144.png",
      "sizes": "144x144",
      "type": "image/png"
    },
  ]
}</pre>

Diese Datei wird unter dem Namen [manifest.json](https://www.meetingtimer.biz/manifest.json) im Root der Domain abgelegt.

Brcue Lawson hat einen kleinen [Manifest-Generator](http://brucelawson.github.io/manifest/) erstellt, und es gibt eine [umfangreiche
Dokumentation](https://developer.mozilla.org/en-US/docs/Web/Manifest) im MDN.

Nun kann man das Manifest validieren. Wenn das ok ist, wird es im HTML-Head der Website eingetragen:

<code><link rel="manifest" href="/manifest.json"></code>
