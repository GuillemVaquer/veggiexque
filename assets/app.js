import './js/bootstrap.bundle.min.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

import './styles/bootstrap.min.css';
import './styles/custom.css';

import welcomeEffect from './js/welcome_effect.js';
window.welcomeEffect = welcomeEffect;

import './js/province_dropdown.js';
//import 'bootstrap';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');


// Import Stimulus if you're using it
//import { startStimulusApp } from '@symfony/stimulus-bridge';
//const app = startStimulusApp();

// Import your custom JavaScript
console.log('Hello from Webpack Encore!');