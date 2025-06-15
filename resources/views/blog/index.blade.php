@extends('layouts.app')

@section('content') 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<main>
        <div class="row">
            <div class="col-12 p-0">
                <div class="sectionHead text-center innerPageBanner">
                    <h2 class="">Travel Articles</h2>
                    <p class="text-white">Read our articles to know more about Andaman
                    </p>
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Blog List</li>
                </ol>
            </nav>
        </div>
    
        <div class="container">
            <div class="row mt-4">
                <div class="col-lg-8 col-12">
                    @if(!empty($data->data))
                    @foreach($data->data as $key=>$val)
                    <a href="{{ url('blog/'.$val->id) }}" class="text-decoration-none mb-4 d-block">
                        <div class="row ">
                            <div class="col-lg-3 blogImg">
                            <img src="{{ !empty($val->path)?config('app.img_base').$val->path:config('app.img_base').'noimage.jpg' }}" width="100%" alt="">
                            </div>
                            <div class="col-lg-9 blogInfo">
                                <p class="text-muted">{{$val->author_name}}, {{ date("dS M, Y",strtotime($val->created_at)) }}</p>
                                <h3>{{ $val->title }}</h3>
                                <p>{{ $val->subtitle }}</p>
                                <!-- <div>
                                    <span class="badge economy ">Economy</span>
                                    <span class="badge">Couple</span>
                                </div> -->
                            </div>
                        </div>
                    </a>
                    @endforeach
                    @endif
                    <div class="text-center load_more" id="append_before">
                        <button type="button" id="load_more" style="border-radius: 5px; padding: 5px;"> <span id="button_loader"><i class="fa fa-refresh fa-spin"></i> </span> Load More</button>
                       
                        <input type="hidden" name="page_no" id="page_no" value="1">
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="sectionHead ">
                                <h4 class="">Search
                                </h4>
                            </div>
                        <form id="search_form" name="search_form" method="GET">
                            <div>
                                <div class="searchBar">
                                    <img src="images/search-icon.svg" alt="">
                                    <input type="search" name="search_txt" id="search_txt" placeholder="Search" class="border-1 " value="{{ (!empty($_GET['search_txt']))?$_GET['search_txt']:'' }}" oninput="searchclear();">
                                </div>
                            </div>
                        </form>
                            {{-- <div class="recentPost">
                                <div class="sectionHead ">
                                    <h4 class="">Recent Posts
                                    </h4>
                                    <ul class="p-0">
                                    @if(!empty($recent_blog->data))
                                    @foreach($recent_blog->data as $key=>$recent)
                                        <li>
                                        <a href="{{ url('blog/'.$val->id) }}" class="text-decoration-none mb-4 d-block">
                                        <img src="{{ !empty($val->path)?config('app.img_base').$val->path:config('app.img_base').'noimage.jpg' }}" width="100%" alt="">
                                                <div>
                                                    <p>{{ $val->title }}</p>
                                                    <span class="text-muted">{{ date('Y-m-d', strtotime($val->created_at)) }}</span>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                    @endif                                  
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
@push('js')
<script>
function searchclear()
{
    var search_txt = $("#search_txt").val();
    if($.trim(search_txt)=='')
    {
        $("#search_form").submit();
    }
}
$( document ).ready(function() {
    $('#button_loader').hide();
}); 

    $(document).on('click', "#load_more", function(e) {
        var page_no = $('#page_no').val();
         $('#button_loader').show();
        $.ajax({
            url: "{{ route('load_more') }}",
            type: 'GET',
            dataType: 'json',
            data: {page_no: page_no, },
            cache: false,
            success: function(data){
               console.log(data);
               if (data.html && $(data.html).length) {
                $('#button_loader').hide();
                    $(data.html).insertBefore('#append_before');
                    $('#page_no').val(data.page_no);
                } else {
                    $('#load_more').hide();
                }
            }
            });
    });
</script>
@endpush