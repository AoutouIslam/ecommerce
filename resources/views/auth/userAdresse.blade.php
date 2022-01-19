@extends('layouts.app')

@section('content')

@if(session()->has('message'))

<div id="successMessage" class="flex flex-wrap flex-row place-items-centerm-1 font-medium py-1 px-2 bg-white rounded-md text-green-700 bg-green-100 border border-green-300 ">
    <div slot="avatar">
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle w-5 h-5 mx-2">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
    </div>
    <div class="text-xl font-normal  text-center item-center max-w-full flex-initial">
        {{Session::get("message")}}</div>
    <div class="flex flex-auto flex-row-reverse">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x cursor-pointer hover:text-green-400 rounded-full w-5 h-5 ml-2">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </div>
    </div>
</div>
@endif
<div class="flex justify-center grid">


    <div class="lg:w-11/12 bg-white p-6 rounded-lg">
        <form action="{{ route('userAdresse') }}" method="POST">
            @csrf

            @php
            $valeurTotal = 0;
            $valeur_laivraison = $wilayas[0]['prix_laivraison'];
            @endphp
            <div class="mb-4 grid grid-cols-2">
                <div>
                <label for="prenom" class="sr-only">prénom</label>
                <input type="text" name="prenom" id="prenom" placeholder="prénom"
                class="bg-gray-100 border-2 w-3/4 text-center m-2 p-4 rounded-lg @error('prenom') border-red-500 @enderror" value="{{ old('prenom') }}">
                @error('prenom')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
                </div>
                <div>
                <label for="Nom" class="sr-only">Nom</label>
                <input type="text" name="Nom" id="Nom" placeholder="nom "
                class="bg-gray-100 border-2 w-3/4 p-4 m-2 text-center rounded-lg @error('Nom') border-red-500 @enderror" value="{{ old('Nom') }}">
                @error('Nom')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>

            <div class="mb-4">
                <p> addrèsse de laivraison</p>
                <label for="Addresse" class="sr-only">Addrèsse de Laivraison</label>
                <input type="text" name="Addresse" id="Addresse"  placeholder="Addrèsse de Laivraison"
                class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('Addresse') border-red-500 @enderror" value="{{ old('Addresse') }}">
                @error('Addresse')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-4 grid grid-cols-2">
                <div>
                <label class="block text-left" style="max-width: 400px">
                    <span class="text-gray-700">Wilaya</span>
                    <input type="hidden" id="wilaya_code" name="wilaya_code" value="" >
                    <select class="form-select block w-11/12 h-10 my-1 border border-gray-600 wilaya_select"  name="wilaya_select" id="wilaya_select">
                    @foreach ($wilayas as $wilaya)
                    <option value="{{$wilaya->code}}">{{ $wilaya->wilaya}} ({{$wilaya->code}})</option>
                    @endforeach

                    </select>
                </label>

                @error('wilaya_code')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
                </div>

                <div>
                <label class="block text-left" style="max-width: 400px">
                    <span class="text-gray-700">Comuune</span>

                    <select class="form-select block w-11/12 h-10 my-1 border border-gray-600 commune_select" name="commune_select" id="commune_select">
                        <option value="">séléctioner une wilaya</option>
                    </select>
                </label>
                @error('commune_select')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="zipCode" class="sr-only">Zip Code</label>
                <input type="text" name="zipCode" id="zipCode" placeholder="choisiser le zip code"
                class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('zipCode') border-red-500 @enderror" value="">
                @error('zipCode')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-4  grid grid-cols-4">
                <div>
                <select class="form-select block w-3/4 h-14 my-1 border border-gray-600" name="phone_select" id="phone_select">
                        <option value="" class="h-14">Séléctioner</option>
                        <option value="06" class="h-14">06</option>
                        <option value="07" class="h-14">07</option>
                        <option value="05" class="h-14">05</option>

                    </select>
                </div>
                <div class="col-span-3">
                <label for="phone" class="sr-only ">Phone</label>
                <input type="text" name="phone" id="phone" placeholder="numéro de téléphone"
                class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('phone') border-red-500 @enderror" value="{{ old('phone') }}">
                @error('phone')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
                </div>
            </div>


            <div>
                <button type="submit" class="bg-red-500 text-white px-4 py-3 rounded font-medium w-full">Ajouter Adresse</button>
            </div>

        </form>
    </div>


    <script>
        $(document).ready(function(){
            $('.wilaya_select').change(function(e)
            {
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

           var selected =  $(".wilaya_select option:selected" ).text();
           var value = $(".wilaya_select option:selected" ).val();
           var data = {
                    'wilaya_code' : value,
                    "_token": "{{ csrf_token() }}",
                }

        $.ajax({
                    method: "POST",
                    url: "selectCommune",
                    data: data,
                    dataType: "json",
                    success: function(response)
                    {


                    $(".prix_laivraison").html("+" + response[1].prix_laivraison +" DA pour la laivraison");
                    $("#wilaya_code").val(value);
                       content = '';
                    for (var x = 0; x < response[0].length; x++)
                    {
                        content += '<option value= "' + response[0][x].nom_commune +' ">';
                        content += response[0][x].nom_commune;
                        content += '</option>';
                    }
                    $('.commune_select').children().remove().end()
                    $('.commune_select').append(content);
               }

                });

        });

        });
</script>
</div>
@endsection
