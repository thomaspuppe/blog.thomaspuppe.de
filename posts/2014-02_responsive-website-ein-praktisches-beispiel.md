# Umstellung auf Responsive Web Design - ein praktisches Beispiel
- Thomas Puppe
- thomaspuppe
- 2014/02/13
- Web-Entwicklung
- published

Wie baut man eine einfache Website von nicht-responsive auf responsive um? Eine Schritt-für-Schritt Anleitung anhand dieses Blogs.

Ziel ist nicht, dass der Blog auf allen Geräten gleich aussieht (was auch nicht der Sinn von RWD ist). Sondern dass er auf allen Geräten gut aussieht und vor Allem funktioniert (was der Sinn von RWD ist).

Anhand des sehr einfachen Blog-Layouts öchte ich drei grundlegende Regeln von Responsive Websites erläutern.

##1. Anpassung des Viewport

Mit der Einführung des iPhone wurde quasi eine neue Geräteklasse geschaffen, auf die das Web nicht vorbereitet war. Websites, die zuvor auf einem Bildschirm mit 1024 und mehr Pixeln dargestellt wurden, sollten nun auf einem 320 oder 480 Pixel breiten Display gezeigt werden. Vor dieser Herausforderung stand Apple. Eine Variante dafür wäre, nur die linke obere Ecke der Website zu zeigen. Ein anderer, die Website klein zu skalieren. Für die zweite Variante hatte sich Apple entschieden. Websites wurden auf eine feste Breite von 980 Pixel gerendert und dann auf die Breite des iPhones herunterskaliert. (Für Android-Browser gilt das gleiche, mit 800 Pixeln Breite.)

<figure><img src="/images/2014/02/responsive_01_ohneviewport.png"><figcaption>Abb. 1: Darstellung ohne Viewport</figcaption></figure>

Wenn nun aber eine Website mit einer Breite von wenigr als 980 Pixeln gut zurechtkommt (also responsive ist), dann muss das dem Browser mitgeteilt werden. Dafür dient der Viewport:

<pre>&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;</pre>

Dieser Meta-Tag im Head-Bereich der Website sagt dem Browser, dass die Seite nicht mit fiktiven 980 Pixeln gerendert werden soll, sondern auf der nativen Breite des Geräts. Wie sich die Seite bei dieser Breite verhält, das ist dann Sache des CSS.

<figure><img src="/images/2014/02/responsive_02_mitviewport.png"><figcaption>Abb. 2: Darstellung mit Viewport (noch nicht schön, aber man sieht die automatische Anpassung der Breite).</figcaption></figure>

Auf Desktop-Browsern spielt der Viewport übrigens keine Rolle. Hier gilt die Fensterbreite wie sie ist, weil es ja keinen Grund zum Skalieren gibt.

##2. Flexible Seitenbreite und Raster

Als nächstes muss die Seite flexibel auf die (nun auch auf kleinen Geräten erkannte) Breite reagieren. Statt einer festen Breite in Pixeln geben wir den Elementen auf der Seite eine flexible Breite in Prozent, die sich an der größe des Browserfensters (oder des mobilen Gerätes) orientiert.

Feste oder minimale Breiten können im Responsive Web Design für kleine Elemente nützlich sein. Für große Elemente sind sie es meist nicht. Böser Fehler in der ersten Version dieses Blogs: 

<pre>.posts { width: 100%; min-width:710px; }</pre>

Soeben haben wir mobile Geräte mittels Viewport dazu gezwungen, die Seite in Originalpixeln zu rendern. Hat das Gerät nur 480 Pixel Breite, ist die Seite natürlich zur Hälfte abgeschnitten. Indem man feste oder minmale Breiten aus dem CSS entfernt, passten sich Block-Elemente wie Divs an die verfügbare Breite an. In diesem Fall sind das 100% des Browsers - so soll es sein. Auf die Angabe von 100% kann man in dem Fall natürlich auch verzichten.

100% Breite für Elemente sind aber nicht immer erwünscht. Gerade bei sehr großen Monitoren sind Flisßtexte schlecht lesbar, wenn sie den ganzen Bildschrimbreite einnehmen. Abhilfe schafft die Angabe einer maximalen Breite: 

<pre>.posts p, .posts h1, .posts h2 { max-width:600px; }</pre>

Da die Artikel selbst noch breit laufen sollen (bunter Rand rechts), begrenzen wir nur Überschriften und Absätze in der Breite. Ḿan erkennt, dass die Inhalte der rechten Spalte sich dem Menü 

##3. Breakpoints für unterschiedliche Styles

Anhand von sogenannten Media Queries kann bestimmtes CSS für bestimmte Gerätetypen ausgeliefert werden. Für Responsive Websites richtet man sich meist nach der Breite des Bildschirms. Anhand von Grenzwerten (&ldquo;Breakpoints&rdquo;) werden unterschiedliche Regeln für unterschiedliche Bildschirm edefiniert. Für den Einsatz von Breakpoints gibt es zwei verschiedene Ansätze. **Desktop-First** funktioniert mit absteigenden max-width Werten:

<pre>h1 {
font-size: 3.5em;
}

@media only screen and (max-width : 1200px) {
    h1 {
        font-size: 3em;
    }
}

@media only screen and (max-width : 600px) {
    h1 {
        font-size: 2em;
    }
}</pre>

**Mobile-First** arbeitet mit aufsteigenden min-width Werten:

<pre>h1 {
font-size: 2em;
}

@media only screen and (min-width : 600px) {
    h1 {
        font-size: 3em;
    }
}

@media only screen and (min-width : 1200px) {
    h1 {
        font-size: 3.5em;
    }
}</pre>

Beachte: für alle Bildschirme über dem größten max-width-Wert (oder unter dem kleinsten min-width-Wert) muss ein Standardwert definiert werden.

Da mobile (kleine) Geräte tendentiell schwächer sind als große, halte ich Mobile-First für einen guten Ansatz.


##Linktipp

<a href="http://bradfrost.github.io/this-is-responsive/">&ldquo;This is responsive&rdquo; von Brad Frost</a>.