Small improvements

## Checks

- https://tenon.io/
- https://developers.google.com/speed/pagespeed/insights/
- https://validator.w3.org/


## Syntax check



## content-type

`"text/html; charset=utf-8"` for html in `/etc/nginx/mime.types`


## Security

Not a real issue, but you can hide your webserver version from the HTTP headers by entering (or uncommenting) `server_tokens off;` in the http section of your nginx config (`/etc/nginx/nginx.conf`).


`add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;` in site config. (In each and every section where headers are set.)
