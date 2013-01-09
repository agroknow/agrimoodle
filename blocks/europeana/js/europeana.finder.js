/**
 * Eummena - info@eummena.org
 *
 * @developer Tasos Koutoumanos
 */



YUI().use ('datasource-io', 'datasource-jsonschema', 'node', 
		   'yui2-container', 'yui2-dragdrop', function(Y) {

/* EUROPEANA Service URL */
//var service_url = 'http://ariadne.cs.kuleuven.be/GlobeFinderF1/servlet/search';
var service_url = '../blocks/europeana/ariadne_result.formatted2.json';
var qstring = document.getElementById("simple_search_fld").value;


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
	var url = service_url;

	var dataSource = new Y.DataSource.IO({source:url});
	console.log("Datasource: " + dataSource);
	dataSource.plug(Y.Plugin.DataSourceJSONSchema, {
		schema: {
			resultListLocator: "result.metadata",
			resultFields: ["title", "description", "keywords", "location", "identifier" ]
		}
	});


//function sendQuery(qstring, base_url) {

	console.log("REQUESTED TO QUERY: " + qstring);
	dataSource.sendRequest({
		callback: {
			success: function(e){
				var _res = "<ul>";
				Y.Array.each(e.response.results, function(item) {
					_res += "<li><a href='" + item.location +"'>" + item.title + "</a></li>";
				});
				_res += "</ul>";
				document.getElementById("results").innerHTML = _res;
			},
			failure: function(e){
				console.log("FAILED with DATA: " + e.response.results);
				alert(e.error.message);
			}
		}
	})
//}

	var panel;
	
	function init() {
		var YAHOO = Y.YUI2;
		panel = new YAHOO.widget.Panel("modalPanel", 
			{
				visible:false,
				modal:true,
				width:"300px",
				height:"auto",
				close: true,
				draggable: true,
				fixedcenter: true
			}
		);
		
	
		panel.hideEvent.subscribe( function() {
			Y.one('#modalContainer').setStyle('height', null);
		});

		panel.render();
		console.log("Completed initializing, created panel: " + panel);
intro
	}

	function showPanel() {
		Y.one('#modalContainer').setStyle('height',Y.one('body').get('winHeight'));
		console.log("Showing modal panel: " + panel + " [" + Y.one('body').get('winHeight') + "]");
	
		panel.show();
	}

	Y.on("domready", init);

	Y.on('click', showPanel, "#popup");
});
