---
title:
date: 2018-03-06
datelabel: 06. March 2018
language: en
tags: [Webentwicklung]
permalink: competetive-performance-benchmarking
draft: true
description:
---

[TOC mit Anker-Deeplinks]


## Manual tests inside the browser



## Manual tests



## One-time comparison tools



## Continuous benchmarks in synthetic tools



## RUM (real user monitoring) data about your competitors with CrUX

... eigentlich gehts nicht

Chrome Real User Experience ("CrUX") Report hat Daten, die im Chrome Browser gesammelt werden. Diese decken allerdings nur die 10000 größten Seiten ab, und sind eben nur von neueren Versionen des Chrome-Browsers.

https://developers.google.com/web/tools/chrome-user-experience-report/

[Page Speed Insights](https://developers.google.com/speed/pagespeed/insights/)


Google Big Query has a CrUX data set (latest one from January 2018) https://bigquery.cloud.google.com/table/chrome-ux-report:all.201801 . And you can query this set for free, if you have a Google account.

Google provides some [example queries](https://developers.google.com/web/tools/chrome-user-experience-report/getting-started#example-queries), which work well with the 2017 dataset. Just change the URL. For 2018 you need to change the queries, because they renamed some fields.


https://bigquery.cloud.google.com/savedquery/415027649228:2e0411a31423477892f0a27aa990f5ed
