# doNotTrack Browserübergreifend erkennen
- Thomas Puppe
- thomaspuppe
- 2013/11/07
- Web-Entwicklung
- published

Mit dem doNotTrack Befehl können User signalisieren, dass sie nicht von Websites getrackt werden möchten. Browser senden dafür einen HTTP-Header mit ihren Requests an den Webserver. Via JavaScript lässt sich diese Einstellung auch im Client auslesen. Dieses Auslesen funktioniert leider nicht einheitlich. 

Chrome und Safari haben eine andere Schreibweise für die doNotTrack Property als der Firefox Browser. Der IE 9/10 verwendet einen eigenen Namen. Und der IE 8 unterstützt diese Einstellung laut Microsoft auf <a href="http://ie.microsoft.com/TEStdrive/Browser/DoNotTrack/Default.html">sehr krude Art und Weise</a>.


##Getestete Browser:

<table>
	<thead>
	<tr><td>Browser</td><td>Abruf</td><td>Wert</td></tr>
	</thead>

	<tbody>
	<tr><td>Chrome 30 (Win 7)</td><td>navigator.doNotTrack</td><td>"0", "1", null</td></tr>
	<tr><td>Chromium 30 (Ubuntu 13)</td><td>navigator.doNotTrack</td><td>"0", "1", null</td></tr>

	<tr><td>Safari 5 (Win 7)</td><td>navigator.doNotTrack</td><td>"0", "1", null</td></tr>

	<tr><td>Firefox 25 (Win 7)</td><td>navigator.doNotTrack</td><td>"no", "yes", "unspecified"</td></tr>
	<tr><td>Firefox 25 (Ubuntu 13)</td><td>navigator.doNotTrack</td><td>"no", "yes", "unspecified"</td></tr>

	<tr><td>Opera 12 (Win 7)</td><td>navigator.doNotTrack</td><td>"0", "1", null</td></tr>

	<tr><td>IE 10 (Win 7)</td><td>navigator.msDoNotTrack</td><td>"0", "1", TODO</td></tr>
	<tr><td>IE 10 (Win 7)</td><td>window.external.InPrivateFilteringEnabled()</td><td>false, true, undefined</td></tr>
	<tr><td>IE 9 (Win 7)</td><td>window.external.InPrivateFilteringEnabled()</td><td>false, true, undefined</td></tr>
	<tr><td>IE 8 (Win 7)</td><td>window.external.InPrivateFilteringEnabled()</td><td>false, true, undefined</td></tr>
	<tr><td>IE 7 (Win 7)</td><td colspan=2>nicht verfügbar</td></tr>

	<tr><td>Chrome Mobile (Android 4.3)</td><td>navigator.doNotTrack</td><td>"0", "1", null</td></tr>
	<tr><td>Safari (iOS 5 / iPad 1)</td><td colspan=2>nicht verfügbar</td></tr>
	<tr><td>Sony Tablet Browser (Android 4.0)</td><td colspan=2>nicht verfügbar</td></tr>
	</tbody>
</table>

<em>Die Tabelle wird nach und nach ergänzt. Input bitte an <a href="https://twitter.com/thomaspuppe">@thomaspuppe</a></em>


##Live-Test in Ihrem Browser


<pre id="jsOutput"></pre>

<script>

var jsOutput = document.getElementById('jsOutput');

jsOutput.innerHTML+= "// Check in normal Browsers\n";
if (typeof navigator.doNotTrack !== 'undefined') {
	jsOutput.innerHTML+= "navigator.doNotTrack ist verfügbar.\n";
	jsOutput.innerHTML+= "navigator.doNotTrack = " + navigator.doNotTrack + " (" + typeof navigator.doNotTrack + ")\n";
} else {
	jsOutput.innerHTML+= "navigator.doNotTrack ist nicht verfügbar.\n";

}
jsOutput.innerHTML+= "\n";


jsOutput.innerHTML+= "// Check in IE 9/10\n";
if (typeof navigator.msDoNotTrack !== 'undefined') {
	jsOutput.innerHTML+= "navigator.msDoNotTrack ist verfügbar.\n";
	jsOutput.innerHTML+= "navigator.msDoNotTrack = " + navigator.msDoNotTrack + " (" + typeof navigator.msDoNotTrack + ")\n";
} else {
	jsOutput.innerHTML+= "navigator.msDoNotTrack ist nicht verfügbar.\n";

}
jsOutput.innerHTML+= "\n";


jsOutput.innerHTML+= "// Check in IE 8\n";
if (typeof window.external !== 'undefined' &&
    typeof window.external.InPrivateFilteringEnabled !== 'undefined') {
	jsOutput.innerHTML+= "window.external.InPrivateFilteringEnabled ist verfügbar.\n";
	jsOutput.innerHTML+= "window.external.InPrivateFilteringEnabled() = " + window.external.InPrivateFilteringEnabled() + " (" + typeof window.external.InPrivateFilteringEnabled() + ")\n";
} else {
	jsOutput.innerHTML+= "window.external.InPrivateFilteringEnabled ist nicht verfügbar.\n";

}
jsOutput.innerHTML+= "\n";

jsOutput.innerHTML+= "// User Agent\n";
jsOutput.innerHTML+= navigator.userAgent + "\n";

</script>
