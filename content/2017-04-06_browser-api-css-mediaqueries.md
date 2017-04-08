---
title: Browser APIs und CSS Media Queries
date: 2017-04-08
datelabel: 08. April 2017
language: de
tags: [Webentwicklung]
permalink: browser-api-css-mediaqueries
draft: false
description: Der Einsatz von Media Queries und Browser APIs beschränkt sich häufig auf min-width und navigator.userAgent. Aber in modernen Browsern gibt es cooles Zeug.
---

In der Regel denkt man bei Media Queries an nicht viel mehr als `min-width` oder `device-pixel-ratio` und bei Browser APIs an `navigator.userAgent`. Moderne Browser können natürlich viel mehr.

Kürzlich sah ich in einer interessanten [Präsentation über Progressive Web Apps](https://speakerdeck.com/grigs/why-you-should-build-a-progressive-web-app-now-1) dies:

<pre>@media (display-mode: standalone), (display-mode: fullscreen) {
	.backButton {
		display: block;
	}
}</pre>

Mit dieser Media Query stellt man fest, ob die Website (bzw Web App) das Browser-GUI (und damit den Back-Button des Browsers ) zur Verfügung hat, oder nicht. Und kann dann einen eigenen Button einblenden.

Das war für mich ein Anlass, mal zu schauen, welche Media/Feature Queries und Browser APIs heutzutage zur Verfügung stehen.


# (1) Browser APIs


## navigator.cookieEnabled

Eigentlich ganz simpel, kannte ich aber bis heute noch nicht. Diese Abfrage ist natürlich der  Methode, ein Cookie zu setzen und dann auszulesen, zu bevorzugen. Sehr gute Browser-Unterstützung.

> In diesem Browser: <script>document.write(navigator.cookieEnabled || '<em>undefined</em>')</script>


## navigator.doNotTrack

Zeigt an, ob im Browser "Do not track" gesetzt wurde -- und auf welchen Wert. Ist in vielen Browsern implementiert, aber der [Rückgabewert ist unterschiedlich](https://blog.thomaspuppe.de/do-not-track-header-crossbrowser) und muss geparsed werden.

> In diesem Browser: <script>document.write(navigator.doNotTrack || '<em>undefined</em>')</script>


## navigator.hardwareConcurrency

Gibt die Zahl der verfügbaren Prozessoren zurück. Das ist ein grober Indikator dafür, ob der Browser auf einem ein starken neuen Gerät läuft, oder einer alten Möhre. (Vielleicht kann man auch auf die sinnvolle Anzahl an Service Workern oder Web Workern schließen? Gibt ein Browser-Tab, das in einem Prozess läuft, solche Möglichkeiten her?)

> In diesem Browser: <script>document.write(navigator.hardwareConcurrency || '<em>undefined</em>')</script>


## navigator.geolocation

Selbsterklärend. Neben der aktuellen Position kann man auch Positions (oder Genauigkeits-) Änderungen als Event-Handler empfangen. Was macht man mit der Position des Users? Man füttert sie in eine Routenplanung, oder nutzt sie, um Ort und Land des Besuchers herauszufinden.

<pre>navigator.geolocation.getCurrentPosition(function(position) {
  console.log(position.coords.latitude, position.coords.longitude);
});</pre>

> In diesem Browser: <span id="geolocationInfo"><button id="geolocationInfoTrigger">Testen</button></span>

<script>
document.getElementById('geolocationInfoTrigger').addEventListener('click', function(){
	var $geolocationInfo = document.getElementById('geolocationInfo');
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
			var coords = position.coords;
			var positionString = coords.latitude + ', ' +  coords.longitude;
			$geolocationInfo.innerHTML = positionString;
		});
	} else {
		$geolocationInfo.innerHTML = '<em>navigator.geolocation ist nicht verfügbar</em>';
	}
});
</script>

Geolocation hat eine sehr gute [Browser-Unterstützung](http://caniuse.com/#search=geolocation), erfordert aber die Berechtigung durch den User und ist im Chrome Browser nur unter SSL verfügbar.


## navigator.onLine

> In diesem Browser: <script>document.write(navigator.onLine || '<em>undefined</em>')</script>

Selbsterklärend. Die Änderung des online-Status lässt sich über ein Event abfangen:

<pre>window.addEventListener('online', function(e) {
    console.log("You are online");
}, false);

window.addEventListener('offline', function(e) {
    console.log("You are offline");
}, false);</pre>


## navigator.connection

Mehr Details zur Internetverbindung des Users (cellular, wifi).

> In diesem Browser: <span id="connectionInfo"></span>

<script>
var $connectionInfo = document.getElementById('connectionInfo');
var connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
if (connection && connection.type) {
	$connectionInfo.innerHTML = connection.type;
} else {
	$connectionInfo.innerHTML = '<em>navigator.connection ist nicht verfügbar</em>';
}
</script>

`navigator.connection` ist nur im Firefox Mobile und auf Android verfügbar.


## navigator.getBattery()

Der Batteriestand des Devices kann abgefragt werden! Traurige Berühmtheit erlangte das Feature, als Uber denjenigen Kunden, deren Smartphone nur noch wenig Saft hatte, die Preise erhöht hat -- weil sie schnell das erstbeste Fahrzeug buchen würden.

> In diesem Browser: <span id="batteryInfo">waiting...</span>

<script>
var $batteryInfo = document.getElementById('batteryInfo');
if (navigator.getBattery) {
	navigator.getBattery().then(function(battery) {
		var batteryLevel = battery.level * 100;
		$batteryInfo.innerHTML = batteryLevel + '%';
	}, function() {
		$batteryInfo.innerHTML = '<em>navigator.getBattery() ist verfügbar, aber die Abfrage funktioniert nicht</em>';
	});
} else {
	$batteryInfo.innerHTML = '<em>navigator.getBattery() ist nicht verfügbar</em>';
}
</script>

Gute Menschen setzen das ein, um bei Telefonen mit schwachem Akku auf aufwändige Animationen und allen überflüssigen Quatsch zu verzichten, der die CPU belastet.

<pre>navigator.getBattery().then(function(battery) {
   console.log(battery.level*100 + '%');
   console.log(battery.chargingTime);
   console.log(battery.dischargingTime);
});</pre>

Für die Änderung der Werte kann man auch wieder Event Handler registrieren, damit die Website/App informiert wird.

Eine schöne Einführung findet man bei [MDN](https://developer.mozilla.org/en-US/docs/Web/API/BatteryManager). Das Feature wird [unterstützt](http://caniuse.com/#search=battery) im Firefox (nur in "privilegiertem Code" -- diesen Term recherchiere ich jetzt nicht), Chrome und Opera.


## navigator.share()

Mit dieser Funktion kann man per JS die Sharing-Funktion auslösen, die sonst aus dem Menü des Browsers getriggert wird. Der Vorteil gegenüber individuellen Sharing-Buttons: die Leute bekommen genau die Dienste angeboten, die sie zur Verfügung haben -- und nicht die der Seitenbetreiber für wichtig hielt.

<pre>navigator.share({
    title: document.title,
    url: window.location.href
})</pre>

Alle Parameter müssen Strings sein. Ob diese aus JavaScript kommen oder hardcoded sind, ist egal. Test oder URL können weggelasssen werden, eines von beiden muss vorhanden sein.

Zurückgegeben wird eine Promise. Man kann den User also fürs Sharen belohnen oder Abbruchraten tracken.

Ein paar Einschränkungen hat die Technik: Sie ist nur auf HTTPS-Seiten verfügbar, und kann nur durch User-Interaktion getriggert werden (nicht etwa onLoad oder onScroll -- Sorry liebe "User Engager"). Navigator.share() ist derzeit nur im Chrome (ab Version 55) verfügbar. Wie bei allen aktuellen Features wird der Entwickler also progressively enhancen.

<script>
function sharePage() {
	if (navigator.share) {
		navigator.share({
			title: document.title,
			url: window.location.href
		});
	} else {
		document.getElementById('shareWrapper').innerHTML = '<em>navigator.share ist nicht verfügbar.</em>';
	}
}
</script>

> In diesem Browser: <span id="shareWrapper"><button id="shareButton" onClick="sharePage();">Share</button></span>


## navigator.sendBeacon

Kann genutzt werden, um kleine Datenmengen asynchron an einen Server zu senden. Das Verfahren ist für Event Tracking und Monitoring gedacht. Vor allem das Rumeiern mit Requests bei window.unload soll erleichtert werden.

<pre>navigator.sendBeacon("/log", data);</pre>

Das `data` können Form Objekte, Arrays oder normale JS Objekte sein.

Der Browser-Support ist [durchwachsen](https://developer.mozilla.org/en-US/docs/Web/API/Navigator/sendBeacon#Browser_compatibility) und das Verfahren ist als experimentell eingestuft. Auf GitHub liegt eine [clevere kleine Testseite](https://googlechrome.github.io/samples/beacon/) bereit.


## navigator.vibrate(500)

Lässt das Gerät vibrieren, wenn das verfügbar ist. Als Parameter nimmt die Funktion einen Integer (einmalige Vibration für x Millisekunden) oder ein Array (Pattern von Vibration und Pause) entgegen. `navigator.vibrate([100,200,300])` vibriert also 100 ms, pausiert 200 ms, vibriert 300 ms. [Verfügbar](http://caniuse.com/#search=vibration) in modernen mobilen Browsern.

> In diesem Browser: <button id="vibrateButton" onClick="if (navigator.vibrate) { navigator.vibrate([200,100,200]); }">Vibrieren</button>

Die Funktion steht auch in nicht-vibrierfähigen Geräten zur Verfügung und man kann nicht prüfen, ob sie tatsächlich etwas tun wird. Zur Erkennung müsste man also über die Device-Detection gehen.


# (2) Media Queries

Die am häufigsten eingesetzten Media Queries dürften `(min/max-)(device-)width` sein, die für responsive Layouts genutzt werden. Das `device` macht den wichtigen Unterschied zwischen der Größe des Gerätes und des eigentlichen Viewports (also Fensters oder Split Screens).

Besonders auf großen Bildschirmen, wo man im Split Screen arbeitet (was mittlerweile auch auf Tablets kein Problem mehr ist), kann das Fenster komplett anders als das Gerät sein.

Doch Media Queries können viel mehr:

## (device-)aspect-ratio

... ist das Seitenverhältnis des geräts (bzw Viewports). Damit kann man im simpelsten Fall quer- von Hochformat unterscheiden, oder beispielsweise Panorama-Bildschirmen spezielel Stile oder Inhalte ausliefern.

<pre>@media screen and (device-aspect-ratio: 16/9), screen and (device-aspect-ratio: 16/10) { ... }</pre>


## orientation

Eine noch simplere Variante der aspect-ratio. Nimmt die Werte `landscape` oder `portrait` an.

<pre>@media all and (orientation: portrait) { ... }</pre>


## resolution

Erkennt die Pixeldichte auf einem Gerät, und wird vor Allem genutzt, um Retina-optimierte Bilder auszuliefern (`min-resolution: 300dpi`).


## display-mode

Mit dieser Media Query stellt man fest, ob die Website (bzw Web App) das Browser-GUI (und damit den Back-Button des Browsers ) zur Verfügung hat. Mögliche Werte: `fullscreen`, `standalone`, `minimal-ui` und `browser`.


## light-level

Beschreibt die Lichtverhältnisse in der Umgebung, und nimmt die Werte `dim` (gedämpft), `normal` und `washed` (sehr hell) an. Eigentlich praktisch für so etwas wie den Nacht-Lese-Modus. Andererseits sehe ich hier die Gefahr, dass man mit seinen Queries die Nutzereinstellungen oder automatische Helligkeitsanpassung des Smartphones überschreibt -- "das Gegenteil von gut ist gut gemeint". Unterstützt wird `light-level` nur im Edge und im Firefox für OS X.


## supports

Erst diese Woche in einem [Vortrag meines Kollegen Nico Brünjes](https://github.com/codecandies/grid-talk) gesehen. Außerhalb leider selten. Mit dieser Feature Query prüft man, ob der Browser bestimmte CSS-Eigenschaften unterstützt. Zum Beispiel `@supports(blink)` oder `@supports (display: grid)`.

In den meisten Fällen lässt sich die Abfrage bzw. das progressive Enhancement direkt in die CSS-Regeln einbauen. Zum Beispiel bei Schriftgrößen via `font-size:16px; font-size: 1rem;` für den IE8. Der ignoriert die zweite Angabe, mit der er nicht klarkommt, und nutzt die erste. Moderne Browser überschreiben die erste mit der zweiten.

Die Query `@supports` sorgt aber für Klarheit, wenn man größere Blöcke umstylen will, sobald eine Technik verfügbar ist. Oder aber, um eine ganz andere CSS-Datei zu laden.

<pre>&lt;link rel="stylesheet" media="all" href="basic.css" /&gt;
&lt;link rel="stylesheet" media="screen and (min-width: 5in) and (display: flex)" href="shiny.css" /&gt;</pre>

Der IE bis inklusive Version 11 unterstützt `@supports` nicht.

Der Support von Features lässt sich übrigens auch via JavaScript über die CSS-API des Browsers abfragen:

<pre>var canuiseCSSGrid = CSS.supports("(display: grid)");</pre>


## Exotische Queries

Der Vollständigkeit halber noch ein paar Media Features, die eher selten genutzt werden.

`scan` unterscheidet in der Art des Bildaufbaus am Bildschirm (interlace vs progressive), und ist relevant bei schnellen Bewegungen.

`color` und `color-index` geben an, wie viele Farben verfügbar sind und wie sie gespeichert werden, `monochrome` erkennt Geräte die nur mit Graustufen arbeiten (und mit wie vielen). `grid` spricht auf Monospace-Font Displays an, also alle die feste Plätze und Breiten für jedes Zeichen haben. Theoretisch ist das cool, um reduzierte Bilder (oder auf Kontrast optimiertes CSS) an Geräte wie den Kindle auszuliefern. Weil diese Mikrooptimierung aber kaum jemand betreibt, machen die Geräte selbst was Gutes aus dem CSS -- weshalb wiederum niemand diese Mikrooptimierung betreibt.

Im Firefox kann man Windows-Versionen und Betriebssystem-Stile erkennen und mit seienm Styling darauf reagieren. Feature-Queries wie `
`-moz-os-version:windows-win10`, `-moz-mac-graphite-theme` und `-moz-windows-theme:aero` regeln das.


## Media Queries Level 4

Noch im [Draft-Status](https://drafts.csswg.org/mediaqueries-4/#media) sind Media Queries Level 4. Sie versprechen Features wie `hover` (kann ich über Elemente hovern?), `pointer` (wie genau kann ich Elemente treffen -- Mauszeiger vs Wurstfinger), `update` (Schnelligkeit beim Bildaufbau, quasi frames-per-second) und mehr.

`device-width`, `device-height`, und damit auch device-aspect-ratio` sind deprecated.


# (3) Was mir fehlt

* Bessere Erkennung von Bandbreite/Netzwerkgeschwindigkeit. Zum Beispiel kann Wifi langsamer sein als Cellular via LTE. Da hilft `navigator.connection.type` nicht unbedingt weiter.
* Statt Wifi/Cellular will man eigentlich wissen: Hat der User eine Flatrate, oder zählt jedes MB? Andererseits will ich beim Surfen diese Info auch nicht unbedingt preisgeben.
* [Container Queries](https://alistapart.com/article/container-queries-once-more-unto-the-breach)
* Geräte-Geschwindigkeit oder RAM. Ich möchte wissen, ob das Gerät schwach ist. Die CPU-Zahl via `navigator.hardwareConcurrency` hilft schon.
* Queries an Script-Tags:

<pre>&lt;script media="screen and not (doNotTrack)" src="https://google.com/analytics.js" defer integrity="abc"&gt;
&lt;script media="screen and (bandwidth:high)" src="/immersiveEffects.js" defer integrity="xyz"&gt;
</script></pre>

