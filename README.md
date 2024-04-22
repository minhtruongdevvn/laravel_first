<h3>Simple note-taking app using Laravel 11 + vite</h3>
<h3>Application deployed at: http://simplenoteapp-env.eba-zenkiwa8.ap-southeast-2.elasticbeanstalk.com/</h3>
<h4>default user: test@example.com - pass123.</h4>

Install Vue:
1. npm install vue vue-loader @vue/compiler-sfc --save-dev
2. mix.js('resources/js/app.js', 'public/js')
    .vue()  // Add this line to handle .vue files
3. create vue component in resources/js/components
4. config app.js:
    ```
    import { createApp } from 'vue';
    import ExampleComponent from './components/ExampleComponent.vue';

    // with no root element
    const app = createApp({});
    app.component('example-component', ExampleComponent);
    app.mount('#app');
    // with root element
    const app = createApp(App);
    app.mount('#app');

    // note: we can use multiple instances in multiple file if needed
    ```
5. use!!
    ```
    <!-- no root element -->
    <div id="app">
        <example-component></example-component>
    </div>
    <!-- with root element -->
    <div id="app"></div>
    ```
        
