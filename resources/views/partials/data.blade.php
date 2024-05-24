@foreach ($posts as $post)
<tr>
    <td>{{ $post->id }}</td>
    <td>{{ $post->title }}</td>
    <td>{!! $post->body !!}</td>
</tr>
@endforeach