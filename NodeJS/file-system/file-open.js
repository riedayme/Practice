const fil = require('fs');

fil.open('file-open.html', 'w', function(err, file){
	if(err) throw err;
	console.info('created');
})