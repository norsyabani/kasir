@extends('layout.app', ['navbar' => true])

@section('title', 'Pendapatan')

@section('content')
@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row flex-row">
            <div class="col">
                <h4 class="card-title" id="title">List Pendapatan</h4>
            </div>
            <div class="col">
                <div class="form-group d-flex flex-row align-items-center justify-content-end">
                    <label for="sort" class="mb-0 me-2">Sort by</label>
                    <select class="form-control w-50" id="sort">
                      <option value="day">Data per hari</option>
                      <option value="month">Data per Bulan</option>
                    </select>
                  </div>
            </div>
        </div>
        <div class="table-responsive pt-3">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>
                    #
                  </th>
                  <th id="time">
                    Tanggal
                  </th>
                  <th>
                    Total Transaksi
                  </th>
                  <th>
                    Total Pendapatan
                  </th>
                  <th>
                    Aksi
                  </th>
                </tr>
              </thead>
              <tbody id="tBody">
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment-with-locales.min.js" integrity="sha512-vFABRuf5oGUaztndx4KoAEUVQnOvAIFs59y4tO0DILGWhQiFnFHiR+ZJfxLDyJlXgeut9Z07Svuvm+1Jv89w5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
      function generateDateToday(date){
        var d = new Date(date)
        var year = d.getFullYear();
        var month = ("0" + (d.getMonth() + 1)).slice(-2);
        var day = ("0" + d.getDate()).slice(-2);
        var hour = ("0" + d.getHours()).slice(-2);
        var minutes = ("0" + d.getMinutes()).slice(-2);
        var seconds = ("0" + d.getSeconds()).slice(-2);
        return year + "-" + month + "-" + day + " "+ hour + ":" + minutes + ":" + seconds;
    }

    moment.locale('id');

    function moneyFormat(num) {
        var	number_string = num.toString(),
            sisa 	= number_string.length % 3,
            rupiah 	= number_string.substr(0, sisa),
            ribuan 	= number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        return rupiah;
    }

    function getData( ){
        $.ajax({
            url: '/pendapatan/get_data',
            type: 'GET',
            success: function(data){
                var result = Object.keys(data.data).map((key) => [Number(key), data.data[key]]);

                let i = 1;
                result.forEach(element => {

                    function totalHarga(data){
                        var total = [];
                        if(element[1].length > 1){
                            for(let j = 0; j < data.length; j++){
                                total.push(data[j]['total_harga']);
                            }
                            return total.reduce((a,b) => a + b, 0);
                        }else{
                            return data[0]['total_harga'];
                        }
                    }

                    for(let j = 0; j < element[1].length; j++){
                        var date = element[1][j]['created_at'];
                        date = moment(date).format('YYYY-MM-DD');
                    }

                    var row = '<tr>' +
                                '<td>' + (i++) + '</td>' +
                                '<td>' + moment(element[1][0]['created_at']).format('dddd, MMMM Do YYYY') + '</td>' +
                                '<td>' + element[1].length+ '</td>' +
                                '<td>' + 'Rp. ' + moneyFormat(totalHarga(element[1])) + '</td>' +
                                '<td>' + '<a href="/pendapatan/day/'+date+'/detail" class="btn btn-inverse-primary btn-fw btn-rounded">Lihat Detail</a>' + '</td>' +
                            '</tr>';
                    $('#tBody').append(row);

                });
            }
        });
    }

    function sortData(sort){
        $.ajax({
            url: '/pendapatan/'+sort+'/sort',
            type: 'GET',
            success: function(data){
                var result = Object.keys(data.data).map((key) => [Number(key), data.data[key]]);

                let i = 1;
                result.forEach(element => {

                    function totalHarga(data){
                        var total = [];
                        if(element[1].length > 1){
                            for(let j = 0; j < data.length; j++){
                                total.push(data[j]['total_harga']);
                            }
                            return total.reduce((a,b) => a + b, 0);
                        }else{
                            return data[0]['total_harga'];
                        }
                    }

                    for(let j = 0; j < element[1].length; j++){
                        var date = element[1][j]['created_at'];
                        date = moment(date).format('YYYY-MM-DD');
                    }

                    var row = '<tr>' +
                                '<td>' + (i++) + '</td>' +
                                '<td>' + moment(element[1][0]['created_at']).format('MMMM YYYY') + '</td>' +
                                '<td>' + element[1].length+ '</td>' +
                                '<td>' + 'Rp. ' + moneyFormat(totalHarga(element[1])) + '</td>' +
                                '<td>' + '<a href="/pendapatan/month/'+date+'/detail" class="btn btn-inverse-primary btn-fw btn-rounded">Lihat Detail</a>' + '</td>' +
                            '</tr>';
                    $('#tBody').append(row);

                });
            }
        });
    }

    $('#sort').change(function(){
        var sort = $(this).val();
        $('#tBody').empty();
        sortData(sort);
        if(sort == 'day'){
            $('#time').text('Tanggal');
            $('#title').text('Pendapatan Hari Ini');
        }else{
            $('#time').text('Bulan');
            $('#title').text('Pendapatan Bulan Ini');
        }
    });

    if($('#sort').val() == 'day'){
        $('#time').text('Tanggal');
        $('#title').text('Pendapatan Hari Ini');
        sortData('day');
    }else{
        $('#time').text('Bulan');
        $('#title').text('Pendapatan Bulan Ini');
        sortData('month');
    }

    getData();
  </script>
@endsection
