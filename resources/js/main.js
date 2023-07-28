import '../scss/style.scss';
import { initCategories } from './categories';
import initDressMe from './dress-me';
import initNav from './nav';
import initRandom from './random';
import { initScroll } from './scroll';
import { initSeasons } from './seasons';
import onLoad from './load';
import onResize from './resize';

initCategories();
initDressMe();
initNav();
initRandom();
initScroll();
initSeasons();

window.addEventListener('load', onLoad);
window.addEventListener('resize', onResize);
