require('./bootstrap');

axios({
  method: 'post',
  url: '/tree',
}).then(function (response) {
    console.log(response.data);
    $('#tree').tree({
        data: response.data,
        autoOpen: true,
        dragAndDrop: false
    });
  })
  .catch(function (error) {
    console.log(error);
  });
