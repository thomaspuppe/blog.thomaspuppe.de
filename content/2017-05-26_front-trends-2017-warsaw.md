---
title: Front Trends 2017 in Warsaw
date: 2017-05-27
datelabel: 27. May 2017
language: en
tags: [Web Development]
permalink: front-trends-2017-warsaw
draft: false
description: A list of talks from the Front Trends 2017 conference in Warsaw, and some remarks.
---

A list of talks from the Front Trends 2017 conference in Warsaw, and some remarks.

There are other summaries available. First of all, the [official schedule](https://2017.front-trends.com/schedule/), which also contains descriptions of each talk. [Nienke Dekker](https://github.com/nienkedekker/Front-Trends-2017) put her detailed notes on GitHub. Syb Wartna has a [blog post about his highlights](http://waarissyb.nl/articles/fronttrends-2017-highlights.html). These sources provide more detail. My list is more of a link collection.

<figure>
	<img src="/images/2017/05/front-trends.jpg" alt="Venue of the Front Trends 2017 conference in Warsaw" />
	<figcaption>Venue of the Front Trends 2017 conference in Warsaw</figcaption>
</figure>

## The talks, in order of my personal preference

**The How, What and Why of migrating to ReactJS** by [Jack Franklin](https://twitter.com/Jack_Franklin/)

**The Power of CSS** by [Una Kravets](https://twitter.com/Una) was a great code-in-slides [code-in-slides](https://codepen.io/una/full/3c45ff838c002255c1b04d63d422466e) performance (in Codepen!!!) about CSS effects like filters and blend-modes. Special takeaway for me: [youmightnotneedjs.com](http://youmightnotneedjs.com/).

**I didn't know the browser could do that!** by [Sam Bellen](https://twitter.com/sambego/) gve a cool introduction into new Browser APIs like `window.speechSynthesis`, Speech Recognition in Chrome, Geolocation, Notofication, Push, MediaRecorder, BatteryManager. The examples were embedded in Sams cool and cute [cat assistant Poes](https://meow.sambego.be/poes) which is available for everyone online.

**Field-tested interfaces for the next billion** by [Ally Long](https://twitter.com/allyelle) [Slides](https://speakerdeck.com/allyelle/field-tested-interfaces-for-the-next-billion) was about regions which are not as good connected a dwestern countries, but will come online i the next Years. Ally Long has worked for health projects in south-sahara Africa and shared valuable tips with us:
The typical device is Android on cheap hardware. Opera Mini is really big in Africs. Connectivity is bad, data is expensive, latency is high. Electrical power is badly available. UI should not be blocked by network loading (eg fullscreen spinners). No gestures. No off-canvas navigation. Forms should be no longer than a screen &mdash; rather use multi-screen forms. Don't use selectboxes &mdash; rather use a list of radio buttons. Skeuomorphism is better than flat design. Be robust for people to click everywhere and often. Use consistent UI. Strip everything back to the essentials!

**Watch your back, Browser! You're being observed.** by [Stefan Judis](https://twitter.com/stefanjudis) showed APIs and Obervers which are available to use in modern browsers: IntersectionObserver (check if an element is inside the visible viewport), MutationObserver (changes in DOM, save to use today), Timing API (navigation, user, resource), PerformanceObserver, ResizeObserver, Observables in general, ... check the [Slides](https://speakerdeck.com/stefanjudis/watch-your-back-browser-youre-being-observed)!

**Easy and affordable user-testing** by [Ida Aalen](https://twitter.com/idaaa) [Slides](https://www.slideshare.net/IdaAalen/easy-and-affordable-user-testing-front-trends-2017) and an article about the [tools mentioned in her talk](https://medium.com/@idaaa/low-budget-low-effort-tools-for-user-testing-b49912d32bc3).

**Rendering performance inside out** by [Martin Splitt](https://twitter.com/g33konaut) [Slides](https://docs.google.com/presentation/d/1AEsn5aR3orFuQuIRV70WylQN9OR4_AFBSX7jy13ITqc/edit)

**Legends of the Ancient Web** by [Maciej Cegłowski](https://twitter.com/baconmeteor/) talks about the fact that "there's nothing new under the sun" and that we have seen recent developments in the web business before: in the radio broadcasting business. (Amateurs -> professionals -> business -> advertising -> copyright -> content created only to increase audience -> propaganda and hate speech.) This is an interesting analogy.

> You have a choice what you work for. If you work for mass surveillance. If you base your business model on evil. **You are not only technicians. You are also citicens and human beings.**
>
> &mdash; Maciej Cegłowski

**The First Meaningful Paint** by [Patrick Hamann](patrickhamann) [Video](https://www.youtube.com/watch?v=4pQ2byAoIX0) (on CSSConf) talks about ways to speed up the first meaningful paint on a website. (Nice example: Google renders the header of its result page, even before the search request is sent to the server.) Measures are: inlining critital CSS. `<link rel=preload>` (which also works via HTTP header). And HTTP/2 server push, which could even be done by your proxy cache, before the actual backend server renders a response.

**Motion In Design Systems: Animation, Style Guides, and the Design Process** by [Val Head](https://twitter.com/vlh) [Slides](https://www.slideshare.net/valhead/animation-in-design-systems-and-process-val-head)

**Experimenting your way to a better product** by [Zoe Mickley Gillenwater](https://twitter.com/zomigi/)

**Changing the layout game** by [Chris Wright](https://twitter.com/cwrightdesign/) [Slides](https://speakerdeck.com/cwrightdesign/changing-the-layout-game)

**Alternative Reality DevTools** by [Konrad Dzwinel](https://twitter.com/kdzwinel/)

**Components, patterns and sh*t it’s hard to deal with** by [Marco Cedaro](https://twitter.com/cedmax): how do we manage and reuse patterns, without making them too rigid for day-to-day activities? Problems arise if you use BEM too digmatic. Solutions: enable unbemmy/atomic CSS in some cases. Use open mixins where the author decides what to enforce, and what to expose to the user of the mixin. If you have a BEM-problem, step back and ask yourself: what problem are we actually trying to solve? [Slides](https://speakerdeck.com/cedmax/components-patterns-and-sh-star-t-its-hard-to-deal-with-at-front-trends-2017)

**Monsters, mailboxes and other nonsense** by [Niels Leenheer](https://twitter.com/rakaz) was about fun wit IoT in his smart house [Slides](https://speakerdeck.com/nielsleenheer/monsters-mailboxes-and-other-nonsense-at-front-trends).

**On How Your Brain is Conspiring Against You Making Good Software** by [Jenna Zeigen](https://twitter.com/zeigenvector) [Slides](http://jenna.is/slides/at-front-trends.pdf)

**Let's save the internet: How to make browsers compatible with the web** by [Ola Gasidlo](https://twitter.com/misprintedtype) [Slides](https://slidr.io/zoepage/let-s-save-the-internet-how-to-make-browsers-compatible-with-the-web#1)

**Microservices - The FAAS and the Furious** by [Phil Hawksworth](https://twitter.com/philhawksworth)

**Demystifying Deep Neural Networks** by [Rosie Campbell](@RosieCampbell) [](https://medium.com/manchester-futurists/demystifying-deep-neural-nets-efb726eae941)

**I'm in IoT** by [Vadim Makeev](https://twitter.com/pepelsbey_/)

**Big Bang Redesign: Smashing Magazine’s 2017 Relaunch**: [Vitaly Friedman](https://twitter.com/smashingmag/) gave insights on why and how Smashing Magazine was rebuilt. Because of the rise of ad blockers, they shifted focus on membership and selling products. They used atomic design and a living styleguide (which is already outdated).

**A Cartoon Intro to React Fiber** by [Lin Clark](https://twitter.com/linclark/)

**The past and future of designing interfaces** by [Adam Morse](https://www.twitter.com/mrmrs_) was a bit abstract and about design systems (which are like Gutenbergs moveable type), spreadsheets (a study shows: almost all have errors) teams (if you have less or more than 3 people, you won't make any substantial progress). My highlight was the idea of a random content generator for design systems, which puts a stress test on styleguides by automatic permutation of content.

**Prevent Default — The future of authoring tools** by [Mihai Cernusca](https://twitter.com/mcernusca/)

**Building a Progressive Web App** by [Kirupa Chinnathambi](https://twitter.com/kirupa/) [Slides](https://onedrive.live.com/view.aspx?resid=1D3A48480C64E70E!163164&ithint=file%2cpptx&app=PowerPoint&authkey=!ACeg0TvJaXr-rJk)


Lightning Talks

https://twitter.com/slsoftworks
https://twitter.com/mjaniszew , https://github.com/mjaniszew/dynamic-imports-example
[Yosef Durr](https://twitter.com/yosefdurr) about Bash on Windows.

## Random facts that I learned:

- There is a [CLI for caniuse.com](https://github.com/sgentle/caniuse-cmd)
- You can style the `caret-color` in CSS.
- You can throttle animations in Chrome DevTools to have a slo-mow ([Screenshot](https://twitter.com/teddyrised/status/867689292281335809))
- The CSS property `will-change: height`.
- Media queries are becoming increasingly complex. Solution is a more fluid design. But except from percentages and fluid font sizing, there are no good solutions.

## My catch-up list:

- Play with new browser APIs
