---
title: Templating mit JS Template Literals
date: 2019-07-02
datelabel: 02. Juli 2019
language: de
tags: [Notizen]
permalink: templating-mit-template-literals
draft: true
description: "..."
---



Vorher: replace

        const tagsString = fileContentFrontmatter[key].join(', #')
        targetContent = targetContent.replace(re, tagsString)
        teaserContent = teaserContent.replace(re, tagsString)


Jetzt: eingefasste Templates, magische Funktion, uns Ausführung.




<article class="teaser">
`<article class="teaser">
    <div class="teaser__meta">
        <span class="teaser__category">#{{ META_TAGS }}</span>
        <time datetime="{{ META_DATE }}">{{ META_DATELABEL }}</time>
        <span class="teaser__category">#${ meta.tags.join(', #') }</span>
        <time datetime="${ meta.datedata }">${ meta.datelabel }</time>
    </div>
    <h2 class="teaser__title">
        <a href="{{ BLOGMETA_BASEURL }}{{ META_PERMALINK }}" rel="bookmark canonical">{{ META_TITLE }}</a>
        <a href="${ blogmeta.baseurl }${ meta.permalink }" rel="bookmark canonical">${ meta.title }</a>
    </h2>
    <p class="teaser__text">{{ META_DESCRIPTION }}</p>
</article>
    <p class="teaser__text">${ meta.description }</p>
</article>`




Beispiele:

<html lang="${ meta.language || 'de' }">

<span class="post__category">#${ meta.tags.join(', #') }</span>

- Platzhalter, die keine Werte haben, werfen Fehler.






Unterschied im JS Code:
