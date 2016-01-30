<div class="videos">
    <div class="videos__icon">
        <img src="/{{ $series->categories->first()->image }}" class="img-circle">
    </div>
    <ul class="list-group">
        @foreach ($series->videos as $video)
            @if (isset($vid))
                <a class="list-group-item{{ $vid == $video->id ? ' active' : '' }}"
                        href="{{ route('series.video.show', ['slug' => $series->slug, 'vid' => $video->id]) }}">
            @else
                <a class="list-group-item"
                    href="{{ route('series.video.show', ['slug' => $series->slug, 'vid' => $video->id]) }}">
            @endif
                    @if (isNew($video->published_at))
                        <i class="label label-danger label--new pull-right">New</i>
                    @endif
                    {{ $video->title }}
                </a>
        @endforeach
    </ul>
</div>
