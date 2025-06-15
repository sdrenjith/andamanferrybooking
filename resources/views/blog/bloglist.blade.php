@extends('layouts.app')

@section('content')

    <main>
        <div class="homepage-pattern-bg">
        <section class="blogs mt-5 pt-0 pt-lg-3">
            <div class="row secHead w-100 m-0">
                <div class="col-12 text-center">
                    <h2>Our Journey Blogs </h2>
                </div>
            </div>
            <div class="blogCards blogList">
                <div class=" container">
                    <div class="row ">
                        @foreach ($blogs as $blog)
                        <div class="col-12 col-md-6 col-lg-3 mb-3">
                            
                            <div class="item ">
                                <div class="blogcard">
                                    <div class="blogImg">
                                        <img src="{{asset(env('UPLOADED_ASSETS').'uploads/blog/'. $blog->path) }}" alt="">
                                    </div>
                                    <div class="blogCardInfo">
                                        <span>{{$blog->author_name}} {{ date('d M, Y', strtotime($blog->created_at)) }}</span>
                                        <h3>{{$blog->title}}</h3>

                                        <a href="{{url('blog/'.$blog->id)}}">Read More <img src="images/read-more.svg" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        </div>
    </main>
    @endsection
    
