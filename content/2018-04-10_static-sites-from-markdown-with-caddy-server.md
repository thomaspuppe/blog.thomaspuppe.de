---
title: Generate static sites from markdown files with the Caddy server
date: 2018-04-10
datelabel: 10. April 2018
language: de
tags: [web development]
permalink: static-sites-from-markdown-with-caddy-server
draft: false
description: Caddy can not only serve files fast and safely. It can also generate static files from markdown, so you dont need a generator.
---

https://caddyserver.com/docs/caddyfile
https://caddyserver.com/tutorial/caddyfile

	caddy -conf ../path/to/Caddyfile


	localhost:8080
	gzip
	log ../access.log
	markdown /blog {
	    css /blog.css
	    js  /scripts.js
	}

https://caddyserver.com/docs/markdown

markdown /blog {
	ext .md .txt
	css /css/blog.css
	js  /js/blog.js
}

markdown /blog {
	template default.html
	template blog  blog.html
	template about about.html
}

<!DOCTYPE html>
<html>
	<head>
		<title>{{.Doc.title}}</title>
	</head>
	<body>
		Welcome to {{.Doc.sitename}}!
		<br><br>
		{{.Doc.body}}
	</body>
</html>

YAML is surrounded by ---:

---
template: blog
title: Blog Homepage
sitename: A Caddy site
---
JSON is simply { and }:

{
	"template": "blog",
	"title": "Blog Homepage",
	"sitename": "A Caddy site"
}


https://github.com/caddyserver/examples/tree/master/markdown

caddyfile
	localhost:8080

	markdown / {
	    template blog templates/blog.html
	    template index templates/index.html
	}

test.md
	---
	template: blog
	title: Hello World
	sitename: A Caddy site
	---
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam lectus. Sed sit amet ipsum mauris. Maecenas congue ligula ac quam viverra nec consectetur ante hendrerit. Donec et mollis dolor. Praesent et diam eget libero egestas mattis sit amet vitae augue.

index.html
	<!DOCTYPE html>
	<html>
	    <head>
	        <meta charset="utf-8" />
	        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	        <title>{{.Doc.title}}</title>

	        <link rel="stylesheet" type="text/css" href="styles/main.css" />
	    </head>
	    <body>
	        <header>
	            <a href="/"><h1 class="page-title">{{.Doc.sitename}}</h1></a>
	        </header>

	        <main>
	            {{range .Files}}
	                {{if ne .Name "index.md" }}
	                    <article>
	                        <h3><a href="{{.Name}}">{{.Name}}</a></h3>
	                            {{if not .IsDir }}
	                                {{.Summarize 15}}
	                            {{end}}
	                    </article>
	                {{end}}
	            {{end}}
	        </main>
	    </body>
	</html>



Extra: Github Raw Files benutzen!
