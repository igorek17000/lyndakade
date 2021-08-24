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
            <div class="card-header p-2" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne"
                  aria-expanded="false" aria-controls="collapseOne">
                  سوال شماره یک؟
                </button>
              </h5>
            </div>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#faqExample" style="">
              <div class="card-body">
                {{-- <b>Answer:</b> --}}
                جواب سوال شماره یک جواب سوال شماره یک جواب سوال شماره یک جواب سوال شماره یک جواب سوال شماره یک جواب سوال
                شماره یک جواب سوال شماره یک
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header p-2" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo"
                  aria-expanded="false" aria-controls="collapseTwo">
                  Q: What is Bootstrap 4?
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqExample" style="">
              <div class="card-body">
                Bootstrap is the most popular CSS framework in the world. The latest version released in 2018 is Bootstrap
                4. Bootstrap can be used to quickly build responsive websites.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header p-2" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseThree"
                  aria-expanded="true" aria-controls="collapseThree">
                  Q. What is another question?
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#faqExample"
              style="">
              <div class="card-body">
                The answer to the question can go here.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header p-2" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseThree"
                  aria-expanded="true" aria-controls="collapseThree">
                  Q. What is the next question?
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqExample">
              <div class="card-body">
                The answer to this question can go here. This FAQ example can contain all the Q/A that is needed.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(function() {
      console.log(1111111);
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
