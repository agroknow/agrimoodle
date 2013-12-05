function block_mdeditor_compose_title(kit, data, fieldName, L10n) {
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
                        "name" : "language"
                    }
                },
                {
                    "type"  : "span",
                    "class" : "block_mdeditor-minus_plus",
                    "html"  : [
                    { 
                        "type" : "a",
                        "class" : "ui-icon ui-icon-minus block_mdeditor-multiplicity_icons",
                        "href"  : '#',
                        "html"  : '[-]',
                        "title" : L10n.common.langString_hide,
                        "post"  : function() {
                            out.add(fieldName, 'hideLocale', this);
                            $(this).click(runMethod);
                        }
                    },
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
    addButton = $('<div>').dform(addLocaleButton);
    addButton = $(addButton).children();
    $(addButton).data('runInstead', {
        "target" : c
    });

    $(c).data('localeButton', addButton);


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


    setLocButton(addButton, child);

    /* set data if any are available */
    if (data[fieldName]) {
        var func = $.proxy($(c).data('setData'), c);
        func(data[fieldName]);
    }

    out.clear();

    return c;
}

/**
 * Called by composeChecklist() and composeChecklistTranslation()
 *
 * @param widget: currently, only 'height' and 'width' is supported
 */
function block_mdeditor_compose_checklist(kit, data, fieldName, L10n, classRule, widget) {
    fieldName || (fieldName = 'checklist');
    classRule || (classRule = '');
    widget || (widget = {});

    var controlClass = kit.controlClass,
    containerClass = kit.containerClass;

    var style = '';
    style += 'height: ' + (widget['height'] ? widget['height'] : '100px;');
    style += 'width:  ' + (widget['width']  ? widget['width']  : '100%;');

    /*
     * Describe the element
     */
    var control = {
        "type"  : "container",
        "class" : controlClass  + ' block_mdeditor-block',
        "html"  : [
        {
            "type"    : "container",
            "html"    : L10n.element[fieldName].caption,
            "class"   : "block_mdeditor-element_heading"
        },
        {
            "type"  : "container",
            "html"  : {
                "type"  : "label",
                "class" : "error",
                "for"   : fieldName+'[]',
                "generated" : true
            }
        },
        {
            "type"        : "select",
            "id"          : fieldName,
            "name"        : fieldName,
            "multiple"    : "multiple",
            "style"       : style,
            "options"     : data,
            "toChecklist" : {
                // "addSearchBox"      : true,
                // "searchBoxText"     : L10n.element[fieldName].searchtext,
                "showSelectedItems" : true,
                "preferIdOverName"  : false,
                "checkboxClass"     : classRule + ' checklist-option'
            }
        }
        ]
    };

    return $.extend(true, {}, control);
}

/*
 * widget - an object describing the input element
 */
function block_mdeditor_compose_description(kit, data, fieldName, L10n, widget) {
    fieldName || (fieldName = 'description');
    widget || (widget = {});

    var
    /* functions */
    setData = kit.setData,
    setContainerData = kit.setContainerData,
    wombBear = kit.wombBear,
    setLocButton = kit.setLocButton,
    newLocale = kit.newLocale,
    newLocaleContainer = kit.newLocaleContainer,
    newLocaleContainerNG = kit.newLocaleContainerNG,
    setIndex = kit.setIndex,
    clearContainerIndex = kit.clearContainerIndex,
    setIndexToContainer = kit.setIndexToContainer,
    hideLocale = kit.hideLocale,
    hideContainer = kit.hideContainer,
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

    out.add(fieldName, 'keyName', fieldName + '-0');

    var defaults = {
        "type"  : "textarea",
        "name"  : "value",
        "post"  : function() {
            $(this).data('parent', out.get(fieldName, 'localeControl'));
        }
    // "class" : "rule_non-empty"
    };
    $.extend(defaults, widget);

    /*
     * Describe the element
     */

    var control = {
        "type"  : "container",
        "class" : controlClass + ' block_mdeditor-element_oneline',
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
        "post"  : function() {
            out.add(fieldName, 'localeControl', this);
        },
        "html"  : [
        {
            "type"  : "container",
            "html"  : {
                "type"  : "label",
                "class" : "error",
                "for"   : "value",
                "generated" : true
            }
        },
        defaults,
        {
            "type"  : "span",
            "class" : "block_mdeditor-element_top",
            "html"  : [
            {
                "type" : "language-selector",
                /* will set name in a dynamic fashion for this one -- see alt */
                "name" : null,
                "alt"  : function() {
                    return out.get(fieldName, 'keyName');
                },
                "repo" : langRepo,
                "attr" : {
                    "name"  : "language"
                }
            },
            {
                "type"  : "span",
                "html"  : [
                {
                    "type"  : "span",
                    "html"  : {
                        "type" : "a",
                        "class" : "ui-icon ui-icon-minus block_mdeditor-multiplicity_icons",
                        "href"  : '#',
                        "html"  : '[-]',
                        "title" : L10n.common.langString_hide,
                        "post"  : function() {
                            out.add(fieldName, 'hideLocale', this);
                            $(this).click(runMethod);
                        }
                    }
                },
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
    };

    var localeContainer = {
        "type"  : "li",
        "class" : containerClass,
        "default-mapper" : {
            "womb"   : womb,
            "name"   : fieldName + "-container",
            "array"  : true,
            "params" : [{
                "sel" : "." + controlClass,
                "ref" : "control"
            }]
        },
        "post" : function() {

            out.add(fieldName, 'localeContainer', this);

            /* Eg, the data given to this container will contain a 'language'
             * key. The value of that key will be stored into a ref named 'lang'
             * within some control */

            /*
             * data array of objects that conform to the data format this
             *  container can handle
             *
             */
            $(this).data('setData', setData);
            $(this).data('hideChild', hideLocale);
            $(this).data('addChild', newLocale);
            $(this).data('clearIndex', clearContainerIndex);

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
        "html" : [
        {
            "type" : "a",
            "href" : "#",
            "class": "block_mdeditor-cardinality_hide",
            "html" : L10n.element[fieldName].cardinality_hide,
            "post" : function() {
                out.add(fieldName, 'hideContainer', this);
                $(this).click(runMethod);
            }
        },
        control
        ]
    };

    var topContainer = {
        "type"  : "container",
        "class" :  "block_mdeditor-block rule_mandatory",
        "default-mapper" : {
            "womb"   : womb,
            "name"   : fieldName + '-top-container',
            "array"  : true,
            "params" : [{
                "sel" : "." + containerClass,
                "ref" : "control"
            }]
        },
        "html" : [
        {
            "type"  : "container",
            // FIXME: move plural to L10n
            "html"  : L10n.element[fieldName].caption + "(s)",
            "class" : "block_mdeditor-element_heading"
        },
        {
            "type"  : "ol",
            "class" : "block_mdeditor-multiple_values",
            "html"  : localeContainer
        },
        {
            "type"  : "a",
            "href"  : "#",
            // "html" : L10n.element[fieldName].cardinality_add,
            "html"  : "+ Add new",
            "style" : "border: 1px dotted; width: 250px",
            "post"  : function() {
                out.add(fieldName, 'addNew', this);
                $(this).click(runMethod);
            }
        }
        ],
        "post" : function() {
            $(this).data('hideChild', hideContainer);
            // ++++ !!!! FIXME: replace with NG !!!
            $(this).data('addChild', newLocaleContainer);            
            // $(this).data('addChild', newLocaleContainerNG);
            $(this).data('setData', setContainerData);
            $(this).data('dataFormat', {
                "language" : {
                    "ref"     : "lang",
                    "trigger" : "change"
                },
                "value"   : {
                    "ref" : "value"
                }
            });
        }
    };


    /* create an 'instance' of this top-level container */
    var t = $('<div>').dform(topContainer);
    t = $(t).children();



    var c = out.get(fieldName, 'localeContainer');


    //
    // INITIALIZE A CARDINALITY_GT1-CONTAINER
    //

    var addnew = out.get(fieldName, 'addNew');

    $(addnew).data('runMethod', {
        "target" : t,
        "method" : "addChild"
    });

    containerData = {

        // refs
        "womb" : womb,
        "out"  : out,
        "fieldName" : fieldName,

        "shades" : [],

        "child"  : localeContainer,
        "childData" : null
    };


    //
    // INITIALIZE A LOCALE-CONTAINER (post womb)
    //


    var v = {
        "fieldName" : fieldName,
        /* a string to be prefixed when generating indices (usually, the name of
         * the field with a possible extension of [0] */
        "indexName" : fieldName+'[0]',
        "keyName"   : fieldName+'-0',
        /* the archetype of element this container generates */
        "child"     : control,
        "localeButton" : addLocaleButton, // this is an object not a DOM element

        /* provide general functionality */
        "womb"      : womb,
        "out"       : out,
        "langRepo"  : langRepo,

        /* there is an extra array, called `refs' which holds references to the
         * children of this container. It is created when a call to `wombBear'
         * has been performed. */

        /* this is sibling to refs (refs is being created via the womb).
         * It holds controls that have been hidden via the hideLocale element */
        "shades"    : []

    /* this is to be invoked when a new child should be created */
    // "addChild"  : newLocale, replace this with a simple .data() on "post"
    };

    containerData.childData = v;
    $(t).data(containerData);



    /* be careful not to override the description of the AddLocale button in the
     * object of shared properties */
    addLocaleButton = $('<div>').dform(addLocaleButton);
    addLocaleButton = $(addLocaleButton).children();
    $(addLocaleButton).data('runInstead', {
        "target" : c
    });


    $(c).data(v);
    /* replace the elements that should NOT be shared among other instances */
    $(c).data('localeButton', addLocaleButton);
    $(c).data('shades', []);



    //
    // CALLING POST-DEFINITION FUNCTIONS
    //

    /* call post-definition functions on the newly-created elements */
    wombBear(womb);

    /* the container is created with a default child; needs initialization in
     * some aspects */
    var child = $(c).data('refs')[0];

    /* set the parameters that are required when attempting to hide this child
     */
    var hide = out.get(fieldName, 'hideLocale');
    $(hide).data('runMethod', {
        "method" : "hideChild",
        "target" : c,
        "data"   : child
    });

    var hide = out.get(fieldName, 'hideContainer');
    $(hide).data('runMethod', {
        "method" : "hideChild",
        "target" : t,
        "data"   : c
    });


    var func = $.proxy(setIndex, child),
    indexName = $(c).data('indexName');
    func(indexName, 0, $(child).data('stims'));

    setLocButton(addLocaleButton, child);
    // Process for localizable control

    /* set data if any are available */
    if (data[fieldName]) {
        var func = $.proxy($(t).data('setData'), t);
        func(data[fieldName]);
    }

    return t;
}

function block_mdeditor_compose_contribute(kit, data, fieldName, L10n, mandatory) {
    fieldName || (fieldName = 'contribute');
    mandatory || (mandatory = false);

    var
    /* functions */
    setData = kit.setData,
    setContainerData = kit.setContainerData,
    contributeSetData = kit.contributeSetData,
    wombBear = kit.wombBear,
    setLocButton = kit.setLocButton,
    newLocale = kit.newLocale,
    newLocaleContainer = kit.newLocaleContainer,
    newLocaleContainerNG = kit.newLocaleContainerNG,
    setIndex = kit.setIndex,
    setStimsIndex = kit.setStimsIndex,
    setStimsName = kit.setStimsName,
    setContainerName = kit.setContainerName,
    clearContainerIndex = kit.clearContainerIndex,
    clearContainerIndexNG = kit.clearContainerIndexNG,
    clearIndex = kit.clearIndex,
    clearStimsIndex = kit.clearStimsIndex,
    setIndexToContainer = kit.setIndexToContainer,
    hideLocale = kit.hideLocale,
    hideContainer = kit.hideContainer,
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

    var keyName = fieldName + '-0';
    out.add(fieldName, 'keyName', keyName);
    out.add(fieldName, 'indexName', fieldName + '[0]');

    /*
     * Describe the element
     */

    /* -- this object will usurper a field under the name 'description'
     * This is done only for convenience; see #1 -- */
    out.add('description', 'keyName', keyName);
    var control = {
        "type"  : "container",
        "class" : controlClass,
        "post"  : function() {
            // $(this).data('fieldName', !!);

            $(this).data('setFieldName', setStimsName);
            out.add(fieldName, 'localeControl', this);
        },
        "default-mapper" : {
            "womb"    : womb,
            "name"    : fieldName,
            "params"  : [{
                "sel" : ".placeholder",
                "ref" : "placeholder"
            },

            {
                "sel" : "[name=firstname]",
                "ref" : "firstname"
            },

            {
                "sel" : "[name=lastname]",
                "ref" : "lastname"
            },

            {
                "sel" : "[name=email]",
                "ref" : "email"
            },

            {
                "sel" : "[name=organization]",
                "ref" : "organization"
            }],
            "indexer" : {
                "firstname"    : {
                    "attr"   : "name",
                    "suffix" : "[firstname]"
                },
                "lastname"     : {
                    "attr"   : "name",
                    "suffix" : "[lastname]"
                },
                "email"        : {
                    "attr"   : "name",
                    "suffix" : "[email]"
                },
                "organization" : {
                    "attr"   : "name",
                    "suffix" : "[organization]"
                }
            }
        },
        "html"  : [
        {
            "type"  : "container",
            "html"  : {
                "type"  : "label",
                "class" : "error",
                "for"   : "value",
                "generated" : true
            }
        },
        {
            "type"    : "fieldset",
            "caption" : {
                "type" : "span",
                "html" : [
                {
                    "type"  : "span",
                    "html"  : [
                    /* this is where the new-locale button resides */
                    {
                        "type"  : "span",
                        "class" : "placeholder"
                    },
                    {
                        "type"  : "span",
                        "html"  : {
                            "type" : "a",
                            "class" : "ui-icon ui-icon-minus block_mdeditor-multiplicity_icons",
                            "href"  : '#',
                            "html"  : '[-]',
                            "title" : L10n.common.langString_hide,
                            "post"  : function() {
                                out.add('entity', 'hideLocale', this);
                                /* describe the name 'hideLocale' is registered
                                             * with (see previous command) */
                                out.add(fieldName, 'hideLocaleField', 'entity');
                                $(this).click(runMethod);
                            }
                        }
                    }
                    ]
                },
                {
                    "type" : "span",
                    "html" : "Entity"
                }
                ]
            },
            "html"    : [
            {
                "type"  : "container",
                "class" : "block_mdeditor-element_oneline",
                "html"  : {
                    "type"    : "text",
                    "name"    : "firstname",
                    // "caption" : L10n.element[fieldName].entities.firstname,
                    "size"    : 30,
                    "placeholder"   : L10n.element[fieldName].entities.firstname
                }
            },
            {
                "type"  : "container",
                "class" : "block_mdeditor-element_oneline",
                "html"  : {
                    "type"    : "text",
                    "name"    : "lastname",
                    // "caption" : L10n.element[fieldName].entities.lastname,
                    "size"    : 30,
                    "placeholder"   : L10n.element[fieldName].entities.lastname
                }
            },
            {
                "type"  : "container",
                "class" : "block_mdeditor-element_oneline",
                "html"  : {
                    "type"    : "text",
                    "name"    : "email",
                    // "caption" : L10n.element[fieldName].entities.email,
                    "size"    : 30,
                    "placeholder"   : L10n.element[fieldName].entities.email
                }
            },
            {
                "type"  : "container",
                "class" : "block_mdeditor-element_oneline",
                "html"  : {
                    "type"    : "text",
                    "name"    : "organization",
                    // "caption" : L10n.element[fieldName].entities.organization,
                    "size"    : 30,
                    "placeholder"   : L10n.element[fieldName].entities.organization
                }
            }
            ]
        }
        ]
    };

    var localeContainer = {
        "type"  : "container",
        "class" : containerClass + ' ' + fieldName + '-entities', // do we need the containerClass?
        "default-mapper" : {
            "womb"   : womb,
            "name"   : fieldName + "-entities",
            "array"  : true,
            "params" : [{
                "sel" : "." + controlClass,
                "ref" : "control"
            }]
        },
        "post" : function() {

            out.add(fieldName, 'localeContainer', this);

            var parent = out.get(fieldName, 'contributeContainer');
            $(parent).data('localeContainer', this);

            $(this).data('fieldName', keyName);
            $(this).data('nonlocale', true);

            $(this).data('setData', setData);
            $(this).data('hideChild', hideLocale);
            $(this).data('addChild', newLocale);
            $(this).data('clearIndex', clearContainerIndex);
            $(this).data('setFieldName', setContainerName);
        },
        "html" : [
        {
            "type"  : "container",
            "class" : "block_mdeditor-element_oneline",
            "html"  : L10n.element[fieldName].entities.caption
        },
        control
        ]
    };


    var uniContainer = {
        "type"  : "container",
        "class" : fieldName + '-uniContainer',
        "post"  : function() {
            $(this).data('fieldName', fieldName);
            $(this).data('setFieldName', setStimsName);
            $(this).data('clearIndex', clearStimsIndex);
            $(this).data('setData', uniSetData);
            out.add(fieldName, 'uniContainer', this);

            var parent = out.get(fieldName, 'contributeContainer');
            $(parent).data('uniContainer', this);

        },
        "default-mapper" : {
            "womb"    : womb,
            "name"    : fieldName + '-uni',
            "params"  : [{
                "sel" : ".role",
                "ref" : "role"
            },

            {
                "sel" : ".date",
                "ref" : "date"
            },

            {
                "sel" : ".role_error",
                "ref" : "role_error"
            },

            {
                "sel" : ".date_error",
                "ref" : "date_error"
            }],

            "indexer" : {
                "role" : {
                    "attr"   : "name",
                    "suffix" : "[role]"
                },
                "date" : {
                    "attr"   : "name",
                    "suffix" : "[date]"
                },
                "role_error" : {
                    "attr"   : "for",
                    "suffix" : "[role]"
                },
                "date_error" : {
                    "attr"   : "for",
                    "suffix" : "[date]"
                }
            }
        },
        "html" : [
        {
            "type"  : "container",
            "html"  : {
                "type"  : "label",
                "class" : "error role_error",
                /* "for"   : "", // need to update with each new */
                "generated" : true
            }
        },
        {
            "type"    : "select",
            "class"   : "role rule_exactly-one block_mdeditor-element_oneline",
            // "caption" : L10n.element[fieldName].role.caption,
            "options" : L10n.element[fieldName].role.options
        },
        {
            "type"  : "container",
            "html"  : {
                "type"  : "label",
                "class" : "error date_error",
                /* "for"   : "", // need to update with each new */
                "generated" : true
            }
        },
        {
            "type"    : "text",
            "class"   : "date block_mdeditor-element_oneline",
            "caption" : L10n.element[fieldName].date.caption,
            "datepicker" : {
                "dateFormat" : "mm/dd/yy"
            }
        },
        {
            "type"  : "span",
            "class" : "ui-icon ui-icon-calendar block_mdeditor-multiplicity_icons",
            "html"  : "&nbsp;"
        }
        ]
    };


    var contributeContainer = {
        "type"  : "li",
        "class" : fieldName + '-contributeContainer',
        "default-mapper" : {
            "womb"   : womb,
            "name"   : fieldName + '-contributeContainer',
            "array"  : true,
            "params" : [{
                "sel" : '.' + fieldName + '-uniContainer',
                "ref" : "control"
            },

            {
                "sel" : '.' + fieldName + '-entities',
                "ref" : "control"
            }]
        },
        "post" : function() {
            out.add(fieldName, 'contributeContainer', this);
            out.add(fieldName, 'localeContainerParent', this);

            $(this).data('setIndex', setStimsIndex);
            $(this).data('clearIndex', clearContainerIndexNG);
            $(this).data('fieldName', fieldName);
            $(this).data('setData', contributeSetData);
        },
        "html" : [
        {
            "type" : "a",
            "href" : "#",
            "html"  : L10n.element[fieldName].cardinality_hide,
            "post" : function() {
                out.add(fieldName, 'hideContainer', this);
                $(this).click(runMethod);
            }
        },
        uniContainer,
        localeContainer
        ]
    };


    var topContainer = {
        "type" : "container",
        "default-mapper" : {
            "womb"   : womb,
            "name"   : fieldName + '-top-container',
            "array"  : true,
            "params" : [{
                "sel" : '.' + fieldName + '-contributeContainer',
                "ref" : "control"
            }]
        },
        "html" : [
        {
            "type"  : "container",
            "html"  : L10n.element[fieldName].caption,
            "class" : "block_mdeditor-element_heading"
        },
        {
            "type"  : "ol",
            "class" : "block_mdeditor-multiple_values",
            "html"  : contributeContainer
        },
        {
            "type"  : "a",
            "href"  : "#",
            "html"  : L10n.element[fieldName].cardinality_add,
            "post"  : function() {
                out.add(fieldName, 'addNew', this);
                $(this).click(runMethod);
            }
        }
        ],
        "post" : function() {
            $(this).data('hideChild', hideContainer);
            $(this).data('addChild', newLocaleContainerNG);
            $(this).data('setData', setContainerData);
            $(this).data('dataFormat', {
                "firstname" : {
                    "ref"   : "firstname"
                },
                "lastname"  : {
                    "ref"   : "lastname"
                },
                "email"     : {
                    "ref"   : "email"
                },
                "organization" : {
                    "ref"   : "organization"
                }
            });
        }
    };


    /* create an 'instance' of this top-level container */
    var t = $('<div>').dform(topContainer);
    t = $(t).children();
    //
    // INITIALIZE A CARDINALITY_GT1-CONTAINER
    //

    var addnew = out.get(fieldName, 'addNew');

    $(addnew).data('runMethod', {
        "target" : t,
        "method" : "addChild"
    });

    containerData = {
        // refs
        "womb" : womb,
        "out"  : out,
        "fieldName" : fieldName,

        "shades" : [],

        "child"  : contributeContainer,
        "childData" : null /* childData is currently used when creating a
                             * localeContainer !*/
    };


    //
    // INITIALIZE A LOCALE-CONTAINER (post womb)
    //


    var v = {

        /* Setting this to 'description' means that when the object is dform-ed
         * it will create a reference in the `out' object under that name, which
         * is not so clear. It should not create problems, though, because, the
         * `out' object (just like the Womb) is only utilized during the process
         * of creating new DOM elements.
         * On the plus side, setting this to description instead of 'contribute'
         * accomodates the use of setFieldName 'method'. */
        "fieldName" : 'entity',


        /* a string to be prefixed when generating indices (usually, the name of
         * the field with a possible extension of [0] */
        "indexName" : fieldName + '[0]',//+'[0]',
        "keyName"   : keyName, /* this is replace before each new dform */
        /* the archetype of element this container generates */
        "child"     : control,
        "localeButton" : addLocaleButton, // this is an object not a DOM element

        /* provide general functionality */
        "womb"      : womb,
        "out"       : out,
        "langRepo"  : langRepo,

        /* there is an extra array, called `refs' which holds references to the
         * children of this container. It is created when a call to `wombBear'
         * has been performed. */

        /* this is sibling to refs (refs is being created via the womb).
         * It holds controls that have been hidden via the hideLocale element */
        "shades"    : []

    /* this is to be invoked when a new child should be created */
    // "addChild"  : newLocale, replace this with a simple .data() on "post"
    };

    containerData.childData = v;
    $(t).data(containerData);


    var c = out.get(fieldName, 'localeContainer');

    /* be careful not to override the description of the AddLocale button in the
     * object of shared properties */
    addLocaleButton = $('<div>').dform(addLocaleButton);
    addLocaleButton = $(addLocaleButton).children();
    $(addLocaleButton).data('runInstead', {
        "target" : c
    });


    $(c).data(v);
    /* replace the elements that should NOT be shared among other instances */
    $(c).data('localeButton', addLocaleButton);
    $(c).data('shades', []);


    //
    // CALLING POST-DEFINITION FUNCTIONS
    //

    /* call post-definition functions on the newly-created elements */
    wombBear(womb);

    /* the container is created with a default child; needs initialization in
     * some aspects */
    var child = $(c).data('refs')[0];

    /* set the parameters that are required when attempting to hide this child
     */
    var hide = out.get('entity', 'hideLocale');
    $(hide).data('runMethod', {
        "method" : "hideChild",
        "target" : c,
        "data"   : child
    });




    setLocButton(addLocaleButton, child);
    // Process for localizable control



    /* set the index to all children */
    var r = out.get(fieldName, 'contributeContainer');

    var hide = out.get(fieldName, 'hideContainer');
    $(hide).data('runMethod', {
        "method" : "hideChild",
        "target" : t,
        "data"   : r
    });


    var f = $(r).data('setIndex');
    f = $.proxy(f, r);
    f(0);

    /* set data if any are available */
    if (data[fieldName]) {
        var func = $.proxy($(t).data('setData'), t);
        func(data[fieldName]);
    }

    return t;


    /*
     * uniContainer needs special handling of data passed to it.
     */
    function uniSetData(data) {
        var refs = $(this).data('refs');

        if (data.role) $(refs['role']).val(data.role);

        if (data.date) $(refs['date']).val(data.date);

    }
}

function block_mdeditor_compose_rights(kit, data, fieldName, L10n) {
    fieldName || (fieldName = 'rights');

    var
    /* functions */
    setData = kit.setData,
    rightsSetData = kit.rightsSetData,
    setContainerData = kit.setContainerData,
    wombBear = kit.wombBear,
    setLocButton = kit.setLocButton,
    newLocale = kit.newLocale,
    newLocaleContainer = kit.newLocaleContainer,
    newLocaleContainerNG = kit.newLocaleContainerNG,
    setIndex = kit.setIndex,
    setStimsIndex = kit.setStimsIndex,
    setStimsName = kit.setStimsName,
    setContainerName = kit.setContainerName,
    clearContainerIndex = kit.clearContainerIndex,
    clearContainerIndexNG = kit.clearContainerIndexNG,
    clearIndex = kit.clearIndex,
    clearStimsIndex = kit.clearStimsIndex,
    setIndexToContainer = kit.setIndexToContainer,
    hideLocale = kit.hideLocale,
    hideContainer = kit.hideContainer,
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

    var keyName = fieldName + '-0';
    out.add(fieldName, 'keyName', keyName);
    out.add(fieldName, 'indexName', fieldName + '[0]');

    function postCCButton() {
        var parent = out.get(fieldName, 'localeControl');
        $(this).data('parent', parent);
        $(this).data('license', $(this).attr('id'));
        $(this).removeAttr('id');
        $(this).click(CCClick);
    }

    function CCClick(event) {
        event.preventDefault();
        var parent = $(this).data('parent')
        refs = $(parent).data('refs'),
        select = refs['lang'],
        language = $(select).val();
        if (! language) return;

        /* we have the language, so make a request to get the license text */

        var license = $(this).data('license');
        if (! license) return;

        var pending = refs['pending'],
        url = M.cfg.wwwroot + '/blocks/mdeditor/action/get_license?' +
        'license=' + license +
        '&language=' + language;

        if (pending) {
            $(pending).html(L10n['message'].pending_response);
            $(pending).show('fast');
        }

        $.get(url)
        .success(function(response) {
            if (! response) {
                $(pending).html(L10n.error.error_occurred);
                $(pending).hide('slow');
                return;
            }

            var license = $.parseJSON(response);
            if (! license) {
                $(pending).html(L10n.error.error_occurred);
                $(pending).hide('slow');
                return;
            }

            var textarea = refs['value'];
            $(textarea).val(license);

            $(pending).hide('fast');
        });
    }

    /*
     * Describe the element
     */

    /* this object will usurper a field under the name 'description'
     * This is done only for convenience; see #1 */
    out.add('description', 'keyName', keyName);
    var control = {
        "type"  : "container",
        "class" : controlClass,
        "post"  : function() {

            $(this).data('setFieldName', setStimsName);
            out.add(fieldName, 'localeControl', this);
        },
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
            },

            {
                "sel" : ".pending",
                "ref" : "pending"
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
            "html"  : {
                "type"  : "label",
                "class" : "error",
                "for"   : "value",
                "generated" : true
            }
        },
        {
            "type"  : "container",
            "class" : "block_mdeditor-element_oneline",
            "html"  : [
            {
                "type" : "button",
                "html" : "CC0",
                "id"   : "cc0",
                "post" : postCCButton
            },
            {
                "type" : "button",
                "html" : "CC1",
                "id": "cc1",
                "post" : postCCButton
            },
            {
                "type" : "button",
                "html" : "CC2",
                "id"   : "cc2",
                "post" : postCCButton
            },
            {
                "type"  : "container",
                "class" : "pending block_mdeditor-element_oneline"
            }
            ]
        },
        {
            "type"  : "textarea",
            "name"  : "value",
            "class" : "rule_non-empty"
        },
        {
            "type"  : "span",
            "class" : "block_mdeditor-element_top",
            "html"  : [
            {
                "type"  : "language-selector",
                /* will set name in a dynamic fashion for this one -- see alt */
                "name"  : null,
                "alt"   : function() {
                    /* before changing this, see #1 */
                    return out.get('description', 'keyName');
                },
                "repo" : langRepo,
                "attr" : {
                    "name"  : "language",
                    "value" : "en"
                }
            },
            {
                "type"  : "span",
                "html"  : [
                {
                    "type"  : "span",
                    "html"  : {
                        "type" : "a",
                        "class" : "ui-icon ui-icon-minus block_mdeditor-multiplicity_icons",
                        "href"  : '#',
                        "html"  : '[-]',
                        "post"  : function() {
                            out.add('description', 'hideLocale', this);
                            /* describe the name 'hideLocale' is registered
                                         * with (see previous command) */
                            out.add(fieldName, 'hideLocaleField', 'description');
                            $(this).click(runMethod);
                        }
                    }
                },
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
    };

    var localeContainer = {
        "type"  : "container",
        "class" : containerClass + ' ' + fieldName + '-descriptions', // do we neeed the containerClass?
        "default-mapper" : {
            "womb"   : womb,
            "name"   : fieldName + "-container",
            "array"  : true,
            "params" : [{
                "sel" : "." + controlClass,
                "ref" : "control"
            }]
        },
        "post" : function() {

            out.add(fieldName, 'localeContainer', this);

            var parent = out.get(fieldName, 'rightsContainer');
            $(parent).data('localeContainer', this);

            $(this).data('fieldName', keyName);

            $(this).data('setData', setData);
            $(this).data('hideChild', hideLocale);
            $(this).data('addChild', newLocale);
            $(this).data('clearIndex', clearContainerIndex);
            $(this).data('setFieldName', setContainerName);

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
        "html" : control
    };


    /*
     * Runs in context.
     * Changes the name of this parent's children taking into account their
     * index.
     * Updates the names of its children (via setIndex).
     */
    function mySetName(newName) {

        var refs = $(this).data('refs'),
        ref = null,
        setName = $(refs[0]).data('setFieldName'),
        indexName = newName + '[' + $(this).data('fieldName') +']',
        f = null;

        for (var i = 0 ; i < refs.length ; ++i) {
            ref = refs[i];
            /* update the prefix of the child, eg rights[0][description] */
            f = $.proxy(setName, refs[i]);
            f(indexName + '[' + i + ']');
        }
    }


    /*
     * uniContainer needs special handling of data passed to it.
     */
    function uniSetData(data) {
        var refs = $(this).data('refs');

        if (data.cost) {
            if (data.cost == 'no')  $(refs['cost_no']).attr('checked', true);
            else if (data.cost == 'yes') $(refs['cost_yes']).attr('checked', true);
        }

        if (data.restrictions) {
            if (data.restrictions == 'no')  $(refs['restrictions_no']).attr('checked', true);
            else if (data.restrictions == 'yes') $(refs['restrictions_yes']).attr('checked', true);
        }

        if (data.cc) {
            var target = $(this).find('[value=' + data.cc + ']');

            if (target) {
                $(target).attr('checked', true);
            }
        }
    }

    var cc = L10n.element.rights.cc_options;
    // var ccOptions = {},
    //     options = L10n.element.rights.cc_options,
    // for (var option in options) {
    //     ccOptions[option] = {
    //         "caption" : options[option],
    //         "post"    : function() {
    //             index =  out.get(fieldName, 'indexName');
    //             $(this).attr('name', index + '[cc]');
    //         }
    //     };
    // }

    var uniContainer = {
        "type"  : "container",
        "class" : fieldName + '-uniContainer',
        "post"  : function() {
            $(this).data('fieldName', fieldName);
            $(this).data('setFieldName', setStimsName);
            $(this).data('clearIndex', clearStimsIndex);
            $(this).data('setData', uniSetData);
            out.add(fieldName, 'uniContainer', this);

            var parent = out.get(fieldName, 'rightsContainer');
            $(parent).data('uniContainer', this);

        },
        "default-mapper" : {
            "womb"    : womb,
            "name"    : fieldName + '-uni',
            "params"  : [{
                "sel" : ".cost_yes",
                "ref" : "cost_yes"
            },

            {
                "sel" : ".cost_no",
                "ref" : "cost_no"
            },

            {
                "sel" : ".cost_error",
                "ref" : "cost_error"
            },

            {
                "sel" : ".restrictions_yes",
                "ref" : "restrictions_yes"
            },

            {
                "sel" : ".restrictions_no",
                "ref" : "restrictions_no"
            },

            {
                "sel" : ".restrictions_error",
                "ref" : "restrictions_error"
            },

            {
                "sel" : "[name=cc]",
                "ref" : "cc"
            }/*,
                         {"sel" : ".cost_no",
                          "ref" : "cost_no"},*/],
            "indexer" : {
                "cost_yes" : {
                    "attr"   : "name",
                    "suffix" : "[cost]"
                },
                "cost_no"  : {
                    "attr"   : "name",
                    "suffix" : "[cost]"
                },
                "cost_error" : {
                    "attr"   : "for",
                    "suffix" : "[cost]"
                },
                "restrictions_yes" : {
                    "attr"   : "name",
                    "suffix" : "[restrictions]"
                },
                "restrictions_no"  : {
                    "attr"   : "name",
                    "suffix" : "[restrictions]"
                },
                "restrictions_error" : {
                    "attr"   : "for",
                    "suffix" : "[restrictions]"
                },
                "cc" : {
                    "attr"   : "name",
                    "suffix" : "[cc]"
                }
            }
        },
        "html" : [
        {
            "type"  : "container",
            "html"  : {
                "type"  : "label",
                "class" : "error cost_error",
                "for"   : "rights[0][cost]", // need to update with each new
                "generated" : true
            }
        },
        {
            "type" : "span",
            "html" : L10n.element[fieldName].cost.caption
        },
        {
            "type"     : "spanify",
            "class"    : "block_mdeditor-element_oneline",
            "realtype" : "radiobuttons",
            "options"  : {
                "yes"  : {
                    "class"   : "rule_exactly-one cost_yes",
                    "caption" : "Yes",
                    "post"    : function() {
                        var key = out.get(fieldName, 'keyName'),
                        index =  out.get(fieldName, 'indexName');

                        /* provide an id for the label (to be able to click
                             * on the latter and check the former) */
                        $(this).attr('id', key + '-cost_yes');
                        $(this).attr('name', index + '[cost]');
                    }
                },
                "no"  : {
                    "class" : "rule_exactly-one cost_no",
                    "caption"  : "No",
                    "post"    : function() {
                        var key = out.get(fieldName, 'keyName'),
                        index =  out.get(fieldName, 'indexName');

                        $(this).attr('id', key + '-cost_no');
                        $(this).attr('name', index + '[cost]');
                    }
                }
            }
        },
        {
            "type"  : "container",
            "html"  : {
                "type"  : "label",
                "class" : "error restrictions_error",
                "for"   : "rights[0][restrictions]", // need to update with each new
                "generated" : true
            }
        },
        {
            "type"  : "span",
            "html"  : L10n.element[fieldName].restrictions.caption
        },
        {
            "type"     : "spanify",
            "class"    : "block_mdeditor-element_oneline",
            "realtype" : "radiobuttons",
            "options"  : {
                "yes"  : {
                    // "id" : "cost_yes",              // must be unique
                    "class"   : "rule_exactly-one restrictions_yes",
                    "caption" : "Yes",
                    "post"    : function() {
                        var key = out.get(fieldName, 'keyName'),
                        index =  out.get(fieldName, 'indexName');

                        $(this).attr('id', key + '-restrictions_yes');
                        $(this).attr('name', index + '[restrictions]');
                    }
                },
                "no"  : {
                    // "id" : "cost_no",
                    "class" : "rule_exactly-one  restrictions_no",
                    "caption"  : "No",
                    "post"    : function() {
                        var key = out.get(fieldName, 'keyName'),
                        index =  out.get(fieldName, 'indexName');

                        $(this).attr('id', key + '-restrictions_no');
                        $(this).attr('name', index + '[restrictions]');
                    }
                }
            }
        }
        ]
    };


    var rightsContainer = {
        "type"  : "li",
        "class" : fieldName + '-rightsContainer',
        "default-mapper" : {
            "womb"   : womb,
            "name"   : fieldName + '-rightsContainer',
            "array"  : true,
            "params" : [{
                "sel" : '.' + fieldName + '-uniContainer',
                "ref" : "control"
            },

            {
                "sel" : '.' + fieldName + '-descriptions',
                "ref" : "control"
            }]
        },
        "post" : function() {
            // $(this).data('setFieldName', setRightsFieldName);
            out.add(fieldName, 'rightsContainer', this);
            out.add(fieldName, 'localeContainerParent', this);

            $(this).data('setIndex', setStimsIndex);
            $(this).data('clearIndex', clearContainerIndexNG);
            $(this).data('fieldName', fieldName);
            $(this).data('setData', rightsSetData);
        },
        "html" : [
        {
            "type" : "a",
            "href" : "#",
            "html" : L10n.element[fieldName].cardinality_hide,
            "post" : function() {
                out.add(fieldName, 'hideContainer', this);
                $(this).click(runMethod);
            }
        },
        uniContainer,
        localeContainer
        ]
    };


    var topContainer = {
        "type" : "container-fluid",
        "default-mapper" : {
            "womb"   : womb,
            "name"   : fieldName + '-top-container',
            "array"  : true,
            "params" : [{
                "sel" : '.' + fieldName + '-rightsContainer',
                "ref" : "control"
            }]
        },
        "html" : [
        {
            "type" : "ol block_mdeditor-multiple_values",
            "html" : rightsContainer
        },
        {
            "type" : "a",
            "href" : "#",
            "html" : L10n.element[fieldName].cardinality_add,
            "post" : function() {
                out.add(fieldName, 'addNew', this);
                $(this).click(runMethod);
            }
        }
        ],
        "post" : function() {
            $(this).data('hideChild', hideContainer);
            $(this).data('addChild', newLocaleContainerNG);
            $(this).data('setData', setContainerData);
            $(this).data('dataFormat', {
                "language" : {
                    "ref"     : "lang",
                    "trigger" : "change"
                },
                "value"   : {
                    "ref" : "value"
                }
            });
        }
    };


    /* create an 'instance' of this top-level container */
    var t = $('<div>').dform(topContainer);
    t = $(t).children();

    //
    // INITIALIZE A CARDINALITY_GT1-CONTAINER
    //

    var addnew = out.get(fieldName, 'addNew');

    $(addnew).data('runMethod', {
        "target" : t,
        "method" : "addChild"
    });

    containerData = {
        // refs
        "womb" : womb,
        "out"  : out,
        "fieldName" : fieldName,

        "shades" : [],

        "child"  : rightsContainer,
        "childData" : null /* childData is currently used when creating a
                            * localeContainer !*/
    };


    //
    // INITIALIZE A LOCALE-CONTAINER (post womb)
    //


    var v = {

        /* Setting this to 'description' means that when the object is dform-ed
         * it will create a reference in the `out' object under that name, which
         * is not so clear. It should not create problems, though, because, the
         * `out' object (just like the Womb) is only utilized during the process
         * of creating new DOM elements.
         * On the plus side, setting this to description instead of 'rights'
         * accomodates the use of setFieldName 'method'. */
        "fieldName" : 'description',


        /* a string to be prefixed when generating indices (usually, the name of
         * the field with a possible extension of [0] */
        "indexName" : 'rights[0]',//+'[0]',
        "keyName"   : keyName, /* this is replace before each new dform */
        /* the archetype of element this container generates */
        "child"     : control,
        "localeButton" : addLocaleButton, // this is an object not a DOM element

        /* provide general functionality */
        "womb"      : womb,
        "out"       : out,
        "langRepo"  : langRepo,

        /* there is an extra array, called `refs' which holds references to the
         * children of this container. It is created when a call to `wombBear'
         * has been performed. */

        /* this is sibling to refs (refs is being created via the womb).
         * It holds controls that have been hidden via the hideLocale element */
        "shades"    : []

    /* this is to be invoked when a new child should be created */
    // "addChild"  : newLocale, replace this with a simple .data() on "post"
    };

    containerData.childData = v;
    $(t).data(containerData);


    var c = out.get(fieldName, 'localeContainer');

    /* be careful not to override the description of the AddLocale button in the
     * object of shared properties */
    addLocaleButton = $('<div>').dform(addLocaleButton);
    addLocaleButton = $(addLocaleButton).children();
    $(addLocaleButton).data('runInstead', {
        "target" : c
    });


    $(c).data(v);
    /* replace the elements that should NOT be shared among other instances */
    $(c).data('localeButton', addLocaleButton);
    $(c).data('shades', []);


    //
    // CALLING POST-DEFINITION FUNCTIONS
    //

    /* call post-definition functions on the newly-created elements */
    wombBear(womb);

    /* the container is created with a default child; needs initialization in
     * some aspects */
    var child = $(c).data('refs')[0];

    /* set the parameters that are required when attempting to hide this child
     */
    var hide = out.get('description', 'hideLocale');
    $(hide).data('runMethod', {
        "method" : "hideChild",
        "target" : c,
        "data"   : child
    });




    setLocButton(addLocaleButton, child);
    // Process for localizable control



    /* set the index to all children */
    var r = out.get(fieldName, 'rightsContainer');

    var hide = out.get(fieldName, 'hideContainer');
    $(hide).data('runMethod', {
        "method" : "hideChild",
        "target" : t,
        "data"   : r
    });


    var f = $(r).data('setIndex');
    f = $.proxy(f, r);
    f(0);

    /* set data if any are available */
    if (data[fieldName]) {
        var func = $.proxy($(t).data('setData'), t);
        func(data[fieldName]);
    }

    return t;
}

function block_mdeditor_compose(target, data, L10n, targetUrl, requestParams) {
    data || (data = {});

    $.dform.options.prefix = null;

    var kit = M.block_mdeditor.kit,
    repo = kit.langRepo,
    persistLOM = kit.persistLOM,
    composeCopyTemplate = kit.composeCopyTemplate,
    composeSelect = kit.composeSelect,
    composeRightsCC = kit.composeRightsCC,
    composeInput = kit.composeInput,
    composeChecklist = kit.composeChecklist,
    composeDescription = kit.composeDescription,
    composeKeyword = kit.composeKeyword;

    L10n.element.language13.options = $.extend(true, {}, L10n.common.languages);
    L10n.element.language5.options = $.extend(true, {}, L10n.common.languages);

    /* get the translation of 'Choose…' and merge it with language options */
    var language34 = $.extend({}, L10n.element.language34.options);
    language34 = $.extend(true, language34, L10n.common.languages);
    L10n.element.language34.options = language34;
    L10n.element.interactivity_level.options = $.extend(true, {}, L10n.common.scale_low_high);
    L10n.element.semantic_density.options = $.extend(true, {}, L10n.common.scale_low_high);

    // +++ console.log( ' DATA', data);

    var form = 'block_mdeditor-edit_form', //'block_mdeditor-edit_dialog',
    formSelector = '#'+form,
    edu = 'educational';

    var e = {
        "title" : block_mdeditor_compose_title(kit, data, 'title', L10n),
        "language13"  : "checklist",
        "description" : composeDescription(kit, data, 'description', L10n),
        "keyword"     : composeKeyword(kit, data, 'keyword', L10n),
        "coverage"    : "checklist",
        "contribute2" : block_mdeditor_compose_contribute(kit, data, 'contribute2', L10n, false),
        "language34"  : {
            "type"  : "input",
            "input" : composeSelect(kit, data, 'language34', L10n, 'contribute3')
        },
        "contribute3" : block_mdeditor_compose_contribute(kit, data, 'contribute3', L10n, false),
        "interactivity_type" : composeSelect(kit, data, 'interactivity_type', L10n, edu),
        "resource_type" : "checklist",
        "interactivity_level" : {
            "type"  : "input",
            "input" : composeSelect(kit, data, 'interactivity_level', L10n, edu)
        },
        "semantic_density" : {
            "type"  : "input",
            "input" : composeSelect(kit, data, 'semantic_density', L10n, edu)
        },
        "indended_user" : "checklist",
        "context"   : "checklist",
        "typical_age" : {
            "type"  : "input",
            "input" : composeInput('text', data, 'typical_age', L10n, edu)
        },
        "difficulty" : {
            "type"  : "input",
            "input" : composeSelect(kit, data, 'difficulty', L10n, edu)
        },
        "learning_time" : {
            "type"  : "input",
            "input" : composeInput('text', data, 'learning_time', L10n, edu)
        },
        "description5" : composeDescription(kit, data, 'description5', L10n, true),
        "language5"  : "checklist",
        "cc"  : composeRightsCC(kit, data, 'cc', L10n),
        //"rights" : block_mdeditor_compose_rights(kit, data, 'rights', L10n)
        "classification_details": "checklist"
    };


    var dialog = {
        "type"   : "container",
        "id"     : 'block_mdeditor-dialog',
        "dialog" : {
            "title"     : L10n.dialog.caption,
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
                "type"    : "span",
                /* we pass requestParams so as to identify which option to
                     * hide (the one that is already visible) */
                "html"    : composeCopyTemplate(L10n, requestParams, e)
            },
            {
                "type"    : "fieldset",
                "caption" : L10n.category.general,
                "html"    : [
                {
                    "type" : "span", 
                    "class": "rule_mandatory",
                    "html" : e.title
                },
                {
                    "type" : "span", 
                    "class": "rule_mandatory",
                    "html" : composeChecklist(kit, data, 'language13', L10n, 'rule_at-least-one')
                },
                {
                    "type" : "span", 
                    "class": "rule_mandatory",
                    "html" : e.description
                },
                {
                    "type" : "span",
                    "html" : e.keyword
                },
                {
                    "type" : "span",
                    "html" : composeChecklist(kit, data, 'coverage', L10n, '')
                }
                ]
            },
            {
                "type"    : "fieldset",
                "caption" : L10n.category.life_cycle,
                "html"    : [
                {
                    "type" : "span",
                    "class": "rule_mandatory",
                    "html" : e.contribute2
                }
                ]
            },
            {
                "type"    : "fieldset",
                "caption" : L10n.category.meta_metadata,
                "html"    : [
                {
                    "type" : "span",
                    "class": "rule_mandatory",
                    "html" : e.language34.input
                },
                {
                    "type" : "span",
                    "class": "rule_mandatory",
                    "html" : e.contribute3
                }
                ]
            },
            {
                "type"    : "fieldset",
                "caption" : L10n.category.educational,
                "html"    : [
                {
                    "type" : "span",
                    "html" : e.interactivity_type.input
                },
                {
                    "type" : "span",
                    "html" : composeChecklist(kit, data, 'resource_type', L10n)
                },
                {
                    "type" : "span",
                    "html" : e.interactivity_level.input
                },
                {
                    "type" : "span",
                    "html" : e.semantic_density.input
                },
                {
                    "type" : "span",
                    "html" : composeChecklist(kit, data, 'indended_user', L10n, edu)
                },
                {
                    "type" : "span",
                    "html" : composeChecklist(kit, data, 'context', L10n)
                },
                {
                    "type" : "span",
                    "html" : e.typical_age.input
                },
                {
                    "type" : "span",
                    "html" : e.difficulty.input
                },
                {
                    "type" : "span",
                    "html" : e.learning_time.input
                },
                {
                    "type" : "span",
                    "html" : e.description5
                },
                {
                    "type" : "span",
                    "html" : composeChecklist(kit, data, 'language5', L10n)
                },
                ]
            },
            {
                "type"    : "fieldset",
                "caption" : L10n.category.rights,
                "html"    : [
                {
                    "type" : "span",
                    "class": "rule_mandatory",
                    "html" : e.cc
                }//,
                // {
                //     "type" : "span",
                //     "html" : e.rights
                // }
                ]
            },
            {
                "type"    : "fieldset",
                "caption" : L10n.category.classification,
                "html"    : [
                {
                    "type" : "span",
                    "html" : composeChecklist(kit, data, 'classification_details', L10n, '', {
                        "width" : "100%;",
                        "height" : "250px;"
                    })
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
                    "html"    : "Save",
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
                    "type"    : "button",
                    "href"    : "#",
                    "html"    : "Save as draft",
                    "post"    : function() {
                        $(this).click(function(e) {
                            /* costruct the url for this particular
                                     * course/resource */
                            var url = targetUrl + '?state=partial',
                            f = null;

                            f = $.proxy(persistLOM, e.target);

                            f(formSelector, url, requestParams, L10n, false);
                            e.preventDefault();
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

    /* generally, these should not be copied */
    delete e.title;
    delete e.description;

    //    L10n.element.language13.options = L10n.common.languages;
    $.dform.options.prefix = null;
    $(target).dform(dialog);
}


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *
 *                      H E A L T H   W A R N I N G
 *
 *                            DO NOT PROCEED!
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */


$(function() {

    /*
     * Iterates through the children of a parent object in an attempt to locate
     * and store references of the specified `children'. The references are
     * stored into the data of the parent under the name of `refs'.
     * Values already present in that variable are preserved, unless their key
     * conflicts with any of the specified reference keys (see format below), in
     * which case, the reference prevails.
     *
     * NOTE: Currently, if more that one elements are matched against the
     * specified selector, a reference will be created only for the first one.
     *
     * This function should be run in the context of the parent object.
     * See jQuery.proxy()
     *
     * children - an array of objects of this format:
     *  {
     *    "sel" : the selector to match against,
     *    "ref" : the key of reference that is to be created; ref must be unique
     *            among the children
     *  }
     *
     */
    function mapper(children) {

        var asArray = false;
        if (children.asArray && children.asArray == true) {
            asArray = true;
            delete children.asArray;
        }

        var parent = this,
        refs = $(parent).data('refs');

        refs || (asArray && (refs=[])) || (refs = {});

        $.each(children, function(index, v) {

            var child = $(parent).find(v.sel);

            child && child[0] && (child = child[0]);

            asArray && (refs[refs.length] = child) || (refs[v.ref] = child);
        });

        $(parent).data('refs', refs);
    }

    /*
     * Creates an array with named references to specific elements drawn from
     * the `refs' array (created by `mapper()') of the object.
     */
    function indexer(params) {

        var pMapper = $.proxy(mapper, this);
        pMapper(params.mapper);

        var refs = $(this).data('refs');

        /* now that the elements have been mapped, create additional references
         * only for those elements that are susceptible to index modifications
         */
        var stims = [];
        $.each(params.indexer, function(refName, value) {

            var stim = {
                "attr"   : value.attr,
                "ref"    : refs[refName]
            };

            /* it's possible that a suffix may have not been provided for some
             * elements in which case an empty suffix should be set */
            value.suffix && (stim.suffix = value.suffix) || (stim.suffix = '');

            stims[stims.length] = stim;

        });

        $(this).data('stims', stims);
    }


    /*
     * Creates a default language selector
     *
     * format:
     *  {
     *    "name"      : name with which to register this object
     *    "container" : the element type to contain the language-selector;
     *                  defaults to '<span>'; optional
     *    "repo"      : reference to a central object for the language selection
     *    "attr"      : any additional attributes to pass as attributes;
     *                  optional
     *  }
     *
     * Specifications:
     * - Each language may be available only once per field
     *   this calls for a dynamic adjustment of the contents of each select as
     *   the user may pick one language for the first localized version, and
     *   change this to another.
     *
     * - Each select must be able to suggest the language of the next localized
     *   version, according to the order of selected languages of previously
     *   completed fields.
     */
    $.dform.addType('language-selector', function(o) {

        /* obtain available languages from langRepo */
        var container,
        selector = {
            "type"    : "select",
            "class"   : "block_mdeditor-language_selector"
        };

        if (o) {

            /* use a different container if one was specified */
            o.container && (container = o.container) || (container = '<span>');

            /* append any available attributes */
            o.attr && $.extend(selector, o.attr);
        }

        var container = $(container).dform(selector),
        element = $(container).children()[0];

        if (o.alt) {
            var func = o.alt;
            func = $.proxy(func, element);
            o.name = func();
        }

        var myRepo = o.repo;

        /* set the language repo for this element */
        $(element).data('repo', myRepo);
        $(element).data('field', o.name);

        /* append this element to the list of other elements of this kind for
         * the given field
         */
        myRepo.enroll(o.name, element);

        /* remember the current value of this select */
        $(element).data('reserved', $(element).val());


        var delegate = $.proxy(myRepo.change, myRepo);
        $(element).change(delegate);

        return container;
    });


    $.dform.addType('spanify', function(o) {
        o = $.extend(true, {}, o);

        o.type = o.realtype;
        delete o.realtype;

        var result = $('<span>').dform(o);

        result = $('<span>').append($($(result).children()[0]).children());
        return result;
    });


    /*
     * Sets up the appropriate values so that an initialization may take place
     * after the element in context has been attached to the DOM tree.
     * format:
     * The function set for the initialization is `mapper()'
     *
     * format:
     *  {
     *    womb   : where the requirements for the initialization of each element
     *             will be stored
     *    name   :
     *    params : the parameters to pass into the `mapper' function
     * }
     */
    $.dform.subscribe('default-mapper', function(o) {

        /* set the requirements of this control */

        if (o.indexer) {

            o.womb[o.name] = {
                "object"   : this,
                "function" : indexer,
                "params"   :
                {
                    "mapper"  : o.params,
                    "indexer" : o.indexer
                }
            };

        } else {

            var asArray = o.array && o.array == true;
            o.params.asArray = asArray;

            o.womb[o.name] = {
                "object"   : this,
                "function" : mapper,
                "params"   : o.params
            };
        }
    });


    $.dform.subscribe('toChecklist', function(options, type) {
        $(this).toChecklist(options);
    },
    $.isFunction($.fn.toChecklist));

    $.dform.subscribe('dialog_init', function(options, type) {

        var dialogWidth = parseInt($(this).dialog('option', 'width'));
        var windowWidth = $(window).width();
        var positionX = parseInt((windowWidth -  dialogWidth)/2);
        // add 30 pixel to appear below the agriMoodle menu
        var scrollTop = $(document).scrollTop() + 30;

        $(this).dialog('option', 'height', ($(window).height()*0.8));
        $(this).dialog('option', 'position', [positionX, scrollTop]);
    });
});


function block_mdeditor_init_kit(target, L10n) {

    function runInstead(e) {
        var self = e.target;

        var ri = $(self).data('runInstead'),
        data = ri.data,
        func = $.proxy(ri.action, ri.target);

        func(self, data);
        e.preventDefault();
    }

    function runMethod(e) {
        var self = e.target;

        var rm = $(self).data('runMethod');
        console.log(">>>>>> ", e);
        var data = rm.data;
        var target = rm.target;
        func = $(target).data(rm.method);

        func = $.proxy(func, rm.target);

        func(data, e);
        e.preventDefault();
    }

    /*
     * Call any registered init functions
     *
     * format:
     * {
     *   "object"   :
     *   "function" :
     *   "params"   :
     */
    function wombBear(womb) {

        $.each(womb, function(key, element) {
            /* the initialization function runs in the context of the object */
            var func = $.proxy(element['function'], element.object);
            /* call the function with the supplied parameters */
            func(element.params);

        // delete this;
        });

        for (var i in womb) {
            delete womb[i];
        }
    }


    /*
     * Creates a new control of this container.
     *
     * Runs in the context of the container.
     *
     * womb is only passed in as a parameter so that the function make operate
     *   from a different scope
     *   TODO: maybe get `womb' out of the container itself…
     *
     * return the newly created child (DOM element)
     */
    function addControl(prefix, control, womb) {
        /* create a new child and dispose of the wrapper
         * NOTE: we are creating the child with the wrapper because we need to
         * inherit any classes available through jQuery UI -- more on this!
         */
        var child = $('<div>').dform(control);
        child = $(child).children()[0];

        /* satisfy the initialization requirements of the child */
        wombBear(womb);

        /* calculate the index of the child */
        var refs = $(this).data('refs'),
        count = refs.length;

        /* we use the reference to the last visible child and insert the new
         * child after that, because the controls may be placed at an arbitrary
         * depth within the container! */
        $(child).hide().insertAfter(refs[count - 1]);
        /* update the refs of this container */
        refs[refs.length] = child;

        /* animation should be handled somewhere more centrally! */
        $(child).show('fast');


        /* update the elements of the child to reflect its index */
        var func = $.proxy(setIndex, child);
        func(prefix, count, $(child).data('stims'));


        return child;
    }


    /*
     * Runs in the context of the parent container.
     *
     */
    function newLocaleContainer() {
        var shades = $(this).data('shades');
        /* check whether shades exists in this container, and display one of
         * them instead of creating a brand-new one */
        if (shades.length) {
            var f = $.proxy(redisplayContainer, this);
            f(shades);
            return;
        }

        var refs = $(this).data('refs'),
        out = $(this).data('out'),
        womb = $(this).data('womb'),
        child = $(this).data('child'),
        childData = $(this).data('childData'), //$.extend(false, {}, ), // #1
        fieldName = $(this).data('fieldName'),
        localeButton = childData.localeButton;

        out.clear();


        var count = refs.length
        index = count - 1,
        total = count + $(this).data('shades').length,
        indexName = $(this).data('fieldName') + '[' + count + ']',
        keyName = fieldName + '-' + total;

        // the next two commented-out lines have been replaced with #1-3
        // childData.indexName = indexName;
        // childData.keyName = keyName;
        out.add(fieldName, 'keyName', keyName);


        child = $('<div>').dform(child);
        child = $(child).children()[0];

        /* set focus on the locale container */
        var localeContainer = null,
        potentialContainer = $(child).data('localeContainer');

        if (potentialContainer) {
            localeContainer = potentialContainer;
        }

        $(child).data(childData);    // localeContainer

        /* create the localization button */
        localeButton = $('<div>').dform(localeButton);
        localeButton = $(localeButton).children();
        $(localeButton).data('runInstead', {
            "target" : child
        }); // localeContainer

        /* replace the elements that should NOT be shared among other instances
         */
        $(child).data('indexName', indexName);  //#2
        $(child).data('keyName', keyName);      //#3
        $(child).data('localeButton', localeButton);
        $(child).data('shades', []);

        wombBear(womb, true);


        /* set the parameters that are required when attempting to hide the
         * default child of the new container */
        var grandc = $(child).data('refs')[0];
        var hide = out.get(fieldName, 'hideLocale');
        $(hide).data('runMethod', {
            "method" : "hideChild",
            "target" : child,
            "data"   : grandc
        });

        hide = out.get(fieldName, 'hideContainer');
        $(hide).data('runMethod', {
            "method" : "hideChild",
            "target" : this,
            "data"   : child
        });

        // when a *new* container is created, could its index be anything else
        // other than zero?
        setIndex(indexName, 0/*index*/, $(grandc).data('stims'));

        setLocButton(localeButton, grandc);


        $($(child).hide()).insertAfter(refs[index]);
        /* update the refs of this container */
        refs[refs.length] = child;

        $(child).show('fast');

        return child;
    }

    function newLocaleContainerNG() {
        var shades = $(this).data('shades');
        /* check whether shades exists in this container, and display one of
         * them instead of creating a brand-new one */
        if (shades.length) {
            var f = $.proxy(redisplayContainer, this);
            f(shades);
            return;
        }

        var refs = $(this).data('refs'), /* place the child after the last of these */
        out = $(this).data('out'),
        womb = $(this).data('womb'),
        child = $(this).data('child'), /* the archetype */
        childData = $(this).data('childData'), /* get data form topContainer */
        localeButton = childData.localeButton,
        fieldName = $(this).data('fieldName');

        out.clear();


        var count = refs.length
        index = count - 1,
        total = count + $(this).data('shades').length, /* to generate unique key */
        indexName = $(this).data('fieldName') + '[' + count + ']', /* sth like rights[0] */
        keyName = fieldName + '-' + total; /* will be registered for this 'run' */

        /* need a way to determine under which key to set the 'keyName' in out */
        out.add('description', 'keyName', keyName);

        child = $('<div>').dform(child);
        child = $(child).children()[0];

        /* work on the locale container */
        var localeContainer = null,
        potentialContainer = $(child).data('localeContainer');
        if (potentialContainer) {
            /* if there is a reference to a localeContainer, use that insead of
             * looking a the new child's refs */
            localeContainer = potentialContainer;
        }

        $(localeContainer).data(childData);

        /* create the localization button */
        localeButton = $('<div>').dform(localeButton);
        localeButton = $(localeButton).children();
        $(localeButton).data('runInstead', {
            "target" : localeContainer
        });

        /* replace the elements that should NOT be shared among other instances
         */
        $(localeContainer).data('indexName', indexName);  //#2
        $(localeContainer).data('keyName', keyName);      //#3
        $(localeContainer).data('localeButton', localeButton);
        $(localeContainer).data('shades', []);

        wombBear(womb, true);


        /* set the parameters that are required when attempting to hide the
         * default localeContainer of the new container */
        var key = out.get(fieldName, 'hideLocaleField'), /* key 'hideLocale' is registered with */
        hide = out.get(key, 'hideLocale');
        var localeControl = out.get(fieldName, 'localeControl');
        // var hide = out.get(fieldName, 'hideLocale');
        $(hide).data('runMethod', {
            "method" : "hideChild",
            "target" : localeContainer,
            "data"   : localeControl
        });

        /* requirements for hiding a child of this top level container */
        hide = out.get(fieldName, 'hideContainer');
        $(hide).data('runMethod', {
            "method" : "hideChild",          /* hideChild of topContainer !! */
            "target" : this,
            "data"   : child
        });

        /* call setIndex for containers that support it (they all should, if
         * they are using this function) */
        var _setIndex = $(child).data('setIndex');
        if (_setIndex) {
            _setIndex = $.proxy(_setIndex, child);
            _setIndex(count);
        } else {
            setIndex(indexName, index, $(grandc).data('stims'));
        }

        setLocButton(localeButton, localeControl);

        $($(child).hide()).insertAfter(refs[index]);
        /* update the refs of this container */
        refs[refs.length] = child;

        $(child).show('fast');

        return child;
    }


    /*
     * Runs in the context of the parent container.
     */
    function addContainer(prefix, container, womb) {
        /* create a new child and dispose of the wrapper
         * NOTE: we are creating the child with the wrapper because we need to
         * inherit any classes available through jQuery UI -- more on this!
         */

        var child = $('<div>').dform(container);
        child = $(child).children()[0];

        // localizable
        var addLocaleButton = $(this).data('addLocaleButton');
        addLocaleButton = $(addLocaleButton).children();
        $(addLocaleButton).data('runInstead', {
            "target" : child
        });

        v.indexName = prefix;
        // calculate or be given the keyName
        v.localeButton = addLocaleButton


        //------- after womb

        // deal with the first child of the container

        /* satisfy the initialization requirements of the child */
        wombBear(womb);

        /* calculate the index of the child */
        var refs = $(this).data('refs'),
        count = refs.length;

        /* we use the reference to the last visible child and insert the new
         * child after that, because the controls may be placed at an arbitrary
         * depth within the container! */
        $(child).hide().insertAfter(refs[count - 1]);
        /* update the refs of this container */
        refs[refs.length] = child;

        /* animation should be handled somewhere more centrally! */
        $(child).show('fast');


        /* update the elements of the child to reflect its index */
        var func = $.proxy(setIndex, child);
        func(prefix, count, $(child).data('stims'));

        return child;
    }


    /*
     * Creates a new control that will contain the addLocalization button.
     *
     * Runs in the context of a container which supports localization.
     */
    function newLocale() {
        var button = $(this).data('localeButton');
        var out = $(this).data('out'),
        repo = $(this).data('langRepo'),
        field = $(this).data('fieldName'),
        shades = $(this).data('shades'),
        keyName = $(this).data('keyName'),
        indexName = $(this).data('indexName');

        /* check whether shades exists in this container, and display one of
         * them instead of creating a brand-new one */
        if (shades.length) {
            var f = $.proxy(redisplayLocale, this);
            return f(shades);
        }

        /* set the keyName for this 'run' */
        /* this will be read by language selectors that need to define their
         * name dynamically */
        out.add(field, 'keyName', keyName);

        /* check whether there are available languages for this field, if not
         * abort, perhaps with a message */

        if (! $(this).data('nonlocale') == true)
            if (! repo.isAvailable(keyName)) return;

        var func = $.proxy(addControl, this),
        child = func(indexName,
            $(this).data('child'),
            $(this).data('womb'));

        var setFieldName = $(this).data('setFieldName');

        if (setFieldName) {
            setFieldName = $.proxy(setFieldName, this);
            setFieldName($(this).data('indexName'));
        }

        /* set requirements for the hideLocale element */
        var hide = out.get(field, 'hideLocale');

        $(hide).data('runMethod', {
            "method" : "hideChild",
            "target" : this,
            "data"   : child
        });


        setLocButton(button, child);

        return child;
    }


    /*
     * Runs in context of a localizable container.
     *
     */
    function redisplayLocale(shades) {
        shades || (shades = $(this).data('shades'));

        var shade = shades[shades.length - 1],
        stims = $(shade).data('stims'),
        lang = $(shade).data('refs')['lang'],
        repo = $(this).data('langRepo'),
        keyName = $(this).data('keyName'),
        indexName = $(this).data('indexName'),
        refs = $(this).data('refs');

        if (! $(this).data('nonlocale') == true) {
            repo.enroll(keyName, lang);
        }

        /* update the elements of the shade to reflect its index */
        var setFieldName = $(this).data('setFieldName');
        if (! setFieldName) {
            var func = $.proxy(setIndex, shade);
            func(indexName, refs.length, stims);
        }

        /* move the hidden control to the bottom of the container (ie, after the
         * last visible element) */
        $(shade).insertAfter(refs[refs.length - 1]);

        /* move the reference from the inactive to the active ones */
        shades.splice(shades.length - 1, 1);
        refs[refs.length] = shade;

        if (setFieldName) {
            setFieldName = $.proxy(setFieldName, this);
            setFieldName($(this).data('indexName'));
        }

        setLocButton($(this).data('localeButton'), shade);
        $(shade).show('fast');

        return shade;
    }


    /*
     * Runs in context of container.
     */
    function redisplayContainer(shades) {
        shades || (shades = $(this).data('shades'));

        var shade = shades[shades.length - 1],
        refs = $(this).data('refs');

        /* update the control to reflect its new index */
        var _setIndex = $(shade).data('setIndex');
        if (_setIndex) {
            _setIndex = $.proxy(_setIndex, shade);
            _setIndex(refs.length);
        } else {
            setIndexToContainer(shade, refs.length);
        }

        /* move the hidden control to the bottom of the container (ie, after the
         * last visible element) */
        $(shade).insertAfter(refs[refs.length - 1]);

        /* move the reference from the inactive to the active ones */
        shades.splice(shades.length - 1, 1);
        refs[refs.length] = shade;


        $(shade).show('fast');
    }


    /*
     * Runs in the context of a container which supports localization.
     * Uses the `refs' and `shades' properties.
     *
     */
    function hideLocale(control) {
        
        var refs = $(this).data('refs');

        /* at least one control must remain (?) */
        if (refs.length < 2) return;

        var shades = $(this).data('shades'),
        index = $.inArray(control, refs),
        keyName = $(this).data('keyName'),
        indexName = $(this).data('indexName'),
        repo = $(this).data('langRepo');

        if (index < 0) return; // this should never be the case

        /* remove control from the 'active' ones */
        refs.splice(index, 1);
        /* append it to the 'inactive' ones */
        shades[shades.length] = control;

        /* remove index for this control so that its data are not included if a
         * post request is submitted while it is in this state */
        clearIndex($(control).data('stims'));

        /* disenroll its language selector so that its reserved value is made
         * available again */
        if (! $(this).data('nonlocale') == true) {
            var lang = $(control).data('refs')['lang'];
            repo.disenroll(keyName, lang);
        }

        $(control).hide('fast');

        /* if this control was the bottom-most, then attach localeButton to the
         * new bottom-most control */
        if (index == refs.length) {
            var button = $(this).data('localeButton'),
            last = refs[refs.length - 1];
            setLocButton(button, last);
        }

        var setFieldName = $(this).data('setFieldName');
        if (setFieldName) {
            setFieldName = $.proxy(setFieldName, this);
            setFieldName($(this).data('indexName'));
        } else {
            /* re-index any controls the succeed the one that has been hidden */
            for (index; index < refs.length ; ++index) {
                setIndex(indexName, index, $(refs[index]).data('stims'));
            }
        }
    }


    /*
     * Runs in context of container.
     */
    function hideContainer(container) {

        var refs = $(this).data('refs'),
        func = null;

        if (refs.length < 2 ) return;

        var shades = $(this).data('shades'),
        index = $.inArray(container, refs);

        if (index < 0) return; // this should never be the case


        /* remove control from the 'active' ones */
        refs.splice(index, 1);
        /* append it to the 'inactive' ones */
        shades[shades.length] = container;

        /* remove index for this container so that its data are not included if
         * a post request is submitted while it is in this state */
        func = $(container).data('clearIndex');
        func = $.proxy(func, container);
        func();

        $(container).hide('fast');


        /* re-index any controls the succeed the one that has been hidden */
        var func = $(container).data('setIndex');
        if (func) {
            var f = null;
            /* if `setIndex' was supported for the child that just got hidden,
             * then the other children of this container will support it as
             * well.
             * Note, it is assumed that the `setIndex' function of the other
             * children is the same with the one of the child got hidden.
             * If need be, get the actual definition of each `setIndex' within
             * the loop. */
            for (index; index < refs.length ; ++index) {
                // func = $(refs[i]).data('setIndex');
                f = $.proxy(func, refs[index]);
                f(index);
            }
        } else {
            for (index; index < refs.length ; ++index) {
                setIndexToContainer(refs[index], index);
            }
        }
    }


    /*
     * Appends the supplied button DOM element to a ref named placeholder of the
     * supplied `control' DOM element.
     */
    function setLocButton(button, control) {
        var refs = $(control).data('refs'),
        pholder = refs.placeholder;
        $(pholder).append(button);
    }

    /*
     *
     * targets:
     *  {
     *    "attr" : the attribute to modify
     *    "ref"  : the element the is to be modified
     *  }
     */
    function setIndex(prefix, order, targets) {

        $.each(targets, function() {
            $(this.ref).attr(this.attr, prefix + '[' + order + ']' + this.suffix);
        });
    }

    /*
     * target is the container
     * prefix is the prefix to set to all of its contents
     */
    function setIndexToContainer(target, order) {
        var refs = $(target).data('refs'),
        fieldName = $(target).data('fieldName'),
        indexName = fieldName + '[' + order + ']';

        $(target).data('indexName', indexName);

        for (var i = 0; i < refs.length ; ++i) {
            setIndex(indexName, i, $(refs[i]).data('stims'));
        }
    }

    /*
     * Runs in context of a container with refs to hide.
     */
    function clearContainerIndex() {

        var refs = $(this).data('refs'),
        ref = null;

        for( var i = 0 ; i < refs.length ; ++i ) {
            clearIndex($($(refs[i]).data('stims')));
        }
    }

    function clearIndex(targets) {

        $.each(targets, function() {

            $(this.ref).attr(this.attr, '');
        });
    }

    $.dform.subscribe("indexible", function() {

        $(this).data('setIndex', setIndex);

        /* set the requirements of this control */
        o.womb[o.name] = {
            "object"   : this,
            "function" : mapper,
            "params"   : o.params
        };
    });


    /* aggregation of initializers */
    var womb = {},

    out  = {
        "refs" : {},

        /* Runs in the context of this object */
        "add"  : function(field, elementName, element) {

            /* create entry for `field' if none exists */
            this.refs[field] || (this.refs[field] = {});
            this.refs[field][elementName] = element;
        },

        /* Runs in the context of this object */
        "get"  : function(field, elementName) {
            if (! this.refs[field]) return null;
            if (! this.refs[field][elementName]) return null;
            return this.refs[field][elementName];
        },

        "getAll" : function(field) {
            if (! this.refs[field]) return null;

            return this.refs[field];
        },

        "clear" : function() {
            for (var i in out.refs) {
                delete out.refs[i];
            }
        }
    },

    /* aggregation of language-selectors per field */
    langRepo = {

        "values"  : $.extend(true, {}, L10n.common.languages),
        /* the number of available values */
        "count"   : L10n.common.languages_count,
        "default" : null,
        "refs"    : {},

        /*
             * name string; group members to fields so that they share a
             *      common repo
             * member the DOM element to enroll
             */
        "enroll"  : function(name, member) {

            /* create room for the specified field, if this is the first
                 * time a request has been made for it
                 */

            if (! this.refs[name]) {
                this.refs[name] = {
                    "hidden"  : {},
                    "count"   : 0,
                    "members" : []
                };
            }
				
            /* TODO: logic to get a suggestion for a default value */

            /* get all the available values */
            var values = this.values,
            field = this.refs[name],
            suggest = null,
            /* this value will have been set for elements that have been
                     * previously hidden and now displayed again */
            prefer = $(member).data('reserved');


            /* if the prefered value is available, then give it that */
            //                if (prefer && !field.hidden[prefer]) {
            //                else
            //                FIXME !!!
            // ------------------------
            /* replace this with an algorithm that suggest a value */
            for (var i in values) {

                /* ignore value if it has been reserved for this field */
                if (field.hidden[i]) continue;
                suggest = i;
                break;
            }

            /* append options */
            $.each(values, function(i ,v) {

                var opt = $('<option value="' + i + '">' + v + '</option>');
                /* add value as hidden if it has already been reserved for
                     * this field
                     */
                if (field.hidden[i]) {
                    $(opt).attr('disabled', true);
                    $(opt).hide();
                }
                $(member).append(opt);
            });

            /* set and store the value within the element */
            $(member).val(suggest);
            $(member).data('reserved', suggest);

            this._hide(field, suggest);

            /* append this element to the members of this field */
            field.members[field.members.length] = member;
            return values;
        },

        "disenroll" : function(name, member) {
            if (! this.refs[name]) return;
            var members = this.refs[name].members,
            index = $.inArray(member, members);

            if (index < 0) return;

            var value = $(member).data('reserved');

            /* remove this member and its history */
            $(member).empty();
            members.splice(index, 1);

            /* make the reserved value available to others */
            this._show(this.refs[name], value);
        },

        "clear" : function() {
            this.refs = {};
        },

        /*
             * Must be run in the context of this object (the repo).
             */
        "change" : function(e) {
            /* swap between the previously reserved language and the one
                 * requested if the latter is available
                 */
            var reserved = $(e.target).data('reserved'),
            requested = $(e.target).val(),
            field = this.refs[$(e.target).data('field')];

            /* `reserved' equals `requested' when data are being loaded
                 * where fake change-events are triggered to enroll the elements
                 * to the repo */
            if (reserved != requested && field.hidden[requested]) {
                /* reset the previous value */
                $(e.target).val(reserved);
                return;
            }

            $(e.target).data('reserved', requested);

            this._show(field, reserved);
            this._hide(field, requested, e.target);
        },

        "isAvailable" : function(field) {
            return this.refs[field].count < this.count;
        },

        // "rename" : function(

        /* these two beauties may be merged into one ? */
        "_hide" : function(field, value, exclude) {
            /* hide the reserved value from the other members for it is no
                 * longer available to them
                 */
            $.each(field.members, function() {
                if (exclude == this) return;
                var option = $(this).find('[value=' + value + ']');
                $(option).attr('disabled', true);
                $(option).hide();
            });

            /* mark the value as reserved (hidden) for this field */
            field.hidden[value] = true;
            ++field.count;
        },
        "_show" : function(field, value) {
            /* hide the reserved value from the other members for it is no
                 * longer available to them
                 */
            $.each(field.members, function() {
                var option = $(this).find('[value=' + value + ']');
                $(option).removeAttr('disabled');
                $(option).show();
            });

            /* remove this value from the hidden values of this field */
            delete field.hidden[value];
            --field.count;
        }
    };



    /**
     * Runs in the context of a container.
     *
     */
    function setData(data, format) {
        format || (format = $(this).data('dataFormat'));

        var refs = $(this).data('refs'),
        map = null,
        key = null,
        value = null;

        var control = refs[0];

        // TODO: if no data[0] ? abort ?
        map = data[0];
        var targets = $(control).data('refs');
        var desc = null;

        var builder = $(this).data('addChild');
        builder = $.proxy(builder, this);

        for (var i = 0 ; i < data.length ; ++i) {

            map = data[i];

            // this is the actual insertion of data (the most low-level)

            for (key in format) {

                /* continue if there is no data for this key */
                if (! map[key]) continue;

                /* the value that must be set */
                value = map[key];

                // TODO: would it be required to support attributes other
                // than value ?
                desc = format[key];

                $(targets[desc.ref]).val(value);

                if (desc.trigger) {
                    $(targets[desc.ref]).trigger(desc.trigger);
                }
            }



            // TODO: any better (in regards to performance) suggestions ?
            if (i < data.length - 1) {
                targets = $(builder()).data('refs');
            }
        }
    }


    /*
     * Runs in context of container.
     *
     * container ==? multple values
     */
    function setContainerData(data, format) {
        /* format is passed to the lower-level "containers" (until it eventually
         * reaches a control */
        format || (format = $(this).data('dataFormat'));

        var extract = null,
        refs = $(this).data('refs'),
        setData = $(refs[0]).data('setData'),
        child = null;

        /* set the first extract of data directly to the first child (which is
         * created by default) */
        setData = $.proxy(setData, refs[0]);
        setData(data[0], format);


        if (data.length == 1) return;

        /* setup the 'method' that creates new children */
        var addChild = $(this).data('addChild');
        addChild = $.proxy(addChild, this);

        /* get the 'method' that sets data to a child (we assumed that all
         * children have the same method!) */
        setData = $(refs[0]).data('setData');

        /* for every other extract of data, create a new child-container */
        for (var i = 1 ; i < data.length ; ++i) {

            child = addChild();
            $.proxy(setData, child)(data[i], format);
        }
    }

    /* this comes from the server -- to simply this, all values should be filled
     * out -- perhaps, merge with defaults to avoid vacancies */



    /*
     * This is the description of a button that adds a new child (eg control) to
     * a specified DOM element (aka container).
     *
     * Once converted into a DOM element, it should be given (in its data) a DOM
     * element (aliased as 'container') and a function (aliased as 'addChild').
     * When the click event is triggered, the function 'addChild' will be
     * invoked in the context of the `container' DOM element (with jQuery.proxy)
     * and pass itself as the first parameter.  TODO: UPDATE THIS !!!
     */
    var addLocale = {
        "type"  : "a",
        "class" : "ui-icon ui-icon-plus block_mdeditor-multiplicity_icons",
        "href"  : '#',
        "html"  : '[+]',
        "title" : L10n.common.langString_add,
        "post"  : function() {
            $(this).click(function(e){
                var self = e.target;

                var ri = $(self).data('runInstead'),
                data = ri.data,
                func = $.proxy(newLocale, ri.target);

                func(self, data);
                e.preventDefault();
            });
        }
    };

    function selectSetData(data) {

        if (!data) return;

        var prefix = $(this).data('prefix'),
        fieldName = $(this).data('fieldName');

        if (!data[prefix][fieldName]) return;
        var value = data[prefix][fieldName];

        $(this).find('option').each(function() {

            if ($(this).val() == value) {
                $(this).attr('selected', 'selected');
            }
        });
    }

    function radioSetData(data) {

        if (! data) return;

        var prefix = $(this).data('prefix'),
        fieldName = $(this).data('fieldName'),
        value = null;

        /* provide support for radios that do not belong to an array */
        if (prefix) {
            if (! data[prefix][fieldName]) return;
            value = data[prefix][fieldName];
        } else {
            value = data;
        }

        var target = $(this).find('[value=' + value + ']');

        if (target) {
            $(target).attr('checked', true);
        }
    }


    /*
     * Runs in context (then again, they all do, these are supposed to be
     * methods!!).
     */
    function rightsSetData(data, format) {
        format || (format = $(this).data('dataFormat')); /* this should never be
                                                          * the case */

        var container = null,
        func = null;

        /* pass data to uniContainer */
        container = $(this).data('uniContainer');
        func = $(container).data('setData');
        func = $.proxy(func, container);
        func(data);

        /* pass data to localeContainer, if any are available */
        if (data.description) {

            container = $(this).data('localeContainer');
            func = $(container).data('setData');
            func = $.proxy(func, container);
            func(data.description, format);
        }
    }

    /*
     * Runs in context.
     */
    function clearStimsIndex() {
        var stims = $(this).data('stims'),
        stim = null;

        // clearIndex(); /* do this manually instead of calling `clearIndex' */
        for (var i = 0 ; i < stims.length ; ++i) {
            stim = stims[i];
            $(stim.ref).attr(stim.attr, '');
        }
    }

    /*
     * Runs in context of parent.
     *
     * set index to stims
     * Uses the fieldName property of the parent and appends the supplied index
     */
    function setStimsIndex(index) {

        /* fieldname should be sth of the kind: rights[0][description] */
        var fieldName = $(this).data('fieldName'),
        newName = fieldName + '[' + index + ']',
        refs = $(this).data('refs'),
        ref = null,
        setName = null;

        for (var i = 0 ; i < refs.length ; ++i) {
            ref = refs[i];

            setName = $(ref).data('setFieldName');
            setName = $.proxy(setName, ref);
            setName(newName);
        }
    }

    /*
     * Runs in context.
     * Changes the name of this parent's children taking into account their
     * index.
     * Updates the names of its children (via setIndex).
     */
    function setContainerName(newName) {

        var refs = $(this).data('refs'),
        ref = null,
        setName = $(refs[0]).data('setFieldName'),
        indexName = newName + '[' + $(this).data('fieldName') +']',
        f = null;

        for (var i = 0 ; i < refs.length ; ++i) {
            ref = refs[i];
            /* update the prefix of the child, eg rights[0][description] */
            f = $.proxy(setName, refs[i]);
            f(indexName + '[' + i + ']');
        }
    }

    function setStimsName(newName) {
        var stims = $(this).data('stims'),
        stim = null;

        for (var i = 0 ; i < stims.length ; ++i) {
            stim = stims[i];
            $(stim.ref).attr(stim.attr, newName + stim.suffix);
        }
    }

    /*
     * Runs in context.
     */
    function clearContainerIndexNG() {
        var refs = $(this).data('refs'),
        ref = null,
        clearIndex = null;

        for (var i = 0 ; i < refs.length ; ++i) {
            ref = refs[i];
            clearIndex = $(ref).data('clearIndex');
            clearIndex = $.proxy(clearIndex, ref);
            clearIndex();
        }
    }

    /*
     * Runs in context (then again, they all do, these are supposed to be
     * methods!!).
     */
    function contributeSetData(data, format) {
        format || (format = $(this).data('dataFormat')); /* this should not be
                                                          * the case */

        var container = null,
        func = null;

        /* pass data to uniContainer */
        container = $(this).data('uniContainer');
        func = $(container).data('setData');
        func = $.proxy(func, container);
        func(data);

        /* pass data to localeContainer, if any are available */
        if (data.entity) {

            container = $(this).data('localeContainer');
            func = $(container).data('setData');
            func = $.proxy(func, container);
            func(data.entity, format);
        }
    }


    /* created as of the requirements of the form; static and always the same */
    var customMethods = {
        "required_non-empty" : $.validator.methods.required,
        "required_at-least-one" : $.validator.methods.required,
        "required_exactly-one" : $.validator.methods.required
    };


    /* combine the L10n strings with the custom methods  */
    var messages = L10n.error;
    for (method in customMethods) {
        $.validator.addMethod(method, customMethods[method], messages[method]);
    }


    /* utilize the custom methods by creating class-rules that require them */
    var customRules = {
        "rule_non-empty" : {
            "required_non-empty" : true,
            "minlength" : 1
        },
        "rule_at-least-one" : {
            "required_at-least-one" : true,
            "minlength" : 1
        },
        "rule_exactly-one" : {
            "required_exactly-one" : true,
            "minlength" : 1
        }
    };
    $.validator.addClassRules(customRules);

    /*
     *  -END
     */

    function composeCopyTemplate(L10n, hideThis, inputs) {

        var options = {},
        deleteId = null;

        options['0'] = 'Existing LOM records ...';
        $.extend(options, L10n.templates);

        /* remove the option that corresponds to the one currently edited */
        /* NOTE: All ids comply with the format: <type>_<id>
         * where
         *  <type> is the name of the mod (eg, 'page', 'resource') or 'course'
         *  <id> the ID of a particular mod or course */
        deleteId = hideThis.id;

        // console.log("L10n.templates : ", L10n.templates);
        // console.log("options        : ", options);
        // console.log("hideThis       : ", hideThis);
        for (var option in options) {
            // console.log("OPTION ", option);
            if ((options[option].value == deleteId) || 
                (options[option].title && 
                    options[option].title == 'No record found.')) {
                delete options[option];
            }
        }
        // console.log("options        : ", options);

		
        var desc = {
            "type"    : "container",
            // "class"   : "block_mdeditor-element_twoline",
            "html"    : [
            {
                "type"  : "label",
                "html"  : L10n.dialog.template
            },
            {
                "type"  : "span",
                "html"  : [
                {
                    "type"    : "select",
                    "id"      : "block_mdeditor-copy_template-select",
                    //                    "class"   : "block_mdeditor-resource_select",
                    "options" : options
                },
                {
                    "type"  : "button",
                    "href"  : "#",
                    "html"  : L10n.dialog.copy_button,
                    "post"  : function() {
                        var select = $('#block_mdeditor-copy_template-select');
                        $(this).data('select', select);
                        $(this).data('L10n', L10n);
                        $(this).data('hideTarget', hideThis);
                        $(this).data('inputs', inputs);

                        $(this).click(getCopy);
                    }
                }
                ]
            },
            {
                "type" : "container",
                "html" : "<b>NOTE:</b> Use with care! Some entries from current LOM record could be overwritten.",
                "style": "font-size: 0.7em; color:darkorange;"
            }
            ]
        };

        return desc;
    }

    function persistLOM(formId, url, params, L10n, validate) {
        var span = $(this).parent('.block_mdeditor-element_heading')
        .find('.save-status')[0];

        if (validate) {
            if (! $(formId).valid()) {
                flashOutMessage(span, L10n.error.form_has_errors);
                return false;
            }
        }

        var formData = $(formId).serialize();
        /* construct the complete url */          
        url = url + '&id=' + params.id;

        $.post(url, formData, function(response, status) {

            // console.log("Trying to parse response: ", response);    // ---- ++++
            var response = $.parseJSON(response);
            // console.log("JSONified it: ", response);                // ---- ++++

            if (status == 'success') {

                /* Meta have been successfully saved. Need to determine if the
                 * action was a save-as 'complete' or 'partial' in order to inform
                 * the Moodle block that it needs to update the visual status  of
                 * the element */
                params.status = validate ? 'complete' : 'partial';
                params.updateCallback(params);
                flashOutMessage(span, response['message'], 'success');
            } else {
                flashOutMessage(span, response['message']);
            }
        });
        return true;
    }

    function flashOutMessage(element, msg, addClass, keepClass, timeout) {
        addClass || (addClass = 'error');
        keepClass || (keepClass = 'save-status');
        timeout || (timeout = 5000);

        /* remove previously set classes and keep only the keepClass and addClass */
        $(element).removeClass();
        $(element).addClass(addClass);
        $(element).addClass(keepClass);
        $(element).hide();
        $(element).html(msg);
        $(element).show();
        $(element).fadeOut(timeout);
    }

    function composeSelect(kit, data, fieldName, L10n, prefix) {
        var result = $('<div>').dform({
            "type"  : "container",
            "class" : "block_mdeditor-element_twoline",
            "html"  : {
                "type"    : "select",
                "caption" : L10n.element[fieldName].caption,
                "name"    : prefix + '[' + fieldName + ']',
                "options" : L10n.element[fieldName].options
            }
        });

        result = $(result).children()[0];


        $(result).data('setData', selectSetData);
        $(result).data('prefix', prefix);
        $(result).data('fieldName', fieldName);

        if (data[prefix] && data[prefix][fieldName]) {

            var f = $.proxy(selectSetData, result);
            f(data);
        }

        return result;
    }

    function composeRightsCC(kit, data, fieldName, L10n) {
        var optName = fieldName,
        cc = L10n.element.rights.cc_options,
        result = $('<div>').dform({
            "type"    : "container",
            "caption" : L10n.element.rights.cc_caption,
            "html"    : [
            {
                "type"  : "label",
                "class" : "error",
                "for"   : "cc",
                "generated" : true
            },
            {
                "type"  : "container",
                "style" : "margin-top: 0.3em;",
                "html"  : {
                    "type"    : "radio",
                    "caption" : cc[""],
                    "class"   : "rule_exactly-one",
                    "value"   : "",
                    "post"    : function() {
                        $(this).attr('id', fieldName+'-cc_no');
                        $(this).attr('name', optName);
                    }
                }
            },
            {
                "type"  : "container",
                "style" : "margin-top: 0.3em;",
                "html"  : {
                    "type"    : "radio",
                    "caption" : cc["by"],
                    "value"   : "by",
                    "post"    : function() {
                        $(this).attr('id', fieldName+'-cc_by');
                        $(this).attr('name', optName);
                    }
                }
            },
            {
                "type"  : "container",
                "style" : "margin-top: 0.3em;",
                "html"  : {
                    "type"    : "radio",
                    "caption" : cc["by_nd"],
                    "value"   : "by_nd",
                    "post"    : function() {
                        $(this).attr('id', fieldName+'-cc_by_nd');
                        $(this).attr('name', optName);
                    }
                }
            },
            {
                "type"  : "container",
                "style" : "margin-top: 0.3em;",
                "html"  : {
                    "type"    : "radio",
                    "caption" : cc["by_nc_nd"],
                    "value"   : "by_nc_nd",
                    "post"    : function() {
                        $(this).attr('id', fieldName+'-cc_by_nc_nd');
                        $(this).attr('name', optName);
                    }
                }
            },
            {
                "type"  : "container",
                "style" : "margin-top: 0.3em;",
                "html"  : {
                    "type"    : "radio",
                    "caption" : cc["by_nc"],
                    "value"   : "by_nc",
                    "post"    : function() {
                        $(this).attr('id', fieldName+'-cc_by_nc');
                        $(this).attr('name', optName);
                    }
                }
            }
            ]
        });

        //result = $(result).children()[0];

        $(result).data('setData', radioSetData);
        $(result).data('fieldName', fieldName);

        if (data[fieldName]) {
            var f = $.proxy(radioSetData, result);
            f(data[fieldName]);
        }

        return result;
    }

    function getKeywords(request, callback) {
        var result = new Array();//,
        //            data = $(this.element).data();
        //            lang = $(data.parent).data('refs')['lang'];

        //        if (! lang) callback(result);

        //        var language = $(lang).val();

        //        if (! language) callback(result);
        //console.log('selected language is', language);

        //        var term = request.term,
        //            url = M.cfg.wwwroot + '/blocks/mdeditor/action/get_keywords.php?' +
        //            'term=' + term +
        //            '&language=' + language;

        //        $.ajax(url, {
        //            "async" : false,
        //            "success" : function(response) {
        //                console.log('get_keywords.php: ', response);
        //                if (! response) return result;

        //                var terms = $.parseJSON(response);
        //                if (! terms) return result;

        //                result = terms;
        //            }
        //        });
        //        .success(function(response) {
        //            console.log('get_keywords.php: ', response);
        //            if (! response) return result;

        //            var terms = $.parseJSON(response);
        //            if (! terms) return result;
        //console.log(callback);
        //            callback(result);
        //        });
        //console.log(callback);
        callback(result);
    }

    function composeInput(type, data, fieldName, L10n, prefix) {

        var result = $('<div>').dform({
            "type"  : "container",
            "class" : "block_mdeditor-element_twoline",
            "html"  : {
                "type"    : type,
                "caption" : L10n.element[fieldName].caption,
                "name"    : prefix + '[' + fieldName + ']',
                "class"   : "block_mdeditor-input"
            }
        });
        result = $(result).children();

        var input =  $(result).find('.block_mdeditor-input');

        $(result).data('setData', inputSetData);
        $(result).data('target', input);
        $(result).data('prefix', prefix);
        $(result).data('fieldName', fieldName);

        if (data[prefix] && data[prefix][fieldName]) {

            var f = $.proxy(inputSetData, result);
            f(data);
        }

        return result;
    }

    function inputSetData(data) {
        if (!data) return;

        var target = $(this).data('target'),
        prefix = $(this).data('prefix'),
        fieldName = $(this).data('fieldName');

        if (!data[prefix][fieldName]) return;
        var value = data[prefix][fieldName];

        $(target).val(value);
    } 
    
    function composeChecklist(kit, data, fieldName, L10n, classes, widget) {
        var allLangs = $.extend(true, {}, L10n.element[fieldName].options);

        /* if there is data for this field, mark as checked the corresponding
         * options */
        if (data[fieldName]) {
            var selection = data[fieldName];

            for (var i = 0 ; i < selection.length ; ++i) {
                var key = selection[i],
                value = allLangs[key];

                if (allLangs[key]) {

                    if (allLangs[key].html) {
                        allLangs[key].selected = 'selected';
                    } else {
                        allLangs[key] = {
                            "selected" : "selected", 
                            "html" : value
                        };
                    }
                } else {

                    /* if option of optgroup was selected: */
                    /* make this more efficient */
                    for (var candidate in allLangs) {
                        if (allLangs[candidate].options) {
                            var optgroup = allLangs[candidate].options;
                            if (optgroup[key]) {
                                value = optgroup[key];
                                optgroup[key] = {
                                    "selected" : "selected", 
                                    "html" : value
                                };
                            }
                        }

                    }
                }
            }
        }
        return block_mdeditor_compose_checklist(kit, allLangs, fieldName, L10n, classes, widget);
    }

    function composeDescription(kit, data, fieldName, L10n, isOptional) {
        isOptional || (isOptional = true);
        var widget = {
            "type"  : "textarea",
            "rows"  : 3,
            "cols"  : 40
        };
        if (! isOptional) widget['class'] = 'rule_non-empty';

        return block_mdeditor_compose_description(kit, data, fieldName, L10n, widget);
    }

    /* Convenience wrapper function of `compose_description()' that provides the
     * appropriate widget object that will result in a keywords input field. */
    function composeKeyword(kit, data, fieldName, L10n) {
        var widget = {
            "type" : "text",
            // "size" : 30,
            "style" : "width: 250px;",
            "autocomplete" : {
                source : getKeywords
            }
        };

        return block_mdeditor_compose_description(kit, data, fieldName, L10n, widget);
    }

    function getCopy(event) {
        event.preventDefault();
        var L10n = $(this).data('L10n'),
        hideThis = $(this).data('hideTarget'),
        inputs = $(this).data('inputs');

        var select = $(this).data('select'),
        id = $(select).val(),
        prefix = id.substring(0, 1),
        type = null;

        /* determine target URL */
        if (prefix == 'c') {
            type = 'course';
            id = id.substring(1);
        } else {
            type = 'resource';
        }

        $.get(M.cfg.wwwroot + '/blocks/mdeditor/action/define.php?type='+type+'&id='+id)
        .success(function(response) {
            if (! response) return;

            var data = $.parseJSON(response);
            if (! data) return;

            // if ...
            var f = null;
            for (var input in inputs) {

                if (inputs[input] == 'checklist') {

                    if (! data[input]) continue;

                    $('#'+input).find('.checklist-option').each(function(key, option){
                        var val = $(option).val();

                        if ($.inArray(val, data[input]) > -1) {

                            $(option).attr('checked', 'checked');
                        } else {
                            $(option).removeAttr('checked');
                        }
                    });
                } else if (inputs[input].type == 'input') {
                    f = $(inputs[input].input).data('setData');
                    f = $.proxy(f, inputs[input].input);
                    f(data);
                } else {
                    console.log(' ', input, data, data[input]);                 // +++
                    f = $(inputs[input]).data('setData');
                    f = $.proxy(f, inputs[input]);
                    f(data[input]);
                }
            }
        });
    }

    var controlClass = 'control',
    containerClass = 'container-fluid';

    target.kit = {
        /* functions */
        "setData"  : setData,
        "rightsSetData" : rightsSetData,
        "contributeSetData" : contributeSetData,
        "setContainerData" : setContainerData,
        "wombBear" : wombBear,
        "setLocButton" : setLocButton,
        "newLocale"    : newLocale,
        "addContainer" : addContainer,
        "newLocaleContainer" : newLocaleContainer,
        "newLocaleContainerNG" : newLocaleContainerNG,
        "setIndex"     : setIndex,
        "setStimsIndex" : setStimsIndex,
        "setStimsName" : setStimsName,
        "setContainerName" : setContainerName,
        "clearContainerIndex" : clearContainerIndex,
        "clearContainerIndexNG" : clearContainerIndexNG,
        "clearStimsIndex" : clearStimsIndex,
        "setIndexToContainer" : setIndexToContainer,
        "hideLocale"   : hideLocale,
        "hideContainer"   : hideContainer,
        "runInstead"   : runInstead,
        "runMethod"   : runMethod,

        "persistLOM" : persistLOM,
        "composeCopyTemplate" : composeCopyTemplate,
        "composeChecklist" : composeChecklist,
        "composeSelect" : composeSelect,
        "composeRightsCC" : composeRightsCC,
        "composeInput" : composeInput,
        "composeDescription" : composeDescription,
        "composeKeyword": composeKeyword,

        /* objects */
        "womb"     : womb,
        "out"      : out,
        "langRepo" : langRepo,
        "addLocaleButton" : addLocale,

        /* variables */
        "controlClass"   : controlClass,
        "containerClass" : containerClass
    };

};
