/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4; */

/*
 * Item browser widget in the Neatline editor.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at http://www.apache.org/licenses/LICENSE-2.0 Unless required by
 * applicable law or agreed to in writing, software distributed under the
 * License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS
 * OF ANY KIND, either express or implied. See the License for the specific
 * language governing permissions and limitations under the License.
 *
 * @package     omeka
 * @subpackage  neatline
 * @author      Scholars' Lab <>
 * @author      Bethany Nowviskie <bethany@virginia.edu>
 * @author      Adam Soroka <ajs6f@virginia.edu>
 * @author      David McClure <david.mcclure@virginia.edu>
 * @copyright   2011 The Board and Visitors of the University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
 */

(function($, undefined) {


    $.widget('neatline.itembrowser', {

        options: {

            // Markup hooks.
            topbar_id: 'topbar',
            search_wrapper_id: 'search-wrapper',
            search_box_id: 'search-box',
            items_list_container_id: 'items-list-container',

            colors: {
                item_list_highlight: '#f2f3fa'
            }

        },

        _create: function() {

            // Getters.
            this._window = $(window);
            this.topBar = $('#' + this.options.topbar_id);
            this.searchWrapper = $('#' + this.options.search_wrapper_id);
            this.searchBox = $('#' + this.options.search_box_id);
            this.itemsList = $('#' + this.options.items_list_container_id);

            // Position the container, add window resize listener.
            this._positionContainer();
            this._addWindowResizeListener();

            // Set starting filtering parameters.
            this._searchString = '';
            this._tagFilter = null;
            this._collectionFilter = null;

            // Add listener to the search box.
            this._glossSearchBox();

            // Fire starting ajax request.
            this._getItems();

        },

        _positionContainer: function() {

            // Update dimensions and set new height.
            this._getDimensions();
            this.element.css({
                'height': this.windowHeight - this.topBarHeight - 1,
                'top': this.topBarHeight
            });

        },

        _addWindowResizeListener: function() {

            var self = this;

            this._window.bind('resize', function() {
                self._positionContainer();
            });

        },

        _getDimensions: function() {

            this.containerWidth = this.element.width();
            this.containerHeight = this.element.height();

            this.windowWidth = this._window.width();
            this.windowHeight = this._window.height();

            this.topBarHeight = this.topBar.height();

        },

        _glossSearchBox: function() {

            var self = this;

            this.searchBox.bind({

                'keyup': function() {
                    self._searchString = self.searchBox.val();
                    self._getItems();
                }

            });

        },

        _getItems: function() {

            var self = this;

            // Core ajax call to get items.
            $.ajax({

                url: 'items',
                dataType: 'html',

                data: {
                    search: this._searchString
                },

                success: function(data) {
                    self.itemsList.html(data);
                    self._positionContainer();
                    self._glossItems();
                }

            });

        },

        _glossItems: function() {

            var self = this;

            // Get the new items.
            this.items = $('#' + this.options.items_list_container_id + ' .item');

            // Gloss each of them.
            $.each(this.items, function(i, item) {

                var item = $(item);
                item.bind({

                    'mouseenter': function() {
                        item.css('background-color', self.options.colors.item_list_highlight);
                    },

                    'mouseleave': function() {
                        item.css('background-color', 'transparent');
                    }

                });

            });

        }

    });


})( jQuery );


// Usage.
jQuery(document).ready(function($) {

    $('#item-browser').itembrowser();

});
