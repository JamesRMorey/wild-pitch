import './index.css'
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faHeart, faTent, faHamburger, faUser, faEdit, faAdd, faRemove, faCamera, faCameraRetro, faUpload, faArrowLeft, faArrowRight, faChevronLeft, faChevronRight } from '@fortawesome/free-solid-svg-icons'

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

const app = createApp(App)

app.use(router)
app.component('font-awesome-icon', FontAwesomeIcon)
app.mount('#app')
