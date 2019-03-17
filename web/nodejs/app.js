

var http = require('http');
// var server = require('./server');
var fs = require('fs');
var express = require('express');
var router = express.Router();


router.get('/', function(req, res, next) {
	res.render('index', {
		title: 'The News'
	});
});

module.exports = router;
// http.createServer(server.request).listen(8000);
