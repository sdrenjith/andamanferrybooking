@if(!empty($blog_data->data))
                    @foreach($blog_data->data as $key=>$val)
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