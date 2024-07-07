@extends('admin.layouts.master')
@push('css')
<link href="https://vjs.zencdn.net/8.5.2/video-js.css" rel="stylesheet" />
<style>
   .video-js {
    position: relative !important;
    width: 100% !important;
    height: 700px !important;
}
</style>
@endpush
@section('header')
<x-header title="Video Panduan"></x-header>
@endsection
@section('content')

<div class="card-body col-12">
   <iframe src="http://103.141.238.86/video.mp4" width="100%" height="800" allow="autoplay"></iframe>
  
 </div>
@endsection
@push('js')
<script src="https://vjs.zencdn.net/8.5.2/video.min.js"></script>
@endpush
