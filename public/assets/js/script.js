$(document).ready(function () {
  updateRandomBlame();
});

$('.random-blame-refresh').on('click', function () {
  updateRandomBlame();
});

/**
 * Get random blame from internal API
 * and update it on homepage.
 */
function updateRandomBlame() {
  $('.random-blame-wrapper').attr('hidden', true);
  $('.random-blame-spinner').attr('hidden', false);

  $.ajax({
    url: "/api/random-blame",
    context: document.body
  }).done(function (data) {
    $('.random-blame-text').html(data.blame);
    $('.random-blame-verdict').html(data.verdict);
    $('.random-blame-dosie-link').attr('href', data.dosieUrl);
    $('.random-blame-spinner').attr('hidden', true);
    $('.random-blame-wrapper').attr('hidden', false);
  });
}
