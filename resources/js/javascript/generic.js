$('#delete').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var contid = button.data('contid');
  var modal = $(this);
  modal.find('.modal-body #contid').val(contid);
});

$('#newStatusCustomer').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var customer = button.data('customer');
  var modal = $(this);
  modal.find('.modal-body #customer').val(customer);
});

$('#newStatusNumber').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var number = button.data('number');
  var modal = $(this);
  modal.find('.modal-body #number').val(number);
});