---
title: Competetive Frontend Performance Benachmarking
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

- bsp speedcurve
- bsp unser sitespeed dashboard


[At work](TODO:ZON-FE-Manual) we haveset up our sitespeed manually. That way, we can send everything we can imagine to our Graphite, and display at Grafana. So we startet expanding our tests from performance to [accessibility, quality or CSS stats](TODO:a11ydashboardRepo).

TODO: Screenshot der HTML Errors competetive


## RUM (real user monitoring) data about your competitors with CrUX

... eigentlich gehts nicht

Chrome Real User Experience ("CrUX") Report hat Daten, die im Chrome Browser gesammelt werden. Diese decken allerdings nur die 10000 größten Seiten ab, und sind eben nur von neueren Versionen des Chrome-Browsers.

https://developers.google.com/web/tools/chrome-user-experience-report/

[Page Speed Insights](https://developers.google.com/speed/pagespeed/insights/)

Report kann jeder nutzen, zB https://beta.httparchive.org/reports/chrome-ux-report

https://gist.github.com/RatulSaha/c06a31354ccb07b02584088659cd328f

Google Big Query has a CrUX data set (latest one from January 2018) https://bigquery.cloud.google.com/table/chrome-ux-report:all.201801 . And you can query this set for free, if you have a Google account.

Google provides some [example queries](https://developers.google.com/web/tools/chrome-user-experience-report/getting-started#example-queries), which work well with the 2017 dataset. Just change the URL. For 2018 you need to change the queries, because they renamed some fields.


https://bigquery.cloud.google.com/savedquery/415027649228:2e0411a31423477892f0a27aa990f5ed


https://calendar.perfplanet.com/2017/finding-your-competitive-edge-with-the-chrome-user-experience-report/

https://developer.akamai.com/akamai-mpulse/crux-benchmarking

------------------------

- https://www.dareboost.com/en/comparison/ ---> das auch bei competetive perf in den blogpost! (neben https://gtmetrix.com/reports/ , https://gtmetrix.com/compare/)
  - https://passmarked.com/reports/20180626c516d0f07137P?section=performance (also einen webperf-Aschnitt im Blogpost machen ... ausgezeichnet :-)
