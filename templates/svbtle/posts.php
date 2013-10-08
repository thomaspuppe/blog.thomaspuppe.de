<article class="category <?php echo(substr($post_category_link, strrpos($post_category_link, '/') + 1)); ?>" onClick="window.location='<?php echo($post_link); ?>';return true;">
	<span class="category">#<?php echo($post_category); ?> | <?php echo($published_date); ?></span>
	<h1 id="title">
		<a href="<?php echo($post_link); ?>" title="Artikel «<?php echo($post_title); ?>» lesen"><?php echo($post_title); ?></a>
	</h1>
	<p><?php echo($post_intro); ?></p>
	<a href="<?php echo($post_link); ?>" class="button_accent" title="Artikel «<?php echo($post_title); ?>» lesen"><?php echo($post_title); ?>&nbsp;&nbsp;&nbsp;&rarr;</a>
</article>

<?php if (!$is_home) { ?>
	<a href="<?php echo($blog_url); ?>" class="button_accent" title="alle Artikel">&larr;&nbsp;&nbsp;&nbsp;Startseite</a>
<?php } ?>