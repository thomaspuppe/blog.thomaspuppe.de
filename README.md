# Installation

	yarn install

# Run it

    yarn build

... which is the `package.json` script for ...

    rm -rf ./output/* && node ./node_modules/easto/index.js --config=easto_config.json --verbose=true
    // TODO: der node-Aufruf des Moduls im Unterverzzeichnis fühlt sich noch nicht richtig an.
