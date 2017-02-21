---
title: News-Aufmacher zur Präsidentenwahl in den USA
date: 2016-11-09
datelabel: 09. November 2016
language: de
tags: [News-Watch]
permalink: us-wahl-aufmacher-auf-news-websites
draft: false
description: Was war der Aufmacher auf deutschen News-Websites rund um das Wahl-Wochenende? Und wer hat den Sieger als erster verkündet?
---

Kürzlich habe ich mit dem Python-Framework [Scrapy](https://scrapy.org/) herumgespielt. Erstens wollte ich ausprobieren, wie gut es sich bedienen lässt. Zweitens war ich neugierig, wie die Aufmacher von News-Websies vor und bei der US-Präsidentschaftswahl bestückt werden. Beides lässt sich praktischerweise gut kombinieren :-)

# Das Vorgehen

Zunächst habe ich die Homepages der News-Seiten mehrere Tage lang im 5-Minuten-Takt heruntergeladen.

<pre>#!/bin/bash
currenttime=`date '+%Y-%m-%d_%H-%M-%S'`;
foldername="/var/www/newscurl/$currenttime";
mkdir $foldername;
cd $foldername;

curl -o spiegel.html http://www.spiegel.de/
curl -o zeit.html http://www.zeit.de/index
curl -o lr-online.html http://www.lr-online.de/
</pre>

Damit ist das HTML der Seite gesichert, und kann später immer wieder analysiert werden. Was mit Scrapy auch recht einfach gelingt:

<pre>import os
import scrapy

class LocalSpider(scrapy.Spider):
    name = 'localspider'
    # provided via `python -m SimpleHTTPServer 9090`, since file:// url did not work
    start_urls = ['http://localhost:9090/']

    def parse_single_page(self, response):
        yield {
            'title': response.css('main article h2 a::attr(title)').extract_first(),
            'url': response.css('main article h2 a::attr(href)').extract_first(),
            'image': response.css('main article img::attr(src)').extract_first()
        }

    def parse(self, response):
    	# entry point: directory listing of localhost:9090
        for link in response.css('a'):
            link_url = link.css('::attr(href)').extract_first()

            if link_url.endswith('zeit.html'):
                yield scrapy.Request(response.urljoin(link_url), callback=self.parse_single_page)
	        else:
	            yield scrapy.Request(response.urljoin(link_url), callback=self.parse)</pre>

Mit `scrapy runspider localspider.py -o result.json --logfile=localspider.log` erhalte ich so ein [JSON-File mit allen Ergebnissen](http://lab.thomaspuppe.de/us-wahl-news-aufmacher/result.json) und ein umfangreiches Logfile des Scraping-Vorgangs.

Zum Schluss robbe ich mittels PHP über das JSON-File und gebe die Inhalte als HTML-Tabelle aus. Das Ergebnis (weder für Mobilgeräte optimiert, noch für sonstwas) schaut so aus: [http://lab.thomaspuppe.de/us-wahl-news-aufmacher/](http://lab.thomaspuppe.de/us-wahl-news-aufmacher/)


# Fazit 1: Scrapy

Die Bedienung ist sehr einfach. Scrapy war eines der ersten Python-Frameworks, das ich problemlos installieren und benutzen konnte. Das liegt vielleicht an meiner wachsenden Python-Erfahrung, wahrscheinlich war viel Glück dabei, und auf jeden Fall bietet die Scrapy-Website einen super Einstieg samt funktionierendem Hello-World.

Die Selektoren entsprechen im Grunde CSS-Selektoren. Womit mans chon sehr weit kommt. Die asynchronen yield-Aufrufe sind ein schöner Weg zur Parallelisierung der Anfragen. Der Output im JSON-Format kommt mir entgegen. Andere Varianten habe ich nicht getestet.

Insgesamt war mein Test-Case ja sehr einfach. Da sieht man nciht viel vom Framework. Aber mein erster Eindruck ist gut. Auch, weil man im Netz jede Menge Doku und Rat zu Scrapy findet. Und es eine "Scraping as a Servcie" Anbindung gib, mit der man seine Scripte in die Cloud schießt und der Dienst [Scrapinghub](https://scrapinghub.com/) sich um das regelmäßige Crawling kümmert.

# Fazit 2: Die Aufmacher

Das Ergebnis kann man hier ansehen: [Aufmacher auf deutschen News-Websites zur US-Wahl](http://lab.thomaspuppe.de/us-wahl-news-aufmacher/) (Achtung: 4 MB groß). Die Legende zeigt die Farbcodes an. Per Mouseover sieht man den Titel. Die meisten Felder sind zum Artikel verlinkt. Zoomen funktioniert. Mobil sieht man was, aber Mouseover tut natürlich nicht.

<figure>
	<img src="/images/2016/11/us-wahl-aufmacher.png" alt="Screenshot der Visualisierung Aufmacher auf deutschen News-Websites zur US-Wahl" />
	<figcaption>Screenshot der Visualisierung</figcaption>
</figure>

Was sieht man?

*Themen:* Am Freitag war die Türkei das dominante Aufmacherthema. Am Wochenende wechselte das über deutsche Politik auf die US-Wahl.

Montag ging es um Clinton (das FBI und die E-Mails), wechselte dann zu allgemeiner/beidseitiger Berichterstattung.

Dienstag hatten wir den ganzen Tag allgemeine (nicht auf einen kandidaten fokussierte) US-Wahl-Aufmacher, nur unterbrochen durch den "Prediger ohne Gesicht". Ab dem Abend dann kippte es schon in Richtung Donald Trump (klickte wohl besser).

Im Laufe der Nacht gab es zunächst allgemeine Wahlticker, bis es am Morgen dann natürlich zu Trump wechselte. Um Hillary Clinton ging es erst am Abend wieder, als sie vor die Presse trat.

Die lokalen Zeitungen aus Berlin und der Lausitz haben lokale Themen und nationale Themen als Aufmacher. Pünktlich am Mittwoch schwenkten sie zur US-Wahl. Die Morgenpost zunächst mit einer Clinton-Party in Berlin.

So weit, so erwartbar.

*Verfügbarkeit:* Alle betrachteten Angebote waren durchweg verfügbar. ZEIT Online hatte zur wichtigsten geplanten Nachrichtenlage des Jahres Aussetzer. Shame on us.

*Und sonst?*

- Die Bild-Zeitung habe ich auch gecurlt, aber das ranzige HTML erwies sich als nicht vernünftig crawlbar. Nehmen wir mal an, das sei Absicht zu Zeiten des AdBlockerBlockings.


# Der Zieleinlauf

In dieser Reihenfolge wurde der Sieg Trumps verkündet (konkrete Aussage, ohne "praktisch nicht mehr einholbar" uns so):

- 08:20 Uhr FAZ: [Liveticker zur Wahl: Donald Trump wird Präsident von Amerika](http://www.faz.net/aktuell/politik/wahl-in-amerika/us-wahl-2016-ergebnisse-und-news-im-liveticker-14508839.html)
- 08:35 Uhr Focus: [+++ US-Wahlen 2016 im Live-Ticker +++: Sie haben es so gewählt: Amerikaner machen Trump zu ihrem nächsten Präsidenten](http://www.focus.de/politik/ausland/us-wahlen-2016/us-wahlen-2016-im-live-ticker-trump-baut-fuehrung-aus-und-gewinnt-florida_id_6179418.html)
- 08:35 Uhr Lausitzer Rundschau: [Die Präsidentschaftswahl in den USA im Liveticker - Donald Trump hat laut US-Medien die Wahl gewonnen](http://www.lr-online.de/us-ticker)
- 08:40 Uhr Süddeutsche Zeitung: [US-Medien verkünden Trumps Sieg](http://www.sueddeutsche.de/politik/us-wahl-us-medien-verkuenden-trumps-sieg-1.3233721)
- 08:40 Uhr taz: [Trump hat gewonnen - taz-Liveticker zur US-Wahl 2016](http://www.taz.de/taz-Liveticker-zur-US-Wahl-2016/!5355525/)
- 08:40 Uhr Welt: [Die Sensation ist perfekt - Donald Trump wird 45. Präsident der Vereinigten Staaten](https://www.welt.de/politik/ausland/article159356634/Donald-Trump-wird-45-Praesident-der-Vereinigten-Staaten.html)
- 08:45 Uhr SPIEGEL: [Vereinigte Staaten: Donald Trump gewinnt US-Präsidentschaftswahl](http://www.spiegel.de/politik/ausland/donald-trump-gewinnt-die-us-wahl-2016-a-1120397.html)
- 08:45 Uhr ZEIT: [Wahl in den USA - Hillary Clinton verliert US-Wahl](http://www.zeit.de/politik/ausland/2016-11/wahl-usa-hillary-clinton-donald-trump-praesidentschaft-live)

