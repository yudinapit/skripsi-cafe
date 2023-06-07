$(function() {
    const listMenu = $('#listMenu');
    const categoryItem = $('.category-item');
    const skeletonMenu = $('#skeletonMenu');
    const modalDetailMenu = $('#modalDetailMenu');
    const modalDetailMenuTitle = modalDetailMenu.find('.name-menu-detail');
    const qtyMenuInput = modalDetailMenu.find('.qty-menu-input');
    const addToCart = modalDetailMenu.find('.add-to-cart');
    const formAddToCart = modalDetailMenu.find('#formAddToCart');
    const formRemoveToCart = modalDetailMenu.find('#formRemoveCart');
    const doneMenu = $('.done-menu');
    const notesAdd = listMenu.find('.notes-add');
    const modalNotes = $('#modalNotes');
    const notesMenu = modalNotes.find('.notes-menu');
    const saveToCart = modalNotes.find('#saveToCart');


    updateCart();

    $('.category-item').on('click', function() {
        categoryItem.removeClass('active');
        $(this).addClass('active');
        const category = $(this).data('filter');
        getMenu(category);
    });

    notesMenu.on('keyup', function() {
        changeNotesMenu(this);
    }).on('change', function() {
        changeNotesMenu(this);
    }).on('keypress', function() {
        changeNotesMenu(this);
    });

    function changeNotesMenu(element) {
        let length = $(element).val()?.length;
        $('.lengthText').text(length);
        if(length > 199) {
            $(element).val($(element).val().slice(0, 200));
            changeNotesMenu(element);
        }
    }

    listMenu.on('click', '.notes-add', function() {
        const id = $(this).data('id');
        getData(`/menu/getDetailMenu/${id}`, {select: 'id,title,price'}, 'GET', function(data) {
            modalNotes.find('.name-menu-detail').text(data.title);
            let notesCurrent = filterData(JSON.parse(localStorage.getItem('cart')) ?? [{}], 'id', data.id);
            if(notesCurrent?.notes)
                notesMenu.val(notesCurrent.notes)
            else
                notesMenu.val('');
            saveToCart.find('input[name=id]').val(data.id);
            modalNotes.modal('show');
        });
    });

   listMenu.on('click', '.edit-item', function() {
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
            formRemoveToCart.find('input[name=id]').val(data.id)
            modalDetailMenu.modal('show');
        });
    });

    modalNotes.find('#saveToCart').on('submit', function(e) {
        e.preventDefault();
        let cart = getCart();
        let id =  saveToCart.find('input[name=id]').val();
        let data = filterData(cart, 'id', id);
        if(!data)
            window.location =  `/menu/list/${code_table}`;
        const valNotes = notesMenu.val();
        data = {
            id: id,
            title: data.title,
            qty: data.qty,
            price: data.price,
            notes: valNotes
        };
        setAddToCart(data, true);
        modalNotes.modal('hide');
    }).on('hide.bs.modal', function() {
        notesMenu.val('');
        saveToCart.find('input[name=id]').val('');
    });

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
    }).on('submit', '#formRemoveCart', function(e) {
        e.preventDefault();
        const id = $(this).find('input[name=id]').val();
        const cart = JSON.parse(localStorage.getItem('cart'));
        const index = cart.findIndex(function(item) {
            return item.id == id;
        });
        cart.splice(index, 1);
        setCart(cart);
        updateCart();
        removeChart(id);
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
            price: price
        };
        setAddToCart(data);
    }).on('hidden.bs.modal', function() {
        qtyMenuInput.val(0);
        addToCart.attr('data-id', '');
        addToCart.attr('data-price', '');
    });

    doneMenu.on('click', function() {
        let cart = JSON.parse(localStorage.getItem('cart'));
        if(cart?.length > 0)
            getData(`/menu/list/checkout/${code_table}`, {data: JSON.stringify(cart), type: 'last'}, 'POST', function(data) {
                if(data.status == true) {
                    localStorage.removeItem('cart');
                    window.location = `/menu/checkout/done`;
                }
            });
        else
            Swal.fire('Belum ada item terplih!', 'Silahkan pilih item terlebih dahulu', 'error')
    });

});

function setAddToCart(data, notes = null) {
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

    if(notes)
        cart[index].notes = data.notes;

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
    if(cart?.length == 0)
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

function arraySumTriple(data, name1, name2, name3) {
    let total = 0;
    data?.forEach(function(item, index) {
        total += (parseInt(item[name1]) * parseInt(item[name2])) * name3
    });
    return total;
}

function updateCart() {
    let cart = localStorage.getItem('cart');
    cart = JSON.parse(cart);
    if(cart?.length < 1)
        window.location =  `/menu/list/${code_table}`;

    let qtyTotal = arraySum(cart, 'qty');
    let priceTotal = arraySumQty(cart, 'qty', 'price');
    let serviceCharge = arraySumTriple(cart, 'price', 'qty', 0.05);
    let pb1 = arraySumTriple(cart, 'price', 'qty', 0.10);
    let totalAll = priceTotal + serviceCharge + pb1;

    let qtySelected = $('#listMenu').find('.menu-item .card-body').find('.qty-selected');
    qtySelected.each((index, item) => {
        if(filterData(cart, 'id', $(item).data('id')))
            $(item).text(filterData(cart, 'id', $(item).data('id')).qty);
        else
            $(item).text(0);
    });

    cart.forEach((item, index) => {
        let element = '';
        if(item.notes !== '') {
            element = `<button data-id="${item.id}"  class="btn btn-secondary rounded-12 font-size-12 font-weight-700 border-0 px-4 notes-add" style="background: #EFEFEF; color: #513819">
                            <i class="fas fa-pencil-alt"></i>
                        </button>`
            $(`#notes-desc-${item.id}`).removeClass('d-none');
            $(`#notes-desc-${item.id}`).html(`<b>Notes</b> : <span class="font-size-12" style="color: #848484; font-weight: 400;">${item.notes}</span>`);
        }else {
            element = `<button class="btn btn-secondary rounded-12 font-size-12 font-weight-700 border-0 px-3 notes-add" data-id="${item.id}" style="background: #EFEFEF; color: #513819">
                            <img src="/assets/frontend/img/file-coffee.svg"/>
                            Notes
                        </button>`
            $(`#notes-desc-${item.id}`).addClass('d-none');
            $(`#notes-desc-${item.id}`).html('');
        }

        $(`#notesMenu-${item.id}`).html(element);
    });

    $('.qty-item').text(qtyTotal);
    $('.service-charge-total').text(`Rp ${numberFormatMoney(serviceCharge)}`);
    $('.pb1-total').text(`Rp ${numberFormatMoney(pb1)}`);
    $('.price-total').text(`Rp ${numberFormatMoney(priceTotal)}`);
    $('.total-all').text(`Rp ${numberFormatMoney(totalAll)}`);
}

function removeChart(id) {
    $('#listMenu').find(`#menuSelect-${id}`).remove();
    getData(`/menu/list/${code_table}/deleteCart`, {id: id}, 'POST');
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
