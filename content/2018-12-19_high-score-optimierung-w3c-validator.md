---
title: High Score – Mikrooptimierung mit ... W3C-Validator
date: 2018-12-19
datelabel: 19. Dezember 2018
language: de
tags: [Webentwicklung, "High Score"]
permalink: high-score-optimierung-w3c-validator
draft: false
description: In dieser neuen Serie versuche ich, mit meinem Blog verschiedene Website-Testing-Tools zufriedenzustellen. Den Anfang macht der W3C-Validator.
---

Valides HTML – eigentlich selbstverständlich für jeden seriösen Web-Entwickler, aber dennoch habe ich bisher kaum eine Seite gesehen die fehlerfrei validiert wird. Manchmal geht einem einfach etwas durch die Lappen. Manchmal gibt es Bedingungen die man nicht erfüllen will: `target="_blank"`, anyone?

Den Auftakt meiner Blogserie "High Score" bildet also der HTML Validator vom W3C. Ist mein eigenes Blog in validem HTML geschrieben? Wie viele Fehler gibt es in meinen simplen Templates? Und wie gut kann ich die Anforderungen des Validators erfüllen?


## Der Test

Der Validator des W3C ist online verfügbar unter [validator.w3.org](https://validator.w3.org/). Er prüft das Markup einer Website auf Validität. Es gibt vom W3C auch weitere Tools, um CSS zu validieren oder defekte Links zu finden. Ich schaue mir zunächst nur das HTML der Startseite an.

Das [Ergebnis](https://validator.w3.org/nu/?doc=https%3A%2F%2Fblog.thomaspuppe.de%2F&showsource=yes&showoutline=yes) erschrickt mich zunächst: 32 Fehler! Allerdings ist das 32 mal derselbe Fehler.

### 1) fehlerhaftes Datumsformat

In jedem Blogpost-Teaser auf der Indexseite ist das Datum in einem ungültigen Format angegeben. Neben dem lesbaren Datum für Menschen wollte ich es auch maschinenlesbar machen...

<pre>&lt;time datetime="Fri Jul 31 2018 02:00:00 GMT+0200 (CEST)"&gt;01. Juli 2018 – 31. Juli 2018&lt;/time&gt;</pre>

... und eben jenes `Fri Jul 20 2018 02:00:00 GMT+0200 (CEST)` ist nicht valide. Der W3C-Validator verlinkt auch gleich auf die [Spec des time-Elements](https://html.spec.whatwg.org/multipage/text-level-semantics.html#the-time-element), die verletzt wird. Dort sind viele Beispiele gültiger Datumsformate aufgelistet.

Ich [ändere also das Datumsformat](https://github.com/thomaspuppe/easto/commit/392dee5b7fb71b562085f7261e8cd8a79ca1a12c) und kürze gleich noch die unnütze Uhrzeit raus.

<pre>&lt;time datetime="2018-07-31"&gt;01. Juli 2018 – 31. Juli 2018&lt;/time&gt;</pre>

Und schwupps: **No errors or warnings to show**!

Das war zu einfach. Deshalb schaue ich mir noch die einzelnen Blogposts an.

## rekursives Testen aller Artikel

Das habe ich mir einfacher vorgestellt. Leider hat der Validator keine Funktion für rekursives Testen (oder eine Liste von Links), und ein entsprechendes einfaches Tool habe ich auf die Schnelle auch nicht gefunden. Also prüfe ich einige Artikel von Hand.

### strike-Tag

Im Artikel [Mein Smarterphone](https://blog.thomaspuppe.de/mein-smarterphone) benutze ich das `<strike>` Tag, um ein paar Worte durchzustreichen. Der Validator moniert, das sei obsolet und man solle lieber CSS benutzen. Die Erklärung ist erst einmal nicht zufriedenstellend, weil das eben _kein_ optischer Effekt ist, sondern ich tatsächlich eine inhaltliche Aussage treffe: dieser Text wurde durchgestrichen.

Wieder verlinkt der Validator die Specs, diesmal auf [Whatwg zum Thema "Presentational Links and Attributes"](https://wiki.whatwg.org/wiki/Presentational_elements_and_attributes). Hier wird genauer erklärt: `s` und `strike` sind zu ersetzen durch `del`. Das korrigiert den Fehler.

Durch die Erklärung, ich wolle ja mit der Durchstreichung etwas ausdrücken, ist mir eines aufgefallen: wenn man den _entfernten_ Text semantisch kennzeichnet, was ist dann mit dem _hinzugefügten_ Text? Der besagte Artikel zu Präsentationselementen hat die Antwort: das `ins` Tag!

Der default-Stil des `ins` Tags ist übrigens eine einfache Unterstreichung &mdash; genau wie es auch Links in meinem Blog sind. Da ich meine Links nicht einfärbe und in der Textfarbe unterstreiche, sehen nun die eingefügten Texte aus wie Links. (Nebenbei: das wäre schon ein Grund, nicht an Link-Stilen herumzufummeln: weil man dann genau solche Probleme erzeugt.) Da ich meine Link-Stile aber nicht ändern möchte, style ich also die `ins` Tags um. Der erste Ansatz war, `text-decoration: none` zu setzen und dann mit einem `border-bottom` in der `currentColor` zu arbeiten. Was aber viel besser ist: es gibt das CSS-Property `text-decoration-style`, mit dem man eben diese Unterstreichung ändern kann, zum Beispiel auf `dotted`, `dashed` oder `wavy`.

Bonuswissen: man kann ebenso die `text-decoration-color` und die `text-decoration-line` ändern. Damit kann man einen Text z.B. wellig rot über- unter- und durchstreichen &mdash; sogar gleichzeitig.

<pre>text-decoration-style: wavy;
text-decoration-line: overline underline line-through;
text-decoration-color: red;</pre>

Das aber nur am Rande. Im Blog-CSS habe ich mich für eine wellige Unterstreichung in etwas hellerem Ton entschieden:

Hier die Demo mit <del>Text im del-Tag</del> und <ins>Text im ins-Tag</ins>.

### spitze Klammern in pre

Innerhalb von `pre` Tags, die ich für Code-Beispiele im Blog benutze, sind keine spitzen Klammern erlaubt. Sie werden nämlich interpretiert, was mir an manchen Stellen im Browser nicht auffiel (das "Element" wurde versteckt, und der Teil des Codes nicht gezeigt). Dem Validator fiel es auf.

Ob es besser wäre, anstelle von `pre` lieber `code` zu benutzen, prüfe ich ein andermal.

## Ergebnis der Tests mit dem W3C-validator

Ich sage mal: fehlerfrei. Ich habe jetzt nicht jeden einzelnen Artikel getestet, aber auf den getesteten Seiten konnte ich alle Fehler korrigieren. Erwartet hatte ich eigentlich, dass ich mich über manche "zu strenge" Hinweise hinwegsetzen werde.

## Fazit zum W3C-Validator

**pro**:

- sehr gute Aufbereitung: Fehler werden im Quellcode markiert
- Fehler werden zu Specs und Erklärungen verlinkt, zum Teil gibt schon der Validator Lösungsvorschläge

**contra**:

- keine rekursive Validierung (der [W3C-Linkchecker](https://validator.w3.org/checklink) kann rekursiv arbeiten)
- wiederholte Fehler auf einer Seite werden nicht zusammengefasst als _ein_ Problem

## Meta-Fazit

Der Auftakt hat mir gut gefallen. Ich habe zwar keine groben Schnitzer gefunden, die man unbedingt korrigieren müsste. Aber die Blog-Serie heißt ja auch "Mikrooptimierung", und ich möchte jeden kleinen Scheiß fixen.

Das Schöne: man lernt viele Details hinzu. Wann im Arbeitsalltag stolpert man schon über das `<ins>` Tag, und wie man die `text-decoration-line` stylen kann?

Ich bin heiß auf den nächsten Check!
