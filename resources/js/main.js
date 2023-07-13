import { initCategories } from './categories';
import initDressMe from './dress-me';
import onLoad from './load';
import initNav from './nav';
import initRandom from './random';
import onResize from './resize';
import { initScroll } from './scroll';
import { initSeasons } from './seasons';

initCategories();
initDressMe();
initNav();
initRandom();
initScroll();
initSeasons();

window.addEventListener('load', onLoad);
window.addEventListener('resize', onResize);
