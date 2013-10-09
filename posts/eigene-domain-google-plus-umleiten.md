# domain.de+ auf Google+ Profil umleiten
- Thomas Puppe
- thomaspuppe
- 2013/01/17
- Web-Entwicklung
- published

Ein Tipp für die Leute mit eigener Domain: Weiterleitung von **thomaspuppe.de/+** auf das Google-Profil via .htaccess:

<code>RewriteEngine on
RewriteCond %{REQUEST_URI} ^/\+
RewriteRule ^(.*)$ https://plus.google.com/u/0/109992889758306031081/ [R=permanent,L]</code>