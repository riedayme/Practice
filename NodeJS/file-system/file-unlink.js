const fil = require('fs');

fil.unlink('file-unlink.html', function(err){
	if (err) throw err;
	console.info('success delete');
});

// must have file-unlink.html first
// or will be error result :D