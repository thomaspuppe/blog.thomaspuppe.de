---
title: Twitterdaten mappen mit Leaflet
date: 2014-11-19
datelabel: 19. November 2014
tags: [Webentwicklung]
permalink: twitterdaten-mappen-mit-leaflet
draft: false
description: Meine Sammlung von Tweets zum #Mauerfall umfasst über 70.000 Tweets. Nun sollen diejenigen mit Fotos und Geo-Daten auf einer Karte angezeigt werden.
---

Meine <a href="https://blog.thomaspuppe.de/twitterdaten-sammeln-mit-aws">Sammlung von Tweets zum #Mauerfall</a> via Amazon AWS hat trotz Ausfall über 70.000 Tweets ergeben. Nun sollen diejenigen mit Fotos und Geo-Daten auf einer Karte angezeigt werden.


In der JSON Datei, die dabei angelegt wird, ist jeder Tweet in einer Zeile erfasst. Das macht das Zählen leicht, und auch das Aussortieren usw.

<pre>//Alle Tweets in einer großen Datei:
$ wc -l tweets.json
// 71180 tweets.json

// Filtern der Tweets, die Medien enthalten (was zurzeit nur Fotos sein können)
$ grep media_url tweets.json > tweets_media.json
$ wc -l tweets_media.json
// 32330 tweets_media.json

// Filtern der Tweets, die Koordinaten enthalten
$ grep -v "\"coordinates\":null" tweets_media.json > tweets_media_coordinates.json
$ wc -l tweets_media_coordinates.json
// 249 tweets_media_coordinates.json</pre>

Die Datei enthält nun (erstaunlich wenige) Tweets, die aber mit allen Daten. Da für die Visualisierung nicht alles benötigt wird, extrahiere ich nur die nötigen Daten. Dazu habe ich ein kleines Python-Script geschrieben. Die Code-Qualität sei mir verziehen, das waren jetzt meine ersten Zeilen Python überhaupt.

<pre>import json

readFile = open('tweets_media_coordinates.json')
lines = readFile.readlines()
readFile.close()

outputArray = []

for lineString in lines:
	try:
		lineObject = json.loads(lineString)
		outputObject = {}
		outputObject['id_str'] = lineObject['id_str']
		outputObject['text'] = lineObject['text']
		outputObject['screen_name'] = lineObject['user']['screen_name']
		outputObject['text'] = lineObject['text']

		for entityKey in lineObject['entities'] :
			if entityKey == 'media' :
				for media in lineObject['entities']['media'] :
					if media['type'] == 'photo' :
						outputObject['media_url'] = media['media_url']

		outputObject['coordinates'] = lineObject['coordinates']['coordinates']

		outputArray.append(outputObject)
	except:
		pass

outputString = json.dumps(outputArray, separators=(',',':'), indent=2)

writeFile = open('tweets_media_coordinates_short.json','w')
writeFile.write('{"tweets":' + outputString + '}')
writeFile.close()</pre>

Das Ergebnis ist eine JSON Datei mit den Tweets, Foto-URLs und Koordinaten: <a href="http://lab.thomaspuppe.de/mauerfall-tweets/data/tweets_media_coordinates_short.json">http://www.thomaspuppe.de/lab/mauerfall-tweets/data/tweets_media_coordinates_short.json</a>.

Diese Datei ist die Daten-Grundlage für die Visualisierung. Auch dafür habe ich fix was aus dem Netz gezogen: den <a href="https://github.com/moklick/generator-leaflet">Leaflet-Generator</a> von <a href="https://twitter.com/moklick">Moritz Klack</a>. Via npm lädt man das halbe Internet herunter, hat aber dafür eine out-of-the-box Map Anwendung. Die eigentlich benötigten Dateien sollte man sich dann fürs nächste mal zurechtlegen.

In die gegebene Karte wmüssen nur noch ein paar Zeilen JavaScript eingefügt werden, und schon sind die Punkte auf einer schönen Karte hinterlegt.

<pre>var markerIcon = L.divIcon({className: 'my-div-icon'}), // stylen via CSS!
markerOptions = {
	'clickable': true,
	'keyboard': false,
	'icon': markerIcon
};

document.addEventListener('DOMContentLoaded', function() {
	var httpRequest = new XMLHttpRequest()
	httpRequest.onreadystatechange = function () {
		if (httpRequest.readyState === 4) {
			if (httpRequest.status === 200) {
				var data = JSON.parse(httpRequest.responseText);
				for (var i=0; i < data['tweets'].length; i++) {
					var currentData = data['tweets'][i];
					markerOptions['alt'] = currentData['media_url'];
					L.marker(
						[currentData['coordinates'][1], currentData['coordinates'][0]],
						markerOptions)
					.addTo(map);
				}
			}
		}
	}
	httpRequest.open('GET', 'data/tweets_media_coordinates_short.json')
	httpRequest.send()
});</pre>

Zu beachten: die Koordinaten bei Twitter sind als Lon,Lat gespeichert, leaflet benötigt aber Lat,Lon. Daher die Rochade beim Anlegen der Marker.

Und hier das Ergebnis:

<figure>
	<a href="http://lab.thomaspuppe.de/mauerfall-tweets/">
		<img src="/images/2014/11/tweets-mauerfall.png" alt="Eine karte mit Tweets zum Mauerfall-Jubiläum">
		<figcaption>http://lab.thomaspuppe.de/mauerfall-tweets/</figcaption>
	</a>
</figure>
