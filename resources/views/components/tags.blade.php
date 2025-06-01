@props(['tags', 'position' => 'start'])

<div class="text-center mt-4">
    <ul class="flex flex-wrap justify-{{ $position }}">
        @foreach ($tags as $tag)
        <li class="py-0.5 px-2 mx-1 mt-2 bg-green-200 text-green-800 rounded">
            <a href="{{ url('/tags', $tag->name) }}">{{ $tag->name }}</a>
        </li>
        @endforeach
    </ul>
</div>
