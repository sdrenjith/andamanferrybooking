@if(!empty($data->data))
      
     
@foreach($data->activity_category as $key=>$val)
<div class="col-lg-3 col-md-4 col-sm-6 placeCard ">
    <a href="{{ url('activity?activity_cat='.$val->id) }}" class="text-decoration-none">
        <img src="{{ !empty($val->category_image)?config('app.img_base').$val->category_image:config('app.img_base').'noimage.jpg' }}" height="100%" alt="">
        <h3>{{ $val->category_title }}</h3>
    </a>
</div>
@endforeach

@endif