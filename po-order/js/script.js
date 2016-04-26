var $savedPoTable = $('.saved-po-table');
var $newPoTable = $('.new-po-table');
var $updateModal = $('.update-po-modal');
var $success_msg = $('.success_msg');
var $error_msg = $('.error_msg');
function updateData(data){
  $.ajax({
    url: './save.php',
    type: 'POST',
    dataType: 'JSON',
    data: data,
    success: function(res){
      console.log('res', res);
      refreshSavedPoTable();
      $updateModal.modal('hide');
      if(res.success_inserted_items!=undefined) {
        document.getElementById("success_msg").style.display = "block";
        $('p',$success_msg).html("Successfully inserted " + res.success_inserted_items + " entries.");
        $('#success_msg').delay(5000).fadeOut();
        document.getElementById("error_msg").style.display = "block";
        $('p',$error_msg).html("Failed to insert " + res.fail_inserted_items + " entries.");
        $('#error_msg').delay(5000).fadeOut();
      }
      }
  });
}


function refreshSavedPoTable(params){
  if(!params) params = {id: 1};
  $.ajax({
    url: './save.php',
    data: params,
    type: 'GET',
    dataType: 'JSON',
    success: function(res){
    updateSavedPoTable(res.data);    
    }
  });
}
var datatable='';
refreshSavedPoTable();


function updateSavedPoTable(data){
  var $trs = [];
  if(datatable!='')datatable.destroy();
  if(!data) data = [];
  data.forEach(function(d){
    var $tr = $('<tr></tr>', {
      data: d
    });
    $('<td></td>', {
      text: d.sku
    }).appendTo($tr);
    $('<td></td>', {
      text: d.product_name
    }).appendTo($tr);
    $('<td></td>', {
      text: d.supplier_name
    }).appendTo($tr);
    $('<td></td>', {
      text: d.formated_price
    }).appendTo($tr);
    $('<td></td>', {
      text: d.preferred_supplier==1?"Yes":"No"
    }).appendTo($tr);
    $trs.push($tr);
    $('<td></td>', {
      html: '<div class="btn-group"><button class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></button>'+
        '<button class="btn btn-info btn-xs edit"><i class="fa fa-pencil"></i></button></div>'
    }).appendTo($tr);
  });
  $('tbody', $savedPoTable).html($trs);
  datatable=$('#saved-po-table').DataTable( {
  "order": [[ 1, "asc" ]],
  "iDisplayLength": 20,
	"dom": "<'row'<'col-sm-4'l><'col-sm-4'T><'col-sm-4'f>>R" +
		     "<'row'<'col-sm-12'tr>>" +
		     "<'row'<'col-sm-5'i><'col-sm-7'p>>",
	"tableTools": {
            "sSwfPath": "copy_csv_xls_pdf.swf",
            "aButtons":[ {
                        "sExtends":    "collection",
                        "sButtonText": "Save",
                        "aButtons":    [ "csv", "pdf" ]
                        }]
        }

} );
}

$savedPoTable.on('click', '.delete', function(e){
  e.preventDefault();
  var $tr = $(this).closest('tr');
  var $data = $tr.data();
  if(!confirm("Are you sure you want to delete \nproduct: \"" + $data.product_name + "\"\nfrom supplier: \"" + $data.supplier_name + "\"")) return;
  updateData({
    action: 'delete',
    id: $data.id
  });

});

$savedPoTable.on('click', '.edit', function(e){
  e.preventDefault();
  var $tr = $(this).closest('tr');
  var $data = $tr.data();
  var $checked='checked';
  if($data.preferred_supplier==0||$data.preferred_supplier==null){
    $checked='';
  }
  $('h4',$updateModal).html("Edit Purchase Price of '" + $data.product_name + "' from '" + $data.supplier_name +"'");
  var $formcontent="<input type='hidden' class='form-control' name='id' value='" + $data.id + "'>"+
    "<div class='form-group'>"+
    "<label for='new_purchase_price'>New Purchase Price</label>"+
    "<div class='input-group'><div class='input-group-addon'>Rp.</div><input type='text' class='form-control' name='price' id='new_purchase_price' value='" + $data.price + "'>"+
    "</div></div>"+
    "<label class='checkbox inline' for='preferred_supplier'>Preferred Supplier"+
    "<input type='checkbox' class='preferred_supplier' name='preferred_supplier' id='preferred_supplier' " + $checked + "></label><br><br>"+
    "<center><input type='submit' class='btn btn-primary btn-block save-po' value='Save' style='width: 150px;'></center>";
$('form',$updateModal).html($formcontent);
  $updateModal.modal('show');
});

var newPoAjax = null;
function searchProduct(params){
  if(!params) params = {id: 1};
  if(newPoAjax){
    newPoAjax.abort();
  }
  newPoAjax = $.ajax({
    url: './get-data.php',
    type: 'GET',
    dataType: 'JSON',
    data: params,
    success: function(res){
      updateNewPoTable(res);
      
    }
  });
}

function supplierSelectHTML(id){
  var result = '<select name="supplier['+id+']" class="form-control">';
  result += '<option value="">Select supplier</option>';
  suppliers.forEach(function(d){
    result += '<option value="'+d.supplier_id+'">'+d.supplier_name+'</option>';
  });
  result += '</select>';
  return result;
}

function updateNewPoTable(data){
  var $trs = [];
  if(!data) data = [];
  $.each(data, function(i, d){
    var $tr = $('<tr></tr>', {
      data: d
    });
    $('<td></td>', {
      html: '<div class="prod-snap clearfix">'+
        '<div class="prod-img">' +
          '<img src="http://fabelio.com/media/catalog/product'+d.image+'">' +
        '</div>' +
        '<div class="prod-content">' +
          '<h3>' + d.name + '</h3>' +
          '<div class="small">'+d.sku+'</div>' +
          '<div class="price text-danger">' +
            '<span class="old-price">Rp. '+(Math.round(d.price))+'</span>' +
            '<span class="sale-price"></span>' +
          '</div>' +
        '</div>' +
      '</div>'
    }).appendTo($tr);
    /*$('<td></td>', {
      html: supplierSelectHTML(i)
    }).appendTo($tr);*/
    $('<td></td>', {
      width: 1,
      html: '<div class="input-group input-group-sm" style="width:150px">'+
        '<span class="input-group-addon">Rp.</span>' +
        '<input type="text" value="" placeholder="Price" class="form-control" name="price['+i+']">' +
      '</div>'
    }).appendTo($tr);
    $trs.push($tr);
  });
  $('tbody', $newPoTable).html($trs);
}

var $searchWrap = $('.prod-search-wrap');
$('.product-search').on('keyup', function(e){
  var $this = $(this);
  searchProduct({
    product: $this.val(),
    prod_type: $('[name=prod_type]:checked', $searchWrap).val()
  });
});

$('[name=prod_type]', $searchWrap).on('change', function(e){
  searchProduct({
    product: $('.product-search', $searchWrap).val(),
    prod_type: $('[name=prod_type]:checked', $searchWrap).val()
  });
});

$('.new-po-form').on('submit', function(e){
  e.preventDefault();
  var data = $(this).serializeArray();
  updateData(data);
});

$('.edit_purchase_price').on('submit', function(e){
  e.preventDefault();
  var data = $(this).serializeArray();
  updateData(data);
});
