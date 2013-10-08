<header>
	<h2>Error 404: Seite nicht gefunden</h2>
</header>

<article class="category <?php echo(substr($post_category_link, strrpos($post_category_link, '/') + 1)); ?>">
	<p>Die aufgerufene Seite wurde nicht gefunden. Alles was ich Ihnen anbieten kann ist eine Liste der Artikel dieses Blogs:</p>
</article>

<a href="<?php echo($blog_url); ?>" class="button_accent" title="alle Artikel">&larr;&nbsp;&nbsp;&nbsp;Alle Artikel dieses Blogs anzeigen.</a>