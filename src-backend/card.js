class Card {
  constructor(db) {
    this.db = db;
  }

  // CREATE
  addCard(cardNo, name, balance, callback) {
    this.db.query(
      "INSERT INTO StarbucksCard (card_number, cardholder_name, card_balance) VALUES (?, ?, ?)",
      [cardNo, name, balance],
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
  getCards(count = 5, page = 1, callback) {
    var start = count * (page - 1);
    this.db.query(
      `SELECT * FROM StarbucksCard LIMIT ${start}, ${count}`,
      (err, result, fields) => {
        callback(result);
      }
    );
  }

  getCardByNo(cardNo, callback) {
    this.db.query(
      "SELECT * FROM StarbucksCard WHERE card_number = ?",
      [cardNo],
      (err, result, fields) => {
        callback(result);
      }
    );
  }

  getCardByCardholderName(name, count = 5, page = 1, callback) {
    var start = count * (page - 1);
    this.db.query(
      "SELECT * FROM StarbucksCard WHERE cardholder_name LIKE ? LIMIT ?, ?",
      ["%" + name + "%", start, count],
      (err, result, fields) => {
        callback(result);
      }
    );
  }

  // UPDATE
  updateCard(cardNo, name, balance, callback) {
    this.db.query(
      "UPDATE StarbucksCard SET cardholder_name = ?, card_balance = ? WHERE card_number = ?",
      [name, balance, cardNo],
      (err, result, fields) => {
        if (result.affectedRows > 0) {
          callback({ status: "success" });
        } else {
          callback({ status: "failed", message: result.message });
        }
      }
    );
  }

  topUpBalance(cardNo, topUpValue, callback) {
    this.db.query(
      "SELECT card_balance FROM StarbucksCard WHERE card_number = ?",
      [cardNo],
      (err, result, fields) => {
        var balance = result + topUpValue;
        this.db.query(
          "UPDATE StarbucksCard SET card_balance = ? WHERE card_number = ?",
          [balance, cardNo],
          (err, result, fields) => {
            if (result.affectedRows > 0) {
              callback({ status: "success" });
            } else {
              callback({ status: "failed", message: result.message });
            }
          }
        );
      }
    );
  }

  // DELETE
  removeCard(cardNo, callback) {
    this.db.query(
      "DELETE FROM StarbucksCard WHERE card_number = ?",
      [cardNo],
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

module.exports = Card;
