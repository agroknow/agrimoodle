// Dependencies:
//      jQuery
//      dform

$.dform.subscribe("post_button", function(options, type) {
    var url = options.url;

    this.click(function(event) {
        var form_id = '#' + options.form;
/*        var status = true;

        $(form_id).find('[name]:not(a)').each(function(){
            var res = $(form_id).validate().element( this );
            if (res == false) {

                var container = $(this).parents('.block_mdeditor_container');

                $('#block_mdeditor_course_accordion').accordion(
                        'activate',
                        $(container).prev());

                status = false;
            }
        });
*/
        // this will not work if some block is hidden at the time the validation
        // occurs
        var status = $(form_id).valid();
//return;
        if (status) {
            var formData = $(form_id).serialize();

            $.post(url, formData, function(response, status){
                if (response.message) {
                    alert(response.message);
                }
            }, 'json');

            // prevent form from submitting normally
            event.preventDefault();
        } else {
            //alert(options.errors_msg);
        }
    });
});

$.dform.subscribe("button", function(options, type) {
    this.button();
});

$.dform.subscribe("validates", function(options, type) {

    if (options.messages) {
        var messages = options.messages;
        // currently, works only for the required method
        $.each(messages, function(alias, message){
            $.validator.addMethod(alias,
                                  $.validator.methods.required,
                                  message);
        });
/*
        if (messages.cRequired) $.validator.addMethod("cRequired",
                                                      $.validator.methods.required,
                                                      messages.cRequired);
*/
    }
    $.validator.addClassRules(options['class-rules']);

},
$.isFunction($.fn.validate));

$.dform.subscribe("toChecklist", function(options, type) {
    $(this).toChecklist(options);
},
$.isFunction($.fn.toChecklist));

$.dform.subscribe("dialog_init", function(options, type) {
    this.dialog({
        close: function( event, ui ) {
            // remove dialog and ALL its elements
            $(this).remove();
        }
    });

    var dialogWidth = parseInt($(this).dialog('option', 'width'));
    var windowWidth = $(window).width();
    var positionX = parseInt((windowWidth -  dialogWidth)/2);
    var scrollTop = $(document).scrollTop()

    $(this).dialog('option', 'height', ($(window).height()*0.8));
    $(this).dialog('option', 'position', [positionX, (0 - scrollTop)]);

});

$.dform.subscribe("foo", function(options, type) {

    $(this).click(function() {
        var param = options.param;
        var control = $(this).parents('.block_mdeditor_control');

        // get language version of the requested license
        var language = $(control).find('.block_mdeditor_language');
        language = $(language).attr('value');

        var target = $(control).find(options.target);
        //$(target).val('sdfs' + param);

        var url = options.source;
        var license = options.param;

        $.get(url, {
            license : license,
            language: language })
        .success(function(response, status) {
            if (status == 'success') {
                $(target).val(response);
            }
        }, 'json');

    });
});

$.dform.subscribe('localization_add', function(options, type) {
    this.click(function(){

        // get the name of the control to create
        var prefix = $(this).attr('name');
        // replace any occurences of [], as they are not included in the name
        var archetypeName = prefix.replace(/\[.*\]/, '');


        // find closest (from bottom-up approach) parent to this control
        // it is in that container that the new control will be appended to
        var container = $(this).parents('.block_mdeditor_container');

        // get the dform representation of the new control from the form itself
        var archetypes = $("#block_mdeditor_dialog_form").data('archetypes');

        $(container).dform('append', archetypes[archetypeName]);

        // identify the id of the new control
        var lastIndex = $(container).children().length - 1; // get(-1) ??

        // get the newly appended control and set proper names to its input
        // elements
        var controls = $(container).children()[lastIndex];

        if (options == 'fluidtags') {
            var newName = prefix + '[' + lastIndex + '][]';

            $($(controls).find('.fluidtags')).data('setPrefix')(newName);

        } else { // generic approach
            $(controls).find('[name], [for]').each(function(){
                var attr = $(this).attr('name') ? 'name':'for';
                var newName = prefix + $(this).attr(attr).replace("loc", lastIndex);
                $(this).attr(attr, newName);
            });
        }

        // move the add-localization button into the new control
        var placeholder = $(controls).find('.block_mdeditor_loc-placeholder');

        $(this).detach().appendTo(placeholder);
    });
});

$.dform.subscribe('handle_archetypes', function(options, type) {                // pass archetypes via options, instead ??

    var field = $('#block_mdeditor_archetypes');
    var a = $(field).val();
    var controls = $.parseJSON(a);
    $(field).remove();

    field = $('#block_mdeditor_containers');
    a = $(field).val();
    var containers = $.parseJSON(a);
    $(field).remove();

    $("#block_mdeditor_dialog_form").data('archetypes', controls);
    $("#block_mdeditor_dialog_form").data('containers', containers);

});

$.dform.subscribe('localization_remove', function(options, type) {

    $(this).click(function(){

        // get the control that is to be deleted as well as its index
        // the index will help in renaming the remaining controls as well as to
        // identify special cases (eg, removing the one and only control..)
        var control = $(this).parents('.block_mdeditor_control');
        var thisIndex = $(control).index();


        // get the index of the addButton control
        var container = $(control).parents('.block_mdeditor_container');


        // locate the add button, because it contains the prefix of the elements
        // that will be used in the reconstruction of their names
        // also, if the control that bears the addButton is to be removed, then
        // the afore-mentioned button needs to be moved before the deletion!
        var addButton = $(container).find('.block_mdeditor_loc-button');
        var buttonIndex = $($(addButton).parents('.block_mdeditor_control')).index();


        // if deleting the one and only control, then just reset its contents
        //  hm, reset ?== remove and re-instantiate from archetype
        //  Note: the addButton should be moved into the new control


        // this check is based on the assumption that the addButton is always
        // present within the LAST control and is only used for convenience !!
        if (thisIndex == 0 && buttonIndex == 0) {
            //alert('Cannot delete the last remaining element.');               // do nothing for now

            return;

        } else if (thisIndex == buttonIndex) {
            // Special case: removing the control that bears the addButton

            // the addButton must be extracted and reinstated
            $(addButton).detach();
        }

        // get the controls succeeding the one that is to be removed because
        // their name attribute must be recalculated and updated
        var siblings = $(control).nextUntil();


        $(control).remove();

        // recalculate the names of all control succeeding the one that has just
        // been removed

        var prefix = $(addButton).attr('name');

        if (options == 'fluidtags') {

            $(siblings).each(function(index, element) {

                var newName = prefix + '[' + index + '][]';

                $($(element).find('.fluidtags')).data('setPrefix')(newName);
            });
        } else {
            $(siblings).each(function(index, element){
                $(element).find('[name]').each(function(i, e){

                    newName = $(this).attr('name').replace(prefix, '');
                    newName = newName.replace(/\[[0-9]+\]/, '');

                    // the check is performed to avoid renaming the addButton or
                    // other such control
                    if (newName != '') {
                        newName = prefix + '[' + (index+thisIndex)+ ']' + newName;
                        $(e).attr('name', newName);
                    }

                });
                $(element).find('[for]').each(function(i, e){

                    newValue = $(this).attr('for').replace(prefix, '');
                    newValue = newValue.replace(/\[[0-9]+\]/, '');

                    // the check is performed to avoid renaming the addButton or
                    // other such control
                    if (newValue != '') {
                        newValue = prefix + '[' + (index+thisIndex)+ ']' + newValue;
                        $(e).attr('for', newValue);
                    }

                });
            });
        }

        if (thisIndex == buttonIndex) {
            $($($($(container).children()).last()).find('.block_mdeditor_loc-placeholder')).append(addButton);
        }
    });
});


$.dform.subscribe('alternative_add', function(name, type) {
    $(this).click(function() {
        var containers = $("#block_mdeditor_dialog_form").data('containers');

/*
        var container = $('<div>').dform(containers[name + '-container']);
        container = $(container).children();
*/
        var ol = $($(this).parent()).children('ol');

        // if not done this way, the input text (and other elements?) do not
        // inherit ui classes
        $(ol).dform(containers[name + '-container']);//append(container);
        var container = $(ol).children().last();

        var placeholder = $(container).find('.block_mdeditor_loc-placeholder');
        if (placeholder) {
            var button = containers['localization-button'];
            button = $($('<div>').dform(button)).children();

            $(button).attr('name', name+'[1]');
            $(placeholder).append(button);
        }
    });
});

$.dform.subscribe('alternative_remove', function(options, type) {
    $(this).click(function() {
        // the element to remove
        var containerA = $(this).parents('.block_mdeditor_container-a');

        // use this to check whether the removal should be permitted
        var containerB = $(containerA).parents('.block_mdeditor_container-b');

        if ($($(containerB).children()).length > 1) {
            $(containerA).remove();
        }
    });
});