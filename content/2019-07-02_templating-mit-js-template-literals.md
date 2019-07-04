---
title: Templating mit JS Template Literals
date: 2019-07-02
datelabel: 02. Juli 2019
language: de
tags: [Webentwicklung]
permalink: templating-mit-js-template-literals
draft: false
description: Wie natives JS Templating mein Suchen-und-Ersetzen im Blog-Generator ablöste
---

Für meinen kleinen [Static-Site Generator easto](https://github.com/thomaspuppe/easto) benutze ich keine Templating-Engine, sondern mache nur Suchen-und-Ersetzen in den Templates. Das sah so aus:

## Gut genug: String-Replacement

<pre>&lt;div class="post__meta"&gt
	&lt;span class="post__category"&gt#{{ META_TAGS }}&lt;/span&gt
	&lt;time datetime="{{ META_DATE }}"&gt{{ META_DATELABEL }}&lt;/time&gt
&lt;/div&gt
&lt;h1 class="post__title"&gt{{ META_TITLE }}&lt;/h1&gt
{{ CONTENT }}
</pre>

Im JavaScript habe ich dann über eien Liste von Metadaten iteriert und diese im Template ersetzt:

<pre>
template.replace('{{ CONTENT }}', fileContentHtml)

for (var key in metatata) {
	const re = new RegExp('{{ META_' + key.toUpperCase() + ' }}', 'g')

	if ( key === 'tags') {
		const tagsString = metatata[key].join(', #')
		template = template.replace(re, tagsString)
	} else {
		template = template.replace(re, metatata[key])
	}
}</pre>

... im Prinzip. In echt dann alles noch etwas umständlicher. Die Regex Nummer ist nötig, weil nur das erste Vorkommen ersetzt wird, wenn man einen String als Parameter verwendet. In Teasern benutze ich etwas andree Ausgaben als im Post oder den Feeds. Usw.

## Besser: Template Literals

Bei einem [anderen Projekt](https://github.com/thomaspuppe/news-benchmark) kam ich letztens auf die Idee, dass man in modernem JavaScript [Template Literals](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Template_literals) zur Verfügung hat. Wenn Strings in Back Ticks (&#715;) gefasst sind, werden enthaltene Ausdrücke ausgeführt.

<pre>var kitty = "Cheddar";
console.log(`Meine Katze heißt ${kitty}`);
=> Meine Katze heißt Cheddar.
</pre>

Meine Template-Dateien sehen nun [etwas anders](https://github.com/thomaspuppe/blog.thomaspuppe.de/commit/2223b3c22d4b1cba6c4d87151137a2f886c47f6c) aus. Erstens werden sie komplett mit Back Ticks umschlossen. Und zweitens verwende ich Ausdrücke mit Dollarzeichen und geschweiften Klammern anstelle der selbst ausgedachten Marker fürs Suchen-und-Ersetzen.

<pre>&lt;div class="post__meta"&gt;
	&lt;span class="post__category"&gt;#${ meta.tags.join(', #') }&lt;/span&gt;
	&lt;time datetime="{{ META_DATE }}"&gt;${ meta.datelabel }&lt;/time&gt;
&lt;/div&gt;
&lt;h1 class="post__title"&gt;${ meta.title }&lt;/h1&gt;
${ content }
</pre>

Im JavaScript stecke ich ein Objekt zusammen das alles enthält, was das Template braucht.

<pre>const output = eval_template(template, {
	'blogmeta': CONFIG,
	'meta': metatata,
	'content': fileContentHtml
})
</pre>

Damit das mit mehreren Variablen und Objekten funktioniert, habe ich im Netz eine magische Funktion gefunden (deren Quelle ich leider nicht mehr weiß).

<pre>const eval_template = (s, params) => {
	return Function(...Object.keys(params), "return " + s)
	(...Object.values(params))
}</pre>


## Voilá

Diese Änderung hat mehrere Vorteile.

* verschlankt den [Code](https://github.com/thomaspuppe/easto/commit/491949d33e41bdc4b781083066607e9bfaaa5932)
* kleine Operatioenn wie `join`, `toUpper` oder `if` kann ich im Template machen.
* Fallbacks `<html lang="${ meta.language || 'de' }">`
* Platzhalter im Template, die keine Werte haben, werfen jetzt Fehler (vorher wurden sie einfach nicht ersetzt).
* Template-Code-Beispiele aus dem Inhalt wurden vorher behandelt wie Templates selbst – und auch ersetzt. Das passiert jetzt [nicht mehr](https://github.com/thomaspuppe/blog.thomaspuppe.de/commit/9058e03eeaa00b16aa17826cdda3e57bd51674b1).

Außerdem sieht das professioneller und sexier aus.


## Geht da noch mehr?

Auf jeden Fall. Insbesondere [Nesting Tempaltes](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Template_literals#Nesting_templates) und [Tagged Templates](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Template_literals#Tagged_templates) sehen vielversprechend aus, um z.B. verschiedene Block-Typen zu rendern. (Im Content steht ein Objekt wie `quote = {text:"Niemand hat das Recht zu gehorchen", name:"Hannah Arendt"}`), und das Blog rendert eine schöne Blockquote.
