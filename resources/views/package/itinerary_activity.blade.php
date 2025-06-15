

    @if(!empty($activity))
 
    {{-- <div class="row append_div" data-activity_id="{{$activity->id }}"> --}}
    <div class="itinerary-activity d-flex append_div" data-activity_id="{{$activity->id }}">
        <div class="col-md-4 col-12">
            <img src="{{asset('/images/inspiration1.png')}}" width="100%" alt="">
        </div>

        <div class="col-md-8 col-12 ms-2 mt-2 mt-md-0">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="badge">Activity</span>
                <div class="d-flex align-items-center">
                <div class="d-flex align-items-center">
                <input type="hidden" name="activity_id[{{$itinerary_day}}][]" value="{{$activity->id }}">
                    <button class="btn btn-danger" id="remove_activity"  data-activity_price="{{$activity->price}}">Remove</button>
                    <button class="btn button add_activity ms-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="add_activity" data-itinerary_day="{{$itinerary_day}}" data-activity_price="{{$activity->price}}" value="{{ $location_id }}" >Add Activity</button>
                </div>
                </div>
            </div>
            <div>
                <h4>{{$activity->title}}</h4>
                <span> {{$activity->subtitle}}</span>
            </div>
             <span class="text-muted badge" style="background:#a83a7a; color:#FFF !important">Price: {{$activity->price}}</span>
            <input type="hidden" class="price activity-price" value="{{$activity->price}}">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img src="{{asset('/images/person.png')}}"
                        width="20px" height="20px" alt="">
                    <p class="ms-2">Per Person</p>
                </div>
                
                {{-- <div class="pkgRating">
                    <img src="{{asset('/images/stars.svg')}}" width="16px" height="16px" alt="">
                    <p><span>4.5</span>/5</p>
                </div> --}}
            </div>
        </div>
    </div>
    {{-- </div> --}}
    @endif