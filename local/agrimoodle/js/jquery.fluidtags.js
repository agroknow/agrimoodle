// TODO: need to discern the characters typed (on keydown) so as to ignore
// control keys and avoid re-activating the swift tag after having removed
// another tag

                                                                                // TODO: set data for basic elements (root, tag-values and so on) so as to avoid
                                                                                // consecutive iterations of the DOM

                                                                                // TODO: IMPORTANT: what if the value added already exists !!

// TODO: replace clozures with functions; no need to duplicate functionality at
// runtime
                                                                                // TODO: place this function (and others) within fluidtags-space
function fluidtags_tag_close_handler() {
    // get the containing tag (the actual <li> container)
    var tag = $(this).parent();
    // use index to identify the corresponding hidden field
    var index = $(tag).index();

    var root = $(tag).parents('.fluidtags');

    // get the hidden field that corresponds to this tag li
    var tag_values = $(root).children('.tag-values');
    var hidden = $($(tag_values).children()).get(index);

    var input = $(root).children('.tag-input');                                 // any improvements?


    if ($(tag).hasClass('fluidtags-swift')) {
        // if this tag is the swift tag, empty the input field and let the
        // latter's keyup handler take care of the rest
        $(input).val('');
        $(input).keyup();
    } else {

        // store current value of the swift tag, if available
        if ($(input).data('is-swift-active')) {

            // create a fake event with the RETURN key pressed
            e = jQuery.Event("keydown");
            e.which = 13;
            $(input).trigger(e);
        }

        // if this tag is not the swift tag, put its text into the input field
        // for correction. If the user attempts to correct it (by typing new
        // characters in the input field), then the swift tag will be
        // automatically re-instated
        $(input).val($(hidden).val())
        $(hidden).remove();
        $(tag).remove();
    }
}

$.dform.addType('fluidtags', function(options) {

    // set dfrom prefix to null -

    var tag_item = $('<div>').dform({
        "type" : "li",
        "class" : "tag",
        "style" : "display: inline; margin: 3px; padding: 3px",
        "html" :[
            {
                "type" : "span",
                "class" : "fluidtags-li"
            },
            {
                "type" : "a",
                "href" : "#",
                "style" : "margin-left: 3px",
                "role" : "button",
                "html" : {
                    "type" : "span",
                    "html" : "close",
                    "class" : "ui-icon ui-icon-closethick",
                    "style" : "display: inline-block;"
                },
                "post" : function(){
                    $(this).bind('click', fluidtags_tag_close_handler);
                }
            }
        ]
    });
    var tag_item = $($(tag_item).children().detach());

    var tag_hidden = $('<div>').dform({
            "type" : "hidden",
            "name" : "prefix[]",                                                // this should be available via the options !!
            "value" : "text"
    });
    tag_hidden = $($(tag_hidden).children()).detach();

    function appendTag(root, text) {
        var new_tag = $(tag_item).clone(true);
        var li = $(new_tag).children('.fluidtags-li');                    // impr? -- if not customizable, the text span is always the FIRST element
        $(li).html(text);

        // create a new hidden field
        var hidden = $(tag_hidden).clone();
        $(hidden).val(text);

        // append the tag and the hidden field
        var tag_pool = $(root).find('.fluidtags-pool');
        $(tag_pool).append(new_tag);
        var index = $(new_tag).index();

        var tag_values = $(root).find('.tag-values');
        $(tag_values).append(hidden);
    }

    // extract the options that are specific for the customization and pass the
    // rest as attributes
    var language = null;
    var autocomplete = null;
    var placeholder = null;
    var error = null;
    var class_rule = null;
    var root_prefix = '';
    if (options.options) {
        var init = options.options;                                             // improve

        // set the language selector if there exists one
        if (init.language) language = init.language;
        if (init.autocomplete) {
            autocomplete = {"type" : "text", "autocomplete" : init.autocomplete};
        }

        if (init.placeholder) {
            placeholder = {"type" : "span", "html" : init.placeholder};
        }

        if (init['root-prefix']) root_prefix = init['root-prefix'];

        if (init.validation) {
            error = init.validation.error;
            //class_rule = init.validation[class-rule];
            $(tag_hidden).addClass(init.validation['class-rule']);
        }
    }


    var div = $('<div>').dform({
        "type" : "container",
        "class" : "fluidtags",
        "post" : function() {

            var root = this;

            $(this).data('setPrefix', function(prefix) {
                // set the prefix for new hidden input that are to be created
                $(tag_hidden).attr('name', prefix);

                // update the name of pre-existing hidden inputs
                var tag_values = $(root).find('.tag-values');
                $($(tag_values).children()).each(function(){
                    $(this).attr('name', prefix);
                });

                var language = $(root).find('.fluidtags-language');
                if (language) {
                    $(language).attr('name', prefix + '[language]');
                }

                if (error) {
                    var error = $(root).find('.fluidtags-error');
                    $(error).attr('for', prefix);
                }
            });

        },
        "html" : [
            {
                "type" : "span",
                "post" : function() {

                    if (error) {
                        var div = $('<div>').dform(error);
                        var element = $($(div).children()).detach();
                        $(element).attr('for', root_prefix +  '[]');
                        $(element).addClass('fluidtags-error');
                        $(this).append(element);
                    }
                }
            },
            {
                "type" : "text",
                "class" : "tag-input ui-widget-content ui-corner-all",
                "post" : function() {
                    // store the swift tag into the input field data
                    var swift = $(tag_item).clone(true);
                    $(swift).addClass('fluidtags-swift');
                    $(this).data('swift-tag', swift);

                    if (autocomplete) $(this).dform('run', autocomplete);

                    $(this).bind('keydown', function(event) {

                        var text = $(this).val();
                        var root = $(this).parents('.fluidtags');

                        if (text && event.which == 13) {

                            // hide autocomplete menu, if available
                            if (autocomplete){
                                $(this).autocomplete('close');
                            }

                            // the RETURN key has been pressed, so finalize
                            // current tag and set the focus to the input field

                            $($(root).find('.new-tag')).click();
                            event.preventDefault();
                        }
                    });

                    $(this).bind('keyup', function(event) {

                        // update the swift tag with the contents of the input

                        var text = $(this).val();

                        var root = $(this).parents('.fluidtags');
                        var tag_values = $(root).find('.tag-values');

                        // if the input is emptied, remove the swift tag and its
                        // hidden field
                        if (!text) {

                            if ($(this).data('is-swift-active')) {

                                var tag = $(root).find('.fluidtags-swift');               // impr? -- swift is usually (if not always) the LAST li !!
                                var index = $(tag).index();

                                // we need to detach the swift tag
                                $(this).data('swift-tag', $(tag).detach());
                                $($($(tag_values).children()).get(index)).remove();

                                $(this).data('is-swift-active', false);
                            }
                            return;
                        }

                        // make the swift tag visible, if not already
                        if (! $(this).data('is-swift-active')) {

                            // set the swift tag
                            var swift = $(this).data('swift-tag');
                            $($(root).find('.fluidtags-pool')).append(swift);

                            // set a hidden field that bears the value
                            // cloning is used because the defaults of may be
                            // defined elsewhere
                            $(tag_values).append($(tag_hidden).clone());

                            // set the switch to recognise that swift is visible
                            $(this).data('is-swift-active', true);
                        }
                                                                                // need to set the hidden field as well !!

                        var tag = $(root).find('.fluidtags-swift');                       // impr? -- swift is usually (if not always) the LAST li !!
                        var index = $(tag).index();

                        var li = $(tag).children('.fluidtags-li');                    // impr? -- if not customizable, the text span is always the FIRST element
                        $(li).html(text);

                        $($($(tag_values).children()).get(index)).val(text);
                    });
                }
            },
            {
                "type" : "a",
                "href" : "#",
                "class" : 'new-tag ui-icon ui-icon-check',
                "style" : "margin-right: 10px; display: inline-block",
                "html" : "OK",
                "post" : function() {
                    $(this).click(function(){
                        var root = $(this).parents('.fluidtags');
                        var input = $(root).find('.tag-input');
                        var text = $(input).val();

                        if (text) {

                            // this one's value will be copied
                            var swift = $(root).find('.fluidtags-swift');

                            if ($(swift).length) {
                                // set text for it may have been altered without
                                // an event being raised (eg, autocomplete)

                                $($(swift).children('.fluidtags-li')).html(text);

                                var hidden = $($($(root).find('.tag-values')).children()).last();
                                $(hidden).remove();

                                $(swift).detach();

                                $(input).data('swift', swift);
                                $(input).data('is-swift-active', false);

                            }

                            appendTag(root, text);
                            $(input).val('');
                        }
                        $(input).focus();
                    });
                }
            },
            {
                "type" : "span",
                "post" : function() {
                    if (language) {
                        var div = $('<div>').dform(language);
                        var select = $($(div).children()).detach();
                        $(select).addClass('fluidtags-language');
                        $(this).append(select);
                    }

                    if (placeholder) {
                        $(this).dform(placeholder);
                    }
                }
            },
            {
                "type" : "ul",
                "style" : "margin-left: 0; margin-top: 0; padding: 0",
                "class" : "fluidtags-pool"
            },
            {
                "type" : "container",
                "class" : "tag-values"
            }
        ]
    });

    if (options.options) {

        var init = options.options;                                             // improve
        var root = $(div).find('.fluidtags');

        // initialize tags with values supplied via options
        if (init.values) {

            var values = options.options.values;
            $.each(values, function(index, value){
                appendTag(root, value);
            });
        }

        if (init.prefix) {
            $(root).data('setPrefix')(init.prefix);
        }
    }
    return div;
});