---
title: Performance-Optimierung von Webfonts
date: 2017-03-15
datelabel: 15. März 2017
language: de
tags: [Webentwicklung]
permalink: performance-optimierung-webfonts
draft: true
description:
---

## braucht man überhaupt Webfonts?

- Screenshot mit/ohne

## woff2 statt woff
- nutze ja derzeit nur die eine. Weil: wie viele Browser unterstützen die? Und: Font ist ein Optisches Schmankerl. Ein Enhancement.

## Subset

- https://transfonter.org/ (oder https://github.com/bramstein/homebrew-webfonttools)
- https://parall.ax/blog/view/3072/tutorial-reducing-the-file-size-of-custom-web-fonts
-


Beispiel:
- 195 KB Montserrat Black in ttf
- Formate mit allen Subsets:
  - eot 220, svg 566, ttf 220, woff 99, woff2 65
- Subset Latin:
  - eot 37, svg 83, ttf 37, woff 21, woff2 16
- Subset Buchstaben ("Do one thing today."):
  -

# FOIT/FOUT

- Cookie-Variante https://www.filamentgroup.com/lab/font-events.html
- Font Loading API (wann kommt die wo?)
- JS Gehampel (http://bdadam.com/blog/better-webfont-loading-with-localstorage-and-woff2.html) für mich keine Option
- Alternativen noch nicht Browsersandard(?): https://www.bramstein.com/writing/web-font-loading-patterns.html#custom-font-display

## optische Angleichung

- letter-spacing, line-height, font-weight, font-variant, font-style
- http://webdesignernotebook.com/css/the-little-known-font-size-adjust-css3-property/

- https://helpx.adobe.com/typekit/using/font-events.html#Stylingfallbackfontsusingfontevents
- http://webfont-test.com/
- Wenn es da kein Tool gibt, mach selber eines (Codepen)


## Laden bei guter Verbindung

- wie gesagt: optisches Schmankerl. Also: Network checken.



## Links


- http://fontfamily.io/Andale_Mono,monospace


## Links

- https://www.zachleat.com/web/comprehensive-webfonts/
