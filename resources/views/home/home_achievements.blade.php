<ul class="m-0 p-0 d-flex justify-content-evenly align-items-center">
    @if(!empty($data->data))
    @foreach($data->data as $key=>$val)
    <li class="list-unstyled achievementlogo achievementlogo{{ $key+1 }} {{ ($key==0)?'active':'' }}" data-list="{{ $key+1 }}"><img src="{{ !empty($val->path)?config('app.img_base').$val->path:config('app.img_base').'noimage.jpg' }}" alt=""></li>
    @endforeach
    @endif
</ul>
<div class="container">
    <div class="achievementCommentContainer position-relative">
        @if(!empty($data->data))
        @foreach($data->data as $key=>$val)
        <div class="achievementComment achievementComment{{ $key+1 }} text-center">
            <h3>"{{ $val->title }}"</h3>
            <p>{{ $val->subtitle }}</p>
        </div>
        @endforeach
        @endif
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".achievementlogo1").addClass("active");
        $(".achievementComment1").css("opacity", "1");
        $(".achievementlogo").click(function() {
            $(this).siblings().removeClass("active");
            $(this).addClass("active");
            var activeComment = $(".achievementlogo.active").data("list");
            $(".achievementComment").css("opacity", "0");
            $(".achievementComment" + activeComment + " ").css("opacity", "1");
        });
    });
</script>