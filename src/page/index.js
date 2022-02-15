import {createApp} from 'vue'
import App from './components/app'
const app = createApp({
    components: {App},
    template: '<app/>'
});

app.mount( '#app')
