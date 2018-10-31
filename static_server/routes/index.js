var express = require("express");
var router = express.Router();
const path = require("path");
const Jimp = require("jimp");

/* GET home page. */
router.get("/", function(req, res, next) {
  res.render("index", { title: "Express" });
});

router.post("/image", (req, res, next) => {
  const level = parseInt(req.body.level);
  const fpath = path.join(__dirname, "..", "images", req.body.image_name);
  return Jimp.read(fpath, (err, image) => {
    if (err) res.json({ success: false, err: err });
    let scaleWidth = 0;
    if (level === 3) {
      scaleWidth = image.bitmap.width > 225 ? 225 : image.bitmap.width;
    } else if (level === 2) {
      scaleWidth = image.bitmap.width > 425 ? 425 : image.bitmap.width;
    } else if (level === 1) {
      scaleWidth = image.bitmap.width > 625 ? 625 : image.bitmap.width;
    }
    session_start();

    image = image.resize(scaleWidth, Jimp.AUTO);
    return image.getBase64(Jimp.AUTO, (err, bitmap) => {
      return res.json({
        data: bitmap
      });
    });
  });
});

module.exports = router;
