<x-app-layout>
    <div class="content-container show">
        <div class="content-action">
            <a class="link-btn" href="{{ route('note.index', $note->id) }}">
                < Back </a>
                    <a class="link-btn" href="{{ route('note.edit', $note->id) }}">Edit</a>
                    <a class="link-btn" href="#">Delete X</a>
        </div>
        <div class="content-text-wrapper">
            <blockquote style="max-width: 100%">{{ $note->note }}</blockquote>
        </div>

        <div style="text-align: center"><cite style="font-size:2rem">{{ $note->user->name }}</cite></div>
    </div>
</x-app-layout>
