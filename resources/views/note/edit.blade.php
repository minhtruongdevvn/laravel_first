<x-layout>
    <div class="content-container create">
        <h1 style="font-size: 2rem">Create new note</h1>
        <form action="{{ route('note.update', $note) }}" method="POST" class="note">
            <textarea style="width: 100%" name="note" rows="10" class="note-body" placeholder="Enter your note here">
                {{ $note->note }}
            </textarea>
            <div class="note-buttons">
                <a class="link-btn" onclick="window.history.back();" class="note-cancel-button">Cancel</a>
                &nbsp;&nbsp;&nbsp;
                <button class="link-btn">Submit</button>
            </div>
        </form>
    </div>
</x-layout>
