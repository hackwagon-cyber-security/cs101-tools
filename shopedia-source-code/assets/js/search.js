searchProducts()

function searchProducts(id) {


  // $.ajax({
  //   method: "GET",
  //   url: `/search.php?collection=products&q=b`
  // }).fail(data => {
  //   console.log(data);
  // })
  // .done(function(data, err) {
  //   let json = JSON.parse(data);
  //   console.log(json)
  //   console.log(err)
  // })
  // $(id)
  //   .search({
  //     source: content
  //   });
}

$(function () {
  $('.search-bar')
    .search({
      apiSettings: {
        url: '/search.php?collection=products&q={query}',
        onResponse: function (data) {
          let response = {
            results: {}
          };

          Object.keys(data).forEach((key, index) => {
            let item = data[key];
            let { id, productCategory = "Unkwnown", productName, productDesc, imgPath, cost = 0 } = item;
            // let language = item.language || 'Unknown', maxResults = 8;
            // if (index >= maxResults) {
            //   return false;
            // }
            // create new language category
            if (response.results[productCategory] === undefined) {
              response.results[productCategory] = {
                name: productCategory,
                results: []
              };
            }
            // add result to category
            response.results[productCategory].results.push({
              id: id,
              title: productName,
              // description: productDesc,
              image: imgPath,
              price: `$${Number.parseFloat(cost).toFixed(2)}`
            });
          })


          return response;
        }
      },
      fields: {
        categories: 'results',     // array of categories (category view)
        categoryName: 'name',        // name of category (category view)
        categoryResults: 'results',     // array of results (category view)
        // description     : 'description', // result description
        image: 'image',       // result image
        price: 'price',       // result price
        results: 'results',     // array of results (standard)
        title: 'title',       // result title
        action: 'action',      // "view more" object name
        actionText: 'text',        // "view more" text
        // actionURL       : 'url'          // "view more" url
      },
      minCharacters: 2,
      maxResults: null,
      type: 'category'
    });


  // $('#search-bar').keypress(e => {
  //   if (e.charCode == 13) {
  //     let val = $('#search-bar-input').val();
  //     if (val && val.length > 0) {
  //       window.location = `/search.php?collection=products&q=${val}`;
  //     }
  //   }
  // })

  $("#search-bar-input-1").keyup(function (event) {
    if (event.which == 13 || event.keyCode == 13) {
      let searchText = $("#search-bar-input-1").val();
      window.location = `/products_search.php?q=${searchText}`;
    }
  });

  $("#search-bar-input-2").keyup(function (event) {
    if (event.which == 13 || event.keyCode == 13) {
      let searchText = $("#search-bar-input-2").val();
      window.location = `/products_search.php?q=${searchText}`;
    }
  });
})
