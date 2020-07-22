const express = require('express');
const bodyParser = require('body-parser');
const dbConfig = require('./config/database.config.js');
const mongoose = require('mongoose');
const app = express();

app.use(bodyParser.urlencoded({extended : true}))

app.use(bodyParser.json())

require('./app/routes/student.routes.js')(app);

mongoose.Promise = global.Promise;

// Connecting to DB
mongoose.connect(dbConfig.url, {
    useNewUrlParser: true
}).then(() => {
    console.log("Successfully connected to database");
}).catch(err => {
    console.log("Could not connect to database. Exiting now...", err);
    process.exit();
})

app.listen('3000', function () {
    console.log("Listening on port 3000...");
})

app.get('/', function (req, res) {
    res.sendFile(__dirname + '/index.html')
})
// 
console.log("Mambo sawasawa");