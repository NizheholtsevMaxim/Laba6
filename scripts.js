$(document).ready(function () {
  
  if ($('.login-wrapper__each-2').length > 0) {
    var $results_name = $('#results-name').text();
    var $results = $('.login-wrapper__each-2').html();
    localStorage.setItem($results_name, $results);
  }

  $('form *').change(function () {

    var $name = $('select[name="name"]').val();
    var $start_date = $('#start_date').val();
    var $end_date = $('#end_date').val();
    var $author = $('select[name="author"]').val();

    if (localStorage.getItem($name + ',' + $author + ',' + $start_date + ',' + $end_date) !== null) {
      $('#previous-results').html(localStorage.getItem($name + ',' + $author + ',' + $start_date + ',' + $end_date));
    } else {
      $('#previous-results').html('<h4>Отсутствуют предсохраненные данные для этого поиска... Нажмите конпку "Отправить"</h4>');
    }
  });
  
});

