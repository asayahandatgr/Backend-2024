const mysql = require("mysql");

require("dotenv").config();

const { localhost, DB_USERNAME, DB_PASSWORD, DB_DATABASE } = process.env;

const db = mysql.createConnection({
  host: localhost,
  user: DB_USERNAME,
  password: DB_PASSWORD,
  database: DB_DATABASE,
});

db.connect((err) => {
  if (err) {
    console.log("Error connecting " + err.stack);
    return;
  } else {
    console.log("Connected to database");
    return;
  }
});

module.exports = db;
