---
title: Notizen Januar 2019
date: 2019-01-21
datelabel: 01. Januar 2019 – 21. Januar 2019
language: de
tags: [Notizen]
permalink: notizen-januar-2019
draft: false
description: "Notizen und Lesetipps für Januar 2019: Performance, Privacy und das vorläufige Ende des Browser War"
---

## Tim Kadlec: The Ethics of Web Performance

Tim Kadlec räsoniert in seinem Artikel "[The Ethics of Web Performance](https://timkadlec.com/remembers/2019-01-09-the-ethics-of-performance/)" darüber, dass imperformante Websites nicht nur ökonomisch sondern auch moralisch schlecht sind.

> Performance as exclusion. Performance as waste.

Zum Thema Waste gibts dann eine schöne Milchmädchenrechnung: in einer Studie wurde errechnet, dass für jedes GB Daten im Internet 5 kWh an Energie benötigt werden (für die Übertragung, nehme ich an). Folglich sind das laut Kadlec 17.6 Millionen kWh pro Tag. Jetzt kann man als Hausaufgabe überschlagen wie viele Kernkraftwerke durch das Abschalten des Google Tag Managers eingespart würden ;-)

Ein anderes Beispiel: beim [Youtube Feather](http://blog.chriszacharias.com/page-weight-matters) Projekt hat [Chris Zacharias](https://twitter.com/zacman85) entdeckt, dass Nutzer in nicht-so-reichen Ländern die Videoplattform überhaupt erst nutzen können, wenn man sie radikal beschleunigt. Also ganze Nutzergruppen _konnten_ Youtube vorher gar nicht benutzen, obwohl sie es wollten. Das beweist erneut "Performance is Accessibility".

### ... und die Ökonomie von Web Performance?

Ich glaube ja, dass das gleiche für ... sagen wir ... News-Websites zutreffen würde. Die erste Seite die signifikant schneller ist als der Rest wird sicher viel mehr besucht. Erreichen könnte man das z.B. durch weniger nervige Werbung. Die Einkommensverluste pro Besucher/Klick würde man dann durch höhere Reichweite ausgleichen? Kann man nicht wissen, solange man es nicht probiert.

Zumal: die große Verbreitung von Adblockern kommt ja nicht daher, dass die Menschen Werbung an sich blöd finden. Vielmehr stören sie sich an der schlechten Performance und am unkontrollierten Tracking. Wenn man durch ehrliches Ausliefern eigener guter Inhalte mit ganz normaler Werbung die Leute überzeugen kann, ihre Adblocker auszuschalten, kommen gleich mal 30% zählbare Nutzer hinzu. Damit überholt man locker seine nächsten beiden Mitbewerber.

Aus den gleichen Motiven, aus denen Leser Adblocker benutzen, benutzen sie den Reader-Mode im Browser, oder auch Pocket. Dass (und wie) wir mit unseren Websites gegen die schöne text-only Darstellung der Browser konkurrieren, legt Eric Bailey dar in [Reader Mode: The Button to Beat](https://css-tricks.com/reader-mode-the-button-to-beat/):

> And what if we’re on a slow, intermittent, and/or metered connection? Top-of-the-line MacBooks still have to use hotel wifi, just like everyone else.

Zwei Tage später habe ich im Smashing Magazine den Artikel [How Improving Website Performance Can Help Save The Planet](https://www.smashingmagazine.com/2019/01/save-planet-improving-website-performance/) entdeckt. Auch hier ist "save the Planet" aus meiner Sicht ein wenig übertrieben. Aber die Intention ist fein. Mach Sachen schlank und performant, dann hilfst du dem Planeten. Und wenn ein Berliner Webdev-Hipster sich _dadurch_ überzeugen lässt, Preact statt React zu benutzen &mdash; auch gut.

Weiterführende Links zum Thema:

- Heydon Pickering: [writing less damn code](https://vimeo.com/190834530) (Video bei vimeo)
- Brad Frost: [Death to Bullshit](http://deathtobullshit.com/)
- Adam Silver: [Designing For Actual Performance](https://adamsilver.io/articles/designing-for-actual-performance/)


## Usability/Findability Vergleich von Flat Design vs Traditional Design

Ein Paper aus dem Jahr 2015 wurde bei Hacker News hochgespült. Forscher aus Russland haben "[Flat Design vs Traditional Design](https://www.researchgate.net/publication/281628009_Flat_Design_vs_Traditional_Design_Comparative_Experimental_Study)" verglichen, in Bezug auf Findbarkeit von User Interface Elementen. Flat Design schneidet schlechter ab.

> The results show that a search in ﬂat text mode (compared with the traditional mode) is associated with higher cognitive load. A search for ﬂat icons takes twice as long as for realistic icons and is also characterized by higher cognitive load. Identifying clickable objects on ﬂat web pages requires more time and is characterised by a signiﬁcantly greater number of errors.


## The State of Web Browsers

Eine schöne Analyse zum aktuellen Stand des Browser Wars. Warum hat Chrome gewonnen, was erwartet die anderen hersteller und den Nutzer in naher Zukunft? [Ferdy Christant: The State of Web Browsers 2018](https://ferdychristant.com/the-state-of-web-browsers-f5a83a41c1cb)

> It’s a better kind of dominance. Like a friendlier dictator. But still a dictator.

Und weil der Artikel so dystopisch ist, gibt es noch ein follow-up zur Aufmunterung: [Ferdy Christant: The State of Web Browsers 2019](https://ferdychristant.com/the-state-of-web-browsers-88224d55b4e6)

Mein Lieblingszitat:

> Be honest, it’s you that wants Web Components, not your users. I won’t judge, I love web tech too.


## LinkedIn spioniert die Browser-Extensions seiner Nutzer aus

Apropos Dystopie und Microsoft und Dominanz: am Beispiel von Linkedin wird hier gezeigt, wie Websites herausfinden können welche Browser-Extensions ein Besucher installiert hat: [Nefarious LinkedIn](https://github.com/dandrews/nefarious-linkedin)

tldr: man prüft, welche lokalen Extension-Dateien der Browser von `chrome://extensions` lädt, oder welche Manipulationen auf berühmten Websites vorgenommen werden. Und gleicht das dann mit seiner Datenbank bekannter Extensions ab.

Das erinnert mich an die gute alte [Erkennung von visited Links](https://dbaron.org/mozilla/visited-privacy) via `getComputedStyles()`, um herauszufinden welche anderen Seiten deine Besucher noch besucht hat.


## Hiring Engineers

Wer Software-Entwickler einstellt, ist heutzutage kein "Käufer" der sich den Entwickler aussucht, sondern er ist "Verkäufer" der vor allem die Firma gut darstellen muss. Die Firmen müssen sich bei den Entwicklern bewerben, nicht andersherum. Das ist alles etwas arrogant geschrieben, aber inhaltlich hat der Autor (gegenwärtig) recht. Welche Aspakte es da zu berücksichtigen gilt, und ein paar schöne Analogien, findet man bei [Trouble hiring senior engineers? It's probably you](https://hiringengineersbook.com/post/trouble-hiring/).


## Sonstiges

Die New York Times hat wegen der DSGVO in Europa auf targeted Ads verzichtet, und ist davon nciht pleite gegangen: [After GDPR, The New York Times cut off ad exchanges in Europe — and kept growing ad revenue](https://digiday.com/media/new-york-times-gdpr-cut-off-ad-exchanges-europe-ad-revenue/)

> The desirability of a brand may be stronger than the targeting capabilities.


Im Guardian erklärt Paul Dolan in einem Exzerpt seines neuen Buches, dass das Erfüllen von gesellschaftlichen Erwartungen nicht automatisch glücklich macht (social narrative vs personal experience): [The money, job, marriage myth: are you happy yet?](https://www.theguardian.com/books/2019/jan/06/happiness-index-wellbeing-survey-uk-population-paul-dolan-happy-ever-after).

> To be happier we need to move from a culture of “more please” to one of “just enough”.



