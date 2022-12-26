const { defineConfig } = require('cypress'); // eslint-disable-line import/no-extraneous-dependencies

module.exports = defineConfig({
	e2e: {
		baseUrl: 'https://wardrobe.jennybelanger.local',
	},
});
