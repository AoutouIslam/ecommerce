@extends('layouts.app')

@section('content')

@if(session()->has('message'))

<div id="successMessage" class="flex justify-center items-center m-1 font-medium py-1 px-2 bg-white rounded-md text-green-700 bg-green-100 border border-green-300 ">
    <div slot="avatar">
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle w-5 h-5 mx-2">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
    </div>
    <div class="text-xl font-normal  max-w-full flex-initial">
        {{ session()->get("message")}}</div>
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
    <div class="flex justify-center m-6 overflow-auto">
        <div class="lg:w-6/12 bg-white p-6 rounded-lg">
            <form action="{{route('addarticle')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="Ref" class="text-gray-500 font-bold md:text-center mb-1 md:mb-0 pr-4">Ref Article</label>
                    <input type="text" name="Ref" id="Ref" placeholder="reference de l'Article"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('Ref') border-red-500 @enderror" value="{{ old('Ref') }}">
                    @error('name')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="mb-4">
                    <label for="NomArticle" class="text-gray-500 font-bold md:text-center mb-1 md:mb-0 pr-4">Nom Article</label>
                    <input type="text" name="NomArticle" id="NomArticle" placeholder="Nom de l'Article"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('NomArticle') border-red-500 @enderror" value="{{ old('NomArticle') }}">
                    @error('NomArticle')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="mb-4">
                    <label for="Description" class="text-gray-500 font-bold md:text-center mb-1 md:mb-0 pr-4 ">Description</label>

                    <textarea id="description" name="Description" id="Description" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('Description') border-red-500 @enderror" placeholder="Description de l'article"></textarea>

                    @error('Description')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="mb-4">
                    <label for="category" class="text-gray-500 font-bold md:text-center mb-1 md:mb-0 pr-4 ">categoré :</label>
                    <select name="category" id="category"  class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('Description') border-red-500 @enderror">
                        <option value="">--Choisiser une option SVP--</option>
                        <option value="chambre">Chambre</option>
                        <option value="Salle De Bain">Salle de bain</option>
                        <option value="salle de bain">Cuissine</option>
                        <option value="decoration">décoration</option>
                    </select>
                    @error('category')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- demension 1 begin-->
                <div class="flex flex-wrap -mx-3 mb-2">

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="demensionX1">
                        demension X1
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="demensionX1" name="demensionX1" type="text" placeholder="demension X">

                      @error('demensionX1')
                      <div class="text-red-500 mt-2 text-sm">
                          {{ $message }}
                      </div>
                  @enderror
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="demensionY1">
                          demension Y1
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="demensionY1" name="demensionY1" type="text" placeholder="demension Y">
                        @error('demensionY1')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="demensionZ1">
                        demension Z1
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="demensionZ1" name="demensionZ1" type="text" placeholder="demension Z">
                      @error('demensionZ1')
                      <div class="text-red-500 mt-2 text-sm">
                          {{ $message }}
                      </div>
                     @enderror
                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="demension1PrixAchat">
                          Prix Achat
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="demension1PrixAchat" name="demension1PrixAchat" type="text" placeholder="Prix Achat">

                        @error('demension1PrixAchat')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                      </div>

                      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                          <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="demension1PrixVente">
                            Prix Vente
                          </label>
                          <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="demension1PrixVente" name="demension1PrixVente" type="text" placeholder="Prix Vente">
                          @error('demension1PrixVente')
                          <div class="text-red-500 mt-2 text-sm">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                </div>
                <!-- demension 1 end-->

                <!-- demension 2 begin-->
                <div class="flex flex-wrap -mx-3 mb-2">

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="demensionX2">
                        demension X2
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="demensionX2" name="demensionX2" type="text" placeholder="demension X">

                      @error('demensionX2')
                      <div class="text-red-500 mt-2 text-sm">
                          {{ $message }}
                      </div>
                  @enderror
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="demensionY2">
                          demension Y2
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="demensionY2" name="demensionY2" type="text" placeholder="demension Y">
                        @error('demensionY2')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="demensionZ2">
                        demension Z2
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="demensionZ2" name="demensionZ2" type="text" placeholder="demension Z">
                      @error('demensionZ2')
                      <div class="text-red-500 mt-2 text-sm">
                          {{ $message }}
                      </div>
                     @enderror
                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="demension2PrixAchat">
                          Prix Achat
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="demension2PrixAchat" name="demension2PrixAchat" type="text" placeholder="Prix Achat">

                        @error('demension2PrixAchat')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                      </div>

                      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                          <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="demension2PrixVente">
                            Prix Vente
                          </label>
                          <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="demension2PrixVente" name="demension2PrixVente" type="text" placeholder="Prix Vente">
                          @error('demension2PrixVente')
                          <div class="text-red-500 mt-2 text-sm">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                </div>
                <!-- demension 2 end -->

                <!-- demension 3 begin-->
                <div class="flex flex-wrap -mx-3 mb-2">

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="demensionX3">
                        demension X3
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="demensionX3" name="demensionX3" type="text" placeholder="demension X">

                      @error('demensionX3')
                      <div class="text-red-500 mt-2 text-sm">
                          {{ $message }}
                      </div>
                  @enderror
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="demensionY3">
                          demension Y3
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="demensionY3" name="demensionY3" type="text" placeholder="demension Y">
                        @error('demensionY3')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="demensionZ3">
                        demension Z3
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="demensionZ3" name="demensionZ3" type="text" placeholder="demension Z">
                      @error('demensionZ3')
                      <div class="text-red-500 mt-2 text-sm">
                          {{ $message }}
                      </div>
                     @enderror
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="demension3PrixAchat">
                          Prix Achat
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="demension3PrixAchat" name="demension3PrixAchat" type="text" placeholder="Prix Achat">

                        @error('demension3PrixAchat')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                      </div>

                      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                          <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="demension3PrixVente">
                            Prix Vente
                          </label>
                          <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="demension3PrixVente" name="demension3PrixVente" type="text" placeholder="Prix Vente">
                          @error('demension3PrixVente')
                          <div class="text-red-500 mt-2 text-sm">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                </div>

                <!-- demension 3 end -->

                <!-- demension 4 begin-->
                <div class="flex flex-wrap -mx-3 mb-2">

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="demensionX4">
                        demension X4
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="demensionX4" name="demensionX4" type="text" placeholder="demension X">

                      @error('demensionX4')
                      <div class="text-red-500 mt-2 text-sm">
                          {{ $message }}
                      </div>
                  @enderror
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="demensionY4">
                          demension Y4
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="demensionY4" name="demensionY4" type="text" placeholder="demension Y">
                        @error('demensionY4')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="demensionZ4">
                        demension Z4
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="demensionZ4" name="demensionZ4" type="text" placeholder="demension Z">
                      @error('demensionZ4')
                      <div class="text-red-500 mt-2 text-sm">
                          {{ $message }}
                      </div>
                     @enderror
                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="demension4PrixAchat">
                          Prix Achat
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="demension4PrixAchat" name="demension4PrixAchat" type="text" placeholder="Prix Achat">

                        @error('demension4PrixAchat')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                      </div>

                      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                          <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="demension4PrixVente">
                            Prix Vente
                          </label>
                          <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="demension4PrixVente" name="demension4PrixVente" type="text" placeholder="Prix Vente">
                          @error('demension4PrixVente')
                          <div class="text-red-500 mt-2 text-sm">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                </div>
                <!-- demension 4 end -->

                <div class="md:flex md:justify-center-mx-3 mb-2">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="md:flex md:justify-center block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="ColorArticleA">
                        Coulour A
                      </label>
                      <input type="color" name="ColorArticleA" id="ColorArticleA" placeholder="Colour de l'Article"
                    class="border-2  p-4 rounded-lg @error('ColorArticleA') border-red-500 @enderror" value="{{ old('ColorArticleA') }}">
                      @error('ColorArticleA')
                      <div class="text-red-500 mt-2 text-sm">
                          {{ $message }}
                      </div>
                  @enderror
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">

                        <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="ColorArticleB">
                          Coulour B
                        </label>
                        <input type="checkbox" class="form-checkbox" name="checkboxB" id="checkboxB" onclick="enableDisableAll();"/>
                        <input  disabled type="color" name="ColorArticleB" id="ColorArticleB" placeholder="Colour de l'Article"
                    class="border-2  p-4 rounded-lg @error('ColorArticleB') border-red-500 @enderror" value="{{ old('ColorArticleB') }}">
                      @error('ColorArticleB')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="ColorArticleC">
                        Coulour C
                      </label>
                      <input type="checkbox" class="form-checkbox" name="checkboxC" id="checkboxC" onclick="enableDisableAll();"/>
                      <input disabled type="color" name="ColorArticleC" id="ColorArticleC" placeholder="Colour de l'Article"
                      class="  border-2  p-4 rounded-lg @error('ColorArticleC') border-red-500 @enderror" value="{{ old('ColorArticleC') }}">

                      @error('ColorArticleC')
                      <div class="text-red-500 mt-2 text-sm">
                          {{ $message }}
                      </div>
                     @enderror
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">

                        <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="ColorArticleB">
                          Coulour D
                        </label>
                        <input type="checkbox" class="form-checkbox" name="checkboxD" id="checkboxD" onclick="enableDisableAll();"/>
                        <input  disabled type="color" name="ColorArticleD" id="ColorArticleD" placeholder="Colour de l'Article"
                    class="border-2  p-4 rounded-lg @error('ColorArticleD') border-red-500 @enderror" value="">
                      @error('ColorArticleD')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">

                        <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="ColorArticleE">
                          Coulour E
                        </label>
                        <input type="checkbox" class="form-checkbox" name="checkboxE" id="checkboxE" onclick="enableDisableAll();"/>
                        <input  disabled type="color" name="ColorArticleE" id="ColorArticleE" placeholder="Colour de l'Article"
                    class="border-2  p-4 rounded-lg @error('ColorArticleE') border-red-500 @enderror" value="{{ old('ColorArticleE') }}">
                      @error('ColorArticleE')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">

                        <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="ColorArticleB">
                          Coulour F
                        </label>
                        <input type="checkbox" class="form-checkbox" name="checkboxF" id="checkboxF" onclick="enableDisableAll();"/>
                        <input  disabled type="color" name="ColorArticleF" id="ColorArticleF" placeholder="Colour de l'Article"
                    class="border-2  p-4 rounded-lg @error('ColorArticleF') border-red-500 @enderror" value="{{ old('ColorArticleF') }}">
                      @error('ColorArticleF')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                </div>


                <!--- coulour end --->

                <!--- misc --->
                <div class="md:flex md:justify-center-mx-3 mb-2">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="md:flex md:justify-center block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="MiscA">
                        Decoration A
                      </label>
                      <div class="md:flex">

                        <div class="w-full p-3 text-center">
                            <input type="checkbox" class="form-checkbox" name="checkboxMiscA" id="checkboxMiscA" onclick="enableDisableMiscA();"/>
                            <div class="bg-blue-500 border-dotted w-20 h-12 rounded-lg border-dashed border-2 border-blue-700 bg-gray-100 flex justify-center items-center">
                                <div class="absolute">
                                    <div class="flex flex-col items-center  @error('MiscA') border-red-500 @enderror" >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" stroke="#03419e" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                      </svg> <span class="block text-gray-400 font-normal"></span> </div>
                                </div> <input type="file" disabled class="h-full w-full opacity-0" name="MiscA" id="MiscA">
                            </div>
                        </div>
                    </div>
                      @error('MiscA')
                      <div class="text-red-500 mt-2 text-sm">
                          {{ $message }}
                      </div>
                  @enderror
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="md:flex md:justify-center block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="MiscB">
                            Decoration A
                          </label>
                        <div class="md:flex">

                            <div class="w-full p-3 text-center">
                                <input type="checkbox" class="form-checkbox" name="checkboxMiscB" id="checkboxMiscB" onclick="enableDisableMiscB();"/>
                                <div class="bg-blue-500 border-dotted w-20 h-12 rounded-lg border-dashed border-2 border-blue-700 bg-gray-100 flex justify-center items-center">
                                    <div class="absolute">
                                        <div class="flex flex-col items-center  @error('MiscB') border-red-500 @enderror" >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" stroke="#03419e" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                          </svg> <span class="block text-gray-400 font-normal"></span> </div>
                                    </div> <input type="file" disabled class="h-full w-full opacity-0" name="MiscB" id="MiscB">
                                </div>
                            </div>
                        </div>
                      @error('MiscB')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2" for="MiscC">
                        decoration C
                      </label>

                      <div class="md:flex">

                        <div class="w-full p-3 text-center">
                            <input type="checkbox" class="form-checkbox" name="checkboxMiscC" id="checkboxMiscC" onclick="enableDisableMiscC();"/>
                            <div class="bg-blue-500 border-dotted w-20 h-12 rounded-lg border-dashed border-2 border-blue-700 bg-gray-100 flex justify-center items-center">
                                <div class="absolute">
                                    <div class="flex flex-col items-center @error('MiscB') border-red-500 @enderror" >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" stroke="#03419e" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                      </svg> <span class="block text-gray-400 font-normal"></span> </div>
                                </div> <input type="file" disabled class="h-full w-full opacity-0" name="MiscC" id="MiscC">
                            </div>
                        </div>
                    </div>

                      @error('MiscC')
                      <div class="text-red-500 mt-2 text-sm">
                          {{ $message }}
                      </div>
                     @enderror
                    </div>
                </div>

                <!--- misc end --->

                <!--Prix achat-->
         <!--       <div class="mb-4">
                    <label for="prixAchat" class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2">prix Achat</label>
                    <input type="text" name="prixAchat" id="prixAchat" placeholder="prix d'achat de l'Article"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('prixAchat') border-red-500 @enderror" value="">
                    @error('prixAchat')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>--->
            <!--prix achat end--->
                <!--Prix vente-->
            <!---    <div class="mb-4">
                    <label for="prixArticle" class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2">prix de l'article</label>
                    <input type="text" name="prixArticle" id="prixArticle" placeholder="prix de l'Article"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('prixArticle') border-red-500 @enderror" value="">
                    @error('prixArticle')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>-->
            <!--prix vente end--->

            <!--Prix vente-->
            <div class="mb-4">
                <label for="Stock" class="block uppercase tracking-wide text-center text-gray-700 text-xs font-bold mb-2">Stock</label>
                <input type="text" name="Stock" id="Stock" placeholder="Stock(optionel)"
                class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('Stock') border-red-500 @enderror" value="">
                @error('Stock')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <!--prix vente end--->

                <div class="mb-4">
                    <label for="user_avatar">Upload file</label>
                    <input aria-describedby="user_avatar_help" id="documents" multiple name="documents[]" type="file">
                    <div id="user_avatar_help">Image de l'article</div>


<!--                <div>
                    <label
  class="w-64 flex flex-col items-center px-4 py-6 bg-white rounded-md shadow-md tracking-wide uppercase border border-blue cursor-pointer hover:bg-purple-600 hover:text-white text-purple-600 ease-linear transition-all duration-150">
  <i class="fas fa-cloud-upload-alt fa-3x"></i>
  <span class="mt-2 text-base leading-normal">Select a file</span>
  <input type='file' class="hidden" />
</label>
                </div>-->

                <!--This is the submit button -->
                <div>
                    <button type="submit" class="bg-red-500 text-white px-4 py-3 rounded font-medium w-full">Ajouter Article</button>
                </div>

                </div>
            </form>


        </div>
    </div>


    <script>
    function enableDisableAll()
    {
    cb1 = document.getElementById('checkboxB').checked;
    cb2 = document.getElementById('checkboxC').checked;
    cb3 = document.getElementById('checkboxD').checked;
    cb4 = document.getElementById('checkboxE').checked;
    cb5 = document.getElementById('checkboxF').checked;
    document.getElementById('ColorArticleB').disabled = !cb1;
    document.getElementById('ColorArticleC').disabled = !cb2;
    document.getElementById('ColorArticleD').disabled = !cb3;
    document.getElementById('ColorArticleE').disabled = !cb4;
    document.getElementById('ColorArticleF').disabled = !cb5;
    }


function enableDisableMiscA() {
    cb1 = document.getElementById('checkboxMiscA').checked;

    document.getElementById('MiscA').disabled = !cb1  ;

}
function enableDisableMiscB() {
    cb1 = document.getElementById('checkboxMiscB').checked;

    document.getElementById('MiscB').disabled = !cb1  ;

}

function enableDisableMiscC() {
    cb1 = document.getElementById('checkboxMiscC').checked;

    document.getElementById('MiscC').disabled = !cb1  ;

}

        </script>

<script>
    ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection
