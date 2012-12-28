M.block_oerfinder = {};
 
M.block_oerfinder.init = function(Y) {
 
    // example to submit a form field on change
    Y.on('change', function(e) {
        Y.one('#mform1').submit();
    }, '#id_fieldname' );
};