function calculateSellingPrice() {
    var quantity = document.getElementById('quantity').value;
    var unitcost = document.getElementById('unitcost').value;

    if (quantity && unitcost) {
        fetch('api/sales/calculateSalesPrice', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF token
            },
            body: JSON.stringify({ quantity: quantity, unitcost: unitcost })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('sellingprice').value = data.sellingprice;
        })
        .catch(error => console.error('Error:', error));
    }
}         