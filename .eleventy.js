const eleventyNavigationPlugin = require("@11ty/eleventy-navigation");
const Image = require("@11ty/eleventy-img");

async function imageShortcode(src, alt, sizes) {
  let metadata = await Image(src, {
    widths: [300, 600],
    formats: ["avif", "jpeg"],
    urlPath: "/assets/images/",
    outputDir: "./_site/assets/images/"  
  });

  let imageAttributes = {
    alt,
    sizes,
    loading: "lazy",
    decoding: "async"
  };

  // You bet we throw an error on missing alt in `imageAttributes` (alt="" works okay)
  return Image.generateHTML(metadata, imageAttributes);
}

module.exports = function (eleventyConfig) {

	eleventyConfig.addPlugin(eleventyNavigationPlugin);
	// Get post comments by ID.
	eleventyConfig.addFilter('thisPostComments', (array, ID) => {
		return array.filter(item => {
			return item.post === ID;
		});
	});
	eleventyConfig.addNunjucksAsyncShortcode("image", imageShortcode);

  eleventyConfig.addPassthroughCopy("src/assets");

	return {
		dir: {
			input: "src"
		}
	}

}