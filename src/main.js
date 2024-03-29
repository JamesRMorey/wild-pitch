import './index.css';
import { createApp } from 'vue';
import App from './App.vue';
import { createPinia } from 'pinia';
import router from './router';

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faBook, faImage, faSave, faRightLeft, faRotateRight, faRotateLeft, faCrop, faUpRightFromSquare, faExclamation, faFilter, faMap, faHeartBroken, faPaw, faPersonFalling, faLeaf, faSpa, faHouseFlag, faPerson, faFaceGrinStars, faWater, faPersonSwimming, faSnowflake, faTree, faCow, faPersonHiking, faMountain, faBinoculars, faHillRockslide, faFaceMehBlank, faChair, faEye, faHeart, faTent, faHamburger, faUser, faEdit, faAdd, faRemove, faCamera, faCameraRetro, faUpload, faArrowLeft, faArrowRight, faChevronLeft, faChevronRight, faM, faS } from '@fortawesome/free-solid-svg-icons'
import { faInstagram } from '@fortawesome/free-brands-svg-icons';

library.add(faHeart);
library.add(faTent);
library.add(faHamburger);
library.add(faUser);
library.add(faEdit);
library.add(faAdd);
library.add(faRemove);
library.add(faCamera);
library.add(faCameraRetro);
library.add(faUpload);
library.add(faArrowLeft);
library.add(faArrowRight);
library.add(faChevronLeft);
library.add(faChevronRight);
library.add(faEye);
library.add(faChair);
library.add(faFaceMehBlank);
library.add(faHillRockslide);
library.add(faBinoculars);
library.add(faPersonHiking);
library.add(faMountain);
library.add(faCow);
library.add(faTree);
library.add(faSnowflake);
library.add(faPersonSwimming);
library.add(faWater);
library.add(faFaceGrinStars);
library.add(faPerson);
library.add(faHouseFlag);
library.add(faSpa);
library.add(faLeaf);
library.add(faPersonFalling);
library.add(faPaw);
library.add(faHeartBroken);
library.add(faFilter);
library.add(faMap);
library.add(faExclamation);
library.add(faInstagram)
library.add(faUpRightFromSquare);
library.add(faCrop);
library.add(faRotateLeft);
library.add(faRotateRight);
library.add(faRightLeft);
library.add(faSave);
library.add(faImage);
library.add(faBook);

const pinia = createPinia();
const app = createApp(App);

app.use(pinia);
app.use(router);
app.component('font-awesome-icon', FontAwesomeIcon);
app.mount('#app');