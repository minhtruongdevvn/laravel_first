<x-app-layout>
    <div class="content-container create">
        <h1 style="font-size: 2rem">Create new note</h1>
        <form action="{{ route('note.store') }}" method="POST" class="note">
            @csrf
            <textarea style="width: 100%" name="note" rows="10" class="note-body" placeholder="Enter your note here"></textarea>
            <div class="note-buttons">
                <a class="link-btn" href="{{ route('note.index') }}" class="note-cancel-button">Cancel</a>
                &nbsp;&nbsp;&nbsp;
                <button class="link-btn">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>
