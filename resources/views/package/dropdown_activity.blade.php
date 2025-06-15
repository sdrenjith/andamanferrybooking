     

@if(!empty($activities))
@foreach($activities as $activity)

<div class="modal-body">
    <div class="row"> 
        <div class="col-md-5 col-12">
            <div class="owl-carousel details_page">
                @foreach ($activity->Activity_images as $activity_image)
                <div class="item caro_image"><img
                        src="{{env('ASSET_PATH') .($activity_image->path)}}" height="100%"
                        alt=""></div>
                @endforeach
            </div>
        </div>

        <div class="col-md-7 col-12 mt-2 mt-md-0">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="badge ">Activity</span>
                <div class="d-flex align-items-center">

                <?php
                    if (in_array($activity->id, $active_activity_id)) { ?>
                            <a><button class="btn button select_activity act_disable{{$activity->id}}" style="padding:3px" id="select_activity" data-itinerary_day="{{$itinerary_day}}" 
                            value="{{$activity->id}}" disabled>Select Activity </button></a>

                            <?php }else { ?>

                            <a><button class="btn button select_activity act_disable{{$activity->id}}" style="padding:3px" id="select_activity" data-itinerary_day="{{$itinerary_day}}" data-location_id="{{$location_id}}" 
                            value="{{$activity->id}}" data-activity_price="{{$activity->price}}">Select Activity </button></a>
                    <?php } ?>
                </div>
            </div>
            <div>
                <h4>{{$activity->title}}</h4>
                <span> {{$activity->subtitle}}</span>
            </div>

            <div class="d-flex m-2" style="position:relative">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img src="{{asset('/images/person.png')}}"
                            width="20px" height="20px" alt="">
                        <p class="m-0 ms-2">Per Person</p>
                    </div>
                </div>
                <div style="position:absolute; right:5px">
                     <span class="text-muted badge " style="background:#a83a7a; color:#FFF !important;">Price:
                        {{$activity->price}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif