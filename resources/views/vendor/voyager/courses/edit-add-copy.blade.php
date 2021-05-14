@php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered" id="form-parent">

                    @include('vendor.voyager.courses.partials.edit-add-form', [
                        'formIndex' => 'One',
                        // 'formIndex' => $formIndex,
                        'edit' => $edit,
                        'dataType' => $dataType,
                        'dataTypeContent' => $dataTypeContent,
                        'errors' => $errors,
                    ])

                    @include('vendor.voyager.courses.partials.edit-add-form', [
                        'formIndex' => 'Two',
                        // 'formIndex' => $formIndex,
                        'edit' => $edit,
                        'dataType' => $dataType,
                        'dataTypeContent' => $dataTypeContent,
                        'errors' => $errors,
                    ])

                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                            enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file"
                                 onchange="$('#my_form').submit();this.value='';">
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
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
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
                slug:   '{{ $dataType->slug }}',
                filename:  $file.data('file-name'),
                id:     $file.data('id'),
                field:  $file.parent().data('field-name'),
                multi: isMulti,
                _token: '{{ csrf_token() }}'
            }

            $('.confirm_delete_name').text(params.filename);
            $('#confirm_delete_modal').modal('show');
          };
        }

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                } else if (elt.type != 'date') {
                    elt.type = 'text';
                    $(elt).datetimepicker({
                        format: 'L',
                        extraFormats: [ 'YYYY-MM-DD' ]
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

            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.'.$dataType->slug.'.media.remove') }}', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });

        var forms = new Queue();


        $('document').ready(function() {
            // function validate(formData, jqForm, options) {
            //     // var form = jqForm[0];
            //     // if (!form.exerciseFile.value) {
            //     //     alert('File not found');
            //     //     return false;
            //     // }
            // }

            function setValueForItems(listItems, value) {
                listItems.forEach(el => {
                    el.innerHTML = value;
                });
            }

            function setWidthForItems(listItems, widthPercent) {
                listItems.forEach(el => {
                    el.style.width = widthPercent;
                });
            }

            function ajax_form_init(formElement) {

                var bars = formElement.querySelectorAll('.bar');
                // var bar = $('.bar');
                if (bars.length === 0)
                    return;

                var percents = formElement.querySelectorAll('.percent');
                var status = formElement.querySelectorAll('#status');
                var remainingTimeDisplay = formElement.querySelectorAll('#remainingTime');
                var uploadSpeed = formElement.querySelectorAll('#uploadSpeed');
                var uploaded = formElement.querySelectorAll('#uploaded');

                var started_at;
                $(formElement).ajaxForm({
                    // beforeSubmit: validate,
                    clearForm: true,
                    dataType: 'json',
                    beforeSend: function () {

                        // TODO: disable all inputs
                        // $('form :input').prop("disabled", true);

                        status.empty();
                        var percentVal = '0%';
                        // var posterValue = $('input[name=exerciseFile]').fieldValue();

                        // bar.width(percentVal);
                        setWidthForItems(bars, percentVal);

                        // percent.html(percentVal);
                        setValueForItems(percents, percentVal);

                        started_at = new Date();
                    },
                    uploadProgress: function (event, uploaded_bytes, total_bytes, percentComplete) {
                        if (bar.length === 0)
                            return;
                        var percentVal = percentComplete + '%';

                        // bar.width(percentVal)
                        setWidthForItems(bars, percentVal);

                        // percent.html(percentVal);
                        setValueForItems(percents, percentVal);

                        var seconds_elapsed = (new Date().getTime() - started_at.getTime()) / 1000;
                        var bytes_per_second = seconds_elapsed ? uploaded_bytes / seconds_elapsed : 0;
                        var Kbytes_per_second = bytes_per_second / 1024;
                        Kbytes_per_second = Math.round(Kbytes_per_second);
                        var remaining_bytes = total_bytes - uploaded_bytes;
                        var seconds_remaining = seconds_elapsed ? remaining_bytes / bytes_per_second : 'calculating';
                        seconds_remaining = Math.round(seconds_remaining);

                        // uploadSpeed.html(Kbytes_per_second + ' Kb/s');
                        setValueForItems(uploadSpeed, Kbytes_per_second + ' Kb/s');

                        // remainingTimeDisplay.html(seconds_remaining + ' seconds');
                        setValueForItems(remainingTimeDisplay, seconds_remaining + ' seconds');

                        // status.text('Uploading');
                        setValueForItems(status, 'Uploading');

                        // uploaded.html(uploaded_bytes + '/' + total_bytes);
                        setValueForItems(uploaded, uploaded_bytes + '/' + total_bytes);
                    },
                    success: function () {
                        if (bar.length === 0)
                            return;
                        var percentVal = 'Finishing ...';

                        // bar.width(percentVal)
                        setWidthForItems(bars, '100%');

                        // percent.html(percentVal);
                        setValueForItems(percents, percentVal);

                        // status.text(percentVal);
                        setValueForItems(status, percentVal);

                        $(uploaded.parentNode).empty();
                    },
                    complete: function (xhr) {
                        var alert_message;
                        var alert_type;

                        console.log("xhr", xhr);
                        var res = xhr.responseJSON;
                        // var res = JSON.parse(xhr.responseText);

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
                            alert_message ="something went wrong: " + res.exception;
                        }

                        // percent.html('Done');
                        setValueForItems(percents, 'Done');

                        // uploadSpeed.html('#');
                        setValueForItems(uploadSpeed, '#');

                        // remainingTimeDisplay.html('#');
                        setValueForItems(remainingTimeDisplay, '#');

                        status.text(alert_message);
                        setValueForItems(status, alert_message);

                        helpers.displayAlerts({
                            type: alert_type,
                            message: alert_message,
                        }, toastr);

                        // TODO: remove the form
                    }
                });
            }
            document.querySelectorAll('.panel div[id*="form"]').forEach(formEl => {
                console.log(formEl.id);
                ajax_form_init(formEl);
            });
        });
    </script>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        for(var item of $('textarea')){
            var selector = 'textarea[name="' + item.name + '"]';
            tinymce.init({
                selector: selector,
            });
            // console.log(item.name);
        }
    </script>
@stop
