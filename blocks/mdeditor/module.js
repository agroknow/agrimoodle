M.block_mdeditor = {};

/*
M.block_mdeditor.edit_course = function(course_id, msg_error) {

    url = M.cfg.wwwroot + '/blocks/mdeditor/action/define_course.php';

    $.get(url, {"course_id": course_id}, "json")
        .success(function(data) {

            var obj = $.parseJSON(data);
            $("#block_mdeditor_edit_dialog").dform(obj);
        })

        .error(function(err) {
            alert(msg_error);
        });
}
*/

/* temporaty initialisation hack */
M.block_mdeditor.kit = null;

/* A callback function that will be informed when the user successfully saves
 * changes. This way, the Moodle block will be able to update its visual display
 * of the statuses.
 *
 * TODO: Need to update the title attribute of L10n.templates for the LO that
 * has been saved. Note, these items appear on the combobox (dropdown list) of
 * 'copy from template'. Note: This might be done in persistLOM (composer.js)
 * after the operation has just succeeded.
 */
M.block_mdeditor.update_status = function(params) {
    var block = M.block_mdeditor.block;
    var L10n = M.block_mdeditor.L10n;

    if (!params) {
        console.error("Empty params, cannot continue!");
        return -1;
    }

    if (params.type == 'course') {
        var div = $(block).find('.course_status_div')[0],
        caption = $(div).find('.course_status_caption')[0],
        status = $(div).find('.course_status')[0];

        $(caption).html(L10n['message'].course_status_caption);
        $(status).html(L10n['message']['course_status_' + params.status]);

    } else {
        var select = $(block).find('.block_mdeditor-resource_select')[0],
        item = $(select).children('[value=' + params.id + ']');

        if (!item) return;
        $(item).attr('class', 'status_' + params.status );								
        // change class of elements according to status! 
        $(item).attr('title', L10n['message']['course_status_' + params.status]);
    }
}

/* L10n and local will be merged into one array */
M.block_mdeditor.init = function(Y, course_id, course_status, resources, local) {
	
    console.log("Starting JS initialisation!");
    var block = $('#block_mdeditor-block');

    var url = {
        'persist' : M.cfg.wwwroot + '/blocks/mdeditor/action/persist.php'
        };

    if (! block) {
        console.error("Could not find the mdeditor block. Exiting!");
        return -1;
    }

    M.block_mdeditor.block = block;

    /* for some inexplicable reason, contribute3 is not included into the L10n,
     * if the latter is sent directly to this function via the parameters above;
     * need to get it via other means so here it goes… */
    $.get(M.cfg.wwwroot + '/blocks/mdeditor/L10n.php')
    .success(function(response) {

        var L10n = null;
        if (response) L10n = $.parseJSON(response);

        if (L10n) {
            $(block).data('L10n', L10n);
            M.block_mdeditor.L10n = L10n;

            /* for now, pass available resources and course as template via L10n */
            var templates = {};
            /* provide the course in the same format used by mods -- the key is
             * not really important any more */
            /* TODO: Provide a 'title' attribute as well */
            templates['cource'] = {
                "html"  : L10n.dialog.copy_from_course,
                "value" : course_id
            };
            L10n.templates = $.extend(templates, resources);

            /* temporaty initialization hack */
            block_mdeditor_init_kit(M.block_mdeditor, L10n);

            /* initialize the status of the labels of the course */
            M.block_mdeditor.update_status({
                "type" : "course",
                "status" : course_status
            });
        }
    /* perhaps make the block inaccessible because, no L10n means no strings
         * at all which in turn means no elements ! */
    });

    $(block).html('');

    /**
     * url : points at the action to be executed for storing changes
     * request_params : object with keys type and id; the define the target
     * resource/course to retrieved/stored
     * element : DOM element to be converted into a dialog upon user-request
     * msg_error : a localized error to display to the user if course/resource
     *  could not be fetched
     */
    $(block).data('open_dialog', function(requestParams, element, msg_error) {
        var base = M.cfg.wwwroot + '/blocks/mdeditor/action',
        sourceUrl = base + '/define.php';

        //		console.log("Trying to get data from url: ", sourceUrl, " With requestParams: ", requestParams);
        $.get(sourceUrl, requestParams, "json")
        .success(function(response) {
            //			console.log("Parsing response for dialog JSON: ", response);
            if (response)
                resp_json = $.parseJSON(response)
            else
                resp_json = "";
            //			console.log("Parsed! Result is:", response, resp_json);

            /* response holds the data */
            var L10n = $(block).data('L10n'),                                   // ++++ TODO buggy?
            targetUrl = base + '/persist.php';

            requestParams.updateCallback = M.block_mdeditor.update_status;
            block_mdeditor_compose(element, resp_json, L10n, targetUrl, requestParams);
        })
        .error(function(err) {
            alert(msg_error);
            console.log(msg_error, err);
        });
    });
    
    /**
     * url : points at the action to be executed for storing changes
     * request_params : object with keys type and id; the define the target
     * resource/course to retrieved/stored
     * element : DOM element to be converted into a dialog upon user-request
     * msg_error : a localized error to display to the user if course/resource
     *  could not be fetched
     *  Diaog Box for translation!!
     */
    $(block).data('open_translate_dialog', function(requestParams, element, msg_error) {
        var base = M.cfg.wwwroot + '/blocks/mdeditor/action',
        sourceUrl = base + '/define.php';

        //console.log("Trying to translate data from url: ", sourceUrl, " With requestParams: ", requestParams);
        $.get(sourceUrl, requestParams, "json")
        .success(function(response) {
            //	console.log("Parsing response for dialog JSON: ", response);
            if (response)
                resp_json = $.parseJSON(response)
            else
                resp_json = "";
           
            /* response holds the data */
            var L10n = $(block).data('L10n'),                                   // ++++ TODO buggy?
            targetUrl = base + '/translate.php';

            requestParams['updateCallback'] = M.block_mdeditor.update_status;
            //flag for which div to show in translation dialog box (checklist or perform translation)
            requestParams.performTranslation = false;
            //console.log(requestParams);
            block_mdeditor_translate(element, resp_json, L10n, targetUrl, requestParams);
        })
        .error(function(err) {
            alert(msg_error);
            console.log(msg_error, err);
        });
    });
    

    $.dform.options.prefix = null;
    $(block).dform({
        "type"  : "container",
        "class" : "ui-widget",
        "html"  : [
        {
            "type"  : "container",
            "class" : "block_mdeditor-resources",
            "html"  : [
            {
                "type"     : "select",
                "class"    : "block_mdeditor-resource_select",
                "multiple" : true,
                "style"    : "width: 100%; margin-bottom: 5px;",
                "caption"  : {
                    "html" : local.edit_resource_desc,
                    "css"  : "font-size: 0.9em; color: #101010; line-height:0.9"
                },
                "options"  : resources,
                "post"     : function() {
                    $(block).data('resource_select', $(this));
                }
            },
            {
                "type"  : "button",
                "class" : "block_mdeditor-edit_resource",
                "style" : "margin-bottom: 2px; width: 100%",
                "html"  : local.edit_resource_button,
                "post"  : function() {
                    $(this).click(function(){
                        var select = $(block).data('resource_select');

                        if (! select) return;

                        var option = $(select).children(':selected');
                        option = option[0];

                        if (! option) return;

                        var params = {
                            "type" : "mod",
                            "id"   : $(option).val()
                            },
                        element = $(block).data('edit_dialog'),
                        msg_error = local.error_fetching_data;

                        $(block).data('open_dialog')(params,
                            element,
                            msg_error);
                    });
                }
            },
            {
                "type"  : "button",
                "class" : "block_mdeditor-edit_resource",
                "style" : "margin-bottom: 2px; width: 100%",
                "html"  : local.translate_resource_button,
                "post"  : function() {
                    $(this).click(function(){
                        var select = $(block).data('resource_select');

                        if (! select) return;
                        

                        var option = $(select).children(':selected');
                        option = option[0];
//                        console.log(option);

                        if (! option) return;

                        var params = {
                            "type" : "mod",
                            "id"   : $(option).val()
                            },
                        element = $(block).data('edit_dialog'),
                        msg_error = local.error_fetching_data;

                        $(block).data('open_translate_dialog')(params,
                            element,
                            msg_error);
                    });
                }
            }
            ]
        },
        //            {
        //                "type"  : "container",
        //                "style" : "margin-top: 1em;",
        //                "html"  : {
        //                    "type"  : "button",
        //                    "class" : "block_mdeditor_edit_course",
        //                    "html"  : local.edit_course_button,
        //                    "post"  : function() {
        //                        $(this).click(function(){
        //
        //                            var url = M.cfg.wwwroot + '/blocks/mdeditor/action/define_course.php',
        //                                data = {"course_id" : course_id},
        //                                element = $(block).data('edit_dialog'),
        //                                msg_error = local.error_fetching_data;
        //
        //                            $(block).data('open_dialog')(url,
        //                                                         data,
        //                                                         element,
        //                                                         msg_error);
        //                        });
        //                    }
        //                }
        //            },
        {
            "type"  : "container",
            "style" : "margin-top: 1em;",
            "html"  : [
            {
                "type"  : "container",
                "class" : "course_status_div",
                "html"  : [
                {
                    "type"  : "label",
                    "class" : "course_status_caption"
                },
                {
                    "type"  : "label",
                    "class" : "course_status"
                }
                ]
            },
            {
                "type"  : "button",
                "class" : "block_mdeditor-edit_course",
                "style" : "margin-bottom: 10px; width: 100%",
                "html"  : local.edit_course_button,
                "post"  : function() {
                    $(this).click(function() {

                        var params = {
                            "type" : "course",
                            "id"   : course_id
                        },
                        element = $(block).data('edit_dialog'),
                        msg_error = local.error_fetching_data;

                        $(block).data('open_dialog')(params,
                            element,
                            msg_error);
                    });
                }
            },
            {
                "type"  : "button",
                "class" : "block_mdeditor-edit_course",
                "style" : "margin-bottom: 10px; width: 100%",
                "html"  : local.translate_course_button,
                "post"  : function() {
                    $(this).click(function() {

                        var params = {
                            "type" : "course",
                            "id"   : course_id
                        },
                        element = $(block).data('edit_dialog'),
                        msg_error = local.error_fetching_data;

                        $(block).data('open_translate_dialog')(params,
                            element,
                            msg_error);
                    });
                }
            }
            ]
        },
        {
            "type" : "span",
            "id"   : "block_mdeditor-edit_dialog",
            "post" : function(){
                $(block).data('edit_dialog', this);
            }
        }
        ]
    });
	

/* display a listbox that allows selection of one item at a time */
// This is not complete !!
// $($(block).find('select.block_mdeditor-resource_select option')).click(
//     function() {
//         $(this).siblings('option').prop('selected', false);
//     });
};
