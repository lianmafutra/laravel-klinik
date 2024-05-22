@extends('admin.layouts.master')
@section('header')
    <x-header title="Dashboard"></x-header>
@endsection
@push('css')
    <style>
        body {}

        .table td,
        .table th {
            word-break: break-word;
        }

        table.dataTable thead tr {
            background-color: green;
        }

        /* .table thead th {
                        vertical-align: bottom;
                        border-bottom: none !important;
                        background-image: rgba(255, 255, 255, 0.2) !important;
                        backdrop-filter: blur(5px);
                        -webkit-backdrop-filter: blur(5px);
                        border: 1px solid rgba(255, 255, 255, 0.3) !important;
                    } */
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Pasien</span>
                    <span style="font-size: 20px" class="info-box-number">
                     <span style="font-size: 20px" class="info-box-number">10</span>
                        {{-- <small>%</small> --}}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
         <div class="info-box mb-3">
             <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
             <div class="info-box-content">
                 <span class="info-box-text">Pasien Hari ini</span>
                 <span style="font-size: 20px" class="info-box-number">2,000</span>
             </div>
         </div>
     </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Dokter</span>
                    <span style="font-size: 20px" class="info-box-number"></span>
                    <span style="font-size: 20px" class="info-box-number">5</span>
                </div>
            </div>
        </div>
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Obat</span>
                    <span style="font-size: 20px" class="info-box-number">100</span>
                    
                </div>
            </div>
        </div>
       
    </div>
    

 
@endsection
@push('js')
    <script>
      //   $.get(route('audit-log'), function(response) {
      //       // console.log(response)
      //       response.data.forEach(element => {
      //           $('#log_audit_body').append(`<tr>
      //                      <td>${element.username}</td>
      //                      <td>${ element.event}</td>
      //                      <td>${ element.auditable_type}</td>
      //                      <td ">${element.url}</td>
      //                      <td>${element.created_at}
      //                      </td></tr>`);
      //       });

      //   });
// 
      //   $.get("https://sirelaku.site/log-viewer/api/logs?direction=desc&exclude_levels[]=EMERGENCY&exclude_levels[]=INFO&exclude_file_types=&shorter_st", {
      //          "file": "laravel.log",
      //           "levels": ["warning", "error"],
      //       })
      //       .done(function(response) {
      //          console.log(response)
      //           response.logs.forEach(element => {
      //               $('#log_error_body').append(`<tr>
      //                      <td>${element.context[1]?.nama_lengkap}</td>
      //                      <td>${element.context[0]?.exception}</td>
      //                      <td>- ${element.context[1]?.url} <br> - ${element.context[1]?.controller}</td>
      //                      <td>${ element?.datetime}</td></tr>`);
      //           });
      //       });
    </script>
@endpush
