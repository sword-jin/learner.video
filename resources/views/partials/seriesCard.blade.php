<div class="card">
    @if (isNew($series->videos->last()->published_at))
        <span class="card__update label label-danger">update!</span>
    @endif
    <span class="card__video-count">{{ count($series->videos) }} Videos</span>
    <div class="card__img">
        <a href="{{ route('series.show', $series->slug) }}">
            <img
                class="img-responsive"
                src="{{ asset($series->image) }}" alt="">
            <div class="card__overlay">
                <i class="fa fa-play-circle-o"></i>
            </div>
        </a>
    </div>
    <div class="card__details">
        <ul class="card__category">
            @foreach ($series->categories as $category)
                <li class="label label--other label--{{ $category->name }}">{{ $category->name }}</li>
            @endforeach
        </ul>
        <h3 class="card__title">
            <a href="{{ route('series.show', $series->slug) }}" class="card__title--a">{{ $series->title }}</a>
        </h3>
    </div>
</div>
