$(function() {
    const listMenu = $('#listMenu');
    const categoryItem = $('.category-item');
    const skeletonMenu = $('#skeletonMenu');
    const modalDetailMenu = $('#modalDetailMenu');
    const modalDetailMenuTitle = modalDetailMenu.find('.name-menu-detail');
    const qtyMenuInput = modalDetailMenu.find('.qty-menu-input');
    const addToCart = modalDetailMenu.find('.add-to-cart');
    const formAddToCart = modalDetailMenu.find('#formAddToCart');
    const doneMenu = $('.done-menu');
    // modalDetailMenu.show();
    getMenu();
    function getMenu(category = '') {
        listMenu.html(skeletonMenu);
        $.ajax({
            url: `/menu/getMenu?category=${category}&search=${$('#searchMenu').val()}`,
            type: 'GET',
            success: function(data) {
                listMenu.html(data);
                updateCart();
            }
        })
    }

    // search
    const debouncedHandleInput = (category) => debounce(getMenu(category), 1000);
    $('#searchMenu').on('keyup', function() {
        const category = $('.category-item.active').data('filter') ?? null;
        debouncedHandleInput(category);
    });

    // category filter
    $('.category-item').on('click', function() {
        categoryItem.removeClass('active');
        $(this).addClass('active');
        const category = $(this).data('filter');
        getMenu(category);
    });


   // add to cart
   listMenu.on('click', '.menu-item', function() {
        const id = $(this).data('id');
        getData(`/menu/getDetailMenu/${id}`, {select: 'id,title,price'}, 'GET', function(data) {
            modalDetailMenuTitle.text(data.title);
            let qtyCurrent = filterData(JSON.parse(localStorage.getItem('cart')) ?? [{}], 'id', data.id);
            if(qtyCurrent)
                qtyMenuInput.val(qtyCurrent.qty);
            else
                qtyMenuInput.val(0);
            formAddToCart.find('input[name=id]').val(data.id);
            formAddToCart.find('input[name=price]').val(data.price);
            modalDetailMenu.modal('show');
        });
    });
    
    //quantity
    modalDetailMenu.on('click', '.add-qty-detail', function() {
        const qty = parseInt(qtyMenuInput.val());
        qtyMenuInput.val(qty + 1);
    }).on('click', '.min-qty-detail', function() {
        const qty = parseInt(qtyMenuInput.val());
        if(qty > 0)
            qtyMenuInput.val(qty - 1);
    }).on('keyup', '.qty-menu-input', function() {
        const qty = $(this).val();
        qtyMenuInput.val(qty.replace(/[^0-9]/g, ''));
        if(qty < 0)
            qtyMenuInput.val(0);
    }).on('keypress', '.qty-menu-input', function(e) {
        const qty = $(this).val();
        qtyMenuInput.val(qty.replace(/[^0-9]/g, ''));
        if(e.which == 13) {
            modalDetailMenu.find('.add-to-cart').trigger('click');
        }
    }).on('change', '.qty-menu-input', function() {
        const qty = $(this).val();
        qtyMenuInput.val(qty.replace(/[^0-9]/g, ''));
        if(qty < 0)
            qtyMenuInput.val(0);
    }).on('click', '.cancel-qty', function() {
        modalDetailMenu.modal('hide');
    }).find('#formAddToCart').on('submit', function(e) {
        e.preventDefault();
        let id =  formAddToCart.find('input[name=id]').val();
        let price = formAddToCart.find('input[name=price]').val();
        const qty = parseInt(qtyMenuInput.val());
        const title = modalDetailMenuTitle.text();
        const data = {
            id: id,
            title: title,
            qty: qty,
            price: price,
            notes: ''
        };
        setAddToCart(data);
    }).on('hidden.bs.modal', function() {
        qtyMenuInput.val(0);
        addToCart.attr('data-id', '');
        addToCart.attr('data-price', '');
    });

    doneMenu.on('click', function() {
        let cart = JSON.parse(localStorage.getItem('cart'));
        if(cart && cart?.length > 0)
            getData(`/menu/list/checkout/${code_table}`, {data: JSON.stringify(cart)}, 'POST', function(data) {
                console.log(code_table);
                if(data.status == true)
                    window.location = `/menu/list/checkout/${code_table}`
            });
        else
            Swal.fire('Belum ada item terplih!', 'Silahkan pilih item terlebih dahulu', 'error')
    });

});


function setAddToCart(data) {
    let cart = getCart();
    const index = cart.findIndex(function(item) {
        return item.id == data.id;
    });

    if(index == -1)
        cart = [...cart, data];
    else if(data.qty > 0)
        cart[index].qty = data.qty;
    else
        cart.splice(index, 1);

    if(data.qty > 0 || index !== -1)
        setCart(cart);
    updateCart();

    $('#modalDetailMenu').modal('hide')
}

function getCart() {
    const cart = localStorage.getItem('cart');
    if(cart)
        return JSON.parse(cart);
    return [];
}

function setCart(cart) {
    if(cart.length == 0)
        localStorage.removeItem('chart');
    localStorage.setItem('cart', JSON.stringify(cart));
}

function arraySum(data, name) {
    let total = 0;
    data?.forEach(function(item, index) {
        total += parseInt(item[name])
    });
    return total;
}

function arraySumQty(data, name1, name2) {
    let total = 0;
    data?.forEach(function(item, index) {
        total += (parseInt(item[name1]) * parseInt(item[name2]))
    });
    return total;
}

function updateCart() {
    let cart = localStorage.getItem('cart');
    cart = JSON.parse(cart);

    let qtyTotal = arraySum(cart, 'qty');
    let priceTotal = arraySumQty(cart, 'qty', 'price');

    let qtySelected = $('#listMenu').find('.menu-item .card-body').find('.qty-selected');
    qtySelected.each((index, item) => {
        if(filterData(cart, 'id', $(item).data('id')))
            $(item).text(filterData(cart, 'id', $(item).data('id')).qty);
        else
            $(item).text(0);
    });

    $('.qty-item').text(qtyTotal);
    $('.price-total').text(`Rp ${numberFormatMoney(priceTotal)}`);
}

function filterData(data, name, value) {
    return data?.filter((item, index) => item[name] == value)[0] ?? null
}

function getData(url, params = {}, method = 'GET', callback = null) {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    return $.ajax({
        url: url,
        type: method,
        data: params,
        success: function(data) {
            if (callback) {
                callback(data);
            }
        }
    })
}


function numberFormatMoney(n) {
    n = (Number(n).toFixed(2) + '').split('.');
    return n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    // + '.' + (n[1] || '00')
}


function debounce(func, delay) {
    let timeoutId;

    return function(...args) {
      clearTimeout(timeoutId);

      timeoutId = setTimeout(() => {
        func.apply(this, args);
      }, delay);
    };
  }
