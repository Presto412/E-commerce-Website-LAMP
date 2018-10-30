var express = require("express");
var router = express.Router();
const path = require("path");
const Jimp = require("jimp");
const fs = require("fs");

/* GET home page. */
router.get("/", function(req, res, next) {
  res.render("index", { title: "Express" });
});

router.get("/image/test/:imagefile", (req, res, next) => {
  Jimp.read(
    path.join(__dirname, "..", "images", req.params.imagefile),
    (err, lenna) => {
      if (err) res.json({ success: false, err: err });
      lenna
        .resize(parseInt(req.query.height), parseInt(req.query.width)) // resize
        .write("output.jpg"); // save
      res.download(path.join(__dirname, "..", "output.jpg"));
    }
  );
});

module.exports = router;
