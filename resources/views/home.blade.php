@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Hero Section-->
    <div class="md:flex md:flex-row mt-20">
        <div class="md:w-2/5 flex flex-col justify-center text-center md:text-left items-center">
            <h2 class="font-serif text-5xl text-gray-600 mb-4">Deco & Cado</h2>
            <p class="uppercase text-gray-600 tracking-wide">our brand tagline goes here</p>
            <p class="uppercase text-gray-600 tracking-wide">our brand motto goes here</p>
            <a href="" class="bg-gradient-to-r from-red-600 to-pink-500 rounded-full py-4 px-8 text-gray-50 uppercase text-xl md:self-start my-4">SHop now</a>
        </div>
        <div class="md:w-3/5">
            <img src="{{URL::asset( 'files/images/hero-img.svg' )}}" class="w-full" alt="">
        </div>
    </div>
    <!-- hero section end--->



</div>
<!--Tous les Articles begin -->
<div class="m-10">
    <div class="flex flex-row justify-between m-10">
        <a href="{{route( 'article',['category' => 'All','sort' => 'partinence'] )}}" class="text-3xl">Article</a>

    </div>
    <div class="grid grid-flow-row grid-cols-2 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2 lg:gap-10 rounded-lg ">


        @if ($articles->count())

                @foreach ($articles->take(4) as $article)
                 @php
                {{

                    $test = str_replace('"', '', $article->images_article);
                    $test = str_replace('[','',$test);
                    $test = str_replace(']','',$test);
                    $data = explode(',',$test);

                    $color = str_replace(']', '', $article->color);
                    $color = str_replace('[','',$color);
                    $colors =  explode(';',$color);
                }}
                @endphp


        <div class="bg-white shadow-lg rounded-lg relative mt-4">

            @if($data[0] .= "")
            <a href="#">
            <img  src="{{ URL::asset($article->image_location . '/images/'. $data[0] ) }}" class="h-50 w-full rounded-lg rounded-tl-lg rounded-tr-lg"/>    </a>

            @else
            <a href="#">
            <img src="{{ URL::asset( 'files/images/error.png' ) }}" class="h-50 w-full rounded-lg rounded-tl-lg rounded-tr-lg"/>    </a>
            @endif
                <!-- div h3 begin--->
            <div class="p-5">
                <h3 class="text-center"><a href="#"> {{ $article->nom_article}}</a></h3>


                <div class="flex flex-row  sm:justify-center grid grid-cols-1 md:grid-cols-2">
                    @foreach ($article->demensions as $dem)
                    @php
                        $d = explode(',',$dem->demension);
                    @endphp
                    <div class="border-2 border-gray-300 text-gray-700 rounded-md text-sm px-2  mr-1 my-1 text-center">{{$d[0] ."X" . $d[1] . "X" . $d[2] ."CM"}}</div>
                   <!--- <div class="text-black rounded-md text-xs px-2 py-2 mr-1">X</div>
                    <div class="border-2 border-gray-300 text-gray-400 rounded-md text-xs px-2 py-1 mr-1">{{$d[1]}}</div>
                    <div class="text-black rounded-md text-xs px-2 py-2 mr-1">X</div>
                    <div class="border-2 border-gray-300 text-gray-400 rounded-md text-xs px-2 py-1 mr-1">{{$d[2]}}</div>
                    <div class="text-black rounded-md text-xs px-2 py-2 mr-1">CM</div>-->
                    @endforeach

                </div> <!--end div sizes-->

                <div class="flex flex-row my-1 justify-center">
                    @foreach ($colors as $c)
                    <div class="h-6 w-6 rounded-full shadow-md mr-2" style="background-color: {{ $c }};"></div>
                    @endforeach
                </div><!-- end div colors-->

                <!-- div sizes start-->


                @if($article->demensions[0]->is_promo   == "yes")
            @php
                    if($article->demensions[0]->is_promo == "yes"){

                    $debut = new DateTime($article->demensions[0]->promo_debut);
                    $fin = new DateTime($article->demensions[0]->promo_fin);
                    $now = new DateTime('NOW');
                    $debut_diffrence = $now->getTimestamp()- $debut->getTimestamp();
                    $fin_diffrence =  $now->getTimestamp() - $fin->getTimestamp();
                    }
                    @endphp
            @if($debut_diffrence >= 0 && $fin_diffrence < 0)
            <div class="bg-gray-50 px-1 rounded-full no-border text-red-500 font-bold uppercase absolute top-0 mt-2 mr-2 right-0">
                <span>{{$article->demensions[0]->promo_price}} DA</span>
            </div>
            <div class="bg-gradient-to-r from-gray-50 to-transparent  px-1  rounded-full no-border font-bold uppercase  absolute top-0 mt-2 mr-24 right-0 text-base text-gray-700 line-through">
                <span>{{$article->demensions[0]->prix_vente}} DA</span>
            </div>
            @else
            <div class="bg-gray-50 px-2 rounded-full no-border text-red-500 font-bold uppercase absolute top-0 mt-2 mr-2 right-0">
                <span>{{$article->demensions[0]->prix_vente}} DA</span>
            </div>
            @endif
            @else
            <div class="bg-gray-50 px-2 rounded-full no-border text-red-500 font-bold uppercase  absolute top-0 mt-2 mr-2 right-0">
                <span>{{$article->demensions[0]->prix_vente}}  DA</span>
            </div>
            @endif

                <div class="flex flex-col  xl:flex-row justify-between product_favori">
                    <input type="text" name="qteInput" class="product_id" id="qteInput" value="{{$article->id}}" hidden class="text">
                    <a href="#" class="justify-center my-2  bg-gradient-to-r from-red-600 to-pink-500 rounded-full py-2 px-4 text-gray-50 text-xs flex flex-row hover:from-pink-600 hover:to-pink-600 favori">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 favoriIcon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                          </svg>
                        favori
                    </a>

                   <!-- <a href="#" class="justify-center my-2 bg-purple-600 rounded-full py-2 px-4 text-gray-50 flex flex-row text-xs hover:bg-purple-700 ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                          </svg>
                        details
                    </a>-->
                </div>
            </div> <!--end div h3 -->

        </div>

        @endforeach

        @endif
    </div> <!--end article new-->
    </div>
<!--Tous les Articles End-->




<!--newletter Section-->
<div class="rounded-lg shadow-lg my-20 flex flex-row">
    <div class="lg:w-3/5 w-full bg-gradient-to-r lg:from-black lg:via-purple-900 lg:to-transparent from-black to-purple-900 rounded-lg text-gray-100 p-12">
        <div class="lg:w-1/2">
            <h3 class="text-2xl font-extrabold mb-4">inscrivez-vous pour recevoir nos offres</h3>
            <p class="mb-4 leading-relaxed">Vous voulez savoir quand nous avons de nouvelles offres ? Inscrivez-vous à notre newsletter et nous vous enverrons
                un e-mail chaque fois que nous aurons de nouvelles offres de vente..</p>
        </div>
        <div class="">
            <input type="text" placeholder="entrer votre email " class="bg-gray-600 text-gray-200 placeholder-gray-400 px-4 py-3 w-3/4 rounded-lg focus:outline-none mb-4">
            <button type="submit" class="bg-red-600 py-3 rounded-lg w-3/4 ">Envoyer</button>
        </div>
    </div>
    <div class="lg:w-2/5 w-full lg:flex lg:flex-row hidden">
        <img src="{{ URL::asset( 'files/images/subscribe-banner.png' ) }}" alt="">
    </div>

</div>
<!--newletter Section End-->


@endsection
