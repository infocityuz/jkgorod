@extends('forthebuilder::layouts.forthebuilder')

@section('title') {{__("locale.show")}} @endsection

@section('content')

<div class="page-header card">
</div>
<div class="card">
<div class="content-header">
  <div class="container-fluid card-block">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">{{__("locale.leads")}}</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('forthebuilder.index')}}">{{__("locale.home")}}</a></li>
          <li class="breadcrumb-item"><a href="{{route('forthebuilder.house.index')}}">{{__("locale.house")}}</a></li>
          <li class="breadcrumb-item"><a href="{{route('forthebuilder.house.show-more',$model->id)}}">{{__("locale.show")}}</a></li>
          <li class="breadcrumb-item active">{{__("locale.show")}}</li>
        </ol>
      </div>
    </div>
  </div>
</div>

</div>

<div class="card">
    <div class="card-body">
    <div class="card-block table-border-style">
          <table class="table table-bordered table-hover">
              <thead >
                  <tr>
                      <th>Атрибут</th>
                      <th>Данные</th>
                  </tr>
              </thead>
              <tbody>
              <tr>
                  <td><b>{{__("locale.house_name")}}</b></td>
                  <td>{{$model->house_number}}</td>
              </tr>
              <tr>
                  <td><b>{{__("locale.corpas")}}</b></td>
                  <td>{{$model->corpas}}</td>
              </tr>
              <tr>
                  <td><b>{{__("locale.info")}}</b></td>
                  <td>{{$model->house_info}}</td>
              </tr>
              <tr>
                  <td><b>{{__("locale.enterance_count")}}</b></td>
                  <td>{{$model->enterance_count}}</td>
              </tr>
              <tr>
                  <td><b>{{__("locale.floor_count")}}</b></td>
                  <td>{{$model->floor_count}}</td>
              </tr>

              </tbody>
          </table>

        </div>
    </div>
</div>
@endsection
@section('scripts')
  <script>
      let page_name = 'house';
      //house-box
      var gId = '';
      var number_of_flat = '';
      var contract_number = '';
      $('.house-box').on('click',function (e) {

          var id = $(this).data('id');
          number_of_flat = $(this).data('name');
          contract_number = $(this).data('contractnumber');

          gId = id;
          e.preventDefault();
          $('.forthebuilder').addClass('active');
          $('.right__sidebar').addClass('active');
          $('#flatItemDetailShow').empty();
          $('#flatItemDetailImg').empty();

          $.ajaxSetup({
              beforeSend: function() {
                  // TODO: show your spinner
                  $("#for-preloader").addClass('spinner-border');
                  $('#flatItemDetailTable').hide();
                  $('#flatItemStatusSelect').hide();
                  $('#change-status').hide();
              },
              complete: function() {
                  // TODO: hide your spinner
                  $("#for-preloader").removeClass('spinner-border');
                  $('#flatItemDetailTable').show();
                  $('#flatItemStatusSelect').show();
                  $('#change-status').show();
              }
          });

          $.get('/forthebuilder/house/show-more-item-detail/'+id, function (data) {
              if(data['flatItemDetailImg'] != null){
                  let imgurl = 'm_'+data['flatItemDetailImg']['guid']
                  $('#flatItemDetailImg').append(`<img src='/uploads/house-flat/${id}/${imgurl}' class='img-fluid mb-2'alt='white sample'/>`);
              }else{
                  $('#flatItemDetailImg').append("<img src='/backend-assets/img/no-photo.png' class='img-fluid mb-2'alt='white sample'/>");
              }

              $('#flatItemStatusSelect option').remove();
              if(data['flatItemDetail']['status'] == 0){
                  $('#flatItemStatusSelect').append('<option value=' + 0 + ' selected> Свобдно </option>');
                  $('#flatItemStatusSelect').append('<option value=' + 1 + '> Занято </option>');
                  $('#flatItemStatusSelect').append('<option value=' + 2 + '> Продано </option>');
              }
              if(data['flatItemDetail']['status'] == 1){
                  $('#flatItemStatusSelect').append('<option value=' + 1 + ' selected> Занято </option>');
                  $('#flatItemStatusSelect').append('<option value=' + 0 + '> Свобдно </option>');
                  $('#flatItemStatusSelect').append('<option value=' + 2 + '> Продано </option>');
              }
              if(data['flatItemDetail']['status'] == 2){
                  $('#flatItemStatusSelect').append('<option value=' + 2 + ' selected> Продано </option>');
                  $('#flatItemStatusSelect').append('<option value=' + 0 + '> Свобдно </option>');
                  $('#flatItemStatusSelect').append('<option value=' + 1 + '> Занято </option>');
              }
              $('#flatItemDetailPrice').text(data['flatItemDetail']['price']);
              $('#flatItemDetailRoomCount').text(data['flatItemDetail']['room_count']);

              $('#flatItemDetailShow').empty();
              $('#flatItemDetailShow').append(`<a href='/forthebuilder/house-flat/show/${id}' class='style-add btn btn-primary' style='color:#fff'>{{__('locale.show')}}</a>`);
              $('#flatItemStatusSelect').attr("data-id",`${id}`);

          })

      });

      $('#flatItemStatusSelect').on('change',function (e) {
          // console.log(gId)
          e.preventDefault();
          var selectedstatuses = $('#flatItemStatusSelect').val();
          if(selectedstatuses != 2){
              $.ajax({
                  url: `/forthebuilder/house-flat/update-status/${gId}`,
                  data: {status: selectedstatuses},
                  type: 'PUT',
                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                  success: function (data) {
                      // console.log(data);
                      //   console.log(data['id']);
                      if(data['warning']){
                          toastr.warning(data['warning']);
                      }
                      if(data['success']){
                          toastr.success(data['success']);
                      }
                      // $('.house-box').data('id');
                      let id = data['id'];
                      if(data['status'] == 0){
                          $(`.house-box[data-id=${id}]`).css('backgroundColor','rgb(25,132,86)')
                      }
                      if(data['status'] == 1){
                          $(`.house-box[data-id=${id}]`).css('backgroundColor','rgb(245,187,12)')
                      }
                      if(data['status'] == 2){
                          $(`.house-box[data-id=${id}]`).css('backgroundColor','rgb(105,116,126)')
                      }

                  },
                  error: function (data) {
                      console.log(data);
                  }
              });
          }else{
              location.replace("/forthebuilder/deal/create?house_flat_id=" + gId + '&name=' + number_of_flat + '&house_id=' + '{{$model->id}}' + '&house_name=' +'{{$model->house_number}}'  + '&contract_number=' + contract_number);
          }

      })
  </script>
@endsection







