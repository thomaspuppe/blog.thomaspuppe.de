# -*- encoding: utf-8 -*-
# This is your configuration file.  Please write valid python!
# See http://posativ.org/acrylamid/conf.py.html

SITENAME = 'Blog von Thomas Puppe, Web Developer.'
WWW_ROOT = 'http://blog.thomaspuppe.de/'

AUTHOR = 'Thomas Puppe'
EMAIL = 'info@thomaspuppe.de'
WEBSITE = 'http://www.thomaspuppe.de'

CONTENT_EXTENSION = '.md'
STATIC = ['static']

FILTERS = ['markdown+codehilite(css_class=highlight)', 'hyphenate', 'h1']

VIEWS = {

	'/': {
		'filters': 'summarize',
		'view': 'index'
	},

	'/:slug': {
		'views': ['entry', 'draft'],
		'filters': ['nohyphenate']
	},

	'/kategorie/:name/': {
		'filters': 'summarize',
		'view':'tag',
		'pagination': '/tag/:name/:num/'
	},

	'/feed/atom/': {'filters': ['h2', 'nohyphenate'], 'view': 'atom'},
	'/feed/rss/': {'filters': ['h2', 'nohyphenate'], 'view': 'rss'},

	# # per tag Atom or RSS feed. Just uncomment to generate them.
	# '/tag/:name/atom/': {'filters': ['h2', 'nohyphenate'], 'view': 'atompertag'},
	# '/tag/:name/rss/': {'filters': ['h2', 'nohyphenate'], 'view': 'rsspertag'},

	'/sitemap.xml': {'view': 'sitemap'},

	# # Here are some more examples

	# # '/:slug/' is a slugified url of your static page's title
	# '/:slug/': {'view': 'page'},

	# # '/atom/full/' will give you a _complete_ feed of all your entries
	# '/atom/full/': {'filters': 'h2', 'view': 'atom', 'num_entries': 1000},

	# # a feed containing all entries tagges with 'python'
	# '/rss/python/': {'filters': 'h2', 'view': 'rss',
	#                  'if': lambda e: 'python' in e.tags},

	# # a full typography features entry including MathML and Footnotes
	# '/:year/:slug': {'filters': ['typography', 'Markdown+Footnotes+MathML'],
	#                  'view': 'entry'},

	# # translations!
	# '/:year/:slug/:lang/': {'view': 'translation'},
}

LANG = 'DE'
THEME = 'themes/thomaspuppe'
THEME_IGNORE = ['sass*']

ENGINE = 'acrylamid.templates.jinja2.Environment'
DATE_FORMAT = '%Y-%m-%d'
PERMALINK_FORMAT = '/:slug'

# prevent pagination
DEFAULT_ORPHANS = 9999

DEPLOYMENT = {
    "ls": "ls $OUTPUT_DIR",
    "echo": "echo '$OUTPUT_DIR'",
    #"default": "rsync -av --delete $OUTPUT_DIR www@server:~/blog.example.org/"
    "default": "scp -vr ./output/* thomaspuppe:/var/www/blog.thomaspuppe.de/"
}
