<div class="col-xs-12 col-sm-4">
    <div class="author-card">
        <img src="#" data-src="{{ fromDLHost($author->img) }}" class="lazyload">
        <div class="author-details">
            <h4>{{ $author->name }}</h4>
            <p>{{ $author->description }}</p>
        </div>
        <a class="author-link ga" href="{{ route('authors.show', [$author->slug, $author->id]) }}">
            <span>مشاهده پروفایل
                <i class="lyndacon arrow-left"></i>
            </span>
        </a>
    </div>
</div>
