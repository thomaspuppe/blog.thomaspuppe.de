---
title: Twitterdaten sammeln mit AWS
date: 2014-11-06
datelabel: 06. November 2014
language: de
tags: [Webentwicklung]
permalink: twitterdaten-sammeln-mit-aws
draft: false
description: Um Tweets zu einem aktuellen Thema zu sammeln, muss man die Twitter Streaming API mitschneiden. In 20 Minuten ist dafür ein kostenloses always-online System aufgesetzt.
---

Um Tweets zu einem aktuellen Thema zu sammeln, muss man die Twitter Streaming API mitschneiden. In 20 Minuten ist dafür ein kostenloses always-online System aufgesetzt.

Bei kurzen Events (TV-Duell vor der Bundestagswahl) habe ich die Sammlung von Tweets einfach auf meinem lokalen Rechner gemacht. Für die anstehenden Feierlichkeiten zum #Mauerfall soll die Sammlung mehrere Tage dauern. Mein Rechner soll dabei aber nicht im Dauerbetrieb laufen. Daher habe ich einfach eine AWS Instanz hochgefahren und lasse die die Arbeit tun. Zum Mitschneiden des Streams dient diesmal auch nicht die PHP-Lib Phirehose, sondern das Python-Tool Tweepy.

Dieser Artikel beschreibt, wie man mit wenigen Klicks, 9 Konsolenkommandos und 40 Zeilen Code einen automatischen und kostenlosen Twitter-Mitschnitt anfertigt.

Out of scope:

- Erstellen einer Twitter App und Generieren der Authentifizierungsdaten
- Anmelden bei AWS und die Details fürs Einrichten einer Instanz.

## Schritt 1: AWS Instanz erstellen und hochfahren

Für das Sammeln reicht die kleinste EC2 Instanz von AWS (t2.micro), die kostenlos ist. Der kostenlose Festplattenspeicher kann bis zu 30 GB reichen, je größer desto besser wird auch die IO Performance sein. Zugriff braucht man nur per SSH, daher lege ich kein eigenes VPC an.

Mit meinem (oder einem neu generierten) Key melde ich mich via SSH auf der Instanz an.

## Schritt 2: Twitter-Collecor installieren und anwerfen

<pre>// Update
$ sudo apt-get update
$ sudo apt-get upgrade

// PIP (Python Paketmanager) und Tweepy (Twitter API Lib) installieren
$ sudo apt-get install python-pip
$ sudo pip install tweepy

// Python-File erstellen
$ mkdir tweets_mauerfall
$ cd tweets_mauerfall/
$ nano collect.py</pre>

Die genaue Code-Quelle finde ich gerade nicht mehr. Eine Suche nach "tweepy save tweets to file" brignt aber mehrere Quellen zutage. Mein Code hatte ursprünglich eine MongoDB als Datenspeicher, das habe ich gegen die einfache Datei ausgetauscht.

Der Quellcode von collect.py:

<pre>import json
import tweepy

consumer_key = ""
consumer_secret = ""
access_key = ""
access_secret = ""

auth = tweepy.OAuthHandler(consumer_key, consumer_secret)
auth.set_access_token(access_key, access_secret)
api = tweepy.API(auth)

# initialize blank list to contain tweets
tweets = []
# file name that you want to open is the second argument
save_file = open('tweets.json', 'a')

class CustomStreamListener(tweepy.StreamListener):
    def __init__(self, api):
        self.api = api
        super(tweepy.StreamListener, self).__init__()

        self.save_file = tweets

    def on_data(self, tweet):
        self.save_file.append(json.loads(tweet))
        print tweet
        save_file.write(str(tweet))

    def on_error(self, status_code):
        return True # Don't kill the stream

    def on_timeout(self):
        return True # Don't kill the stream

sapi = tweepy.streaming.Stream(auth, CustomStreamListener(api))
sapi.filter(track=['mauerfall', 'fotw25', 'mauerspecht', 'berlinwall', 'fallofthewall25'])</pre>

Und das Ganze muss dann nur noch gestartet werden:

<pre>// Stumm im Hintergrund ausführen lassen
$ nohup python collect.py > /dev/null &

// anhand der ausgegebenen Prozessnummer (oder via top suchen) kann ich den Prozess später wieder killen.

// Um die aktuelle Zahl der Tweets zu verfolgen, lasse ich mir (periodisch) die Anzahl der Zeilen in der json-Datei ausgeben:
$ while true; do ( wc -l tweets.json ; sleep 5 ) done;</pre>


Fertig. Ein Update zur Zuverlässigkeit und eine Auswertung der Tweets gibt es dann später hier im Blog.


## Update zur Zuverlässigkeit:

Das lief nicht so toll. Die Sammlung ist mehrfach abgebrochen, ohne dass Infos im Error-Log gelandet sind. Ob der Server mit dem Speichern nicht nachgekommen ist, oder ob die Streaming API Aussetzer hatte, lässt sich nicht mehr feststellen. Lesson learned: während der Sammlung sollte ein externer "Dienst" (Cronjob, Daemon, whatever) prüfen ob das Programm noch läuft und falls nötig neu starten. Sicher lässt sich auch das


## Auswertung der Tweets:

Insgesamt wurden 71180 Tweets erfasst. Da die Aufzeichnung ausgerechnet am Abend des 8.11. abbrach und ich bis Spätabends am 9.11. nicht online war, fehlen alle Tweets vom Tag des Mauerfalls. Aber immerhin gibt es die kleine Sammlung der Tage zuvor.

Die Datei lässt sich via scp vom AWS Server herunterladen, dann kann man die Maschien stoppen oder terminieren.

Die Tweets, die ein Foto enthalten und mit Geodaten versehen waren, habe ich auf einer Karte dargestellt: <a href="http://lab.thomaspuppe.de/mauerfall-tweets/">Karte</a>, <a href="https://blog.thomaspuppe.de/twitterdaten-mappen-mit-leaflet">Blog-Beitrag</a>.
