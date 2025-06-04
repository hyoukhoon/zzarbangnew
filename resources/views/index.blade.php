@extends('main.layout')
@section('content')
<style>
	.page-link a{color: black;}
</style>

<main class="container">
<!-- hot 시작 -->


  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-0"><span class="material-symbols-outlined" style="vertical-align: text-bottom;">award_star</span> Today Hot!</h6>

    @foreach ($hots as $hot)
        <a class="page_link" href="/boards/show/{{$hot['site_num']}}">
        <div class="d-flex text-muted pt-3">
          @if($hot['thumbnail'])
            @if($hot['thumbnail']=="mp4")
              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-caret-right-square-fill flex-shrink-0 me-2 rounded" viewBox="0 0 16 16">
                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.5 10a.5.5 0 0 0 .832.374l4.5-4a.5.5 0 0 0 0-.748l-4.5-4A.5.5 0 0 0 5.5 4v8z"/>
              </svg>
            @elseif($hot['thumbnail']=="img")
              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-image flex-shrink-0 me-2 rounded" viewBox="0 0 16 16">
                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
              </svg>
            @else
              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-image flex-shrink-0 me-2 rounded" viewBox="0 0 16 16">
                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
              </svg>
            @endif
          @else
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-exclamation-square-fill flex-shrink-0 me-2 rounded" viewBox="0 0 16 16">
              <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
          @endif
        <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
            <div class="d-flex justify-content-between">
            <strong class="text-gray-dark">{{$hot['subject']}}</strong>
            <a href="#">{{$hot['site_cnt']}}</a>
            </div>
            <span class="d-block"> {{$hot['username']}} / {{$hot['site_reg_date']}}</span>
            </div>
        </div></a>
    @endforeach
    <!-- <small class="d-block text-end mt-3">
      <a href="#">All updates</a>
    </small> -->
  </div>

<!-- hot 끝 -->
  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-0"><span class="material-symbols-outlined" style="vertical-align: text-bottom;">book</span> Today Zzal </h6>

    @foreach ($today as $key => $t)
    <a class="page_link" href="/boards/show/{{$t->site_num}}">
    <div class="d-flex text-muted pt-3">
      @if($t->thumbnail)
        @if($t->thumbnail=="mp4")
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-caret-right-square-fill flex-shrink-0 me-2 rounded" viewBox="0 0 16 16">
            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.5 10a.5.5 0 0 0 .832.374l4.5-4a.5.5 0 0 0 0-.748l-4.5-4A.5.5 0 0 0 5.5 4v8z"/>
          </svg>
        @elseif($t->thumbnail=="img")
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-image flex-shrink-0 me-2 rounded" viewBox="0 0 16 16">
            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
            <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
          </svg>
        @else
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-image flex-shrink-0 me-2 rounded" viewBox="0 0 16 16">
            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
            <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
          </svg>
        @endif
      @else
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-exclamation-square-fill flex-shrink-0 me-2 rounded" viewBox="0 0 16 16">
          <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>
      @endif
	  <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
        <div class="d-flex justify-content-between">
        <strong class="text-gray-dark">{{$t->subject}}</strong>
		<a href="#">{{$t->site_cnt}}</a>
		</div>
		<span class="d-block"> {{$t->username}} / {{$t->site_reg_date}}</span>
		</div>
    </div></a>
    @endforeach

    <small class="d-block text-end mt-3">
      <ul class="pagination justify-content-center">
        <li class="page-item">

        </li>
        
        <li class="page-item">

        </li>
      </ul>
    </small>
	<div style="text-align:center;padding:10px;" id="searchbutton">	
		<form method="get" action="search.php" name="sform" onsubmit="return searchform();">
			<input type="text" name="sword" value="" id="sword"  style="width:200px;height:38px;">&nbsp;<button  type="submit" id="search" class="btn btn-dark">검색</button>
		</form>
	</div>
	<div style="text-align:center;padding:10px;display:none;" id="searching">	
	<button class="btn btn-dark" type="button" disabled >
	  <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
	  Searching...
	</button>
	</div>
@auth()  
<div style="text-align:left;margin:20px;">
<a href="/boards/write/{{ $multi }}" class="btn btn-dark">등록</a>
</div>
@endauth()		
  </div>
</main>

@endsection