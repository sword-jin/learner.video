<div class="right-category">
    <h4>视频分类</h4>
    <div class="category__wrapper">
        <ul class="list-group">
            @foreach ($category->getCategories() as $category)
                <a href="#" class="list-group-item list--item__link">
                    {{ $category->name }}
                </a>
            @endforeach
        </ul>
    </div>
</div>
