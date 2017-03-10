---
title: Twitter-Bot-Beobachtung zu #AnneWill
date: 2017-03-10
datelabel: 10. März 2017
language: de
tags: [Webentwicklung]
permalink: twitter-bots-anne-will
draft: false
description: Social Bots sind aktell ein großes Thema. Zu Recht? Ich habe am Sonntag #AnneWill Tweets gesammelt, und an denen zwei Methoden zur Bot-Erkennung verglichen.
---

Social Bots sind aktuell ein großes Thema. Die Medien berichten darüber, wie die [bösen Roboter](http://www.zeit.de/digital/internet/2017-01/social-bots-bundestagswahl-twitter-studie) unsere [Demokratie hacken](http://www.zeit.de/2017/09/bundestagswahl-fake-news-manipulation-russland-hacker-cyberkrieg) werden. Sogar Verbote werden gefordert -- ich nehme an, der Quatsch soll Schlagzeilen bringen und ist nicht ernst gemeint. "Forscher" und "Experten" versuchen, die vom Untergang bedrohten Parteien zu beraten. Aufgefallen ist mir kürzlich das Projekt [Botswatch](http://botswatch.de/projects/anne-will-am-04-12-2016/), das Bot-Reaktionen auf Talkshows beleuchtet -- mit der simplen Heuristik, dass User mit 50 oder mehr Tweets pro Tag Bots seien.

Ich halte das alles für sinnlose Panikmache. War aber neugierig, wie denn die Zahlen zustande kommen, was sie bedeuten, und welche Techniken heute zum Einsatz kommen um Social Bots zu identifizieren.

Dazu habe ich am vergangenen Sonntag Tweets zur Sendung Anne Will im Ersten gespeichert, und etwas genauer angeschaut.

- Sendung: So, 05.03.17 | 21:45 - 22:45 Uhr Das Erste
- Tweet-Aufzeichnung: 21:00 bis 23:30 Uhr, Tweets mit dem Hashtag #annewill.
- Insgesamt wurden 5705 Tweets erfasst, davon sind 2842 "originale" Tweets und 2863 Retweets.

Die Rohdaten habe ich bei [GitHub](https://github.com/thomaspuppe/watch-the-bots/tree/master/data/annewill/original) veröffentlicht, einige Erkundungs-Grafiken sind in meinem [Tableau](https://public.tableau.com/profile/thomas.puppe#!/vizhome/BlogBotswatch/TweetsUhrzeit) Account zugänglich.


<figure>
	<img src="/images/2017/03/botswatch/graph_tweets-per-minute.png" alt="Graph: Tweets pro Minute währen der Anne Will Sendung"/>
	<figcaption>Tweets mit #annewill pro Minute während der Sendung am 05.03.2017 <a href="https://public.tableau.com/profile/thomas.puppe#!/vizhome/BlogBotswatch/TweetsUhrzeit">Daten bei Tableau</a></figcaption>
</figure>


Insgesamt haben 1794 User (Re)Tweets gesendet. Die meisten wenige, manche viele. Die fleißigsten Kommentatoren waren @rot_pe (64 Tweets), @HorstNRW (53 Tweets), @darksideoftheeg (37 Tweets).

888 User haben nur einen Tweet gesendet, 491 User zwei oder drei Tweets. Immerhin 115 User schrieben jeweils mehr als 10 Tweets.

Die erfolgreichsten (im Sinne von Retweets während der Sendung) stammen von @krk979 (98 RT), @AliCologne (58 RT und 42 RT) und @Heinrich_Krug (42 RT).

Man kann da jetzt alle möglichen Analysen drauf fahren (Hashtags, Dialoge, wer wird erwähnt) ... aber hier soll es um Bots gehen. Also los: finden wir die Bots!


## Verfahren 1: Accounts mit mehr als 50 Tweets pro Tag sind Bots

Das erste Verfahren, das mich auch auf das Thema gebracht hat, ist das schnellste. Alle Accounts, die mindestens 50 Tweets pro Tag senden oder mindestens 50 Favoriten markieren, sind Bots.

Im Sample von #annewill wären das

* mit 50+Tweets: 151 User mit 838 Tweets.
* mit 50+ Favoriten: 130 User mit 615 Tweets.
* Kombiniert (50 Tweets oder Favoriten): *217 User mit 1080 Tweets*.

12 Prozent aller User sollen also Bots sein, die für ein Fünftel der Tweets verantwortlich sind. Das sind auch zahlen, die Botswatch nennt (logisch, ich habe deren Verfahren angewendet) und 19% werden auch in einem [ZEIT Online Artikel zu Social Bots](http://www.zeit.de/digital/internet/2017-01/social-bots-bundestagswahl-twitter-studie/komplettansicht) genannt, oder im [Handelsblatt](http://www.manager-magazin.de/unternehmen/it/social-bots-donald-trumps-stimmungsmacher-a-1136133.html). Beide zitieren Studien von Universitäten in den USA. Ich habe mir nicht die Mühe gemacht, die Primärquellen zu prüfen.

Verschiebt man die Grenze auf 40 oder 60 Tweets, bleibt der Anteil ähnlich: 16 bis 10 Prozent der Nutzer wären Bots, und 22 bis 15 Prozent der Nachrichten von ihnen geschrieben. Ein [Histogramm](https://public.tableau.com/profile/thomas.puppe#!/vizhome/BlogBotswatch/TweetsTagHistogramm) dazu habe ich bei Tableau (Achtung: unterschiedliche Bucket-Größen!).


<figure>
	<img src="/images/2017/03/botswatch/graph_tweets-tag-histogramm.png" alt="Graph: Histogramm mit Accounts und Tweets pro Tag"/>
	<figcaption>Anzahl von Accounts des #annewill Samples, die eine bestimmte Menge von Tweets pro Tag versenden</figcaption>
</figure>


Ich habe mir die aktivsten dieser Accounts angesehen, um zu erfahren was da los ist.

Was sind das für Bots, die "nach einer neuen Bundestags-Studie nicht nur unsere politische Kultur vergiften, sondern bei knappen Mehrheiten auch Wahlergebnisse beeinflussen können" ([focus](http://www.focus.de/politik/deutschland/social-bots-bundestagsstudie-warnt-roboter-koennten-radikalisieren-und-wahlen-beeinflussen_id_6527643.html))?

Ich habe mir die Accounts angeschaut, die im Annewill-Sample als Bot klassifiziert wurden, und besonders viel tweeten.

Top-Bot meines Samples mit 855 Tweets pro Tag ist der *@bot_huso* ("Hurensohn Bot"). Ein automatisches Programm, das Tweets retweetet, die das Wort "Hurensohn" beinhalten.

Es folgen eine kurdische Nachrichten-Suchmaschine (@Rojname_com), der @Demokratie_Bot, der offenbar alles mit #democracy retweetet, die @WorldTweetNews und etliche Trending-Topic-Bots (@TrendingTopicPK, @top_world_now).

Erst danach folgt im Ranking der User @hans_obermeier (Username "Old Fart") mit 439 Tweets pro Tag und 12 Beiträgen zur Anne Will Sendung. Ein echter AfD/Merkelmussweg Typ, der sehr viele Beiträge retweetet, und manche selber verfasst oder kommentiert. Nach der 50-Tweets-Regel wäre er ein Bot, nach meiner menschlichen Einschätzung nicht.

Dann folgen einige Spam-Bots.

<p class="highlight">Nachrichten wie "Check LINK Live Nude Streaming #Deutschland #BVBFCB #annewill #bpw16 #CDU www.ein-spam-link.com" werden häufig verschickt. Sie stammen auch eindeutig von Bots. Aber sie gefähren nicht unsere Demokratie!</p>

Das Live-Nude-Streaming aus dem Bundestag wurde mit nur 14 Tweets beworben. Das ist nicht viel, aber treibt zusammen mit anderem Spam die Zahlen der Bot-Hysteriker nach oben.

Zwischen Trend-Bots und Spam gibt es natürlich viele Accounts, die tatsächlich Inhalte verbreiten. Auch, und vor Allem, politische.

Zunächst möchte ich noch das andere Ende des Spektrums anschauen: Accounts, die sehr wenige Tweets pro Tag absenden. (Kleiner Exkurs: die Tweets pro Tag errechnet man in der Regel aus dem Tag der Accounteröffnung und der Gesamtzahl der bisherigen Tweets. Schwankungen in der Aktivität werden dabei nicht berücksichtigt. Das ginge auch, aber mit erheblch mehr Aufwand.)

Ab unteren Ende des Spektrums des #annewill-Bot-Rankings auffällig viele Accounts, die seit Jahren bestehen, aber nur eine einstellige Anzahl an Tweets verfasst haben. Als Beispiel seien genannt: @Secret9191, @Eschenbach22145, @Coby18807372, @juewilu, @trueequalsfalse und @FredHeiss. Besucht man diese Accounts, stellt man fest, dass sie wenige oder keine Follower haben, und tatsächlich nur einen sehr aktuellen Tweet (der aber zum Zeitpunkt der Überprüfung, zwei Tage später, schon nicht mehr der Annewill-Tweet ist). Hier wird offensichtlich kurz nach dem Schreiben wieder gelöscht. Entweder das sind komische Kauze -- oder Bots, die nicht also solche (durch plumpe Heuristiken) erkennbar sein wollen. Besonders die Namen mit Zahlen deuten möglicherweise auf eine generische Erzeugung der Accounts hin. Beim Herumspielen mit den Zahlen habe ich allerdings kein Schema und keine Serie gefunden.


Verfahren 2: BotOrNot

Die University of Indiana bietet einen Service namens [BotOrNot](http://truthy.indiana.edu/botornot) an, den man auch per [API](https://github.com/truthy/botornot-python) benutzen kann. Die Nutzer der Annewill-Tweets habe ich gegen diese API gesendet.

Als Ergebnis erhält man eine Wahrscheinlichkeit, zu der ein Account als Bot angesehen wird. Da gibt es verschiedene Merkmale wie das Netzwerk, Account-Infos, Zeiträume zu denen geschrieben wird (24h Aktivität=Bot) und Inhaltsanalysen. Außerdem einen Gesamt-Score, den ich für alle Accounts, die sich an #annewill beteiligt haben, betrachtet habe:

<figure>
	<img src="/images/2017/03/botswatch/graph_botornot-score-histogramm.png" alt="Graph: Histogramm mit dem Botornot-Score"/>
	<figcaption>Anzahl von Accounts des #annewill Samples, die eine bestimmten Score bei BotOrNot erreichen</figcaption>
</figure>

Aus dem Sample werden 163 Accounts als Bots betrachtet, wenn man 50% Wahrscheinlichkeit als Bot-Grenze zieht. Möchte man zu 60% sicher sein, sind es nur noch 31 Accounts. Diese habe ich mir genauer angesehen.

Sehr hohe Werte haben die Accounts @Anti68er (97%), @FredHeiss (92%), Coby18807372 (79%). Das sind die oben genannten "leeren" Accounts, die ihre Tweets schnell wieder lsöchen.

Auch vertreten sind @RMehberg (79%), @MarkusFelder2 (64%), @LisaSkytta (64%), die nicht sehr aktiv sind. Warum Accounts, die wenige Wochen alt sind und nicht viel schreiben, als Bots eingeordnet werden, erschließt sich mir nicht.

Von den 31 Usern, die mit mehr als 60% als Bot klassifiziert werden, wurde nur ein einziger in der 50-Tweets-Methode erfasst: @top_world_now.

Umgekehrt: der "Hurensohn"-Retweeter, die Trend-Bots, und die Spam-Schleudern sind von BotOrNot alle nicht als Bot erkannt worden.

Auch hier noch ein Blick auf das andere Ende des Spektrums: von den 58 Usern, die mit weniger als 20% Wahrscheinlichkeit als Bot eingeordnet wurden, wären drei von der 50-Tweet Klassifizierung erfasst worden.


## Fazit 1: Vergleich der Bots

Man sieht, dass die beiden Verfahren -- 50-Tweet-Heutistik vs. API der Universität -- unterschiedliche Accounts als Bots einordnen. Bei beiden findet man an beiden Enden des Spektrums sofort Fehlklassifizierungen. Die Zahlen, die man als Grenzwert benutzt, lasse sich beliebig verschieben und sorgen dann entweder allmählich für mehr Bots (Anzahl-der-Tweets Methode) oder rapide (BotOrNot Score).


## Fazit 2: Der Inhalt

Im Sample habe ich jede Menge radikale Asichten gesehen. Meistens von rechts. Besonders von Vielschreibern. Und das durch die Bank, unabhängig von Methode und Einordnung als Bot.

Was nicht bedeuten muss, dass die AfD und andere Nazis Bots einsetzen (wie gern irgendwo geschrieben), sondern auch bedeuten kann dass diejenigen besonders viel zu politischen Talkshows twittern, die besonders viel politisches Mitteilungsbedürfnis haben.

In absoluten Zahlen ist das nach meiner Ansicht eh nicht relevant. Accounts wie @AnneWillTalk, @HeikoMaas, @berlinerzeitung oder @jungeunion haben eine große Reichweite, stehen aber nicht im Verdacht Bots zu sein.

Der patriotische Vielschreiber @darksideoftheeg kommt auf 13.000 Follower, hat viele Beiträge und einen mittleren Score von 51% bei BotOrNot.

Die als Bots erkannten Accounts haben hingegen keine großen Follower-Zahlen. Und damit keinen großen Einfluss. Außer, wie so oft bei twitter, indirekt über die Medien, die das Thema Bots aufgreifen und die, als wirksamer Aufreger, extreme Ansichten weiterverbreiten.

## Was hilft denn? Wie erkennt man Bots?

Ganz wichtig: Bots schreiben eh keine Inhalte. Sie dienen als Multiplikatoren (einer schreibt, zehn künstliche Accounts veröffentlichen), oder sie verbreiten bestimmte Inhalte weiter. Und an der Stelle ist es auch egal, ob das ein identitärer Fanboy mit zu viel Zeit macht, oder ein automatisches Programm.

Als konkrete Maßnahme für ein Thema, z.B. Polit-Talkshows, hilft nur die Einordnung ins Thema. Passt das Geschriebene zur Sendung? Das kann dann nicht vorbereitet aus der Dose kommen. (Witze über die Vorhersagbarkeit von Polit-Talkshows überspringen wir.) Dann ist es wohl von Menschen geschrieben.

Ist es ein Allgemeinplatz oder eine Lüge? Dann könnte es vorbereitet aus der Dose kommen. Oder auch nicht. Hier hilft dann Medienkompetenz und gesunder Menschenverstand.

*Die Bot-Detektoren jedenfalls helfen nicht.* Noch nicht. Noch nicht gut genug. Es gibt sicher weitere Ansätze, aber so etwas ist immer ein Wettrennen. Die Bot-Programmierer wissen ja auch, mit welchen Methoden die Detektoren arbeiten. Und haben sich, wie gesehen, daran angepasst. Ich erinnere an die Accounts, die sehr viel schreiben und gleich wieder löschen. Oder die automatischen Trend-Bots und Spam-Bots. Bei solch groben Unschärfen kann man nur raten. Eine Angabe im Nachkommabereich, dass nun 22,81% der Akteure Bots seien, täuscht eine Wissenschaftlichkeit vor, die nicht gegeben ist.

## P.S.

Es macht wirklich keinen Spaß, sich durch politische Tweets durchzuarbeiten.

<blockquote>"Die Talkshow #annewill ist noch nicht mal als Trinkspiel zu gebrauchen. Sad /o\" &mdash; @NicolePunkt</blockquote>




