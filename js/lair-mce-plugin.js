(function() {
    tinymce.create('tinymce.plugins.Lair', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init: function(ed, url) {
            ed.addButton('blue-line', {
                title: 'Blue Line headline',
                cmd: 'blue-line',
                image: url + '/../img/blue-line.png'
            });
            ed.addCommand('blue-line', function() {
                var selected_text = ed.selection.getContent();
                var return_text = '';
                return_text = '<div class="blue-line-header"><strong>' + selected_text + '</strong></div>';
                ed.execCommand('mceInsertContent', 0, return_text);
            });

            ed.addButton('gray', {
                title: 'Gray area',
                cmd: 'gray',
                image: url + '/../img/gray.png'
            });
            ed.addCommand('gray', function() {
                var selected_text = ed.selection.getContent();
                var return_text = '';
                return_text = '<div class="gray">' + selected_text + '</div>';
                ed.execCommand('mceInsertContent', 0, return_text);
            });

            ed.addButton('cod-excerpt', {
                title: 'Excerpt area',
                cmd: 'cod-excerpt',
                image: url + '/../img/cod-excerpt.png'
            });
            ed.addCommand('cod-excerpt', function() {
                var selected_text = ed.selection.getContent();
                var return_text = '';
                return_text = '<div class="cod-excerpt">' + selected_text + '</div>';
                ed.execCommand('mceInsertContent', 0, return_text);
            });
        },

        /**
         * Creates control instances based in the incomming name. This method is normally not
         * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
         * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
         * method can be used to create those.
         *
         * @param {String} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl: function(n, cm) {
            return null;
        },

        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo: function() {
            return {
                longname: 'Lair Buttons',
                // author: 'Lee',
                // authorurl: 'http://wp.tutsplus.com/author/leepham',
                // infourl: 'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/example',
                version : '0.1'
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add('lair', tinymce.plugins.Lair);
})();