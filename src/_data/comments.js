const Cache = require("@11ty/eleventy-cache-assets");

module.exports = async function() {
  // https://developer.github.com/v3/repos/#get
  let json = await Cache("http://www.handwerksvideos.de/wp-json/wp/v2/comments?page=1&per_page=500", {
    duration: "1d", // 1 day
    type: "json" // also supports "text" or "buffer"
  });

  return {
    comments: json
  };
};