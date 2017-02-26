---
title: How to make your shiny new brutalist website brutally fast
date: 2017-02-09
datelabel: February 9th, 2017
language: en
tags: [web development]
permalink: fast-brutalist-websites
draft: false
description: Intentionally ugly websites are one of the trends in 2017. What I like most about this: ugly is fast!
---

<link href="/images/2017/02/brutalist/styles.css" type="text/css" rel="stylesheet" />

Websites which are intentionally ugly are one of the hottest trends in webdesign in early 2017, according to the [Washington Post](https://www.washingtonpost.com/news/the-intersect/wp/2016/05/09/the-hottest-trend-in-web-design-is-intentionally-ugly-unusable-sites/), [webdesignerdepot](http://www.webdesignerdepot.com/2016/08/the-rise-and-rise-of-the-brutalist-design-trend/) or the [t3n magazine](http://t3n.de/news/web-brutalism-design-trend-705490/).

After [years](https://www.templatemonster.com/infographics/web-design-trends-years-2004-2014.php) of flash, wood patterns, skeuomorphism, webfonts, grunge handwriting, full screen images, ambient background videos, parallax bullshit and interactive <strike>crap</strike>cards, this is a trend that I actually like. **Because: ugly is fast!**

Well, it can be fast. Scanning a [collection of brutalist websites](http://brutalistwebsites.com/), I have seen everything from pages with 10 kilobytes to dozens of megabytes. In this article I want to explore and explain some tricks for building ugly websites simply and fast.


# 1. Backgrounds

Use small background images and either tile them, or show them in full size - even if the image is actually much smaller than the screen.

<div class="bgkermitphoto larger"></div>
<div class="bgkermiticon larger"></div>

I really like CSS backgrounds which repeat a pattern or symbol. There is a beautiful collection of [CSS3 patterns by Lea Verou](http://lea.verou.me/css3patterns/). You can even have [moving color tiles](http://codepen.io/mistic100/pen/GFHkm). My absoute favourite are the [fruits by Angela Valasquez](https://codepen.io/collection/XORbRd/).

<div class="bgcssananas full"></div>

At this point I want to point out that I do not want to describe the sources or the techniques as "ugly". But they can help you to create effects that might be used in so-called brutalist webdesign. That being said, let me continue with [CSS gradients](http://angrytools.com/gradient/):

<div class="bgcssgradient larger"></div>

# 2. Fonts

You can go absolutely crazy with [CSS text effects](https://css3gen.com/css3-text-effects/). Just google it. Without even touching the font size or font face (aka webfont), you can make a lot of impact. The best: you do not need to load a huge web font file (maybe even from the Google servers), but can use these effects with any system font. Which viewer cares about rounded serifs and handcrafted ligatures, if you put these in their face?

<span class="textshadow">Text-Shadow and <u>underline</u></span>,
<span class="textneon">Crazy Neon</span> or <span class="textfire">fire effects</span>.

Take care that you do not get <span class="textdeepshadow">too classy</span> by accident.

You might want to use text which fills the screen. Which fills **any** screen, from smartphone to cinema display. There's a unit for that:

<div class="full"><span class="texthuge"><a href="https://css-tricks.com/viewport-sized-typography/">Viewport sized typography</a></span></div>

More properties that you can play with: line-heights, alignment (center, right), [vertical text](https://davidwalsh.name/demo/css-vertical-text.php), [3D glasses effect](http://line25.com/tutorials/how-to-create-a-cool-anaglyphic-text-effect-with-css), [star wars scrolling](http://codepen.io/squarecat/pen/KuHsl) and <span class="texthover" data-letters="hover animations">hover animations</span> ([1](https://tympanus.net/codrops/2015/05/13/inspiration-for-text-styles-and-hover-effects/), [2](http://codepen.io/boldfacedesign/pen/EoGgD), [3](http://codepen.io/lbebber/pen/BzoHi))!


# 3. Images

Holy shit, there is a [huge amount](https://css-tricks.com/almanac/properties/f/filter/) of [CSS filters](https://blog.kulturbanause.de/2015/03/css-filter-effekte/) that you can apply on images in modern browsers. Plus: everything Photoshop.

But we want a tiny fast brutal website, don't we? So we only use small images. Which can either be scaled, repeated (with varying effects) or heavily compressed.

<div class="larger">
<table>
<tr>
<td><a href="http://bennettfeely.com/filters/">appy CSS filters</a><br>
(credits: <a href="https://twitter.com/bennettfeely">@bennettfeely</a>)</td>
<td><img src="/images/2017/02/brutalist/img_trump_jpeg75.jpg" alt="Photo of Donald Trump with a graphic filter"
	style="-webkit-filter:sepia(1) hue-rotate(200deg);filter:sepia(1) hue-rotate(200deg);"/>
	<br>sepia(1) hue-rotate(200deg)
</td>
<td><img src="/images/2017/02/brutalist/img_trump_jpeg75.jpg" alt="Photo of Donald Trump with a graphic filter"
	style="-webkit-filter:sepia(1);filter:sepia(1);"/>
	<br>sepia(1)
</td>
<td><img src="/images/2017/02/brutalist/img_trump_jpeg75.jpg" alt="Photo of Donald Trump with a graphic filter"
	style="-webkit-filter:saturate(4);filter: saturate(4);"/>
	<br>saturate(4)
</td>
</tr>
<tr>
<td><img src="/images/2017/02/brutalist/img_trump_jpeg75.jpg" alt="Photo of Donald Trump with a graphic filter"
	style="-webkit-filter:hue-rotate(90deg);filter:hue-rotate(90deg);"/>
	<br>hue-rotate(90deg)
</td>
<td><img src="/images/2017/02/brutalist/img_trump_jpeg75.jpg" alt="Photo of Donald Trump with a graphic filter"
	style="-webkit-filter:invert(.8);filter:invert(.8);"/>
	<br>invert(.8)
</td>
<td><img src="/images/2017/02/brutalist/img_trump_jpeg75.jpg" alt="Photo of Donald Trump with a graphic filter"
	style="-webkit-filter:contrast(3);filter:contrast(3);"/>
	<br>contrast(3)
</td>
<td><img src="/images/2017/02/brutalist/img_trump_jpeg75.jpg" alt="Photo of Donald Trump with a graphic filter"
	style="-webkit-filter:blur(7px);filter: blur(7px);"/>
	<br>blur(7px)
</td>
</tr>
</table>
</div>

<div class="larger">
	<table><tr>
		<td><a href="http://www.jpegreducer.com">compress heavily</a></td>
		<td>
			<img src="/images/2017/02/brutalist/img_trump_jpeg50.jpg" alt="Photo of Donald Trump" /><br>
			jpg 50%: 13kB
		</td>
		<td>
			<img src="/images/2017/02/brutalist/img_trump_jpeg25.jpg" alt="Photo of Donald Trump, heavily compressed" /><br>
			jpg 25%: 9kB
		</td>
		<td>
			<img src="/images/2017/02/brutalist/img_trump_jpeg10.jpg" alt="Photo of Donald Trump, heavily compressed" /><br>
			jpg 10%: 6kB
		</td>
	</tr></table>
</div>

<div class="larger">
	<table><tr>
		<td><a href="http://optimizilla.com">reduce colors</a></td>
		<td>
			<img src="/images/2017/02/brutalist/img_trump_8colors.png" alt="8-color-photo of Donald Trump" /><br>
			8 colors png: 44kB
		</td>
		<td>
			<img src="/images/2017/02/brutalist/img_trump_2colors.png" alt="2-color-photo of Donald Trump" /><br>
			2 colors png: 15kB
		</td>
	</tr></table>
</div>


# 4. ASCII Art

<pre>
 _______________________________________
< Are you old enough to know ASCII art? >
 ---------------------------------------
        \   ^__^
         \  (oo)\_______
            (__)\       )\/\
                ||----w |
                ||     ||</pre>


# 5. Unicode Writing

I can write &#x24d8;&#x24dd; &#x24d1;&#x24e4;&#x24d1;&#x24d1;&#x24db;&#x24d4;&#x24e2; or &#x73;&#x20e3;&#xa0;&#xa0;&#xa0;&#x71;&#x20e3;&#xa0;&#xa0;&#xa0;&#x75;&#x20e3;&#xa0;&#xa0;&#xa0;&#x61;&#x20e3;&#xa0;&#xa0;&#xa0;&#x72;&#x20e3;&#xa0;&#xa0;&#xa0;&#x65;&#x20e3;&#xa0;&#xa0;&#xa0;&#x73;&#x20e3; and even &#x105; &#x282;&#x567;&#x57e;&#x4c0;&#x4bd; &#xe7;&#x105;&#x4c0;&#x4c0;&#x4bd;&#x56a; &#x48d;&#x4bd;&#x572;&#x567; just using [unicode characters](http://lunicode.com/).

There are many more on the ➥ [unicode table](https://unicode-table.com/en/) <span style="font-size:200%">😎</span>.


# 6. Oldschool HTML without styles

This was more fun when `<hr>` had a dropshadow and tables had borders and table-padding and stuff. But some HTML elements look quite brutal when unstyled. `fieldset` elements are handy for creating boxes:

<div><form><fieldset>
	<legend>form fieldset legend</legend>
	<textarea cols="3" rows="8">unstyled    textarea</textarea>
	<hr>
	<button disabled style="width:100%">disabled button</button>
	<hr>
	With HTML5 we even have new fany stuff like the progress element:
	<progress>progress</progress>
</fieldset></form></div>


# 7. Share this page! &#10084;

Never never ever use Twitter and Facebook widgets! They are the worst! They force your users to connect to twitter/facebook servers and load tons of crap, even when they do not click.

Instead, use simple links which you can style on your own behalf. It is really fast, it is safe, and it works. Just try it out:

<a href="https://twitter.com/share?url=https%3A%2F%2Fblog.thomaspuppe.de/fast-brutalist-websites&hashtags=brutalist%2Cwebdesign&text=How%20to%20make%20your%20shiny%20new%20brutalist%20website%20brutally%20fast">
<p style="font-family:monospace;white-space:pre;">
┊┊┊┊┊┊┊┊┊┊┊┊╭━━━━━╮
┊┊┊┊╱▔▔╲┊┊╭━╯TWEET╰━╮
┊┊┊▕┈┈▋▋▏╭┫THIS HOLY┃
┊▂▂╱┈┈┈▕╲╯╰╮  SHIT! ┃
┊▏▕▂▂╱┈▕▔┊┊╰━━━━━━━━╯
┊╲▂▂▂▂▂╱┊┊┊┊┊┊┊┊┊┊┊┊┊┊┊┊┊┊┊┊┊┊
━━━━┃━┃━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
</p></a>


<a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fblog.thomaspuppe.de%2Ffast-brutalist-websites" class="facebookbutton"><span style="font-size:150%">&#9996;</span> Share on facebook</a>


<br><br><br><br><br><br>
**Credits:** [Kermit photo](https://pixabay.com/de/kermit-frosch-schneeball-werfen-601711/), [Kermit icon](https://dribbble.com/shots/1787673-Kermit), [Twitter Button](http://xahlee.info/comp/unicode_ascii_art.html), [Facebook Button](http://www.mburnette.com/blog/create-simple-faux-3d-css-button).
