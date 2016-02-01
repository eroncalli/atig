define(function(require, exports, module) {
    var Class = require('class');

    var PaginationControl = exports.PaginationControl = Class.extend({
        init: function(container) {
            var self = this;
            this.container = container;
            this.totalRecordCount = this.container.attr('data-total-record-count');
            this.$changeRowPerPageButton = this.container.find('.define-page-size-button');
            this.$changeRowPerPageButton.click(function(e) {
                e.preventDefault();
                self._clickChangeRowPerPageButtonHandler();
            });
            this.$changeRowPerPageDialog = this.container.find('.modal');
            this.$changeRowPerPageDialog.modal({
                modal: true,
                show: false
            });

            var $customPageSizeInput = this.container.find('.js-pgui-custom-page-size')

            var applyCallback = function (e) {
                e.preventDefault();
                var value = $customPageSizeInput.val();
                $customPageSizeInput.val(Math.abs(parseInt(value)) || 10);
                self._applyRowPerPageValue(self.getRowPerPageValue());
            };

            this.$changeRowPerPageDialog.find('.save-changes-button').click(applyCallback);
            this.$changeRowPerPageDialog.find('form').submit(applyCallback);

            $customPageSizeInput.keyup(function() {
                self.container.find('.js-custom_page_size_page_count').html(
                    self._getPageCountForPageSize($(this).val(), self.totalRecordCount)
                );
            });
        },

        _getPageCountForPageSize: function (pageSize, rowCount) {
            if (pageSize > 0)
                return Math.floor(rowCount / pageSize) +
                    ((Math.floor(rowCount / pageSize) == (rowCount / pageSize)) ? 0 : 1);
            else
                return 1;
        },

        _applyRowPerPageValue: function(value) {
            require(['jquery/jquery.query'], function()
            {
                window.location = jQuery.query.set('recperpage', value);
            });
        },

        getRowPerPageValue: function() {
            var value = this.container.find('input:checked').val();
            if (value == 'custom')
                value = this.container.find('.js-pgui-custom-page-size').val();
            return value;
        },

        _clickChangeRowPerPageButtonHandler: function() {
            this._showChangeRecPerPageDialog();
        },

        _showChangeRecPerPageDialog: function() {
            this.$changeRowPerPageDialog.modal('show');
        }
    });

    exports.setupPaginationControls = function($context) {
        $context.find('.pgui-pagination').each(function() {
            var paginationControl = new PaginationControl($(this));
            $(this).data('PaginationControl-class', paginationControl);
        });
    };


});