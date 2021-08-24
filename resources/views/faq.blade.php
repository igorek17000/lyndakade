@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row my-3 justify-content-center">
      <div class="col-12">
        <h1>
          سوالات متداول
        </h1>
      </div>
      <div class="col-12 mx-auto">
        <div class="accordion" id="faqExample">

          <div class="card">
            <div class="card-header p-2">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" aria-expanded="false">
                  سوال شماره یک؟
                </button>
              </h5>
            </div>
            <div class="collapse" data-parent="#faqExample">
              <div class="card-body">
                {{-- <b>Answer:</b> --}}
                جواب سوال شماره یک جواب سوال شماره یک جواب سوال شماره یک جواب سوال شماره یک جواب سوال شماره یک جواب سوال
                شماره یک جواب سوال شماره یک
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header p-2">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" aria-expanded="false">
                  سوال شماره یک؟
                </button>
              </h5>
            </div>
            <div class="collapse" data-parent="#faqExample">
              <div class="card-body">
                {{-- <b>Answer:</b> --}}
                جواب سوال شماره یک جواب سوال شماره یک جواب سوال شماره یک جواب سوال شماره یک جواب سوال شماره یک جواب سوال
                شماره یک جواب سوال شماره یک
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <script>
    $(function() {
      var idx = 1;
      document.querySelectorAll('#faqExample .card').forEach((el) => {
        var heading_id = 'heading' + idx,
          collapse_id = 'collapse' + idx;

        var heading = el.querySelector('.card-header');
        heading.setAttribute('id', heading_id);

        var btn = el.querySelector('button');
        btn.setAttribute('data-target', '#' + collapse_id);
        btn.setAttribute('aria-controls', collapse_id);

        var content = el.querySelector('.collapse');
        content.setAttribute('id', collapse_id);
        content.setAttribute('aria-labelledby', heading_id);

        idx++;
      });
    });
  </script>
@endsection
