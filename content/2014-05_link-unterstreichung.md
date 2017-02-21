---
title: Perfekte Link-Unterstreichung
date: 2014-05-06
datelabel: 06. Mai 2014
tags: [Webentwicklung]
permalink: link-unterstreichung
draft: false
description: Link-Unterstreichung bei großen Schriftarten wirkt schnell klobig. Mit ein paar Zeilen CSS lässt sich die Seite optisch aufwerten und die Lesbarkeit erhöhen.
---

Link-Unterstreichung bei großen Schriftarten wirkt schnell klobig. Mit ein paar Zeilen CSS lässt sich die Seite optisch aufwerten und die Lesbarkeit erhöhen.

Als Freund <a href="http://ia.net/blog/100e2r">&ldquo;großer&rdquo; Schrift</a> auf Websites stelle ich fest, dass die Unterstreichung von Links ab 20 Pixeln Schriftgröße (bei meinem Setup von font-family: Georgia, "Times New Roman", Times, serif;) recht breit ist. Das stört auch die Lesbarkeit des Textes &mdash; zumindest im Vergleich zu einer Variante mit schmalerer Unterstreichung. Hier im Blog kommt das nicht zum Tragen. Groß sind nur die Überschriften, die eine dicke Unterstreichung vertragen. Der Fließtext ist kleiner als 20px und hat daher moderate Unterstreichung. Auf meiner Website mit vielen Links störte die Unterstreichung schon mehr (siehe Screenshot):

<figure>
    <img src="/images/2014/05/link-underline.png" alt="Abb. 1: Link-Unterstreichung nativ und trickreich">
    <figcaption>Abb. 1: Link-Unterstreichung nativ und trickreich</figcaption>
</figure>

Kürzlich bin ich auf einen Artikel von <a href="https://medium.com/@mwichary">Marcin Wichary</a> gestoßen, der dieses Problem löst: <a href="https://medium.com/p/7c03a9274f9">&ldquo;Crafting link underlines on Medium&rdquo;</a>. In dem sehr lesenswerten Artikel wird auf pro und contra von Link-Unterstreichung im Allgemeinen und verschiedenen Techniken im Speziellen eingegangen. Am Ende schaut die Lösung so aus:

<pre>a, a:link, a:visited {
    color: #333;
    text-decoration: none;
    position: relative;
    text-shadow: -1px -1px 0 white, 1px -1px 0 white, -1px 1px 0 white, 1px 1px 0 white;
    background-image: linear-gradient(to top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0) 2px, #333333 2px, #333333 3px, rgba(0, 0, 0, 0) 3px);
}

@media (-webkit-min-device-pixel-ratio: 1.5), (min-resolution: 144dpi) {
    a {
        background-image: linear-gradient(to top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0) 2px, #333333 2px, #333333 2.5px, rgba(0, 0, 0, 0) 2.5px);
    }
}

a:hover, a:focus {
    background-image: linear-gradient(to top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0) 2px, #666 2px, #666 3px, rgba(0, 0, 0, 0) 3px);
}

@media (-webkit-min-device-pixel-ratio: 1.5), (min-resolution: 144dpi) {
    a:hover, a:focus {
        background-image: linear-gradient(to top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0) 2px, #666 2px, #666 2.5px, rgba(0, 0, 0, 0) 2.5px);
    }
}</pre>

**Trick 1:** Links bekommen ein Hintergrundbild, das keine Datei oder DataURI nutzt, sondern Gradients.

**Trick 2:** Ein Text-Shadow, unterbricht die Linie bei Buchstaben mit Unterlänge.

Achtgeben muss man auf Links, die nicht nur Text enthalten. Wird z.B. ein Bild verlinkt, erhält dieses auch eine solche Unterstreichung. Das muss dann mittels &ldquo;background-image:none;&rdquo; unterbunden werden &mdash; und zwar am Link statt am Bild. Bei großen Seiten kann es hier haarig werden und der Nutzen rechtfertigt den Aufwand vielleicht nicht mehr. Dasselbe gilt für Links im Button-Stil usw.
