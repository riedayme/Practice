const fil = require('fs');

fil.rename('file-rename.html', 'file-rename2.html', function(err){
	if(err) throw err;
	console.info('renamed');
});

// first must have file-rename.html