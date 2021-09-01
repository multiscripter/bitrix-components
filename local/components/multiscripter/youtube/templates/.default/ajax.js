$(function () {
    function Ytube(box) {
        var self = this;
        this.box = box;
        this.box.on('click', function (event) {
            event.preventDefault();
            let tar = $(event.target);
            if (!tar.hasClass('js-comp-youtube-btn') || !tar.attr('href'))
                return;
            $.get(tar.attr('href') + '&YTCAJAX', function (data) {
                let html = $.parseHTML(data);
                content = $(html[0]).children().detach();
                self.box.empty().append(content);
            }).fail(function () {
                console.log('Youtube component AJAX request failed.');
            });
        });
    }

    $('.js-comp-youtube').each(function () {
        new Ytube($(this));
    });
});
