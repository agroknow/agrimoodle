/**
 * Eummena - info@eummena.org
 *
 * @developer Tasos Koutoumanos
 */

/* EUROPEANA Service URL */
var service_url = 'http://ariadne.cs.kuleuven.be/GlobeFinderF1/servlet/search';

var selected_page = 1;
var per_page=5;

var boxy_ref = null ;
var boxy_ref2 = null ;

YUI().use ('io-base', 'node', function(Y) {

function handleResponse(resp) {
	console.log("RESPONSE :" + response.outputHTML);
}

/**
* Core Request Function
* Send JSON Request to EUROPEANA server, and return result 
* then display it in results div.
*/
function sendQuery(qstring, base_url) {

	console.log("REQUESTED TO QUERY: " + qstring + " WITH BASE_URL: " + base_url);

	// FIXME: m17n
	if( qstring === '' ) {
		alert('You must enter a valid query string!');
		return ;
	}

	var clauses = [{
		language:'VSQL',
		expression:qstring
	}];
	var petition = {
		clause: clauses,
		resultFormat:'json',
		resultListOffset:0,
		resultListSize:6
	};

	url = service_url;

/*
	new Ajax.JSONRequest(url, {
		method: 'get',
		requestHeaders: {Accept: 'application/json'},
		parameters: {
			json: Object.toJSON(petition),
			engine: 'InMemory'
		},
		onSuccess: function(transport) {
			response = eval(transport.responseJSON);
			searchResultList = response.result.metadata;
			//search result id list
			searchIdResultList=response.result.id;
			var content = '';
			console.log(searchIdResultList);
			if(searchResultList.length <=0)	{
				content = "<div>No Results, use other terms...</div>";
			} else {
				content='<ul> ';
				for(var i=0; i<searchResultList.length;i++) {
					var title = searchResultList[i].title;
					var body = searchResultList[i].description;
					var location = searchResultList[i].location;
					var id = escape(searchIdResultList[i]);

					content+= '<li><a data-id="'+id+'" href="#" location="'+location+'" body="'+body+'" title="'+title+'" class="modal_show">';
					content+= title;
					content+= '</a><div class="raty" id="'+id+'" data-startvalue="'+0+'"></div>' ;
					content+= '</li>';
				}

				content+=' </ul>'
			}

			// put the results in the div with id="results" 
			jQuery('#results').html(content);

		}, // onSuccess
		onFailure: function() {
			alert('Something went wrong...');
		} // onFailure
	})
*/

//	var service = Y.JSONPRequest(url, handleResponse);

var service = new Y.JSONPRequest(url, {
	on: {
		success: handleJSONP,
		timeout: handleTimeout
	},
	timeout: 3000          // 3 second timeout
//        args: [new Date(), 100] // e.g. handleJSONP(data, date, number)
});
service.send();
};

function pagingRequest(qstring,id,start,end)
{
	start = start || 6 ;
	end = end || 0 ;

	buffer = [];

	var clauses = [{
		language:'VSQL',
		expression:qstring

	}];
	var petition = {
		clause: clauses,
		resultFormat:'json',
		resultListOffset:start,
		resultListSize:5
	};

	new Ajax.equest(service_url, {
		callbackParamName: "callback",
		method: 'get',
		parameters: {
			json: Object.toJSON(petition),
			engine: 'InMemory'
		},
		onSuccess: function(transport) {

			response = eval(transport.responseJSON);
			searchResultList =response.result.metadata;


			//search result id list
			searchIdResultList=response.result.id;
			var html = '';

			html='<table>  ';
			for(var i=0; i<searchResultList.length;i++)
			{
				//console.log(searchResultList[i])
				var title=searchResultList[i].title;
				var body=searchResultList[i].description;
				var location = searchResultList[i].location;
				var keywords= implode(',',searchResultList[i].keywords);
				var id= escape(searchIdResultList[i]);
				html+='<tr ><td><a  href="#" data-id="'+id+'" location="'+location+'" body="'+body+'" title="'+title+'" class="modal_show">';

				if( title.length > 100 ) {
					html+=  ''+title.substr(0,100)+'..';
				} else {
					html+=  ''+title ;
				}

				html+='</a><div class="raty_more" id="'+id+'" data-startvalue="'+0+'"></div>' ;
				if( body.length < 120 ) {
					html+='<div>'+body.substr(0,120)+'</div>';
				} else {
					html+='<div>'+body.substr(0,100)+'<br/>'+body.substr(101,100)+'..</div>';
				}

				html+= '<div style="font-weight:bold;font-size:10px;"> Keywords : '+keywords.substr(0,100)+'..</div>';
				html+='</td></tr>';
			}
			html+="</table><div id=\"widjet_pages\"></div>";
			//remove prev boxy box
			if( boxy_ref != null ) {
				boxy_ref.hide();
				boxy_ref.unload();

			}

			boxy_ref = new Boxy( html ,{
				draggable: true,
				modal:true,
				title:ARD_LANG['more_results'],
				y:10,
				unloadOnHide:true,
				closeText:ARD_LANG['close']
			//  fixed:false
			});

			genPage('#widjet_pages',response.result['nrOfResults'],selected_page);
		}
	});
};


function genPage(inDiv,numrows,_selected_page)
{
	if( numrows <= per_page )
	{
		return false;
	}

	var pages = Math.ceil(  numrows / per_page  ) - 1;

	var html="";
	var range = 6 ;
	var from_page = ( ( _selected_page-range  ) <= 0 )? 1 : _selected_page -range ;
	var to_page = (   ( _selected_page  ) <=  pages-range )?  _selected_page+range :   _selected_page+(pages-_selected_page) ;
	html += '<a href="" data-offset="'+1+'" class="wnext_page"  data-offset="'+1+'"> '+ARD_LANG['first']+' </a>';
	html += '<a href="" data-offset="'+ (_selected_page-1) +'" class="wnext_page"> < </a>';

	for( var i = from_page; i <= to_page ;i++ )
	{
		if( i == _selected_page )
		{
			html += '<span  class=" pselected wnext_page "  data-offset="'+i+'">'+i+'</span>';
		}
		else
		{
			html += '<a href="" data-offset="'+i+'" class="wnext_page">'+i+'</a>';
		}
	}
	html += '<a href="" data-offset="'+(_selected_page+1)+'" class="wnext_page ">  > </a>';
	html += '<a href="" data-offset="'+pages+'" class="wnext_page"> '+ARD_LANG['last']+' </a>';
	jQuery(inDiv).html(html );
};


jQuery('.wnext_page').live('click',function() {
	boxy_ref.setTitle('Loading...');

	var offset = parseInt( jQuery(this).attr('data-offset'));
	selected_page = offset;
	searchPages(offset);

	return false;
});

/**
 *Start Point
 **/
jQuery(document).ready(function() {
	
	// +++ let's start!
	var qstring = document.getElementById("simple_search_fld").value;
	sendQuery(qstring,"");
	jQuery('.modal_show').live('click',function(){
		var title = jQuery(this).attr('title');
		var body =  jQuery(this).attr('body');
		var location =jQuery(this).attr('location');

		var social_links = '<span style="float:right;clear:both;">'+get_social_buttons(location)+'<span>';
		var last_boxy;
		//remove prev boxy box
		/*  if( boxy_ref != null )
        {
            last_boxy = boxy_ref;
            boxy_ref.hide();
            boxy_ref.unload();
        }*/

		boxy_ref2 = new Boxy( '<p style="width:500px; padding-bottom:0; text-align:left;"> '+getLogo(location)+body+'<br/><a target="_blank" href="'+location+'">'+location+'</a> ' +'<br/> '+social_links+'</p> '+
			'<br clear="all"/> <br clear="all"/> <div class="overlay-options"  style="clear:both !important; width:100%;"> Please Choose a Section : <select id="section"></select> <input type="button" class="import_moodle" value="Import" data-name="' +title+ '" data-body="'+body+'" /> <br/><!--<a href=\''+location+'\' target=\'_blank\'> '+location+'</a>-->  </div>' , {
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


	jQuery('#simple_search_fld').click(function(){
		if( jQuery(this).val().trim() === 'Search..')
		{
			jQuery(this).val('');
			jQuery(this).css('color','#000');
		}
	});
	jQuery('#simple_search_fld').blur(function(){

		if( jQuery(this).val().trim() === '')
		{
			jQuery(this).val('Search..');
			jQuery(this).css('color','#999');
		}
	});


});

//Close modal box on click escape .
jQuery(document).keyup(function(e) {

	if (e.keyCode == 27) {
		if( boxy_ref != null && (boxy_ref2.isVisible() === false || boxy_ref2 === null )   )
		{
			boxy_ref.hide();
		}
		if( boxy_ref2 != null )
		{
			boxy_ref2.hide();
		}
	}   // esc
});



jQuery('#getMoreResults').live('click',function(){
	selected_page=1;
	searchPages();
	return false;
});



function searchPages(offset)
{

	var showPerPage = 5 ;
	offset = ( offset || 0  ) * showPerPage ;
	//if he not enter any thing in the search box i.e. just enter the page .
	var search_term = "";
	if( jQuery('#simple_search_fld').val() !== "Search..")
	{
		search_term = jQuery('#simple_search_fld').val();
	}
	else
	{
		search_term = page['course_name'];
	}

	pagingRequest(search_term,'',offset,showPerPage);


	return false;
};
function getLogo(learnObjectURL)
{
	var logos ={
		'http://ariadne.cs.kuleuven.be':base_url()+'logos/ariadne.png',
		'http://www.oercommons.org':base_url()+'logos/oercommons.png'
	};


	for( key in logos )
	{
		var patt = new RegExp(key ,'ig');
		if( patt.test(learnObjectURL) )
		{
			return '<a href="http://'+key+'"><img style="float:right; margin:5px;height:90px;"  src="'+logos[key]+'"/></a>';
		}
	}


	return '<br style="clear:both;"/><a href="http://ariadne.cs.kuleuven.be"><img style="float:right; margin:5px;height:90px;" src="'+logos['http://ariadne.cs.kuleuven.be']+'"/></a>';;

};





/******************************************/
/******************************************/
/**            Utily Functions           **/
/******************************************/
/******************************************/
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
};

function base_url()
{
	// FIXME: make it dynamic
	return "http://localhost/agrimoodle/blocks/ariadne/";
};

function abs_url()
{
	// FIXME: make it dynamic
	return "http://localhost/agrimoodle/";
};

/**
* Generate Social Media Links to be used with dynamic url
*
*  @athor Ahmad Shukr
*  @param url<string>
*  @return <string>
*/
function get_social_buttons(url)
{
	// using array give the advantge for flixble add and remove links
	var links = new Array();

	// twitter
	links[0]='<a href="http://twitter.com/home?status='+url+'" title="Share to Twitter"> <img src="'+base_url()+'images/twit.png"/></a>';
	// facebook
	links[1]='<a href="http://www.facebook.com/sharer.php?u='+url+'" title="Share to Facebook"><img src="'+base_url()+'images/face.png"/></a>';
	// linkedin
	links[2]='<a href="http://www.linkedin.com/shareArticle?mini=true&url='+url+'"><img src="'+base_url()+'images/linked.png" style="width:36px; height:36px;"/></a>';

	// Delicious
	links[3]='<a href="http://del.icio.us/post?url='+url+'&amp;amp;title&amp;notes="><img src="'+base_url()+'images/delc.png"/></a>';

	//concate string
	return implode(" ",links);
};





function baseDomain()
{
	// FIXME: make it dynamic
	return 'localhost';
};

});