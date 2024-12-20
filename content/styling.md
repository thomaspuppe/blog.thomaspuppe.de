---
title: Blog Styling
date: 2016-06-19
datelabel: 19. Juni 2016
tags: [Webentwicklung]
permalink: styling
draft: true
description: Styleguide für diesen Blog, der alle Arten von Inhalten enthält
---

Link-Unterstreichung bei großen Schriftarten wirkt schnell klobig. Mit ein paar Zeilen CSS lässt sich die Seite optisch aufwerten und die Lesbarkeit erhöhen.

Als Freund <a href="http://ia.net/blog/100e2r">&ldquo;großer&rdquo; Schrift</a> auf Websites stelle ich fest, dass die Unterstreichung von Links ab 20 Pixeln Schriftgröße (bei meinem Setup von font-family: Georgia, "Times New Roman", Times, serif;) recht breit ist. Das stört auch die Lesbarkeit des Textes &mdash; zumindest im Vergleich zu einer Variante mit schmalerer Unterstreichung. Hier im Blog kommt das nicht zum Tragen. Groß sind nur die Überschriften, die eine dicke Unterstreichung vertragen. Der Fließtext ist kleiner als 20px und hat daher moderate Unterstreichung. Auf meiner Website mit vielen Links störte die Unterstreichung schon mehr (siehe Screenshot):


<h1>HTML Ipsum Presents</h1>

<p><strong>Pellentesque habitant morbi tristique</strong> senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. <em>Aenean ultricies mi vitae est.</em> Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, <code>commodo vitae</code>, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. <a href="#">Donec non enim</a> in turpis pulvinar facilisis. Ut felis.</p>

<h2>Header Level 2</h2>

<ol>
	 <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
	 <li>Aliquam tincidunt mauris eu risus.</li>
</ol>

<h2>Highlighted Paragraph</h2>

<p>Pellentesque habitant morbi tristique</strong> senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper.</p>

<em>This is a quote -- but by me.</em> Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui.</p>

<h3>Header Level 3: Blockquotes</h3>

<blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.</p></blockquote>

<blockquote>
<p>Everything on your page should have a _value_, because everything has a _cost_.</p>
<cite><a href="https://twitter.com/tkadlec" title="Tim Kadlec on Twitter">Tim Kadlec</a></cite>
</blockquote>

<h4>Header Level 4: Lists</h4>

<ul>
	 <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
	 <li>Aliquam tincidunt mauris eu risus.</li>
</ul>

<pre><code>#header h1 a {
	display: block;
	width: 300px;
	height: 80px;
}
</code></pre>

<ul>
	 <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
	 <li>Aliquam tincidunt mauris eu risus.</li>
	 <li>Vestibulum auctor dapibus neque.</li>
</ul>

<ul>
	 <li>Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.</li>
	 <li>Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</li>
	 <li>Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus. Nam nulla quam, gravida non, commodo a, sodales sit amet, nisi.</li>
	 <li>Pellentesque fermentum dolor. Aliquam quam lectus, facilisis auctor, ultrices ut, elementum vulputate, nunc.</li>
</ul>


<ol>
	 <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
	 <li>Aliquam tincidunt mauris eu risus.</li>
	 <li>Vestibulum auctor dapibus neque.</li>
</ol>


<dl>
	 <dt>Definition list</dt>
	 <dd>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
commodo consequat.</dd>
	 <dt>Lorem ipsum dolor sit amet</dt>
	 <dd>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
commodo consequat.</dd>
</dl>


<h2>überlanger Code (unten wegen dem Grid)</h2>

Kürzlich bin ich auf einen Artikel von <a href="https://medium.com/@mwichary">Marcin Wichary</a> gestoßen, der dieses Problem löst: <a href="https://medium.com/p/7c03a9274f9">&ldquo;Crafting link underlines on Medium&rdquo;</a>. In dem sehr lesenswerten Artikel wird auf pro und contra von Link-Unterstreichung im Allgemeinen und verschiedenen Techniken im Speziellen eingegangen. Am Ende schaut die Lösung so aus:

<pre>a, a:link, a:visited {
		color: #333;
		text-decoration: none;
		position: relative;
		text-shadow: -1px -1px 0 white, 1px -1px 0 white, -1px 1px 0 white, 1px 1px 0 white;
		background-image: linear-gradient(to top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0) 2px, #333333 2px, #333333 3px, rgba(0, 0, 0, 0) 3px);
}

@media (-webkit-min-device-pixel-ratio: 1.5), (min-resolution: 144dpi) {
		a {
				background-image: linear-gradient(to top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0) 2px, #333333 2px, #333333 2.5px, rgba(0, 0, 0, 0) 2.5px);
		}
}

a:hover, a:focus {
		background-image: linear-gradient(to top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0) 2px, #666 2px, #666 3px, rgba(0, 0, 0, 0) 3px);
}

@media (-webkit-min-device-pixel-ratio: 1.5), (min-resolution: 144dpi) {
		a:hover, a:focus {
				background-image: linear-gradient(to top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0) 2px, #666 2px, #666 2.5px, rgba(0, 0, 0, 0) 2.5px);
		}
}</pre>

**Trick 1:** Links bekommen ein Hintergrundbild, das keine Datei oder DataURI nutzt, sondern Gradients.

**Trick 2:** Ein Text-Shadow, unterbricht die Linie bei Buchstaben mit Unterlänge.


Achtgeben muss man auf Links, die nicht nur Text enthalten. Wird z.B. ein Bild verlinkt, erhält dieses auch eine solche Unterstreichung. Das muss dann mittels &ldquo;background-image:none;&rdquo; unterbunden werden &mdash; und zwar am Link statt am Bild. Bei großen Seiten kann es hier haarig werden und der Nutzen rechtfertigt den Aufwand vielleicht nicht mehr. Dasselbe gilt für Links im Button-Stil usw.


<h2>Bilder (unten wegen dem Grid)</h2>

<figure>
	<img src="/images/2016/05/warschau-panorama.jpg" alt="beautiful city of Warsaw" />
	<figcaption>beautiful Warsaw</figcaption>
</figure>

Achtgeben muss man auf Links, die nicht nur Text enthalten. Wird z.B. ein Bild verlinkt, erhält dieses auch eine solche Unterstreichung. Das muss dann mittels &ldquo;background-image:none;&rdquo; unterbunden werden &mdash; und zwar am Link statt am Bild. Bei großen Seiten kann es hier haarig werden und der Nutzen rechtfertigt den Aufwand vielleicht nicht mehr. Dasselbe gilt für Links im Button-Stil usw.

<figure>
	<img src="/images/2016/05/front-trends-venue.jpg" alt="The venue: Warsaws Star Club" />
	<figcaption>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.</figcaption>
</figure>
