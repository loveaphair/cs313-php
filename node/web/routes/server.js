const NewsAPI = require('newsapi');
const newsapi = new NewsAPI('ae14a9ea6acf4d7d94b1e221351c1757');
newsapi.v2.topHeadlines({
		sources: 'bbc-news,the-verge',
		// q: 'bitcoin',
		// category: 'business',
		language: 'en',
		// country: 'us'
	  }).then(response => {
		module.exports.newsHeadlines = response;
	  });

module.exports = {
	selectSource: function (res, source){
		newsapi.v2.topHeadlines({
			sources: source,
			language: 'en',
		}).then(response => {
			res.send(response);
		});
	}
}


// function processHeadlines(data){
// 	return JSON.stringify(data.totalResults);
// }