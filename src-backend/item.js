class Item {
  constructor(db) {
    this.db = db;
  }

  // CREATE
  addItem(name, size, price, callback) {
    this.db.query(
      "INSERT INTO Items (item_name, item_size, item_price) VALUES (?, ?, ?)",
      [name, size, price],
      (err, result, fields) => {
        if (result.affectedRows > 0) {
          callback({ status: "success" });
        } else {
          callback({ status: "failed", message: result.message });
        }
      }
    );
  }

  // READ
  getItems(count = 5, page = 1, callback) {
    var start = count * (page - 1);
    this.db.query(
      `SELECT * FROM Items ORDER BY item_name ASC, item_size ASC LIMIT ${start}, ${count}`,
      [start, count],
      (err, result, fields) => {
        callback(result);
      }
    );
  }

  getItemByID(id, callback) {
    this.db.query(
      "SELECT * FROM Items WHERE item_id = ?",
      [id],
      (err, result, fields) => {
        callback(result);
      }
    );
  }

  getItemByName(name, count = 5, page = 1, callback) {
    var start = count * (page - 1);
    this.db.query(
      `SELECT * FROM Items WHERE item_name LIKE ?`,
      ["%" + name + "%"],
      (err, result, fields) => {
        callback(result);
      }
    );
  }

  // UPDATE
  updateItem(id, name, size, price, callback) {
    this.db.query(
      "UPDATE Items SET item_name = ?, item_size = ?, item_price = ? WHERE item_id = ?",
      [name, size, price, id],
      (err, result, fields) => {
        if (result.affectedRows > 0) {
          callback({ status: "success" });
        } else {
          callback({ status: "failed", message: result.message });
        }
      }
    );
  }

  // DELETE
  removeItem(id, callback) {
    this.db.query(
      "DELETE FROM Items WHERE item_id = ?",
      [id],
      (err, result, fields) => {
        if (result.affectedRows > 0) {
          callback({ status: "success" });
        } else {
          callback({ status: "failed", message: result.message });
        }
      }
    );
  }
}

module.exports = Item;
