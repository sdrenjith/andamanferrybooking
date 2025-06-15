@extends('layouts.app')

@section('content')
    <main>
        <section class="blogs mt-0 mt-lg-5 mt-0 pt-0">
            <div class="container">

                <div class="row secHead w-100 py-1 py-lg-5" >
                    <h3>{{ $blog->title }}</h3>
                    <span class="blog-full-image">{{$blog->author_name}} {{ date('d M, Y', strtotime($blog->created_at)) }}</span>     
                    <!-- <div class="col-12 col-lg-6 col-md-6 blogDetailsImg">
                        <img src="{{ asset(env('UPLOADED_ASSETS').'uploads/blog/'. $blog->path) }}" class="w-100" alt="">
                    </div> -->
                    <!-- <div class="col-12 col-lg-6 col-md-6 blogDetails">
                        <div class="blogDetails-view">
                            <h3>{{ $blog->title }}</h3>
                            <span>{{$blog->author_name}} {{ date('d M, Y', strtotime($blog->created_at)) }}</span>     
                        </div>
                    </div> -->
                 </div>

                 <div class="row secHead w-100 mt-lg-4 mt-0 blog-details-content">
                    <div class="col-12 col-lg-9 col-md-9 ">
                        {!! $blog->subtitle !!}
                    </div>
                    <div class="col-12 col-lg-3 col-md-3">
                        @foreach($blogImages as $row)
                            <img src="{{ asset(env('UPLOADED_ASSETS').'uploads/blog/'. $row->image_path) }}" class="w-100" alt="" style="margin-bottom: 10px;">
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </section>
    </main>
    
@endsection