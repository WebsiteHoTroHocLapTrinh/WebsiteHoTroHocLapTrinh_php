@extends('layout.master')
@section('body')
@include('layout.imageHeader')
<!-- Content -->
<div class="content">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 ">
				<div class="main-content">
					<div class="content-card">
						<div class="tabs">
							@if(count($list_paginate)<=0)
							<h4 class="topquestion d-inline-block">Không tìm thấy kết quả cho từ khóa: "{{ $keyword }}"</h4>
							@else
							<h4 class="topquestion d-inline-block">Kết quả cho từ khóa: "{{ $keyword }}"</h4>
							@endif
							<br>
							<br>
							<div class="row">
								<div class="col-lg-6">
									<form id="form-search" action="{{ route('search-user') }}" method="GET">
										<div class="input-group">
											<input id="key_search" type="text" class="form-control" name="keyword" placeholder="Nhập từ khóa cần tìm" value="{{ $keyword }}">
											<span class="input-group-btn" >
												<button id="btn-search" type="button" class="btn btn-success">Tìm kiếm</button>
											</span>
										</div>
									</form>
								</div>
							</div>
							<br>
							<hr>
							<br>
							<div>
								<div class="row">
									@foreach($list_paginate as $list)
									<div class="col-lg-3 break-word" id="one-tag">
										<div class="media">
											<a href="{{ route('user-information', ['user_id' => $list->id, 'user_url' => $list->name_url]) }}" ><img class="rounded-circle mr-3" src="image/avatar_users/{{ $list->avatar }}" width="50" height="50"></a>
											<div class="media-body">
												<a class="name-list-user" href="{{ route('user-information', ['user_id' => $list->id, 'user_url' => $list->name_url]) }}" >{{ $list->name }}</a>
												<div class="text-muted info-list-user">
													<span>{{ $list->location }}</span>
													<span>Point: {{ $list->point_reputation }}</span>
													<span>Tham gia: {{ date('d-m-Y', strtotime($list->created_at)) }}</span>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
								
							</div>
							{{ $list_paginate->appends(['keyword' => $keyword])->links('pagination.custom') }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>			
</div>
</div>
</div>
<!-- end Content -->
@endsection

@section('title')
{{ "$keyword - Tìm Kiếm Người Dùng" }}
@endsection

@section('css')
<link rel="stylesheet" href="css/jquery.sweet-modal.min.css" />
@endsection

@section('script')
<script src="js/jquery.sweet-modal.min.js"></script>
<script>
	$(function(){
		$('#btn-search').click(function(){
			var content = $('#key_search').val();
    			//alert(content)
    			if(content.length<=0){
    				$('#form-search').submit(function(e){
    					e.preventDefault();
    				});

    				$.sweetModal({
    					content: 'Bạn chưa nhập từ khóa tìm kiếm',
    					icon: $.sweetModal.ICON_WARNING
    				});
    			}
    			else{
    				document.getElementById('form-search').submit();
    			}
    		});
	})
</script>
@endsection