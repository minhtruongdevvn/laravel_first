<x-app-layout>
    <div id="vue-controller">
        <note-editor action="{{ route('note.update', $note) }}" :note='@json($note->note)'
            :author='@json($note->user->name)' deleteLink="{{ route('note.destroy', $note) }}"
            back-link="{{ route('note.index') }}">
            <template v-slot:delete>
                @csrf <!-- CSRF token for security -->
                @method('DELETE') <!-- Specify the method Laravel should use -->
            </template>
            <template>
                @csrf
                @method('PUT')
            </template>
        </note-editor>
    </div>
</x-app-layout>
