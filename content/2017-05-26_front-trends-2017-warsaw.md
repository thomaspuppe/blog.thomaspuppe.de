---
title: Front Trends 2017 in Warsaw
date: 2017-07-08
datelabel: 08. July 2017
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

**The How, What and Why of migrating to ReactJS** by [Jack Franklin](https://twitter.com/Jack_Franklin/) was not about React, but all about migrating complex software. His company Songkick switched from Angular (yesterdays hot code was "unmaintainable, feature-bloated, tricky, old developers gone") to ReactJS.

They did it by incremental migration, instead of a big bang. That way, you can learn as you migrate, often release to the public, and prioritize based on pain-points in the old app. At first, they migrated unit tests and introduced acceptance tests.

A mix of big and small tasks helped to keep momentum. People could choose freely from a big backlog in Trello. They aroused interest and morale  with a variety of available tasks.

Code-Reviews were split into feature branches with feature-part-branches and incremental pull requests. The knowlede base was inside the code repository, and maintained by the same pull requests that added/changed code.

Metrics (e.g. the number of Angular and React files) were prominently communicated, so the team could see if it was heading in the right direction. And this is a good thing to show to the business department.

**The Power of CSS** by [Una Kravets](https://twitter.com/Una) was a great [code-in-slides](https://codepen.io/una/full/3c45ff838c002255c1b04d63d422466e) performance (in Codepen!!!) about CSS effects like filters and blend-modes. Special takeaway for me: [youmightnotneedjs.com](http://youmightnotneedjs.com/).

**I didn't know the browser could do that!** by [Sam Bellen](https://twitter.com/sambego/) gave a cool introduction into new Browser APIs like `window.speechSynthesis`, Speech Recognition in Chrome, Geolocation, Notification, Push, MediaRecorder, BatteryManager. The examples were embedded in Sams cool and cute [cat assistant Poes](https://meow.sambego.be/poes) which is available for everyone online.

**Field-tested interfaces for the next billion** by [Ally Long](https://twitter.com/allyelle) ([slides](https://speakerdeck.com/allyelle/field-tested-interfaces-for-the-next-billion)) was about regions which are not as good connected as western countries, but will come online during the next years. Ally Long has worked for health projects in south-sahara Africa and shared valuable tips with us:

The typical device is Android on cheap hardware. Opera Mini is really big in Africa. Connectivity is bad, data is expensive, latency is high. Electrical power is badly available. As a consequence, you should follow some rules: UI should not be blocked by network loading (eg fullscreen spinners). No gestures. No off-canvas navigation. Forms should be no longer than a screen &mdash; rather use multi-screen forms. Don't use selectboxes &mdash; rather use a list of radio buttons. Skeuomorphism is better than flat design. Be robust for people to click everywhere and often. Use consistent UI. Strip everything back to the essentials!

**Watch your back, Browser! You're being observed.** by [Stefan Judis](https://twitter.com/stefanjudis) showed APIs and Obervers which are available to use in modern browsers: IntersectionObserver (check if an element is inside the visible viewport), MutationObserver (changes in DOM, save to use today), Timing API (navigation, user, resource), PerformanceObserver, ResizeObserver, Observables in general, ... check the [slides](https://speakerdeck.com/stefanjudis/watch-your-back-browser-youre-being-observed)!

**Easy and affordable user-testing** by [Ida Aalen](https://twitter.com/idaaa) was a funny talk about how everyone can conduct cheap user tests. Colleagues, designers, developers, or user testing experts are not your users! You find real users among your friends and on the streets. And since only 5 real users will catch most of the problems in any thing, it is worth trying some low-cost low-effort methods. Watch the [slides](https://www.slideshare.net/IdaAalen/easy-and-affordable-user-testing-front-trends-2017) and an article about the [tools mentioned in her talk](https://medium.com/@idaaa/low-budget-low-effort-tools-for-user-testing-b49912d32bc3) to get some great ideas!

**Rendering performance inside out** by [Martin Splitt](https://twitter.com/g33konaut) was about the insides of rendering inside the browser. The rendered page is composed of layers, and from a computational perspective, composing them is faster than repainting, because it can be done in parallel (pixels are independent from another). That's why videos or canvas, which are always inside their own layer, do not slow down the whole page. What I took away from this talk: do animations via transformation, and use the `will-change` property with absolute positioning. The [slides](https://docs.google.com/presentation/d/1AEsn5aR3orFuQuIRV70WylQN9OR4_AFBSX7jy13ITqc/edit) are available online.

**Legends of the Ancient Web** by [Maciej Cegłowski](https://twitter.com/baconmeteor/) talks about the fact that "there's nothing new under the sun" and that we have seen developments, which seem new in the web business, long before: in the radio broadcasting business. (Amateurs -> professionals -> business -> advertising -> copyright -> content created only to increase audience -> propaganda and hate speech.) This is an interesting analogy.

> You have a choice what you work for. If you work for mass surveillance. If you base your business model on evil. **You are not only technicians. You are also citicens and human beings.**
>
> &mdash; Maciej Cegłowski

**The First Meaningful Paint** by [Patrick Hamann](patrickhamann) ([video](https://www.youtube.com/watch?v=4pQ2byAoIX0) on CSSConf) talks about ways to speed up the first meaningful paint on a website. Nice example: Google renders the header of its result page, even before the search request is sent to the server. Measures you can take are: inlining critital CSS. `<link rel=preload>` (which also works via HTTP header). And HTTP/2 server push, which could even be done by your proxy cache, before the actual backend server renders a response.

**Motion In Design Systems: Animation, Style Guides, and the Design Process** by [Val Head](https://twitter.com/vlh): Very cool presentation about designer-developer-collaboration with sketches, storyboards (anyone can do. quick tests with little commitment. trigger, what happens, how does it happen?), motion comps (HTML5 tool: Tumult Hype) and interactive prototypes (tool: atomic, codepen). [Slides](https://www.slideshare.net/valhead/animation-in-design-systems-and-process-val-head), [Codepen](https://codepen.io/valhead).

**Experimenting your way to a better product** by [Zoe Mickley Gillenwater](https://twitter.com/zomigi/) was about A/B-Tests. It's clear that experiments help to avoid biases and opinions. The goal is that users drive the product direction. Zoe shared her process (observe, hypotesis, test, measure, avaluate, repeat) and experience (create smallest change possible, iterate quickly, most tests fail, one out of ten tiny changes has a huge impact). Cool talk, spiced up with some cognitive biases (Texas sharpshooter fallacy, HARPing).

> Avoid HIPPOs. _(Highest Paid Persons Opinions)_
>
> &mdash; Zoe Mickley Gillenwater

**Changing the layout game** by [Chris Wright](https://twitter.com/cwrightdesign/) presented some examples on how people hack CSS to get near the features they actually would like to have. Fox example we have hacked layouts with tables, floats, flexbox ... and now CSS grids are available. The talk contains a lot of nice examples on how to solve common problems in CSS. You should check the [slides](https://speakerdeck.com/cwrightdesign/changing-the-layout-game).

**Alternative Reality DevTools** by [Konrad Dzwinel](https://twitter.com/kdzwinel/) started with the history of browser dev tools, which have all been similar, and even today have seen not much improvement. So, Konrad tries new concepts, inspired by AutoCAD, video editing, processor design, game design, graphic design, and so on. Highlights: Context aware inspectors (for meta tags: docs and specs, for SVG: SVG editor). Concentrate on a certain element (hide all the others). Timeline (go back while using your app, e.g. un-click a radio button). Inionite canvas (multiple devices on one big screen). Good news: everyone can contribute! Firefox devtools are open source and written in React.

**Components, patterns and sh*t it’s hard to deal with** by [Marco Cedaro](https://twitter.com/cedmax): how do we manage and reuse patterns, without making them too rigid for day-to-day activities? Problems arise if you use BEM too dogmatic. Solutions: enable unbemmy/atomic CSS in some cases. Use open mixins where the author decides what to enforce, and what to expose to the user of the mixin. If you have a BEM-problem, step back and ask yourself: what problem are we actually trying to solve? [Slides](https://speakerdeck.com/cedmax/components-patterns-and-sh-star-t-its-hard-to-deal-with-at-front-trends-2017)

**Monsters, mailboxes and other nonsense** by [Niels Leenheer](https://twitter.com/rakaz) was about fun wit IoT in his smart house [Slides](https://speakerdeck.com/nielsleenheer/monsters-mailboxes-and-other-nonsense-at-front-trends).

**On How Your Brain is Conspiring Against You Making Good Software** by [Jenna Zeigen](https://twitter.com/zeigenvector) ([slides](http://jenna.is/slides/at-front-trends.pdf)) applies cognitive biases to software development. The effects everyone knows (pair programming and breaks are good, debugging your own code is hard, people are bad at estimating the time to program something) are explained by the cognitive biases humans have.

**Let's save the internet: How to make browsers compatible with the web** by [Ola Gasidlo](https://twitter.com/misprintedtype) introduced us to the history of browser wars and led to the W3C and WHATWG specs. [Slides](https://slidr.io/zoepage/let-s-save-the-internet-how-to-make-browsers-compatible-with-the-web#1). Takeaway: WHATWG specs are available on GitHub, you can contribute to prevent single companies from deciding on the webs future.

**Microservices - The FAAS and the Furious** by [Phil Hawksworth](https://twitter.com/philhawksworth) gave examples on how static sites can be enhanced with microservices (comments and search, for example). In the end, the setup was rather complex ;-) ... but the basic message is: start by outsourcing simple things.

**Demystifying Deep Neural Networks** by [Rosie Campbell](@RosieCampbell)  gave an introduction to machine leaning. Conventional programs have explicit algorithms, deep learning is trained with data. The talk was based on an [article](https://medium.com/manchester-futurists/demystifying-deep-neural-nets-efb726eae941) which explains the principles behind neural networks.

**I'm in IoT**: [Vadim Makeev](https://twitter.com/pepelsbey_/) controlled lamps and drones on stage with his browser. His drone was highjacked by someone in the audience :-). [Slides](https://pepelsbey.net/pres/im-in-iot/).

**Big Bang Redesign: Smashing Magazine’s 2017 Relaunch**: [Vitaly Friedman](https://twitter.com/smashingmag/) gave insights on why and how Smashing Magazine was rebuilt. Because of the rise of ad blockers, they shifted focus on membership and selling products. They used atomic design and a living styleguide (which is already outdated).

**A Cartoon Intro to React Fiber** by [Lin Clark](https://twitter.com/linclark/) was a deep dive into how React Fiber improves the perceived performance of react apps. I only understood that it prioritizes updates during rendering. You can watch the talk on [youtube](https://www.youtube.com/watch?v=qAs1bHnSn7I).

**The past and future of designing interfaces** by [Adam Morse](https://www.twitter.com/mrmrs_) was a bit abstract and about design systems (which are like Gutenbergs moveable type), spreadsheets (a study shows: almost all have errors) teams (if you have less or more than 3 people, you won't make any substantial progress). My highlight was the idea of a random content generator for design systems, which puts a stress test on styleguides by automatic permutation of content.

**Prevent Default — The future of authoring tools** by [Mihai Cernusca](https://twitter.com/mcernusca/) showed a lot of examples and principles of authoring tools from the past, present and future. Even complex 3D software uses a heap of generic UI elements (sliders, input, radio buttons). How can we enhance this? The tool "[Hemingway](http://www.hemingwayapp.com/)" lints your text while writing. But apart from that, most text editors look like Word 1.0. And it gets harder if you want to edit layout instead of vertical one-column text flow, have history, drag&drop, selection, cursor navigation. Mihais Solutions: ContentEditable, Outliner, Workflowy, Notion.io.

**Building a Progressive Web App** by [Kirupa Chinnathambi](https://twitter.com/kirupa/) was an intoductionto PWAs ([Slides](https://onedrive.live.com/view.aspx?resid=1D3A48480C64E70E!163164&ithint=file%2cpptx&app=PowerPoint&authkey=!ACeg0TvJaXr-rJk)). It was new to me that PWAs are available and installable from the Windows 10 app store.


## Random facts that I learned:

- There is a [CLI for caniuse.com](https://github.com/sgentle/caniuse-cmd)
- You can style the `caret-color` in CSS.
- You can throttle animations in Chrome DevTools to have a slow-motion ([Screenshot](https://twitter.com/teddyrised/status/867689292281335809))
- The CSS property `will-change: height`.
- Media queries are becoming increasingly complex. Solution is a more fluid design. But except from percentages and fluid font sizing, there are no good solutions.
- `<input type="text" pattern="..." />` is a thing

## My catch-up list:

- Play with new browser APIs
- Use CSS grids
- Finally, use HTTP/2
