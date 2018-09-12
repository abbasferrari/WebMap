var express = require('express');
var bodyParser = require('body-parser');
var app = express();
var router = express.Router();

var fs = require('fs');

app.use(bodyParser.json());

app.use(function(req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    next();
});

var path = require("path");

var port = process.env.PORT || 8080;

app.use(express.static(path.join(__dirname,"/")));

app.all('/',function(req,res){
    console.log(__dirname);
    res.sendFile("//check.html");
});

app.post('/updateMap', function(req, res) {
    var jsonData = req.body.NewJSON;
    fs.writeFile('neighborhood.geojson', jsonData, function (err) {
      if (err) throw err;
      console.log('Saved!');
    });
});

app.listen(port, function() {
    console.log('Our app is running on ' + port);
});
