var $table = $('table.result');
var $tableBody = $('tbody', $table);

function Ord(dt){
  var ord = this;
  ord.data = dt;
  ord.save();
}

Ord.prototype.save = function(){
  var ord = this;
  ord.renderRow();
  $.ajax({
    url: 'save.php',
    data: ord.data,
    type: 'POST',
    dataType: 'JSON',
    success: function(data){
      ord.resultData = data;
      ord.renderRow();
    },
    error: function(){
      //ord.renderErrorRow();
    }
  });
};

Ord.prototype.addRow = function(){
  var ord = this;
};

Ord.prototype.renderRow = function(){
  var ord = this;
  if(!ord.$tr) {
    ord.$tr = $('<tr></tr>');
    ord.$tr.data('ord', ord);
    $tableBody.append(ord.$tr);
  }
  ord.$tr.removeClass('loading error saved');
  if(!ord.resultData){
    ord.$tr.addClass('loading');
    ord.$tr.append(
      '<td class="id">'+ ord.data.increment_id+'</td>'+
      '<td class="status">Processing.</td>'+
      '<td class="new-addr">'+
        (ord.data.city || '[No City]') + ', ' + (ord.data.region || '[No Region]') +
        '<div class="small">'+ord.data.street+'</div>'+
      '</td>'+
      '<td class="old-addr"></td>'+
      '<td> </td>'
    );
  }else{
    var $tdId = $('td.status', ord.$tr);
    if(ord.resultData.error){
      ord.$tr.addClass('danger');
      $tdId.text(ord.resultData.error);
    }
    if(ord.resultData.saved){
      ord.$tr.addClass('success');
      $tdId.text('Saved');
      if(ord.resultData.oldOrdData){
        $('td.old-addr', ord.$tr).html(
          (ord.resultData.oldOrdData.city || '[No City]') + ', ' + (ord.resultData.oldOrdData.region || '[No Region]') +
          '<div class="small">'+ord.resultData.oldOrdData.street+'</div>'
        );
      }
    }
  }
};

Ord.prototype.renderErrorRow = function(){
  var ord = this;
  if(!ord.errorRow) return;
};

$('.ord-file').on('change', function(e){
  e.preventDefault();
  var textType = /text.*/;
  for (var i = 0, file; file = this.files[i]; i++) {
    if (!file.type || (file.type && file.type.match(textType))) {
      var reader = new FileReader();
      reader.onload = function(e) {
        var dt = d3.tsv.parse(reader.result);
        dt.forEach(function(v,i){
          new Ord(v);
        });
      }
      reader.readAsText(file);
    }else{
      alert("File not supported - " + file.type);
    }
  }
});



