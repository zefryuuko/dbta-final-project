class Bill {
  constructor(db) {
    this.db = db;
  }

  // CREATE

  insertDetails(billId, itemId, discountId) {
    // Get item price
    this.db.query(
      "SELECT item_price FROM Items WHERE item_id = ?",
      [itemId],
      (err, result, fields) => {
        var itemPrice = result[0].item_price;
        // Get discount percentage
        this.db.query(
          "SELECT discount_percentage FROM Discount WHERE discount_id = ?",
          [discountId],
          (err, result, fields) => {
            var discountPercentage = result.length > 0 ? result[0].discount_percentage : null ;
            // Insert transaction details
            this.db.query("INSERT INTO TransactionDetails (bill_id, item_id, item_price, discount_id, discount_percentage) VALUES (?, ?, ?, ?, ?)",
              [billId, itemId, (parseInt(itemPrice) - parseInt(itemPrice) * parseInt(discountPercentage) / 100) >= 0 ? parseInt(itemPrice) - parseInt(itemPrice) * parseInt(discountPercentage) / 100 : itemPrice, discountId == "" ? null : discountId, discountPercentage],
              (err, result, fields) => {

              }
            );
          }
        );
      }
    );
  }
  
  addBill(requestBody, callback) {
    // Add Bill
    this.db.query(
      "INSERT INTO Bill (branch_id, cashier_id, check_number, dine_type, amount_paid, amount_change, date_time) VALUES (?, ?, ?, ?, ?, ?, NOW())",
      [requestBody.branchId, requestBody.staffId, requestBody.checkNumber, requestBody.dineType, requestBody.amountPaid, parseInt(requestBody.amountPaid) - parseInt(requestBody.amountTotal)],
      (err, result, fields) => {
        // Insert payment details
        var billId = result.insertId;
        this.db.query(
          "INSERT INTO PaymentDetails (bill_id, method_id, card_no) VALUES (?, ?, ?)",
          [billId, requestBody.paymentMethod, requestBody.cardNo],
          (err, result, fields) => {
            // Insert transaction details
            for (var i = 0; i < requestBody.items.length; i++) {
              this.insertDetails(billId, requestBody.items[i], requestBody.discounts[i])
            }
          }
        )
      }
    )

    // Subtract card balance
    if (requestBody.paymentMethod == "4") {
      this.db.query(
        "SELECT card_balance FROM StarbucksCard WHERE card_number = ?",
        [requestBody.cardNo],
        (err, result, fields) => {
          var cardBalance = result[0].card_balance
          var test = this.db.query(
            "UPDATE StarbucksCard SET card_balance = ? WHERE card_number = ?",
            [parseInt(cardBalance) - parseInt(requestBody.amountTotal), requestBody.cardNo],
            (err, result, fields) => {
              
            }
          )
        }
      )
    }
    console.log(requestBody);
    callback(requestBody);
  }

  // READ
  getBills(count = 5, page = 1, callback) {
    var start = count * (page - 1);
    this.db.query(
      `SELECT b.bill_id, r.branch_name, c.staff_name, b.check_number FROM Bill b LEFT JOIN Staff c ON c.staff_id = b.cashier_id LEFT JOIN Branch r ON r.branch_id = b.branch_id LIMIT ${start}, ${count}`,
      (err, result, fields) => {
        callback(result);
      }
    );
  }

  getBillByID(id, callback) {
    this.db.query(
      "SELECT b.bill_id, r.branch_name, c.staff_name, b.check_number, b.dine_type, b.amount_paid, b.amount_change, b.date_time, i.item_name, i.item_size, t.item_price, d.discount_name, t.discount_percentage, m.method_name, p.card_no, s.cardholder_name FROM Bill b LEFT JOIN Branch r ON r.branch_id = b.branch_id LEFT JOIN Staff c ON c.staff_id = b.cashier_id LEFT JOIN TransactionDetails t ON t.bill_id = b.bill_id LEFT JOIN Items i ON i.item_id = t.item_id LEFT JOIN Discount d ON d.discount_id = t.discount_id LEFT JOIN PaymentDetails p ON p.bill_id = b.bill_id LEFT JOIN PaymentMethod m ON p.method_id = m.method_id LEFT JOIN StarbucksCard s ON s.card_number = p.card_no WHERE b.bill_id = ?",
      [id],
      (err, result, fields) => {
        // Format query results to make it readable
        var formattedResult = {
          bill_id: result[0].bill_id,
          branch_name:
            result[0].branch_name != undefined
              ? result[0].branch_name
              : "Closed branch",
          staff_name:
            result[0].staff_name != undefined
              ? result[0].staff_name
              : "Removed staff",
          check_number: result[0].check_number,
          dine_type: result[0].dine_type == 0 ? "Dine in" : "Take away",
          amount_total: 0,
          amount_paid: result[0].amount_paid,
          amount_change: result[0].amount_change,
          date_time: result[0].date_time,
          payment_method: result[0].method_name,
          card_no: result[0].card_no != undefined ? result[0].card_no : "",
          cardholder_name:
            result[0].cardholder_name != undefined
              ? result[0].cardholder_name
              : "",
          items: []
        };
        // Populate items array
        result.forEach(element => {
          formattedResult.amount_total += element.item_price;
          formattedResult.items.push({
            item_name:
              element.item_name != undefined
                ? element.item_name
                : "Removed item",
            item_size:
              element.item_size != undefined
                ? element.item_size
                : "Removed item",
            item_price: element.item_price,
            discount:
              element.discount_percentage != undefined
                ? {
                    discount_name:
                      element.discount_name != undefined
                        ? element.discount_name
                        : "Removed discount",
                    discount_percentage: element.discount_percentage
                  }
                : {}
          });
        });
        callback(formattedResult);
      }
    );
  }

  getBillByStaffID(id, count = 5, page = 1, callback) {
    var start = count * (page - 1);
    this.db.query(
      `SELECT b.bill_id, r.branch_name, c.staff_name, b.check_number FROM Bill b LEFT JOIN Staff c ON c.staff_id = b.cashier_id LEFT JOIN Branch r ON r.branch_id = b.branch_id WHERE b.cashier_id = ? LIMIT ${start}, ${count}`,
      [id],
      (err, result, fields) => {
        if (result != undefined) callback(result);
        else callback([]);
      }
    );
  }

  // UPDATE

  // DELETE
  deleteBillById(id) {
    this.db.query(
      'DELETE FROM Bill WHERE bill_id = ?',
      [id],
      (err, result, fiends) => {
        if (result.affectedRows() > 0) {
          callback({status: "success"})
        }
        callback({status: "failed", message: "Invalid card number"})
      })
  }
}

module.exports = Bill;
