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

Dass aber ein Tracking-Tool wie Chartbeat in der lage ist, die Webseite lahmzulegen, ist ein Desaster. Und kein theoretisches. Genau das ist (auch mir) schon passiert: TODO: Quelle suchen.

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



Süddeutsche
- Chartbeat


ZEIT Online
- http://static.chartbeat.com/js/chartbeat_mab.js



------------------------------

Weitere Performance-Sachen:
- Gewichtsvergleich, Ladezeit, Scores
- Textinhalt/Gesamtcode Verhältnis der HP und eines Artikels
-


## Quellen:

- http://de.slideshare.net/patrickmeenan/frontend-spof
- https://www.stevesouders.com/blog/2010/06/01/frontend-spof/
