# Installation

    npm install

# Run it

    npm run build
    npm run serve    # http://localhost:8000

# Local development with easto

To co-develop easto and this blog locally, use `npm link`:

    cd /path/to/easto
    npm link

    cd /path/to/blog.thomaspuppe.de
    npm link easto

After linking, changes in the easto repo are immediately reflected in the blog build. Re-run `npm link` in the easto repo if you do a fresh `npm install` there.


# Tools

Broken link checker

    npx broken-link-checker https://blog.thomaspuppe.de -ro

    wget --spider --recursive --force-html https://blog.thomaspuppe.de

    npx check-html-links https://blog.thomaspuppe.de
