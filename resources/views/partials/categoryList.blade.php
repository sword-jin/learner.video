@inject('category', 'Learner\Services\Layouts\Category')

<div class="right-category">
    <h4>视频分类</h4>
    <div class="category__wrapper">
        <ul class="list-group">
            @foreach ($category->getCategories() as $category)
                <a href="{{ route('category', $category->name) }}" class="list-group-item list--item">
                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" width="30">
                    <span>{{ $category->name }}</span>
                    <span class="label label--other label--{{$category->name}} pull-right">
                        {{ count($category->series) }}
                    </span>
                </a>
            @endforeach
        </ul>
    </div>
</div>
