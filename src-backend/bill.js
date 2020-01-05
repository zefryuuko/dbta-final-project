class Bill {
  constructor(db) {
    this.db = db;
  }

  // CREATE
  addBill(requestBody) {
    /*
      {
          cashier_id: 1,
          items: [
              {
                item_id: 2
              },
              {
                  item_id: 3,
                  discount_id: 1
              }
          ],
          payment: 
          {
              method: 2,
              cardNo: 1234567890123456
          }
      }
    */
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
      "SELECT b.bill_id, r.branch_name, c.staff_name, b.check_number, b.dine_type, b.amount_paid, b.amount_change, i.item_name, i.item_size, t.item_price, d.discount_name, t.discount_percentage, m.method_name, p.card_no, s.cardholder_name FROM Bill b LEFT JOIN Branch r ON r.branch_id = b.branch_id LEFT JOIN Staff c ON c.staff_id = b.cashier_id LEFT JOIN TransactionDetails t ON t.bill_id = b.bill_id LEFT JOIN Items i ON i.item_id = t.item_id LEFT JOIN Discount d ON d.discount_id = t.discount_id LEFT JOIN PaymentDetails p ON p.bill_id = b.bill_id LEFT JOIN PaymentMethod m ON p.method_id = m.method_id LEFT JOIN StarbucksCard s ON s.card_number = p.card_no WHERE b.bill_id = ?",
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
}

module.exports = Bill;
