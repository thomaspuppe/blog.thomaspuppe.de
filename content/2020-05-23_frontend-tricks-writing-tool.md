---
title: Cool frontend tricks I learned while making my own writing tool
date: 2020-05-23
datelabel: 23. May 2020
language: en
tags: [Webentwicklung]
permalink: cool-frontend-tricks-learned-while-making-a-writing-tool
draft: true
description: this-month-I-learned meets Lesetipps meets Notizblock für Januar 2020
---


## contentEditable attribute



## ch attribute on container widths

max-width: 70ch;


## prevent certain symbols from being typed


`<input type="text" onkeydown="return event.keyCode!==46;">`



## Always wrap localStorage into try/catch


## element.classList.toggle() parameter and return value


`element.classList.toggle()` returns a boolean value, telling you if the class was added or removed. I used this to store the result directly into localstorage (or a variable). No value-checking needed.

```
document.querySelector('#darkmode').addEventListener('click', function(evt) {
	window.localStorage.setItem('wryte_darkmode', document.body.classList.toggle('dark'));
});
```


`element.classList.toggle()` accepts a second parameter, where you can command if the value shoud be set or removed. This is a shortcut to "check a boolean, and then do add or remove".

```
document.querySelector('#darkmode').addEventListener('click', function(evt) {
	document.body.classList.toggle('dark', window.localStorage.getItem('wryte_darkmode')==='true');
});
```


## caret-color

You can style the color of the caret inside form inputs and contentEditables. `caret-color: pink;`


## CSS Vars with classes and native dark mode


## fullscreen

- on the whole document or even specific elements! (testen)

function toggleFullScreen() {
  if (!document.fullscreenElement) {
    document.documentElement.requestFullscreen();
  } else {
    if (document.exitFullscreen) {
      document.exitFullscreen();
    }
  }
}

A shorthand version of this:

document.querySelector('#fullscreenToggle').addEventListener('click', function(evt) {
    document.fullscreenElement ? document.exitFullscreen() : document.documentElement.requestFullscreen();
});
