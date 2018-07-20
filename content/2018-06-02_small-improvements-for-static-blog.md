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

- https://tenon.io/
- https://developers.google.com/speed/pagespeed/insights/
- https://validator.w3.org/


## Syntax check



## content-type

`"text/html; charset=utf-8"` for html in `/etc/nginx/mime.types`


## Security

Not a real issue, but you can hide your webserver version from the HTTP headers by entering (or uncommenting) `server_tokens off;` in the http section of your nginx config (`/etc/nginx/nginx.conf`).


`add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;` in site config. (In each and every section where headers are set.)
