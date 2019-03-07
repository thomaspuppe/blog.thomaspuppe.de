---
title: "Easto: ein kleiner schneller Static-Site Generator"
date: 2019-03-11
datelabel: 11. März 2019
language: de
tags: [Webentwicklung]
permalink: easto-static-site-generator
draft: false
description: Um mein kleines Blog zu betreiben, brauche ich keine fremde Software. Einfache Prinzipien und ein paar Node-Module genügen, um mir selbst einen Static-Site Generator zu schreiben. Eine Schritt-für-Schritt Anleitung.
---

Dieses Blog wird über einen [Static-Site Generator]() erzeugt. Zuletzt hatte ich die Open Source Software [Acrylamid]() im Einsatz, die leider nicht mehr maintained wird.

Als Acrylamid Probleme hatte, und ich mich nach Alternativen umsah, begann der Aufstieg des JAM-Stacks in Meetups und Blogposts. Der Ansatz wird oft als schlank und schnell beschrieben, aber das sehe ich anders. Der JAM-Stack ist ein Zusammenkleben mehrerer SAAS oder FAAS aus der Cloud. Inhalte werden auf fremdem Speicher abgelegt, eine _Serverless_ Generator-Software wird pro Sekunde fürs Rendern bezahlt, und ein weiterer Service übernimmt das Hosting. Und das alles nur um meine 20 HTML Seiten abzulegen -- sind die verrückt geworden? Und alle machen mit! Der nächste Trend wird garantiert "speed up your JAM Stack with a self-hosted hard disk".

Rant 1 Ende.

Ich möchte mein Blog also lokal auf meinem Rechner schreiben und erzeugen. [Static-Site Generatoren]() gibt es wie Sand am Meer. Eigentlich fand ich Gatsby ganz interessant, weil (optional!) Möglichkeiten zur Integration in Richtung Contentful, Netlify, Algolia und co. Aber: das benutzt JS/React nicht nur zum Bauen der Seite, sondern müllt das auch alles in das Ergebnis. Und schon habe ich für ein "Hello World" vier JS-Requests mit 250 KB Download.

Ich will nicht den JS-ist-böse Meckerkopf spielen. Und für viele Anwendungen ist es eine gute Idee, einmal das Paket zu laden und dann bei jedem Klick Bytes zu sparen die nicht mehr durch die Leitung müssen. Aber für eine statische Seite oder ein Blog mit zwei oder drei Page Views pro Besuch ist das halt keine gute Idee. Und bei Gatsby wird es wohl wieder schwierig, das JS zu rauszufrickeln.

Rant 2 Ende.


## Easto: ein Static-Site Generator im Eigenbau

Langes Meckern, kurzer Sinn: ich hatte mich entschieden, einen eigenen Generator zu schreiben. Den entscheidenden Impuls gab mir [TODO](TODO) bei einem [Static-Site Meetup in Berlin](TODO), bei dem er dafür warb, es einmal selbst zu probieren.

Erste Gehversuche hatte ich vor <stroke>Monaten</stroke> Jahren mit Ruby gemacht ([https://github.com/thomaspuppe/easto-ruby](GitHub/thomaspuppe/easto-ruby)). Da ich mich 2018 aber entschieden hatte, mich auf JavaScript zu konzentrieren, startete ich einen zweiten Anlauf.

Diesen möchte ich nun beschreiben, und damit einen Fahrplan liefern, wie jeder mit 100 Zeilen Code seinen eigenen Static-Site Generator bauen kann.


## Schritt 1: Markdown-Dateien iterieren, transformieren, und speichern

Das Grundprinzip eines Static-Site Generators lässt sich in wenigen Zeilen Code umsetzen. Lies Dateien (z.B. Blogposts) von der Festplatte aus, mach etwas mit ihnen, und speichere das Ergebnis wieder auf die Festplatte.

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

Nun habe alle Dateien aus einem Quellordner ausgelesen, und unter neuem Namen in einen Zielordner gespeichert. Das könnte ich auch kopieren, ohne auszulesen, aber ich möchte ja noch etwas damit anfangen:

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

Im Befehl `const contentHtml = marked(contentMarkdown)` steckt die Magie. Texte, die in Markdown verfasst wurden, werden in HTML umgewandelt. Natürlich könnte ich auch gleich in HTML schreiben. Schöner ist aber beides! Mit dem npm Modul marked kann ich sowohl schlankes Markdown schreiben (für Blogposts aus Überschriften, Texten, und Links), als auch im selben Text HTML verwenden, wenn Markdown nicht mehr ausreicht (für Figures, Tabellen, JS und CSS). Die [Quelldatei dieses Blog-Posts](https://github.com/thomaspuppe/blog.thomaspuppe.de/blob/master/content/2019-03-11_easto-static-site-generator.md) veranschaulicht die Mischung. Ein Artikel über [moderne Browser-APIs](https://raw.githubusercontent.com/thomaspuppe/blog.thomaspuppe.de/master/content/2017-04-06_browser-api-css-mediaqueries.md) enthält ausführbare Code-Beispiele aus CSS und JavaScript.

Aber zurück zum Generator. Obiges Textbeispiel als JavaScript-Datei reicht schon aus, um ein kleines simples Blog zu erzeugen. Der Aufruf der JavaScript-Datei wird alle Markdown-Dateien im Content-Ordner als HTML im Output-Ordner ablegen.

<pre>$ node index.js
🚀 Easto: 170.456ms</pre>

Wie in der modernen JavaScript-Welt üblich, musste ich vorher noch das "marked" Modul als Dependency mit dem aktuell coolen Paketmanager installieren.

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

Was sofort auffällt: der `title` ist gar nicht individuell. Den möchte ich aber gern setzen. Woraus eine zweite Frage folgt: woher bekomme ich den Titel, oder andere Metadaten?


## 3: Metadaten (YAML/Frontmatter)

"Frontmatter" ist ein gängiges Format oder Prinzip, um in Dateien mit Inhalten außerdem noch Meta-Informationen zu schreiben.

<pre>---
title: Perfekte Link-Unterstreichung
language: de
permalink: link-unterstreichung
---
Hier beginnt der Inhalt. Er ist beliebig lang...</pre>

In einen Block am Anfang der Datei werden die Meta-Informationen geschrieben. Nach einem Trenner (`---`) kommt dann der Inhalt. Weil diese Struktur schön einfach und definiert ist, kommen selbst Computer damit klar &mdash; und deswegen gibt es auch ein npm Modul dafür: [yaml-front-matter](https://www.npmjs.com/package/yaml-front-matter).

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

Im JavaScript füge ich hinter das Transformieren von Markdown in HTML die Schleife zur Ersetzung aller Metadaten ein.

<pre>const content = fs.readFileSync(sourcePath, {encoding: 'utf-8'})

// parse die Datei mit Inhalt und Metadaten
const frontmatter = yaml.loadFront(content)

// der Teil unter dem Trenner steht als "__content" zur Verfügung
let contentHtml = marked(frontmatter.__content)
let contentPage = template.replace('{{ CONTENT }}', contentHtml)

// die Yaml-Teile über dem Trenner sind nun Felder im "frontmatter" Objekt
contentPage = contentPage.replace('{{ META_TITLE }}', frontmatter['title'])
contentPage = contentPage.replace('{{ META_LANGUAGE }}', frontmatter['language'])</pre>

Das yaml-Modul habe ich am Anfang des Scripts via `const yaml = require('yaml-front-matter')` geladen, und vorher mit dem Paketmanager installiert.

Die Werte aus dem Frontmatter kann ich natürlich nicht nur für den Inhalt der Seiten benutzen, sondern auch für den Dateinamen.

<pre>const targetFilename = frontmatter['permalink'] + '.html`</pre>

Wenn ich die Struktur häufiger erweitere, oder es etwas bequemer haben möchte, kann ich natürlich auch über alle Metadaten iterieren und diese im Template generisch ersetzen. Das ist dann schon etwas fortgeschrittener:

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

Bei der Entwicklung von diesen Algorithmus konnte ich wunderbar in kleinen Schritten vorgehen, weil ich binnen Milliskunden das Ergebnis meiner Bemühung im Browser betrachten konnte. Hoch lebe die handgestrickte Webentwicklung!

## 4: Inhaltsverzeichnis

Mit dem bisherigen Code wurden also allerlei Seiten oder Blog-Artikel generiert. Eine dieser Seiten war die Startseite, die ich anfangs händisch angelegt und die Links zu allen Artkeln eingepflegt habe. Ich möchte aber, dass die Startseite meines Blog austomatisch eine Liste aller Blogposts enthält und darauf verlinkt. Auch das habe ich easto beigebracht.

Beim Iterieren über alle Inhalte baue ich nicht nur die aktuelle Seite zusammen, sondern jeweils auch einen Link zur Seite. Und die gesammelten Links werden am Ende als Index-Seite gespeichert.

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

<pre>
let teaserList = [];
const teaserTemplate = fs.readFileSync(`templates/teaser.html`, {encoding: 'utf-8'})

... .forEach(sourceFilename => {
...
	// in der Schleife, wo auch Artikel-Metadaten ersetzt werden:
	teaserContent = teaserTemplate.replace(re, fileContentFrontmatter[key])
	teaserList.push(teaserContent)
}</pre>

Beim Ansehen der index-Seite fällt auf, dass die Quelldatien in "zufälliger" Reihenfolge von der Platte gelesen werden. Ich löse das, indem ich als Präfix für meine Dateinamen das Datum jedes Blogposts benutze (`/content/2019-03-11_easto-static-site-generator.md`), und zwischen Auslesen und Verarbeiten eine Sortierung setze:

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

Die Domain des Blogs möchte ich am Ende lieber in einer Konfigurationsdatei haben als im Quellcode, aber das Beispiel zeigt, worauf ich hinaus will: mit wenigen Zeilen Code lassen sich Feeds in den gängigen Formaten RSS, Atom und JSON bauen.

Eine XML Sitemap _sollte_ ähnlich funktionieren sein, das habe ich aber noch nicht umgesetzt.


## 6: Statische Dateien kopieren

Zuletzt noch alles was den geschriebenen Inhalt anreichert: Assets (CSS, JS), Bilder und andere statische Dateien kopiere ich direkt aus einer Quelle in das Output-Verzeichis. Das Node-Modul `ncp`ermöglicht das rekursiv.

<pre>const ncp = require('ncp').ncp
ncp('static', 'output', err => {
  if (err) return console.error(err)
})
</pre>


## Deployment

Am Ende habe ich einen Output-Ordner, der alle Inhalte als HTML-Dateien enthält, und außerdem ein Inhaltsverzeichnis, Feeds, mein CSS, und Bilder.

Das lässt sich am einfachsten per `scp` auf meinen Server kopieren. Optionen wären auch auch FTP, Github Pages, Netlify, whatever. Das ist einer der Vorteile statischer Websites :-)


## Struktur und Übersicht

Okay, das war ein langer Blogpost. Rekapitulieren wir das Ganze:

* Mit rund 100 Zeilen JavaScript-Code (und 5 Modulen als direkte Dependency) lässt sich ein Static-Site Generatorprogrammieren, der aus markdown-Dateien ein Blog rendert.
* Dieses Blog besteht aus Artikeln, einer Homapeg mit einer Liste aller Artikel, und aus Feeds in den Formaten RSS, Atom und JSON.
* Zwei HTML-Template-Dateien dienen als Rahmen für die Artikel und als Teaser-Ansicht auf der Homepage. Ich brauche dazu keine Template-Engine, sondern Suchen-und-Ersetzen genügt.

Die Markdown-Dateien bestehen aus zwei Teilen

1. Metadaten wie Titel, Permalink, Sprache, Beschreibung oder Datum. Diese werden im Frontmatter-Format hinterlegt, und können unter ihrem Namen in den Templates genutzt werden.
2. Inhalte, die in Markdown geschrieben werden. Ich kann auch HTMl-Code verwenden, oder beides vermischen.

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

... und die Abstrahierung von easto in ein Modul, das auch andere benutzen können. [Easto ist Open Source](https://github.com/thomaspuppe/easto) und schon jetzt recht gut per Konfiguration steuerbar, aber bevor sie jeder benutzen _kann_ und _möchte_, muss noch ein wenig Aufräumarbeit und Dokumentation geschehen.

Ich freue mich über Feedback, am besten via Twitter an [@thomaspuppe](https://twitter.com/thomaspuppe) oder [E-Mail](https:/www.thomaspuppe.de).
