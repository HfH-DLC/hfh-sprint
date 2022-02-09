/**
 * textboxes.js
 *
 * Copyright, Moxiecode Systems AB
 * Released under LGPL License.
 *
 * License: http://www.tinymce.com/license
 * Contributing: http://www.tinymce.com/contributing
 */

console.log("sprint textboxes");

tinymce.PluginManager.add('hfh-sprint-textboxes', function(editor) {
    /**
     * @param type
     * @param title
     * @param image
     * @param selection
     */
    function eduTextboxWithSelection(type, title, image, selection) {
        return `<div class="textbox textbox--${type} hfh-sprint"><header class="textbox__header"><div><p class="textbox__title">${title}</p></div><div>${image}</div></header>\n<div class="textbox__content">${selection}</div></div><p></p>`;
    }

    /**
     * @param type
     * @param title
     * @param image
     * @param placeholder
     * @param first
     * @param second
     */
    function eduTextboxWithPlaceholder(type, title, image, placeholder, first, second) {
        return `<div class="textbox textbox--${type} hfh-sprint"><header class="textbox__header"><div><p class="textbox__title">${title}</p></div><div>${image}</div></header>\n<div class="textbox__content"><p>${placeholder}</p><ul><li>${first}</li><li>${second}</li></ul></div></div><p></p>`;
    }

    editor.addButton('hfh-sprint-textboxes', {
        type: 'menubutton',
        text: "Sprint Textfelder",
        icon: false,
        menu: [{
                text: editor.getLang('strings.examples'),
                /**
                 *
                 */
                onclick: function() {
                    let type = 'examples';
                    let selection = editor.selection.getContent();
                    let title = editor.getLang(`strings.${type}`);
                    let image = 'Bild';
                    let placeholder = editor.getLang(`strings.${type}placeholder`);
                    let first = editor.getLang('strings.first');
                    let second = editor.getLang('strings.second');
                    if (selection !== '') {
                        editor.execCommand(
                            'mceReplaceContent',
                            false,
                            eduTextboxWithSelection(type, title, image, selection)
                        );
                    } else {
                        editor.execCommand(
                            'mceInsertContent',
                            0,
                            eduTextboxWithPlaceholder(type, title, image, placeholder, first, second)
                        );
                    }
                },
            },
            {
                text: editor.getLang('strings.exercises'),
                /**
                 *
                 */
                onclick: function() {
                    let type = 'exercises';
                    let selection = editor.selection.getContent();
                    let title = editor.getLang(`strings.${type}`);
                    let image = 'Bild';
                    let placeholder = editor.getLang(`strings.${type}placeholder`);
                    let first = editor.getLang('strings.first');
                    let second = editor.getLang('strings.second');
                    if (selection !== '') {
                        editor.execCommand(
                            'mceReplaceContent',
                            false,
                            eduTextboxWithSelection(type, title, image, selection)
                        );
                    } else {
                        editor.execCommand(
                            'mceInsertContent',
                            0,
                            eduTextboxWithPlaceholder(type, title, image, placeholder, first, second)
                        );
                    }
                },
            },
            {
                text: editor.getLang('strings.keytakeaways'),
                /**
                 *
                 */
                onclick: function() {
                    let type = 'key-takeaways';
                    let selection = editor.selection.getContent();
                    let title = editor.getLang(`strings.${type}`);
                    let image = 'Bild';
                    let placeholder = editor.getLang(`strings.${type}placeholder`);
                    let first = editor.getLang('strings.first');
                    let second = editor.getLang('strings.second');
                    if (selection !== '') {
                        editor.execCommand(
                            'mceReplaceContent',
                            false,
                            eduTextboxWithSelection(type, title, image, selection)
                        );
                    } else {
                        editor.execCommand(
                            'mceInsertContent',
                            0,
                            eduTextboxWithPlaceholder(type, title, image, placeholder, first, second)
                        );
                    }
                },
            },
            {
                text: editor.getLang('strings.learningobjectives'),
                /**
                 *
                 */
                onclick: function() {
                    let type = 'learning-objectives';
                    let selection = editor.selection.getContent();
                    let title = editor.getLang(`strings.${type}`);
                    let image = 'Bild';
                    let placeholder = editor.getLang(`strings.${type}placeholder`);
                    let first = editor.getLang('strings.first');
                    let second = editor.getLang('strings.second');
                    if (selection !== '') {
                        editor.execCommand(
                            'mceReplaceContent',
                            false,
                            eduTextboxWithSelection(type, title, image, selection)
                        );
                    } else {
                        editor.execCommand(
                            'mceInsertContent',
                            0,
                            eduTextboxWithPlaceholder(type, title, image, placeholder, first, second)
                        );
                    }
                },
            },
        ],
    });
});