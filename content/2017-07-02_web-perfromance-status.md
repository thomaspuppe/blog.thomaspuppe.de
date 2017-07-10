---
title: Website Performance Optimierung ohne Zukunft?
date: 2017-07-01
datelabel: 02. Juli 2017
language: de
tags: [Webentwicklung]
permalink: web-performance
draft: true
description:
---

Why is Webperf so hard these days?

Früher: Dateien zusammenfügen, Bilder usw komprimieren, richtige Load Order, Cachine Header -> Das galt universell. Alle Seiten, alle Besuche.

Heute: Critical CSS (unterschiedlich, auch pro Device), Preload (weiß man nicht, welche Datei), Server Push Async (aber nur beim ersten Besuch).

Sind also alle einfachen Sachen (niedrig hängende Früchte) abgearbeitet?


CSS per JavaScript nachladen ist ein NoGo! (Wenn du "Strategien" brauchst, um dein CSS zu laden, ist es vermutlich zu viel - dann liegt dein problem woanders.)
Critical CSS rendern: ok, aber eigentlich nicht richtig.
Per Progressive Web App und Service Worker Inhalte schonmal vorzuhalten ist ok, aber der normale Browsercache soltle das meiste davon schon tun.



Wenn bei uns alles super ist, dann 3rd parties lehren

Manuelle Audits

Wahldaten, Datawrapper (ungecachte 200k für Balkngraphen)

Der britische Guardian stellt für seine Redaktion ein [Dashboard mit den langsamsten Artikeln](https://www.theguardian.com/info/developer-blog/2017/mar/06/empowering-our-editorial-teams-to-impact-page-performance) bereit. Häufig reicht das Wissen um eine langsame Seite, und die Anpassung eines Embeds (z.B.), um das Problem zu lösen.

> The tool has had significant impact. In terms of direct performance improvements, sixty percent of the pages alerted since the tool was implemented had performance problems resolved by editorial action.

Wir bei ZEIT Online haben ein

Screenshot von unserem Sitespeed Dashboard

Werbebranche hoffnungslos?
