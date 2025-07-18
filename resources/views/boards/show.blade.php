@extends('main.layout')
@section('content')

<!-- Bootstrap core CSS -->
<link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="/css/4-col-portfolio.css" rel="stylesheet">
<style>
    video {
        max-width:95%;
        height:auto;
    }
    iframe {
        max-width:100%;
        max-height:100%;
    }
    .float1 { float: left; padding: 10px;}
    .memo-profile{
        width:50px;height:50px;
        border: 1px solid black;
        border-radius: 100%;
    }
    .user-profile{
        width:20px;height:20px;
        border: 1px solid black;
        border-radius: 100%;
        vertical-align: inherit;
    }
    .memo-image{
        max-width:200px;max-height:200px;
    }
    .utubevideo {
        position: relative;
        padding-bottom: 56.25%;
        height: 0; overflow: hidden;
        }
            
    .utubevideo iframe,
    .utubevideo object,
    .utubevideo embed {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    }

    .row a:link{color: black;}
    .row a:visited{color: black;}
</style>


    <!-- Page Content -->
    <div class="container">
		<div style="padding-bottom:10px;padding-top:10px;">
			<span style="font-weight:700;">{{$boards->subject}}</span>
			<span style="font-size:14px;float:right;"><i class="bi bi-graph-up" style="font-size:14px;vertical-align: bottom;"></i>&nbsp;{{$boards->cnt}}</span>
		</div>
		<div class="row">
            <div class="card" style="width:100%;">
                <div>
                    <table width="100%">
                        <tr>
                            <td style="text-align:left;padding:10px;">
                                <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{$boards->userphoto}}" class="user-profile"> {{$boards->name}} {!! member_level_icon($boards->mylevel??1) !!}
                                </a>
                                {{-- <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#msgModal" data-bs-whatever="@mdo"><span class="material-symbols-outlined" style="vertical-align: text-bottom;margin-right:5px;">forward_to_inbox</span>쪽지보내기</a></li>
                                    <li><a class="dropdown-item" href="javascript:;" onclick="msg();"><span class="material-symbols-outlined" style="vertical-align: text-bottom;margin-right:5px;">forward_to_inbox</span>쪽지보내기</a></li>
                                </ul>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Open modal for @mdo</button> --}}
                            </td>
                            <td style="text-align:right;padding:10px;">
                                <img src="/img/calendar-week.svg">
                                {{$boards->reg_date}}
                            </td>
                        </tr>
                    </table>
                </div>
					
                <div class="card-body">
                    {!! nl2br($boards->content) !!}
                </div>

                <div class="card-body">

                </div>


				<table width="120" align="center">
					<tr align="center">
						<td style="border: 1px solid;padding:5px;cursor:pointer;">
                            <img src="{{ $boards->btu }}" style="width:30px;" id="t_up" nv="n" onclick="thumbpress('up');">
						</td>
						<td>&nbsp;</td>
						<td style="border: 1px solid;padding:5px;cursor:pointer;">
                            <img src="{{ $boards->btd }}" style="width:30px;" id="t_down" nv="n" onclick="thumbpress('down');">
						</td>
					</tr>
					<tr align="center">
						<td style="border: 1px solid" id="area_up">
                            {{ number_format($boards->good) }}
						</td>
						<td>&nbsp;</td>
						<td style="border: 1px solid" id="area_down">
                            {{ number_format($boards->bad) }}
						</td>
					</tr>
				</table>
				<br>
                <div style="margin-bottom:10px;">
                @if($boards->next)
                <a href="/boards/show/{{ $boards->next }}"><span style="float:left;"><span class="material-symbols-outlined" style="vertical-align: text-bottom;">arrow_back_ios</span>다음짤</span></a>
                @endif
                @if($boards->prev)
                <a href="/boards/show/{{ $boards->prev }}"><span style="float:right;">이전짤<span class="material-symbols-outlined" style="vertical-align: text-bottom;">arrow_forward_ios</span></span></a>
                @endif
                </div>
            

    <br>
    <div>
        <button type="button" class="btn btn-dark" id="scrap">스크랩</button>

        <a href="/board/write.php?num={{ $boards->num }}"><button type="button" class="btn btn-dark">수정</button></a>
        <a href="/board/delete.php?num={{ $boards->num }}"><button type="button" class="btn btn-dark" onclick="return confirm('삭제하시겠습니까?')">삭제</button></a>

        @if(Auth::user()->email)
            <button type="button" class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#police">신고</button>
        @else
            <button type="button" class="btn btn-danger"  onclick="alert('회원 전용 기능입니다. 로그인 하십시오.');">신고</button>
        @endif

        <a href="#"><button type="button" class="btn btn-dark" style="float:right;">목록</button></a>
        <button type="button" class="btn btn-primary" style="float:right;margin-right:5px;"  onclick="sharePage()">공유</button>
    </div>
<!--댓글 시작 -->
	<!-- 댓글 -->
	<div class="btn btn-secondary" style="margin-top:10px;">
        댓글 <span id="memo_cnt_area">{{ number_format($boards->memo_cnt) }}</span>개
    </div>
    @if($boards->memo_cnt)

    <div id="reply">
        @foreach ($memos as $memo)
        <div class="card mt-2" id="memolist_{{ $memo->memoid }}">
            <div class="card-header p-2">
                <table>
                    <tbody><tr class="align-middle">
                        <td rowspan="2" class="pr-2">
                            @if($memo->photo)
                                <img src="/board/upImages/thumb/{!! $memo->photo !!}" class="memo-profile">
                            @else
                                <span class="material-symbols-outlined" style="font-size:40px;">record_voice_over</span>
                            @endif
                        </td>
                        <td class="ml">{{ $memo->name }} | {!! member_level_icon($memo->mylevel) !!}</td>
                    </tr>
                    <tr>
                        <td>
                            <font size="2">{{ $memo->regdate }}</font> 
                                <span style="cursor:pointer" onclick="#"></span>
                        </td>
                    </tr>
                </tbody></table>
            </div>
            <div class="card-body">
                @if($memo->memo_file)
                    <img src='/board/upImages/data/{{$memo->memo_file}}' class='memo-image'>
                @endif
                <p class="card-text">
                    {!! $memo->memo !!}
                </p>
                <span class="badge bg-secondary" style="cursor:pointer;padding:10px;"><a onclick="reply_write('{{ $memo->memoid }}','{{ $memo->bid }}')">답글</a></span>
                <span class="badge bg-secondary" style="cursor:pointer;padding:10px;"><a onclick="memo_delete('{{ $memo->memoid }}','{{ $memo->bid }}')">삭제</a></span>
                <span style="float:right;">
                    <table width="160" align="center">
                        <tr align="center">
                            <td style="border: 1px solid;padding:5px;cursor:pointer;" onclick="memothumb('up',{{ $memo->memoid }});">
                                <i id="mupc_{{ $memo->memoid }}" class="bi bi-emoji-heart-eyes" style="vertical-align: text-bottom;"></i>
                                <span id="mup_{{ $memo->memoid }}">{{ $memo->gn }}</span>
                            </td>
                            <td>&nbsp;</td>
                            <td style="border: 1px solid;padding:5px;cursor:pointer;" onclick="memothumb('down',{{ $memo->memoid }});">
                                <i id="mdnc_{{ $memo->memoid }}" class="bi bi-emoji-angry" style="vertical-align: text-bottom;"></i>
                                <span id="mdn_{{ $memo->memoid }}">{{ $memo->bn }}</span>
                            </td>
                            <td>&nbsp;</td>
                            <td style="border: 1px solid;padding:5px;cursor:pointer;color:red;">
                                <a href="javascript:;"  onclick="memopolice({{ $memo->memoid }});">
                                <span class="material-symbols-outlined"  style="vertical-align: text-bottom;color:red;">local_police</span></a>
                            </td>
                        </tr>
                    </table>
                </span>
            </div>
        </div>
        @endforeach
    </div>
    @endif
<!--댓글 끝 -->

    <div class="input-group" id="firstmemo" style="margin-top:10px;margin-bottom:10px;">
		<input type="hidden" name="memo_file" id="memo_file">
		<span class="input-group-text" id="memo_image_view"  style="display:none;"></span>
		<button type="button" id="togglememoimage" class="btn btn-seconday dropdown-toggle border" data-bs-toggle="dropdown" aria-expanded="false">
			이미지첨부
		  </button>
		  <ul class="dropdown-menu">
			<li><a class="dropdown-item"  id="replyimage">기존댓글에서선택</a></li>
			<li><hr class="dropdown-divider"></li>
			<li><a class="dropdown-item"  id="memo_image">내파일에서선택</a></li>
		  </ul>
		  <input type="file" name="upfile" id="upfile" accept="image/*" style="display:none;" />
		  <textarea class="form-control" aria-label="With textarea" style="height:100px;" name="memo" id="memo" placeholder="댓글을 입력해주세요"></textarea>
		  <button type="button" class="btn btn-secondary" style="float:right;" id="memo_submit">입력</button>
    </div>
<br><br>


</div>
</div>
</div>
</div><!-- container -->

<script>
    $("#memo_submit").click(function () {
        var memo=$("#memo").val();
        var memo_file=$("#memo_file").val();
        if(!memo && !memo_file){
                alert("댓글이나 첨부파일을 입력하세요");
                return;
        }

        var data = {
                memo : memo ,
                bid : {{$boards->num}},
                memo_file : memo_file
            };

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            async : false ,
            type : 'post' ,
            url : '/boards/memowrite' ,
            data  : data ,
            dataType : 'html' ,
            error : function() {} ,
            success : function(return_data) {
            if(return_data=="login"){
                alert('로그인 하십시오.');
                location.href='/member/login';
                return;
            }else{
                $('#memo').val('')
                //$('#memo_image').html('이미지<br>첨부');
                $("#memo_image_view").hide();
    //			$("#togglememoimage").show();
                $("#firstmemo").hide();
                $('#reply').append(return_data);
            }
            }
            , beforeSend: function () {
                var width = 0;
                var height = 0;
                var left = 0;
                var top = 0;
                width = 50;
                height = 50;

                top = ( $(window).height() - height ) / 2 + $(window).scrollTop();
                left = ( $(window).width() - width ) / 2 + $(window).scrollLeft();

                if($("#div_ajax_load_image").length != 0) {
                        $("#div_ajax_load_image").css({
                                "top": top+"px",
                                "left": left+"px"
                        });
                        $("#div_ajax_load_image").show();
                }
                else {
                        $('body').append('<div id="div_ajax_load_image" style="position:absolute; top:' + top + 'px; left:' + left + 'px; width:' + width + 'px; height:' + height + 'px; z-index:9999;" class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>');
                }

        }
            , complete: function () {
                        $("#div_ajax_load_image").hide();
        }
        });
    });

    function memo_delete(memoid,bid){

        if(!confirm('삭제하시겠습니까?')){
            return false;
        }

        var data = {
                num : bid,
                memoid : memoid
            };

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            async : false ,
            type : 'post' ,
            url : '/boards/memodelete' ,
            data  : data ,
            dataType : 'json' ,
            error : function() {} ,
            success : function(return_data) {
            if(return_data.msg=="fail"){
                alert(return_data.val);
                //location.href='/member/login.php';
                return;
            }else if(return_data.result=="succ"){
                    $('#memolist_'+memoid).remove();
                    $('#memo_cnt_area').text({{ $boards->memo_cnt-1 }})
                    //alert(return_data.val);
            }else{
                alert('관리자에게 문의하십시오.');
                return;
            }
            }
        });

        }
</script>


@endsection