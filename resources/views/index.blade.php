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
        <a class="page_link">
        <div class="d-flex text-muted pt-3">
        
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


    <a class="page_link">
    <div class="d-flex text-muted pt-3">

	  <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
        <div class="d-flex justify-content-between">
        <strong class="text-gray-dark">
		</strong>
		<a href="#"></a>
		</div>
		<span class="d-block"> / </span>
		</div>
    </div></a>


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
<div style="text-align:left;margin:20px;">
<a href="/board/write.php" class="btn btn-dark">등록</a>
</div>
		
  </div>
</main>

@endsection