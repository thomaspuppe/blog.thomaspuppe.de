---
title: "Easto: a static-site generator"
date: 2018-03-06
datelabel: 06. March 2018
language: en
tags: [Webentwicklung]
permalink: easto-static-site-generator
draft: true
description:
---

Dieses Blog wird über einen [Static Site Generator]() erzeugt. Konkret ist die Open Source Software [Acrylamid]() im EInsatz, die leider nicht mehr maintained wird.

[Alternative Generatoren]() gibt es wie Sand am Meer. Eigentlich fand ich Gatsby ganz interessant, weil viel Integration in Richtung Contentful, Netlify, Algolia und co. Aber: das benutzt JS/React nicht nur zum Bauen der Seite, sondern müllt das auch alles in das Ergebnis. Und schon habe ich für ein "Hello World" vier JS-Requests mit 250 KB Download.

Ich will nicht den JS-ist-böse Meckerkopf spielen. Und für viele Anwendungen ist es eine gute Idee, einmal das Paket zu laden und dann bei jedem Klick Bytes zu sparen die nicht ehr durch die Leitung müssen. Aber für eine Static Site oder ein Blog mit zwei oder drei Page Views pro Besuch ist das halt keine gute Idee. Und bei Gatsby wird es wohl wieder schwierig, das JS zu rauszufrickeln.

Langes Meckern, kurzer Sinn: ich habe mich entschieden, einen eigenen Generator zu schreiben. Erste Gehversuche hatte ich vor Monaten mit Ruby gemacht ([https://github.com/thomaspuppe/easto-ruby](https://github.com/thomaspuppe/easto-ruby)). Da ich mich aber entschieden habe, mich 2018 auf JavaScript zu konzentrieren, mache ich einen zweiten Anlauf.

## Easto: ein S


puppe:~/code/private/easto (master) $ yarn start
yarn run v1.5.1
$ node index.js
Hello World
✨  Done in 0.19s.
