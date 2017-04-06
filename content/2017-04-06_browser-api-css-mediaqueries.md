---
title: Coole Browser APIs und CSS Media Queries
date: 2017-04-06
datelabel: 06. April 2017
language: de
tags: [Webentwicklung]
permalink: browser-api-css-mediaqueries
draft: true
description:
---

Kürzlich sah ich in einer interessanten [Präsentation über Progressive Web Apps](https://speakerdeck.com/grigs/why-you-should-build-a-progressive-web-app-now-1) dies:

@media (display-mode: standalone), (display-mode: fillscreen) {
	.backButton {
		display: block;
	}
}

(1) Browser APIs

## navigator.cookieEnabled

Eigentlich ganz simpel, kannte ich aber bis heute noch nicht. Ist natürlich der  Methode, ein Cookie zu setzen und dann auszulesen, zu bevorzugen. Breite Browser-Unterstützung.

> Auf diesem Browser: <script>document.write(navigator.cookieEnabled || '<em>undefined</em>')</script>

## navigator.doNotTrack

Zeigt an, ob im Browser "Do not track" gesetzt wurde -- und auf welchen Wert. Ist in vielen browsern implementiert, aber der [Rückgabewert ist unterscheidlich](https://blog.thomaspuppe.de/do-not-track-header-crossbrowser) und muss geparsed werden.

> Auf diesem Browser: <script>document.write(navigator.doNotTrack || '<em>undefined</em>')</script>

## navigator.getBattery().then(function(e){console.log(e)})
https://developer.mozilla.org/en-US/docs/Web/API/BatteryManager


## navigator.hardwareConcurrency

Gibt die Zahl der verfügbaren Prozessoren zurück. Das ist ein grober Indikator dafür, ob der Browser auf einem ein starken neuen Gerät läuft, oder einer alten Möhre. (Vielleicht kann man auch auf die sinnvolle Anzahl an Service Workern oder Web Workern schließen? Gibt ein Browser-Tab, das in einem Prozess läuft, solche Möglichkeiten her?)

> Auf diesem Browser: <script>document.write(navigator.hardwareConcurrency || '<em>undefined</em>')</script>

## navigator.geolocation

> Auf diesem Browser: <script>document.write(navigator.geolocation || '<em>undefined</em>')</script>

## navigator.onLine

> Auf diesem Browser: <script>document.write(navigator.onLine || '<em>undefined</em>')</script>


navigator.storage


## navigator.share()

https://developers.google.com/web/updates/2016/10/navigator-share

Mit disem Button kann man per JS auslösen, was sonst aus dem Menü getriggert wird. Der Vorteil gegenüber individuellen Sharing-Buttons: die Leute bekommen genau die Dienste angeboten, die sie zur Verfügung haben -- und nicht die der Seitenbetreiber für wichtig hielt.

navigator.share({
    title: document.title,
    text: "Hello World",
    url: window.location.href
})

Alle Parameter müssen Strings sein. Ob diese aus JavaScript kommen oder hardcoded sind, ist egal. Test oder URL können weggelasssen werden.

Zurückgegeben wird eine Promise. Man kann den User also fürs Sharen belohnen oder Abbruchraten tracken.

Ein paar Einschränkungen hat die Technik: Sie ist nur auf HTTPS-Seiten verfügbar, und kann nur durch User-Interaktion getriggert werden (nicht etwa onLoad oder onScroll -- Sorry lieber "User Engager"). Navigator.share() ist derzeit nur im Chrome (ab Version 55) verfügbar. Wie bei allen aktuellen Features wird der Entwickler also progressively enhancen (`navigator.share !== undefined`).

Mozilla verfolgte einen ähnlichen Ansatz:

https://github.com/mozilla/f1/wiki/navigator-share-api




https://developer.mozilla.org/en-US/docs/Web/API/Navigator/permissions
https://developer.mozilla.org/en-US/docs/Web/API/NetworkInformation
https://developer.mozilla.org/en-US/docs/Web/API/Presentation
https://developer.mozilla.org/en-US/docs/Web/API/Navigator/sendBeacon
https://developer.mozilla.org/en-US/docs/Web/API/Web_Workers_API



TODO: Bei Chrome nachsehen


## navigator.vibrate(500)

Lässt das Gerät vibrieren, wenn das verfügbar ist. Als Parameter nimmt die Funktion einen Integer (einmalige Vibration für x Millisekunden) oder ein Array (Pattern von Vibration und Pause) entgegen. `navigator.vibrate([100,200,300])` vibriert also 100 ms, pausiert 200 ms, vibriert 300 ms. Verfügbar in modernen mobilen Browsern ([caniuse?](http://caniuse.com/#search=vibration)). Die Funktion steht aber auch in nicht-vibrierfähigen Geräten zur Verfügung und lässt sich nicht prüfen. Zur Erkennung muss man also über die Device-Detection gehen.


navigator.watch()
navigator.permissions
navigator.sendBeacon()

navigator.battery
navigator.connection

Navigator.standalone


NetworkInformation.type
- https://developer.mozilla.org/en-US/docs/Web/API/NetworkInformation



# (2) Media Queries


## (device-)aspect-ratio

...

Wenig beachtet ist der Unterschied zwischen device-aspect-ratio und aspect-ratio. Letztere beschreibt die Ratio des Fensters -- nicht des Gerätes. Besonders auf großen Bildschirmen, wo man im Split Screen arbeitet (was mittlerweile auch auf Tablets kein Problem mehr ist), kann das Fenster komplett anders als das Gerät sein. Lässt sich mit min/max kombinieren:

@media screen and (device-aspect-ratio: 16/9), screen and (device-aspect-ratio: 16/10) { ... }


## orientation

Eine simplere Variante der ratio. Nimmt die Werte `landscape` oder `portrait` an.

@media all and (orientation: portrait) { ... }


## resolution

Erkennt die Pixeldichte auf einem Gerät, und wird vor Allem genutzt, um Retina-optimierte Bilder auszuliefern (`min-resolution: 300dpi`).

## display-mode


## light-level

Beschreibt die Lichtverhältnisse in der Umgebung, und nimmt die Werte "dim" (gedämpft), "normal" und "washed" (sehr hell) an. Eigentlich praktisch für so etwas wie den Nacht-Lese-Modus. Andererseits sehe ich hier die Gefahr, dass man mit seinen Queries die Nutzereinstellungen oder automatische Helligkeitsanpassung des Smartphones überschreibt -- "das Gegenteil von gut ist gut gemeint". Unterstützt wird `light-level` nur im Edge und im Firefox für OS X.

## supports

Erst heute in einem [Vortrag des Kollegen Brünjes](https://github.com/codecandies/grid-talk) gesehen. Außerhalb leider selten. Mit dieser Feature Query prüft man, ob der Browser bestimmte CSS-Eigenschaften unterstützt. Zum Beispiel `@supports(blink)` oder `@supports (display: grid)`.

In den meisten Fällen lässt sich die Abfrage bzw. das progressive Enhancement direkt in die CSS-Regeln einbauen. Zum Beispiel bei Schriftgrößen via `font-size:16px; font-size: 1rem;` für den IE8. Der ignoriert die zweite Angabe, mit der er nicht klarkommt, und nutzt die erste. Moderne Browser überschreiben die erste mit der zweiten.

Die Query `@supports` sorgt aber für Klarheit, wenn man größere Blöcke umstylen will, sobald eine Technik verfügbar ist. Oder aber, um eine ganz andere CSS-Datei zu laden.

<pre>&lt;link rel="stylesheet" media="all" href="basic.css" /&gt;
&lt;link rel="stylesheet" media="screen and (min-width: 5in) and (display: flex)" href="shiny.css" /&gt;</pre>

Der IE bis inklusive Version 11 unterstützt `@supports` nicht.

Der Support von Features lässt sich auch via JavaScript über die CSS-API des Browsers abfragen: `var canuiseCSSGrid = CSS.supports("(display: grid)");`.


## Exotische und

Der Vollständigkeit halber noch ein paar Media Features, die eher selten genutzt werden.

`scan` unterscheidet in der Art des Bildaufbaus am Bildschirm (interlace vs progressive), und ist relevant bei schnellen Bewegungen.

`color` und `color-index` geben an, wie viele Farben verfügbar sind und wie sie gespeichert werden, `monochrome` erkennt Geräte die nur mit Graustufen arbeiten (und mit wie vielen). `grid` spricht auf Monospace-Font Displays an, also alle die feste Plätze und Breiten für jedes Zeichen haben. Theoretisch ist das cool, um reduzierte Bilder (oder auf Kontrast optimiertes CSS) an Geräte wie den Kindle auszuliefern. Weil diese Mikrooptimierung aber kaum jemand betreibt, machen die Geräte selbst was gutes aus dem CSS -- weshalb wiederum niemand diese Mikrooptimierung betreibt.

Im Firefox kann man Windows-Versionen und Betriebssystem-Stile erkennen und mit seienm Styling darauf reagieren. Feature-Queries wie `
`-moz-os-version:windows-win10`, `-moz-mac-graphite-theme` und `-moz-windows-theme:aero` regeln das.

## Media Queries Level 4

Noch im [Draft-Status](https://drafts.csswg.org/mediaqueries-4/#media) sind Media Queries Level 4. Sie versprechen Features wie `hover` (kann ich über Elemente hovern?), `pointer` (wie genau kann ich Elemente treffen -- Mauszeiger vs Wurstfinger), `update` (Schnelligkeit beim Bildaufbau, quasi frames-per-second) und mehr.

`device-width`, `device-height`, und damit auch device-aspect-ratio` sind deprecated.

# (3) The Missing

Was um Himmels Willen endlich eingeführt werden muss:

* Bandbreite/Netzwerkgeschwindigkeit
* Wifi/Cellular (oder eigentlich: Flatrate vs jedes-MB-zählt)
* Container Queries
* Geräte-Geschwindigkeit oder RAM. Ich möchte wissen, ob das Gerät schwach ist. Die CPU-Zahl via `navigator.hardwareConcurrency` hilft schon.
* Queries an Script-Tags:

<pre>&lt;script media="screen and not (doNotTrack)" src="https://google.com/analytics.js" defer integrity="abc"&gt;
&lt;script media="screen and (bandwidth:high)" src="/immersiveEffects.js" defer integrity="xyz"&gt;
</script></pre>
