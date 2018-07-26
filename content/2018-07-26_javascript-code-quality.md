---
title: Small improvements on a tiny JS project
date: 2018-07-26
datelabel: 26. July 2018
language: en
tags: [webdevelopment]
permalink: small-improvements-on-tiny-js-project
draft: true
description: ...
---


## The project

Meetingtimer erklären, GitHub Projekt verlinken.



## const/let

(TODO: theoretische )


## Make it more functional

Another thing to make the code more handable is to move variables from the "global" scope to a more local one. What I mean by this:


<pre>var initialTime,
	timeDomElement,
	currentTime,
	elapsedTime,
	elapsedTimeHours,
	elapsedTimeMinutes,
	elapsedTimeSeconds,
	updateTime = function () {
		elapsedTimeSeconds = Math.floor((elapsedTime / 1000) % 60);
		elapsedTimeMinutes = Math.floor((elapsedTime / 60000) % 60);
		elapsedTimeHours = Math.floor((elapsedTime / 1000) / 3600);

		elapsedTimeSeconds = (elapsedTimeSeconds > 9) ? elapsedTimeSeconds : '0' + elapsedTimeSeconds.toString();
		elapsedTimeMinutes = (elapsedTimeMinutes > 9) ? elapsedTimeMinutes : '0' + elapsedTimeMinutes.toString();

		timeDomElement.innerHTML = elapsedTimeHours + ':' + elapsedTimeMinutes + ':' + elapsedTimeSeconds;
	},
	tick = function () {
		currentTime = Date.parse(new Date());
		elapsedTime = currentTime - initialTime;
		updateCosts(elapsedTime);
		updateTime(elapsedTime);
    };</pre>

There is more code around it, that's why initialTime is not set here. But what I want to demonstrate: initially I hat all variables on a "global" scope so every function inside that scope can read and write them. Which works fine, and is okay for that small project. But at a larger scale things would get confusing and before you now it you start chasing states and lokking who changes what when.

A better approach is to keep things on a more local scope. Only menipulate variables on a certain point, and pushing them into functions where they are only read. My small timer is a perfect example for that.

<pre>var initialTime,
	timeDomElement,
	updateTime = function (elapsedTime) {
		let elapsedTimeSeconds = Math.floor((elapsedTime / 1000) % 60);
		let elapsedTimeMinutes = Math.floor((elapsedTime / 60000) % 60);
		const elapsedTimeHours = Math.floor((elapsedTime / 1000) / 3600);

		elapsedTimeSeconds = (elapsedTimeSeconds > 9) ? elapsedTimeSeconds : '0' + elapsedTimeSeconds.toString();
		elapsedTimeMinutes = (elapsedTimeMinutes > 9) ? elapsedTimeMinutes : '0' + elapsedTimeMinutes.toString();

		timeDomElement.innerHTML = elapsedTimeHours + ':' + elapsedTimeMinutes + ':' + elapsedTimeSeconds;
	},

	tick = function () {
		const currentTime = Date.parse(new Date());
		const elapsedTime = currentTime - initialTime;
		updateTime(elapsedTime);
	};</pre>

That way, the `updateTime()` function has no influence on the outside world (except DOM manipulation). It only takes the one argument that it needs, and handles internal stuff (seconds, minutes) internally.


## let/const

I also replaced `var` declarations with `let` and `const`. As long as we don't transpile the code, we loose users from IE10 and below. But we win a certain degree of safety, simply because we limit the ways to shoot ourselves in the foot.

[TODO: eine etwas bessere "akademische" Argumentation finden.]

We will have a deeper look at that later.

[TODO: minute-Formatierung in Funktionen auslagern.]


## Code formatting

- editorconf
- prettier


## Eslint



## Other Quality Tools

- https://deepscan.io/demo/
- http://jshint.com/
- http://jsmeter.info/
