/*
load tags in course add
 */
function get_data(url) {
    return $.parseJSON($.ajax({
        url: url,
        method: 'POST',
        dataType: "json",
        async: false,
        data: {id: 0, _token: $('input[name="_token"]').val()},
        error: function (xhr, status, error) {
            let msg = {
                xhr: xhr,
                status: status,
                error: error,
            };
            console.log(msg);
        },
    }).responseText);
}

function tags_init(element, data) {
    let task = new Bloodhound({
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
}

let subject_tag = $('#subjects-tags');
if (subject_tag.length > 0) {
    tags_init(subject_tag, get_data('/dashboard/subject/get-all'));
}

let software_tag = $('#software-tags');
if (software_tag.length > 0) {
    tags_init(software_tag, get_data('/dashboard/software/get-all'));
}

let author_tag = $('#author-tags');
if (author_tag.length > 0) {
    tags_init(author_tag, get_data('/dashboard/author/get-all'));
}

let course_tag = $('#courses-tags');
if (course_tag.length > 0) {
    tags_init(course_tag, get_data('/dashboard/course/get-all'));
}

let library_tag = $('#library-tags');
if (library_tag.length > 0) {
    tags_init(library_tag, get_data('/dashboard/library/get-all'));
}


/*
upload ajaxForm
 */

function showNotify(text, time) {
    $.notify(
        {
            icon: "tim-icons icon-bell-55",
            message: text,
        }, {
            type: type[1],
            timer: time,
            placement: {
                from: 'bottom',
                align: 'right'
            }
        }
    );
}

function validate(formData, jqForm, options) {
    // var form = jqForm[0];
    // if (!form.exerciseFile.value) {
    //     alert('File not found');
    //     return false;
    // }
}

$(function () {
    var bar = $('.bar');
    if (bar.length === 0)
        return;
    var percent = $('.percent');
    var status = $('#status');
    var remainingTimeDisplay = $('#remainingTime');
    var uploadSpeed = $('#uploadSpeed');
    var started_at;
    $('form').ajaxForm({
        beforeSubmit: validate,
        clearForm: true,
        dataType: 'json',
        beforeSend: function () {
            status.empty();
            var percentVal = '0%';
            // var posterValue = $('input[name=exerciseFile]').fieldValue();
            bar.width(percentVal)
            percent.html(percentVal);
            started_at = new Date();
        },
        uploadProgress: function (event, position, total, percentComplete) {
            if (bar.length === 0)
                return;
            var percentVal = percentComplete + '%';
            bar.width(percentVal)
            percent.html(percentVal);

            var seconds_elapsed = (new Date().getTime() - started_at.getTime()) / 1000;
            var bytes_per_second = seconds_elapsed ? position / seconds_elapsed : 0;
            var Kbytes_per_second = bytes_per_second / 1024;
            Kbytes_per_second = Math.round(Kbytes_per_second);
            var remaining_bytes = total - position;
            var seconds_remaining = seconds_elapsed ? remaining_bytes / bytes_per_second : 'calculating';
            seconds_remaining = Math.round(seconds_remaining);

            uploadSpeed.html(Kbytes_per_second + ' Kb/s');
            remainingTimeDisplay.html(seconds_remaining + ' seconds');
            status.text('Uploading');
        },
        success: function () {
            if (bar.length === 0)
                return;
            var percentVal = 'Finishing ...';
            bar.width(percentVal)
            percent.html(percentVal);
            status.text(percentVal);
        },
        complete: function (xhr) {
            // console.log(xhr);
            var percentVal;

            // alert(xhr.responseText);
            var res = JSON.parse(xhr.responseText);

            if (res.exception) {
                showNotify(res.exception, 5000)
                percentVal = 'something went wrong: ' + res.exception;
            } else {
                showNotify(res.status, 5000)
                percentVal = 'Uploaded';
            }
            percent.html(percentVal);
            uploadSpeed.html(percentVal);
            remainingTimeDisplay.html(percentVal);
            status.text(percentVal);

            // if (res) {
            //     alert('upload done');
            // }
            // alert('Uploaded Successfully');
            // window.location.href = '/dashboard/courses/create';
        }
    });
});
