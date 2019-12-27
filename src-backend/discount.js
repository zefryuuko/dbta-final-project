class Discount {
  constructor(db) {
    this.db = db;
  }

  // CREATE
  addDiscount(name, percentage, callback) {
    this.db.query(
      "INSERT INTO Discount (discount_name, discount_percentage, item_price) VALUES (?, ?)",
      [name, percentage],
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
  getDiscounts(count = 5, page = 1, callback) {
    var start = count * (page - 1);
    this.db.query(
      "SELECT * FROM Discount LIMIT ?, ?",
      [start, count],
      (err, result, fields) => {
        callback(result);
      }
    );
  }

  getDiscountByID(id, callback) {
    this.db.query(
      "SELECT * FROM Discount WHERE discount_id = ?",
      [id],
      (err, result, fields) => {
        callback(result);
      }
    );
  }

  getDiscountByName(name, count = 5, page = 1, callback) {
    var start = count * (page - 1);
    this.db.query(
      "SELECT * FROM Discount WHERE item_name LIKE ? LIMIT ?, ?",
      ["%" + name + "%", start, count],
      (err, result, fields) => {
        callback(result);
      }
    );
  }

  // UPDATE
  updateDiscount(id, name, percentage, callback) {
    this.db.query(
      "UPDATE Discount SET discount_name = ?, discount_percentage = ? WHERE item_id = ?",
      [name, percentage, id],
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
  removeDiscount(id, callback) {
    this.db.query(
      "DELETE FROM Discount WHERE discount_id = ?",
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

module.exports = Discount;
