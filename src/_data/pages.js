// const fetch = require("node-fetch");


// Fetch 50 pages from category 12
// If we want more, we can loop through requests, up to 100 at a time, and append them to an array
// https://developer.wordpress.org/rest-api/using-the-rest-api/pagination/

// module.exports = async () => {
//     const res = await fetch("http://www.handwerksvideos.de/wp-json/wp/v2/pages?page=1&per_page=50&categories=15&orderby=date&_embed")
//     return await res.json()
// }


const Cache = require("@11ty/eleventy-cache-assets");

module.exports = async function() {
  // https://developer.github.com/v3/repos/#get
  let json = await Cache("http://www.handwerksvideos.de/wp-json/wp/v2/pages?page=1&per_page=50&categories=15&orderby=date&_embed", {
    duration: "1d", // 1 day
    type: "json" // also supports "text" or "buffer"
  });

  return {
    pages: json
  };
};