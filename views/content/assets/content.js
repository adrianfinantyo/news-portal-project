const getId = (url) => {
  var regExp =
    /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
  var match = url.match(regExp);

  if (match && match[2].length == 11) {
    return match[2];
  } else {
    return "error";
  }
};

$(document).ready(() => {
  document.querySelectorAll("oembed[url]").forEach((element) => {
    const figure = element.parentNode;
    let videoId = getId(element.attributes.url.value);
    let iframeMarkup =
      '<iframe src="//www.youtube.com/embed/' +
      videoId +
      '" frameborder="0" allowfullscreen></iframe>';
    figure.innerHTML = iframeMarkup;
  });
});
