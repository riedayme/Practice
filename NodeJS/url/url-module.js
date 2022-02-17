const url = require('url');
const dummy = "https://w3schoo.com?param1=ok&param2=yes&param3=howhow";
const q = url.parse(dummy, true);

console.info(q.host);
console.info(q.pathname);
console.info(q.search);

const query = q.query;
console.info(query.param1);