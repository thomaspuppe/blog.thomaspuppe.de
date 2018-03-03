---
title: Smashing Conf 2018 in London: #perfmatters
date: 2018-02-08
datelabel: 08. February 2018
language: en
tags: [Webentwicklung]
permalink: smashingconf-london-2018
draft: true
description: Summarizing the first day presentations of the Front Trends 2016 conference in Warsaw. Covering pranks, animations, static sites, RxJS, performance, and leadership.
---

Summarizing the first day presentations of the Front Trends 2016 conference in Warsaw. Covering pranks, animations, static sites, RxJS, performance, and leadership. A speakers list can also be found on [2016.front-trends.com/speakers/](https://2016.front-trends.com/speakers/).

<figure>
	<picture>
		<img
			sizes="(max-width: 1200px) 100vw, 1200px"
			srcset="
			/images/2018/02/smashingconf-london/cover_w_400.jpg 400w,
			/images/2018/02/smashingconf-london/cover_w_850.jpg 850w,
			/images/2018/02/smashingconf-london/cover_w_1170.jpg 1170w,
			/images/2018/02/smashingconf-london/cover_w_1458.jpg 1458w"
			src="/images/2018/02/smashingconf-london/cover_w_1458.jpg"
			alt="TODO">
	</picture>
	<figcaption>TODO Smashing Conf</figcaption>
</figure>


## See yourself: the conference papers and videos



## Performance Culture

[Phil Hawksworth](https://twitter.com/TODO) spoke about deployments at/via netlify (where he works). Each version (tag) of your software results in a build which is (and stays) available as a stable resource. That way you can easily allocate traffic to different versions (gradual release of a new thing, fast rollback) and have a history available to check out your site in earlier states. Further advice: Move unknowns to the start of your projects, so you can tacke them early. And: use services. The complexity of modern web development is still there, but you don't have to own everything.

> Human interventions in deployments are undesirable
> – Phil Hawksworth


## Measuring Performance

[Andy Davies](https://twitter.com/TODO) had a brilliant talk on 3rd party scripts, how they harm your site, and how to analyze what they do.

Webpagetest allows blocking 3rd party scripts (by domain blacklists). That way you can directly compare the load behaviour of your site with(out) certain 3rd party tools.

Andy demonstrated how to use the Chrome developer tools to detect which scripts use network and memory. That way you can find things that the usual testing tools dont show (eg heavy CPU load on unload event, when some tracking scripts start to calculate and send data home).

Some specific tricks on Optimizely: You can tune it, for example remove its jQuery _(I was shocked that it comes with jQuery at all)_ if you provide your own version in the global namespace. You can read the number of examples from outside via JS - that way you can track what Optimizely does on each page, and relate that to load times or bounce rates.

And in the end, Andy spoke about general failures on A/B tests. Some use redirects for variant B, which totally destroys comparability. Or business people use uncompressed images on the B variant, which of course performs worse than the optimized A variant which is already in production.

Which brought him to the conclusion, that maybe sometimes the benefits of A/B testing or other 3rd party tools are destroyed by the bad performance.

TODO: meinen Tweet einfügen

> 3rd parties cost us money
> – Andy Davies

TODO: Zitat von Tim Kadlec

## Improving Performance


[Una TODO](https://twitter.com/TODO) and [Martin TODO](https://twitter.com/TODO) blew my mind with image optimization wizardry. After briefly covering the basics (formats, responsive images, compression) they went beyond the regular stuff. My favorite techniques:

- blur unimportant parts of a photo (eg the sky behind a portrait)
- show small (scaled-up + blurry via CSS) image placeholders while the big image loads
- black/white images combined with CSS blend modes/filters give great dual tone or gradient effects, and are much smaller than a colored image
- contrast swap: decrease contrast on the image file (so it is smaller on transfer) and increase contrast via CSS filter.

You cannot apply everything automatically on your whole site. But might be worth the effort for your home page or landing page artwork which does not change often.

--

[Zach TODO](https://twitter.com/TODO) had a talk about font loading. Most things I knew (FOIT, FOUT, font-display).

Next thing was font-synthesis what was quite cool. TODO

Two more optimizations: If you know the set of characters that will be used, you can create subsets of webfonts, so the font file gets smaller. You might strip all non-latin characters (plus special characters or maybe umlauts) from the font. Or, if you use it only for a specific text (your page header) you could create a subset of only these characters. Which could be included base64 encoded as data-uri inside your page or CSS file. (Assuming you have only one format, which should be the case IMHO).



## Things to review and resarch


## My personal todo list

- Use responsive images on this blog ... done on this article :-).
- Use modern compression.
- Finally try netlify. Just because it is hot this year.
- Try image previews (blurry technique or svg preview).
- Check out (JS Manners)[http://jsmanners.com/]

----

## Promoting Performance trhough [Tim Holman](https://twitter.com/twholman)

* Fun with [CSS pranks](http://slides.com/tholman/css
