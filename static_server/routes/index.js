var express = require("express");
var router = express.Router();

/* GET home page. */
router.get("/", function(req, res, next) {
  res.render("index", { title: "Express" });
});

router.get("/image/:filename", (req, res, next) => {
  res.sendFile("../images/" + req.params.filename);
});
module.exports = router;
