---
title: domain.de+ auf Google+ Profil umleiten
date: 2013-01-17
datelabel: 17. Januar 2013
language: de
tags: [Web-Entwicklung]
permalink: eigene-domain-google-plus-umleiten
draft: false
---

Ein Tipp für die Leute mit eigener Domain: Weiterleitung von **thomaspuppe.de/+** auf das Google-Profil via .htaccess:

<code>RewriteEngine on
RewriteCond %{REQUEST_URI} ^/\+
RewriteRule ^(.*)$ https://plus.google.com/u/0/109992889758306031081/ [R=permanent,L]</code>
