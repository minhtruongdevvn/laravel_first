import { createApp } from 'vue';
import NoteEditor from './components/NoteEditor.vue';


const app = createApp({});
app.component('note-editor', NoteEditor);
app.mount('#vue-controller');
