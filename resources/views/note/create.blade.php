<x-app-layout>
    <div id="vue-controller">
        <note-editor :is-create="true" action="{{ route('note.store') }}" back-link="{{ route('note.index') }}">
            <template>
                @csrf
            </template>
        </note-editor>
    </div>
</x-app-layout>
