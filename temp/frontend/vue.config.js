const { defineConfig } = require("@vue/cli-service");
module.exports = defineConfig({
  devServer: {
    host: process.env.VUE_APP_URL || "127.0.0.1",
    port: process.env.VUE_APP_PORT || 8080,
  },
  transpileDependencies: true,
});
