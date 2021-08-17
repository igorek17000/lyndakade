$(function() {
    $(document).on("click", "#tab-list .nav-link", function(t) {
        $.ajax({
            url: $(t.target).attr("data-url"),
            method: "POST",
            data: { id: 0, _token: $('input[name="_token"]').val() },
            success: function(t) {
                let e = document.getElementById("list-items");
                for (; e.firstChild; ) e.removeChild(e.firstChild);
                $("#load-more").remove(), $("#list-items").append(t);
            },
            error: function(t, e, n) {
                (msg = { xhr: t, status: e, error: n }), console.log(msg);
            }
        });
    }),
        $(document).on("click", "#load-more", function(t) {
            $.ajax({
                url: $(".tab-list .active").attr("data-url"),
                method: "POST",
                data: {
                    id: $(t.target).attr("data-id"),
                    _token: $('input[name="_token"]').val()
                },
                success: function(t) {
                    $("#load-more").remove(), $("#list-items").append(t);
                },
                error: function(t, e, n) {
                    (msg = { xhr: t, status: e, error: n }), console.log(msg);
                }
            });
        }),
        $(document).on("click", ".btn-preview", function(t) {
            var e = $("#exampleModalCenter");
            t.stopPropagation();
            var n = $(this).attr("data-video-url"),
                a = $(this).attr("data-title"),
                o = $(this).attr("data-subtitle-url"),
                r =
                    '<div class="video-player" style="width: 100%;">   <video \n       style="width: 100%;"       controls\n       preload="auto"\n       poster="' +
                    $(this).attr("data-poster-url") +
                    '">       <source type="video/mp4" src="' +
                    n +
                    '"/>       <track\n           default\n           kind="captions"\n           srclang="en"\n           label="Persian"\n           src="' +
                    o +
                    '"/>   </video></div>';
            e.find(".modal-title").text(a),
                $(".modal-body .video-player").remove(),
                (e.find(".modal-body")[0].innerHTML = r),
                e.modal("toggle"),
                e.on("hidden.bs.modal", function(t) {
                    $(".modal-body .video-player").remove();
                });
        }),
        $(document).on("click", ".ga.bookmark-icon-btn", function(t) {
            alert("added"),
                $.ajax({
                    url: $(this).attr("data-url"),
                    method: "POST",
                    data: {
                        course_id: $(this).attr("data-id"),
                        _token: $('input[name="_token"]').val()
                    },
                    success: function(t) {},
                    error: function(t, e, n) {
                        (msg = { xhr: t, status: e, error: n }),
                            console.log(msg);
                    }
                });
        }),
        $(document).on("mouseenter", "#navbarLibrary", function() {
            this.classList.add("show"),
                $(this)
                    .children(".dropdown-menu")
                    .addClass("show");
        }),
        $(document).on("mouseleave", "#navbarLibrary", function() {
            this.classList.remove("show"),
                $(this)
                    .children(".dropdown-menu")
                    .removeClass("show");
        }),
        $(document).on("mouseenter", ".dropdown-title", function() {
            $(".dropdown-title.active").removeClass("active"),
                $(".dropdown-content.active").removeClass("active"),
                this.classList.add("active"),
                $("#" + $(this).attr("data-id")).addClass("active");
        });
}),
    $(function() {
        var t = function() {
            $.ajax({
                url: "/cart",
                method: "POST",
                data: {
                    id: $(this).attr("data-id"),
                    _token: $('input[name="_token"]').val()
                },
                success: function(t) {
                    let e = document.getElementById("cart-list-item");
                    for (; e.firstChild; ) e.removeChild(e.firstChild);
                    $("#cart-list-item").append(t);
                },
                error: function(t, e, n) {
                    (msg = { xhr: t, status: e, error: n }), console.log(msg);
                }
            });
        };
        $(document).on("click", ".cart-add-btn", function(e) {
            var n = $(this);
            $.ajax({
                url: "/cart/add",
                method: "POST",
                data: {
                    id: $(this).attr("data-id"),
                    _token: $('input[name="_token"]').val()
                },
                success: function(e) {
                    if (e) {
                        var a = n.attr("data-id");
                        n.remove();
                        var o = document.querySelectorAll("#cart-btn");
                        for (let t = 0; t < o.length; t++)
                            o[t].innerHTML =
                                '<a data-id="' +
                                a +
                                '" class="btn btn-danger align-self-center cart-remove-btn">حذف از سبد خرید</a>';
                        t();
                    } else alert("خطایی رخ داده است. لطفا دوباره تلاش کنید.");
                },
                error: function(t, e, n) {
                    (msg = { xhr: t, status: e, error: n }), console.log(msg);
                }
            });
        }),
            $(document).on("click", ".cart-remove-btn", function(e) {
                var n = $(this);
                $.ajax({
                    url: "/cart/remove",
                    method: "POST",
                    data: {
                        id: $(this).attr("data-id"),
                        _token: $('input[name="_token"]').val()
                    },
                    success: function(e) {
                        if (e) {
                            var a = n.attr("data-id");
                            n.remove();
                            var o = document.querySelectorAll("#cart-btn");
                            for (let t = 0; t < o.length; t++)
                                o[t].innerHTML =
                                    '<a data-id="' +
                                    a +
                                    '" class="btn btn-download align-self-center cart-add-btn">افزودن به سبد خرید</a>';
                            t();
                        } else
                            alert("خطایی رخ داده است. لطفا دوباره تلاش کنید.");
                    },
                    error: function(t, e, n) {
                        (msg = { xhr: t, status: e, error: n }),
                            console.log(msg);
                    }
                });
            }),
            document.getElementById("cart-list-item") && t();
    }),
    $(function() {
        $(document).on("click", ".show-more-toggle", function(t) {
            var e,
                n = $(this.parentNode).find(".filter-item");
            if (this.innerText.includes("+")) {
                for (e = 0; e < n.length; e++) $(n[e]).show();
                this.innerHTML =
                    '<button class="btn btn-link"><span>- موارد کمتر</span></button>';
            } else {
                for (e = 5; e < n.length; e++) $(n[e]).hide();
                this.innerHTML =
                    '<button class="btn btn-link"><span>+ موارد بیشتر</span></button>';
            }
        }),
            $(document).on("change", "select[name=sort]", function(t) {
                alert(this.options[this.selectedIndex].value);
            });
    });
