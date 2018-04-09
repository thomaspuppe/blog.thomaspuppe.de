---
title: "Front Trends 2016 in Warsaw: Day 1"
date: 2016-05-18
datelabel: 18. Mai 2016
language: en
tags: [Webentwicklung]
permalink: front-trends-2016-warsaw-day-one
draft: false
description: Summarizing the first day presentations of the Front Trends 2016 conference in Warsaw. Covering pranks, animations, static sites, RxJS, performance, and leadership.
---

Summarizing the first day presentations of the Front Trends 2016 conference in Warsaw. Covering pranks, animations, static sites, RxJS, performance, and leadership. A speakers list can also be found on [2016.front-trends.com/speakers/](https://2016.front-trends.com/speakers/).

<figure>
	<img src="/images/2016/05/front-trends-venue.jpg" alt="The venue: Warsaws Star Club" />
	<figcaption>The venue: Warsaws Star Club</figcaption>
</figure>

## Opening by [Tim Holman](https://twitter.com/twholman)

* Fun with [CSS pranks](http://slides.com/tholman/css-pranks/#/)


## Keynote: The Web in Motion by [Rachel Nabors](https://twitter.com/RachelNabors)

Rachel talked about Apps vs Websites, and how Apps often provide the same content, but look much nicer because transitions between states are animated. If there is only _old state -> new state_, the users brain needs to do heavy interpolation work. If the transition is animated, there is less cognitive workload on the user. So the goal is to eliminate sudden visual changes. Rachel takes two excurses to dark patterns/ads and technical history of animations (Flash, SMIL. CSS Animations) and closes with the Web Animation API.

> The difference between web and native starts to blur. The Web is moving forward.

Lovely presentation slides with selfmade comic drawings!

* Twitter: [@RachelNabors](https://twitter.com/RachelNabors)
* [Rachel Nabors Website](http://rachelnabors.com)
* Slides of this talk: [The Web in Motion: animation's impact on UI and web design](http://slideshare.net/CrowChick/the-web-in-motion-animations-impact-on-ui-and-web-design).
* [Web Animations API resources](http://rachelnabors.com/waapi)
* Chrome status: Statistics of the [occurrences of certain CSS features in the wild](http://www.chromestatus.com/metrics/css/popularity)
* [Web Animation Weekly](http://webanimationweekly.com/) newsletter



## Static Sites go all Hollywood [Phil Hawksworth](https://twitter.com/philhawksworth)

Phil Hawksworth speaks about the advantages of Static Site Generators and the situations where they are a good choice. Embedded in Praise of simplicity and "Short Stack development". Key argument: SSG moves complexity and potential failures away from the user, because if things go wrong, it is in the building step and not while actually serving a user's request.

> Simplifying is not dumbing down. It is focussing on what matters.

* Twitter: [@philhawksworth](https://twitter.com/philhawksworth)
* [Netlify](http://www.netlify.com): Service for building and hosting of static sites, [Surge.sh](http://surge.sh): Deployment and hosting of static sites



## Working with the web and the future by [Sally Jenkinson](https://twitter.com/sjenkinson)

Sally Jenkinson had a rather abstract talk about how our decisions of today affect the future. In positive ways (visionary user interfaces) and negative ways (technical debt). I learned about the "[White Elephant](https://en.wikipedia.org/wiki/White_elephant)" analogy.

> The future is a spectrum, not a single point in time. Think of the next sprint, the next month, the next year, the next ten years – at the same time.

* Twitter: [@sjenkinson](https://twitter.com/sjenkinson)
* Website: [recordssoundthesame.com](http://www.recordssoundthesame.com)
* Book recommendation: [Make it so: Interaction Design Lessons from Science Fiction](http://rosenfeldmedia.com/books/make-it-so/)
* [Lessons from Sci-Fi Interfaces](http://www.scifiinterfaces.com)



## Lightning Talks
* "Layout: Think Flex"
* "50 Shades of #0089ff" by Gabriel Agu
* "Language" by [Gunnar Bittersman](https://twitter.com/g16n)



## RxJS – Destroy the state machine by Stenver Jerkku

A technical talk with lots of code samples. In short: RxJS is like "Promises on steroids", providing more possibilities and code which is easier to read. It also has brilliant testing tools and is available in various languages (Scala, Ruby, Java, ...).

* [The reactive manifesto](http://www.reactivemanifesto.org)



## Untangle your code with yield by [Staś Małolepszy](https://twitter.com/stas)

Very technical talk, completely in code. This was fascinating, in the sense of Clarke's law. I will need to check and work-through the presentation. Buzzwords: ES5, function generators, yield, iterators.

Staś did some live coding (live-uncommenting, actually) with split-screen of code and results. Not sure if this setting is also part of the demo repo.

* Twitter: [@stas](https://twitter.com/stas)
* Code demo: [Untangle your code with yield](http://www.github.com/stasm/preso)



## Once more with feeling by [Tim Kadlec](https://twitter.com/tkadlec)

Tim Kadlec held yet another performance talk, making fun of the fact that this topic has been talked about a lot in the last years. ("There's a secret club of people who need to say 'The fastest Request is no Request' two times each year.")

Measurable performance improvement (DNS-prefetch, preconnect, preload, prerender, async, defer, inline critical CSS) is important. If there is nothing left to speed up, you can increase the perceived speed (skeleton rendering, changing status text on progress bars). And sometimes you need to add an artificial delay, because people do not trust a credit card validation which runs too fast.

> Everything on your page should have a _value_, because everything has a _cost_.

* Twitter: [@tkadlec](https://twitter.com/tkadlec)
* Presentation Slides: [Once more with feeling](https://speakerdeck.com/tkadlec/once-more-with-feeling)



## Leadership in an Ever-Changing Industry by [Meri Williams](https://twitter.com/Geek_Manager)

Meri Williams cursed more than other speakers while explaining what makes a good geek manager. in short: giving/explaining/allowing people  PURPOSE, AUTONOMY, MASTERY and INCLUSION. And keep developing your own mastery in TECH, TEAM and TOOLS. People need to say "yes" to these questions: "Am I expected? Am I respected? Can I be myself and be successfull here?"

> Be a bulldozer and a cheerleader. Get shit out of their way and tell them they're awesome.

* Twitter: [@Geek_Manager](https://twitter.com/Geek_Manager)
* [Meris Blog](http://blog.geekmanager.co.uk/)
* Book Recommendation: [Drive](http://www.danpink.com/books/drive/) by Daniel H. Pink
* Book Recommendation: [First, Break All the Rules](http://www.gallup.com/press/176069/first-break-rules-world-greatest-managers-differently.aspx)


----
Next read: [Front Trends 2016 in Warsaw: Day 2](/front-trends-2016-warsaw-day-two)
