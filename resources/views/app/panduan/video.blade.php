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
   <iframe src="https://drive.google.com/file/d/1ACDZR3F1U441v9RwnCRYXNtFfzMPEqyK/preview" width="640" height="480" allow="autoplay"></iframe>
  
 </div>
@endsection
@push('js')
<script src="https://vjs.zencdn.net/8.5.2/video.min.js"></script>
@endpush
