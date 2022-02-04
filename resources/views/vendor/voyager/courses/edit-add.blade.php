@php
$edit = !is_null($dataTypeContent->getKey());
$add = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.' . ($edit ? 'edit' : 'add')) . ' ' .
  $dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
  <h1 class="page-title">
    <i class="{{ $dataType->icon }}"></i>
    {{ __('voyager::generic.' . ($edit ? 'edit' : 'add')) .' ' .$dataType->getTranslatedAttribute('display_name_singular') }}
  </h1>
  @include('voyager::multilingual.language-selector')
@stop

@section('content')
  <div class="page-content edit-add container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-bordered">
          {{-- <div class="form-group col-md-12">
                        @include('vendor.voyager.courses.partials.edit-add-form', [
                            'formIndex' => 'One',
                            'dataType' => $dataType,
                            'dataTypeContent' => $dataTypeContent,
                            'edit' => $edit,
                            'add' => $add,
                            'errors' => $errors,
                        ])

                    </div> --}}

          <!-- form start -->
          <form role="form" class="form-edit-add" id="form-tag" autocomplete="off"
            action="{{ $edit? route('voyager.' . $dataType->slug . '.update', $dataTypeContent->getKey()): route('voyager.' . $dataType->slug . '.store') }}"
            method="POST" enctype="multipart/form-data">
            <!-- PUT Method if we are editing -->
            @if ($edit)
              {{ method_field('PUT') }}
            @endif

            <!-- CSRF TOKEN -->
            {{ csrf_field() }}

            <div class="panel-body">

              <div class="form-group col-md-12">
                <div class="row progress">
                  <div class="bar"></div>
                  <div class="percent">0%</div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-12" style="color: black;">
                    Status: <span class="status"></span>
                  </div>
                  <div class="col-md-6 col-sm-12" style="color: black;">
                    Remaining Time: <span class="remainingTime"></span>
                  </div>
                  <div class="col-md-6 col-sm-12" style="color: black;">
                    Upload Speed: <span class="uploadSpeed"></span>
                  </div>
                  <div class="col-md-6 col-sm-12" style="color: black;">
                    Uploaded: <span class="uploaded"></span>
                  </div>
                </div>
              </div>

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

                <div
                  class="form-group @if ($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }}
                  {{ $errors->has($row->field) ? 'has-error' : '' }}"
                  @if (isset($display_options->id)){{ "id=$display_options->id" }}@endif>
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

            <div class="form-group  col-md-12">
                <label for="sendMessageToDemandUsers">Send Message To Demand Users</label>
                <input type="text" class="form-control" id="sendMessageToDemandUsers" name="sendMessageToDemandUsers">
            </div>

              @if (!$edit)
                <div class="form-group col-md-12">
                  <label for="sendMessageToPaidUsers">
                    <input class="form-check-input" id="sendMessageToPaidUsers" type="checkbox"
                      name="sendMessageToPaidUsers" />
                    Send Message To Paid Users
                  </label>
                </div>
              @endif
              <div class="form-group col-md-12">
                <div class="row progress" style="height: 25px;">
                  <div class="bar"></div>
                  <div class="percent">0%</div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-12" style="color: black;">
                    Status: <span class="status"></span>
                  </div>
                  <div class="col-md-6 col-sm-12" style="color: black;">
                    Remaining Time: <span class="remainingTime"></span>
                  </div>
                  <div class="col-md-6 col-sm-12" style="color: black;">
                    Upload Speed: <span class="uploadSpeed"></span>
                  </div>
                  <div class="col-md-6 col-sm-12" style="color: black;">
                    Uploaded: <span class="uploaded"></span>
                  </div>
                </div>
              </div>

            </div>
            <!-- panel-body -->

            <div class="panel-footer">
            @section('submit-buttons')
              <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
            @stop
            @yield('submit-buttons')
          </div>
        </form>

        <iframe id="form_target" name="form_target" style="display:none"></iframe>
        <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
          enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
          <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
          <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
          {{ csrf_field() }}
        </form>

      </div>
    </div>
  </div>
</div>

<div class="modal fade modal-danger" id="confirm_delete_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
      </div>

      <div class="modal-body">
        <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default"
          data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
        <button type="button" class="btn btn-danger"
          id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
      </div>
    </div>
  </div>
</div>
<!-- End Delete File Modal -->
@stop

@section('javascript')
<script src="{{ asset('js/jquery.form.js') }}"></script>
<script src="{{ asset('js/queue.js') }}"></script>
<script>
  var params = {};
  var $file;

  function deleteHandler(tag, isMulti) {
    return function() {
      $file = $(this).siblings(tag);

      params = {
        slug: '{{ $dataType->slug }}',
        filename: $file.data('file-name'),
        id: $file.data('id'),
        field: $file.parent().data('field-name'),
        multi: isMulti,
        _token: '{{ csrf_token() }}'
      }

      $('.confirm_delete_name').text(params.filename);
      $('#confirm_delete_modal').modal('show');
    };
  }

  $('document').ready(function() {
    $('.toggleswitch').bootstrapToggle();

    //Init datepicker for date fields if data-datepicker attribute defined
    //or if browser does not handle date inputs
    $('.form-group input[type=date]').each(function(idx, elt) {
      if (elt.hasAttribute('data-datepicker')) {
        elt.type = 'text';
        $(elt).datetimepicker($(elt).data('datepicker'));
      } else if (elt.type != 'date') {
        elt.type = 'text';
        $(elt).datetimepicker({
          format: 'L',
          extraFormats: ['YYYY-MM-DD']
        }).datetimepicker($(elt).data('datepicker'));
      }
    });

    @if ($isModelTranslatable)
      $('.side-body').multilingual({"editing": true});
    @endif

    $('.side-body input[data-slug-origin]').each(function(i, el) {
      $(el).slugify();
    });

    $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
    $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
    $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
    $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

    $('#confirm_delete').on('click', function() {
      $.post('{{ route('voyager.' . $dataType->slug . '.media.remove') }}', params, function(response) {
        if (response &&
          response.data &&
          response.data.status &&
          response.data.status == 200) {

          toastr.success(response.data.message);
          $file.parent().fadeOut(300, function() {
            $(this).remove();
          })
        } else {
          toastr.error("Error removing file.");
        }
      });

      $('#confirm_delete_modal').modal('hide');
    });
    $('[data-toggle="tooltip"]').tooltip();
  });
  $('document').ready(function() {
    // function validate(formData, jqForm, options) {
    //     // var form = jqForm[0];
    //     // if (!form.exerciseFile.value) {
    //     //     alert('File not found');
    //     //     return false;
    //     // }
    // }

    function formatBytes(a, b = 2) {
      if (0 === a) return "0 Bytes";
      const c = 0 > b ? 0 : b,
        d = Math.floor(Math.log(a) / Math.log(1024));
      return (
        parseFloat((a / Math.pow(1024, d)).toFixed(c)) +
        " " + ["Bytes", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"][d]
      );
    }

    function formatSeconds(seconds) {
      seconds = Number(seconds);
      var d = Math.floor(seconds / (3600 * 24));
      var h = Math.floor(seconds % (3600 * 24) / 3600);
      var m = Math.floor(seconds % 3600 / 60);
      var s = Math.floor(seconds % 60);

      var dDisplay = d > 0 ? d + (d == 1 ? " day, " : " days, ") : "";
      var hDisplay = h > 0 ? h + (h == 1 ? " hour, " : " hours, ") : "";
      var mDisplay = m > 0 ? m + (m == 1 ? " minute, " : " minutes, ") : "";
      var sDisplay = s > 0 ? s + (s == 1 ? " second" : " seconds") : "";

      if (d > 0) {
        return dDisplay + hDisplay + mDisplay;
      }

      return hDisplay + mDisplay + sDisplay;
    }

    function ajax_form_init() {
      var bars = $('.bar');
      if (bars.length === 0)
        return;

      var percents = $('.percent');
      var status = $('.status');
      var remainingTimeDisplay = $('.remainingTime');
      var uploadSpeed = $('.uploadSpeed');
      var uploaded = $('.uploaded');
      var started_at;

      /*
                      var form = document.getElementById('form-tag');
                      var xhr = new XMLHttpRequest();
                      xhr.upload.onprogress = (e) => {
                          var uploaded_bytes = e.position || e.loaded, total_bytes = e.totalSize || e.total;
                          var percentComplete = (uploaded_bytes / total_bytes * 100).toFixed(2);
                          var percentVal = percentComplete + '%';
                          bars.width(percentVal);
                          percents.html(percentVal);
                          var seconds_elapsed = (new Date().getTime() - started_at.getTime()) / 1000;
                          var bytes_per_second = seconds_elapsed ? uploaded_bytes / seconds_elapsed : 0;
                          var Kbytes_per_second =  formatBytes(bytes_per_second) + '/s';
                          var remaining_bytes = total_bytes - uploaded_bytes;
                          var seconds_remaining = seconds_elapsed ? formatSeconds(remaining_bytes / bytes_per_second) : 'calculating';
                          // seconds_remaining = formatSeconds(seconds_remaining);
                          uploadSpeed.html(Kbytes_per_second);
                          remainingTimeDisplay.html(seconds_remaining);
                          status.text('Uploading');
                          uploaded.html(formatBytes(uploaded_bytes) + '/' + formatBytes(total_bytes));
                          // console.log('xhr.upload progress: ' + done + ' / ' + total + ' = ' + (Math.floor(done/total*1000)/10) + '%');
                      };

                      xhr.upload.onload = (e) =>  {
                          console.log('xhr load', e);
                          // var percentVal = 'Finishing ...';
                          // bars.width('100%')
                          // percents.html(percentVal);
                          // status.text(percentVal);
                          // $(uploaded.parentNode).empty();
                      }

                      xhr.onreadystatechange = () => {
                          console.log("xhr", xhr);

                          if (xhr.readyState === 4) {
                              if(xhr.status === 200){
                                  var res = JSON.parse(xhr.responseText);

                                  var alert_message;
                                  var alert_type;
                                  // var res = xhr.responseJSON;

                                  if (res) {
                                      if(res.success){
                                          alert_type = 'success';
                                          alert_message = 'just _tagging';
                                      } else {
                                          alert_type = res["alert-type"];
                                          alert_message = res.message;
                                      }
                                  } else {
                                      alert_type = "error";
                                      alert_message ="something went wrong!!!";
                                  }

                                  percents.html('Done');
                                  uploadSpeed.html('#');
                                  remainingTimeDisplay.html('#');
                                  status.text(alert_message);

                                  // helpers.displayAlerts({
                                  //     type: alert_type,
                                  //     message: alert_message,
                                  // }, toastr);
                                  if(alert_type === 'success')
                                      toastr.success(alert_message, {timeOut: 20000});
                                  else
                                      toastr.error(alert_message, {timeOut: 20000});
                              }
                              else{
                                  toastr.error("Error: " + xhr.statusText + "\n" +
                                              "Code: " + xhr.status);
                                  // helpers.displayAlerts({
                                  //     type: alert_type,
                                  //     message: alert_message,
                                  // }, toastr);
                              }
                          }
                      }

                      xhr.upload.onerror = (e) => {
                          console.log("error", e);
                      }
                      xhr.upload.onabort = () => {
                          console.log('aborted');
                      }

                      var serialize = function (form) {
                          var field,
                              l,
                              s = [];
                              // s = {};

                          if (typeof form == 'object' && form.nodeName == "FORM") {
                              var len = form.elements.length;

                              for (var i = 0; i < len; i++) {
                                  field = form.elements[i];
                                  if (field.name && !field.disabled && field.type != 'button' && field.type != 'file' && field.type != 'hidden' && field.type != 'reset' && field.type != 'submit') {
                                      if (field.type == 'select-multiple') {
                                          l = form.elements[i].options.length;

                                          for (var j = 0; j < l; j++) {
                                              if (field.options[j].selected) {
                                                  // s[encodeURIComponent(field.name)] = encodeURIComponent(field.options[j].value);
                                                  s[s.length] = encodeURIComponent(field.name) + "=" + encodeURIComponent(field.options[j].value);
                                              }
                                          }
                                      }
                                      else if ((field.type != 'checkbox' && field.type != 'radio') || field.checked) {
                                          // s[encodeURIComponent(field.name)] = encodeURIComponent(field.value);
                                          s[s.length] = encodeURIComponent(field.name) + "=" + encodeURIComponent(field.value);
                                      }
                                  }
                              }
                          }

                          // return s;
                          return s.join('&').replace(/%20/g, '+');
                      };

                      form.onsubmit = (event) => {
                          event.preventDefault();

                          toastr.warning('start uploading', {timeOut: 20000});

                          // var formData = new FormData(form);
                          // console.log("formData", formData);
                          var sr = serialize(form);
                          console.log("sr1", sr);
                          // sr = JSON.stringify(sr);
                          // console.log("sr2", sr);

                          xhr.open(form.method, form.action, true);
                          // xhr.open(form.method, form.getAttribute('action'), true);
                          started_at = new Date();
                          xhr.send(sr);
                          // xhr.send(formData);

                          return false; // To avoid actual submission of the form
                      }

      */
      $('form').ajaxForm({
        // beforeSubmit: validate,
        // clearForm: true,
        // dataType: 'json',
        beforeSend: function() {
          // TODO: disable all inputs
          // $('form :input').prop("disabled", true);
          status.empty();
          var percentVal = '0%';
          bars.width(percentVal);
          percents.html(percentVal);
          started_at = new Date();
        },
        uploadProgress: function(event, uploaded_bytes, total_bytes, percentComplete) {
          if (bars.length === 0)
            return;
          var percentVal = (uploaded_bytes / total_bytes * 100).toFixed(2) + '%';
          bars.width(percentVal)
          percents.html(percentVal);

          var seconds_elapsed = (new Date().getTime() - started_at.getTime()) / 1000;
          var bytes_per_second = seconds_elapsed ? uploaded_bytes / seconds_elapsed : 0;
          var Kbytes_per_second = formatBytes(bytes_per_second);
          var remaining_bytes = total_bytes - uploaded_bytes;
          var seconds_remaining = seconds_elapsed ? remaining_bytes / bytes_per_second : 'calculating';
          seconds_remaining = formatSeconds(seconds_remaining);

          uploadSpeed.html(Kbytes_per_second);
          remainingTimeDisplay.html(seconds_remaining);
          status.text('Uploading');
          uploaded.html(formatBytes(uploaded_bytes) + '/' + formatBytes(total_bytes));
        },
        success: function() {
          if (bars.length === 0)
            return;
          var percentVal = 'Finishing ...';

          bars.width('100%')
          percents.html(percentVal);
          status.text(percentVal);
          $(uploaded.parentNode).empty();
        },
        complete: function(xhr) {
          var alert_message;
          var alert_type;

          console.log("xhr", xhr);
          var res = xhr.responseJSON;
          // var res = JSON.parse(xhr.responseText);

          if (res) {
            if (res.success) {
              alert_type = 'success';
              alert_message = 'just _tagging';
            } else {
              alert_type = res["alert-type"];
              alert_message = res.message;
            }
          } else {
            alert_type = "error";
            alert_message = "something went wrong";
          }

          percents.html('Done');
          uploadSpeed.html('#');
          remainingTimeDisplay.html('#');
          status.text(alert_message);

          // helpers.displayAlerts({
          //     type: alert_type,
          //     message: alert_message,
          // }, toastr);

          if (alert_type === 'success') {
            toastr.success(alert_message, {
              timeOut: 200000
            });
            setTimeout(() => {
              window.location.reload(true);
            }, 1500);
          } else {
            toastr.error(alert_message, {
              timeOut: 200000
            });
          }
          // TODO: remove the form

        }
      });

    }
    ajax_form_init();

  });
</script>
@stop
