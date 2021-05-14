<div class="card" id="form{{ $formIndex }}">
  <div class="card-header" id="heading{{ $formIndex }}">
    {{-- <div class="row progress" style="margin: 0;">
      <div class="bar"></div>
      <div class="percent">0%</div>
    </div> --}}
    <h5 class="mb-0">
      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{ $formIndex }}"
        aria-expanded="false" aria-controls="collapse{{ $formIndex }}">
        Toggle
      </button>
    </h5>
  </div>
  <style>
    /* .collapse form input {
      display: inline;
    } */

  </style>
  <div id="collapse{{ $formIndex }}" class="collapse show" aria-labelledby="heading{{ $formIndex }}"
    data-parent="#form-parent">
    <div class="card-body">
        <!-- form start -->
        <form role="form" class="form-edit-add"
            action="{{ $edit ? route('voyager.' . $dataType->slug . '.update', $dataTypeContent->getKey()) : route('voyager.' . $dataType->slug . '.store') }}"
            method="POST" enctype="multipart/form-data">
            <!-- PUT Method if we are editing -->
            @if ($edit)
            {{ method_field('PUT') }}
            @endif

            <!-- CSRF TOKEN -->
            {{ csrf_field() }}

            <div class="panel-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                </div>
            @endif

            <!-- Adding / Editing -->
            @php
                $dataTypeRows = $dataType->{$edit ? 'editRows' : 'addRows'};
            @endphp

            @foreach ($dataTypeRows as $row)
                <!-- GET THE DISPLAY OPTIONS -->
                @php
                $display_options = $row->details->display ?? null;
                if ($dataTypeContent->{$row->field . '_' . ($edit ? 'edit' : 'add')}) {
                    $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field . '_' . ($edit ? 'edit' : 'add')};
                }
                @endphp
                @if (isset($row->details->legend) && isset($row->details->legend->text))
                <legend class="text-{{ $row->details->legend->align ?? 'center' }}"
                    style="background-color: {{ $row->details->legend->bgcolor ?? '#f0f0f0' }};padding: 5px;">
                    {{ $row->details->legend->text }}</legend>
                @endif

                <div class="form-group @if ($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }}
                {{ $errors->has($row->field) ? 'has-error' : '' }}" @if (isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                {{ $row->slugify }}
                <label class="control-label" for="name">{{ $row->getTranslatedAttribute('display_name') }}</label>
                @include('voyager::multilingual.input-hidden-bread-edit-add')
                @if (isset($row->details->view))
                    @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' =>
                    $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => ($edit ? 'edit' : 'add'),
                    'view' => ($edit ? 'edit' : 'add'), 'options' => $row->details])
                @elseif ($row->type == 'relationship')
                    @include('voyager::formfields.relationship', ['options' => $row->details])
                @else
                    {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                @endif

                @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                    {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                @endforeach
                @if ($errors->has($row->field))
                    @foreach ($errors->get($row->field) as $error)
                    <span class="help-block">{{ $error }}</span>
                    @endforeach
                @endif
                </div>
            @endforeach

            {{-- </div>
            <!-- panel-body -->

            <div class="panel-footer"> --}}
            @section('submit-buttons')
                <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
            @stop
            @yield('submit-buttons')
            </div>
        </form>
    </div>
  </div>
</div>
