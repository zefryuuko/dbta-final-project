const fs = require("fs");
const express = require("express");
const basicAuth = require("express-basic-auth");
const mysql = require("mysql");
const authInfo = JSON.parse(fs.readFileSync("auth.json"));

const Staff = require("./staff.js");

var app = express();
// app.use(
//   basicAuth({
//     users: { username: "password" }
//   })
// );
app.use(express.static("public"));

var db = mysql.createPool({
  connectionLimit: 1,
  host: authInfo["host"],
  user: authInfo["user"],
  password: authInfo["password"],
  database: authInfo["database"]
});

var staff = new Staff(db);

app.get("/", (req, res) => {
  res.send("Hello World!");
});

// Staff Routes
app.get("/staff", (req, res) => {
  if (req.query.id != undefined) {
    staff.getStaffByID(req.query.id, result => {
      res.send(result);
    });
  } else if (req.query.name != undefined) {
    staff.getStaffByName(
      req.query.name,
      req.query.count,
      req.query.page,
      result => {
        res.send(result);
      }
    );
  } else {
    staff.getStaffs(req.query.count, req.query.page, result => {
      res.send(result);
    });
  }
});

app.post("/staff", (req, res) => {
  //
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
