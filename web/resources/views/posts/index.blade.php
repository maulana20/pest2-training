<ul>
@foreach ($posts as $post)
    <li>{{ $post->message }}</li>
@endforeach
</ul>