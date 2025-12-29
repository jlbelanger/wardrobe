import { defineConfig } from 'cypress';

export default defineConfig({
	e2e: {
		baseUrl: 'https://wardrobe.jennybelanger.local',
		experimentalRunAllSpecs: true,
	},
});
