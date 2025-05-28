@extends('main.layout')
@section('content')

<main class="container">

    <div class="my-3 p-3 bg-body rounded shadow-sm">
      <h6 class="border-bottom pb-2 mb-0"><span class="material-symbols-outlined" style="vertical-align: text-bottom;">workspace_premium</span>게시판</h6>
  
    @foreach ($boards as $key => $b)
        <a href="/boards/{{$b->site_num}}">
        <div class="d-flex text-muted pt-3">
            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
            <div class="d-flex justify-content-between">
            <strong class="text-gray-dark">{{$b->subject}}
            </strong>
            <a href="#">{{$b->site_cnt}}</a>
            </div>
            <span class="d-block"> {{$b->username}} / {{$b->site_reg_date}} </span>
            </div>
        </div></a>
    @endforeach
    
      <!-- <small class="d-block text-end mt-3">
        <a href="#">All updates</a>
      </small> -->
    </div>
  <br><br><br>
    
  </main>

@endsection