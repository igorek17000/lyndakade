@extends('layouts.admin', ['page' => __('Add New Course'), 'pageSlug' => 'course.add'])

@section('content')
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h5 class="title">{{ __('Add New Course') }}</h5>
        </div>
        <form method="post" action="{{ route('courses.store') }}" autocomplete="off" enctype="multipart/form-data">
          <div class="card-body">
            @csrf
            {{-- @include('alerts.success') --}}

            <div class="form-row form-group">
              <div class="col-md-6{{ $errors->has('title') ? ' has-danger' : '' }}">
                <label>{{ __('Title') }}</label>
                <input type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Title') }}" value="{{ old('title') }}">
                @include('alerts.feedback', ['field' => 'title'])
              </div>
              <div class="col-md-6{{ $errors->has('titleEnglish') ? ' has-danger' : '' }}">
                <label>{{ __('Title English') }}</label>
                <input type="text" name="titleEnglish"
                  class="form-control{{ $errors->has('titleEnglish') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Title English') }}" value="{{ old('titleEnglish') }}">
                @include('alerts.feedback', ['field' => 'titleEnglish'])

              </div>
            </div>

            <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
              <label>{{ __('Description') }}</label>
              <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                rows="7" type="text" name="description" autocomplete="description"
                placeholder="{{ __('Description') }}">{{ old('description') }}</textarea>
              @include('alerts.feedback', ['field' => 'description'])
            </div>

            <div class="form-group{{ $errors->has('descriptionEnglish') ? ' has-danger' : '' }}">
              <label>{{ __('Description English') }}</label>
              <textarea id="descriptionEnglish"
                class="form-control{{ $errors->has('descriptionEnglish') ? ' is-invalid' : '' }}" rows="7" type="text"
                name="descriptionEnglish" autocomplete="descriptionEnglish"
                placeholder="{{ __('Description English') }}">{{ old('descriptionEnglish') }}</textarea>
              @include('alerts.feedback', ['field' => 'descriptionEnglish'])
            </div>

            <div class="form-row form-group">
              <div class="col-md-6{{ $errors->has('subjects') ? ' has-danger' : '' }}">
                <label>{{ __('Subjects') }}</label>
                <input type="text" name="subjects" id="subjects" data-role="tagsinput"
                  class="form-control{{ $errors->has('subjects') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Subjects') }}">
                @include('alerts.feedback', ['field' => 'subjects'])
              </div>
              <div class="col-md-6{{ $errors->has('software') ? ' has-danger' : '' }}">
                <label>{{ __('Software') }}</label>
                <input type="text" name="software" id="software" data-role="tagsinput"
                  class="form-control{{ $errors->has('software') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Software') }}">
                @include('alerts.feedback', ['field' => 'software'])
              </div>

            </div>

            <div class="form-row form-group">
              <div class="col-md-6{{ $errors->has('author') ? ' has-danger' : '' }}">
                <label>{{ __('Author') }}</label>
                <input type="text" name="author" id="author" data-role="tagsinput"
                  class="form-control{{ $errors->has('author') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Author') }}">
                @include('alerts.feedback', ['field' => 'author'])
              </div>
              <div class="col-md-6">
                <label for="skillLevel">Skill Level</label>
                <select class="form-control" id="skillLevel" name="skillLevel">
                  <option style="color: #0f0f0f">Beginner</option>
                  <option style="color: #0f0f0f">Intermediate</option>
                  <option style="color: #0f0f0f">Advanced</option>
                </select>
              </div>
            </div>

            <div class="form-row form-group">
              <div class="col">
                <label>{{ __('Price') }}</label>
                <input type="number" name="price" id="price" min="0"
                  class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Price') }}" value="{{ old('price', 0) }}">
                @include('alerts.feedback', ['field' => 'price'])
              </div>
              <div class="col">
                <label>{{ __('Price Off Percent') }}</label>
                <input type="number" min="0" max="100" name="priceOffPercent" id="priceOffPercent"
                  class="form-control{{ $errors->has('priceOffPercent') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Price Off Percent') }}" value="{{ old('priceOffPercent', 0) }}">
                @include('alerts.feedback', ['field' => 'priceOffPercent'])
              </div>
              <div class="col">
                <label>{{ __('Number Of Courses') }}</label>
                <input type="number" min="1" name="partNumbers" id="partNumbers"
                  class="form-control{{ $errors->has('partNumbers') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Number Of Courses') }}" value="{{ old('partNumbers', 1) }}">
                @include('alerts.feedback', ['field' => 'partNumbers'])
              </div>
            </div>

            <div class="form-row form-group">
              <div class="col-md-3{{ $errors->has('logo') ? ' has-danger' : '' }}">
                <label>{{ __('Select Logo') }}</label>
                <input type="file" name="logo" class="form-control{{ $errors->has('logo') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Select Logo') }}" value="{{ old('logo') }}">
                @include('alerts.feedback', ['field' => 'logo'])
              </div>
              <div class="col-md-3{{ $errors->has('courseFile') ? ' has-danger' : '' }}">
                <label>{{ __('Select Course File') }}</label>
                <input type="file" name="courseFile"
                  class="form-control{{ $errors->has('courseFile') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Select Course File') }}" value="{{ old('courseFile') }}">
                @include('alerts.feedback', ['field' => 'courseFile'])
              </div>
              <div class="col-md-3{{ $errors->has('previewFile') ? ' has-danger' : '' }}">
                <label>{{ __('Select Preview File') }}</label>
                <input type="file" name="previewFile"
                  class="form-control{{ $errors->has('previewFile') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Select Preview File') }}" value="{{ old('previewFile') }}">
                @include('alerts.feedback', ['field' => 'previewFile'])
              </div>
              <div class="col-md-3{{ $errors->has('exerciseFile') ? ' has-danger' : '' }}">
                <label>{{ __('Select Exercise File') }}</label>
                <input type="file" name="exerciseFile" {{-- required --}}
                  class="form-control{{ $errors->has('exerciseFile') ? ' is-invalid' : '' }}"
                  placeholder="{{ __('Select Exercise File') }}" value="{{ old('exerciseFile') }}">
                @include('alerts.feedback', ['field' => 'exerciseFile'])
              </div>
            </div>

          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-fill btn-primary">{{ __('Publish') }}</button>
          </div>
        </form>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card card-user">
        <div class="card-body">
          <div class="card-text">
            <div class="author">
              <div class="block block-one"></div>
              <div class="block block-two"></div>
              <div class="block block-three"></div>
              <div class="block block-four"></div>
              <a href="#">
                <img class="avatar" src="{{ asset('black/img/emilyz.jpg') }}" alt="">
                <h5 class="title">{{ auth()->user()->name }}</h5>
              </a>
              <p class="description">
                {{ __('Ceo/Co-Founder') }}
              </p>
            </div>
          </div>
          <div class="card-description">
            {{ __('Do not be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...') }}
          </div>
        </div>
        <div class="card-footer">
          <div class="button-container">
            <button class="btn btn-icon btn-round btn-facebook">
              <i class="fab fa-facebook"></i>
            </button>
            <button class="btn btn-icon btn-round btn-twitter">
              <i class="fab fa-twitter"></i>
            </button>
            <button class="btn btn-icon btn-round btn-google">
              <i class="fab fa-google-plus"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('js')
  <script type="text/javascript">
    function fill_tags(element, data_list) {
      var data = [];
      for (let i = 0; i < data_list.length; i++) {
        item = {};
        item.value = data_list[i].id;
        if (data_list[i].title)
          item.text = data_list[i].title;
        else
          item.text = data_list[i].name;
        data.push(item);
      }

      var task = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace("text"),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: data
      });

      task.initialize();

      element.tagsinput({
        itemValue: "value",
        itemText: "text",
        typeaheadjs: {
          name: "task",
          displayKey: "text",
          source: task.ttAdapter()
        }
      });

      //insert data to input in load page
      // element.tagsinput("add", data[0]);
    }

    var subjects = {!! json_encode(\App\Subject::all()->toArray()) !!};
    fill_tags($('#subjects'), subjects);
    var software = {!! json_encode(\App\Software::all()->toArray()) !!};
    fill_tags($('#software'), software);
    var authors = {!! json_encode(\App\Author::all()->toArray()) !!};
    fill_tags($('#author'), authors);

  </script>
@endpush
