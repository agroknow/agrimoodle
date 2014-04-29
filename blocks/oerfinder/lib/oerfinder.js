/**
 * Eummena - info@eummena.org
 * Agro-Know - info@agroknow.gr
 *
 * @developer Ahmad Shukr
 * @developer Tasos Koutoumanos
 */


/* Ariadne 2 Service URL */
//var service_url = 'http://ariadne.cs.kuleuven.be/globe-ws/api/ariadne/restp';

//http://agrolab.sytes.net:9999/wiki/doku.php/project/ariadne_search

// var service_url = 'http://ariadne.cs.kuleuven.be/GlobeFinderF1/servlet/search';
//Check div in block_oerfinder for web service url
var service_url = document.getElementById("web_service_url").innerHTML;
//var service_url = 'http://83.212.96.169:8080/repository2/api/ariadne/restp';

// Check div in block_oerfinder to run or not the experment
var runexperiment = document.getElementById("run_experiment").innerHTML;
if(runexperiment=='1'){
    var logger_url = home_url() + "blocks/oerfinder/lib/logger.php";
}else{
    var logger_url =null;
}

// Holds the results accross various pages
var searchResultList = [];

// variables to control the pager
var selected_page = 1;
var per_page = 2;

var boxy_ref = null ;
var boxy_ref2 = null ;



// keep the logger's timestamp as a token in case
// we need to log back a click;
var logger_timestamp="";

/**
 * Core Request Function
 * Send JSONP Request to ariadne server and
 * return result then display it in results div.
 */
function sendJSONRequest(es_query) {

    buffer = [];
    // FIXME: m17n
    if( es_query === 'Search...' ) {
        alert('You must enter a valid keyword :) ');
        return ;
    }

    var clauses = [{
        language:'VSQL',
        expression:es_query

    }];
    var petition = {
        clause: clauses,
        resultFormat:'json',
        resultListOffset:1,
        resultListSize: per_page+1
    };

    //    console.log("Sending JSON request :", JSON.stringify(petition));
    jQuery.getJSON(service_url+"?callback=?", {
        json: JSON.stringify(petition),
        engine: 'InMemory'
    },
    function(data) {
        //        console.log("GOT RESPONSE !!! ", data);
        searchResultList = data.result.metadata;
        //search result id list
        searchIdResultList=data.result.id;
        var content = '';

        // log the results in the experiment log
        logExperiment(searchIdResultList);

        if(searchResultList!=null) {
            if(searchResultList.length <=0)	{
                content = "<div>No Results, use other search terms...</div>";
            } else {
                content='<ul>';
                for(var i=0; i<searchResultList.length;i++)  {
                    var sr = searchResultList[i];
                    var title=sr.title;
                    var body=sr.descriptions;
                    var location = sr.location;
                    var id= escape(searchIdResultList[i]);
                    var titlevalue = title[0]['value'];
                    for (t=0;t<title.length;t++){ 
                        if(title[t]['lang']=='en'){
                            titlevalue=title[t]['value'];
                        } 
                    }
                    if(body!=null){
                        var bodyvalue = ''; 
                        for (t=0;t<body.length;t++){ 
                            if(body[t]['lang']=='en'){
                                bodyvalue=body[t]['value'];
                            } 
                        }
                    }else{
                        var bodyvalue = '';
                    }
                    content+= '<li><a data-id="'+id+'" href="#" location="'+location+'" body="'+bodyvalue+'" title="'+titlevalue+'" class="modal_show">';
                    content+= titlevalue + '</a>';
                    //~ content+= '</a><div class="raty" id="'+id+'" data-startvalue="'+0+'"></div>' ;
                    content+= '</li>';
                //                    console.log(sr);
                }

                content+=' </ul>'
                content+='<div><a href="" id="getMoreResults">More...</a></div>';
            }
        }

        // $('results').update(content);
        jQuery('#results').html(content);
    })
    .error(function(response) {
        console.log("JSON failure ", response);
        jQuery('#results').html("Service unavailable, sorry...")
    });

}

function logExperiment(results, click) {
    // Do we need to go on?
    if (logger_url == null) {
        console.log("Not going to run the experiment!");
        return;
    }

    click = (click || 0);

    var rr = {
        "results" : results, 
        "search" : "XXXXX", 
        "action" : 0, 
        "click" : 0, 
        "id": 0, 
        "timestamp" : ""
    } ;

    if (click) {
        dt = new Date();
        rr.click = dt.value;
        rr.timestamp = logger_timestamp;
        rr.action = 10;
    }

    //    console.log("Trying to log experiment: " + JSON.stringify(rr));

    jQuery.getJSON(logger_url+"?callback=?", {
        json: JSON.stringify(rr),
        engine: 'InMemory'
    },
    function(res) {
        logger_timestamp = res.timestamp;
        content= "&gt; " + res.newLogEntries + " entries logged (" +
        res.totalLogEntries + " total)";
        jQuery('#debug').html(content);
    })
    .error(function(response) {
        console.log("JSON failure ", response);
        content= "Unable to log experiment!";
        jQuery('#debug').html(content);
    }
    );
}

function pagingRequest(es_query, start) {
    //    console.log("=============", es_query, start);
    start = start || 1 ;
    if (start < 1) start = 1;

    var clauses = [{
        language:'VSQL',
        expression:es_query

    }];
    var petition = {
        clause: clauses,
        resultFormat:'json',
        resultListOffset:(start-1)*per_page,
        resultListSize:per_page
    };

    jQuery.getJSON(service_url+"?callback=?", {
        json: JSON.stringify(petition),
        engine: 'InMemory'
    },
    function(data) {
        //search result id list
        searchResultList = data.result.metadata;
        // log the results in the experiment log
        logExperiment(searchIdResultList);

        var html = '';

        html='<table>  ';
        for (var i=0; i<searchResultList.length; i++) {
            var title=searchResultList[i].title;
            var body=searchResultList[i].descriptions;
            var location = searchResultList[i].location;
            var keywordsvalue = new Array();
            if(searchResultList[i].keywords!=null){
                for (t=0;t<searchResultList[i].keywords.length;t++){ 
                    if(searchResultList[i].keywords[t]['lang']=='en'){
                        keywordsvalue[t]=searchResultList[i].keywords[t]['value'];
                    }
                }
            }
            var keywords= implode(',',keywordsvalue);
            var id= escape(searchIdResultList[i]);
            var titlevalue = title[0]['value'];
            for (t=0;t<title.length;t++){ 
                if(title[t]['lang']=='en'){
                    titlevalue=title[t]['value'];
                } 
            }
            if(body!=null){
                var bodyvalue = ''; 
                for (t=0;t<body.length;t++){ 
                    if(body[t]['lang']=='en'){
                        bodyvalue=body[t]['value'];
                    } 
                }
            }else{
                var bodyvalue = '';
            }
            html+='<tr ><td><a  href="#" data-id="'+id+'" location="'+location+'" body="'+bodyvalue+'" title="'+titlevalue+'" class="modal_show">';
            
            if( titlevalue.length > 100 ) {
                html+=  ''+titlevalue.substr(0,100)+'...';
            } else {
                html+=  ''+titlevalue ;
            }

            //~ html+='</a><div class="raty_more" id="'+id+'" data-startvalue="'+0+'"></div>' ;
            html+='</a>' ;
            if( bodyvalue.length < 120 ) {
                html+='<div>'+bodyvalue.substr(0,120)+'</div>';
            } else {
                html+='<div>'+bodyvalue.substr(0,100)+'<br/>'+bodyvalue.substr(101,100)+'..</div>';
            }

            html+= '<div style="font-weight:bold;font-size:10px;"> Keywords : '+keywords.substr(0,100)+'..</div>';
            html+='</td></tr>';
        }
        html+="</table><div id=\"widget_pages\"></div>";

        //remove prev boxy box
        if( boxy_ref != null ) {
            boxy_ref.hide();
            boxy_ref.unload();

        }

        boxy_ref = new Boxy(html ,{
            draggable: true,
            modal:true,
            title:M.util.get_string('more_results', 'block_oerfinder') ,
            y:10,
            unloadOnHide:true,
            closeText:'close'
        //  fixed:false
        });

        //        console.log("created new boxy: " + boxy_ref, "for ::: ", data);

        createPager('#widget_pages', data.result['nrOfResults']);
    })
    .error(function(data) {
        console.log("JSON failure ", data);
        content= "Unable to log experiment!";
        jQuery('#debug').html(content);
    });

}


function createPager(inDiv, numrows) {
    //    console.log("~~~~~~~~~~~~~~~~~~~~~~", inDiv, "--", numrows, "--", selected_page);
    //    if( numrows <= per_page ) {
    //        return false;
    //    }

    var total_pages = Math.ceil(  numrows / per_page  );
    
    if (selected_page > total_pages) selected_page = total_pages;
    if (selected_page < 1) selected_page = 1;

    var html="";
    var range = per_page ;
    var from_page = ( ( selected_page-range  ) <= 0 )? 1 : selected_page -range ;
    var to_page = (   ( selected_page  ) <=  total_pages-range )?  selected_page+range :   selected_page+(total_pages-selected_page) ;
    
    var disable_first = (selected_page <= 1);
    var disable_last = (selected_page >= total_pages);

    fclass = disable_first ? "disabled_wnext_page" : "wnext_page";

    html += '<span href="" pg="' + 1 +  '" class="' + fclass + '">first</span>';
    html += '<span href="" pg="'+ (selected_page-1) + '" class="' + fclass + '"> < </span>';

    for( var i = from_page; i <= to_page ;i++ ) {
        if( i == selected_page ) {
            html += '<span  class=" pselected wnext_page " pg="'+i+'">'+i+'</span>';
        } else {
            html += '<span href="" pg="'+i+'" class="wnext_page">'+i+'</span>';
        }
    }
    
    lclass = disable_last ? "disabled_wnext_page" : "wnext_page";
    html += '<span pg="' + (selected_page+1) + '" class="' + lclass + '">  > </span>';
    html += '<span pg="' + total_pages + '" class="' + lclass + '">last</span>';
    jQuery(inDiv).html(html);
    return true;
}

// jQuery.live has been removed since jquery 1.9 ...
// jQuery('.wnext_page').live('click',function(){
jQuery(document).on('click', '.wnext_page', function() {
    boxy_ref.setTitle('Loading...');

    var pg = parseInt( jQuery(this).attr('pg'));
    console.log('************************************',  pg);
    selected_page = pg;
    searchPages();

    return false;
});


/**
 * Starting point
 **/
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
jQuery(document).ready(function() {
    /* Lets Start */
    //    console.log("JUST STARTED!");
    sendJSONRequest(jQuery('#simple_search_fld').val());

    jQuery('#submit_search').click( function() {
        console.log("What?");
        sendJSONRequest(jQuery('#simple_search_fld').val());
    });

    //    jQuery('.modal_show').live('click',function() {
    jQuery(document).on('click', '.modal_show', function() {
        var title = jQuery(this).attr('title');
        var body =  jQuery(this).attr('body');
        var location =jQuery(this).attr('location');
        var id = 'rate-'+jQuery(this).attr('data-id');

        console.log(">>>>>>>>>> CLICK! <<<<<<<<<<<<<<<");
        console.log(logger_timestamp);

        logExperiment([location], true)

        var social_links = '<span style="float:right;clear:both;">'+get_social_buttons(location)+'<span>';
        var last_boxy;
        //remove prev boxy box
        /*  if( boxy_ref != null )
        {
            last_boxy = boxy_ref;
            boxy_ref.hide();
            boxy_ref.unload();
        }*/

        boxy_ref2 = new Boxy(
            '<p style="width:500px; padding-bottom:0; text-align:left;"> ' +
            getLogo(location) + body + '<br/><a target="_blank" href="' +
            location + '">' + location + '</a><br/> ' + social_links+'</p>' ,
            {
                title:title ,
                draggable: true,
                modal:true,
                unloadOnHide:true,
                beforeUnload:function(){
                // if( last_boxy != null )
                // last_boxy.show();
                },
                fixed:false
            });

        return false;
    });


    jQuery('#simple_search_fld').click(function() {
        if( jQuery(this).val().trim() === 'Search...') {
            jQuery(this).val('');
            jQuery(this).css('color','#000');
        }
    });
    jQuery('#simple_search_fld').blur(function() {

        if( jQuery(this).val().trim() === '') {
            jQuery(this).val('Search...');
            jQuery(this).css('color','#999');
        }
    });


});

//Close modal box on click escape .
jQuery(document).keyup(function(e) {

    if (e.keyCode == 27) {
        if( boxy_ref != null && (boxy_ref2 === null || boxy_ref2.isVisible() === false )) {
            boxy_ref.hide();
        }
        if( boxy_ref2 != null ) {
            boxy_ref2.hide();
        }
    }   // esc
});



//jQuery('#getMoreResults').live('click',function( ) {
jQuery(document).on('click', '#getMoreResults', function() {
    //    console.log("User is trying to get more results!")
    selected_page=2;
    searchPages();
    return false;
});


function searchPages() {
    // default to 1st page
    pg_no = (selected_page > 0) ? selected_page : 1;
    

    var search_term = "";
    if( jQuery('#simple_search_fld').val() !== "Search...") {
        search_term = jQuery('#simple_search_fld').val();
    } else {
        search_term = page['course_name'];
    }
    pagingRequest(search_term, pg_no);

    return pg_no;
}


/*           Utily Functions          */
/*------------------------------------*/
function implode (glue, pieces) {
    // http://kevin.vanzonneveld.net
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Waldo Malqui Silva
    // +   improved by: Itsacon (http://www.itsacon.net/)
    // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
    // *     example 1: implode(' ', ['Kevin', 'van', 'Zonneveld']);
    // *     returns 1: 'Kevin van Zonneveld'
    // *     example 2: implode(' ', {first:'Kevin', last: 'van Zonneveld'});
    // *     returns 2: 'Kevin van Zonneveld'
    var i = '',
    retVal = '',
    tGlue = '';
    if (arguments.length === 1) {
        pieces = glue;
        glue = '';
    }
    if (typeof(pieces) === 'object') {
        if (Object.prototype.toString.call(pieces) === '[object Array]') {
            return pieces.join(glue);
        }
        for (i in pieces) {
            retVal += tGlue + pieces[i];
            tGlue = glue;
        }
        return retVal;
    }
    return pieces;
}

function base_url() {
    //    return l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1] + "/agrimoodle/blocks/oerfinder/";
    return M.cfg.wwwroot + "/blocks/oerfinder/";
}


/**
 * Returns the agrimoodle home url, e.g. "http://www.example.com/s/agrimoodle/"
 * Note the trailing '/'
 */
function home_url() {
    var old_loc = window.location;
    var new_loc = "";
    // FIXME - this is not very "secure", it could easily break ...
    // window.location has the form: http://localhost/dev/agrimoodle/course/view.php?id=4
    // so we actually want to strip the last two elements between slashes ('/')
    // splitting the location would give us  an array like this:
    // http://localhost/dev/agrimoodle/course/view.php?id=4 --> ,dev,agrimoodle,course,view.php

    // first let's get the array
    var lsplit = old_loc.pathname.split('/');
    // then we remove the last two elements
    lsplit.pop();
    lsplit.pop();
    // and finally join the array back into a string
    new_loc = lsplit.join('/');
    //    console.log("ABS_URL: " + old_loc + " --> " + new_loc);
    return old_loc.protocol + "//" + old_loc.host + new_loc + '/';
}

/**
* Generate Social Media Links to be used with dynamic url
*
*  @athor Ahmad Shukr
*  @param url<string>
*  @return <string>
*/
function get_social_buttons(url) {
    //using array give the advantage for flexible add and remove links
    var links = new Array();

    //twitter
    links[0]='<a href="http://twitter.com/home?status='+url+'" title="Share to Twitter"> <img src="'+base_url()+'images/twit.png"/></a>';
    //facebook
    links[1]='<a href="http://www.facebook.com/sharer.php?u='+url+'" title="Share to Facebook"><img src="'+base_url()+'images/face.png"/></a>';

    //Dig
    links[2]='<a href="http://digg.com/submit?url=http://designwoop.com"><img src="'+base_url()+'images/digg.png"/></a>';

    //Delcious
    links[3]='<a href="http://del.icio.us/post?url='+url+'&amp;amp;title&amp;notes="><img src="'+base_url()+'images/delc.png"/></a>';

    links[4]='<a href="http://www.linkedin.com/shareArticle?mini=true&url='+url+'"><img src="'+base_url()+'images/linked.png" style="width:36px; height:36px;"/></a>';
    //concate string
    return implode(" ",links);
}

function getLogo(learnObjectURL) {
    var logos ={
        'http://ariadne.cs.kuleuven.be' : base_url()+'images/ariadne.png',
        'http://www.oercommons.org'     : base_url()+'images/oercommons.png',
        'http://portal.organic-edunet.eu' : base_url()+'images/org_edunet.png'
    };

    for( key in logos ) {
        var patt = new RegExp(key ,'ig');
        if( patt.test(learnObjectURL) )
            return '<br style="clear:both;"/><a href="http://'+key+'"><img style="float:right; margin:5px;height:90px;"  src="'+logos[key]+'"/></a>';
    }
    return '<br style="clear:both;"/><a href="javascript:void(0);"><img style="float:right; margin:5px;height:90px;" src="'+logos['http://portal.organic-edunet.eu']+'"/></a>';
}
