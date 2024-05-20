var express = require("express");
var bodyParser = require("body-parser");
var util = require("util");
var mysql = require("mysql");
var moment = require("moment-timezone"); // Import moment-timezone module

var app = express(); // Initialize Express app

// Konfigurasi koneksi MySQL
var connection = mysql.createConnection({
  host: "localhost", // Ganti dengan host MySQL Anda
  user: "root", // Ganti dengan username MySQL Anda
  password: "", // Ganti dengan password MySQL Anda
  database: "absensi", // Ganti dengan nama database Anda
});

// Membuat koneksi ke MySQL
connection.connect(function (err) {
  if (err) {
    console.error("Error connecting to database:", err);
    return;
  }
  console.log("Connected to MySQL database");
});

// Middleware untuk mem-pool koneksi MySQL di setiap request
app.use(function (req, res, next) {
  req.mysql = connection;
  next();
});

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));

app.post("/monitor", function (req, res, next) {
  const data = JSON.parse(
    req.body["m2m:sgn"]["m2m:nev"]["m2m:rep"]["m2m:cin"]["con"]
  );

  console.log(util.inspect(data, false, null));

  const name = data.NAME;
  console.log(name);

  const time = data.TIME;
  // Konversi waktu ke zona waktu UTC+7
  const timestamp = moment(time).tz("Asia/Jakarta");
  const isoTimestamp = timestamp.format();
  console.log(isoTimestamp);

  const cardId = data.CARD_ID;
  console.log(cardId);

  var query = `INSERT INTO data_absensi (name, time, card_id) VALUES ('${name}', '${isoTimestamp}', '${cardId}')`;
  connection.query(query, function (err, result) {
    if (err) {
      console.error("Error executing query:", err);
      res.status(500).send("Internal Server Error");
      return;
    }
    console.log("Inserted into monitor table:", result);
    res.send("ack");
  });
});

// Start the server
var server = app.listen(9000, function () {
  console.log("App listening on port 9000");
});
