---
title: Generate static sites from markdown files with the Caddy server
date: 2018-04-10
datelabel: 10. April 2018
language: en
tags: [webdevelopment]
permalink: static-sites-from-markdown-with-caddy-server
draft: false
description: Caddy can not only serve files fast and safely. It can also generate static files from markdown, so you dont need a generator.
---

Lately, I am experimenting with different forms of static-site generation. While investigating the server [Caddy](https://caddyserver.com) for _serving_ pages, I found that it can also _generate_ these pages from markdown.

> ⚠️ Update 2022: This article is from 2018 and refers to Caddy version 1. User [camkego on HN](https://news.ycombinator.com/item?id=30145237#30146034) provides links to the current documentation of Caddy V2 markdown usage:
> - [https://caddyserver.com/docs/caddyfile/directives/templates](https://caddyserver.com/docs/caddyfile/directives/templates)
> - [https://github.com/caddyserver/website/blob/master/src/docs/index.html](https://github.com/caddyserver/website/blob/master/src/docs/index.html)
> - [https://caddy.community/t/markdown-support-in-v2/6984](https://caddy.community/t/markdown-support-in-v2/6984)


## Render markdown as HTML

Basically it is enough to activate markdown in your [Caddyfile](https://caddyserver.com/docs/caddyfile):

<pre>localhost:8000
markdown /</pre>

Now start your server with `caddy -conf ../path/to/Caddyfile` and visit pages `http://localhost:8000/one.md`. You will see that pages written in markdown (which you have to create, of course) ...

<pre># one.md:
---
title: My First Post
---

What The Fuck. Cool!

## This is h2

Lorem Ipsum youknow.</pre>

... are rendered as HTML:

<pre># http://localhost:8000/one.md
&lt;!DOCTYPE html&gt;
&lt;html&gt;
	&lt;head&gt;
		&lt;title&gt;My First Post&lt;/title&gt;
		&lt;meta charset="utf-8"&gt;
	&lt;/head&gt;
	&lt;body&gt;
		&lt;p&gt;What The Fuck. Cool!&lt;/p&gt;
		&lt;h2&gt;This is h2&lt;/h2&gt;
		&lt;p&gt;Lorem Ipsum youknow.&lt;/p&gt;
	&lt;/body&gt;
&lt;/html&gt;</pre>

Ta dah! A website with title-tag and content.


## Add CSS and JS

For some cases like a programming journal this might be enough. But you might want at least some CSS with it. You can do this by simply adding the path to a CSS file into the markdown-block of your caddyfile:

<pre>localhost:8000
markdown / {
	css /styles.css
}</pre>

which results into the line

<pre>&lt;link rel="stylesheet" href="/styles.css"&gt;</pre>

in the head of your rendered HTML file. This also works for JavaScript (`js /script.js`), which is also inserted into the head of your HTML file.


## Templating

But you want to load JS asyncronously and deferred at the end of the body-tag, don't you? And you want to add some more HTML, like a custom header or something. You can do that – by creating a template file and using that in the caddyfile:

<pre>localhost:8000
markdown / {
	template ../template.html
}</pre>

Note: the template path is not relative to the caddyfile, but relative to the folder where you run your `caddy -conf path/to/Caddyfile` command.

Note 2: You need to restart the caddy server after changing the caddyfile.

And: we do not need to specify the CSS and JS here, because we can do it directly inside out HTML template file:

<pre>&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;title&gt;{{.Doc.title}}&lt;/title&gt;
        &lt;link rel="stylesheet" media="screen" href="/styles.css"&gt;
    &lt;/head&gt;
    &lt;body&gt;
        &lt;head&gt;
            &lt;h1&gt;{{.Doc.title}}&lt;/h1&gt;
        &lt;/head&gt;
        &lt;article&gt;
            {{.Doc.body}}
        &lt;/article&gt;
        &lt;script async defer src="/script.js"&gt;&lt;/script&gt;
    &lt;/body&gt;
&lt;/html&gt;</pre>

which renders this:

<pre>&lt;!DOCTYPE html&gt;
&lt;html&gt;
	&lt;head&gt;
		&lt;title&gt;My First Post&lt;/title&gt;
		&lt;link rel="stylesheet" media="screen" href="/styles.css"&gt;
	&lt;/head&gt;
	&lt;body&gt;
		&lt;head&gt;
			&lt;h1&gt;My First Post&lt;/h1&gt;
		&lt;/head&gt;
		&lt;article&gt;
			&lt;p&gt;What The Fuck. Cool!&lt;/p&gt;
			&lt;h2&gt;This is h2&lt;/h2&gt;
			&lt;p&gt;Lorem Ipsum youknow.&lt;/p&gt;
		&lt;/article&gt;
		&lt;script async defer src="/script.js"&gt;&lt;/script&gt;
	&lt;/body&gt;
&lt;/html&gt;</pre>


## Template variables

You can see that the variable `{{.Doc.title}}` holds the content of the line `title: My First Post` in your markdown file. That kind of declaration in markdown (an other) files is called "frontmatter" and can be written in YAML or JSON format.

Even better: it can hold different contents ...

<pre>---
title: My First Post
author: Thomas Puppe
author_url: https://www.thomaspuppe.de
date: April 10th 2018
---</pre>

... which then can be used inside your template file:

<pre>&lt;a href="{{.Doc.author_url}}"&gt;{{.Doc.author}}&lt;/a&gt; on {{.Doc.date}}&lt;/footer&gt;</pre>

Caddy even offers some own template variables like `{{.Cookie "cookiename"}}` or `{{.RandomString 100 10000}}`, sanitizing functions and control statements. A [complete list of template actions](https://caddyserver.com/docs/template-actions) can be found in the Caddy docs.

This is pretty cool and you can get very far with that.


## Clean URLs

But one more thing: The URL `http://localhost:8000/one.md` is neither pretty nor common. Something like `http://localhost:8000/my-first-post` would be nicer. The slug "my-first-post" is simply the name of your file, of course. But what about the extension? You can get rid of that by making use of Caddys [ext](https://caddyserver.com/docs/ext) directive:

<pre>localhost:8000

markdown / {
	ext .md .html
	template ../template.html
}</pre>

This means that caddy tries to match every request, which is not served by an existing file, is tested against files with these extensions. So if you request `http://localhost:8000/my-first-post`, Caddy tries to find a `my-first-post` file, and if that does not exist, it tries to find `my-first-port.md`, which we just have created. `.html` would be another fallback, and you can define as many as you like.

I also tried the other way around: I put markdown files without any extension into the folder, and wanted Caddy to render them as HTML, but that did not work.


## Special templates per file

You might want render diffent posts inside different templates. Maybe there are special posts which have a sidebar, or you create some landing pages with a lot of beautiful custom HTML and only some copy text from markdown. You can introduce diffent templates to Caddy be listing them in the caddyfile.

<pre>markdown / {
	template ../template.html
	template special ../special.html
}</pre>

In the frontmatter part of your your markdown file, you can specify the template just like this: `template: index`. Then, this page will use the special.html template for rendering. If no template is given in the markdown file, the default `template.html`, which is defined without a name in the Caddyfile, will be used.

If your templates share a common set of HTML tags, you should be able to use the import directive:

<pre>{{.Include "path/to/file.html"}}  // no arguments
{{.Include "path/to/file.html" "arg1" 2 "value 3"}}  // with arguments</pre>

(This is written in the [template action docs](https://caddyserver.com/docs/template-actions), but did not work for me. Maybe because of a strange combination of relative paths?)


## File listings

On index pages, it would be handy to hava an automatic listing of subpages: the home page of a blog, the members page of your sports club. Caddy can even do that:

<pre>&lt;ul&gt;
	{{.Files "sub/folder"}}
		&lt;li&gt;
			&lt;a href="{{$.StripExt .Name}}"&gt;{{$.StripExt .Name}}&lt;/a&gt;
		&lt;/li&gt;
	{{end}}
&lt;/ul&gt;</pre>

You "just" have to filter files like ".DS_Store", asset folders, the index file itself and so on. But, for your convenience, Caddy at least provides [control statements](https://caddyserver.com/docs/template-actions) like `{{if not .IsDir }}` and you can strip away extensions (`{{$.StripExt .Name}}`).

According to the docs, you can even list a subset of "tagged" files by, but I have not explored that.


## External data sources

It would be cool to store the markdown files externally (think GitHub), and have Caddy fetch them. I think this should be possible, because Caddy can be used as a proxy server.

I tried the proxy directive (`proxy /test https://raw.githubusercontent.com/thomaspuppe/blog.thomaspuppe.de/`), but got stuck with SSL handshake errors.


## Other shortcomings

While Caddy gets you pretty far with its templating and markdown rendering functions, there are a few things which keep me from using it for this blog.

- I have not figured out sorting of the file listing. Caddy does no alphabetic sorting, it looks rather random.
- I want to have more control over content rendering, and
- No feed generation.
- No pagination of listing pages.


## Wrap-up

Caddys built-in features for static-site generation do a good job for putting together a simple and fast static site. With templating, logical conditions and string manipulation you get pretty far with few lines of code. If you reach the limits of what Caddy can do, you won't have wasted much time. So it is worth a try.
