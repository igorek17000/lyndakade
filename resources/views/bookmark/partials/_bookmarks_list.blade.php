<div class="row no-gutters"
     onclick="location.href ='{{ route('bookmark.show', $bookmark->id) }}';">
    <div class="col-md-4 align-self-center list-item-img">
        <img src="{{ asset($bookmark->bookmark_parts[0]->course->img) }}"
             class="card-img" alt="image">
    </div>
    <div class="col-md-8">
        <div class="card-body">
            <h5 class="card-title bookmark-title">{{ $bookmark->title }}</h5>
            <p class="card-text"><small>{{ $bookmark->partNumbers }} قسمت</small>
            </p>
        </div>
    </div>
</div>
