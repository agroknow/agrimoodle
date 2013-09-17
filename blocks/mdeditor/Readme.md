
L10n.php
--------
Contains all the strings and structure of the metadata editor popup window. 
Parsed as a JSON string from the **module.js** script. If we need to change the 
metadata editor's form, we can probably do it only by editing this file.

module.js
---------
This is a standard script for Moodle. Moodle loads it automatically when the 
block of mdeditor appears. It contains callback functions that have access to 
the **M.block_mdeditor** php object. 
It's easy to debug with @console.log("a message!");@ statements (you need to 
keep the Develeper's tools Javascript console open in order to watch the 
messages).
The script calls in respect the **composer.js**, a giant script with >4100 loc!


composer.js
----------- 
The "beast" (>4100 loc). These are the main parts:

0001: block_mdeditor_compose_title(kit, data, fieldName, L10n)
0255: (kit, data, fieldName, L10n, classRule, widget)
0312: (kit, data, fieldName, L10n, widget)
0668: (kit, data, fieldName, L10n, mandatory)
1200: (kit, data, fieldName, L10n)
1879: (target, data, L10n, targetUrl, requestParams)
2180: ------ HEALT WARNING - sic ;-) ------
2215: mapper(children)
2244: indexer(params)
2295: $.dform.addType('language-selector', function(o)
2342: $.dform.addType('spanify', function(o)
2369: $.dform.subscribe('default-mapper', function(o)
2399: $.dform.subscribe('toChecklist', function(o, type)
2404: $.dform.subscribe('dialog_init', function(o, type)
2417: block_mdeditor_init_kit(target, L10n)                <-------- the beast!
2419: |- runInstead(e)
2490: |- runMethod(e)
2453: |- wombBear(womb)
2481: |- addControl(prefix, control, womb)
2520: |- newLocaleContainer()
2610: |- newLocaleContainerNG()
2712: |- addContainer(prefix, container, womb)
2766: |- newLocale()
2823: |- redisplayLocale(shades)
2868: |- redisplayContainer(shades)
2902: |- hideLocale(control)
2958: |- hideContainer(container)
3013: |- setLocButton(button, control)
3027: |- setIndex(prefix, order, targets)
3038: |- setIndexToContainer(target, order)
3053: |- clearContainerIndex()
3063: |- clearIndex(targets)
3071: |- $.dform.subscribe("indexible", function()
3283: |- setData(data, format)
3341: |- setContainerData(data, format)
3411: |- selectSetData(data)
3429: |- radioSetData(data)
3457: |- rightsSetData(data, format)
3483: |- clearStimsIndex()
3500: |- setStimsIndex(index)
3524: |- setContainerName(newName)
3540: |- setStimsName(newName)
3553: |- clearContainerIndexNG()
3570: |- contributeSetData(data, format)
3625: --------- end of 1st part ----------
3630: |- composeCopyTemplate(L10n, hideThis, inputs)
3702: |- persistLOM(formId, url, params, L10n, validate)             <----- Important, saves to json file!
3737: |- flashOutMessage(element, msg, addClass, keepClass, timeout)
3752: |- composeSelect(kit, data, fieldName, L10n, prefix)
3780: |- composeRightsCC(kit, data, fieldName, L10n)
3875: |- getKeywords(request, callback)
3917: |- composeInput(type, data, fieldName, L10n, prefix)
3947: |- inputSetData(data)
3960: |- composeChecklist(kit, data, fieldName, L10n, classes, widget)
3999: |- composeDescription(kit, data, fieldName, L10n, isOptional)
4013: |- composeKeyword(kit, data, fieldName, L10n)
4026: '- getCopy(event)

