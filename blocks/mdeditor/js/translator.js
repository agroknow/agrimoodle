/* 
 * Implements the dialog with the form for translation of LOM records
 */

var dialog;

var langs;

function block_mdeditor_translate(target, data, L10n, targetUrl, requestParams) {
    data || (data = {});

    $.dform.options.prefix = null;

    var kit = M.block_mdeditor.kit,
    repo = kit.langRepo,
    persistLOM = kit.persistLOM,
    composeInput = kit.composeInput,
    composeChecklist = kit.composeChecklist,
    composeDescription = kit.composeDescription,
    composeKeyword = kit.composeKeyword;


    //console.log( ' DATA', data);
    //console.log( ' DATA', data.title);

    var form = 'block_mdeditor-edit_form', //'block_mdeditor-edit_dialog',
    formSelector = '#'+form;
    
    //console.log('step 0');
    
    if (! requestParams.performTranslation) {
        dialog = {
            "type"   : "container",
            "id"     : 'block_mdeditor-dialog',
            "dialog" : {
                "title"     : L10n.dialog.translateCaption,
                "resizable" : true,
                "modal"     : true,
                "width"     : 650,
                "height"    : 400,
                "maxHeight" : 600,
                "position"  : {
                    // my: "center top+80", 
                    // at: "center top+80",
                    at: "center 80", 
                    of: window
                },
                "closeOnEscape" : false,
                "close"     : function( event, ui ) {
                    // remove dialog and ALL its elements

                    var f = $.proxy(repo.clear, repo);
                    f();

                    $(this).remove();
                    $(this).dialog("destroy");
                }
            },
            "dialog_init" : true,
            "html" : {
                "type" : "form",
                "id"   : form,
                "html" : [
                {
                    "type"    : "fieldset",
                    "caption" : L10n.category.selectelanguage,
                    "html"    : [
                    {
                        "type" : "span",
                        "style"   : "height : auto;",
                        "html" : composeChecklistTranslation(kit, data, 'translationSelectLanguage', L10n, '',{
                            "width" : "100%;",
                            "height" : "190px;"
                        })
                    }
                    ]
                },
                {
                    "type"    : "container",
                    "class"   : "block_mdeditor-element_heading",
                    "html"    : [
                    {
                        "type"    : "a",
                        "href"    : "javascript:void(0)",
                        "html"    : "Proceed with Translation",
                        "onclick" : function() {
                            $(this).click(function(e) {
                                requestParams.performTranslation = true;
                                var selectedLangs = $("#translationSelectLanguage input:checkbox:checked").map(function(){
                                    return $(this).val();
                                }).get();
                                requestParams.selectedLangs = selectedLangs;
                                block_mdeditor_translate(target, data, L10n, targetUrl, requestParams);
                               // console.log('step 2');
                            //                                $.get(sourceUrl, requestParams, "json");
                            //                                /* costruct the url for this particular
                            //                                         * course/resource */
                            //                                var url = targetUrl + '?state=complete',
                            //                                f = null,
                            //                                prevent = true;
                            //
                            //                                f = $.proxy(persistLOM, e.target);
                            //                                prevent = f(formSelector, url, requestParams, L10n, true);
                            //                                if (prevent) e.preventDefault();
                            });
                        }
                    },
                    {
                        "type"  : "span",
                        "class" : "save-status",
                        "style" : "padding-left: 5px;"
                    }
                    ]
                }
                ]
            }
        };        
        //    L10n.element.language13.options = L10n.common.languages;
        $.dform.options.prefix = null;
        $(target).dform(dialog);
        
    } else {
        //console.log('step 3', dialog);
        
        var selectedLangs = requestParams.selectedLangs;
        add_tanslation_in_json_variable(selectedLangs, data);
        // data.title[0] = 


        var e = {
            "title" : block_mdeditor_compose_title_translation(kit, data, 'title', L10n),
            "description" : composeDescription(kit, data, 'description', L10n),
            "keyword"     : composeKeyword(kit, data, 'keyword', L10n)
        };


        var newDialog = {
            "html" : {
                "type" : "form",
                "id"   : form,
                "html" : [
                {
                    "type"    : "fieldset",
                    "caption" : L10n.category.general,
                    "html"    : [
                    {
                        "type" : "span", 
                        "class": "rule_mandatory",
                        "html" : "TRANSLATING TO : <pre>" + selectedLangs + "</pre>"
                    },
                    {
                        "type" : "span", 
                        "class": "rule_mandatory",
                        "html" : e.title
                    },
                    {
                        "type" : "span", 
                        "class": "rule_mandatory",
                        "html" : e.description
                    },
                    {
                        "type" : "span",
                        "html" : e.keyword
                    }
                    ]
                },
                {
                    "type"    : "container",
                    "class"   : "block_mdeditor-element_heading",
                    "html"    : [
                    {
                        "type"    : "button",
                        "href"    : "#",
                        "html"    : "Translate",
                        "post"    : function() {
                            $(this).click(function(e) {
                                /* costruct the url for this particular
                                         * course/resource */
                                var url = targetUrl + '?state=complete',
                                f = null,
                                prevent = true;

                                f = $.proxy(persistLOM, e.target);
                                prevent = f(formSelector, url, requestParams, L10n, true);
                                if (prevent) e.preventDefault();
                            });
                        }
                    },
                    {
                        "type"  : "span",
                        "class" : "save-status",
                        "style" : "padding-left: 5px;"
                    }
                    ]
                }
                ]
            }
        };
        
        //console.log('step 4');
        
        //        $("#block_mdeditor-dialog").element = '';
        $(formSelector).html('');
        $(formSelector).dform(newDialog.html);
    }


}

function composeChecklistTranslation(kit, data, fieldName, L10n, classes, widget) {
    var allLangs = $.extend(true, {}, L10n.element[fieldName].options);

       
    //check the title for languages that already exist and select the checkbox
    for (i in data.title) {
        var key = data.title[i].language;
        if (allLangs[key]) {
            allLangs[key].selected = 'selected';
        }   
    }
    return block_mdeditor_compose_checklist(kit, allLangs, fieldName, L10n, classes, widget);
}

function add_tanslation_in_json_variable(selectedLangs, data) {
    var title_to_send;
    
    //console.log(data.title);
    if (data.title[0]){
        title_to_send = {
            language : data.title[0].language,
            value : data.title[0].value
        }
    } 

    // check for english title
    for (t in data.title) {
        if (data.title[t].language == 'en') {
            title_to_send = data.title[t];
        }
    }
    //console.log(title_to_send);
    
    var count = data.title.length-1;
    for (sl in selectedLangs) {
        var lang = selectedLangs[sl];
        //        var title = data.title;
        var found = false;
        for (i in data.title) {
            if (found) break;
            if (lang == data.title[i].language) {
                found = true;
            }
        }        
        if (!found) {
            count+=1;
            data.title[count] = new Object()         
            data.title[count].language = lang;
            data.title[count].value = AMT(title_to_send, lang, count);
                
        //data.title[count].value = '123';
        }

    //console.log(sl, lang, data.title[sl]);
        
    }

    
}

function AMT(object_to_send, lang, count) {
    var url = 'http://aglr.agroknow.gr/translationapi/analytics/translate?text='+object_to_send.value+'&to='+lang+'&from='+object_to_send.language+'';

    url=escape(url);
    $.when( $.ajax({
        url : '../blocks/mdeditor/proxy.php?url='+url,
        dataType: 'json',
        success : function(res){
            //console.log(res.data.translation);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR, textStatus, errorThrown);
        }
    
    })
    ).done(function( output ) {
        if(output){    
            //console.log('123',output.data.translation, count);         
            //$('#title['+count+'].value').html(output.data.translation);
            //$('#block_mdeditor-edit_form').elements.title[count][value] = output.data.translation;
            $('#block_mdeditor-edit_form  textarea[name=title\\['+count+'\\]\\[value\\]]').val(output.data.translation);
            return output;
        }
    })

}

function block_mdeditor_compose_title_translation(kit, data, fieldName, L10n) {
    fieldName || (fieldName = 'title');

    var
    /* functions */
    setData = kit.setData,
    wombBear = kit.wombBear,
    setLocButton = kit.setLocButton,
    newLocale = kit.newLocale,
    setIndex = kit.setIndex,
    hideLocale = kit.hideLocale,
    runInstead = kit.runInstead,
    runMethod = kit.runMethod,

    /* objects */
    womb = kit.womb,
    out = kit.out,
    langRepo = kit.langRepo,
    addLocaleButton = kit.addLocaleButton,

    /* variables */
    controlClass = kit.controlClass,
    containerClass = kit.containerClass;

    out.clear();


    /* set the current key-name of this field. The key-name is a unique id that
     * can be used as key in an object */
    out.add(fieldName, 'keyName', fieldName);
    

    /*
     * Describe the element
     */
    var titleControl = {
        "type"  : "container",
        "class" : controlClass, 
        "default-mapper" : {
            "womb"    : womb,
            "name"    : fieldName,
            "params"  : [{
                "sel" : "[name=value]",
                "ref" : "value"
            },
            {
                "sel" : "[name=language]",
                "ref" : "lang"
            },
            {
                "sel" : "[for=value]",
                "ref" : "value-error"
            },
            {
                "sel" : ".placeholder",
                "ref" : "placeholder"
            }],
            "indexer" : {
                "value" : {
                    "attr"   : "name",
                    "suffix" : "[value]"
                },
                "lang"  : {
                    "attr"   : "name",
                    "suffix" : "[language]"
                },
                "value-error" : {
                    "attr"   : "for",
                    "suffix" : "[value]"
                }
            }
        },
        "html"  : [
        {
            "type"  : "container",
            "class" : "block_mdeditor-element_oneline",
            "html"  : [ 
            {
                "type"  : "label",
                "class" : "error",
                "for"   : "value",
                "generated" : true
            },
            {
                "type"  : "span",
                "class" : "block_mdeditor-element_top",
                "html"  : [
                {
                    "type"  : "textarea",
                    "name"  : "value",
                    "rows" : "2",
                    "style": "width: 250px",
                    // "size"  : 40,
                    "class" : "rule_non-empty"
                },
                {
                    "type" : "language-selector",
                    "name" : out.get(fieldName, 'keyName'),
                    "repo" : langRepo,
                    "attr" : {
                        "name" : "language"//,
                        //"disabled" : "disabled"
                    }
                },
                {
                    "type"  : "span",
                    "class" : "block_mdeditor-minus_plus",
                    "html"  : [
                    //                    { 
                    //                        "type" : "a",
                    //                        "class" : "ui-icon ui-icon-minus block_mdeditor-multiplicity_icons",
                    //                        "href"  : '#',
                    //                        "html"  : '[-]',
                    //                        "title" : L10n.common.langString_hide,
                    //                        "post"  : function() {
                    //                            out.add(fieldName, 'hideLocale', this);
                    //                            $(this).click(runMethod);
                    //                        }
                    //                    },
                    /* this is where the new-locale button resides */
                    {
                        "type"  : "span",
                        "class" : "placeholder"
                    }
                    ]
                }
                ]
            }
            ]
        }
        ]
    };
    //console.log('titlecontrol', titleControl);
    var titleContainer = {
        "type"  : "container",
        "class" : containerClass + ' block_mdeditor-block rule_mandatory',
        "default-mapper" : {
            "womb"   : womb,
            "name"   : fieldName + 'container',
            "array"  : true,
            "params" : [{
                "sel" : "." + controlClass,
                "ref" : "control"
            }]
        },
        "post" : function() {
            /* Eg, the data given to this container will contain a 'language'
             * key. The value of that key will be stored into a ref named 'lang'
             * within some control */

            /*
             * data array of objects that conform to the data format this
             *  container can handle
             *
             */
            $(this).data('setData', setData);
            $(this).data('addChild', newLocale);
            $(this).data('hideChild', hideLocale);
            $(this).data('dataFormat', {
                "language" : {
                    "ref"     : "lang",
                    "trigger" : "change"
                },
                "value"   : {
                    "ref" : "value"
                }
            });
        },
        "html"  : [
        {
            "type"    : "container",
            "html"    : L10n.element[fieldName].caption,
            "class"   : "block_mdeditor-element_heading"
        },
        {
            "type"    : "container",
            "html"    : titleControl
        }
        ]
    };


    /* create an 'instance' of this top-level container */
    var c = $('<div>').dform(titleContainer);
    
    /* get rid of the wrapper div */
    c = $(c).children()[0];


    var v = {
        /* provides a unique group id for the content of this field in shared
         * objects like womb, out… */
        "fieldName" : fieldName,

        /* a string to be prefixed when generating indices (usually, the name of
         * the field with a possible extension of [0] */
        "indexName" : fieldName,

        /* an id that uniquely identifies this field in a shared repo, and which
         * can be used as a key to an object */
        "keyName" : fieldName,

        /* the archetype of element this container generates */
        "child" : titleControl,

        /* provide general functionality */
        "womb" : womb,
        "out"  : out,
        "langRepo" : langRepo,


        /* this is to be invoked when a new child should be created */
        // "addChild" : newLocale,  replace by and .data() on "post"

        "localeHideButton" : out.get(fieldName, 'hideLocale'),


        /* there is an extra array, called `refs' which holds references to the
         * children of this container. It is created when a call to `wombBear'
         * has been performed. */

        /* this is sibling to refs (refs is being created via the womb).
         * It holds controls that have been hidden via the hideLocale element */
        "shades" : []
    };
    $(c).data(v);

    /* be careful not to override the description of the AddLocale button in the
     * object of shared properties */
    // addButton = $('<div>').dform(addLocaleButton);
    // addButton = $(addButton).children();
    // $(addButton).data('runInstead', {
    //    "target" : c
    //});

    // $(c).data('localeButton', addButton);


    /* call post-definition functions on the newly-created elements */
    wombBear(womb);


    /* the container is created with a default child; needs initialization in
     * some aspects */
    var child = $(c).data('refs')[0]; // it is an array now

    /* set the parameters that are required when attempting to hide this child
     */
    var hide = out.get(fieldName, 'hideLocale');
    $(hide).data('runMethod', {
        "method" : "hideChild",
        "target" : c,
        "data"   : child
    });


    var func = $.proxy(setIndex, child),
    indexName = $(c).data('indexName');
    func(indexName, 0, $(child).data('stims'));


    //setLocButton(addButton, child);

    /* set data if any are available */
    if (data[fieldName]) {
        var func = $.proxy($(c).data('setData'), c);
        func(data[fieldName]);
    }
    //console.log('titleContainer', data);

        

    out.clear();

    return c;
}

