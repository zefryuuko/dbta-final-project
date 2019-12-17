var fs = require("fs");
var express = require("express");
var basicAuth = require("express-basic-auth");
var mysql = require("mysql");
var authInfo = JSON.parse(fs.readFileSync("auth.json"));

var app = express();
var db = mysql.createPool({
  connectionLimit: 1,
  host: authInfo["host"],
  user: authInfo["user"],
  password: authInfo["password"],
  database: authInfo["database"]
});

app.use(
  basicAuth({
    users: { username: "password" }
  })
);

app.use(express.static("public"));

app.get("/", (req, res) => {
  res.send("Hello World!");
});

app.get("/staff", (req, res) => {
  request = {
    id: req.query.id == undefined ? "%" : req.query.id,
    name: req.query.name == undefined ? "%" : req.query.name
  };

  db.query(
    `SELECT * FROM Staff WHERE staff_name LIKE '${request["name"]}' AND staff_id LIKE '${request["id"]}'`,
    (err, result, fields) => {
      res.send(result);
    }
  );
});

app.get("/bills", (req, res) => {
  db.query("SELECT * FROM Bill", (err, result, fields) => {
    res.send(result);
  });
});

var server = app.listen(8081, () => {
  var host = server.address().address;
  var port = server.address().port;
  console.log("Server running at http://%s:%s", host, port);
});
