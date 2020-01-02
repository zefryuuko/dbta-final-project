const uuidv1 = require("uuid/v1");

class Auth {
  constructor(db, mdb) {
    this.db = db;
    this.mdb = mdb;
  }

  // CREATE
  createAuth(id, pass, callback) {
    // Check if id already exists in the database
    this.mdb.collection("staff").findOne({ id: id }, (err, result) => {
      if (result != null) {
        callback({
          status: "failed",
          message: "ID already exists in the database."
        });
        return;
      }

      // Create entry
      this.mdb
        .collection("staff")
        .insertOne({ id: id, password: pass, session: "" }, (err, result) => {
          if (result == null) {
            callback({
              status: "failed",
              message: "ID and or password does not match."
            });
            return;
          } else {
            callback({ status: "success" });
          }
        });
    });
  }

  // READ
  login(id, pass, level, callback) {
    // Validate id parameter
    if (isNaN(parseInt(id))) {
      callback({
        status: "failed",
        message: "ID must be numerical"
      });
      return;
    }

    this.mdb
      .collection("staff")
      .findOne(
        { id: parseInt(id), password: pass },
        { projection: { _id: 0 } },
        (err, result) => {
          // If username/password combination does not match
          if (result == null) {
            callback({
              status: "failed",
              message: "ID and or password does not match."
            });
            return;
          }

          // Access control for staff and admin
          this.db.query(
            "SELECT staff_level FROM Staff WHERE staff_id = ?",
            [result.id],
            (err, result, fields) => {
              // Checks for authority based on level
              if (parseInt(level) >= result[0].staff_level) {
                var sessionID = uuidv1();
                this.mdb
                  .collection("staff")
                  .updateOne(
                    { id: parseInt(id) },
                    { $set: { session: sessionID } }
                  );
                callback({
                  status: "success",
                  session: sessionID
                });
              } else {
                callback({
                  status: "failed",
                  message: "You are not authorized to access this page."
                });
              }
            }
          );
        }
      );
  }

  authCheck(id, session, level, callback) {
    // Validate id parameter
    if (isNaN(parseInt(id))) {
      callback({
        status: "failed",
        message: "ID must be numerical"
      });
      return;
    }

    this.mdb
      .collection("staff")
      .findOne(
        { id: parseInt(id), session: session },
        { projection: { _id: 0 } },
        (err, result) => {
          // If username/password combination does not match
          if (result == null) {
            callback({
              status: "failed",
              message: "Session expired. Please try again."
            });
            return;
          }
          // Access control for staff and admin
          this.db.query(
            "SELECT staff_level FROM Staff WHERE staff_id = ?",
            [result.id],
            (err, result, fields) => {
              // Checks for authority based on level
              if (parseInt(level) >= result[0].staff_level) {
                // var sessionID = uuidv1();
                // this.mdb
                //   .collection("staff")
                //   .updateOne(
                //     { id: parseInt(id) },
                //     { $set: { session: sessionID } }
                //   );
                callback({
                  status: "success"
                  // session: sessionID
                });
              } else {
                callback({
                  status: "failed",
                  message: "You are not authorized to access this page."
                });
              }
            }
          );
        }
      );
  }

  // UPDATE
  updateAuth(id, password, callback) {
    this.mdb
      .collection("staff")
      .updateOne(
        { id: id },
        { $set: { password: password } },
        (err, result) => {
          if (result == null) {
            callback({
              status: "failed",
              message: "ID not found."
            });
            return;
          }
          callback({ status: "success" });
        }
      );
  }

  // DELETE
  removeAuth(id, callback) {
    this.mdb.collection("staff").deleteOne({ id: id }, (err, result) => {
      if (result == null) {
        callback({
          status: "failed",
          message: "ID not found."
        });
        return;
      }
      callback({ status: "success" });
    });
  }
}

module.exports = Auth;
