---
title: URL-unshortening
date: 2017-01-06
datelabel: 06. Januar 2017
language: de
tags: [Webentwicklung]
permalink: url-unshortening
draft: false
description: Auflösen von bit.ly, fb.me und co im großen Stil
---

Für ein aktuelles Feature bei Bundestwitter trage ich gerade zusammen, welche Links von Politikern via Twitter verbreitet wurden. Dabei stellt sich heraus, dass mehr als 20% der geposteten Links sogenannte Shortlinks sind. Also nicht nur die Kürzung von Twitter selbst via `t.co` (deren echte URLs werden über die APIs mitgeliefert), sondern es werden schon Short-URLs beim Schreiben der Tweets eingegeben.

In Zahlen drückt sich das so aus (bei insgesamt 48.000 Links):

- 6404 &times; fb.me
- 1506 &times; bit.ly
- 1072 &times; ow.ly
- 199 &times; tinyurl.com
- 187 &times; goo.gl
- 138 &times; ift.tt

Diese URLs möchte ich nun also auflösen. Im Internet findet man darüber [Artikel](http://security.thejoshmeister.com/2009/04/how-to-preview-shortened-urls-tinyurl.html), [einige](http://www.toolsvoid.com/unshorten-url) [verschiedene](https://www.unshorten.it/) [Dienste ](http://checkshorturl.com/) und [diverse](https://github.com/quark-zju/unshorten) [Scripte](https://github.com/mathiasbynens/node-unshorten), [Bibliotheken](https://github.com/nodeca/url-unshort) und [Snippets](https://gist.github.com/zhasm/986361) bei GitHub.

# Eigentlich ist es viel einfacher!

Es stellt sich heraus, dass _im Prinzip_ ein Curl-Aufruf ausreicht. Alle genannten Dienste antworten mit einem HTTP Status 301 und dem Location-Header. __Das Internet ist also doch noch nicht so kaputt wie ich dachte.__

In Bash ist das ganz simpel: `curl -I http://fb.me/16MEzokwA`. Fertig. Wegen der Anbindung an meine Datenbank habe ich die Arbeit mit PHP erledigt, was auch mit Bordmitteln und ein paar Codezeilen funktioniert:

<pre>function get_resp_from_url($url)
{
    $curlConnection = curl_init();
    curl_setopt($curlConnection, CURLOPT_URL, $url);
    curl_setopt($curlConnection, CURLOPT_NOBODY, true);

    if (curl_exec($curlConnection) == false) {
        print 'Curl-Error: ' . curl_error($ch);
        curl_close($curlConnection);
        return false;
    } else {
        $responseInfo = curl_getinfo($curlConnection);
        curl_close($curlConnection);
        return array(
            'status' => $responseInfo['http_code'],
            'location' => $responseInfo['redirect_url']
            );
    }
}</pre>

Einzig Facebook konnte damit nicht abgegrast werden. `fb.me`-Adressen liefern mir zuverlässig Status 301 bei Abfrage per Bash, und Status 200 mit Facebook-HTML im Body bei der Abfrage per PHP.

Weder Google noch die curl-Referenz für PHP konnten helfen, also musste Python herhalten. Nach dem üblichen erfolglosen Herumirren auf mehreren Wegen (`httplib` und `urllib2`) funktioniert es dann auf diese Art:

<pre>import requests
r = requests.get(url, allow_redirects=False)
if r.status_code == 301:
	return r.headers.get('Location')</pre>

Schöne Erkenntnis am Rande: selbst bei hunderten oder tausenden Abfragen im unter-Sekunden-Takt hat keiner der Dienste mit Rate Limiting oder anderer Abweisung reagiert.
