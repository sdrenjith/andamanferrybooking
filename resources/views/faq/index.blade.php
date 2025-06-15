@extends('layouts.app')

@section('content')






<main>
    <div class="pageHead innerPageBanner">
        <h1>FAQ</h1>
    </div>

    <div class="container">
    <div class="faq">
        @foreach($faq_category as $index => $c)
        <div class="accordion" id="accordionExample{{$index}}">
            <div class="accordion-item row">
                <div class="accordion-header col-12 col-lg-3" id="heading{{$index}}">
                    <button class="parent accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse{{$index}}" aria-expanded="false"
                        aria-controls="collapse{{$index}}">
                        <ul class="p-0 faqList" >
                            <li class="list-unstyled ">
                                {{ $c->category_title }}
                            </li>
                        </ul>
                    </button>
                </div>
                <div id="collapse{{$index}}" class="accordion-collapse collapse  col-12 col-lg-9" aria-labelledby="heading{{$index}}"
                    data-bs-parent="#accordionExample{{$index}}">

                    <?php
                        $cat_id = $c->id;
                        $faq = DB::select("SELECT * FROM faq WHERE faq_category = ?", [$cat_id]);
                    ?>

                    <div class="accordion-body">
                        <div class="row">
                            <div class="faqQuestions">
                                <div class="accordion" id="nestedAccordion{{$index}}">
                                    @foreach($faq as $dataIndex => $value)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="nestedHeading{{$index}}{{$dataIndex}}">
                                            <button class="accordion-button" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#nestedCollapse{{$index}}{{$dataIndex}}"
                                                aria-expanded="true" aria-controls="nestedCollapse{{$index}}{{$dataIndex}}">
                                                {{$value->questions}}
                                            </button>
                                        </h2>
                                        <div id="nestedCollapse{{$index}}{{$dataIndex}}" class="accordion-collapse collapse "
                                            data-bs-parent="#nestedAccordion{{$index}}">
                                            <div class="accordion-body">
                                                {{$value->answers}}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

</main>

@endsection