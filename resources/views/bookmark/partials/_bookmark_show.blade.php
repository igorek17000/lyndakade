@foreach($bookmark_parts as $part)
    <div class="row no-gutters"
         onclick="location.href ='{{ courseURL($part->course) }}';">
        <div class="col-md-1 align-self-center list-item-img">
            <p class="card-text">{{ explode(' ' ,$part->course->title)[0] }}</p>
        </div>
        <div class="col-md-3 align-self-center list-item-img">
            <img src="{{ asset($part->course->img) }}" class="card-img" alt="image">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title bookmark-title">{{ $part->course->title }}</h5>
                <p class="card-body">{{ $part->course->description }}</p>
            </div>
        </div>
    </div>
    @if($bookmark_parts->last()->id != $part->id)
        <hr class="my-1">
    @endif
@endforeach
