---
title: Eine Single-Page-App minimieren mit Gulp
date: 2015-01-23
tags: [Webentwicklung]
permalink: single-page-apps-monimieren-mit-gulp
draft: false
---

Unter meetingtimer.biz habe ich eine kleine Web-App. CSS und JavaScript sind so gering, dass ich keine seperaten Requests starten möchte. Gleichzeitig sollen Less und JSLint genutzt werden. Ein wunderbares Einsatzgebiet für Gulp!

##Das Projekt

Unter der Domain <a href="http://meetingtimer.biz">meetingtimer.biz</a> betreibe ich eine kleine Website. Ein Nachmittagsprojekt, das während eines Meetings anhand der Teilnehmerzahl die Kosten des Meetings hochzählt und anzeigt.

Die Seite ist einfach und benötigt nur wenig JavaScript und CSS. Dem Performance-Junkie in mir hat es gestört, dass für 2,8 KB CSS (nicht minimiert und unkomprimiert) extra ein Request gestartet werden muss. Weil ich außerdem mit Gulp experimentieren wollte, nahm ich diese Seite zum Anlass.

##Herausforderungen

1. Möglichst wenige Requests im Live-betrieb ... es wäre schade, für 6 kB JavaScript und 3 kB CSS zwei Roundtrips zu starten.
2. Beim Programmieren möchte ich dennoch nicht alles in einer großen HTML Datei horten.

##Lösung mittels Gulp

Grundlage bei der Arbeit mit CSS und JS sind natürlich die klassischen Werkzeuge wie less, minify-css, slint, uglify und concat. Die sind in jedem Gulp-Tutorial enthalten und sollen hier nicht behandelt werden. Spannend für meine Zwecke sind zwei weitere Tasks: 

<pre>var replace = require('gulp-replace-task'),
    cleanhtml = require('gulp-cleanhtml');</pre>

Deren Benutzung ist simpel und komfortabel: Im HTML setzt man Platzhalter: 

<pre>...
&lt;style type="text/css"&gt;@@cssStyles&lt;/style&gt;
...&lt;/head&gt;
&lt;body&gt;...
&lt;script type="text/javascript">@@jsScript&lt;/script&gt;
&lt;/body&gt;</pre>

Und lässt diese im Gulp Task durch den Inhalt der Dateien ersetzen:

<pre>gulp.task('replace', function () {
    return gulp.src('./index.html')
        .pipe(replace({
            patterns: [
                {
                    match: 'cssStyles',
                    replacement: fs.readFileSync('./web/assets/css/style.css', 'utf8')
                },
                {
                    match: 'jsScript',
                    replacement: fs.readFileSync('./web/assets/js/all.min.js', 'utf8')
                },
                {
                    match: 'timestamp',
                    replacement: currentDatetime
                }
            ]
        }))
        .pipe(cleanhtml())
        .pipe(gulp.dest('./web'));
});</pre>

Ich habe auch mit "gulp-inline-source" experimentiert, aber der hat den JavaScript Code zerstört. Replace macht dasselbe und kann außerdem banutzt werden um andere Platzhalter zu erstezen - z.B. den aktuellen Timestamp, eine Release-Nummer, Dateigrößen, Subtemplates, MD5-Hashes von Downloads oder was auch immer.

Die Datei aus "src" wird gelesen und die Vorkommen des Suchpatterns ersetzt. Danach entfernt "cleanhtml" alle Whitespaces und "dest" schreibt die Datei in ihren Zielordner (das VErzeichnis was dann deployed wird). So einfach geht es.

Das Ergebnis ist eine 4,4 kB große HTML Datei (die damit einen Bruchteil des 27,7 kB großen Touch Icons hat). Zu sehen unter <a href="http://meetingtimer.biz">meetingtimer.biz</a>. Die Quellen, .gulpfile und das Ergebnis sind bei GitHub zu finden: <a href="https://github.com/thomaspuppe/meetingtimer.biz">https://github.com/thomaspuppe/meetingtimer.biz</a>

##Potential

- Gulp entschlanken. Die Concat Funktionen werden für jeweils eine Datei jar gar nicht gebraucht.
- Innerhalb des JS Codes könnten nicht-native Bezeichner noch automatisch gegen kürzere ersetzt werden.
- Ebenso könnte man CSS Klassennamen zusammenkürzen.
- Unnötiges CSS rauswerfen. Selektoren präzisieren. Zugegeben, da war ich schlampig.
- Erlaubt iOS, Touch Icons inline als Base 64 codiert abzulegen? Oder Inline als SVG?

Das kommt später. Das wäre auch ein guter Anreiz, die Minimierung auszureizen. Wieso sollte ein simpler Timer KB groß sein, wenn man <a href="http://js1k.com/2014-dragons/demo/1854">Minecraft in 1024 bytes</a> oder <a href="http://js1k.com/2014-dragons/demo/1934">Wolfenstein 2D in 2K</a> programmieren kann?