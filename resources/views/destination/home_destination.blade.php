@if(!empty($data->data))

@foreach($data->data as $key=>$val)
  <?php
  if($key==0 || $key==1){
  ?>
    <div class="col-md-6 col-12 placeCard position-relative">
        <a href="{{ url('sightseeing?location='.$val->id) }}" class="text-decoration-none overflow-x-hidden">
        <img src="{{ !empty($val->path)?config('app.img_base').$val->path:config('app.img_base').'noimage.jpg' }}" height="100%" alt="">
            <h3>{{ $val->name }}</h3>
        </a>
    </div>
    <?php
  }else{
  ?>

    <div class="col-md-3 col-12 placeCard position-relative">
        <a href="{{ url('sightseeing?location='.$val->id) }}" class="text-decoration-none overflow-x-hidden">
        <img src="{{ !empty($val->path)?config('app.img_base').$val->path:config('app.img_base').'noimage.jpg' }}" height="100%" alt="">
            <h3>{{ $val->name }}</h3>
        </a>
    </div>
    <?php
  }
  ?>
@endforeach

@endif