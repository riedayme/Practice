const http = require('http');
const fil = require('fs');

http.createServer(function(req, res){
	fil.readFile('file-readFile.html', function(err, data){
		res.writeHead(200, {'Content-Type':'text/html'});
		res.write(data);
		res.end();
	})
}).listen(8080);