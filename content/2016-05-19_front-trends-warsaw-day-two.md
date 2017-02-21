---
title: Front Trends 2016 in Warsaw: Day 2
date: 2016-05-19
datelabel: 19. Mai 2016
language: en
tags: [Webentwicklung]
permalink: front-trends-2016-warsaw-day-two
draft: false
description: Summarizing the second day presentations of the Front Trends 2016 conference in Warsaw. Todays talks were about components, digital afterlife, tiny JS, typography, knitting and frontend tooling.
---

Summarizing the second day presentations of the Front Trends 2016 conference in Warsaw. Todays talks were about components, digital afterlife, tiny JS, typography, knitting and frontend tooling. A speakers list can also be found on [2016.front-trends.com/speakers/](https://2016.front-trends.com/speakers/).

<figure>
	<img src="/images/2016/05/warschau-panorama.jpg" alt="beautiful city of Warsaw" />
	<figcaption>beautiful Warsaw</figcaption>
</figure>


## First Class Styles by [Mark Dalgleish](http://markdalgleish.com/)

The first talk was very technical, but on an abstract level. Todays tooling handles HTML, Images, JS, CSS seperately (seperate tasks in Grunt or Gulp), and the connecteion between them has to be maintained by the developer (by using the same names e.g.). It would be better to have everything which belongs to one component in one place (including CSS which might be written in JS and served inline). Another hot thing: server-side rendering of the HTML. (sic!)

My instant reaction: *WTF?* This is wrong on so many levels! But Mark presented good arguments (the strongest: it works in production on a big app) that I will take some time reading his blog posts.

* Twitter: [@markdalgleish](https://twitter.com/markdalgleish)
* Blogpost: [Block, Element, Modifying Your JavaScript Components](https://medium.com/seek-ui-engineering/block-element-modifying-your-javascript-components-d7f99fcab52b#.mc6l5gsx6)
* Blogpost: [The End of Global CSS](https://medium.com/seek-ui-engineering/the-end-of-global-css-90d2a4a06284#.ppl4ol45r)
* [css-modules](https://github.com/css-modules) on GitHub



## Our eternal digital afterlife by [Alberta Soranzo](https://twitter.com/albertatrebla)

Peoples social media profiles are still available when they pass away. Alberta Soranzo explained what tools and strategies (not yet dead) people and their relatives can do. Very moving and widespread talk.

> We need to design offboarding.

* Film recommendation: Black Mirror, Season 02, Episode 01: "be right back"



## Demo Reel & Tiny JavaSCript by [Mathieu Henry](http://www.p01.org/)

The creative coder and code golfer did exactly this: vanilla JS coding of a cool visualization with sound in just a few lines. First some dirty tricks, then some jawdropping live coding.

* check [Henrys Website](http://www.p01.org/) with really cool stuff!



## Syntax Highlight Everything by [Kenneth Ormandy](https://twitter.com/kennethormandy)

> Syntax highlighting is designed.

Starting with features of syntax highlighting and code fonts, Kenneth explains some typographic features (kerning, ligatures, case-sensitive fonts, small caps) and how to use them correctly in your CSS. The best part: you can just copy and use it from [utility-opentype.kennethormandy.com](http://utility-opentype.kennethormandy.com/).

* eBook recommendation: [Butterick's Practical Typography](http://practicaltypography.com/)



## Lightning Talks

[Marciej Korsan](http://www.maciejkorsan.com/): Frontend is an art (an ukulele song!!!!).

[Ramon Vicor](http://ramonvictor.github.io/): Redux principles in plain JavaScript. A talk about the principles of Redux. There is a blog post which covers the same topic: [https://medium.com/@ramonvictor/tic-tac-toe-js-redux-pattern-in-plain-javascript-fffe37f7c47a#.2jrpb9qnr](Tic-Tac-Toe.js: redux pattern in plain javascript).

Keith: Tech Addiction in Aeroplane Mode: A coping strategy. tl;dr: Have fun with yourself and unconscious passengers!

[Michael Hans](https://www.twitter.com/michaelhans_pl), [Kamil Zasada](https://www.twitter.com/ZasadaKamil): API First. Customer says "We need something. Dont know what. Can you show something this week?" [RESTful API TODO](http://www.raml.com). API contracts are created before any actual code is written. This way, QA can start running tests against it while DEV is programming. Also, FE can programm a SPA against dummy/mockup endpoints.

[Rachel Nabors](https://www.twitter.com/RachelNabors): Creatures of the Deep, featuring great illustrations from the [DevToolsChallenger.com](http://devtoolschallenger.com/) !



## Computer Assisted Arts and Crafts by [Mariko Kosaka](https://twitter.com/kosamari)

After hacking her knitting mashine, Mariko Kosaka started experimenting with electric circuits. On stage, she showed cool demos with metallic tape on paper, pen lead as resistor, yarn as dimmer switch, ... and blowing bulbs :-)

* [Boilerplate to create Node.js IoT system with Arduino and Socket.io](https://github.com/kosamari/IoT-Boilerplate)



## Taking over the web platform with Angular 2 by [Todd Motto](https://twitter.com/toddmotto)

A walk through Angular 2 architecture, (web) components, dataflow.


## Panel Discussion: The State of Front-End Tooling

_It is hard to cover a discussion, so I just post a few questions to think about._

* Today, is it harder to get into FE Development than ten years ago?
* What features do you think are still missing on the web platform?
* In our industry: How much is healthy competition, how much is fighting/arguing?
* How important is it for companies to build own tools? Or to use available solutions?
* What do you think about the responsibilities of big companies using Open Source software, and the authors which suddenly have a huge company depending on them?

_...and a few thoughts from the panel:_

* Even for small things, we need a packet manager and a build process. You can still open and save a text file, reload the browser, and see results. But what you find on the web is more intimidating than in the past.
* Today, (some!) people learn Angular but downt know what the script-Tag does ona a page.
* You constantly have to fight holy wars over which tools to use.
* Rewriting just for the sake is a good thing on your own projects/money. But on clients cost there should be a business value which justifies refactoring.


----
Next read: [Front Trends 2016 in Warsaw: Day 3](/front-trends-2016-warsaw-day-three)
