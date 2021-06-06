const Config = require('./config');

module.exports =
    Config.Config.execute({
        resources: "./resources/js/index.js",
        public: "public/js"
    });
