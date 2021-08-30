<button class="go-to-top-btn" title="Go to top">{{ __('msg.Top') }}</button>
@push('js')

  <script>
    //   window.onscroll = function() {
    //     scrollBtnFunction();
    //   };

    //   function scrollBtnFunction() {
    //     var btns = document.querySelectorAll(".go-to-top-btn");
    //     var scrollSize = 20;
    //     if (document.body.scrollTop > scrollSize || document.documentElement.scrollTop > scrollSize) {
    //       btns.forEach(btn => {
    //         btn.style.display = "block";
    //       });
    //     } else {
    //       btns.forEach(btn => {
    //         btn.style.display = "none";
    //       });
    //     }
    //   }

    //   function goToTopFunction() {
    //     document.body.scrollTop = 0;
    //     document.documentElement.scrollTop = 0;
    //   }
    $(function() {
      $(window).on('mousewheel', function() {
        $('html,body').stop();
      });

      $(window).scroll(function(e) {
        if ($(this).scrollTop() > 100) {
          $('.go-to-top-btn').fadeIn();
        } else {
          $('.go-to-top-btn').fadeOut();
        }
      });

      $('.go-to-top-btn').click(function() {
        $('html, body').animate({
          scrollTop: 0
        }, 1000);
        return false;
      });
    });
  </script>

@endpush
