
module.exports.request = function onRequest(req, res) {
	const NewsAPI = require('newsapi');
	const newsapi = new NewsAPI('ae14a9ea6acf4d7d94b1e221351c1757');
	res.writeHead(200, {'Content-Type': 'text/html'});
	// response.write('hi kevin');
	newsapi.v2.topHeadlines({
		sources: 'bbc-news,the-verge',
		// q: 'bitcoin',
		// category: 'business',
		language: 'en',
		// country: 'us'
	  }).then(response => {
		  res.write(processHeadlines(response));
	  }).then(response => {
		  res.end();
	  });
}

function processHeadlines(data){
	return JSON.stringify(data.totalResults);
}