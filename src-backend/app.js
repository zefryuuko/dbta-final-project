const fs = require("fs");
const express = require("express");
const bodyParser = require("body-parser");
const basicAuth = require("express-basic-auth");
const mysql = require("mysql");
const authInfo = JSON.parse(fs.readFileSync("auth.json"));

const Staff = require("./staff");
const Item = require("./item");
const Discount = require("./discount");

var app = express();
app.use(bodyParser.urlencoded({ extended: true }));
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

const staff = new Staff(db);
const item = new Item(db);

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
  if (req.body.task == undefined)
    res.send({ status: "failed", message: "missing task parameter." });
  else if (req.body.name == undefined)
    res.send({ status: "failed", message: "missing name parameter." });
  else if (req.body.level == undefined)
    res.send({ status: "failed", message: "missing level parameter." });
  else if (req.body.task == "add") {
    staff.addStaff(req.body.name, req.body.level, result => {
      res.send(result);
    });
  } else if (req.body.task == "update") {
    if (req.body.id == undefined)
      res.send({ status: "failed", message: "missing id parameter." });
    staff.updateStaff(req.body.id, req.body.name, req.body.level, result => {
      res.send(result);
    });
  }
});

app.delete("/staff", (req, res) => {
  if (req.body.id == undefined)
    res.send({ status: "failed", message: "missing id parameter." });

  staff.removeStaff(req.body.id, result => {
    res.send(result);
  });
});

// Item Routes
app.get("/item", (req, res) => {
  if (req.query.id != undefined) {
    item.getItemByID(req.query.id, result => {
      res.send(result);
    });
  } else if (req.query.name != undefined) {
    staff.getItemByName(
      req.query.name,
      req.query.count,
      req.query.page,
      result => {
        res.send(result);
      }
    );
  } else {
    item.getItems(req.query.count, req.query.page, result => {
      res.send(result);
    });
  }
});

app.post("/item", (req, res) => {
  if (req.body.task == undefined)
    res.send({ status: "failed", message: "missing task parameter." });
  else if (req.body.name == undefined)
    res.send({ status: "failed", message: "missing name parameter." });
  else if (req.body.size == undefined)
    res.send({ status: "failed", message: "missing size parameter." });
  else if (req.body.price == undefined)
    res.send({ status: "failed", message: "missing price parameter." });
  else if (req.body.task == "add") {
    item.addItem(req.body.name, req.body.size, req.body.price, result => {
      res.send(result);
    });
  } else if (req.body.task == "update") {
    if (req.body.id == undefined)
      res.send({ status: "failed", message: "missing id parameter." });
    item.updateItem(
      req.body.id,
      req.body.name,
      req.body.size,
      req.body.price,
      result => {
        res.send(result);
      }
    );
  }
});

app.delete("/item", (req, res) => {
  if (req.body.id == undefined)
    res.send({ status: "failed", message: "missing id parameter." });

  item.removeItem(req.body.id, result => {
    res.send(result);
  });
});

var server = app.listen(8081, () => {
  var host = server.address().address;
  var port = server.address().port;
  console.log("Server running at http://%s:%s", host, port);
});
