@extends('layouts.app')

@section('content')
    <main>

        <style>
            #luxuryContainer {
                display: none;
            }

            #g-o-1-economy {
                display: none;
            }

            #g-o-1-premium {
                display: none;
            }

            #luxuryContainer .luxury-down {
                height: 51%;
                width: 100%;
                bottom: 28%;
            }

            #royalContainer .luxury-down {

                width: 100%;
                bottom: 27%;
            }

            #g-o-1-economy .luxury-down {
                height: 51%;
                width: 100%;
                bottom: 30%;
            }

            #g-o-1-premium .luxury-down {
                height: 51%;
                width: 100%;
                bottom: 30%;
            }

            #g-o-1-royal .luxury-down {
                height: 51%;
                width: 100%;
                bottom: 30%;
            }

            .seat {
                width: 25px;
                background: #fff;
                display: inline-flex;

                border: 1px solid #ccc;
                padding: 2px 0px;
                justify-content: center;
                align-items: center;
                font-size: 14px;
                cursor: pointer;
            }

            .seat:hover {
                background-color: aqua;
            }

            .seat.selected {
                background: #39b300;
            }

            .seat.booked {
                background: #b8b8b8 !important;
                cursor: not-allowed;
            }

            @media screen and (max-width: 575px) {
                #luxuryContainer {
                    width: 100% !important;
                }

                #g-o-1-economy {
                    width: 100% !important;
                }

                #g-o-1-premium {
                    width: 100% !important;
                }

                #g-o-1-royal {
                    width: 100% !important;
                }

                .seat {
                    font-size: 12px;
                }
            }

            @media screen and (max-width: 412px) {
                #luxuryContainer {
                    width: 100% !important;
                }

                #g-o-1-economy {
                    width: 100% !important;
                }

                #g-o-1-premium {
                    width: 100% !important;
                }

                #g-o-1-royal {
                    width: 100% !important;
                }

                .seat {
                    font-size: 12px;
                    width: 21px;
                }
            }


            /* Green Ocean Ship Design */
            #modalGreenOceanSeat .seat-layout .selected{
                background-color: #114e31;                
            }
            /* #modalGreenOceanSeat .available{
                background-color: #198754;                
            } */

        </style>
  {{-- <div class="text-center loaderDiv">
    <img src="{{ asset('assets/images/rudder.gif') }}" width="80">

    
</div> --}}

        {{-- ************** Seat Layout *************** --}}

        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Book Seat</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="">
                            <div class="row py-4">
                                <div class="col-4 d-flex justify-content-center">
                                    <div class="seat me-1"></div>
                                    <p class="m-0">Vaccant</p>
                                </div>
                                <div class="col-4 d-flex justify-content-center">
                                    <div class="seat selected me-1"></div>
                                    <p class="m-0">Selected</p>
                                </div>
                                <div class="col-4 d-flex justify-content-center">
                                    <div class="seat booked me-1"></div>
                                    <p class="m-0">Booked</p>
                                </div>
                            </div>
                        </div>
                        <div class="position-relative h-100 m-auto" id="luxuryContainer" style="width: 90%;">
                            <div class="position-absolute luxury-down">
                                <div class="position-relative h-100 " style="width: 90%; margin: 0px auto;">
                                    <div class="position-absolute " style="top: 1%;">
                                        <div><span class="seat luxury 2A">2A</span><span
                                                class="seat luxury 2B">2B</span><span class="seat luxury 2C">2C</span></div>
                                        <div><span class="seat luxury 3A">3A</span><span
                                                class="seat luxury 3B">3B</span><span class="seat luxury 3C">3C</span></div>
                                        <div><span class="seat luxury 4A">4A</span><span
                                                class="seat luxury 4B">4B</span><span class="seat luxury 4C">4C</span></div>
                                        <div><span class="seat luxury 5A">5A</span><span
                                                class="seat luxury 5B">5B</span><span class="seat luxury 5C">5C</span></div>
                                        <div><span class="seat luxury 6A">6A</span><span
                                                class="seat luxury 6B">6B</span><span class="seat luxury 6C">6C</span></div>
                                    </div>
                                    <div class="position-absolute end-0" style="top: 1%;">
                                        <div><span class="seat luxury 2J">2J</span><span
                                                class="seat luxury 2K">2K</span><span class="seat luxury 2L">2L</span></div>
                                        <div><span class="seat luxury 3J">3J</span><span
                                                class="seat luxury 3K">3K</span><span class="seat luxury 3L">3L</span></div>
                                        <div><span class="seat luxury 4J">4J</span><span
                                                class="seat luxury 4K">4K</span><span class="seat luxury 4L">4L</span></div>
                                        <div><span class="seat luxury 5J">5J</span><span
                                                class="seat luxury 5K">5K</span><span class="seat luxury 5L">5L</span></div>
                                        <div><span class="seat luxury 6J">6J</span><span
                                                class="seat luxury 6K">6K</span><span class="seat luxury 6L">6L</span></div>

                                    </div>
                                    <div class="position-absolute start-50 translate-middle-x " style="top: 0;">
                                        <div style="text-align: center;"><span class="seat luxury 1E">1E</span><span
                                                class="seat luxury 1F">1F</span><span class="seat luxury 1G">1G</span><span
                                                class="seat luxury 1H">1H</span><span class="seat luxury 1I">1I</span>
                                        </div>
                                        <div><span class="seat luxury 2D">2D</span><span
                                                class="seat luxury 2E">2E</span><span class="seat luxury 2F">2F</span><span
                                                class="seat luxury 2G">2G</span><span class="seat luxury 2H">2H</span><span
                                                class="seat luxury 2I">2I</span></div>
                                        <div><span class="seat luxury 3D">3D</span><span
                                                class="seat luxury 3E">3E</span><span class="seat luxury 3F">3F</span><span
                                                class="seat luxury 3G">3G</span><span class="seat luxury 3H">3H</span><span
                                                class="seat luxury 3I">3I</span></div>
                                        <div><span class="seat luxury 4D">4D</span><span
                                                class="seat luxury 4E">4E</span><span class="seat luxury 4F">4F</span><span
                                                class="seat luxury 4G">4G</span><span class="seat luxury 4H">4H</span><span
                                                class="seat luxury 4I">4I</span></div>
                                        <div><span class="seat luxury 5D">5D</span><span
                                                class="seat luxury 5E">5E</span><span class="seat luxury 5F">5F</span><span
                                                class="seat luxury 5G">5G</span><span class="seat luxury 5H">5H</span><span
                                                class="seat luxury 5I">5I</span></div>
                                        <div><span class="seat luxury 6D">6D</span><span
                                                class="seat luxury 6E">6E</span><span class="seat luxury 6F">6F</span><span
                                                class="seat luxury 6G">6G</span><span
                                                class="seat luxury 6H">6H</span><span class="seat luxury 6I">6I</span>
                                        </div>
                                        <div><span class="seat luxury 7D">7D</span><span
                                                class="seat luxury 7E">7E</span><span
                                                class="seat luxury 7F">7F</span><span
                                                class="seat luxury 7G">7G</span><span
                                                class="seat luxury 7H">7H</span><span class="seat luxury 7I">7I</span>
                                        </div>
                                    </div>


                                    <div class="position-absolute bottom-0">
                                        <div><span class="seat luxury 7A">7A</span><span
                                                class="seat luxury 7B">7B</span><span class="seat luxury 7C">7C</span>
                                        </div>
                                        <div><span class="seat luxury 8A">8A</span><span
                                                class="seat luxury 8B">8B</span><span class="seat luxury 8C">8C</span>
                                        </div>
                                        <div><span class="seat luxury 9A">9A</span><span
                                                class="seat luxury 9B">9B</span><span class="seat luxury 9C">9C</span>
                                        </div>
                                        <div><span class="seat luxury 10A">10A</span><span
                                                class="seat luxury 10B">10B</span><span class="seat luxury 10C">10C</span>
                                        </div>
                                        <div><span class="seat luxury 11A">11A</span><span
                                                class="seat luxury 11B">11B</span><span class="seat luxury 11C">11C</span>
                                        </div>
                                        <div><span class="seat luxury 12A">12A</span><span
                                                class="seat luxury 12B">12B</span><span class="seat luxury 12C">12C</span>
                                        </div>
                                        <div><span class="seat luxury 13A">13A</span><span
                                                class="seat luxury 13B">13B</span><span class="seat luxury 13C">13C</span>
                                        </div>
                                        <div><span class="seat luxury 14A">14A</span><span
                                                class="seat luxury 14B">14B</span><span class="seat luxury 14C">14C</span>
                                        </div>
                                        <div><span class="seat luxury 15A">15A</span><span
                                                class="seat luxury 15B">15B</span><span class="seat luxury 15C">15C</span>
                                        </div>
                                        <div><span class="seat luxury 16A">16A</span><span
                                                class="seat luxury 16B">16B</span><span class="seat luxury 16C">16C</span>
                                        </div>
                                        <div><span class="seat luxury 17A">17A</span><span
                                                class="seat luxury 17B">17B</span><span class="seat luxury 17C">17C</span>
                                        </div>

                                    </div>
                                    <div class="position-absolute start-50 translate-middle-x bottom-0">
                                        <div><span class="seat luxury 7D">7D</span><span
                                                class="seat luxury 7E">7E</span><span
                                                class="seat luxury 7F">7F</span><span
                                                class="seat luxury 7G">7G</span><span
                                                class="seat luxury 7H">7H</span><span class="seat luxury 7I">7I</span>
                                        </div>
                                        <div><span class="seat luxury 8D">8D</span><span
                                                class="seat luxury 8E">8E</span><span
                                                class="seat luxury 8F">8F</span><span
                                                class="seat luxury 8G">8G</span><span
                                                class="seat luxury 8H">8H</span><span class="seat luxury 8I">8I</span>
                                        </div>
                                        <div><span class="seat luxury 9D">9D</span><span
                                                class="seat luxury 9E">9E</span><span
                                                class="seat luxury 9F">9F</span><span
                                                class="seat luxury 9G">9G</span><span
                                                class="seat luxury 9H">9H</span><span class="seat luxury 9I">9I</span>
                                        </div>
                                        <div><span class="seat luxury 10D">10D</span><span
                                                class="seat luxury 10E">10E</span><span
                                                class="seat luxury 10F">10F</span><span
                                                class="seat luxury 10G">10G</span><span
                                                class="seat luxury 10H">10H</span><span class="seat luxury 10I">10I</span>
                                        </div>
                                        <div><span class="seat luxury 11D">11D</span><span
                                                class="seat luxury 11E">11E</span><span
                                                class="seat luxury 11F">11F</span><span
                                                class="seat luxury 11G">11G</span><span
                                                class="seat luxury 11H">11H</span><span class="seat luxury 11I">11I</span>
                                        </div>
                                        <div><span class="seat luxury 12D">12D</span><span
                                                class="seat luxury 12E">12E</span><span
                                                class="seat luxury 12F">12F</span><span
                                                class="seat luxury 12G">12G</span><span
                                                class="seat luxury 12H">12H</span><span class="seat luxury 12I">12I</span>
                                        </div>
                                        <div><span class="seat luxury 13D">13D</span><span
                                                class="seat luxury 13E">13E</span><span
                                                class="seat luxury 13F">13F</span><span
                                                class="seat luxury 13G">13G</span><span
                                                class="seat luxury 13H">13H</span><span class="seat luxury 13I">13I</span>
                                        </div>
                                        <div><span class="seat luxury 14D">14D</span><span
                                                class="seat luxury 14E">14E</span><span
                                                class="seat luxury 14F">14F</span><span
                                                class="seat luxury 14G">14G</span><span
                                                class="seat luxury 14H">14H</span><span class="seat luxury 14I">14I</span>
                                        </div>
                                        <div><span class="seat luxury 15D">15D</span><span
                                                class="seat luxury 15E">15E</span><span
                                                class="seat luxury 15F">15F</span><span
                                                class="seat luxury 15G">15G</span><span
                                                class="seat luxury 15H">15H</span><span class="seat luxury 15I">15I</span>
                                        </div>
                                        <div><span class="seat luxury 16D">16D</span><span
                                                class="seat luxury 16E">16E</span><span
                                                class="seat luxury 16F">16F</span><span
                                                class="seat luxury 16G">16G</span><span
                                                class="seat luxury 16H">16H</span><span class="seat luxury 16I">16I</span>
                                        </div>
                                        <div class="text-center"><span class="seat luxury 17E">17E</span><span
                                                class="seat luxury 17F">17F</span><span
                                                class="seat luxury 17G">17G</span><span
                                                class="seat luxury 17H">17H</span><span class="seat luxury 17I">17I</span>
                                        </div>

                                    </div>
                                    <div class="position-absolute end-0 bottom-0">
                                        <div><span class="seat luxury 7J">7J</span><span
                                                class="seat luxury 7K">7K</span><span class="seat luxury 7L">7L</span>
                                        </div>
                                        <div><span class="seat luxury 8J">8J</span><span
                                                class="seat luxury 8K">8K</span><span class="seat luxury 8L">8L</span>
                                        </div>
                                        <div><span class="seat luxury 9J">9J</span><span
                                                class="seat luxury 9K">9K</span><span class="seat luxury 9L">9L</span>
                                        </div>
                                        <div><span class="seat luxury 9J">9J</span><span
                                                class="seat luxury 9K">9K</span><span class="seat luxury 9L">9L</span>
                                        </div>
                                        <div><span class="seat luxury 10J">10J</span><span
                                                class="seat luxury 10K">10K</span><span class="seat luxury 10L">10L</span>
                                        </div>
                                        <div><span class="seat luxury 11J">11J</span><span
                                                class="seat luxury 11K">11K</span><span class="seat luxury 11L">11L</span>
                                        </div>
                                        <div><span class="seat luxury 12J">12J</span><span
                                                class="seat luxury 12K">12K</span><span class="seat luxury 12L">12L</span>
                                        </div>
                                        <div><span class="seat luxury 13J">13J</span><span
                                                class="seat luxury 13K">13K</span><span class="seat luxury 13L">13L</span>
                                        </div>
                                        <div><span class="seat luxury 14J">14J</span><span
                                                class="seat luxury 14K">14K</span><span class="seat luxury 14L">14L</span>
                                        </div>
                                        <div><span class="seat luxury 15J">15J</span><span
                                                class="seat luxury 15K">15K</span><span class="seat luxury 15L">15L</span>
                                        </div>
                                        <div><span class="seat luxury 16J">16J</span><span
                                                class="seat luxury 16K">16K</span><span class="seat luxury 16L">16L</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <img src="{{ url('images/nautika-luxury.png') }}" alt="" width="100%"
                                height="1100px">
                        </div>

                        <div class="position-relative h-100 m-auto" id="royalContainer" style="width: 90%;">
                            <div class="position-absolute luxury-down">
                                <div class="position-relative h-100 " style="width: 82%; margin: 0px auto;">

                                    <div class="position-absolute bottom-0">
                                        <div><span class="seat royal 1A">1A</span><span class="seat royal 1B">1B</span>
                                        </div>
                                        <div><span class="seat royal 2A">2A</span><span class="seat royal 2B">2B</span>
                                        </div>
                                        <div><span class="seat royal 3A">3A</span><span class="seat royal 3B">3B</span>
                                        </div>
                                        <div><span class="seat royal 4A">4A</span><span class="seat royal 4B">4B</span>
                                        </div>
                                        <div><span class="seat royal 5A">5A</span><span class="seat royal 5B">5B</span>
                                        </div>
                                        <div><span class="seat royal 6A">6A</span><span class="seat royal 6B">6B</span>
                                        </div>
                                        <div><span class="seat royal 7A">7A</span><span class="seat royal 7B">7B</span>
                                        </div>
                                        <div><span class="seat royal 8A">8A</span><span class="seat royal 8B">8B</span>
                                        </div>
                                        <div><span class="seat royal 9A">9A</span><span class="seat royal 9B">9B</span>
                                        </div>
                                        <div><span class="seat royal 10A">10A</span><span
                                                class="seat royal 10B">10B</span></div>
                                        <div><span class="seat royal 11A">11A</span><span
                                                class="seat royal 11B">11B</span></div>
                                        <div><span class="seat royal 12A">12A</span><span
                                                class="seat royal 12B">12B</span></div>
                                    </div>
                                    <div class="position-absolute start-50 translate-middle-x bottom-0">
                                        <div><span class="seat royal 5C">5C</span><span
                                                class="seat royal 5D">5D</span><span class="seat royal 5E">5E</span><span
                                                class="seat royal 5F">5F</span><span class="seat royal 5G">5G</span><span
                                                class="seat royal 5H">5H</span></div>
                                        <div><span class="seat royal 6C">6C</span><span
                                                class="seat royal 6D">6D</span><span class="seat royal 6E">6E</span><span
                                                class="seat royal 6F">6F</span><span class="seat royal 6G">6G</span><span
                                                class="seat royal 6H">6H</span></div>
                                        <div><span class="seat royal 7C">7C</span><span
                                                class="seat royal 7D">7D</span><span class="seat royal 7E">7E</span><span
                                                class="seat royal 7F">7F</span><span class="seat royal 7G">7G</span><span
                                                class="seat royal 7H">7H</span></div>
                                        <div><span class="seat royal 8C">8C</span><span
                                                class="seat royal 8D">8D</span><span class="seat royal 8E">8E</span><span
                                                class="seat royal 8F">8F</span><span class="seat royal 8G">8G</span><span
                                                class="seat royal 8H">8H</span></div>
                                        <div><span class="seat royal 5C">5C</span><span
                                                class="seat royal 9D">9D</span><span class="seat royal 9E">9E</span><span
                                                class="seat royal 9F">9F</span><span class="seat royal 9G">9G</span><span
                                                class="seat royal 9H">9H</span></div>
                                        <div><span class="seat royal 10C">10C</span><span
                                                class="seat royal 10D">10D</span><span
                                                class="seat royal 10E">10E</span><span
                                                class="seat royal 10F">10F</span><span
                                                class="seat royal 10G">10G</span><span class="seat royal 10H">10H</span>
                                        </div>
                                        <div><span class="seat royal 11C">11C</span><span
                                                class="seat royal 11D">11D</span><span
                                                class="seat royal 11E">11E</span><span
                                                class="seat royal 11F">11F</span><span
                                                class="seat royal 11G">11G</span><span class="seat royal 10H">10H</span>
                                        </div>
                                    </div>
                                    <div class="position-absolute bottom-0 text-end end-0">
                                        <div><span class="seat royal 1I">1I</span><span
                                                class="seat royal 1J">1J</span><span class="seat royal 1K">1K</span></div>
                                        <div><span class="seat royal 2I">2I</span><span
                                                class="seat royal 2J">2J</span><span class="seat royal 2K">2K</span></div>
                                        <div><span class="seat royal 3J">3J</span><span class="seat royal 3K">3K</span>
                                        </div>
                                        <div><span class="seat royal 4J">4J</span><span class="seat royal 4K">4K</span>
                                        </div>
                                        <div><span class="seat royal 5J">5J</span><span class="seat royal 5K">5K</span>
                                        </div>
                                        <div><span class="seat royal 6J">6J</span><span class="seat royal 6K">6K</span>
                                        </div>
                                        <div><span class="seat royal 7J">7J</span><span class="seat royal 7K">7K</span>
                                        </div>
                                        <div><span class="seat royal 8J">8J</span><span class="seat royal 8K">8K</span>
                                        </div>
                                        <div><span class="seat royal 9J">9J</span><span class="seat royal 9K">9K</span>
                                        </div>
                                        <div><span class="seat royal 10J">10J</span><span
                                                class="seat royal 10K">10K</span></div>
                                        <div><span class="seat royal 11J">11J</span><span
                                                class="seat royal 11K">11K</span></div>
                                        <div><span class="seat royal 12J">12J</span><span
                                                class="seat royal 12K">12K</span></div>
                                    </div>
                                </div>
                            </div>
                            <img src="{{ url('images/nautika-royal.png') }}" alt="" width="100%"
                                height="1150px">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" id="nautika_proceed"
                            class="btn btn-primary">Proceed</button> -->
                        <button type="button" id="confirm_seats"
                            class="btn btn-primary">Proceed</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================== Green Ocean 1 Modal ============================== --}}
        <div class="modal modal-xl fade" id="modalGreenOceanSeat" tabindex="-1" aria-labelledby="modalGreenOceanSeatLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalGreenOceanSeatLabel">Book Seat</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="">
                            <div class="row py-4">
                                <div class="col-4 d-flex justify-content-center">
                                    <div class="seat me-1"></div>
                                    <p class="m-0">Vaccant</p>
                                </div>
                                <div class="col-4 d-flex justify-content-center">
                                    <div class="seat selected me-1"></div>
                                    <p class="m-0">Selected</p>
                                </div>
                                <div class="col-4 d-flex justify-content-center">
                                    <div class="seat booked me-1"></div>
                                    <p class="m-0">Booked</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="seat-layout"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="confirm_seats"
                            class="btn btn-primary">Proceed</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================== Green Ocean 2 Modal ============================== --}}
        <div class="modal fade" id="exampleModalGreenOcean2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Book Seat</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="">
                            <div class="row py-4">
                                <div class="col-4 d-flex justify-content-center">
                                    <div class="seat me-1"></div>
                                    <p class="m-0">Vaccant</p>
                                </div>
                                <div class="col-4 d-flex justify-content-center">
                                    <div class="seat selected me-1"></div>
                                    <p class="m-0">Selected</p>
                                </div>
                                <div class="col-4 d-flex justify-content-center">
                                    <div class="seat booked me-1"></div>
                                    <p class="m-0">Booked</p>
                                </div>
                            </div>
                        </div>
                        <div class="position-relative h-100 m-auto" id="g-o-2-premium" style="width: 90%;">
                            <div class="position-absolute luxury-down">
                                <div class="position-relative h-100 " style="width: 82%; margin: 0px auto;">

                                    <div class="position-absolute bottom-0">
                                        <div><span class="seat royal 1A">1A</span><span class="seat royal 1B">1B</span>
                                        </div>
                                        <div><span class="seat royal 2A">2A</span><span class="seat royal 2B">2B</span>
                                        </div>
                                        <div><span class="seat royal 3A">3A</span><span class="seat royal 3B">3B</span>
                                        </div>
                                        <div><span class="seat royal 4A">4A</span><span class="seat royal 4B">4B</span>
                                        </div>
                                        <div><span class="seat royal 5A">5A</span><span class="seat royal 5B">5B</span>
                                        </div>
                                        <div><span class="seat royal 6A">6A</span><span class="seat royal 6B">6B</span>
                                        </div>
                                        <div><span class="seat royal 7A">7A</span><span class="seat royal 7B">7B</span>
                                        </div>
                                        <div><span class="seat royal 8A">8A</span><span class="seat royal 8B">8B</span>
                                        </div>
                                        <div><span class="seat royal 9A">9A</span><span class="seat royal 9B">9B</span>
                                        </div>
                                        <div><span class="seat royal 10A">10A</span><span
                                                class="seat royal 10B">10B</span></div>
                                        <div><span class="seat royal 11A">11A</span><span
                                                class="seat royal 11B">11B</span></div>
                                        <div><span class="seat royal 12A">12A</span><span
                                                class="seat royal 12B">12B</span></div>
                                    </div>
                                    <div class="position-absolute start-50 translate-middle-x bottom-0">
                                        <div><span class="seat royal 5C">5C</span><span
                                                class="seat royal 5D">5D</span><span class="seat royal 5E">5E</span><span
                                                class="seat royal 5F">5F</span><span class="seat royal 5G">5G</span><span
                                                class="seat royal 5H">5H</span></div>
                                        <div><span class="seat royal 6C">6C</span><span
                                                class="seat royal 6D">6D</span><span class="seat royal 6E">6E</span><span
                                                class="seat royal 6F">6F</span><span class="seat royal 6G">6G</span><span
                                                class="seat royal 6H">6H</span></div>
                                        <div><span class="seat royal 7C">7C</span><span
                                                class="seat royal 7D">7D</span><span class="seat royal 7E">7E</span><span
                                                class="seat royal 7F">7F</span><span class="seat royal 7G">7G</span><span
                                                class="seat royal 7H">7H</span></div>
                                        <div><span class="seat royal 8C">8C</span><span
                                                class="seat royal 8D">8D</span><span class="seat royal 8E">8E</span><span
                                                class="seat royal 8F">8F</span><span class="seat royal 8G">8G</span><span
                                                class="seat royal 8H">8H</span></div>
                                        <div><span class="seat royal 5C">5C</span><span
                                                class="seat royal 9D">9D</span><span class="seat royal 9E">9E</span><span
                                                class="seat royal 9F">9F</span><span class="seat royal 9G">9G</span><span
                                                class="seat royal 9H">9H</span></div>
                                        <div><span class="seat royal 10C">10C</span><span
                                                class="seat royal 10D">10D</span><span
                                                class="seat royal 10E">10E</span><span
                                                class="seat royal 10F">10F</span><span
                                                class="seat royal 10G">10G</span><span class="seat royal 10H">10H</span>
                                        </div>
                                        <div><span class="seat royal 11C">11C</span><span
                                                class="seat royal 11D">11D</span><span
                                                class="seat royal 11E">11E</span><span
                                                class="seat royal 11F">11F</span><span
                                                class="seat royal 11G">11G</span><span class="seat royal 10H">10H</span>
                                        </div>
                                    </div>
                                    <div class="position-absolute bottom-0 text-end end-0">
                                        <div><span class="seat royal 1I">1I</span><span
                                                class="seat royal 1J">1J</span><span class="seat royal 1K">1K</span></div>
                                        <div><span class="seat royal 2I">2I</span><span
                                                class="seat royal 2J">2J</span><span class="seat royal 2K">2K</span></div>
                                        <div><span class="seat royal 3J">3J</span><span class="seat royal 3K">3K</span>
                                        </div>
                                        <div><span class="seat royal 4J">4J</span><span class="seat royal 4K">4K</span>
                                        </div>
                                        <div><span class="seat royal 5J">5J</span><span class="seat royal 5K">5K</span>
                                        </div>
                                        <div><span class="seat royal 6J">6J</span><span class="seat royal 6K">6K</span>
                                        </div>
                                        <div><span class="seat royal 7J">7J</span><span class="seat royal 7K">7K</span>
                                        </div>
                                        <div><span class="seat royal 8J">8J</span><span class="seat royal 8K">8K</span>
                                        </div>
                                        <div><span class="seat royal 9J">9J</span><span class="seat royal 9K">9K</span>
                                        </div>
                                        <div><span class="seat royal 10J">10J</span><span
                                                class="seat royal 10K">10K</span></div>
                                        <div><span class="seat royal 11J">11J</span><span
                                                class="seat royal 11K">11K</span></div>
                                        <div><span class="seat royal 12J">12J</span><span
                                                class="seat royal 12K">12K</span></div>
                                    </div>
                                </div>
                            </div>
                            <img src="" alt="" width="100%"
                                height="1150px">
                        </div>

                        <div class="position-relative h-100 m-auto" id="g-o-2-royal" style="width: 90%;">
                            <div class="position-absolute luxury-down">
                                <div class="position-relative h-100 " style="width: 82%; margin: 0px auto;">

                                    <div class="position-absolute bottom-0">
                                        <div><span class="seat royal 1A">1A</span><span class="seat royal 1B">1B</span>
                                        </div>
                                        <div><span class="seat royal 2A">2A</span><span class="seat royal 2B">2B</span>
                                        </div>
                                        <div><span class="seat royal 3A">3A</span><span class="seat royal 3B">3B</span>
                                        </div>
                                        <div><span class="seat royal 4A">4A</span><span class="seat royal 4B">4B</span>
                                        </div>
                                        <div><span class="seat royal 5A">5A</span><span class="seat royal 5B">5B</span>
                                        </div>
                                        <div><span class="seat royal 6A">6A</span><span class="seat royal 6B">6B</span>
                                        </div>
                                        <div><span class="seat royal 7A">7A</span><span class="seat royal 7B">7B</span>
                                        </div>
                                        <div><span class="seat royal 8A">8A</span><span class="seat royal 8B">8B</span>
                                        </div>
                                        <div><span class="seat royal 9A">9A</span><span class="seat royal 9B">9B</span>
                                        </div>
                                        <div><span class="seat royal 10A">10A</span><span
                                                class="seat royal 10B">10B</span></div>
                                        <div><span class="seat royal 11A">11A</span><span
                                                class="seat royal 11B">11B</span></div>
                                        <div><span class="seat royal 12A">12A</span><span
                                                class="seat royal 12B">12B</span></div>
                                    </div>
                                    <div class="position-absolute start-50 translate-middle-x bottom-0">
                                        <div><span class="seat royal 5C">5C</span><span
                                                class="seat royal 5D">5D</span><span class="seat royal 5E">5E</span><span
                                                class="seat royal 5F">5F</span><span class="seat royal 5G">5G</span><span
                                                class="seat royal 5H">5H</span></div>
                                        <div><span class="seat royal 6C">6C</span><span
                                                class="seat royal 6D">6D</span><span class="seat royal 6E">6E</span><span
                                                class="seat royal 6F">6F</span><span class="seat royal 6G">6G</span><span
                                                class="seat royal 6H">6H</span></div>
                                        <div><span class="seat royal 7C">7C</span><span
                                                class="seat royal 7D">7D</span><span class="seat royal 7E">7E</span><span
                                                class="seat royal 7F">7F</span><span class="seat royal 7G">7G</span><span
                                                class="seat royal 7H">7H</span></div>
                                        <div><span class="seat royal 8C">8C</span><span
                                                class="seat royal 8D">8D</span><span class="seat royal 8E">8E</span><span
                                                class="seat royal 8F">8F</span><span class="seat royal 8G">8G</span><span
                                                class="seat royal 8H">8H</span></div>
                                        <div><span class="seat royal 5C">5C</span><span
                                                class="seat royal 9D">9D</span><span class="seat royal 9E">9E</span><span
                                                class="seat royal 9F">9F</span><span class="seat royal 9G">9G</span><span
                                                class="seat royal 9H">9H</span></div>
                                        <div><span class="seat royal 10C">10C</span><span
                                                class="seat royal 10D">10D</span><span
                                                class="seat royal 10E">10E</span><span
                                                class="seat royal 10F">10F</span><span
                                                class="seat royal 10G">10G</span><span class="seat royal 10H">10H</span>
                                        </div>
                                        <div><span class="seat royal 11C">11C</span><span
                                                class="seat royal 11D">11D</span><span
                                                class="seat royal 11E">11E</span><span
                                                class="seat royal 11F">11F</span><span
                                                class="seat royal 11G">11G</span><span class="seat royal 10H">10H</span>
                                        </div>
                                    </div>
                                    <div class="position-absolute bottom-0 text-end end-0">
                                        <div><span class="seat royal 1I">1I</span><span
                                                class="seat royal 1J">1J</span><span class="seat royal 1K">1K</span></div>
                                        <div><span class="seat royal 2I">2I</span><span
                                                class="seat royal 2J">2J</span><span class="seat royal 2K">2K</span></div>
                                        <div><span class="seat royal 3J">3J</span><span class="seat royal 3K">3K</span>
                                        </div>
                                        <div><span class="seat royal 4J">4J</span><span class="seat royal 4K">4K</span>
                                        </div>
                                        <div><span class="seat royal 5J">5J</span><span class="seat royal 5K">5K</span>
                                        </div>
                                        <div><span class="seat royal 6J">6J</span><span class="seat royal 6K">6K</span>
                                        </div>
                                        <div><span class="seat royal 7J">7J</span><span class="seat royal 7K">7K</span>
                                        </div>
                                        <div><span class="seat royal 8J">8J</span><span class="seat royal 8K">8K</span>
                                        </div>
                                        <div><span class="seat royal 9J">9J</span><span class="seat royal 9K">9K</span>
                                        </div>
                                        <div><span class="seat royal 10J">10J</span><span
                                                class="seat royal 10K">10K</span></div>
                                        <div><span class="seat royal 11J">11J</span><span
                                                class="seat royal 11K">11K</span></div>
                                        <div><span class="seat royal 12J">12J</span><span
                                                class="seat royal 12K">12K</span></div>
                                    </div>
                                </div>
                            </div>
                            <img src="" alt="" width="100%"
                                height="1150px">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" id="nautika_proceed"
                            class="btn btn-primary">Proceed</button> -->
                        <button type="button" id="confirm_seats"
                            class="btn btn-primary">Proceed</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- **************End seat selection  *************** --}}

        <section class="search-banner">
                <div class="container">
                    <div class="bookingConsole ">
                        <div class="tabBtns  d-flex align-items-center">
                            <div class="d-flex align-items-start tabBtn tabBtn1 {{ request('trip_type') == 1 ? 'active' : '' }}"
                                id="one-way" data-list="1">
                                <img src="images/one-way-inactive.png" class="icon-inactive" alt="">
                                <img src="images/one-way-active.png" class="icon-active" alt="">
                                <p class="mb-0 ms-2">One Way</p>
                            </div>
                            <div class="d-flex align-items-center tabBtn tabBtn2 {{ request('trip_type') > 1 ? 'active' : '' }}"
                                data-list="2" id="round-trip">
                                <img src="images/return-inactive.png" class="icon-inactive" alt="">
                                <img src="images/return-active.png" class="icon-active" alt="">
                                <p class="mb-0 ms-2">Round Trip</p>
                            </div>
                        </div>

                        <form
                            action="{{ route('search-result-ferry', ['form_location' => request('form_location'), 'to_location' => request('to_location'), 'date' => request('date'), 'passenger' => request('passenger'), 'infant' => request('infant')]) }}"
                            method="GET">
                            <input type="hidden" name="trip_type" id="trip_type" value="1">

                            <div class="position-relative tabContainer">
                                <div class="tabs tabs1 mx-0 ferry-search-bar" {{ request('trip_type') == 1 ? 'active' : '' }}>
                                <div class="row mb-3">
                                    <div class="col-12 col-lg-3 mb-2">
                                        <label for="form_location">From</label>
                                        <select name="form_location" class="form-select border-0 p-0" id="form_location">
                                            @foreach ($ferry_locations as $ferry_location)
                                                <option value="{{ $ferry_location->id }}"
                                                    {{ old('form_location', request('form_location')) == $ferry_location->id ? 'selected' : '' }}>
                                                    {{ $ferry_location->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-3 mb-2">
                                        <label for="to_location">To</label>
                                        <select name="to_location" class="form-select border-0 p-0" id="to_location">
                                            @foreach ($ferry_locations as $ferry_location)
                                                <option value="{{ $ferry_location->id }}"
                                                    {{ old('to_location', request('to_location')) == $ferry_location->id ? 'selected' : '' }}>
                                                    {{ $ferry_location->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-2 mb-2">
                                        <label for="date">Date</label>
                                        <input type="date" placeholder="Select Date" id="date" name="date"
                                            min="<?php echo date('d-m-Y'); ?>" value="{{ old('date', request('date')) }}">
                                    </div>
                                    <div class="col-12 col-lg-2 mb-2">
                                        <label for="passenger">Passengers</label>
                                        <input type="number" class="form-control" id="passenger" name="passenger"
                                            value="{{ old('passenger', request('passenger')) }}"
                                            onkeyup="maxpassenger(this)" required>
                                    </div>
                                    <div class="col-12 col-lg-2">
                                        <label for="infant">Infants</label>
                                        <input type="number" class="form-control" id="infant" name="infant"
                                            value="{{ old('infant', request('infant')) }}"
                                            oninput="this.value = this.value.replace(/[^0-8]/g, '').slice(0, 1);" required>
                                    </div>
                                    </div>

                                    <div class="row search-bar-btn">
                                    <div class="col-12 col-lg-2">
                                        <button class="btn button w-100" id="search"><i class="bi bi-search"></i>
                                            Search</button>
                                    </div>
                                    </div>
                                </div>

                                <div class="tabs tabs2 row mx-0 {{ request('trip_type') > 1 ? 'active' : '' }}">
                                    <div class="row trop-relative p-0">
                                    <div class="mb-visible">
                                <div class="row trip-section my-3">
                                <div class="col-12 trip-name p-0">Trip 1</div>
                                </div>
                            </div>
                                        <div class="col-12 col-lg-3 mb-2 mb-lg-0">
                                            <label for="location">From</label>
                                            <select name="form_location" class="form-select border-0 p-0"
                                                id="form_location">
                                                @foreach ($ferry_locations as $index => $ferry_location)
                                                    <option value="{{ $ferry_location->id }}"
                                                        {{ old('form_location', request('form_location')) == $ferry_location->id ? 'selected' : '' }}>
                                                        {{ $ferry_location->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-3 mb-2 mb-lg-0">
                                            <label for="to_location">To</label>
                                            <select name="to_location" class="form-select border-0 p-0" id="to_location">

                                                @foreach ($ferry_locations as $index => $ferry_location)
                                                    <option value="{{ $ferry_location->id }}"
                                                        {{ old('to_location', request('to_location')) == $ferry_location->id ? 'selected' : '' }}>
                                                        {{ $ferry_location->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-3 mb-2 mb-lg-0">
                                            <label for="date">Date</label>
                                            <input type="date" class="my_date_picker" placeholder="Select Date"
                                                id="round_date" name="date" min="<?php echo date('Y-m-d'); ?>"
                                                value="{{ old('date', request('date')) }}">
                                        </div>

                                        <div class="col-12 col-lg-1 mb-2 mb-lg-0">
                                            <label for="passenger">Passengers</label>
                                            <input type="number" class="form-control" id="passenger" name="passenger"
                                                value="{{ old('passenger', request('passenger')) }}"
                                                onkeyup="maxpassenger(this)" required>
                                        </div>

                                        <div class="col-12 col-lg-1 mb-2 mb-lg-0">
                                            <label for="infant">Infants</label>
                                            <input type="number" class="form-control" id="infant" name="infant"
                                                value="{{ old('infant', request('infant')) }}"
                                                oninput="this.value = this.value.replace(/[^1-8]/g, '').slice(0, 1);"
                                                required>
                                        </div>
                                        {{-- <input type="hidden" name="trip_type" value="single_trip"> --}}


                                    </div>

                                    <div class="row py-lg-3 py-0 trop-relative p-0">
                                    <div class="mb-visible">
                                <div class="row trip-section my-3">
                                <div class="col-12 trip-name p-0">Trip 2</div>
                                </div>
                            </div>
                                        <div class="col-12 col-lg-3 mb-2 mb-lg-0">
                                            <label for="location">From</label>
                                            <select name="round1_from_location" class="form-select border-0 p-0"
                                                id="round1_from_location">
                                                @foreach ($ferry_locations as $index => $ferry_location)
                                                    <option value="{{ $ferry_location->id }}"
                                                        {{ old('round1_from_location', request('round1_from_location')) == $ferry_location->id ? 'selected' : '' }}>
                                                        {{ $ferry_location->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-3 mb-2 mb-lg-0">
                                            <label for="location">To</label>
                                            <select name="round1_to_location" class="form-select border-0 p-0"
                                                id="round1_to_location">

                                                @foreach ($ferry_locations as $index => $ferry_location)
                                                    <option value="{{ $ferry_location->id }}"
                                                        {{ old('round1_to_location', request('round1_to_location')) == $ferry_location->id ? 'selected' : '' }}>
                                                        {{ $ferry_location->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-3 mb-2 mb-lg-0">
                                            <label for="date">Date</label>
                                            <input type="date" class="my_date_picker" placeholder="Select Date"
                                                id="round1_date" name="round1_date" min="<?php echo date('Y-m-d'); ?>"
                                                value="{{ old('round1_date', request('round1_date')) }}" required>
                                        </div>

                                        <div class="col-12 col-lg-1 mb-2 mb-lg-0">
                                            <label for="location">Passengers</label>
                                            <input type="number" class="form-control bg-secondary" id="round1_pasanger"
                                                value="{{ old('passenger', request('passenger')) }}" readonly>
                                        </div>

                                        <div class="col-12 col-lg-1 mb-2 mb-lg-0">
                                            <label for="location">Infants</label>
                                            <input type="number" class="form-control bg-secondary" id="round1_infant"
                                                value="{{ old('infant', request('infant')) }}"
                                                oninput="this.value = this.value.replace(/[^1-8]/g, '').slice(0, 1);"
                                                readonly>
                                        </div>

                                        {{-- <input type="hidden" name="trip_type" value="round1_trip"> --}}

                                        <div class="col-12 col-lg-1 mb-2 mb-lg-0 table-delet-btn">
                                            <button type="button" class="btn btn-outline-danger trip-delete delete"><i
                                                    class="bi bi-trash3-fill"></i></button>
                                        </div>
                                    </div>

                                    <div class="row trop-relative p-0">
                                    <div class="mb-visible">
                                <div class="row trip-section my-3">
                                <div class="col-12 trip-name p-0">Trip 3</div>
                                </div>
                            </div>
                                        <div class="col-12 col-lg-3 mb-2 mb-lg-0">
                                            <label for="location">From</label>
                                            <select name="round2_from_location" class="form-select border-0 p-0"
                                                id="round2_from_location">
                                                {{-- <option value="">Select</option> --}}
                                                @foreach ($ferry_locations as $index => $ferry_location)
                                                    <option value="{{ $ferry_location->id }}"
                                                        {{ old('round2_from_location', request('round2_from_location')) == $ferry_location->id ? 'selected' : '' }}>
                                                        {{ $ferry_location->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-3 mb-2 mb-lg-0">
                                            <label for="round2_to_location">To</label>
                                            <select name="round2_to_location" class="form-select border-0 p-0"
                                                id="round2_to_location">
                                                @foreach ($ferry_locations as $index => $ferry_location)
                                                    <option value="{{ $ferry_location->id }}"
                                                        {{ old('round2_to_location', request('round2_to_location')) == $ferry_location->id ? 'selected' : '' }}>
                                                        {{ $ferry_location->title }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="col-12 col-lg-3 mb-2 mb-lg-0">
                                            <label for="round2_date">Date</label>
                                            <input type="date" class="my_date_picker" placeholder="Select Date"
                                                id="round2_date" name="round2_date" min="<?php echo date('Y-m-d'); ?>"
                                                value="{{ old('round2_date', request('round2_date')) }}" required>
                                        </div>

                                        <div class="col-12 col-lg-1 mb-2 mb-lg-0">
                                            <label for="round2_pasanger">Passengers</label>
                                            <input type="number" class="form-control bg-secondary" id="round2_pasanger"
                                                value="{{ old('passenger', request('passenger')) }}" readonly>
                                        </div>

                                        <div class="col-12 col-lg-1 mb-2 mb-lg-0">
                                            <label for="round2_infants">Infants</label>
                                            <input type="number" class="form-control bg-secondary" id="round2_infants"
                                                value="{{ old('infant', request('infant')) }}" readonly>
                                        </div>
                                        {{-- <input type="hidden" name="trip_type" value="round2_trip"> --}}

                                        <div class="col-12 col-lg-1 mb-2 mb-lg-0 table-delet-btn">
                                            <button type="button" class="btn btn-outline-danger trip-delete delete"><i
                                                    class="bi bi-trash3-fill"></i></button>
                                        </div>
                                        
                                    </div>

                                    <div class="row search-bar-btn pt-0 pt-lg-4">
                                    <div class="col-12 col-lg-2">
                                            <button class="btn button w-100" id="search"><i class="bi bi-search"></i>
                                                Search</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </section>

        <input type="hidden" name="trip1details" id="trip1details" value="">
        <input type="hidden" name="trip2details" id="trip2details" value="">
        <input type="hidden" name="trip3details" id="trip3details" value="">
        <input type="hidden" name="trip1seatcount" id="trip1seatcount" value="0">
        <input type="hidden" name="trip2seatcount" id="trip2seatcount" value="0">
        <input type="hidden" name="trip3seatcount" id="trip3seatcount" value="0">
        <input type="hidden" name="trip1seatNo" id="trip1seatNo" value="">
        <input type="hidden" name="trip2seatNo" id="trip2seatNo" value="">
        <input type="hidden" name="trip3seatNo" id="trip3seatNo" value="">

        <div class="text-center  loaderDiv" >
            <div id="lds-spinner" class="lds-spinner d-none">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>

        <section class="mt-5 pt-3 searchResultsPage" id="searchResultsPage">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-12 col-md-12">
                        <div class="row secHead mb-4">
                            <div class="col-12 text-center">
                                <h2>Search Results For Ferry</h2>
                            </div>
                        </div>
                        <div class="route row px-2">
                            <div class="col-12">
                                <nav class=" mb-3 tabNav ">
                                    <div class="row w-100 m-0 nav nav-tabs  justify-content-center border-0" id="nav-tab" role="tablist">
                                        <button class="nav-link  active col-4 border-0 " id="nav-profile-tab"
                                            data-bs-toggle="tab" data-bs-target="#nav-profile" type="button"
                                            role="tab" aria-controls="nav-profile" aria-selected="false"
                                            tabindex="-1">{{ $route_titles['from_location'] }} -
                                            {{ $route_titles['to_location'] }}
                                        </button>

                                        @if (!empty($round1_route_titles))
                                            <button class="nav-link  col-4 border-0 " id="nav-contact-tab"
                                                data-bs-toggle="tab" data-bs-target="#nav-contact" type="button"
                                                role="tab" aria-controls="nav-contact"
                                                aria-selected="true" disabled >{{ $round1_route_titles['from_location'] }} -
                                                {{ $round1_route_titles['to_location'] }}
                                            </button>
                                        @endif

                                        @if (!empty($round2_route_titles))
                                            <button class="nav-link  col-4 border-0 " id="nav-extra-tab"
                                                data-bs-toggle="tab" data-bs-target="#nav-extra" type="button"
                                                role="tab" aria-controls="nav-extra"
                                                aria-selected="true" disabled>{{ $round2_route_titles['from_location'] }} -
                                                {{ $round2_route_titles['to_location'] }}
                                            </button>
                                        @endif
                                    </div>
                                </nav>
                            </div>
                            <div class="col-12">
                                <div class="tab-content  border bg-transparent border-0" id="nav-tabContent">
                                    <div class="tab-pane fade active show " id="nav-profile" role="tabpanel"
                                        aria-labelledby="nav-profile-tab">
                                        <div class="row">
                                            <div class="col-12 searchResults px-0">
                                                @if (isset($apiScheduleData))
                                                    @foreach ($apiScheduleData as $key => $shipSchedule)
                                                        @if ($shipSchedule['ship_name'] == 'Nautika')
                                                            <div class="ferryCard ferrySearch mb-3">
                                                                <div class="ferryImg"
                                                                    data-ferry-id="{{ $shipSchedule['id'] }}">

                                                                    {{-- <img src="{{url($shipSchedule['ship_image']) }}" alt="" style="width:240px"> --}}
                                                                    <img src="{{ env('UPLOADED_ASSETS') . $shipSchedule['ship_image'] }}"
                                                                        alt="" style="">
                                                                </div>
                                                                <div class="ferryDetails ms-3 ">
                                                                    <div class="ferryName">
                                                                        <h4 class="mb-3">
                                                                            {{ $shipSchedule['ship_name'] }}
                                                                        </h4>
                                                                        <p class="mb-3">
                                                                            Departure Time
                                                                            {{ date('H:i', strtotime($shipSchedule['departure_time'])) }}
                                                                        </p>
                                                                        <p class="mb-3">
                                                                            Arrival Time
                                                                            {{ date('H:i', strtotime($shipSchedule['arrival_time'])) }}
                                                                        </p>
                                                                        <p class="mb-3">
                                                                            {{ $shipSchedule['from'] ?? 'NA' }} -
                                                                            {{ $shipSchedule['to'] ?? 'NA' }}
                                                                        </p>
                                                                    </div>

                                                                    <div class="classBtn">
                                                                        <a href="#"
                                                                            id="{{ 'ferry_p_' . $key + 1 }}"
                                                                            data-ferryschedule-id="{{ $shipSchedule['id'] }}"
                                                                            data-trip_id="{{ $shipSchedule['tripId'] }}"
                                                                            data-vessel_id="{{ $shipSchedule['vesselID'] }}"
                                                                            data-from="{{ $shipSchedule['from'] }}"
                                                                            data-to="{{ $shipSchedule['to'] }}"
                                                                            data-departure_time="{{ $shipSchedule['departure_time'] }}"
                                                                            data-arrival_time="{{ $shipSchedule['arrival_time'] }}"
                                                                            data-class-title="{{ 'Premium' }}"
                                                                            data-class_id="pClass"
                                                                            data-price="{{ $shipSchedule['fares']->pBaseFare }}"
                                                                            data-psf="{{ 50 }}"
                                                                            data-avl_seat="{{ $shipSchedule['p_class_seat_availibility'] }}"
                                                                            data-ship_name="{{ 'Nautika' }}"
                                                                            class="btn {{ 'Premium' }} ferry-btn  mb-2"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#exampleModal">
                                                                            <p class="text-white mb-0">
                                                                                {{ 'Premium' }}
                                                                            </p>
                                                                            <p class="text-white mb-0"
                                                                                style="text-decoration: line-through;">
                                                                                ₹{{ $shipSchedule['fares']->pBaseFare }}
                                                                            </p>
                                                                            <p class="text-white mb-0">
                                                                                ₹{{ $shipSchedule['fares']->pBaseFare - 100 }}
                                                                            </p>
                                                                            <p class="text-white mb-0">
                                                                                Seat:
                                                                                {{ $shipSchedule['p_class_seat_availibility'] }}
                                                                            </p>
                                                                            <p class="bg-green-text-white mb-0">
                                                                                Book Now
                                                                            </p>
                                                                        </a>

                                                                        <a href="#"
                                                                            class="btn {{ 'Business' }} ferry-btn  mb-2"
                                                                            id="{{ 'ferry_b_' . $key + 1 }}"
                                                                            data-ferryschedule-id="{{ $shipSchedule['id'] }}"
                                                                            data-trip_id="{{ $shipSchedule['tripId'] }}"
                                                                            data-vessel_id="{{ $shipSchedule['vesselID'] }}"
                                                                            data-from="{{ $shipSchedule['from'] }}"
                                                                            data-to="{{ $shipSchedule['to'] }}"
                                                                            data-departure_time="{{ $shipSchedule['departure_time'] }}"
                                                                            data-arrival_time="{{ $shipSchedule['arrival_time'] }}"
                                                                            data-class-title="{{ 'Business' }}"
                                                                            data-class_id="bClass"
                                                                            data-price="{{ $shipSchedule['fares']->bBaseFare }}"
                                                                            data-psf="{{ 50 }}"
                                                                            data-avl_seat="{{ $shipSchedule['b_class_seat_availibility'] }}"
                                                                            data-ship_name="{{ 'Nautika' }}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#exampleModal">
                                                                            <p class="text-white mb-0">
                                                                                {{ 'Business' }}</p>
                                                                            <p class="text-white mb-0"
                                                                                style="text-decoration: line-through;">
                                                                                ₹{{ $shipSchedule['fares']->bBaseFare }}
                                                                            </p>
                                                                            <p class="text-white mb-0">
                                                                                ₹{{ $shipSchedule['fares']->bBaseFare - 100 }}
                                                                            </p>
                                                                            <p class="text-white mb-0">
                                                                                Seat:
                                                                                {{ $shipSchedule['b_class_seat_availibility'] }}
                                                                            </p>
                                                                            <p class="bg-green-text-white mb-0">
                                                                                Book Now
                                                                            </p>
                                                                        </a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        @elseif($shipSchedule['ship_name'] == 'Admin')
                                                            <div class="ferryCard ferrySearch mb-3">
                                                                <div class="ferryImg"
                                                                    data-ferry-id="{{ $shipSchedule['id'] }}">
                                                                    <img src="{{ env('UPLOADED_ASSETS') . $shipSchedule['ship']['image'] }}"
                                                                        alt="" style="">
                                                                </div>
                                                                <div class="ferryDetails ms-3 ">
                                                                    <div class="ferryName">
                                                                        <h4 class="mb-3">
                                                                            {{ $shipSchedule['ship']['title'] }}
                                                                        </h4>
                                                                        <p class="mb-3">
                                                                            Departure Time
                                                                            {{ date('H:i', strtotime($shipSchedule['departure_time'])) }}
                                                                        </p>
                                                                        <p class="mb-3">
                                                                            Arrival Time
                                                                            {{ date('H:i', strtotime($shipSchedule['arrival_time'])) }}
                                                                        </p>
                                                                        <p class="mb-3">
                                                                            {{ $shipSchedule['from_location']['title'] ?? 'NA' }}
                                                                            -
                                                                            {{ $shipSchedule['to_location']['title'] ?? 'NA' }}
                                                                        </p>
                                                                    </div>

                                                                    <div class="classBtn">
                                                                        @foreach ($shipSchedule['ferry_prices'] as $adminFerry)
                                                                            <a href="#"
                                                                                id="{{ 'ferry_p_' . $key + 1 }}"
                                                                                data-ferryschedule-id="{{ $shipSchedule['id'] }}"
                                                                                data-from="{{ $shipSchedule['from_location']['title'] }}"
                                                                                data-to="{{ $shipSchedule['to_location']['title'] }}"
                                                                                data-departure_time="{{ $shipSchedule['departure_time'] }}"
                                                                                data-arrival_time="{{ $shipSchedule['arrival_time'] }}"
                                                                                data-class-title="{{ $adminFerry['class']['title'] }}"
                                                                                data-class_id="{{ $adminFerry['class']['id'] }}"
                                                                                data-price="{{ $adminFerry['price'] }}"
                                                                                data-psf="{{ 50 }}"
                                                                                data-ship_name="Admin"
                                                                                class="btn {{ $adminFerry['class']['title'] }} ferry-btn  mb-2">
                                                                                <p class="text-white mb-0">
                                                                                    {{ $adminFerry['class']['title'] }}
                                                                                </p>
                                                                                <p class="text-white  mb-0">
                                                                                    ₹{{ $adminFerry['price'] }}
                                                                                </p>
                                                                                <p class="bg-green-text-white mb-0">
                                                                                    Book Now
                                                                                </p>
                                                                            </a>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @elseif($shipSchedule['ship_name'] == 'Makruzz')
                                                            <div class="ferryCard ferrySearch mb-3">
                                                                <div class="ferryImg"
                                                                    data-ferry-id="{{ $shipSchedule['id'] }}">
                                                                    {{-- <img src="{{ url($shipSchedule['ship_image']) }}" alt="" style=""> --}}
                                                                    <img src="{{ env('UPLOADED_ASSETS') . $shipSchedule['ship_image'] }}"
                                                                        alt="" style="">
                                                                </div>

                                                                <div class="ferryDetails ms-3 ">

                                                                    <div class="ferryName">
                                                                        <h4 class="mb-3">
                                                                            {{ $shipSchedule['ship_name'] }}
                                                                        </h4>
                                                                        <p class="mb-3">
                                                                            Departure Time
                                                                            {{ date('H:i', strtotime($shipSchedule['ship_class'][0]->departure_time)) }}
                                                                        </p>
                                                                        <p class="mb-3">
                                                                            Arrival Time
                                                                            {{ date('H:i', strtotime($shipSchedule['ship_class'][0]->arrival_time)) }}
                                                                        </p>

                                                                        <p class="mb-3">
                                                                            {{ $shipSchedule['ship_class'][0]->source_name ?? 'NA' }}
                                                                            -
                                                                            {{ $shipSchedule['ship_class'][0]->destination_name ?? 'NA' }}
                                                                        </p>

                                                                    </div>

                                                                    <div class="classBtn">
                                                                        @foreach ($shipSchedule['ship_class'] as $ferryPrice)
                                                                            <a href="#"
                                                                                id="{{ 'ferry_' . $ferryPrice->ship_class_title . '_' . $key + 1 }}"
                                                                                data-ferryschedule-id="{{ $ferryPrice->id }}"
                                                                                data-class_id="{{ $ferryPrice->ship_class_id }}"
                                                                                data-from="{{ $ferryPrice->source_name }}"
                                                                                data-to="{{ $ferryPrice->destination_name }}"
                                                                                data-departure_time="{{ $ferryPrice->departure_time }}"
                                                                                data-arrival_time="{{ $ferryPrice->arrival_time }}"
                                                                                data-class-title="{{ $ferryPrice->ship_class_title }}"
                                                                                data-price="{{ $ferryPrice->ship_class_price }}"
                                                                                data-psf="{{ $ferryPrice->psf }}"
                                                                                data-avl_seat="{{ $ferryPrice->seat }}"
                                                                                data-ship_name="{{ 'Makruzz' }}"
                                                                                class="btn {{ $ferryPrice->ship_class_title }}  ferry-btn mb-2">
                                                                                <p class="text-white mb-0">
                                                                                    {{ $ferryPrice->ship_class_title }}
                                                                                </p>
                                                                                <p class="text-white mb-0"
                                                                                    style="text-decoration: line-through;">
                                                                                    ₹ {{ $ferryPrice->ship_class_price }}
                                                                                </p>
                                                                                <p class="text-white mb-0">
                                                                                    ₹
                                                                                    {{ $ferryPrice->ship_class_price - 100 }}
                                                                                </p>
                                                                                <p class="text-white mb-0">
                                                                                    Seat: {{ $ferryPrice->seat }}
                                                                                </p>
                                                                                <p class="bg-green-text-white mb-0">
                                                                                    Book Now
                                                                                </p>
                                                                            </a>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        

                                                        @elseif($shipSchedule['ship_name'] == 'Green Ocean 1' || $shipSchedule['ship_name'] == 'Green Ocean 2')
                                                            <div class="ferryCard ferrySearch mb-3">
                                                                <div class="ferryImg"
                                                                    data-ferry-id="{{ $shipSchedule['id'] }}">
                                                                    {{-- <img src="{{ url($shipSchedule['ship_image']) }}" alt="" style=""> --}}
                                                                    <img src="{{ env('UPLOADED_ASSETS') . $shipSchedule['ship_image'] }}"
                                                                        alt="" style="">
                                                                </div>

                                                                <div class="ferryDetails ms-3 ">

                                                                    <div class="ferryName">
                                                                        <h4 class="mb-3">
                                                                            {{ $shipSchedule['ship_name'] }}
                                                                        </h4>
                                                                        <p class="mb-3">
                                                                            Departure Time
                                                                            {{ date('H:i', strtotime($shipSchedule['departure_time'])) }}
                                                                        </p>
                                                                        <p class="mb-3">
                                                                            Arrival Time
                                                                            {{ date('H:i', strtotime($shipSchedule['arraival_time'])) }}
                                                                        </p>

                                                                        <p class="mb-3">
                                                                            {{ $route_titles['from_location'] }}
                                                                            -
                                                                            {{ $route_titles['to_location'] }}
                                                                        </p>

                                                                    </div>

                                                                    <div class="classBtn">
                                                                        @foreach ($shipSchedule['ship_class'] as $ferryPrice)
                                                                            <a href="#"
                                                                                id="{{ 'ferry_' . $ferryPrice->class_name . '_' . $key + 1 }}"
                                                                                data-ferryschedule-id="{{ $ferryPrice->route_id }}"
                                                                                data-class_id="{{ $ferryPrice->class_id }}"
                                                                                data-from="{{ $route_titles['from_location'] }}"
                                                                                data-to="{{ $route_titles['to_location'] }}"
                                                                                data-departure_time="{{ date('H:i', strtotime($shipSchedule['departure_time'])) }}"
                                                                                data-arrival_time="{{ date('H:i', strtotime($shipSchedule['arraival_time'])) }}"
                                                                                data-class-title="{{ $ferryPrice->class_name }}"
                                                                                data-price="{{ $ferryPrice->adult_seat_rate }}"
                                                                                data-psf="{{ $ferryPrice->port_fee }}"
                                                                                data-avl_seat="{{ $ferryPrice->seat_available }}"
                                                                                data-ship_name="{{ $ferryPrice->ferry_name }}"
                                                                                data-ship_id="{{ $ferryPrice->ferry_id }}"
                                                                                class="btn {{ $ferryPrice->class_name }}  ferry-btn mb-2">
                                                                                <p class="text-white mb-0">
                                                                                    {{ $ferryPrice->class_name }}
                                                                                </p>
                                                                                <p class="text-white mb-0"
                                                                                    style="text-decoration: line-through;">
                                                                                    ₹ {{ $ferryPrice->adult_seat_rate }}
                                                                                </p>
                                                                                <p class="text-white mb-0">
                                                                                    ₹
                                                                                    {{ $ferryPrice->adult_seat_rate - 100 }}
                                                                                </p>
                                                                                <p class="text-white mb-0">
                                                                                    Seat: {{ $ferryPrice->seat_available }}
                                                                                </p>
                                                                                <p class="bg-green-text-white mb-0">
                                                                                    Book Now
                                                                                </p>
                                                                            </a>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        {{-- Modal for light box on ship logo --}}
                                                        <div class="modal fade"
                                                            id="imageModal-{{ $shipSchedule['id'] }}" tabindex="-1"
                                                            aria-labelledby="imageModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-body light_box">
                                                                        <div id="shipIMG-{{ $shipSchedule['id'] }}"
                                                                            class="carousel slide light_box">
                                                                            <div class="carousel-inner">
                                                                                @php
                                                                                    $k = 1;
                                                                                @endphp

                                                                                @if (!empty($shipSchedule['ship']['images']))
                                                                                    @foreach ($shipSchedule['ship']['images'] as $key => $shipImage)
                                                                                        <div
                                                                                            class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                                                            {{-- <img src="{{ asset(trim($shipImage['image_path'])) }}" 
                                                                                class="w-100" alt="Boat Image"> --}}
                                                                                            <img src="{{ env('UPLOADED_ASSETS') . $shipImage['image_path'] }}"
                                                                                                class="w-100"
                                                                                                alt="Image">
                                                                                        </div>
                                                                                        @php
                                                                                            $k++;
                                                                                        @endphp
                                                                                    @endforeach
                                                                                @else
                                                                                    @foreach ($shipSchedule['ship'] as $shipImage)
                                                                                        @foreach ($shipImage->images as $images)
                                                                                            <div
                                                                                                class="carousel-item {{ $k == 1 ? 'active' : '' }}">
                                                                                                <img src="{{ env('UPLOADED_ASSETS') . $images->image_path }}"
                                                                                                    class="w-100"
                                                                                                    alt="Image">
                                                                                            </div>
                                                                                        @endforeach

                                                                                        @php
                                                                                            $k++;
                                                                                        @endphp
                                                                                    @endforeach
                                                                                @endif
                                                                            </div>
                                                                            <button class="carousel-control-prev"
                                                                                type="button"
                                                                                data-bs-target="#shipIMG-{{ $shipSchedule['id'] }}"
                                                                                data-bs-slide="prev">
                                                                                <span class="carousel-control-prev-icon"
                                                                                    aria-hidden="true"></span>
                                                                                <span
                                                                                    class="visually-hidden">Previous</span>
                                                                            </button>
                                                                            <button class="carousel-control-next"
                                                                                type="button"
                                                                                data-bs-target="#shipIMG-{{ $shipSchedule['id'] }}"
                                                                                data-bs-slide="next">
                                                                                <span class="carousel-control-next-icon"
                                                                                    aria-hidden="true"></span>
                                                                                <span class="visually-hidden">Next</span>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane societyList fade next_return_tab " id="nav-contact"
                                        role="tabpanel" aria-labelledby="nav-contact-tab">

                                        <div class="row">
                                            <div class="row">
                                                <div class="col-12 searchResults px-0">
                                                    @if (isset($apiScheduleData2))
                                                        @foreach ($apiScheduleData2 as $key => $shipSchedule)
                                                            @if ($shipSchedule['ship_name'] == 'Nautika')
                                                                <div class="ferryCard ferrySearch mb-3">
                                                                    <div class="ferryImg"
                                                                        data-ferry-id="{{ $shipSchedule['id'] }}">

                                                                        {{-- <img src="{{url($shipSchedule['ship_image']) }}" alt="" style="width:240px"> --}}
                                                                        <img src="{{ env('UPLOADED_ASSETS') . $shipSchedule['ship_image'] }}"
                                                                            alt="" style="">
                                                                    </div>
                                                                    <div class="ferryDetails ms-3 ">
                                                                        <div class="ferryName">
                                                                            <h4 class="mb-3">
                                                                                {{ $shipSchedule['ship_name'] }}
                                                                            </h4>
                                                                            <p class="mb-3">
                                                                                Departure Time
                                                                                {{ date('H:i', strtotime($shipSchedule['departure_time'])) }}
                                                                            </p>
                                                                            <p class="mb-3">
                                                                                Arrival Time
                                                                                {{ date('H:i', strtotime($shipSchedule['arrival_time'])) }}
                                                                            </p>
                                                                            <p class="mb-3">
                                                                                {{ $shipSchedule['from'] ?? 'NA' }} -
                                                                                {{ $shipSchedule['to'] ?? 'NA' }}
                                                                            </p>
                                                                        </div>

                                                                        <div class="classBtn">
                                                                            <a href="#"
                                                                                id="{{ 'ferry_p_' . $key + 1 }}"
                                                                                data-ferryschedule-id="{{ $shipSchedule['id'] }}"
                                                                                data-trip_id="{{ $shipSchedule['tripId'] }}"
                                                                                data-vessel_id="{{ $shipSchedule['vesselID'] }}"
                                                                                data-from="{{ $shipSchedule['from'] }}"
                                                                                data-to="{{ $shipSchedule['to'] }}"
                                                                                data-departure_time="{{ $shipSchedule['departure_time'] }}"
                                                                                data-arrival_time="{{ $shipSchedule['arrival_time'] }}"
                                                                                data-class-title="{{ 'Premium' }}"
                                                                                data-class_id="pClass"
                                                                                data-price="{{ $shipSchedule['fares']->pBaseFare }}"
                                                                                data-psf="{{ 50 }}"
                                                                                data-avl_seat="{{ $shipSchedule['p_class_seat_availibility'] }}"
                                                                                data-ship_name="{{ 'Nautika' }}"
                                                                                class="btn {{ 'Premium' }} ferry-btn2 mb-2"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#exampleModal">
                                                                                <p class="text-white mb-0">
                                                                                    {{ 'Premium' }}
                                                                                </p>
                                                                                <p class="text-white mb-0"
                                                                                    style="text-decoration: line-through;">
                                                                                    ₹{{ $shipSchedule['fares']->pBaseFare }}
                                                                                </p>
                                                                                <p class="text-white mb-0">
                                                                                    ₹{{ $shipSchedule['fares']->pBaseFare - 100 }}
                                                                                </p>
                                                                                <p class="text-white mb-0">
                                                                                    Seat:
                                                                                    {{ $shipSchedule['p_class_seat_availibility'] }}
                                                                                </p>
                                                                                <p class="bg-green-text-white mb-0">
                                                                                    Book Now
                                                                                </p>
                                                                            </a>

                                                                            <a href="#"
                                                                                id="{{ 'ferry_b_' . $key + 1 }}"
                                                                                data-ferryschedule-id="{{ $shipSchedule['id'] }}"
                                                                                data-trip_id="{{ $shipSchedule['tripId'] }}"
                                                                                data-vessel_id="{{ $shipSchedule['vesselID'] }}"
                                                                                data-from="{{ $shipSchedule['from'] }}"
                                                                                data-to="{{ $shipSchedule['to'] }}"
                                                                                data-departure_time="{{ $shipSchedule['departure_time'] }}"
                                                                                data-arrival_time="{{ $shipSchedule['arrival_time'] }}"
                                                                                data-class-title="{{ 'Business' }}"
                                                                                data-class_id="bClass"
                                                                                data-price="{{ $shipSchedule['fares']->bBaseFare }}"
                                                                                data-psf="{{ 50 }}"
                                                                                data-avl_seat="{{ $shipSchedule['b_class_seat_availibility'] }}"
                                                                                data-ship_name="{{ 'Nautika' }}"
                                                                                class="btn {{ 'Business' }} ferry-btn2 mb-2"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#exampleModal">
                                                                                <p class="text-white mb-0">
                                                                                    {{ 'Business' }}</p>
                                                                                <p class="text-white mb-0"
                                                                                    style="text-decoration: line-through;">
                                                                                    ₹{{ $shipSchedule['fares']->bBaseFare }}
                                                                                </p>
                                                                                <p class="text-white mb-0">
                                                                                    ₹{{ $shipSchedule['fares']->bBaseFare - 100 }}
                                                                                </p>
                                                                                <p class="text-white mb-0">
                                                                                    Seat:
                                                                                    {{ $shipSchedule['b_class_seat_availibility'] }}
                                                                                </p>
                                                                                <p class="bg-green-text-white mb-0">
                                                                                    Book Now
                                                                                </p>
                                                                            </a>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            @elseif($shipSchedule['ship_name'] == 'Admin')
                                                                <div class="ferryCard ferrySearch mb-3">
                                                                    <div class="ferryImg"
                                                                        data-ferry-id="{{ $shipSchedule['id'] }}">
                                                                        <img src="{{ env('UPLOADED_ASSETS') . $shipSchedule['ship']['image'] }}"
                                                                            alt="" style="">
                                                                    </div>
                                                                    <div class="ferryDetails ms-3 ">
                                                                        <div class="ferryName">
                                                                            <h4 class="mb-3">
                                                                                {{ $shipSchedule['ship']['title'] }}
                                                                            </h4>
                                                                            <p class="mb-3">
                                                                                Departure Time
                                                                                {{ date('H:i', strtotime($shipSchedule['departure_time'])) }}
                                                                            </p>
                                                                            <p class="mb-3">
                                                                                Arrival Time
                                                                                {{ date('H:i', strtotime($shipSchedule['arrival_time'])) }}
                                                                            </p>
                                                                            <p class="mb-3">
                                                                                {{ $shipSchedule['from_location']['title'] ?? 'NA' }}
                                                                                -
                                                                                {{ $shipSchedule['to_location']['title'] ?? 'NA' }}
                                                                            </p>
                                                                        </div>

                                                                        <div class="classBtn">
                                                                            @foreach ($shipSchedule['ferry_prices'] as $adminFerry)
                                                                                <a href="#"
                                                                                    id="{{ 'ferry_p_' . $key + 1 }}"
                                                                                    data-ferryschedule-id="{{ $shipSchedule['id'] }}"
                                                                                    data-from="{{ $shipSchedule['from_location']['title'] }}"
                                                                                    data-to="{{ $shipSchedule['to_location']['title'] }}"
                                                                                    data-departure_time="{{ $shipSchedule['departure_time'] }}"
                                                                                    data-arrival_time="{{ $shipSchedule['arrival_time'] }}"
                                                                                    data-class-title="{{ $adminFerry['class']['title'] }}"
                                                                                    data-class_id="{{ $adminFerry['class']['id'] }}"
                                                                                    data-price="{{ $adminFerry['price'] }}"
                                                                                    data-psf="{{ 50 }}"
                                                                                    data-ship_name="Admin"
                                                                                    class="btn {{ $adminFerry['class']['title'] }} ferry-btn2 mb-2">
                                                                                    <p class="text-white mb-0">
                                                                                        {{ $adminFerry['class']['title'] }}
                                                                                    </p>
                                                                                    <p class="text-white mb-0">
                                                                                        ₹{{ $adminFerry['price'] }}
                                                                                    </p>
                                                                                    <p class="bg-green-text-white mb-0">
                                                                                        Book Now
                                                                                    </p>
                                                                                </a>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @elseif($shipSchedule['ship_name'] == 'Makruzz')
                                                                <div class="ferryCard ferrySearch mb-3">
                                                                    <div class="ferryImg"
                                                                        data-ferry-id="{{ $shipSchedule['id'] }}">
                                                                        {{-- <img src="{{ url($shipSchedule['ship_image']) }}" alt="" style=""> --}}
                                                                        <img src="{{ env('UPLOADED_ASSETS') . $shipSchedule['ship_image'] }}"
                                                                            alt="" style="">
                                                                    </div>

                                                                    <div class="ferryDetails ms-3 ">

                                                                        <div class="ferryName">
                                                                            <h4 class="mb-3">
                                                                                {{ $shipSchedule['ship_name'] }}
                                                                            </h4>
                                                                            <p class="mb-3">
                                                                                Departure Time
                                                                                {{ date('H:i', strtotime($shipSchedule['ship_class'][0]->departure_time)) }}
                                                                            </p>
                                                                            <p class="mb-3">
                                                                                Arrival Time
                                                                                {{ date('H:i', strtotime($shipSchedule['ship_class'][0]->arrival_time)) }}
                                                                            </p>

                                                                            <p class="mb-3">
                                                                                {{ $shipSchedule['ship_class'][0]->source_name ?? 'NA' }}
                                                                                -
                                                                                {{ $shipSchedule['ship_class'][0]->destination_name ?? 'NA' }}
                                                                            </p>

                                                                        </div>

                                                                        <div class="classBtn">
                                                                            @foreach ($shipSchedule['ship_class'] as $ferryPrice)
                                                                                <a href="#"
                                                                                    id="{{ 'ferry_' . $ferryPrice->ship_class_title . '_' . $key + 1 }}"
                                                                                    data-ferryschedule-id="{{ $ferryPrice->id }}"
                                                                                    data-class_id="{{ $ferryPrice->ship_class_id }}"
                                                                                    data-from="{{ $ferryPrice->source_name }}"
                                                                                    data-to="{{ $ferryPrice->destination_name }}"
                                                                                    data-departure_time="{{ $ferryPrice->departure_time }}"
                                                                                    data-arrival_time="{{ $ferryPrice->arrival_time }}"
                                                                                    data-class-title="{{ $ferryPrice->ship_class_title }}"
                                                                                    data-price="{{ $ferryPrice->ship_class_price }}"
                                                                                    data-psf="{{ $ferryPrice->psf }}"
                                                                                    data-avl_seat="{{ $ferryPrice->seat }}"
                                                                                    data-ship_name="{{ 'Makruzz' }}"
                                                                                    class="btn {{ $ferryPrice->ship_class_title }} ferry-btn2 mb-2">
                                                                                    <p class="text-white mb-0">
                                                                                        {{ $ferryPrice->ship_class_title }}
                                                                                    </p>
                                                                                    <p class="text-white mb-0"
                                                                                        style="text-decoration: line-through;">
                                                                                        ₹
                                                                                        {{ $ferryPrice->ship_class_price }}
                                                                                    </p>
                                                                                    <p class="text-white mb-0">
                                                                                        ₹
                                                                                        {{ $ferryPrice->ship_class_price - 100 }}
                                                                                    </p>
                                                                                    <p class="text-white mb-0">
                                                                                        Seat: {{ $ferryPrice->seat }}
                                                                                    </p>
                                                                                    <p class="bg-green-text-white mb-0">
                                                                                        Book Now
                                                                                    </p>
                                                                                </a>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @elseif($shipSchedule['ship_name'] == 'Green Ocean 1' || $shipSchedule['ship_name'] == 'Green Ocean 2')
                                                                <div class="ferryCard ferrySearch mb-3">
                                                                    <div class="ferryImg"
                                                                        data-ferry-id="{{ $shipSchedule['id'] }}">
                                                                        {{-- <img src="{{ url($shipSchedule['ship_image']) }}" alt="" style=""> --}}
                                                                        <img src="{{ env('UPLOADED_ASSETS') . $shipSchedule['ship_image'] }}"
                                                                            alt="" style="">
                                                                    </div>
    
                                                                    <div class="ferryDetails ms-3 ">
    
                                                                        <div class="ferryName">
                                                                            <h4 class="mb-3">
                                                                                {{ $shipSchedule['ship_name'] }}
                                                                            </h4>
                                                                            <p class="mb-3">
                                                                                Departure Time
                                                                                {{ date('H:i', strtotime($shipSchedule['departure_time'])) }}
                                                                            </p>
                                                                            <p class="mb-3">
                                                                                Arrival Time
                                                                                {{ date('H:i', strtotime($shipSchedule['arraival_time'])) }}
                                                                            </p>
    
                                                                            <p class="mb-3">
                                                                                {{ $round1_route_titles['from_location'] }}
                                                                                -
                                                                                {{ $round1_route_titles['to_location'] }}
                                                                            </p>
    
                                                                        </div>
    
                                                                        <div class="classBtn">
                                                                            @foreach ($shipSchedule['ship_class'] as $ferryPrice)
                                                                                <a href="#"
                                                                                    id="{{ 'ferry_' . $ferryPrice->class_name . '_' . $key + 1 }}"
                                                                                    data-ferryschedule-id="{{ $ferryPrice->route_id }}"
                                                                                    data-class_id="{{ $ferryPrice->class_id }}"
                                                                                    data-from="{{ $round1_route_titles['from_location'] }}"
                                                                                    data-to="{{ $round1_route_titles['to_location'] }}"
                                                                                    data-departure_time="{{ date('H:i', strtotime($shipSchedule['departure_time'])) }}"
                                                                                    data-arrival_time="{{ date('H:i', strtotime($shipSchedule['arraival_time'])) }}"
                                                                                    data-class-title="{{ $ferryPrice->class_name }}"
                                                                                    data-price="{{ $ferryPrice->adult_seat_rate }}"
                                                                                    data-psf="{{ $ferryPrice->port_fee }}"
                                                                                    data-avl_seat="{{ $ferryPrice->seat_available }}"
                                                                                    data-ship_name="{{ $ferryPrice->ferry_name }}"
                                                                                    class="btn {{ $ferryPrice->class_name }}  ferry-btn mb-2">
                                                                                    <p class="text-white mb-0">
                                                                                        {{ $ferryPrice->class_name }}
                                                                                    </p>
                                                                                    <p class="text-white mb-0"
                                                                                        style="text-decoration: line-through;">
                                                                                        ₹ {{ $ferryPrice->adult_seat_rate }}
                                                                                    </p>
                                                                                    <p class="text-white mb-0">
                                                                                        ₹
                                                                                        {{ $ferryPrice->adult_seat_rate - 100 }}
                                                                                    </p>
                                                                                    <p class="text-white mb-0">
                                                                                        Seat: {{ $ferryPrice->seat_available }}
                                                                                    </p>
                                                                                    <p class="bg-green-text-white mb-0">
                                                                                        Book Now
                                                                                    </p>
                                                                                </a>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                            {{-- Modal for light box on ship logo --}}
                                                            <div class="modal fade"
                                                                id="imageModal-{{ $shipSchedule['id'] }}" tabindex="-1"
                                                                aria-labelledby="imageModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body light_box">
                                                                            <div id="shipIMG-{{ $shipSchedule['id'] }}"
                                                                                class="carousel slide light_box">
                                                                                <div class="carousel-inner">
                                                                                    @php
                                                                                        $k = 1;
                                                                                    @endphp

                                                                                    @if (!empty($shipSchedule['ship']['images']))
                                                                                        @foreach ($shipSchedule['ship']['images'] as $key => $shipImage)
                                                                                            <div
                                                                                                class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                                                                {{-- <img src="{{ asset(trim($shipImage['image_path'])) }}" 
                                                                                    class="w-100" alt="Boat Image"> --}}
                                                                                                <img src="{{ env('UPLOADED_ASSETS') . $shipImage['image_path'] }}"
                                                                                                    class="w-100"
                                                                                                    alt="Image">
                                                                                            </div>
                                                                                            @php
                                                                                                $k++;
                                                                                            @endphp
                                                                                        @endforeach
                                                                                    @else
                                                                                        @foreach ($shipSchedule['ship'] as $shipImage)
                                                                                            @foreach ($shipImage->images as $images)
                                                                                                <div
                                                                                                    class="carousel-item {{ $k == 1 ? 'active' : '' }}">
                                                                                                    <img src="{{ env('UPLOADED_ASSETS') . $images->image_path }}"
                                                                                                        class="w-100"
                                                                                                        alt="Image">
                                                                                                </div>
                                                                                            @endforeach

                                                                                            @php
                                                                                                $k++;
                                                                                            @endphp
                                                                                        @endforeach
                                                                                    @endif
                                                                                </div>
                                                                                <button class="carousel-control-prev"
                                                                                    type="button"
                                                                                    data-bs-target="#shipIMG-{{ $shipSchedule['id'] }}"
                                                                                    data-bs-slide="prev">
                                                                                    <span
                                                                                        class="carousel-control-prev-icon"
                                                                                        aria-hidden="true"></span>
                                                                                    <span
                                                                                        class="visually-hidden">Previous</span>
                                                                                </button>
                                                                                <button class="carousel-control-next"
                                                                                    type="button"
                                                                                    data-bs-target="#shipIMG-{{ $shipSchedule['id'] }}"
                                                                                    data-bs-slide="next">
                                                                                    <span
                                                                                        class="carousel-control-next-icon"
                                                                                        aria-hidden="true"></span>
                                                                                    <span
                                                                                        class="visually-hidden">Next</span>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="nav-extra" role="tabpanel"
                                        aria-labelledby="nav-extra-tab">
                                        <div class="row">
                                            <div class="col-12 searchResults px-0">
                                                @if (isset($apiScheduleData3))
                                                    @foreach ($apiScheduleData3 as $key => $shipSchedule)
                                                        @if ($shipSchedule['ship_name'] == 'Nautika')
                                                            <div class="ferryCard ferrySearch mb-3">
                                                                <div class="ferryImg"
                                                                    data-ferry-id="{{ $shipSchedule['id'] }}">

                                                                    {{-- <img src="{{url($shipSchedule['ship_image']) }}" alt="" style="width:240px"> --}}
                                                                    <img src="{{ env('UPLOADED_ASSETS') . $shipSchedule['ship_image'] }}"
                                                                        alt="" style="">
                                                                </div>
                                                                <div class="ferryDetails ms-3 ">
                                                                    <div class="ferryName">
                                                                        <h4 class="mb-3">
                                                                            {{ $shipSchedule['ship_name'] }}
                                                                        </h4>
                                                                        <p class="mb-3">
                                                                            Departure Time
                                                                            {{ date('H:i', strtotime($shipSchedule['departure_time'])) }}
                                                                        </p>
                                                                        <p class="mb-3">
                                                                            Arrival Time
                                                                            {{ date('H:i', strtotime($shipSchedule['arrival_time'])) }}
                                                                        </p>
                                                                        <p class="mb-3">
                                                                            {{ $shipSchedule['from'] ?? 'NA' }} -
                                                                            {{ $shipSchedule['to'] ?? 'NA' }}
                                                                        </p>
                                                                    </div>

                                                                    <div class="classBtn">
                                                                        <a href="#"
                                                                            id="{{ 'ferry_p_' . $key + 1 }}"
                                                                            data-ferryschedule-id="{{ $shipSchedule['id'] }}"
                                                                            data-trip_id="{{ $shipSchedule['tripId'] }}"
                                                                            data-vessel_id="{{ $shipSchedule['vesselID'] }}"
                                                                            data-from="{{ $shipSchedule['from'] }}"
                                                                            data-to="{{ $shipSchedule['to'] }}"
                                                                            data-departure_time="{{ $shipSchedule['departure_time'] }}"
                                                                            data-arrival_time="{{ $shipSchedule['arrival_time'] }}"
                                                                            data-class-title="{{ 'Premium' }}"
                                                                            data-class_id="pClass"
                                                                            data-price="{{ $shipSchedule['fares']->pBaseFare }}"
                                                                            data-psf="{{ 50 }}"
                                                                            data-avl_seat="{{ $shipSchedule['p_class_seat_availibility'] }}"
                                                                            data-ship_name="{{ 'Nautika' }}"
                                                                            class="btn {{ 'Premium' }} ferry-btn3 mb-2"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#exampleModal">
                                                                            <p class="text-white mb-0">
                                                                                {{ 'Premium' }}
                                                                            </p>
                                                                            <p class="text-white mb-0"
                                                                                style="text-decoration: line-through;">
                                                                                ₹{{ $shipSchedule['fares']->pBaseFare }}
                                                                            </p>
                                                                            <p class="text-white mb-0">
                                                                                ₹{{ $shipSchedule['fares']->pBaseFare - 100 }}
                                                                            </p>
                                                                            <p class="text-white mb-0">
                                                                                Seat:
                                                                                {{ $shipSchedule['p_class_seat_availibility'] }}
                                                                            </p>
                                                                            <p class="bg-green-text-white mb-0">
                                                                                Book Now
                                                                            </p>
                                                                        </a>

                                                                        <a href="#"
                                                                            id="{{ 'ferry_b_' . $key + 1 }}"
                                                                            data-ferryschedule-id="{{ $shipSchedule['id'] }}"
                                                                            data-trip_id="{{ $shipSchedule['tripId'] }}"
                                                                            data-vessel_id="{{ $shipSchedule['vesselID'] }}"
                                                                            data-from="{{ $shipSchedule['from'] }}"
                                                                            data-to="{{ $shipSchedule['to'] }}"
                                                                            data-departure_time="{{ $shipSchedule['departure_time'] }}"
                                                                            data-arrival_time="{{ $shipSchedule['arrival_time'] }}"
                                                                            data-class-title="{{ 'Business' }}"
                                                                            data-class_id="bClass"
                                                                            data-price="{{ $shipSchedule['fares']->bBaseFare }}"
                                                                            data-psf="{{ 50 }}"
                                                                            data-avl_seat="{{ $shipSchedule['b_class_seat_availibility'] }}"
                                                                            data-ship_name="{{ 'Nautika' }}"
                                                                            class="btn {{ 'Business' }} ferry-btn3 mb-2"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#exampleModal">
                                                                            <p class="text-white mb-0">
                                                                                {{ 'Business' }}</p>
                                                                            <p class="text-white mb-0"
                                                                                style="text-decoration: line-through;">
                                                                                ₹{{ $shipSchedule['fares']->bBaseFare }}
                                                                            </p>
                                                                            <p class="text-white mb-0">
                                                                                ₹{{ $shipSchedule['fares']->bBaseFare - 100 }}
                                                                            </p>
                                                                            <p class="text-white mb-0">
                                                                                Seat:
                                                                                {{ $shipSchedule['b_class_seat_availibility'] }}
                                                                            </p>
                                                                            <p class="bg-green-text-white mb-0">
                                                                                Book Now
                                                                            </p>
                                                                        </a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        @elseif($shipSchedule['ship_name'] == 'Admin')
                                                            <div class="ferryCard ferrySearch mb-3">
                                                                <div class="ferryImg"
                                                                    data-ferry-id="{{ $shipSchedule['id'] }}">
                                                                    <img src="{{ env('UPLOADED_ASSETS') . $shipSchedule['ship']['image'] }}"
                                                                        alt="" style="">
                                                                </div>
                                                                <div class="ferryDetails ms-3 ">
                                                                    <div class="ferryName">
                                                                        <h4 class="mb-3">
                                                                            {{ $shipSchedule['ship']['title'] }}
                                                                        </h4>
                                                                        <p class="mb-3">
                                                                            Departure Time
                                                                            {{ date('H:i', strtotime($shipSchedule['departure_time'])) }}
                                                                        </p>
                                                                        <p class="mb-3">
                                                                            Arrival Time
                                                                            {{ date('H:i', strtotime($shipSchedule['arrival_time'])) }}
                                                                        </p>
                                                                        <p class="mb-3">
                                                                            {{ $shipSchedule['from_location']['title'] ?? 'NA' }}
                                                                            -
                                                                            {{ $shipSchedule['to_location']['title'] ?? 'NA' }}
                                                                        </p>
                                                                    </div>

                                                                    <div class="classBtn">
                                                                        @foreach ($shipSchedule['ferry_prices'] as $adminFerry)
                                                                            <a href="#"
                                                                                id="{{ 'ferry_p_' . $key + 1 }}"
                                                                                data-ferryschedule-id="{{ $shipSchedule['id'] }}"
                                                                                data-from="{{ $shipSchedule['from_location']['title'] }}"
                                                                                data-to="{{ $shipSchedule['to_location']['title'] }}"
                                                                                data-departure_time="{{ $shipSchedule['departure_time'] }}"
                                                                                data-arrival_time="{{ $shipSchedule['arrival_time'] }}"
                                                                                data-class-title="{{ $adminFerry['class']['title'] }}"
                                                                                data-class_id="{{ $adminFerry['class']['id'] }}"
                                                                                data-price="{{ $adminFerry['price'] }}"
                                                                                data-psf="{{ 50 }}"
                                                                                data-ship_name="Admin"
                                                                                class="btn {{ $adminFerry['class']['title'] }} ferry-btn3 mb-2">
                                                                                <p class="text-white mb-0">
                                                                                    {{ $adminFerry['class']['title'] }}
                                                                                </p>
                                                                                <p class="text-white mb-0">
                                                                                    ₹{{ $adminFerry['price'] }}
                                                                                </p>
                                                                                <p class="bg-green-text-white mb-0">
                                                                                    Book Now
                                                                                </p>
                                                                            </a>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @elseif($shipSchedule['ship_name'] == 'Makruzz')
                                                            <div class="ferryCard ferrySearch mb-3">
                                                                <div class="ferryImg"
                                                                    data-ferry-id="{{ $shipSchedule['id'] }}">
                                                                    {{-- <img src="{{ url($shipSchedule['ship_image']) }}" alt="" style=""> --}}
                                                                    <img src="{{ env('UPLOADED_ASSETS') . $shipSchedule['ship_image'] }}"
                                                                        alt="" style="">
                                                                </div>

                                                                <div class="ferryDetails ms-3 ">

                                                                    <div class="ferryName">
                                                                        <h4 class="mb-3">
                                                                            {{ $shipSchedule['ship_name'] }}
                                                                        </h4>
                                                                        <p class="mb-3">
                                                                            Departure Time
                                                                            {{ date('H:i', strtotime($shipSchedule['ship_class'][0]->departure_time)) }}
                                                                        </p>
                                                                        <p class="mb-3">
                                                                            Arrival Time
                                                                            {{ date('H:i', strtotime($shipSchedule['ship_class'][0]->arrival_time)) }}
                                                                        </p>

                                                                        <p class="mb-3">
                                                                            {{ $shipSchedule['ship_class'][0]->source_name ?? 'NA' }}
                                                                            -
                                                                            {{ $shipSchedule['ship_class'][0]->destination_name ?? 'NA' }}
                                                                        </p>

                                                                    </div>

                                                                    <div class="classBtn">
                                                                        @foreach ($shipSchedule['ship_class'] as $ferryPrice)
                                                                            <a href="#"
                                                                                id="{{ 'ferry_' . $ferryPrice->ship_class_title . '_' . $key + 1 }}"
                                                                                data-ferryschedule-id="{{ $ferryPrice->id }}"
                                                                                data-class_id="{{ $ferryPrice->ship_class_id }}"
                                                                                data-from="{{ $ferryPrice->source_name }}"
                                                                                data-to="{{ $ferryPrice->destination_name }}"
                                                                                data-departure_time="{{ $ferryPrice->departure_time }}"
                                                                                data-arrival_time="{{ $ferryPrice->arrival_time }}"
                                                                                data-class-title="{{ $ferryPrice->ship_class_title }}"
                                                                                data-price="{{ $ferryPrice->ship_class_price }}"
                                                                                data-psf="{{ $ferryPrice->psf }}"
                                                                                data-avl_seat="{{ $ferryPrice->seat }}"
                                                                                data-ship_name="{{ 'Makruzz' }}"
                                                                                class="btn {{ $ferryPrice->ship_class_title }} ferry-btn3 mb-2">
                                                                                <p class="text-white mb-0">
                                                                                    {{ $ferryPrice->ship_class_title }}
                                                                                </p>
                                                                                <p class="text-white mb-0"
                                                                                    style="text-decoration: line-through;">
                                                                                    ₹ {{ $ferryPrice->ship_class_price }}
                                                                                </p>
                                                                                <p class="text-white mb-0">
                                                                                    ₹
                                                                                    {{ $ferryPrice->ship_class_price - 100 }}
                                                                                </p>
                                                                                <p class="text-white mb-0">
                                                                                    Seat: {{ $ferryPrice->seat }}
                                                                                </p>
                                                                                <p class="bg-green-text-white mb-0">
                                                                                    Book Now
                                                                                </p>
                                                                            </a>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @elseif($shipSchedule['ship_name'] == 'Green Ocean 1' || $shipSchedule['ship_name'] == 'Green Ocean 2')
                                                            <div class="ferryCard ferrySearch mb-3">
                                                                <div class="ferryImg"
                                                                    data-ferry-id="{{ $shipSchedule['id'] }}">
                                                                    {{-- <img src="{{ url($shipSchedule['ship_image']) }}" alt="" style=""> --}}
                                                                    <img src="{{ env('UPLOADED_ASSETS') . $shipSchedule['ship_image'] }}"
                                                                        alt="" style="">
                                                                </div>

                                                                <div class="ferryDetails ms-3 ">

                                                                    <div class="ferryName">
                                                                        <h4 class="mb-3">
                                                                            {{ $shipSchedule['ship_name'] }}
                                                                        </h4>
                                                                        <p class="mb-3">
                                                                            Departure Time
                                                                            {{ date('H:i', strtotime($shipSchedule['departure_time'])) }}
                                                                        </p>
                                                                        <p class="mb-3">
                                                                            Arrival Time
                                                                            {{ date('H:i', strtotime($shipSchedule['arraival_time'])) }}
                                                                        </p>

                                                                        <p class="mb-3">
                                                                            {{ $round2_route_titles['from_location'] }}
                                                                            -
                                                                            {{ $round2_route_titles['to_location'] }}
                                                                        </p>

                                                                    </div>

                                                                    <div class="classBtn">
                                                                        @foreach ($shipSchedule['ship_class'] as $ferryPrice)
                                                                            <a href="#"
                                                                                id="{{ 'ferry_' . $ferryPrice->class_name . '_' . $key + 1 }}"
                                                                                data-ferryschedule-id="{{ $ferryPrice->route_id }}"
                                                                                data-class_id="{{ $ferryPrice->class_id }}"
                                                                                data-from="{{ $round2_route_titles['from_location'] }}"
                                                                                data-to="{{ $round2_route_titles['to_location'] }}"
                                                                                data-departure_time="{{ date('H:i', strtotime($shipSchedule['departure_time'])) }}"
                                                                                data-arrival_time="{{ date('H:i', strtotime($shipSchedule['arraival_time'])) }}"
                                                                                data-class-title="{{ $ferryPrice->class_name }}"
                                                                                data-price="{{ $ferryPrice->adult_seat_rate }}"
                                                                                data-psf="{{ $ferryPrice->port_fee }}"
                                                                                data-avl_seat="{{ $ferryPrice->seat_available }}"
                                                                                data-ship_name="{{ $ferryPrice->ferry_name }}"
                                                                                class="btn {{ $ferryPrice->class_name }}  ferry-btn mb-2">
                                                                                <p class="text-white mb-0">
                                                                                    {{ $ferryPrice->class_name }}
                                                                                </p>
                                                                                <p class="text-white mb-0"
                                                                                    style="text-decoration: line-through;">
                                                                                    ₹ {{ $ferryPrice->adult_seat_rate }}
                                                                                </p>
                                                                                <p class="text-white mb-0">
                                                                                    ₹
                                                                                    {{ $ferryPrice->adult_seat_rate - 100 }}
                                                                                </p>
                                                                                <p class="text-white mb-0">
                                                                                    Seat: {{ $ferryPrice->seat_available }}
                                                                                </p>
                                                                                <p class="bg-green-text-white mb-0">
                                                                                    Book Now
                                                                                </p>
                                                                            </a>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        {{-- Modal for light box on ship logo --}}
                                                        <div class="modal fade"
                                                            id="imageModal-{{ $shipSchedule['id'] }}" tabindex="-1"
                                                            aria-labelledby="imageModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-body light_box">
                                                                        <div id="shipIMG-{{ $shipSchedule['id'] }}"
                                                                            class="carousel slide light_box">
                                                                            <div class="carousel-inner">
                                                                                @php
                                                                                    $k = 1;
                                                                                @endphp

                                                                                @if (!empty($shipSchedule['ship']['images']))
                                                                                    @foreach ($shipSchedule['ship']['images'] as $key => $shipImage)
                                                                                        <div
                                                                                            class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                                                            {{-- <img src="{{ asset(trim($shipImage['image_path'])) }}" 
                                                                                class="w-100" alt="Boat Image"> --}}
                                                                                            <img src="{{ env('UPLOADED_ASSETS') . $shipImage['image_path'] }}"
                                                                                                class="w-100"
                                                                                                alt="Image">
                                                                                        </div>
                                                                                        @php
                                                                                            $k++;
                                                                                        @endphp
                                                                                    @endforeach
                                                                                @else
                                                                                    @foreach ($shipSchedule['ship'] as $shipImage)
                                                                                        @foreach ($shipImage->images as $images)
                                                                                            <div
                                                                                                class="carousel-item {{ $k == 1 ? 'active' : '' }}">
                                                                                                <img src="{{ env('UPLOADED_ASSETS') . $images->image_path }}"
                                                                                                    class="w-100"
                                                                                                    alt="Image">
                                                                                            </div>
                                                                                        @endforeach

                                                                                        @php
                                                                                            $k++;
                                                                                        @endphp
                                                                                    @endforeach
                                                                                @endif
                                                                            </div>
                                                                            <button class="carousel-control-prev"
                                                                                type="button"
                                                                                data-bs-target="#shipIMG-{{ $shipSchedule['id'] }}"
                                                                                data-bs-slide="prev">
                                                                                <span class="carousel-control-prev-icon"
                                                                                    aria-hidden="true"></span>
                                                                                <span
                                                                                    class="visually-hidden">Previous</span>
                                                                            </button>
                                                                            <button class="carousel-control-next"
                                                                                type="button"
                                                                                data-bs-target="#shipIMG-{{ $shipSchedule['id'] }}"
                                                                                data-bs-slide="next">
                                                                                <span class="carousel-control-next-icon"
                                                                                    aria-hidden="true"></span>
                                                                                <span class="visually-hidden">Next</span>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </main>

@endsection

@push('js')
    <script type="text/javascript">

        window.onload = function() {
            // Scroll to a specific pixel position
            window.scrollTo({
                top: document.getElementById('searchResultsPage').offsetTop, 
                behavior: 'smooth' // Optional for smooth scrolling
            });
        }

        function maxpassenger(element) {
            if (element.value < 1 || element.value > 20) {

                $(element).val('');
            }
        }

        // end validation for return date
        function enableDiv1() {
            $(".tabs.tabs1.row.mx-0").find("input, select, button").prop("disabled", false);
        }

        function disableDiv() {

            $(".tabs.tabs2.mx-0").find("input, select, button").prop("disabled", true);
        }

        function disableDiv1() {
            $(".tabs.tabs1.row.mx-0").find("input, select, button").prop("disabled", true);
        }

        function enableDiv() {
            $(".tabs.tabs2.mx-0").find("input, select, button").prop("disabled", false);
        }

        disableDiv();

        $(".tabBtn.tabBtn1").on("click", function() {
            enableDiv1();
            disableDiv();
        });

        $(".tabBtn.tabBtn2").on("click", function() {
            enableDiv();
            disableDiv1();
        });


        function getQueryParams() {
            const params = new URLSearchParams(window.location.search);
            return {
                tripType: params.get('trip_type'),

            };
        }


        $(document).ready(function() {

            // Joydev



            const seatsSl = [];


            $('.ferryImg').on('click', function() {
                var ferryId = $(this).data('ferry-id');
                $('#imageModal-' + ferryId).modal('show');
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // document.getElementById('form_location').addEventListener('change', function() {
            //     updateToLocationOptions();
            // });
            // updateToLocationOptions();

            var clickCount = 0;

            $('.ferry-btn').on('click', function(event) {
                event.preventDefault();
                
                var avl_seat = $(this).data('avl_seat');
                var passenger = $('#passenger').val();
                
                if (avl_seat < passenger) {
                    alert('Not Enough Seat Available')
                    die();
                }
                
                var element = $(this);
                
                var shipClass = $(this).data('class_id');
                
                // remove all selected seat an d let user select new
                $('.luxury-down').find('.seat').removeClass("selected");
                $("#trip1seatcount").val(0);
                
                var shipName = $(this).data('ship_name');

                $.ajax({
                    url: '{{ url('booking-data-store') }}',
                    method: 'POST',
                    data: {
                        trip: 1,
                        ship: $(this).data('ship_name'),
                        scheduleId: $(this).data('ferryschedule-id'),
                        shipClass: $(this).data('class_id')
                    },
                    success: function(response) {
                        var results = JSON.parse(response);
                        if (results.seats) {
                            var seats = results.seats;
                            Object.entries(seats).forEach(([key, value]) => {
                                if (value.isBooked == 1 || value.isBlocked == 1) {
                                
                                    $('.' + value.number + '.' + results.ship_class).each(function() {
                                            $(this).addClass('booked');
                                        });
                                }
                                $('.' + value.number + '.' + results.ship_class).each(
                                    function() {
                                        $(this).attr('data-trip-no', '1');
                                        $(this).attr('data-seat-no', value.number);
                                    });
                            });

                            if (shipClass == 'pClass') {
                                $("#luxuryContainer").css('display', 'block');
                                $("#royalContainer").css('display', 'none');
                            } else if (shipClass == 'bClass') {
                                $("#royalContainer").css('display', 'block');
                                $("#luxuryContainer").css('display', 'none');
                            }
                        }

                        var shipName = element.data('ship_name');
                        
                        const gShipName = "Green Ocean";

                        @if (request('trip_type') == 1)

                            
                            if ((shipName != 'Nautika') && (shipName.indexOf(gShipName) == -1)) {
                                var newUrl = "{{ route('booking-ferry') }}";
                                window.location.href = newUrl;
                                // $(document).find("#nav-contact-tab").removeClass('disabled')
                                //     .trigger("click");
                                
                            }
                        @else
                            
                            if ((shipName != 'Nautika') && (shipName.indexOf(gShipName) == -1)) {
                                $(document).find("#nav-contact-tab").removeClass('disabled').prop('disabled', false)
                                    .trigger("click");
                            }

                            
                        @endif

                        var ferryScheduleId = element.data('ferryschedule-id');
                        var shipId = element.data('ship_id');
                        var classId = element.data('class_id');
                        var tripId = element.data('trip_id');
                        var vesselId = element.data('vessel_id');
                        var from = element.data('from');
                        var to = element.data('to');
                        var departureTime = element.data('departure_time');
                        var arrivalTime = element.data('arrival_time');
                        var classTitle = element.data('class-title');
                        var price = element.data('price');
                        var psf = element.data('psf');
                        var avlSeat = element.data('avl_seat');
                        
                        var trip1Details = {
                            'ship_id' : shipId,
                            'ship_name' : shipName,
                            'ferryschedule_id' : ferryScheduleId,
                            'class_id' : classId,
                            'trip_id' : tripId,
                            'vessel_id' : vesselId,
                            'from' : from,
                            'to' : to,
                            'departure_time' : departureTime,
                            'arrival_time' : arrivalTime,
                            'class_title' : classTitle,
                            'price' : price,
                            'psf' : psf,
                            'avl_seat' : avlSeat,
                        };
                        
                        var trip1Detailsstr = JSON.stringify(trip1Details);
                        $("#trip1details").val(trip1Detailsstr);

                        // if green ocean ship get ship seat layout
                        // console.log(shipName.indexOf(gShipName) == 0);
                        
                        if (shipName.indexOf(gShipName) == 0) {

                            $.ajax({
                                url: '{{ url('get-green-ship-layout') }}',
                                method: 'POST',
                                // dataType: 'JSON',
                                data: {
                                    trip: 1,
                                    class_id: classId,
                                    ship_id: shipId,
                                    // ferry_id: shipId,
                                    route_id: ferryScheduleId
                                },
                                success: function(seatRes) {
                                    $("#modalGreenOceanSeat .seat-layout").empty();
                                    $("#modalGreenOceanSeat .seat-layout").data('trip-no', 1);
                                    $("#modalGreenOceanSeat .seat-layout").append(seatRes);
                                    $('#modalGreenOceanSeat').modal('show');
                                }
                            });
                            
                        }
                    },
                    error: function(xhr) {
                    }
                });
            });


                // when round 2 booking 
            $('.ferry-btn2').on('click', function(event) {
                event.preventDefault();

                var avl_seat = $(this).data('avl_seat');
                var passenger = $('#passenger').val();

                if (avl_seat < passenger) {
                    alert('Not Enough Seat Available');
                    die();
                }

                var element = $(this);

                var shipClass = $(this).data('class_id');
                var shipName = $(this).data('ship_name');

                

                // remove all selected seat an d let user select new
                $('.luxury-down').find('.seat').removeClass("selected");
                $("#trip2seatcount").val(0);

                $.ajax({
                    url: '{{ url('booking-data-store') }}',
                    method: 'POST',
                    data: {
                        trip: 2,
                        ship: $(this).data('ship_name'),
                        scheduleId: $(this).data('ferryschedule-id'),
                        shipClass: $(this).data('class_id')
                    },
                    success: function(response) {
                        var results = JSON.parse(response)

                        if (results.seats) {
                            var seats = results.seats;
                            Object.entries(seats).forEach(([key, value]) => {
                                
                                if (value.isBooked == 1 || value.isBlocked == 1) {
                                    // $("." + value.number).addClass("booked");
                                    $('.' + value.number + '.' + results.ship_class)
                                        .each(function() {
                                            $(this).addClass('booked');
                                        });
                                } else {
                                    $('.' + value.number + '.' + results.ship_class)
                                        .each(function() {
                                            $(this).removeClass('booked');
                                    });
                                }

                                $('.' + value.number + '.' + results.ship_class).each(
                                    function() {
                                        $(this).attr('data-trip-no', '2');
                                        $(this).attr('data-seat-no', value.number);
                                    });
                            });

                            if (shipClass == 'pClass') {
                                $("#luxuryContainer").css('display', 'block');
                                $("#royalContainer").css('display', 'none');
                            } else if (shipClass == 'bClass') {
                                $("#royalContainer").css('display', 'block');
                                $("#luxuryContainer").css('display', 'none');
                            }
                        }

                        var shipName = element.data('ship_name');
                        @if (request('trip_type') == 2)
                            if (shipName != 'Nautika') {
                                var newUrl = "{{ route('booking-ferry') }}";
                                window.location.href = newUrl;
                                // $(document).find("#nav-contact-tab").removeClass('disabled')
                                //     .trigger("click");
                            }
                        @else
                            
                            if (shipName != 'Nautika') {
                                $(document).find("#nav-extra-tab").removeClass('disabled').prop("disabled", false)
                                    .trigger("click");
                            }
                            
                        @endif
                            var ferryScheduleId = element.data('ferryschedule-id');
                            var classId = element.data('class_id');
                            var tripId = element.data('trip_id');
                            var vesselId = element.data('vessel_id');
                            var from = element.data('from');
                            var to = element.data('to');
                            var departureTime = element.data('departure_time');
                            var arrivalTime = element.data('arrival_time');
                            var classTitle = element.data('class-title');
                            var price = element.data('price');
                            var psf = element.data('psf');
                            var avlSeat = element.data('avl_seat');
                            
                            var trip2Details = {
                                'ship_name' : shipName,
                                'ferryschedule_id' : ferryScheduleId,
                                'class_id' : classId,
                                'trip_id' : tripId,
                                'vessel_id' : vesselId,
                                'from' : from,
                                'to' : to,
                                'departure_time' : departureTime,
                                'arrival_time' : arrivalTime,
                                'class_title' : classTitle,
                                'price' : price,
                                'psf' : psf,
                                'avl_seat' : avlSeat,
                            };
                            
                            var trip2Detailsstr = JSON.stringify(trip2Details);
                            $("#trip2details").val(trip2Detailsstr);
                        
                    },
                    error: function(xhr) {
                    }
                });


            });


            // when round 3 booking 
            $('.ferry-btn3').on('click', function(event) {
                event.preventDefault();

                var avl_seat = $(this).data('avl_seat');
                var passenger = $('#passenger').val();

                if (avl_seat < passenger) {
                    alert('Not Enough Seat Available')
                    die();
                }

                var element = $(this);

                var shipClass = $(this).data('class_id');
                var shipName = $(this).data('ship_name');

                

                

                // remove all selected seat an d let user select new
                $('.luxury-down').find('.seat').removeClass("selected");
                $("#trip3seatcount").val(0);

                $.ajax({
                    url: '{{ url('booking-data-store') }}',
                    method: 'POST',
                    data: {
                        trip: 3,
                        ship: $(this).data('ship_name'),
                        scheduleId: $(this).data('ferryschedule-id'),
                        shipClass: $(this).data('class_id')
                    },
                    success: function(response) {

                        var results = JSON.parse(response)
                        if (results.seats) {
                            var seats = results.seats;
                            Object.entries(seats).forEach(([key, value]) => {
                                if (value.isBooked == 1 || value.isBlocked == 1) {
                                    // $("." + value.number).addClass("booked");
                                    $('.' + value.number + '.' + results.ship_class)
                                        .each(function() {
                                            $(this).addClass('booked');
                                        });
                                } else {
                                    $('.' + value.number + '.' + results.ship_class)
                                        .each(function() {
                                            $(this).removeClass('booked');
                                        });
                                }

                                $('.' + value.number + '.' + results.ship_class).each(
                                    function() {
                                        $(this).attr('data-trip-no', '3');
                                        $(this).attr('data-seat-no', value.number);
                                    });
                            });

                            if (shipClass == 'pClass') {
                                $("#luxuryContainer").css('display', 'block');
                                $("#royalContainer").css('display', 'none');
                            } else if (shipClass == 'bClass') {
                                $("#royalContainer").css('display', 'block');
                                $("#luxuryContainer").css('display', 'none');
                            }

                            var shipName = element.data('ship_name');

                            // var shipName = element.data('ship_name');
                            var ferryScheduleId = element.data('ferryschedule-id');
                            var classId = element.data('class_id');
                            var tripId = element.data('trip_id');
                            var vesselId = element.data('vessel_id');
                            var from = element.data('from');
                            var to = element.data('to');
                            var departureTime = element.data('departure_time');
                            var arrivalTime = element.data('arrival_time');
                            var classTitle = element.data('class-title');
                            var price = element.data('price');
                            var psf = element.data('psf');
                            var avlSeat = element.data('avl_seat');
                            
                            var trip3Details = {
                                'ship_name' : shipName,
                                'ferryschedule_id' : ferryScheduleId,
                                'class_id' : classId,
                                'trip_id' : tripId,
                                'vessel_id' : vesselId,
                                'from' : from,
                                'to' : to,
                                'departure_time' : departureTime,
                                'arrival_time' : arrivalTime,
                                'class_title' : classTitle,
                                'price' : price,
                                'psf' : psf,
                                'avl_seat' : avlSeat,
                            };
                            
                            var trip3Detailsstr = JSON.stringify(trip3Details);
                            $("#trip3details").val(trip3Detailsstr);

                        } else if (shipName != 'Nautika') {
                            var newUrl = "{{ route('booking-ferry') }}";
                            window.location.href = newUrl;
                        }

                        // var newUrl = "{{ route('booking-ferry') }}";
                        // window.location.href = newUrl;
                    },
                    error: function(xhr) {
                    }
                });
            });

            $(".tabBtn2").click(function() {
                $(".ferryBanner ").addClass("secHeight");
            })
            $(".tabBtn1").click(function() {
                $(".ferryBanner").removeClass("secHeight");
                $(".tabs2").children(".row").removeClass("hide");
            });

            $('#date').flatpickr({
                dateFormat: 'Y-m-d',
                minDate: "today"
            });
            $('#round_date').flatpickr({
                dateFormat: 'Y-m-d',
                minDate: "today"
            });

            $('#round1_date').flatpickr({
                dateFormat: 'Y-m-d',
                minDate: "today"
            });
            $('#round2_date').flatpickr({
                dateFormat: 'Y-m-d',
                minDate: "today"
            });

            $("#lds-spinner").addClass('d-none');
            $(document).on('click', "#search", function(e) {

                $("#lds-spinner").removeClass('d-none');
                var car_id = $(this).val();
            });

            $(document).on('click', ".delete", function(e) {
                var row = $(this).closest(".row");
                row.html("");
                row.removeClass("border-bottom");
            });

            $("#round-trip").on("click", function() {
                $("#trip_type").val('3');
            });

            $("#one-way").on("click", function() {
                $("#trip_type").val('1');
            });

            $(".trip-delete").on("click", function() {
                $tripVal = parseInt($("#trip_type").val()) - 1;
                $("#trip_type").val($tripVal);
            });

            @if(request('trip_type') > 1)
                $(".tabBtn1").removeClass('active');
                $(".tabBtn2").trigger("click")
            @endif

            // $(".seat").click(function() {
            $(document).on('click', ".seat", function() {
                element = $(this);
                
                var no_of_pax = $("#passenger").val();
                const curTripNo = element.data('trip-no');

                // console.log("curTripNo == " + curTripNo);
                

                $(this).toggleClass("selected");
                
                if (curTripNo == 1) {
                    if ($(this).hasClass('selected')) {
                        var selectedSeat = parseInt($("#trip1seatcount").val(), 10);
                        selectedSeat += 1;
                        $("#trip1seatcount").val(selectedSeat);

                        var trip1seatcount = parseInt($("#trip1seatcount").val(), 10);
                        if (no_of_pax < trip1seatcount) {
                            alert('Maximum Seat Already Selected');
                            $(this).removeClass("selected");
                            trip1seatcount -= 1;
                            $("#trip1seatcount").val(trip1seatcount);

                            return false;
                        }
                        var element = $(this);
                        var seat_nos = [];

                        $(this).parents('.luxury-down').find('.seat.selected').each(function(index) {
                            var seat = $(this).data('seat-no');
                            
                            if (!seat_nos.includes(seat)) {
                                seat_nos.push(seat);
                            }
                        });

                        // $.ajax({
                        //     headers: {
                        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        //     },
                        //     url : "{{ url('store_selected_seats') }}",
                        //     data : {
                        //             'seat_nos' : seat_nos,
                        //             'curTripNo': curTripNo,
                        //             },
                        //     type : 'POST',
                        //     dataType : 'json',
                        //     success : function(data){
                        //     }
                        // });

                        seatsSl.push(seat_nos);

                        var seatsString = JSON.stringify(seat_nos);
                        $("#trip1seatNo").val(seatsString);
                    } else {
                        // alert('not selected')
                        var selectedSeat = parseInt($("#trip1seatcount").val(), 10);
                        selectedSeat -= 1;
                        $("#trip1seatcount").val(selectedSeat);

                        var seats = $("#trip1seatNo").val();
                        var seat_nos = JSON.parse(seats);

                        const index = seat_nos.indexOf($(this).data('seat-no'));
                        if (index > -1) { // only splice seat_nos when item is found
                            seat_nos.splice(index, 1); // 2nd parameter means remove one item only
                        }

                        var seatsString = JSON.stringify(seat_nos);
                        $("#trip1seatNo").val(seatsString);
                    }

                }

                if (curTripNo == 2) {
                    if ($(this).hasClass('selected')) {
                        var selectedSeat = parseInt($("#trip2seatcount").val(), 10);
                        selectedSeat += 1;
                        $("#trip2seatcount").val(selectedSeat);

                        var trip2seatcount = parseInt($("#trip2seatcount").val(), 10);
                        if (no_of_pax < trip2seatcount) {
                            alert('Maximum Seat Already Selected');
                            $(this).removeClass("selected");
                            trip2seatcount -= 1;
                            $("#trip2seatcount").val(trip2seatcount);
                            return false;

                        }
                        var element = $(this);
                        var seat_nos = [];

                        $(this).parents('.luxury-down').find('.seat.selected').each(function(index) {
                            var seat = $(this).data('seat-no');
                            if (!seat_nos.includes(seat)) {
                                seat_nos.push(seat);
                            }
                        });

                        var seatsString = JSON.stringify(seat_nos);
                        $("#trip2seatNo").val(seatsString);


                        // $('#nautika-proceed').click(function() {});
                        
                    } else {
                        // alert('not selected')
                        var selectedSeat = parseInt($("#trip2seatcount").val(), 10);
                        selectedSeat -= 1;
                        $("#trip2seatcount").val(selectedSeat);

                        var seats = $("#trip2seatNo").val();
                        var seat_nos = JSON.parse(seats);

                        const index = seat_nos.indexOf($(this).data('seat-no'));
                        if (index > -1) { // only splice seat_nos when item is found
                            seat_nos.splice(index, 1); // 2nd parameter means remove one item only
                        }

                        var seatsString = JSON.stringify(seat_nos);
                        $("#trip2seatNo").val(seatsString);
                        // console.log(seatsString);

                        // $("#trip1seatNo").val(seats);
                    }

                }

                if (curTripNo == 3) {
                    if ($(this).hasClass('selected')) {
                        var selectedSeat = parseInt($("#trip3seatcount").val(), 10);
                        selectedSeat += 1;
                        $("#trip3seatcount").val(selectedSeat);

                        var trip3seatcount = parseInt($("#trip3seatcount").val(), 10);

                        if (no_of_pax < trip3seatcount) {
                            alert('Maximum Seat Already Selected');
                            $(this).removeClass("selected");
                            trip3seatcount -= 1;
                            $("#trip3seatcount").val(trip3seatcount);
                            return false;
                        }
                        var element = $(this);
                        var seat_nos = [];

                        // $(this).parents('.luxury-down').find('.seat.selected').each(function(index) {
                        // console.log(element.parents('.luxury-down').find('.seat.selected'));
                        
                            element.parents('.luxury-down').find('.seat.selected').each(function(index) {
                            var seat = $(this).data('seat-no');
                            if (!seat_nos.includes(seat)) {
                                seat_nos.push(seat);
                            }
                        });
                        seatsSl.push(seat_nos);
                        // console.log('Selected seats:', seat_nos);
                        var seatsString = JSON.stringify(seat_nos);
                        $("#trip3seatNo").val(seatsString);
                        // console.log("curTripNo == " + curTripNo + " || seat_nos" + seat_nos + " || seatsString" + seatsString);

                        // $('#nautika-proceed').click(function() {});
                        
                    } else {
                        // alert('not selected')
                        var selectedSeat = parseInt($("#trip3seatcount").val(), 10);
                        selectedSeat -= 1;
                        $("#trip3seatcount").val(selectedSeat);

                        // console.log(selectedSeat);
                        

                        var seats = $("#trip3seatNo").val();
                        var seat_nos = JSON.parse(seats);

                        const index = seat_nos.indexOf($(this).data('seat-no'));
                        if (index > -1) { // only splice seat_nos when item is found
                            seat_nos.splice(index, 1); // 2nd parameter means remove one item only
                        }

                        var seatsString = JSON.stringify(seat_nos);
                        $("#trip3seatNo").val(seatsString);
                        // console.log(seatsString);

                        // $("#trip1seatNo").val(seats);
                    }

                }
                
                // console.log($("#trip1seatNo").val());

            });

            // ### Green Ocan Seat Selection
            $("#modalGreenOceanSeat").on("click", ".btn.class_selection.onewaysel.enablebutton", function(){
                var curEl = $(this);
                
                var no_of_pax = $("#passenger").val();
                const curTripNo = curEl.parents('.seat-layout').data('trip-no');
                
                curEl.toggleClass("selected");
                
                if (curTripNo == 1) {
                    if (curEl.hasClass('selected')) {
                        var selectedSeat = parseInt($("#trip1seatcount").val(), 10);
                        selectedSeat += 1;
                        $("#trip1seatcount").val(selectedSeat);

                        var trip1seatcount = parseInt($("#trip1seatcount").val(), 10);
                        if (no_of_pax < trip1seatcount) {
                            alert('Maximum Seat Already Selected');
                            curEl.removeClass("selected");
                            trip1seatcount -= 1;
                            $("#trip1seatcount").val(trip1seatcount);

                            return false;
                        }
                        // var element = curEl;
                        var seat_nos = [];

                        curEl.parents('.seat-layout').find('.btn.class_selection.onewaysel.enablebutton.selected').each(function(index) {
                            var seat = this.value; //curEl.data('seat-no');
                            
                            if (!seat_nos.includes(seat)) {
                                seat_nos.push(seat);
                            }
                        });

                        seatsSl.push(seat_nos);

                        var seatsString = JSON.stringify(seat_nos);
                        $("#trip1seatNo").val(seatsString);
                    } else {
                        // alert('not selected')
                        var selectedSeat = parseInt($("#trip1seatcount").val(), 10);
                        selectedSeat -= 1;
                        $("#trip1seatcount").val(selectedSeat);

                        var seats = $("#trip1seatNo").val();
                        var seat_nos = JSON.parse(seats);

                        const index = seat_nos.indexOf(curEl.data('seat-no'));
                        if (index > -1) { // only splice seat_nos when item is found
                            seat_nos.splice(index, 1); // 2nd parameter means remove one item only
                        }

                        var seatsString = JSON.stringify(seat_nos);
                        $("#trip1seatNo").val(seatsString);
                    }

                }
            });

            // $("#nautika_proceed").on('click', function() {
            $(document).on('click', "#confirm_seats", function() {
                var curEl = $(this);
                var selectedTotalSeats = 0;
                var modalTripNo = '';
               
                if (curEl.parents('.modal-content').find('.luxury-down').length >= 1) { // for nautica
                    curEl.parents('.modal-content').find('.luxury-down').find('.seat.selected').each(function(index) {
                        selectedTotalSeats++;
                        modalTripNo = $(this).data('trip-no');
                    });
                } else if (curEl.parents('.modal-content').find('.seat-layout').length >= 1) { // for green ocean
                    
                    curEl.parents('.modal-content').find('.seat-layout').find('.btn.class_selection.onewaysel.enablebutton.selected').each(function(index) {
                        selectedTotalSeats++;
                        modalTripNo = $(this).parents('.seat-layout').data('trip-no');                        
                    });
                }

                const urlParams = new URLSearchParams(window.location.search);
                const trip_type = urlParams.get('trip_type');
                var no_of_pax = $("#passenger").val();

                if (selectedTotalSeats < no_of_pax) {
                    alert("Please select seat first.");
                } else {
                    // console.log("Final modalTripNo " + modalTripNo);

                    var ajaxDataSet = {};
                    
                    if (modalTripNo == 1) {
                        var trip1DetailsStr = $("#trip1details").val();
                        var trip1Details = JSON.parse(trip1DetailsStr);

                        var trip1SeatNo = $("#trip1seatNo").val();


                        ajaxDataSet = {
                            trip: modalTripNo,
                            ship: trip1Details.ship_name,
                            scheduleId: trip1Details.ferryschedule_id,
                            shipClass: trip1Details.class_id,
                            tripSeatNo: trip1SeatNo,
                        }

                        

                        $(document).find("#nav-contact-tab").removeClass('disabled').prop("disabled", false).trigger("click");
                    } else if (modalTripNo == 2) {

                        var trip2DetailsStr = $("#trip2details").val();
                       
                        var trip2Details = JSON.parse(trip2DetailsStr);

                        var trip2SeatNo = $("#trip2seatNo").val();


                        ajaxDataSet = {
                            trip: modalTripNo,
                            ship: trip2Details.ship_name,
                            scheduleId: trip2Details.ferryschedule_id,
                            shipClass: trip2Details.class_id,
                            tripSeatNo: trip2SeatNo,
                        }

                        $(document).find("#nav-extra-tab").removeClass('disabled').prop("disabled", false).trigger("click");
                    } if (modalTripNo == 3) {
                        var trip3DetailsStr = $("#trip3details").val();
                     
                        var trip3Details = JSON.parse(trip3DetailsStr);

                        var trip3SeatNo = $("#trip3seatNo").val();

                        // console.log(trip3SeatNo);
                        // return false;
                        


                        ajaxDataSet = {
                            trip: modalTripNo,
                            ship: trip3Details.ship_name,
                            scheduleId: trip3Details.ferryschedule_id,
                            shipClass: trip3Details.class_id,
                            tripSeatNo: trip3SeatNo,
                        }

                        // var tripType = $("#trip_type").val();
                        // var passenger = $("#passenger").val();
                        // var infant = $("#infant").val();

                        // var formLocation = $("#form_location").val();
                        // var toLocation = $("#to_location").val();
                        // var roundDate = $("#round_date").val();

                        // var round1FormLocation = $("#round1_from_location").val();
                        // var round1ToLocation = $("#round1_to_location").val();
                        // var round1Date = $("#round1_date").val();

                        // var round2FormLocation = $("#round2_from_location").val();
                        // var round2ToLocation = $("#round2_to_location").val();
                        // var round2Date = $("#round2_date").val();


                        // var trip1DetailsStr = $("#trip1details").val();
                        // var trip1Details = JSON.parse(trip1DetailsStr);
                        // var trip1Seatcount = $("#trip1seatcount").val();
                        // var trip1SeatNo = $("#trip1seatNo").val();

                        
                        // var trip2DetailsStr = $("#trip2details").val();
                        // var trip2Details = JSON.parse(trip2DetailsStr);
                        // var trip2Seatcount = $("#trip2seatcount").val();
                        // var trip2SeatNo = $("#trip2seatNo").val();
                        
                        // var trip3DetailsStr = $("#trip3details").val();
                        // var trip3Details = JSON.parse(trip3DetailsStr);
                        // var trip3Seatcount = $("#trip3seatcount").val();
                        // var trip3SeatNo = $("#trip3seatNo").val();

                        // var bookingData = [
                        //     {
                        //         'trip_type': tripType,
                        //         'form_location': formLocation,
                        //         'to_location': toLocation,
                        //         'date': roundDate,
                        //         'round1_from_location': round1FormLocation,
                        //         'round1_to_location': round1ToLocation,
                        //         'round1_date': round1Date,
                        //         'round2_from_location': round2FormLocation,
                        //         'round2_to_location': round2ToLocation,
                        //         'round2_date': round2Date,
                        //         'no_of_passenger': passenger,
                        //         'no_of_infant': infant,
                        //         'schedule': [
                        //             {
                        //                 'ship': trip1Details.ship_name,
                        //                 'scheduleId': trip1Details.ferryschedule_id,
                        //                 'shipClass': trip1Details.class_id,
                        //                 'tripSeatNo': trip1SeatNo,
                        //             },
                        //             {
                        //                 'ship': trip2Details.ship_name,
                        //                 'scheduleId': trip2Details.ferryschedule_id,
                        //                 'shipClass': trip2Details.class_id,
                        //                 'tripSeatNo': trip2SeatNo,
                        //             },
                        //             {
                        //                 'ship': trip3Details.ship_name,
                        //                 'scheduleId': trip3Details.ferryschedule_id,
                        //                 'shipClass': trip3Details.class_id,
                        //                 'tripSeatNo': trip3SeatNo,
                        //             },
                        //         ],
                        //     }
                        // ];

                        // var bookingDataStr = JSON.stringify(bookingData);
                        
                        

                        // var hdnForm = `<form action="{{ url('booking-ferry') }}" id="customHiddenForm" method="post">
                        //                     @csrf
                        //                     <input type="hidden" name="booking_data" id="booking_data">
                        //                 </form>`;

                        // $('body').append(hdnForm);

                        // $('body').find('#customHiddenForm').find('#booking_data').val(bookingDataStr);
                        // $('body').find('#customHiddenForm').submit();

                    }


                    $.ajax({
                        url: '{{ url('booking-seat-data-store-session') }}',
                        method: 'POST',
                        data: ajaxDataSet,
                        success: function(response) {
                            // return false;

                            $('#exampleModal').modal('hide');
                            $('#modalGreenOceanSeat').modal('hide');

                            if (trip_type == 1 && modalTripNo == 1) {
                                var newUrl = "{{ route('booking-ferry') }}";
                                window.location.href = newUrl;
                            }
                            if (trip_type == 2 && modalTripNo == 2) {
                                var newUrl = "{{ route('booking-ferry') }}";
                                window.location.href = newUrl;
                            }
                            if (trip_type == 3 && modalTripNo == 3) {
                                var newUrl = "{{ route('booking-ferry') }}";
                                window.location.href = newUrl;
                            }
                        }
                    });

                    
                    
                }
                
                // $('#modal_id').modal('hide');
                // $(document).find("#nav-contact-tab").removeClass('disabled').trigger("click");
            });

        });
    </script>
@endpush
