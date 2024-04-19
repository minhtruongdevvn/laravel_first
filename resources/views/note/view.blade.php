<x-layout>
    <div class="note-container">
        <div style="text-align: center;color: white">
            <a class="link-btn" href="{{ route('note.create') }}">Add New</a>
        </div>

        @foreach ($notes as $note)
            <div class="content-container">
                <div class="content-action">
                    <a class="link-btn" href="{{ route('note.edit', $note->id) }}">Edit</a>
                    <a class="link-btn" href="#">Delete</a>
                </div>
                <div class="content-text-wrapper">
                    <blockquote>{{ $note->note }}</blockquote>
                </div>
                <blockquote class="m-6">&nbsp;&nbsp;&nbsp;...</blockquote>
                <div style="text-align: center"><cite>Aldous Huxley</cite></div>
            </div>
        @endforeach
    </div>
</x-layout>
