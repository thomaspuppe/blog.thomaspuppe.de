---
title: "Easto: ein kleiner schneller Static-Site Generator"
date: 2019-03-11
datelabel: 11. März 2019
language: de
tags: [Webentwicklung]
permalink: easto-static-site-generator
draft: true
description:
---

Dieses Blog wird über einen [Static-Site Generator]() erzeugt. Zuletzt war die Open Source Software [Acrylamid]() im Einsatz, die leider nicht mehr maintained wird.

Als Acrylamid Probleme hatte und ich

(Rant unterbringen: Was soll eigentlich dieser JAM Scheiß? Ich klebe irgendwelche SAAS oder FAAS zusammen mit fremdem Datenspeicher, Generator-Software und Hosting, um meine 20 HTML Seiten zu hosten -- sind die verrückt geworden? Und alle machen mit!

Der nächste Trend wird garantiert "speed up your JAM Stack with a self-hosted database".)

[Alternative Generatoren]() gibt es wie Sand am Meer. Eigentlich fand ich Gatsby ganz interessant, weil viel Integration in Richtung Contentful, Netlify, Algolia und co. Aber: das benutzt JS/React nicht nur zum Bauen der Seite, sondern müllt das auch alles in das Ergebnis. Und schon habe ich für ein "Hello World" vier JS-Requests mit 250 KB Download.

Ich will nicht den JS-ist-böse Meckerkopf spielen. Und für viele Anwendungen ist es eine gute Idee, einmal das Paket zu laden und dann bei jedem Klick Bytes zu sparen die nicht mehr durch die Leitung müssen. Aber für eine Static Site oder ein Blog mit zwei oder drei Page Views pro Besuch ist das halt keine gute Idee. Und bei Gatsby wird es wohl wieder schwierig, das JS zu rauszufrickeln.

## Easto: ein Static Site Generator im Eigenbau

Langes Meckern, kurzer Sinn: ich hatte mich entschieden, einen eigenen Generator zu schreiben. Den entscheidenden Impuls gab mir [TODO](TODO) bei einem [Static Site Meetup in Berlin](TODO), bei dem er dafür warb, es einmal selbst zu probieren.

Erste Gehversuche hatte ich vor <stroke>Monaten</stroke> Jahren mit Ruby gemacht ([https://github.com/thomaspuppe/easto-ruby](GitHub/thomaspuppe/easto-ruby)). Da ich mich 2018 aber entschieden hatte, mich auf JavaScript zu konzentrieren, startete ich einen zweiten Anlauf.


## Schritt 1: Markdown-Dateien iterieren, transformieren, und speichern

Das Grundprinzip eines Static Site Generators lässt sich in wenigen Zeilen Code umsetzen. Lies Dateien (z.B. Blogposts) aus, mach etwas mit ihnen, und speichere das Ergebnis.

<pre>const fs = require('fs')
fs.readdirSync('content')
  .forEach(sourceFilename => {
    const sourcePath = `content/${sourceFilename}`
    const content = fs.readFileSync(sourcePath, {encoding: 'utf-8'})
    // TODO: Verarbeiten
    const targetFilename = sourceFilename.replace('.md', '.html')
    const targetPath = `output/` + targetFilename
    fs.writeFileSync(targetPath, content)
  })</pre>

In diesem Fall hätten wir alle Dateien aus einem Quellordner ausgelesen, und unter neuem Namen in einen Zielordner gespeichert. Das könnte man auch kopieren, ohne auszulesen, aber wir wollen ja noch etwas damit anfangen:

<pre>const fs = require('fs')
const marked = require('marked')

fs.readdirSync('content')
  .forEach(sourceFilename => {
    const sourcePath = `content/${sourceFilename}`

    const contentMarkdown = fs.readFileSync(sourcePath, {encoding: 'utf-8'})
    const contentHtml = marked(contentMarkdown)

    const targetFilename = sourceFilename.replace('.md', '.html')
    const targetPath = `output/${targetFilename}`

    fs.writeFileSync(targetPath, contentHtml)
  })</pre>

Im Befehl `const contentHtml = marked(contentMarkdown)` steckt die Magie. Texte, die in Markdown verfasst wurden, werden in HTML umgewandelt. Natürlich könnte man auch gleich in HTML schreiben. Oder beides! Mit dem npm Modul marked kann man sowohl schlankes Markdown schreiben, als auch im selben Text HTML verwenden, wenn Markdown nicht mehr ausreicht. Die [Quelldatei dieses Blog-Posts](TODO) veranschaulicht das.

Aber zurück zum Generator. Obiges Textbeispiel als JavaScript-Datei reicht (fast) schon aus, um ein kleines simples Blog zu erzeugen.

<pre>$ node index.js
🚀 Easto: 170.456ms</pre>

Wie in der modernen JavaScript-Welt üblich, muss man vorher noch das "marked" Modul als Dependency mit dem aktuell coolen Paketmanager installieren.

Die Laufzeit des Scripts messe ich übrigens mit

<pre>console.time('🚀 Easto')
...
console.timeEnd('🚀 Easto')
</pre>

am Anfang und Ende des Scripts.


## 2: Templating

Nun ist der Output von Inhalt im HTML Format noch keine anständige Website. Alles um den eigentlichen Inhalt herum (Header, Navigation, Footer) möchte ich ja auch nicht auf jeder einzelnen Seite pflegen. Also: Templating to the rescue!

Aber bevor ich irgendwelche Template-Engines lade, benutze ich simple String-Ersetzung. Das soll ja schließlich ein einfacher Seiten-Editor werden, und kein Dependency-Monster.

Als erstes Template für mein Blog dient eine HTMl-Datei, deren Inhalt nur aus einem Platzhalter besteht.

<pre>&lt;!doctype html&gt;
&lt;html lang="de"&gt;
    &lt;head&gt;
        &lt;meta charset="utf-8"&gt;
        &lt;title&gt;Mein Blog&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        &lt;h1&gt;Willkommen auf Thomas Puppes Blog!&lt;/h1&gt;
        {{ CONTENT }}
    &lt;/body&gt;
&lt;/html&gt;</pre>

In meinem Generator lese ich nun zusätzlich das Template aus (außerhalb der Schleife, denn das bleibt ja gleich) und benutze es zum Zusammenbauen jeder einzelnen Seite.

<pre>// Module laden

const template = fs.readFileSync('template.html', {encoding: 'utf-8'})

fs.readdirSync('content')
  .forEach(sourceFilename => {
    const sourcePath = `content/${sourceFilename}`

    const contentMarkdown = fs.readFileSync(sourcePath, {encoding: 'utf-8'})
    const contentHtml = marked(contentMarkdown)

    let contentPage = template.replace('{{ CONTENT }}', contentHtml)

    const targetFilename = sourceFilename.replace('.md', '.html')
    const targetPath = `output/` + targetFilename

    fs.writeFileSync(targetPath, contentPage)
  })</pre>

Und schon enthalten die generierten Dateien das HTML des Templates und alle Inhalte.

Was sofort auffällt: der `title` ist gar nicht individuell. Den möchte man aber gern setzen. Woraus eine zweite Frage folgt: woher bekomme ich den Titel überhaupt?

## 3: Metadaten (YAML/Frontmatter)

"Frontmatter" ist ein gängiges Format, um in Dateien mit Inhalten außerdem noch Meta-Informationen zu schreiben. (TODO: Frontmatter Quelle verlinken, und das sauber erklären.) Das Format sieht aus wie folgt:

<pre>---
title: Perfekte Link-Unterstreichung
language: de
permalink: link-unterstreichung
---
Hier beginnt der Inhalt. Er ist beliebig lang...</pre>

In einen Block am Anfang der Datei werden die Meta-Informationen geschrieben. Nach einem Trenner (`---`) kommt dann der Inhalt. Weil diese Struktur schön einfach und definiert ist, kommen selbst Computer damit klar &mdash; und deswegen gibt es auch ein npm Modul dafür: [frontmatter](TODO).

Im Detail unterscheiden sich die Module (zum Beispiel brauchen manche den Trenner auch am Anfang der Datei), und es gibt kleine Fallstricke (wenn der Titel einen Doppelpunkt enthält, muss er in Anführungsstriche gesetzt werden, damit klar wird was Struktur und was Inhalt ist). Aber im Grunde parst das Modul die Datei, und gibt die Werte strukturiert zurück.

Ich setze weitere Platzhalter in das Template, und ersetze diese beim Zusammenbauen der HTML-Seiten.

Das Template sieht nun so aus:

<pre>&lt;!doctype html&gt;
&lt;html lang="{{ META_LANGUAGE }}"&gt;
    &lt;head&gt;
        &lt;meta charset="utf-8"&gt;
        &lt;title&gt;{{ META_TITLE }}&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        &lt;h1&gt;{{ META_TITLE }}&lt;/h1&gt;
        {{ CONTENT }}
    &lt;/body&gt;
&lt;/html&gt;</pre>

und im JavaScript füge ich hinter das Transformieren von Markdown in HTML die Schleife zur Ersetzung aller Metadaten ein.

<pre>const content = fs.readFileSync(sourcePath, {encoding: 'utf-8'})

// parse die Datei mit Inhalt und Metadaten
const frontmatter = yaml.loadFront(content)

// der Teil unter dem Trenner steht als "__content" zur Verfügung
let contentHtml = marked(frontmatter.__content)
let contentPage = template.replace('{{ CONTENT }}', contentHtml)

// die Yaml-Teile über dem Trenner sind nun Felder im "frontmatter" Objekt
contentPage = contentPage.replace('{{ META_title }}', frontmatter['title'])
contentPage = contentPage.replace('{{ META_language }}', frontmatter['language'])</pre>

Das yaml-Modul habe ich am Anfang des Scripts via `const yaml = require('yaml-front-matter')` geladen, und vorher mit dem Paketmanager installiert.

Die Werte aus dem Frontmatter kann man natürlich nicht nur für den Inhalt der Seiten benutzen, sondern auch für den Dateinamen.

<pre>const targetFilename = frontmatter['permalink'] + '.html`</pre>

Wenn man die Struktur häufiger erweitert, oder es etwas bequemer haben möchte, kann man natürlich auch über alle Metadaten iterieren und diese im Template generisch ersetzen. Das ist dann schon etwas fortgeschrittener:

<pre>for (var key in contentFrontmatter) {
	const re = new RegExp('{{ META_' + key.toUpperCase() + ' }}', 'g')

	// Frontmatter unterstützt auch Arrays im Format
	// "tags: [Webentwicklung, Magic, Internet]"
	if ( key === 'tags') {
		const tagsString = contentFrontmatter[key].join(', #')
		contentPage = contentPage.replace(re, tagsString)
	} else {
		contentPage = contentPage.replace(re, contentFrontmatter[key])
	}
}</pre>

Bei der Entwicklung von diesen Algorithmen kann man wunderbar in kleinen Schritten vorgehen, weil man binnen Milliskunden das Ergebnis seiner Bemhung im Browser betrachten kann. Hoch lebe die handgestrickte Webentwicklung!

## 4: Inhaltsverzeichnis

Mit dem bisherigen Code wurden also allerlei Inhalts-Seiten oder Blog-Artikel generiert. Eine dieser Seiten könnte die Startseite sein, die man natürlich händisch anlegen und pflegen kann. Ich möchte aber, dass die Startseite meines Blog austomatisch eine Liste aller Blogposts enthält und darauf verlinkt. Auch das habe ich easto beigebracht.

Beim Iterieren über alle Inhalte baue ich nicht nur die jeweilige Seite zusammen, sondern jeweils auch einen Link zur Seite. Und die gesammelten Links werden am Ende als Index-Seite gespeichert.

<pre>
let teaserList = [];

... .forEach(sourceFilename => {
...
	teaserList.push(`<li><a href="${frontmatter['permalink']}">${frontmatter['title']}</a></li>`)
}

const indexTemplate = fs.readFileSync('template_index.html', {encoding: 'utf-8'})

let indexContent = indexTemplate.replace(
  '{{ CONTENT_BODY }}',
  teaserList.join()
)

fs.writeFileSync('output/index.html', indexContent)</pre>

Das lässt sich nun mit der bekannten Technik der Templates erweitern, damit aus der simplen Linkliste schöne Teaser-Blöcke werden.

<pre></pre>

Beim Ansehen der index-Seite fällt auf, dass die Quelldatien in "zufälliger" Reihenfolge von der Platte gelesen werden. Ich löse das, indem ich als Präfix für meine Dateinamen das Datum jedes Blogposts benutze, und zwischen Auslesen und Verarbeiten eine Sortierung setze:

<pre>fs
  .readdirSync('content')
  .sort((a, b) => {
    return b.localeCompare(a)
  })
  .forEach(sourceFilename => { ...</pre>


## 5: Feeds generieren

Wenn ich schon das chronologische Inhaltsverzeichnis erzeuge, kann ich im gleichen Zuge auch RSS-Feeds bauen, die im Grunde nichts anderes sind. Auch dafür gibt es ein Node-Package ("feed"), mit dem dies recht einfach gelingt.

<pre>
	// Vorbereitung: Metadaten zum Feed

	const Feedbuilder = require('feed')
	feed_config = {
		"title": "Blog von Thomas Puppe, Web Developer.",
		"description": "This is my personal feed!"
	}
	let feed = new Feedbuilder.Feed(feed_config)

	// ... in der Schleife der Blogposts: "Teaser" sammeln

	const feedItem = {
		title: contentFrontmatter['title'],
		description: contentFrontmatter['description'],
		date: contentFrontmatter['date'],
		link: `https://blog.thomaspuppe.de/${targetFilename}`
	}
	feed.addItem(feedItem)

	// ... nach der Schleife: Speichern der Feeds in den Output-Ordner

	fs.mkdirSync(`output/feed`)
	fs.writeFileSync(`output/feed/rss`, feed.rss2())
	fs.writeFileSync(`output/feed/atom`, feed.atom1())
	fs.writeFileSync(`output/feed/json`, feed.json1())
</pre>

Die Domain des Blogs möchte man eher in einer Konfiguration haben als im Quellcode, aber das Beispiel zeigt, worauf ich hinaus will: mit wenigen Zeilen Code lassen sich Feeds in den gängigen Formaten RSS, Atom und JSON bauen.

Eine XML Sitemap _sollte_ ähnlich einfach sein, das habe ich aber noch nicht umgesetzt.


## 6: Statische Dateien kopieren

Zuletzt noch alles was den geschriebenen Inhalt anreichert: Assets (CSS, JS), Bilder und andere statische Dateien kopiere ich einfach aus einer Quelle in das Output-Verzeichis.

<pre>const ncp = require('ncp').ncp
ncp('static', 'output', err => {
  if (err) return console.error(err)
})
</pre>


## Deployment

Am Ende habe icheinen Output-Ordner, der alle Inhalte als HTML-Dateien enthält, und außerdem ein Inhaltsverzeichnis, Feeds, mein CSS, und Bilder.

Das lässt sich am einfachsten per `scp` auf meinen Server kopieren. Optionen wären auch auch FTP, Github Pages, Netlify, whatever. Das ist einer der Vorteile statischer Websites :-)


## Struktur und Übersicht

Okay, das war ein langer Blogpost. Rekapitulieren wir das Ganze:

* Mit rund 100 Zeilen JavaScript-Code (und 5 Modulen als direkte Dependency) lässt sich ein Static-Site Generatorprogrammieren, der aus markdown-Dateien ein Blog rendert.
* Dieses Blog besteht aus Artikeln, einer Homapeg mit einer Liste aller Artikel, und aus Feeds in den Formaten RSS, Atom und JSON.
* Zwei HTML-Template-Dateien dienen als Rahmen für die Artikel und als Teaser-Ansicht auf der Homepage. Man braucht man keine Template-Engine, sondern Suchen-und-Ersetzen genügt.

Die Markdown-Dateien bestehen aus zwei Teilen

* Metadaten wie Titel, Permalink, Sprache, Beschreibung oder Datum. Diese werden im Frontmatter-Format hinterlegt, und können unter ihrem Namen in den Templates genutzt werden.
* Inhalte, die in Markdown geschrieben werden, aber man kann auch HTMl-Code verwenden, oder beides vermischen.

Der Algorithmus besteht aus drei Teilen

1. Einsammeln von Templates, Konfiguration und Inhalten
2. Iterieren über die Inhalte. Dabei werden Artikel gerendert und gespeichert. Teaser und Feed-Items werden zusammengetragen.
3. Abspeichern der Homepage und Feeds, Kopieren von statischen Dateien (Bilder und Assets).


## Fazit und Ausblick

Mit diesem Setup lassen sich Blogs in weniger als einer Sekunde generieren. Außerdem finde ich als Programmierer so ein Projekt sehr schön, weil ich mir neue Features direkt nach Bedarf selbt hinzufügen kann, und keinen Code habe den ich nicht benötige.

Die nächsten Featues werden sein

* Code-Highlighting in Artikeln (wovon genau _dieser_ Artikel hier profitieren wird)
* "Komponenten als Inhaltstyp". Soll heißen: im Inhalt schreibe ich so etwas wie `!tweet {id: 1234, author: 'thomaspuppe', content: 'hello Twitter'}`, und ein Template rendert schönes HTML daraus.
* Keyword/Tag-Seiten: alle Artikel zu einem Tag unter einer URL `/thema/webentwicklung` oder `/language/en` versammeln
* Paginierung der Übersichtsseiten

... und die Abstrahierung von easto in ein Modul, das auch andere einfach benutzen können. Die Software ist Open Source und schon jetzt recht gut per Konfiguration steuerbar, aber bevor sie jeder benutzen _kann_, muss noch ein wenig Aufräumarbeit und Dokumentation geschehen.

Ich freue mich über Feedback, am besten via Twitter an [@thomaspuppe](https://twitter.com/thomaspuppe) oder [E-Mail](https:/www.thomaspuppe.de).

<!--
TODO
- ist frontmatter das offizielle Format? Oder ist das Yaml, und Frontmatter ist nur der Name des Node-Moduls?
-->
