const fil = require('fs');

fil.appendFile('file-appendFile.html', 'Content', function(err){
	if(err) throw err;
	console.info('created');
})