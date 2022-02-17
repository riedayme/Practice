const http = require('http');
const fs = require('fs');
const url = require('url');


http.createServer(function(req, res){
	const q = url.parse(req.url, true);
	const filename = `.${q.pathname}`;
	fs.readFile(filename, function(err, data){
		if (err) {
			res.writeHead(400, {'Content-Type':'text/html'});
			return res.end('404 nothing');
		}
		res.writeHead(200, {'Content-Type':'text.html'});
		res.write(data);
		return res.end();
	});
}).listen(8080);