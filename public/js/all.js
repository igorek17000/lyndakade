$(function () {
    $(document).on('click', '#tab-list .nav-link', function (event) {
        $.ajax({
            url: $(event.target).attr('data-url'),
            method: 'POST',
            data: {id: 0, _token: $('input[name="_token"]').val()},
            success: function (data) {
                let list_view = document.getElementById('list-items');
                while (list_view.firstChild)
                    list_view.removeChild(list_view.firstChild);
                $('#load-more').remove();
                $('#list-items').append(data);
            },
            error: function (xhr, status, error) {
                msg = {
                    xhr: xhr,
                    status: status,
                    error: error,
                };
                console.log(msg);
            }
        });
    });

    $(document).on('click', '#load-more', function (event) {
        $.ajax({
            url: $('.tab-list .active').attr('data-url'),
            method: 'POST',
            data: {id: $(event.target).attr('data-id'), _token: $('input[name="_token"]').val()},
            success: function (data) {
                $('#load-more').remove();
                $('#list-items').append(data);
            },
            error: function (xhr, status, error) {
                msg = {
                    xhr: xhr,
                    status: status,
                    error: error,
                };
                console.log(msg);
            }
        })
    });

    // $(document).on('click', '.list-item-row', function (event) {
    //     let url = $(this).attr('data-url');
    //     window.open(url, "_self");
    // });

    $(document).on('click', '.btn-preview', function (event) {
        var modal = $('#exampleModalCenter');
        event.stopPropagation();
        var video_url = $(this).attr('data-video-url');
        var title = $(this).attr('data-title');
        var subtitle_url = $(this).attr('data-subtitle-url');
        var poster_url = $(this).attr('data-poster-url');

        var body = '<div class="video-player" style="width: 100%;">' +
            '   <video \n' +
            '       style="width: 100%;"' +
            '       controls\n' +
            '       preload="auto"\n' +
            '       poster="' + poster_url + '">' +
            '       <source type="video/mp4" src="' + video_url + '"/>' +
            '       <track\n' +
            '           default\n' +
            '           kind="captions"\n' +
            '           srclang="en"\n' +
            '           label="Persian"\n' +
            '           src="' + subtitle_url + '"/>' +
            '   </video>' +
            '</div>';

        // var body = '<div class="video-player" style="padding: 0; margin: 0;">\n' +
        //     '                            <video\n' +
        //     '                                id="preview-player"\n' +
        //     '                                class="video-js vjs-big-play-centered vjs-16-9"\n' +
        //     '                                controls\n' +
        //     '                                preload="auto"\n' +
        //     '                                poster="' + poster_url + '"\n' +
        //     '                                data-setup=\'{ "fluid" : true , "controls": true, "autoplay": false, "preload": "auto", "seek": true  }\'>\n' +
        //     '                                <source type="video/mp4" src="/' + video_url + '"/>\n' +
        //     '\n' +
        //     '                                <track\n' +
        //     '                                    default\n' +
        //     '                                    kind="captions"\n' +
        //     '                                    srclang="en"\n' +
        //     '                                    label="Persian"\n' +
        //     '                                    src="' + subtitle_url + '"/>\n' +
        //     '\n' +
        //     '                                <p class="vjs-no-js">\n' +
        //     '                                    To view this video please enable JavaScript, and consider upgrading to a\n' +
        //     '                                    web browser that\n' +
        //     '                                    <a href="https://videojs.com/html5-video-support/" target="_blank">\n' +
        //     '                                        supports HTML5 video\n' +
        //     '                                    </a>\n' +
        //     '                                </p>\n' +
        //     '                            </video>\n' +
        //     '                        </div>'

        modal.find('.modal-title').text(title);
        $('.modal-body .video-player').remove();
        modal.find('.modal-body')[0].innerHTML = body;
        modal.modal('toggle');
        //var player = videojs('preview-player');

        modal.on('hidden.bs.modal', function (e) {
            // console.log(e)
            $('.modal-body .video-player').remove();
            // modal.find('.modal-body')[0].innerHTML = "";
        });
    });

    $(document).on('click', '.ga.bookmark-icon-btn', function (event) {
        alert('added');
        $.ajax({
            url: $(this).attr('data-url'),
            method: 'POST',
            data: {course_id: $(this).attr('data-id'), _token: $('input[name="_token"]').val()},
            success: function (data) {
                // $('.toast').addClass('show');
                // $(this).toast(data);
            },
            error: function (xhr, status, error) {
                msg = {
                    xhr: xhr,
                    status: status,
                    error: error,
                };
                console.log(msg);
            }
        });
    });

    // $(document).on('click', '.ga', function (event) {
    //     if ((
    //         event.target.tagName === 'A' ||
    //         event.target.tagName === 'SPAN' ||
    //         event.target.tagName === 'BUTTON') &&
    //         event.target.tagName !== 'IMG'
    //     ) {
    //         // alert('hi');
    //         event.stopPropagation();
    //     } else {
    //         // alert('bye');
    //         event.preventDefault();
    //         event.stopPropagation();
    //     }
    // });

    $(document).on('mouseenter', '#navbarLibrary', function () {
        this.classList.add('show');
        $(this).children('.dropdown-menu').addClass('show');
    });

    $(document).on('mouseleave', '#navbarLibrary', function () {
        this.classList.remove('show');
        $(this).children('.dropdown-menu').removeClass('show');
    });

    $(document).on('mouseenter', '.dropdown-title', function () {
        $('.dropdown-title.active').removeClass('active');
        $('.dropdown-content.active').removeClass('active');

        this.classList.add('active');
        $('#' + $(this).attr('data-id')).addClass('active');
    });

    // $(document).on('mouseenter', '.dropdown-content-item', function () {
    //     this.style.backgroundColor = "#333";
    // });
    //
    // $(document).on('mouseleave', '.dropdown-content-item', function () {
    //     this.style.backgroundColor = "transparent";
    // });

});

$(function () {
    var update_cart_list = function () {
        $.ajax({
            url: '/cart',
            method: 'POST',
            data: {id: $(this).attr('data-id'), _token: $('input[name="_token"]').val()},
            success: function (data) {
                // alert(data);
                // $('#cart-list-item').innerHTML = data;
                let cart_list_view = document.getElementById('cart-list-item');
                while (cart_list_view.firstChild)
                    cart_list_view.removeChild(cart_list_view.firstChild);
                $('#cart-list-item').append(data);


            },
            error: function (xhr, status, error) {
                msg = {
                    xhr: xhr,
                    status: status,
                    error: error,
                };
                console.log(msg);
            }
        });
    }

    $(document).on('click', '.cart-add-btn', function (event) {
        var item = $(this);
        $.ajax({
            url: '/cart/add',
            method: 'POST',
            data: {id: $(this).attr('data-id'), _token: $('input[name="_token"]').val()},
            success: function (data) {
                if (data) {
                    var id = item.attr('data-id');
                    item.remove()
                    var el = document.querySelectorAll('#cart-btn');
                    for (let i = 0; i < el.length; i++) {
                        el[i].innerHTML =
                            '<a data-id="' + id + '" ' +
                            'class="btn btn-danger align-self-center cart-remove-btn">' +
                            'حذف از سبد خرید' +
                            '</a>'
                    }
                    // alert('با موفقیت به سبد اضافه شد.')
                    update_cart_list();
                } else {
                    alert('خطایی رخ داده است. لطفا دوباره تلاش کنید.')
                }
            },
            error: function (xhr, status, error) {
                msg = {
                    xhr: xhr,
                    status: status,
                    error: error,
                };
                console.log(msg);
            }
        });
    });
    $(document).on('click', '.cart-remove-btn', function (event) {
        var item = $(this);
        $.ajax({
            url: '/cart/remove',
            method: 'POST',
            data: {id: $(this).attr('data-id'), _token: $('input[name="_token"]').val()},
            success: function (data) {
                if (data) {
                    var id = item.attr('data-id');
                    item.remove()
                    var el = document.querySelectorAll('#cart-btn');
                    for (let i = 0; i < el.length; i++) {
                        el[i].innerHTML =
                            '<a data-id="' + id + '" ' +
                            'class="btn btn-download align-self-center cart-add-btn">' +
                            'افزودن به سبد خرید' +
                            '</a>'
                    }
                    // alert('با موفقیت از سبد حذف شد.')
                    update_cart_list();
                } else {
                    alert('خطایی رخ داده است. لطفا دوباره تلاش کنید.')
                }
            },
            error: function (xhr, status, error) {
                msg = {
                    xhr: xhr,
                    status: status,
                    error: error,
                };
                console.log(msg);
            }
        });
    });
    if (document.getElementById('cart-list-item'))
        update_cart_list();
})

$(function () {
    $(document).on('click', '.show-more-toggle', function (event) {
        var i;
        var nodes = $(this.parentNode).find('.filter-item');
        if (this.innerText.includes('+')) {
            for (i = 0; i < nodes.length; i++) {
                $(nodes[i]).show();
            }
            this.innerHTML = '<button class="btn btn-link"><span>- موارد کمتر</span></button>';
        } else {
            for (i = 5; i < nodes.length; i++) {
                $(nodes[i]).hide();
            }
            this.innerHTML = '<button class="btn btn-link"><span>+ موارد بیشتر</span></button>';
        }
    });
    $(document).on('change', 'select[name=sort]', function (event) {
        alert(this.options[this.selectedIndex].value);
    });
});
