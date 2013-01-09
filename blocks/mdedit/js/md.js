/**
 * Metaedit widget JS*/


//closed namsspaced
jQuery(document).ready(function(){
    var $ = jQuery; 
    
 
     $('#medit').click(function(){
            MDEBox();
     });
});

/**
 * Generate input with type , value
 * 
 * 
 * @param <string> name
 * @param <string> value
 * @param <string> type , default text
 * 
 * @return <string>
 */
function input(name,value,type)
{
    type = type || 'text' ;
    return '<ul><li>'+humanize(name)+'</li>'+
            '<li><input type="'+type+'" value="'+value+'" name="'+name+'" /></li></ul>';
}


function MDEBox()
{
     var out_html = "";
     out_html += '<div class="ulTable">';
     for( obj in MDEData )
     {
         out_html += input(obj , MDEData[obj] );
     }
     out_html += input('submit' , 'Save' , 'submit' );
     out_html += '</div>';
     new Boxy(out_html, {title: "Dialog",modal:true});
}


//idea from https://gist.github.com/1301931
function humanize (str) {
    return str.toLowerCase().replace(/_/g, ' ')
      .replace(/(\w+)/g, function(match) {
        return match.charAt(0).toUpperCase() + match.slice(1);
      });
}