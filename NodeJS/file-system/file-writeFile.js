const fil = require('fs');

fil.writeFile('file-writeFile.html', 'Content', function(err){
	if(err) throw err;
	console.info('created');
})