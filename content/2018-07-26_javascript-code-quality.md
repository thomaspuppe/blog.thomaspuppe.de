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



## currying

TODO: make it currying, or change the headline :-)

<pre>updateTime = function (elapsedTime) {
	let elapsedTimeSeconds = Math.floor((elapsedTime / 1000) % 60);
	let elapsedTimeMinutes = Math.floor((elapsedTime / 60000) % 60);
	const elapsedTimeHours = Math.floor((elapsedTime / 1000) / 3600);

	elapsedTimeSeconds = (elapsedTimeSeconds > 9) ? elapsedTimeSeconds : '0' + elapsedTimeSeconds.toString();
	elapsedTimeMinutes = (elapsedTimeMinutes > 9) ? elapsedTimeMinutes : '0' + elapsedTimeMinutes.toString();

	timeDomElement.innerHTML = elapsedTimeHours + ':' + elapsedTimeMinutes + ':' + elapsedTimeSeconds;
	}</pre>

We cannot have the `elapsedTimeSeconds` as constant, because we need to manipulate it later. That manipulation has, in a strict sense, nothing to do with the updateTime(), and is only a cosmetical enhancement. Further, the code is redundant because we want to apply the same logic to `elapsedTimeMinutes`.

So, of course, a first step would be to extract that into a function:

<pre>addLeadingZero = function(num) {
	return (num > 9) ? num.toString() : '0' + num.toString();
},
updateTime = function (elapsedTime) {
	let elapsedTimeSeconds = Math.floor((elapsedTime / 1000) % 60);
	let elapsedTimeMinutes = Math.floor((elapsedTime / 60000) % 60);
	const elapsedTimeHours = Math.floor((elapsedTime / 1000) / 3600);

	elapsedTimeSeconds = addLeadingZero(elapsedTimeSeconds);
	elapsedTimeMinutes = addLeadingZero(elapsedTimeMinutes);

	timeDomElement.innerHTML = elapsedTimeHours + ':' + elapsedTimeMinutes + ':' + elapsedTimeSeconds;
}</pre>

Since this is a utility for formatting, one could consider moving it somewhere else. But for now this stays right above the updateTime() function.

After we extracted that code into a function, we can also wrap that one around our calculation ... and have the desired constant.

<pre>addLeadingZero = function(num) {
	return (num > 9) ? num.toString() : '0' + num.toString();
},
updateTime = function (elapsedTime) {
	const elapsedTimeSeconds = addLeadingZero(Math.floor((elapsedTime / 1000) % 60));
	const elapsedTimeMinutes = addLeadingZero(Math.floor((elapsedTime / 60000) % 60));
	const elapsedTimeHours = Math.floor((elapsedTime / 1000) / 3600);

	timeDomElement.innerHTML = elapsedTimeHours + ':' + elapsedTimeMinutes + ':' + elapsedTimeSeconds;
}</pre>


TODO: define the function _inside_ updateTime???

This is calles currying and a lot sexier in ES6 notation, but in my case I want to spare the Babel transpiler and can live without the narrow syntax. Also, in this example you could argue that the inline code is easier to comprehend (and probably more performant) than the seperate function. But here it serves as an example.



## Code formatting

- editorconf
- prettier


## Eslint



## Other Quality Tools

- https://deepscan.io/demo/
- http://jshint.com/
- http://jsmeter.info/
