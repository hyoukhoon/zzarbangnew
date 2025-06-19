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
</style>
<style type="text/css">
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
                                    <img src="{{$boards->userphoto}}" class="user-profile"> {{$boards->name}} {{member_level_icon($boards->mylevel)}}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#msgModal" data-bs-whatever="@mdo"><span class="material-symbols-outlined" style="vertical-align: text-bottom;margin-right:5px;">forward_to_inbox</span>쪽지보내기</a></li>
                                    <li><a class="dropdown-item" href="javascript:;" onclick="msg();"><span class="material-symbols-outlined" style="vertical-align: text-bottom;margin-right:5px;">forward_to_inbox</span>쪽지보내기</a></li>
                                </ul>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Open modal for @mdo</button>
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
						</td>
						<td>&nbsp;</td>
						<td style="border: 1px solid;padding:5px;cursor:pointer;">

						</td>
					</tr>
					<tr align="center">
						<td style="border: 1px solid" id="area_up">
						</td>
						<td>&nbsp;</td>
						<td style="border: 1px solid" id="area_down">
						</td>
					</tr>
				</table>
				<br>
                <div style="margin-bottom:10px;">
                <a href="/boards/show/{{ $boards->next }}"><span style="float:left;"><span class="material-symbols-outlined" style="vertical-align: text-bottom;">arrow_back_ios</span>다음짤</span></a>
                <a href="/boards/show/{{ $boards->prev }}"><span style="float:right;">이전짤<span class="material-symbols-outlined" style="vertical-align: text-bottom;">arrow_forward_ios</span></span></a>
                </div>
            </div>
        </div>
    </div>


@endsection