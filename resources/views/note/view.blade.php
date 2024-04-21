<x-app-layout>
    <div class="note-container">
        <div style="text-align: center;color: white">
            <a class="link-btn" href="{{ route('note.create') }}">Add New</a>
        </div>

        @foreach ($notes as $note)
            <div class="content-container">
                <div class="content-action">
                    <a class="link-btn" href="{{ route('note.edit', $note->id) }}">Edit</a>
                    <a class="link-btn" href="{{ route('note.show', $note->id) }}">View</a>
                    <form action="{{ route('note.destroy', $note) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')

                        <button class="link-btn">Delete</button>
                    </form>
                </div>
                <div class="content-text-wrapper">
                    <blockquote>{{ $note->note }}</blockquote>
                </div>
                <div style="text-align: center"><cite>{{ $note->user->name }}</cite></div>
            </div>
        @endforeach
    </div>
    <br>
    {{ $notes->links() }}
</x-app-layout>
