@props(['tags'])

<div class="text-center mt-4">
    <ul class="flex flex justify-start">
        @foreach ($tags as $tag)
        <li class="py-0.5 px-2 mx-1 bg-green-200 text-green-800 rounded">
            <a href="{{ url('/tags', $tag->name) }}">{{ $tag->name }}</a>
        </li>
        @endforeach
    </ul>
</div>
