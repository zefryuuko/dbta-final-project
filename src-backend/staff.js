class Staff {
  constructor(db) {
    this.db = db;
  }

  // CREATE
  addStaff(name, level, callback) {
    this.db.query(
      "INSERT INTO Staff (staff_name, staff_level) VALUES (?, ?)",
      [name, level],
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
  getStaffs(count = 5, page = 1, callback) {
    var start = count * (page - 1);
    this.db.query(
      `SELECT * FROM Staff WHERE staff_id LIMIT ${start}, ${count}`,
      (err, result, fields) => {
        callback(result);
      }
    );
  }

  getStaffByID(id, callback) {
    this.db.query(
      "SELECT * FROM Staff WHERE staff_id LIKE ?",
      [id],
      (err, result, fields) => {
        callback(result);
      }
    );
  }

  getStaffByName(name, count = 5, page = 1, callback) {
    var start = count * (page - 1);
    this.db.query(
      `SELECT * FROM Staff WHERE staff_name LIKE ? LIMIT ${start}, ${count}`,
      ["%" + name + "%"],
      (err, result, fields) => {
        callback(result);
      }
    );
  }

  // UPDATE
  updateStaff(id, name, level, callback) {
    this.db.query(
      "UPDATE Staff SET staff_name = ?, staff_level = ? WHERE staff_id = ?",
      [name, level, id],
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
  removeStaff(id, callback) {
    this.db.query(
      "DELETE FROM Staff WHERE staff_id = ?",
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

module.exports = Staff;
