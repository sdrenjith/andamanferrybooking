
    
    @if(!empty($data->data))
    @foreach($data->data as $key=>$val)
            <div class="carousel-item {{ ($key==0)?'active':'' }}">
            <img src="{{ !empty($val->bannerimage[0]->path)?config('app.img_base').$val->bannerimage[0]->path:config('app.img_base').'noimage.jpg' }}" class="d-block" alt="...">
                <div class="carousel-caption ">
                    <p>{{ $val->subtitle }}</p>
                    <h1>{{ $val->title }}</h1>
                    <a href ="{{ url($val->button_link) }}" class="btn btn-light bannerBtn">{{$val->button_text}}</a>
                </div>
            </div>
    @endforeach


    @endif

    <script>
        $(document).ready(function() {

        });
    </script>