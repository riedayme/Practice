const http = require('http');
const url = require('url');

http.createServer(function(req, res){
	res.writeHead(200, {'Content-Type':'text/html'});
	res.write(req.url); // get path url

	res.write('<br/>');

	// handle query
	const q = url.parse(req.url, true).query;
	res.write(`param1 = ${q.param1} param2 = ${q.param2}`);
	// now request url with param
	// http://localhost:8080/?param1=hehe&param2=hoho

	res.end();
}).listen(8080);