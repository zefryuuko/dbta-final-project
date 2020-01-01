const fs = require("fs");
const express = require("express");
const bodyParser = require("body-parser");
const basicAuth = require("express-basic-auth");
const mysql = require("mysql");
const mongodb = require("mongodb");
const authInfo = JSON.parse(fs.readFileSync("auth.json"));

const MongoClient = mongodb.MongoClient;

const Auth = require("./auth");
const Staff = require("./staff");
const Item = require("./item");
const Discount = require("./discount");
const Branch = require("./branch");
const Card = require("./card");
const Bill = require("./bill");

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

var mdb;
var auth;
MongoClient.connect(
  `mongodb://${authInfo["user_mongo"]}:${authInfo["pass_mongo"]}@${authInfo["host"]}`,
  (err, client) => {
    if (err) console.log(err);
    mdb = client.db(authInfo["database_mongo"]);
    auth = new Auth(db, mdb);
  }
);

const staff = new Staff(db);
const item = new Item(db);
const discount = new Discount(db);
const branch = new Branch(db);
const card = new Card(db);
const bill = new Bill(db);

app.get("/", (req, res) => {
  res.send("Hello World!");
});

// Auth Routes
app.get("/auth", (req, res) => {
  auth.authCheck(req.query.id, req.query.session, req.query.level, result => {
    res.send(result);
  });
});

app.get("/auth/login", (req, res) => {
  auth.login(req.query.id, req.query.pass, req.query.level, result => {
    res.send(result);
  });
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

// Discount Routes
app.get("/discount", (req, res) => {
  if (req.query.id != undefined) {
    discount.getDiscountByID(req.query.id, result => {
      res.send(result);
    });
  } else if (req.query.name != undefined) {
    discount.getDiscountByName(
      req.query.name,
      req.query.count,
      req.query.page,
      result => {
        res.send(result);
      }
    );
  } else {
    discount.getDiscounts(req.query.count, req.query.page, result => {
      res.send(result);
    });
  }
});

app.post("/discount", (req, res) => {
  if (req.body.task == undefined)
    res.send({ status: "failed", message: "missing task parameter." });
  else if (req.body.name == undefined)
    res.send({ status: "failed", message: "missing name parameter." });
  else if (req.body.percentage == undefined)
    res.send({ status: "failed", message: "missing percentage parameter." });
  else if (req.body.task == "add") {
    discount.addDiscount(req.body.name, req.body.percentage, result => {
      res.send(result);
    });
  } else if (req.body.task == "update") {
    if (req.body.id == undefined)
      res.send({ status: "failed", message: "missing id parameter." });
    staff.updateStaff(
      req.body.id,
      req.body.name,
      req.body.percentage,
      result => {
        res.send(result);
      }
    );
  }
});

app.delete("/discount", (req, res) => {
  if (req.body.id == undefined)
    res.send({ status: "failed", message: "missing id parameter." });

  discount.removeDiscount(req.body.id, result => {
    res.send(result);
  });
});

// Branch Routes
app.get("/branch", (req, res) => {
  if (req.query.id != undefined) {
    branch.getBranchByID(req.query.id, result => {
      res.send(result);
    });
  } else if (req.query.name != undefined) {
    branch.getBranchByName(
      req.query.name,
      req.query.count,
      req.query.page,
      result => {
        res.send(result);
      }
    );
  } else {
    branch.getBranches(req.query.count, req.query.page, result => {
      res.send(result);
    });
  }
});

app.post("/branch", (req, res) => {
  if (req.body.task == undefined)
    res.send({ status: "failed", message: "missing task parameter." });
  else if (req.body.name == undefined)
    res.send({ status: "failed", message: "missing name parameter." });
  else if (req.body.phone == undefined)
    res.send({ status: "failed", message: "missing phone parameter." });
  else if (req.body.task == "add") {
    branch.addBranch(req.body.name, req.body.phone, result => {
      res.send(result);
    });
  } else if (req.body.task == "update") {
    if (req.body.id == undefined)
      res.send({ status: "failed", message: "missing id parameter." });
    branch.updateBranch(req.body.id, req.body.name, req.body.phone, result => {
      res.send(result);
    });
  }
});

app.delete("/branch", (req, res) => {
  if (req.body.id == undefined)
    res.send({ status: "failed", message: "missing id parameter." });

  branch.removeBranch(req.body.id, result => {
    res.send(result);
  });
});

// Card Routes
app.get("/card", (req, res) => {
  if (req.query.no != undefined) {
    card.getCardByNo(req.query.no, result => {
      res.send(result);
    });
  } else if (req.query.name != undefined) {
    card.getCardByCardholderName(
      req.query.name,
      req.query.count,
      req.query.page,
      result => {
        res.send(result);
      }
    );
  } else {
    card.getCards(req.query.count, req.query.page, result => {
      res.send(result);
    });
  }
});

app.post("/card", (req, res) => {
  if (req.body.task == undefined)
    res.send({ status: "failed", message: "missing task parameter." });
  else if (req.body.balance == undefined)
    res.send({ status: "failed", message: "missing balance parameter." });
  else if (req.body.task == "add") {
    card.addCard(req.body.no, req.body.name, req.body.balance, result => {
      res.send(result);
    });
  } else if (req.body.task == "update") {
    if (req.body.id == undefined)
      res.send({ status: "failed", message: "missing no parameter." });
    if (req.body.name == undefined)
      res.send({ status: "failed", message: "missing name parameter." });
    card.updateCard(req.body.no, req.body.name, req.body.balance, result => {
      res.send(result);
    });
  } else if (req.body.task == "topup") {
    if (req.body.id == undefined)
      res.send({ status: "failed", message: "missing id parameter." });
    card.topUpBalance(req.body.no, req.body.balance, result => {
      res.send(result);
    });
  }
});

app.delete("/card", (req, res) => {
  if (req.body.no == undefined)
    res.send({ status: "failed", message: "missing no parameter." });

  card.removeCard(req.body.no, result => {
    res.send(result);
  });
});

app.get("/bill", (req, res) => {
  if (req.query.id != undefined) {
    bill.getBillByID(req.query.id, result => {
      res.send(result);
    });
  } else {
    bill.getBills(req.query.count, req.query.page, result => {
      res.send(result);
    });
  }
});

app.post("/bill", (req, res) => {
  if (req.body.task == undefined)
    res.send({ status: "failed", message: "missing task parameter." });
  else if (req.body.data == undefined)
    res.send({ status: "failed", message: "missing data parameter." });
  else if (req.body.task == "add") {
    bill.addBill(req.body.data, result => {
      res.send(result);
    });
  }
});

var server = app.listen(8081, () => {
  var host = server.address().address;
  var port = server.address().port;
  console.log("Server running at http://%s:%s", host, port);
});
