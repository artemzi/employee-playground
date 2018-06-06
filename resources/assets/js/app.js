require('./bootstrap');

axios({
  method: 'post',
  url: '/tree',
}).then(function (response) {
    // console.log(response.data);
    let $tree = $('#tree');
    $tree.tree({
        data: response.data,
        autoOpen: false,
        selectable: true,
        closedIcon: '+',
        openedIcon: '-',
        dragAndDrop: false,
        onCreateLi: function(node, $li) {
            // Append a link to the jqtree-element div.
            // The link has an url '#node-[id]' and a data property 'node-id'.
            $li.find('.jqtree-element').append(
                ' - ( <span class="node_title" data-node-id="'+
                node.id +'">' + node.title.name + '</span> )'
            );
        }
    });
  })
  .catch(function (error) {
    console.log(error);
  });
