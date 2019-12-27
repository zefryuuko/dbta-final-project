class Branch {
  constructor(db) {
    this.db = db;
  }

  // CREATE
  addBranch(name, phone, callback) {
    this.db.query(
      "INSERT INTO Branch (branch_name, branch_phone) VALUES (?, ?)",
      [name, phone],
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
  getBranches(count = 5, page = 1, callback) {
    var start = count * (page - 1);
    this.db.query(
      "SELECT * FROM Branch LIMIT ?, ?",
      [start, count],
      (err, result, fields) => {
        callback(result);
      }
    );
  }

  getBranchByID(id, callback) {
    this.db.query(
      "SELECT * FROM Branch WHERE branch_id = ?",
      [id],
      (err, result, fields) => {
        callback(result);
      }
    );
  }

  getBranchByName(name, count = 5, page = 1, callback) {
    var start = count * (page - 1);
    this.db.query(
      "SELECT * FROM Branch WHERE branch_name LIKE ? LIMIT ?, ?",
      ["%" + name + "%", start, count],
      (err, result, fields) => {
        callback(result);
      }
    );
  }

  // UPDATE
  updateBranch(id, name, phone, callback) {
    this.db.query(
      "UPDATE Branch SET branch_name = ?, branch_phone = ? WHERE branch_id = ?",
      [name, phone, id],
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
  removeBranch(id, callback) {
    this.db.query(
      "DELETE FROM Branch WHERE branch_id = ?",
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

module.exports = Branch;
