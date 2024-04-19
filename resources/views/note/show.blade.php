<x-app-layout>
    <div class="content-container show">
        <div class="content-action">
            <a class="link-btn" href="{{ route('note.index', $note->id) }}">
                < Back </a>
                    <a class="link-btn" href="{{ route('note.edit', $note->id) }}">Edit</a>
                    <form action="{{ route('note.destroy', $note) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')

                        <button class="link-btn">Delete</button>
                    </form>
        </div>
        <div class="content-text-wrapper">
            <blockquote style="max-width: 100%">{{ $note->note }}</blockquote>
        </div>

        <div style="text-align: center"><cite style="font-size:2rem">{{ $note->user->name }}</cite></div>
    </div>
</x-app-layout>
