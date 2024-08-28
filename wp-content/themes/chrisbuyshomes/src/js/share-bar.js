document.addEventListener("DOMContentLoaded", function () {
  var url = encodeURIComponent(window.location.href);
  var title = encodeURIComponent(document.title);

  document.querySelectorAll(".share-bar").forEach(function (shareBar) {
    var facebookShare = shareBar.querySelector(".facebook-share");
    var twitterShare = shareBar.querySelector(".twitter-share");
    var linkedinShare = shareBar.querySelector(".linkedin-share");

    facebookShare.setAttribute(
      "href",
      "https://www.facebook.com/sharer/sharer.php?u=" + url
    );
    twitterShare.setAttribute(
      "href",
      "https://twitter.com/intent/tweet?url=" + url + "&text=" + title
    );
    linkedinShare.setAttribute(
      "href",
      "https://www.linkedin.com/sharing/share-offsite/?url=" + url
    );
  });
});
