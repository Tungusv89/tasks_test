// Функция для отправки ajax запроса
function sendAjaxRequest(data) {
  fetch('/wp-admin/admin-ajax.php', {
    method: 'POST',
    body: data,
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (result) {
      console.log(result.status);
    })
    .catch(function (error) {
      console.error(error);
    });
}

const currentDate = new Date();

const templates = settings.templates;
const lastTemplate = templates[templates.length - 1];

const formData = new FormData();
formData.append('action', 'test_jobcart');
formData.append('template', lastTemplate);
formData.append('timestamp', currentDate.getTime());

sendAjaxRequest(formData);
