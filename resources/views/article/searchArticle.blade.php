@extends('layouts.app')

@section('content')
<!--article old end-->
<div class="m-20">
    <div class="bg-white" id="search_box">

    </div>
<div class="flex flex-col xl:flex-row  justify-between m-10">
    <h2 class="text-3xl">Article</h2>

<!-- search div begin--->
    <div class="">
        <div class="container  h-14 flex justify-center items-center px-4 sm:px-6 lg:px-8">
            <div class="relative">
                <form action="{{route('article.search')}}" >
                    @csrf
                 <input type="text" name="searchBox" id="searchBox" class="h-10 w-76 lg:w-96 pr-8 pl-5 rounded z-0 focus:shadow focus:outline-none" placeholder="Rechercher Votre Article...">
                <div id="serach_result" class="serach_result h-24"></div>
                 <div class="absolute top-2 right-3"> <button type="submit"> <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                  </svg> </button> </div>
                </form>
            </div>
        </div>
    </div>

<!-- search div end--->
<!-- Dropdown menu begin--->
<div class="relative ">


        <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider" class="text-white bg-gray-700 w-44 hover:text-gray-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Trier Par<svg class="ml-16 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
<!-- Dropdown menu -->
<div id="dropdownDivider" class="hidden absolute z-10 w-44 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
    <ul class="py-1" aria-labelledby="dropdownDividerButton">
      <li>
        <a href="{{URL::current()."?sort=partinence&search=" .$search}}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">partinence</a>
      </li>
      <li>
        <a href="{{URL::current(). "?sort=new&search=" .$search}}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Nouveau</a>
      </li>
      <li>
        <a href="{{URL::current() ."?sort=price_asc&search=" .$search}}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Prix: bas au haut</a>
      </li>
    </ul>
    <div class="py-1">
      <a href="{{URL::current(). "?sort=price_desc&search=" .$search}}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Prix: haut au bas</a>
    </div>
    </div>
      </div>

      <!-- Dropdown menu end--->
</div>
<div class="grid grid-flow-row grid-cols-1 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10 rounded-lg ">


    @if ($articles->count())

            @foreach ($articles as $article)
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


    <div class="shadow-lg rounded-lg relative mt-4">




        @if($data[0] != "")
        <a href="#">
        <img src="{{ URL::asset($article->image_location . '/images/'. $data[0] ) }}" class="h-80 w-full rounded-lg rounded-tl-lg rounded-tr-lg"/>    </a>

        @else
        <a href="#">
        <img src="{{ URL::asset( 'files/images/error.png' ) }}" class="h-80 w-full rounded-lg rounded-tl-lg rounded-tr-lg"/>    </a>
        @endif
            <!-- div h3 begin--->
        <div class="p-5">
            <h3 class="text-center"><a href="#"> {{ $article->nom_article}}</a></h3>


            <div class="flex flex-row my-3 sm:justify-center grid grid-cols-2">
                @foreach ($article->demension() as $dem)
                @php
                    $d = explode(',',$dem->demension);
                @endphp
                <div class="border-2 border-gray-300 text-gray-400 rounded-md text-xs px-2 py-1 mr-1 my-1">{{$d[0] ."X" . $d[1] . "X" . $d[2] ."CM"}}</div>
               <!--- <div class="text-black rounded-md text-xs px-2 py-2 mr-1">X</div>
                <div class="border-2 border-gray-300 text-gray-400 rounded-md text-xs px-2 py-1 mr-1">{{$d[1]}}</div>
                <div class="text-black rounded-md text-xs px-2 py-2 mr-1">X</div>
                <div class="border-2 border-gray-300 text-gray-400 rounded-md text-xs px-2 py-1 mr-1">{{$d[2]}}</div>
                <div class="text-black rounded-md text-xs px-2 py-2 mr-1">CM</div>-->
                @endforeach

            </div> <!--end div sizes-->

            <div class="flex flex-row my-3 sm:justify-center">
                @foreach ($colors as $c)
                <div class="h-8 w-8 rounded-full shadow-md mr-2" style="background-color: {{ $c }};"></div>
                @endforeach
            </div><!-- end div colors-->

            <!-- div sizes start-->

            @if($article->is_promo   == "yes")
            @php
                    if($article->is_promo == "yes"){

                    $debut = new DateTime($article->promo_debut);
                    $fin = new DateTime($article->promo_fin);
                    $now = new DateTime('NOW');
                    $debut_diffrence = $now->getTimestamp()- $debut->getTimestamp();
                    $fin_diffrence =  $now->getTimestamp() - $fin->getTimestamp();
                    }
                    @endphp
            @if($debut_diffrence >= 0 && $fin_diffrence < 0)
            <div class="bg-gray-50 px-2 rounded-full no-border text-red-500 font-bold uppercase p-1 absolute top-0 mt-2 mr-2 right-0">
                <span>{{$article->demension()[0]->promo_price}} DA</span>
            </div>
            <div class=" px-2  rounded-full no-border font-bold uppercase p-1 absolute top-0 mt-2 mr-24 right-0 text-base text-gray-700 line-through">
                <span>{{$article->demension()[0]->prix_vente}} DA</span>
            </div>
            @else
            <div class="bg-gray-50 px-2 rounded-full no-border text-red-500 font-bold uppercase p-1 absolute top-0 mt-2 mr-2 right-0">
                <span>{{$article->demension()[0]->prix_vente}} DA</span>
            </div>
            @endif
            @else
            <div class="bg-gray-50 px-2 rounded-full no-border text-red-500 font-bold uppercase p-1 absolute top-0 mt-2 mr-2 right-0">
                <span>{{$article->demension()[0]->prix_vente}} DA</span>
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

                <a href="#" class="justify-center my-2 bg-purple-600 rounded-full py-2 px-4 text-gray-50 flex flex-row text-xs hover:bg-purple-700 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                      </svg>
                    details
                </a>
            </div>
        </div> <!--end div h3 -->

    </div>

    @endforeach

    @endif
</div> <!--end article new-->

<div class="mb-4content-center m-10">
    {{ $articles->links() }}
</div>
</div>

<!--article new end-->


<script>
$(document).ready(function()
{
    $('.favori').click(function(e)
        {
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        var prod_id = $(this).closest('.product_favori').find('.product_id').val();
    var data = {

                'product_id' : prod_id,
                "_token": "{{ csrf_token() }}",
            }

            $.ajax({
                method: "POST",
                url: "favori",
                data: data,
                success: function(response)
                {
                   // $(this).closest('.product_favori').find('.favoriIcon')

                  // alert(response);
                }

            });
    });


    $('#dropdownDividerButton').click(function(e)
    {
        $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        if($('#dropdownDivider').hasClass( "hidden" ))
        {
            $('#dropdownDivider').removeClass( "hidden" );
        }else{
            $('#dropdownDivider').addClass( "hidden" );
        }
    });
    $('#searchBox').change(function(e)
    {
        $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        if($('#searchBox').val() != "")
        {
        var search = $('#searchBox').val();
        var data = {
            "_token": "{{ csrf_token() }}",
            'search' : search,
        }
           $.ajax({
                method: "POST",
                url: "search",
                data: data,
                dataType: "json",
                success: function(response)
                {
                   // $(this).closest('.product_favori').find('.favoriIcon')

                  content = '';
                for (var x = 0; x < response[0].length; x++)
                {
                    content += '<p  class="h-4 w-90 text-gray-400 ">';
                    content += response[0][x].nom_article;
                    content += '</p>';
                }
                alert(content);
                $('.search_result').children().remove().end();
                $('.search_result').append(content);
                }

            });
        }


       /* var sort_by = this.value;
        var data = {
            "_token": "{{ csrf_token() }}",
            'sort_by' : sort_by,
        }
           $.ajax({
                method: "POST",
                url: "sort_by",
                data: data,
                success: function(response)
                {
                   // $(this).closest('.product_favori').find('.favoriIcon')

                  alert(response);
                }

            });*/
    });
});

function Sort_by()
{

}
</script>
@endsection
