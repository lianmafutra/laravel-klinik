@extends('admin.layouts.master')
@section('header')
<x-header title="Buku Panduan"></x-header>
@endsection
@section('content')

<div class="card-body">
   <iframe src="{{ asset('file/buku-panduan-sampeyan-01.pdf') }}" width="100%" height="800px"></iframe>
 </div>
@endsection
