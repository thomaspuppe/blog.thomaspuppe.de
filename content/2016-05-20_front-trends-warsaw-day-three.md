---
title: "Front Trends 2016 in Warsaw: Day 3"
date: 2016-05-20
datelabel: 20. Mai 2016
language: en
tags: [Webentwicklung]
permalink: front-trends-2016-warsaw-day-three
draft: false
description: Summarizing the third day presentations of the Front Trends 2016 conference in Warsaw, including the Nyan cat, pixel bonding, modern(izer) tools, CSS engineering principles, Origami, offline pages, real programmers and Trojan CVs.
---

Summarizing the third day presentations of the Front Trends 2016 conference in Warsaw, including the Nyan cat, pixel bonding, modern(izer) tools, CSS engineering principles, Origami, offline pages, real programmers and Trojan CVs.. A speakers list can also be found on [2016.front-trends.com/speakers/](https://2016.front-trends.com/speakers/).

<figure>
	<img src="/images/2016/05/front-trends-emotions.jpg" alt="Photograph of a slide with Nyan Cat"/>
	<figcaption>If an interface is more human, it allow us to be more human.<br>&mdash;Tammie Lister</figcaption>
</figure>


## Opening by [Staś Małolepszy](https://twitter.com/stas)

Trigger a bit of interest, be available to help. And many cool things will happen.

* [Construct 2](https://www.scirra.com/construct2): HTML5 game maker



## Exploring the Universal Library by [Szymon Kalinski](http://treesmovethemost.com/)

Szymon showed some work he had done. It looked [really cool](http://treesmovethemost.com/), but honestly I don't know what he wanted to tell us ;-)



## Pixel Bonding by [Tammie Lister](http://diaryofawebsite.com/)

People long for connection with others. By creating emotional UX and positive experience, you create trust and users will come back.

As a user, you recognize if an interface (the people behind it) care for you, or simply don't care. For example, friends don't let friends make mistakes.

Even little UI eastereggs can be incredibly delightful. But don't get creepy. Nobody likes stalker interfaces.

> If an interface is more human, it allow us to be more human.

* Slides of the Presentation: [Pixel Bonding](https://speakerdeck.com/tammielis/pixel-bonding), including lots of cool interface details.
* Tammies Twitter Account: [karmatosed](https://twitter.com/karmatosed)



## Modern Websites for the Modern Web by [Patrick Kettner](https://twitter.com/PatrickKettner)

Use of tools inside the new version of the Modernizr website and downloader: Service workers, clipboard.js, download binary blobs of service-worker-generated files, [decent markup](https://twitter.com/thomaspuppe/status/733603489067245568), custom Modernizr versions via npm install,

> Make cool stuff. Don't be afraid to use new shiny things.

* [Video of this talk](https://www.youtube.com/watch?v=UPrlA8I9dm8) (at JSConf US)



## CSS for Software Engineers for CSS Developers by [Harry Roberts](https://twitter.com/csswizardry)

Harry applies software engineering principles to CSS development: DRY, Single Source of Truth, Single Responsibility, Seperation of Concerns(!), Immutability, Open/Closed Principle,

Good and funny talk with lots of code examples. One of the [conference highlights](front-trends-2016-warschau-fazit)!

> There are 6,442,450,944 possible combinations of s sandwich at Subways. And all taste the same.

* [Presentation slides](https://speakerdeck.com/csswizardry/css-for-software-engineers-for-css-developers)
* two [video](https://vimeo.com/140641366) [recordings](https://vimeo.com/153895841) of this talk
* You should take 10 minutes and read about [Grace Hopper](https://en.wikipedia.org/wiki/Grace_Hopper).



## Can't you make it more like Bootstrap? by [Alice Bartlett](http://alicebartlett.co.uk/)

Subtitle: "Considerations for building front end systems". Alice leads a team whose aim is to unify and DRY frontend work at the Financial Times (project "Origami".

On the different FT branded websites, there are a lot of things which have been implemented differently, even on atomic scale (4 implementations of a close button which looks the same, 3 different Twitter icons).

First step was to use components to keep HTML, CSS, JS for one thing in one place (this seems to be a hot topic this year).

The websites also have different tooling, which should be unified so all websites (implemented in different languages) can use the same components.

You can move the JS to bower packages, for example. But for (customizable) HTML templates or CSS ths is more complicated. So they implemented a build service that "everyone" can use to request Origamis CSS, JS and HTML. People liked using it, but the documentation was not good. -> I wish it was more like bootstrap.

And: they created a documentation styleguide(!), whcih includes a communication plan for new releases, incident reports, ...

> Documentation is not complicated. It is just hard.

* Alice Bartlett on Twitter: [@alicebartlett](https://twitter.com/alicebartlett
* talk recommendation: "Thingness" Mark Boulton (should be on vimeo, but I could not find the link)
* [Origami on GitHub](https://github.com/financial-times/ft-origami)



## Building an Offline Page for The Guardian [Oliver Joseph Ash](https://oliverjash.me/)

The Guardian's Native app caches articles offline, to provide content even if the user (or the servers) are offline. The website is not available offline. Oliver built a prototype for an offline page in less than a day! And provided a detailes step-by-step walkthrough on how it works.

* Oliver Ashs Twitter Account: [@oliverjash](https://twitter.com/oliverjash)
* [The slides](https://speakerdeck.com/oliverjash/building-an-offline-page-for-theguardian-dot-com-front-trends-may-2016) of this talk
* This talk on video: [Building an offline page for theguardian.com](https://www.youtube.com/watch?v=dZU6_2xXeVk)
* [the Guardian's digital development team blog](https://www.theguardian.com/info/developer-blog)



## The Myth of the "Real JavaScript Programmer" by [Brenna O'Brian](http://brennaobrien.com/)

Great talk about what seems to be expected from "good programmers" today, and what really is.

We don't need to know everything, finding a niche is cool. This is not a test. Real developers use resources wisely. Code has not to be perfect or even correct on the first try (or at all). Learn from mistakes. Show your work, not only your finished and polishes products. Encourage each other. We don't have to code all the day and everyday. Being a developer does not have to kill your hobbies (or parentship).

> My biggest professional development was admitting what I don't know.
> &mdash; Jessica Rose

* Brenna O'Brian on Twitter: [@brnnbrn](https://twitter.com/brnnbrn)
* Slides should come up [here](http://brennaobrien.com/speaking/) soon, a [pdf version](http://talks.brennaobrien.com/real-developer/myth-of-the-real-javascript-developer.pdf) is already available.
* Hashtag [#juniordevforlife](https://twitter.com/search?q=%23juniordevforlife)



## Don't hate the player, hate the game by [Tim Holman](http://tholman.com/)

> please be less ridiculous

* Tims Twitter: [@twholman](https://twitter.com/twholman)
* Tims website: [tholman.com](http://tholman.com/)
* Some [funny presentations](http://slides.com/tholman/), todays not included

> Creativity is the best motivator.
> Projects are a journey, be fluid.
> &mdash; Tim Holman
