---
title: Small improvements for a simple blog
date: 2018-04-10
datelabel: 10. Juli 2018
language: en
tags: [webdevelopment]
permalink: small-improvements-blog
draft: true
description: todo
---


## Checks

[ ] https://tenon.io/
[ ] https://developers.google.com/speed/pagespeed/insights/
[x] https://validator.w3.org/
[ ] W3C Link-Checker https://validator.w3.org/checklink?uri=https%3A%2F%2Fblog.thomaspuppe.de&summary=on&hide_type=all&recursive=on&depth=1&check=Check
[ ] Mach Metrics

## Syntax check



## content-type

`"text/html; charset=utf-8"` for html in `/etc/nginx/mime.types`


## Security

Not a real issue, but you can hide your webserver version from the HTTP headers by entering (or uncommenting) `server_tokens off;` in the http section of your nginx config (`/etc/nginx/nginx.conf`).


`add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;` in site config. (In each and every section where headers are set.)


## Tools

### Dareboost

https://www.dareboost.com/en/report/d_5c157f90e96790544a1b4003

85% (4 Issues, 6 Improvements, 61 Successes)

(1) Schriften mit falschem Content-Type HTTP Header überliefert

Meine Schriften im woff 2 Format (https://blog.thomaspuppe.de/assets/webfonts/leaguespartan/leaguespartan-bold.woff2) haben den HTTP-Header `Content-Type: ext/html`. Lösung: `font/woff2   woff2;` in `/etc/nginx/mime.types` eintragen.


(2) XSS und CSP

Dareboost moniert,dass ich keine CSP und XSS protection header aktiviert habe. Da das Blog reinstatisch ist, sollte das _eigentlich_(TM) nicht nötig sein. Aber schaden tut es auch nicht, und ich bin ja auf hohe Scores aus, also:

	# nur Ressourcen von derselben Domain einbinden
	add_header Content-Security-Policy "default-src 'self'";
	# kein Laden der Seite in (i)Frames erlauben
	add_header X-Frame-Options SAMEORIGIN always;
	# XSS Protection
	add_header X-XSS-Protection "1; mode=block" always;

Zur weiteren Recherche: in einem Stackoverflow Kommentar https://stackoverflow.com/a/43492470 habe ich ein ausführliches Github Repo über nginx Config gefunden: https://github.com/h5bp/server-configs-nginx

(3) Charset im HTTT-Header von HTML und Schriften angeben, um das Rendern zu beschleunigen.

Das klingt schon nach einer homöopatischen Mikro-Optimierung, aber warum nicht?

Hinzugefügt zu den `/etc/nginx/mime.types`: `"text/html; charset=UTF-8" html htm shtml;`

(4) Fehlende robots.txt Datei

txt-Files im Root macht mein Blog-Generator [Link zu easto] leider noch nicht mit, aber händisch angelegt habe ich eien simple robots.txt Datei, die allen alles erlaubt:

	User-agent: *
	Disallow:


(5) Überschriebene CSS-Properties

Es ist cool, dass Dareboost auf solche Details eingeht.

	https://blog.thomaspuppe.de/assets/styles.css
    .post table thead td:not(:first-child): "background" resets "background-color" property set earlier (line 125, col 5)
    .post table thead td:not(:first-child): "background" resets "background-color" property set earlier (line 125, col 5)

Weitere CSS Probleme:

- `body` CSS selector is duplicated
- superfluous selectors (https://blog.thomaspuppe.de/assets/styles.css: .grid body (line 52, col 3))

(6) Favicon

... wie die robots.txt

(7)

Your site doesn't use Open Graph properties

<meta property="og:title" content="The title" />
<meta property="og:type" content="The type" />
<meta property="og:url" content="http://url.com/" />
<meta property="og:image" content="http://image.jpg" />

... auch was für Easto und mein Blogtheme

(8)

- `integrity` Attribut für 3rd Party Ressourcen (die ich ja nicht habe)

(9) HSTS Header

... den hab ich doch eigentlich? Fixen!
