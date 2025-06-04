@extends('main.layout')
@section('content')
<?php
        if($bid){
            $pid=$bid;
            $btitle = "수정";
        }else{
            $pid=time();
            $btitle = "쓰기";
        }
    ?>
<!-- Section Title -->
<div class="container section-title" style="margin-bottom:0px;margin-top:10px;" data-aos="fade-up">
    <div class="section-title-container d-flex align-items-center justify-content-between" style="padding-bottom:0px;">
        <h2>{{ boardtitle($multi)}}</h2>
        <p>{{ boardtitle($multi)}}입니다.</p>
    </div>
</div>
<!-- End Section Title -->

<!-- Page Content -->
<div class="container">
    <form action="#" method="post">
    @csrf
    @method('post')
    <input type="hidden" name="pid" id="pid" value="{{ $pid }}">
    <input type="hidden" name="bid" id="bid" value="{{ $bid??0 }}">
    <input type="hidden" name="code" id="code" value="boardattach">
    <input type="hidden" name="attcnt" id="attcnt" value="0">
    <input type="hidden" name="imgUrl" id="imgUrl" value="">
    <input type="hidden" name="attcnt" id="attcnt" value="0">
    <div style="padding-bottom:10px;padding-top:10px;text-align:center;">
        <input type="text" class="form-control" id="subject" placeholder="제목을 입력하세요" value="">
    </div>
    
    <iframe id="summerframe" src="{{ route('boards.summernote',['multi' => $multi, 'bid' => $bid]) }}" style="width:100%; height:550px; border:none" scrolling = "no"></iframe>

    <div id="attach_site">
        <div class="row row-cols-1 row-cols-md-6 g-4" id="attachFiles" style="margin-left:0px;">
            
        </div>
    </div>
<br>
    <div class="mb-3">
            <input type="file" name="afile" id="afile" accept="image/*" multiple class="form-control" aria-label="Large file input example">
        </div>

  <br><!--img src="/img/loading.gif"-->
  <button type="button" class="btn btn-dark" style="float:right;" id="upbutton" onclick="saveUp();">등록</button>
    <div class="alert alert-info" role="alert" id="upmsg" style="display:none;">
         등록중입니다. 잠시만 기다려주십시오.
    </div>
  </form>
  <!-- /.row -->

</div>
<br><br>	<br><br>
<!-- /.container -->
<script>
    function saveUp(){
        var subject=$("#subject").val();
        //var content=$("#content").val();
        var content=$('#summerframe').get(0).contentWindow.$('#summernote').summernote('code');//iframe에 있는 값을 가져온다
        var pid = $("#pid").val();
        var code = $("#code").val();
        var data = {
            multi : '{{ $multi }}',
            subject : subject,
            content : content,
            pid : pid,
            code : code
        };
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'post',
            url: '{{ route('boards.create') }}',
            dataType: 'json',
            enctype: 'multipart/form-data',
            data: data,
            success: function(data) {
                location.href='/boards/show/'+data.bid+'/1';
            },
            error: function(data) {
                console.log("error" +data);
            }
        });
    }
</script>
@endsection