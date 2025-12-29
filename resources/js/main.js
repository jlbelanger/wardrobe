import '../css/style.css';
import { initCategories } from './categories.js';
import initDressMe from './dress-me.js';
import initNav from './nav.js';
import initRandom from './random.js';
import { initScroll } from './scroll.js';
import { initSeasons } from './seasons.js';
import onLoad from './load.js';
import onResize from './resize.js';

initCategories();
initDressMe();
initNav();
initRandom();
initScroll();
initSeasons();

window.addEventListener('load', onLoad);
window.addEventListener('resize', onResize);
