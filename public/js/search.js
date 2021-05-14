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
