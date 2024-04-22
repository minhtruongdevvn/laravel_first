<h3>Install Vue:</h3>

1. npm install vue vue-loader @vue/compiler-sfc --save-dev

2. mix.js('resources/js/app.js', 'public/js')
    .vue()  // Add this line to handle .vue files
   
4. create vue component in resources/js/components

5. config app.js:
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
6. use!!
    ```
    <!-- no root element -->
    <div id="app">
        <example-component></example-component>
    </div>
    <!-- with root element -->
    <div id="app"></div>
    ```
        
<h3>Install Vue - TypeScript</h3>

```
npm install --save-dev typescript ts-loader
```

```
const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .ts('resources/ts/app.ts', 'public/js')
   .vue();
```

```
<script lang="ts" setup>
import { ref } from 'vue';

const title = ref('Hello Vue!');

function updateTitle() : void {
  title.value = 'New Title';
}
</script>
```

add tsconfig.json

add vue-shims.d.ts

<h3>
auto reload:

npm install browser-sync browser-sync-webpack-plugin --save-dev

mix.browserSync('http://127.0.0.1:8000');
</h3>
