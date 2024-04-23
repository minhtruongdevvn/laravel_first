<template>
    <div class="content-container">
        <h1 v-if="props.isCreate" style="font-size: 2rem">Create new note</h1>
        <h1 v-else-if="isEdit" style="font-size: 2rem">Edit note</h1>
        <div v-else class="content-action">
            <a class="link-btn" :href="props.backLink">Back</a>
            <button class="link-btn" @click="handleSwitchMode"> Edit</button>
            <form :action="props.deleteLink" method="POST" style="display: inline;">
                <slot name="delete"></slot>

                <button type="submit" class="link-btn">Delete</button>
            </form>
        </div>
        <div ref="contentRef" class="input" :class="{ edit: isEdit }" @input="handleInput" :contenteditable="isEdit"
            v-html="props.note" :key="componentKey">
        </div>
        <cite>{{ props.author }}</cite>
        <form :action="props.action" method="POST">
            <slot></slot>
            <textarea hidden="true" name="note" :value="noteDetails.content"></textarea>
            <div v-if="isEdit">
                <button type="button" class="link-btn" @click="handleCancelEdit">Cancel</button>
                &nbsp;&nbsp;&nbsp;
                <button type="submit" class="link-btn">Submit</button>
            </div>
        </form>
        <button @click="handleInfoPopup" class="expanse-btn">...</button>
        <div v-if="showPopup" class="info">
            <div>
                <p v-if="isEdit" style="text-align: center;">
                    <button @click="handleBoldClick" title="Make selected text bold" class="text-action-btn"
                        style="font-weight: bold">B</button>
                    &nbsp;&nbsp;&nbsp;
                    <button @click="handleItalicClick" title="Make selected text italic" class="text-action-btn"
                        style="font-style: italic;">I</button>
                </p>
                <br>
                <p> • Word count: {{ noteDetails.wordCount }}</p>
                <p> • Sentence count: {{ noteDetails.totalSentence }}</p>
            </div>
            <div v-if="debounceChangeInSecond != 0" class="status">
                Update In: {{ debounceChangeInSecond }}s
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import debounce from '../helpers/debounce';
import { reactive, ref, onMounted } from 'vue';
import { toggleBold, toggleItalic } from '../helpers/makeTextStyle'
import DOMPurify from 'dompurify';

const props = defineProps({
    isCreate: { type: Boolean, required: false, default: false },
    note: { type: String, required: false, default: '' },
    author: { type: String, required: false },
    action: { type: String, require: true },
    editLink: { type: String, require: false },
    deleteLink: { type: String, require: false },
    backLink: { type: String, require: false }
});

const noteDetails = reactive({ content: '', wordCount: 0, totalSentence: 0 })
onMounted(() => {
    if (props.isCreate) isEdit.value = true;
    updateCount(props.note)
    noteDetails.content = props.note;
});

const showPopup = ref(false);
const isEdit = ref(false);
const contentRef = ref(null);
const componentKey = ref(0); // trigger re-render to revert content back to init state
const debounceChangeInSecond = ref(0);
const userSelection = ref<string | undefined>(undefined);

const handleInfoPopup = () => {
    showPopup.value = !showPopup.value;
}
const handleSwitchMode = () => {
    isEdit.value = !isEdit.value;
}
const handleCancelEdit = () => {

    if (props.isCreate) {
        window.history.back();
    } else {
        noteDetails.content = props.note;
        componentKey.value += 1; // trigger re-render to revert content back to init state
        isEdit.value = !isEdit.value;
    }
}

const updateCount = (text: string) => {
    noteDetails.wordCount = text
        .split(/\s+/)
        .filter(sentence => sentence.trim().length > 0)
        .length;

    noteDetails.totalSentence = text
        .split(/[.;?!]/)
        .filter(sentence => sentence.trim().length > 0)
        .length;
}

const updateDebounceTimeInSecond = 3;
const debouncedUpdateInfo = debounce(
    () => updateCount(noteDetails.content),
    updateDebounceTimeInSecond,
    (sec) => { debounceChangeInSecond.value = sec }
);
const halfSecond = 0.5;
const debounceUpdateContent = debounce(
    (event) => { noteDetails.content = (event.target as HTMLDivElement).innerHTML; },
    halfSecond
);
const handleInput = (event: Event) => {
    debounceUpdateContent(event);
    debouncedUpdateInfo();
}

// const handleSelection = () => {
//     const selection = window?.getSelection()?.toString().trim();
// mouseup="handleSelection"
// touchend="handleSelection"
// }

const handleBoldClick = () => {
    toggleBold();
    noteDetails.content = (contentRef!.value! as any).innerHTML;
}
const handleItalicClick = () => {
    toggleItalic();
    noteDetails.content = (contentRef!.value! as any).innerHTML;
}
</script>

<style scoped>
textarea {
    width: 100%;
    height: 300px;
    text-align: justify;
}

.content-container {
    text-align: center;
    padding: 12px;
    width: 100%;
    height: 100%;
    position: relative;
}

.expanse-btn {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 50px;
    height: 50px;
    padding: 0;
    border-radius: 50%;
    border: 2px solid #000;
    background-color: #fff;
    cursor: pointer;
    font-size: 24px;
    line-height: 1;
    outline: none;
    position: absolute;
    top: 4px;
    right: 6px;
    z-index: 2;
}

.expanse-btn:hover {
    background-color: #eaeaea;
}

.expanse-btn:focus {
    outline: none;
}

.info {
    background-color: whitesmoke;
    width: 200px;
    height: 180px;
    position: absolute;
    top: 0;
    right: 0;
    z-index: 1;
    border-radius: 6px;
    box-shadow: 2px 2px 2px 2px;
}

.info div {
    position: absolute;
    bottom: 15px;
    width: 100%;
    padding-left: 4px;
    text-align: left;
}

.input {
    text-align: left;
    padding: 18px;
}

.edit {
    max-height: 500px;
    min-height: 300px;
    overflow-y: auto;
    background-color: white;
}

.content-action {
    display: flex;
    color: #3f3f5a;
    font-size: .8rem;
    margin-left: 10px;
    margin-right: 10px;
    justify-content: space-around;
}

.status {
    position: absolute;
    top: 0;
    left: 0;
    margin: 20px;
    font-style: italic;
    color: green;
}

cite {
    line-height: 3;
    font-size: 1.2rem;
    text-align: left;
}

/* text-action-btn */
/* CSS */
.text-action-btn {
    align-items: center;
    appearance: none;
    background-color: #FCFCFD;
    border-radius: 4px;
    border-width: 0;
    box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
    box-sizing: border-box;
    color: #36395A;
    cursor: pointer;
    display: inline-flex;
    font-family: "JetBrains Mono", monospace;
    height: 28px;
    width: 28px;
    justify-content: center;
    line-height: 1;
    list-style: none;
    overflow: hidden;
    padding-left: 8px;
    padding-right: 8px;
    position: relative;
    text-align: left;
    text-decoration: none;
    transition: box-shadow .15s, transform .15s;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    white-space: nowrap;
    will-change: box-shadow, transform;
    font-size: 18px;
}

.text-action-btn:focus {
    box-shadow: #D6D6E7 0 0 0 1.5px inset, rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
}

.text-action-btn:hover {
    box-shadow: rgba(45, 35, 66, 0.4) 0 4px 8px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
    transform: translateY(-2px);
}

.text-action-btn:active {
    box-shadow: #D6D6E7 0 3px 7px inset;
    transform: translateY(2px);
}
</style>
