# Installation

	npm install

# Run it

    npm run build

... which is the `package.json` script for ...

    rm -rf ./output/* && node ./node_modules/easto/index.js --config=easto_config.json --verbose=true
    // TODO: der node-Aufruf des Moduls im Unterverzeichnis fühlt sich noch nicht richtig an.


# Tools

Broken link checker

    npx broken-link-checker https://blog.thomaspuppe.de -ro

    wget --spider --recursive --force-html https://blog.thomaspuppe.de

    npx check-html-links https://blog.thomaspuppe.de
