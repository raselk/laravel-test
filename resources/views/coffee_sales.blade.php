<script type="text/javascript" src="{{asset('js/calculatesaleprice.js') }}"></script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New ☕️ Sales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <form action="{{ route('sale.store')}}" method="post">
                        @csrf  

                        <div class="form-group">
                            <label for="productid">{{ __('Product') }}</label>
                            <select name="productid" id="productid" oninput="calculateSellingPrice()">
                                @foreach ($products as $product)
                                    <option value="{{ $product->id}}">{{ $product->name }}</option>   
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="quantity">{{ __('Quantity') }}</label>
                            <input type="number" id="quantity" name="quantity" value="0" min="0" oninput="calculateSellingPrice()">
                        </div>
                
                        <div class="form-group">
                            <label for="unitcost">{{ __('Unit Cost (£)') }}</label>
                            <input type="number" id="unitcost" name="unitcost" value="0.00" min="0" step="0.01" oninput="calculateSellingPrice()">
                        </div>                    

                        <div class="form-group">
                            <label for="sellingprice">{{ __('Selling price') }}</label>
                            <input type="number" id="sellingprice" name="sellingprice" placeholder="0.00" readonly>
                        </div>
                        <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                            {{ __('Record Sale') }}
                        </button>
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif                    
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Previous Sales') }}</h2>
                    <div class="div-table">
                        
                        <div class="div-table-row header">
                            <div class="div-table-cell">{{ __('Product') }}</div>
                            <div class="div-table-cell">{{ __('Quantity') }}</div>
                            <div class="div-table-cell">{{ __('Unit cost') }}</div>
                            <div class="div-table-cell">{{ __('Selling Price') }}</div>
                            <div class="div-table-cell">{{ __('Sold at') }}</div>
                        </div>
                        @forelse ($sales as $sale)
                        <div class="div-table-row">
                            <div class="div-table-cell">{{ $sale->CoffeeProduct->name ?? 'n/a'  }}</div>
                            <div class="div-table-cell">{{ $sale->quantity }}</div>
                            <div class="div-table-cell"><x-money amount="{{ $sale->unitcost*100 }}" currency="GBP" /></div>
                            <div class="div-table-cell"><x-money amount="{{ $sale->sellingprice*100 }}" currency="GBP" /></div>
                            <div class="div-table-cell">{{ $sale->created_at }}</div>
                        </div>                        
                        @empty
                        <div class="div-table-row">
                            No sales to report yet
                        </div>                          
                        @endforelse
                        {{ $sales->links() }}                           
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
