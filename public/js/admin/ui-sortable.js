(function ($) {
    var fixHelper = function (e, ui) {
        ui.children().each(function () {
            $(this).width($(this).width());
        });
        return ui;
    };


    $.fn.SortableGridView = function (url) {
        var widget = this,
            grid = $('tbody', this),
            initialIndex = [];

        $('tr', grid).each(function () {
            initialIndex.push($(this).data('key'));
        });

        grid.sortable({
            items: 'tr',
            axis: 'y',
            update: function () {

                var items = {};
                var i = 0;
                $('tr', grid).each(function () {
                    var currentKey = $(this).data('key');
                    if (initialIndex[i] != currentKey) {
                        items[currentKey] = initialIndex[i];
                        initialIndex[i] = currentKey;
                    }
                    ++i;
                });

                $.ajax({
                    'url': url,
                    'type': 'post',
                    'data': {
                        items: JSON.stringify(items),
                        _token: token
                    },
                    'success': function(data) {
                    }
                });
            },
            helper: fixHelper
        });
        //}).disableSelection();
    };
})(jQuery);
