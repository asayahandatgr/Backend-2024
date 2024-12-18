const express = require("express");

// Membuat object express
const app = express();

app.get("/", (req, res) => {
    res.send("Uhuyy!");
});

app.listen(3000, () => {
    console.log("Server running at http://localhost:3000");
}
);