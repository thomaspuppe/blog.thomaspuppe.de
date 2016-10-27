---
title: Single Point Of Failure auf News-Websites
date: 2016-10-26
datelabel: 26. Oktober 2016
language: de
tags: [Webentwicklung]
permalink: spof-auf-news-websites
draft: false
description: Kaputte Third-Party Scripts können Websites lahmlegen. Ich untersuche einige Nachrichten-Websites auf deren Robustheit für dieses Problem.
---

Moderne Websites binden häufig Inhalte und Code von fremden Servern ein. Seien es Social-Media-Widgets, Tracking, oder Werbung. News-Websites verwenden all diese Dinge. Und damit ist die Verfügbarkeit und Geschwindigkeit der News-Website unter Umständen abhängig von der Verfügbarkeit und Geschwindigkeit der fremden Anbieter. Was diese Umstände sind, wie man sie erkennt, und ausschaltet, erkläre ich in diesem Artikel an einigen Beispielen.

# Was ist ein SPOF und was ist daran schlimm?

Ein "Single Point of Failure" (SPOF) ist ein Bestandteil eines Systems, dessen Ausfall das gesamte System beeinträchtigt. Auf einer Website heißt das: ein Element der Website, das die gesamte Seite beeinträchtigt, wenn es einen Fehler hat, langsam ist, oder überhaupt nicht verfügbar ist. Was eine "Beeinträchtigung der Seite" ist, darüber kann man streiten. Im Kontext dieses Artikels ist eine News-Website beeinträchtigt, wenn man keine Inhalte lesen kann.

# Wie entsteht so etwas?

Der SPOF kann auf einer Website an verschiedenen Stellen sitzen. Offensichtlich ist der Fall, dass der Server, der die HTML-Seiten ausliefert, nicht verfügbar ist. Dann gibt es keine Inhalte, die mit weiteren Scripten "angereichert" werden könnten. Das ist der Worst Case, und es gibt Strategien dagegen, aber das soll hier nicht das Thema sein.

Interessant sind die Situationen, in denen der eigentliche Inhalt -- das HTML -- sehr wohl verfügbar ist. Aber externe Scripte den schon geladenen Inhalt dann verzögern, beschädigen, blockieren. Diesen Fällen möchte ich mich hier widmen.



# Simulation von SPOF

Steve Souders befasst sich in dem sehr guten Artikel "[Frontend SPOF](https://www.stevesouders.com/blog/2010/06/01/frontend-spof/)" mit SPOFs und liefert einen tollen Trick, mit dem man einen kaputten Server simulieren kann. Und zwar wird der Domain des zu testenden Hosts mittels der lokalen Hosts-Datei auf dem Testrechner ins Leere geführt. Man weist ihm einfach eine falsche IP-Adresse zu.

Das kann entweder Localhost sein. In dem Fall würde der Request schnell fehlschlagen, meist mit Fehler 404. Das simuliert einen kaputten Third-Party_Server. Oder man leitet den Request zum "Blackhole-Service" vom Webpagetest.org. Dieser Server antwortet einfach nicht auf Requests, und lässt diese somit in einen Timeout laufen. Das simuliert, dass ein Third-Party-Server überlastet ist.




Wenn ohne Werbung auch kein Inhalt geliefert wird, kann das vielleicht verargumentiert werden -- schließlich werden AdBlocker-Blocker genau mit dieser Begründung gerechtfertigt.

Dass aber ein Tracking-Tool wie Chartbeat in der Lage ist, die Webseite lahmzulegen, ist ein Desaster. Und kein theoretisches. Genau das ist (auch mir) schon passiert: TODO: Quelle suchen.

TODO: jQuery Outage suchen




- http://de.slideshare.net/patrickmeenan/frontend-spof
-

- Google sperrt document.write aus

# Wie umgeht man den SPOF?


# Simulation


- https://www.stevesouders.com/blog/2010/06/01/frontend-spof/ (mit Hosts-Sache)

Weil localhost schnell fehlschlägt, bracht es das Blackhole.

- Extension https://chrome.google.com/webstore/detail/spof-o-matic/plikhggfbplemddobondkeogomgoodeg

-


#

> Weil localhost schnell fehlschlägt, bracht es das Blackhole.

Wenn es schnell fehlschlagen soll, dann ist localhost cool. So kann man z.B. bestimmte Tracker effektiv und systemweit ausschalten (AdBlocking/Trackblocking home made).


# Zur Sache: SPOF auf deutschen News-Websites

Für meinen Test habe ich acht deutsche Nachrichten-Websites herangezogen. Grundlage für meine Auswahl waren die Zugriffszahlen laut Statista, und die taz aus Interesse.

Mein Vorgehen: im jeweiligen Quellcode der Seite habe ich nach den beiden Triggern für blockierendes JavaScript gesucht: `document.write` und `<script src=""` ohne `async`. Von der Liste der gefundenen Dateien habe ich diehjenigen ausgenommen, die unter der Domain der zeitung laufen. Auch wenn Subdomains in der Art `scripts.zeit.de` oder `code.bildstatic.de`  vielleicht schon eine Art third-party sind (CDN bzw Proxy_Server zu einem anderen Hoster), habe ich das als Self-Hosted gewertet. Im Sinne von "wenn das ausfällt, ist kein Fremder schuld sondern du selber". Die übrigen Hosts habe ich dann in meiner `/etc/hosts`-Datei blockiert, indem ich sie auf die IP des Webpagetest Blackhole schicke: `72.66.115.13	www.googletagmanager.com`.


## Test 1: IVW Zählung

Es gibt eine Sache, die alle betrachteten Websites gemeinsam haben. Und zwar die "IVW-Zählung". Die IVW ist die "[Informationsgemeinschaft zur Feststellung der Verbreitung von Werbeträgern](https://de.wikipedia.org/wiki/Informationsgemeinschaft_zur_Feststellung_der_Verbreitung_von_Werbetr%C3%A4gern)". Sie erfasst die Reichweite vieler Medien, und dient damit nicht nur zur unabhängigen Feststellung von Reichweite, sondern auch zur Verteilung von Werbeerlösen.

Da machen alle betrachteten Medien mit, und daher haben auch alle die Datei `https://script.ioam.de/iam.js` eingebunden. Was passiert also, wenn ich den Host `script.ioam.de` blockiere -- oder er tatsächlich ausfällt bzw lahmt?

<table>
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
	<tr>
		<td>IVW</td>
		<td style="background-color:red;">BLOCKIERT</td>
		<td style="background-color:red;">BLOCKIERT</td>
		<td style="background-color:red;">BLOCKIERT</td>
		<td style="background-color:green;">läuft</td>
		<td style="background-color:red;">BLOCKIERT</td>
		<td style="background-color:red;">BLOCKIERT</td>
		<td style="background-color:red;">BLOCKIERT</td>
		<td style="background-color:red;">BLOCKIERT</td>
	</tr>
</table>

Alle Seiten bis auf welt.de bleiben weiß. Der Nutzer sieht keinen Inhalt, und nichts passiert solange das Zähl-Script der IWV geladen und ausgeführt wird.

Auch unter besten Bedingungen hat das einen Performance-Impact. Bei meinen Tests benötigte das Script zwischen 35 und 180ms zum Laden. Jede Seite muss also immer warten. Meistens unmerklich. Erst wenn es Probleme beim Laden gibt, wird der Single Point of Failure zu einem Problem.

Einzig die Welt lädt ihren Zählpixel asynchron und im Footer der Seite. Das heißt, auch wenn es beim Laden Probleme gibt, wird immerhin der gesamte Inhalt dargestellt.


## Test 2: Gogole Analytics und TagManager

Als nächstes habe ich mir die Standardtools von Google angesehen. Auch sie werden von fast allen Medien genutzt.

<table>
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
	<tr>
		<td>Google Analytics</td>
		<td>-</td>
		<td style="background-color:green;">OK</td>
		<td>-</td>
		<td style="background-color:green;">OK</td>
		<td style="background-color:green;">OK</td>
		<td>-</td>
		<td>-</td>
		<td>-</td>
	</tr>
	<tr>
		<td>Google TagManager</td>
		<td>-</td>
		<td>-</td>
		<td style="background-color:green;">OK</td>
		<td>-</td>
		<td>-</td>
		<td style="background-color:green;">OK</td>
		<td>-</td>
		<td style="background-color:green;">OK</td>
	</tr>
</table>

Da Google die Einbindung grundsätzlich asynchron empfiehlt, stellen diese Tools keinen SPOF dar. Und folglich spielen auch alle Dinge, die über den TagManager nachgeladen werden (zum Beispiel Analytics, das dann auch nicht mit betrachtet wird), keine Rolle mehr für die Untersuchung. Dass sie die korrekt geladene Seite dennoch wieder langsam machen und bis zur Unkenntlichkeit manipulieren können, ist hier nicht das Thema.


## Test 3: Facebook und Twitter

Einzig die Süddeutsche Zeitung bindet auf der Homepage direkt (ohne Umweg über den Google TagManager) Facebook und Twitter Krams ein. Beides aber nicht blockierend. Also kein SPOF.


## Test 4: Chartbeat

Chartbeat ist ein Tool, mit dem man live die Besucherstöme auf einer Website anschauen kann, samt Herkunft und Interaktionen.

<table>
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
	<tr>
		<td>Chartbeat</td>
		<td>-</td>
		<td>-</td>
		<td>-</td>
		<td>-</td>
		<td style="background-color:green;">OK</td>
		<td style="background-color:red;">BLOCKIERT</td>
		<td>-</td>
		<td>-</td>
	</tr>
</table>

Der Stern und die SZ binden Chartbeat auf ihrer Homepage ein. Und bieten ein schönes Beispiel dafür, dass der SPOF nicht zwingend durch den Drittanbieter verursacht wird, sondern man durch die Art der Einbindung selbst Einfluss darauf hat. Hat Chartbeat Probleme, reißt es die Süddeutsche mit rein. Der Stern lädt das Script asynchron, und ist damit nicht abhängig.




# Test 5: Werbung

Die Einbindung der Werbung ist sehr unterschiedlich gelöst. Und häufig über die eigenen Server. So werden Scripte gern mal blockierend eingebunden, auch über document.write, aber über eigene Domains (Beispielsweise `<script type="text/javascript" src="http://scripts.zeit.de/iqd/iqd_gzip_test.js.gz"></script>`). Diese Fälle lasse ich hier außen vor.

<table>
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
	<tr>
		<td>Werbung</td>
		<td style="background-color:red;">BLOCKIERT</td>
		<td style="background-color:red;">BLOCKIERT</td>
		<td style="background-color:green;">OK</td>
		<td style="background-color:green;">OK</td>
		<td style="background-color:green;">OK</td>
		<td style="background-color:red;">BLOCKIERT</td>
		<td style="background-color:green;">OK</td>
		<td style="background-color:green;">OK</td>
	</tr>
</table>

Wieder einmal macht es die Welt richtig. Sie benutzt den gleichen Werbeserver wie die Bild, aber bindet das Script asynchron ein. Vorbildlich.

## Sonstige Beobachtungen

- Bild.de bindet am meisten blockierende Scripte ein. Das umfasst eigene nicht zusammengefassten Scripte (über eigene Domains), verschiedenen Werbeserver,  Content-Marketing-Gedöhns ("Outbrain", dieselbe Datei mehrfach geladen), nicht zuletzt der AdBlocker-Blocker. Eins der Werbe-Scripte wird auf Artikeln blockierend und auf der Homepage asynchron eingebunden.
- Ein Ausfall von `ec-ns.sascdn.com` für bild.de löst den AdBlocker-Blocker aus und zeigt den Nutzern einen Hinweis, man möge doch den AdBlocker ausschalten.
- Das Tracking-Script "Meetrics" auf ZEIT Online ist blockierend eingebunden, aber im Fuß der Seite. Damit wird bei einem Ausfall das Rendern der Seite angehalten. Aber eben nur des Seitenfußes. Der gesamte Inhalt, der vorher im HTML steht, ist sichtbar.



# Auffälligkeiten

- RUM: window.performance.mark im Einsatz (Süddeutsche, Welt)
- taz: Content Management: openNewspaper www.opennewspaper.org based on TYPO3 www.typo3.org


## Quellen:

- http://de.slideshare.net/patrickmeenan/frontend-spof
- https://www.stevesouders.com/blog/2010/06/01/frontend-spof/
