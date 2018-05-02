---
title: Single Point Of Failure auf News-Websites
date: 2016-10-31
datelabel: 31. Oktober 2016
language: de
tags: [Webentwicklung]
permalink: spof-auf-news-websites
draft: false
description: Kaputte Third-Party Scripts können Websites lahmlegen. Ich untersuche einige Nachrichten-Websites auf deren Robustheit gegen dieses Problem.
---

Moderne Websites binden häufig Inhalte und Code von fremden Servern ein. Seien es Social-Media-Widgets, Tracking, oder Werbung. News-Websites verwenden all diese Dinge. Und damit ist die Verfügbarkeit und Geschwindigkeit der News-Website unter Umständen abhängig von der Verfügbarkeit und Geschwindigkeit der fremden Anbieter. Was diese Umstände sind, wie man sie erkennt, und ausschaltet, erkläre ich in diesem Artikel an einigen Beispielen.

# Was ist ein SPOF und was ist daran schlimm?

Ein "Single Point of Failure" (SPOF) ist ein Bestandteil eines Systems, dessen Ausfall das gesamte System beeinträchtigt. Auf einer Website heißt das: ein Element der Website, das die gesamte Seite beeinträchtigt, wenn es einen Fehler hat, langsam ist, oder überhaupt nicht verfügbar ist. Was eine "Beeinträchtigung der Seite" ist, darüber kann man streiten. Im Kontext dieses Artikels ist eine News-Website beeinträchtigt, wenn man keine Inhalte lesen kann.

# Wie entsteht so etwas?

Der SPOF kann auf einer Website an verschiedenen Stellen sitzen. Offensichtlich ist der Fall, dass der Server, der die HTML-Seiten ausliefert, nicht verfügbar ist. Dann gibt es schlicht keine Inhalte. Das ist der Worst Case, und es gibt Strategien dagegen, aber das soll hier nicht das Thema sein.

Interessant sind die Situationen, in denen der eigentliche Inhalt &mdash; das HTML &mdash; sehr wohl verfügbar ist. Aber externe Scripte den schon geladenen Inhalt dann verzögern, beschädigen, oder blockieren. Ein nicht notwendiger Bestandteil der Seite blockiert also den wichtigen Teil. Das ist ärgerlich, weil unnötig. Diesen Fällen möchte ich mich hier widmen.

# Simulation von SPOF

Die beschriebene Situation, dass ein externer Bestandteil &mdash; oder besser Zusatz &mdash; einer Website dieselbe lahmlegt, lässt sich künstlich simulieren.

Steve Souders befasst sich in dem sehr guten Artikel "[Frontend SPOF](https://www.stevesouders.com/blog/2010/06/01/frontend-spof/)" mit SPOFs. Auch die Präsentation "[Frontend SPOF](http://de.slideshare.net/patrickmeenan/frontend-spof)" von Patrick Meenan beleuchtet das Problem und liefert einen tollen Trick, mit dem man einen beliebigen Server (genauer: Host) als kaputt simulieren kann. Und zwar über einen manipulierten DNS-Eintrag. Die Domain des zu testenden Hosts wird mittels der lokalen Hosts-Datei auf dem Testrechner ins Leere geführt. Man weist ihm einfach eine falsche IP-Adresse zu.

Das kann entweder Localhost sein. In dem Fall würde der Request schnell fehlschlagen, meist mit Fehler 404. Das simuliert einen Third-Party-Server, der schnell mit einem Fehler antwortet. Oder man leitet den Request zum "Blackhole-Service" vom Webpagetest.org. Dieser Server antwortet einfach nicht auf Requests, und lässt diese somit in einen Timeout laufen. Damit simuliere ich, dass ein Third-Party-Server überlastet ist.

Es gibt eine Extension für den Google-Chrome Browser, die auf SPOF hinweist und die jeweiligen Resourcen auch blockieren kann: [SPOF-O-Matic](https://chrome.google.com/webstore/detail/spof-o-matic/plikhggfbplemddobondkeogomgoodeg). Damit lassen sich SPOF auch gut simulieren.


# Zur Sache: Single Points of Failure auf deutschen News-Websites

Für meinen Test habe ich acht deutsche Nachrichten-Websites herangezogen. Grundlage für meine Auswahl waren die Zugriffszahlen laut Statista, plus die taz aus eigenem Interesse.

Mein Vorgehen: im jeweiligen Quellcode der Seite habe ich nach den beiden Triggern für blockierendes JavaScript gesucht: `document.write` und `<script src=""` ohne `async`.

Von der Liste der gefundenen Dateien habe ich diejenigen ausgenommen, die unter der Domain der Zeitung selbst laufen. Auch wenn Subdomains in der Art `scripts.zeit.de` oder `code.bildstatic.de` vielleicht schon Third-Party sind (CDN bzw Proxy-Server zu einem anderen Hoster), habe ich das als selbst gehostet gewertet. Im Sinne von "wenn das ausfällt, ist kein Fremder schuld sondern du selber".

Die übrigen Hosts habe ich dann in meiner `/etc/hosts`-Datei blockiert, indem ich sie auf die IP des Webpagetest Blackhole schicke: `72.66.115.13	www.googletagmanager.com`. Das funktioniert auch in [anderen Betriebssystemen]("https://de.wikipedia.org/wiki/Hosts_(Datei)#Pfade_unter_verschiedenen_Betriebssystemen").

## Test 1: IVW Zählung

Es gibt eine Sache, die alle betrachteten Websites gemeinsam haben. Und zwar die "IVW-Zählung". Die IVW ist die "[Informationsgemeinschaft zur Feststellung der Verbreitung von Werbeträgern](https://de.wikipedia.org/wiki/Informationsgemeinschaft_zur_Feststellung_der_Verbreitung_von_Werbetr%C3%A4gern)". Sie erfasst die Reichweite vieler Medien, und dient damit nicht nur zur unabhängigen Zählung der Besucher, sondern auch zur Verteilung von Werbeerlösen.

Da machen alle betrachteten Medien mit, und daher haben auch alle die Datei `https://script.ioam.de/iam.js` eingebunden. Was passiert also, wenn ich den Host `script.ioam.de` blockiere &mdash; oder er tatsächlich ausfällt bzw lahmt?

<table>
	<thead>
		<tr>
			<td></td>
			<td>Bild</td>
			<td>Spiegel</td>
			<td>Focus</td>
			<td>Welt</td>
			<td>Stern</td>
			<td>SZ</td>
			<td>taz</td>
			<td>Zeit</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>IVW</td>
			<td class="red">blockiert</td>
			<td class="red">blockiert</td>
			<td class="red">blockiert</td>
			<td class="green">ok</td>
			<td class="red">blockiert</td>
			<td class="red">blockiert</td>
			<td class="red">blockiert</td>
			<td class="red">blockiert</td>
		</tr>
	</tbody>
</table>

Alle Seiten bis auf welt.de bleiben weiß! Der Nutzer sieht keinen Inhalt, und nichts passiert solange das Zähl-Script der IWV geladen und ausgeführt wird. Wenn deren Server nicht antwortet, bleibt die News-Website also etliche Sekunden lang (bei meinen Tests im aktuellen Chrome 2 Minuten) weiß. Obwohl alle Inhalte eigentlich schon da sind.

Auch unter besten Bedingungen hat das einen Performance-Impact. Bei meinen Tests benötigte das Script zwischen 35 und 180ms zum Laden. Jede Seite muss also immer warten. Meistens unmerklich. Erst wenn es Probleme beim Laden gibt, wird der Single Point of Failure zu einem Problem.

Einzig die Welt lädt ihren Zählpixel asynchron und im Footer der Seite. Das heißt, auch wenn es beim Laden Probleme gibt, wird immerhin der gesamte Inhalt dargestellt.

## Test 2: Google Analytics und Google TagManager

Als nächstes habe ich mir die Standardtools von Google angesehen. Auch sie werden von fast allen Medien genutzt.

<table>
	<thead>
		<tr>
			<td></td>
			<td>Bild</td>
			<td>Spiegel</td>
			<td>Focus</td>
			<td>Welt</td>
			<td>Stern</td>
			<td>SZ</td>
			<td>taz</td>
			<td>Zeit</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Google Analytics</td>
			<td>-</td>
			<td class="green">ok</td>
			<td>-</td>
			<td class="green">ok</td>
			<td class="green">ok</td>
			<td>-</td>
			<td>-</td>
			<td>-</td>
		</tr>
		<tr>
			<td>Google TagManager</td>
			<td>-</td>
			<td>-</td>
			<td class="green">ok</td>
			<td>-</td>
			<td>-</td>
			<td class="green">ok</td>
			<td>-</td>
			<td class="green">ok</td>
		</tr>
	</tbody>
</table>

Da Google die Einbindung grundsätzlich asynchron empfiehlt, stellen diese Tools keinen SPOF dar. Und folglich spielen auch alle Dinge, die über den TagManager nachgeladen werden (zum Beispiel Analytics, das dann auch nicht mit betrachtet wird), keine Rolle mehr für die Untersuchung. Dass sie die korrekt geladene Seite dennoch wieder langsam machen und bis zur Unkenntlichkeit manipulieren können, ist hier nicht das Thema.

## Test 3: Facebook und Twitter

Einzig die Süddeutsche Zeitung bindet auf der Homepage direkt (ohne Umweg über den Google TagManager) Facebook und Twitter Krams ein. Beides aber nicht blockierend. Also kein SPOF.

## Test 4: Chartbeat

Chartbeat ist ein Tool, mit dem man live die Besucherstöme auf einer Website anschauen kann, samt Herkunft und Interaktionen.

<table>
	<thead>
		<tr>
			<td></td>
			<td>Bild</td>
			<td>Spiegel</td>
			<td>Focus</td>
			<td>Welt</td>
			<td>Stern</td>
			<td>SZ</td>
			<td>taz</td>
			<td>Zeit</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Chartbeat</td>
			<td>-</td>
			<td>-</td>
			<td>-</td>
			<td>-</td>
			<td class="green">ok</td>
			<td class="red">blockiert</td>
			<td>-</td>
			<td>-</td>
		</tr>
	</tbody>
</table>

Der Stern und die SZ binden Chartbeat auf ihrer Homepage ein. Und bieten ein schönes Beispiel dafür, dass der SPOF nicht zwingend durch den Drittanbieter verursacht wird, sondern man selbst durch die Art der Einbindung Einfluss darauf hat. Hat Chartbeat Probleme, reißt es die Süddeutsche mit rein. Der Stern lädt das Script asynchron, und ist damit nicht abhängig.

## Test 5: Werbung

Die Einbindung der Werbung ist sehr unterschiedlich gelöst. Und häufig über die eigenen Server. So werden Scripte gern mal blockierend eingebunden, auch über document.write, aber über eigene Domains (Beispielsweise `<script type="text/javascript" src="http://scripts.zeit.de/iqd/iqd_gzip_test.js.gz"></script>`). Diese Fälle lasse ich hier außen vor.

<table>
	<thead>
		<tr>
			<td></td>
			<td>Bild</td>
			<td>Spiegel</td>
			<td>Focus</td>
			<td>Welt</td>
			<td>Stern</td>
			<td>SZ</td>
			<td>taz</td>
			<td>Zeit</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Werbung</td>
			<td class="red">blockiert</td>
			<td class="red">blockiert</td>
			<td class="green">ok</td>
			<td class="green">ok</td>
			<td class="green">ok</td>
			<td class="red">blockiert</td>
			<td class="green">ok</td>
			<td class="green">ok</td>
		</tr>
	</tbody>
</table>

Wieder einmal macht es die Welt richtig. Sie benutzt den gleichen Werbeserver wie die Bild, aber bindet das Script asynchron ein (es gibt einen Feature-Toggle: offenbar werden synchron und asynchron verglichen).

Auf verschiedene Wege verhindern auch andere Seiten den SPOF: Der Stern lädt das Werbescript asynchron und vom eigenen Server. Die Zeit blockierend vom eigenen Server. Die taz asynchron von fremden Servern.

Bei Bild, Spiegel und Süddeutscher Zeitung leidet die Website, wenn das Werbenetzwerk langsam antwortet.

# Sonstige Beobachtungen

- Bild.de bindet am meisten blockierende Scripte ein. Das umfasst eigene nicht zusammengefassten Scripte (über eigene Domains), verschiedenen Werbeserver,  Content-Marketing-Gedöns ("Outbrain", dieselbe Datei mehrfach geladen), und nicht zuletzt den AdBlocker-Blocker. Eines der Werbe-Scripte wird auf Artikeln blockierend eingebunden, auf der Homepage jedoch asynchron.
- Ein Ausfall von `ec-ns.sascdn.com` für bild.de löst den AdBlocker-Blocker aus und zeigt den Nutzern einen Hinweis, man möge doch bitte seinen AdBlocker ausschalten.
- Das Tracking-Script "Meetrics" auf ZEIT Online ist blockierend eingebunden, aber im Fuß der Seite. Damit wird bei einem Ausfall das Rendern der Seite angehalten. Aber eben nur das Rendern des Seitenfußes. Der gesamte Inhalt, der vorher im HTML steht, ist sichtbar.
- Die Süddeutsche und die Welt betreiben Real User Monitoring für Frontend Performance mittels <code>window.performance.mark</code>. Das ist eigentlich ein alter Hut, aber bei News-Websites sind sie damit Vorreiter.
- Der Google Chrome Browser wird in Zukunft bei mobilen Datenverbindungen (2G) von selbst Scripte ignorieren, die blockierend von einem langsamen Netzwerk geladen werden: [Intervening against document.write()](https://developers.google.com/web/updates/2016/08/removing-document-write).

# Zusammenfassung

<table>
	<thead>
		<tr>
			<td></td>
			<td>Bild</td>
			<td>Spiegel</td>
			<td>Focus</td>
			<td>Welt</td>
			<td>Stern</td>
			<td>SZ</td>
			<td>taz</td>
			<td>Zeit</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>IVW</td>
			<td class="red">blockiert</td>
			<td class="red">blockiert</td>
			<td class="red">blockiert</td>
			<td class="green">ok</td>
			<td class="red">blockiert</td>
			<td class="red">blockiert</td>
			<td class="red">blockiert</td>
			<td class="red">blockiert</td>
		</tr>
		<tr>
			<td>Google Analytics</td>
			<td>-</td>
			<td class="green">ok</td>
			<td>-</td>
			<td class="green">ok</td>
			<td class="green">ok</td>
			<td>-</td>
			<td>-</td>
			<td>-</td>
		</tr>
		<tr>
			<td>Google TagManager</td>
			<td>-</td>
			<td>-</td>
			<td class="green">ok</td>
			<td>-</td>
			<td>-</td>
			<td class="green">ok</td>
			<td>-</td>
			<td class="green">ok</td>
		</tr>
		<tr>
			<td>Chartbeat</td>
			<td>-</td>
			<td>-</td>
			<td>-</td>
			<td>-</td>
			<td class="green">ok</td>
			<td class="red">blockiert</td>
			<td>-</td>
			<td>-</td>
		</tr>
		<tr>
			<td>Werbung</td>
			<td class="red">blockiert</td>
			<td class="red">blockiert</td>
			<td class="green">ok</td>
			<td class="green">ok</td>
			<td class="green">ok</td>
			<td class="red">blockiert</td>
			<td class="green">ok</td>
			<td class="green">ok</td>
		</tr>
	</tbody>
</table>

Mit ihrer Ansage, durch den Relaunch im September 2016 die schnellste News-Website in Deutschland zu werden, meinte die Welt es ernst. Best Practices wurden offenbar konsequent verfolgt, notfalls auch um den Preis von IVW-Zählungen (so meine Vermutung). Dass Lade- und Render-Zeiten von verschiedenen Punkten auf der Website mittels <code>window.performance.mark</code> gemessen werden, deutet auf eine genaue Beobachtung der Performance hin &mdash; was überhaupt erst einmal die Grundlage einer vernünftigen Optimierung ist.

Die Bild hingegen verfolgt das Gegenteil. Hier gibt es viel Blocking, zum Beispiel vom Clickbait-Inhalte-Lieferanten Outbrain, und einen AdBlocker-Blocker, der bei Versagen des ThirdParty Servers zu unrecht anspringt.

Wenn ohne Werbung auch kein Inhalt geliefert wird, kann das vielleicht verargumentiert werden &mdash; schließlich werden AdBlocker-Blocker genau mit dieser Begründung gerechtfertigt.

Dass aber ein Tracking-Tool wie Chartbeat oder eine Bibliothek wie jQuery in der Lage ist, die Webseite lahmzulegen, ist ein leicht zu vermeidendes Desaster. Und kein theoretisches: [jQuery](https://twitter.com/the_jsf/status/529302161499619328), [SoundCloud](https://twitter.com/SCsupport/status/789546288530403328).

# One more thing

Bitte nicht vergessen, die Tracking-Domains aus der Hosts-Datei zu entfernen. Wäre doch schade, wenn die Scripte nicht mehr geladen würden.

<pre># Tracker-Blocking
127.0.0.1       www.googletagmanager.com
127.0.0.1       www.google-analytics.com
127.0.0.1       widgets.outbrain.com
127.0.0.1       connect.facebook.net
127.0.0.1       platform.twitter.com
127.0.0.1       static.chartbeat.com
</pre>
