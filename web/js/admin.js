$(function () {
    $('.sidebar-menu a').each(function () {
        let location = window.location.protocol + '//' + window.location.host + window.location.pathname;
        let link = this.href;

        if (link == location){
            $('.sidebar-menu li').removeClass('active');
            $(this).parent().addClass('active');
            $(this).closest('.treeview').addClass('active');
        }
    })
});

window.onload = function () {
    let volumeInput = document.querySelectorAll('.form-check'),
        volumeContent = document.querySelector(".price__content");


    let volumeData = {
        grams: `
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-1">Ціна за 200 грам</label>
                <input type="number" id="price-1" class="form-control" name="price_200" data-volume = "200" autocomplete="off">
            </div>

            <div class="form-group _price col-md-3">
                <label class="control-label" for="price-2">Ціна за 300 грам</label>
                <input type="number" id="price-2" class="form-control" name="price_300" data-volume = "300" autocomplete="off">
            </div>

            <div class="form-group _price col-md-3">
                <label class="control-label" for="price-3">Ціна за 400 грам</label>
                <input type="number" id="price-3" class="form-control" name="price_400" data-volume = "400" autocomplete="off">
            </div>

            <div class="form-group _price col-md-3">
                <label class="control-label" for="price-4">Ціна за 500 грам</label>
                <input type="number" id="price-4" class="form-control" name="price_500" data-volume = "500" autocomplete="off">
            </div>

            <div class="form-group _price col-md-3">
                <label class="control-label" for="price-5">Ціна за 600 грам</label>
                <input type="number" id="price-5" class="form-control" name="price_600" data-volume = "600" autocomplete="off">
            </div>

            <div class="form-group _price col-md-3">
                <label class="control-label" for="price-6">Ціна за 700 грам</label>
                <input type="number" id="price-6" class="form-control" name="price_700" data-volume = "700" autocomplete="off">
            </div>

            <div class="form-group _price col-md-3">
                <label class="control-label" for="price-7">Ціна за 800 грам</label>
                <input type="number" id="price-7" class="form-control" name="price_800" data-volume = "800" autocomplete="off">
            </div>

            <div class="form-group _price col-md-3">
                <label class="control-label" for="price-8">Ціна за 900 грам</label>
                <input type="number" id="price-8" class="form-control" name="price_900" data-volume = "900" autocomplete="off">
            </div>

            <div class="form-group _price col-md-3">
                <label class="control-label" for="price-9">Ціна за 1000 грам</label>
                <input type="number" id="price-9" class="form-control" name="price_1000" data-volume = "1000" autocomplete="off">
            </div>

            <div class="form-group _price _price col-md-3">
                <label class="control-label" for="price-10">Ціна за 1500 грам</label>
                <input type="number" id="price-10" class="form-control" name="price_1500" data-volume = "1500" autocomplete="off">
            </div>

            <div class="form-group _price col-md-3">
                <label class="control-label" for="price-11">Ціна за 2000 грам</label>
                <input type="number" id="price-11" class="form-control" name="price_2000" data-volume = "2000" autocomplete="off">
            </div>
        `,
        kilograms: `
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-1">Ціна за 1 кілограм</label>
                <input type="number" id="price-1" class="form-control" name="price_200" data-volume = "1" autocomplete="off">
            </div>
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-2">Ціна за 2 кілограми</label>
                <input type="number" id="price-2" class="form-control" name="price_200" data-volume = "2" autocomplete="off">
            </div>
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-3">Ціна за 3 кілограми</label>
                <input type="number" id="price-3" class="form-control" name="price_200" data-volume = "3" autocomplete="off">
            </div>
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-4">Ціна за 4 кілограми</label>
                <input type="number" id="price-4" class="form-control" name="price_200" data-volume = "4" autocomplete="off">
            </div>
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-5">Ціна за 5 кілограм</label>
                <input type="number" id="price-5" class="form-control" name="price_200" data-volume = "5" autocomplete="off">
            </div>
        `,
        liters: `
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-1">Ціна за 1 літр</label>
                <input type="number" id="price-1" class="form-control" name="price_200" data-volume = "1" autocomplete="off">
            </div>
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-2">Ціна за 2 літри</label>
                <input type="number" id="price-2" class="form-control" name="price_200" data-volume = "2" autocomplete="off">
            </div>
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-3">Ціна за 3 літри</label>
                <input type="number" id="price-3" class="form-control" name="price_200" data-volume = "3" autocomplete="off">
            </div>
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-4">Ціна за 4 літри</label>
                <input type="number" id="price-4" class="form-control" name="price_200" data-volume = "4" autocomplete="off">
            </div>
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-5">Ціна за 5 літрів</label>
                <input type="number" id="price-5" class="form-control" name="price_200" data-volume = "5" autocomplete="off">
            </div>
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-6">Ціна за 6 літрів</label>
                <input type="number" id="price-6" class="form-control" name="price_200" data-volume = "6" autocomplete="off">
            </div>
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-7">Ціна за 7 літрів</label>
                <input type="number" id="price-7" class="form-control" name="price_200" data-volume = "7" autocomplete="off">
            </div>
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-8">Ціна за 8 літрів</label>
                <input type="number" id="price-8" class="form-control" name="price_200" data-volume = "8" autocomplete="off">
            </div>
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-9">Ціна за 9 літрів</label>
                <input type="number" id="price-9" class="form-control" name="price_200" data-volume = "9" autocomplete="off">
            </div>
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-10">Ціна за 10 літрів</label>
                <input type="number" id="price-10" class="form-control" name="price_200" data-volume = "10" autocomplete="off">
            </div>
        `,
        count: `
                <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-1">Ціна за 1 штуку</label>
                <input type="number" id="price-1" class="form-control" name="price_200" data-volume = "1" autocomplete="off">
            </div>
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-2">Ціна за 2 штуки</label>
                <input type="number" id="price-2" class="form-control" name="price_200" data-volume = "2" autocomplete="off">
            </div>
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-3">Ціна за 3 штуки</label>
                <input type="number" id="price-3" class="form-control" name="price_200" data-volume = "3" autocomplete="off">
            </div>
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-4">Ціна за 4 штуки</label>
                <input type="number" id="price-4" class="form-control" name="price_200" data-volume = "4" autocomplete="off">
            </div>
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-5">Ціна за 5 штук</label>
                <input type="number" id="price-5" class="form-control" name="price_200" data-volume = "5" autocomplete="off">
            </div>
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-6">Ціна за 6 штук</label>
                <input type="number" id="price-6" class="form-control" name="price_200" data-volume = "6" autocomplete="off">
            </div>
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-7">Ціна за 7 штук</label>
                <input type="number" id="price-7" class="form-control" name="price_200" data-volume = "7" autocomplete="off">
            </div>
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-8">Ціна за 8 штук</label>
                <input type="number" id="price-8" class="form-control" name="price_200" data-volume = "8" autocomplete="off">
            </div>
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-9">Ціна за 9 штук</label>
                <input type="number" id="price-9" class="form-control" name="price_200" data-volume = "9" autocomplete="off">
            </div>
            <div class="form-group _price col-md-3" >
                <label class="control-label" for="price-10">Ціна за 10 штук</label>
                <input type="number" id="price-10" class="form-control" name="price_200" data-volume = "10" autocomplete="off">
            </div>
        `
    }


    let labelVolume = document.querySelectorAll(".form-check-label"),
        inputVolume = document.querySelectorAll(".iCheck-helper");

    labelVolume.forEach(item => {
        item.addEventListener("click", activeVolume)
    })

    inputVolume.forEach(item => {
        item.addEventListener("click", activeVolume)
    })

    let volume_type = document.querySelector('input[name="volume-type"]:checked').id;
    let volume = volumeContent.children;
    let test = '';
    for (let i = 0; i < volume.length; i++){
        test += volume[i].outerHTML;
    }
    volumeData[volume_type] = test;

    function activeVolume(){
        let volume_type = document.querySelector('input[name="volume-type"]:checked').id;

        volumeContent.innerHTML = volumeData[volume_type];
        price(volume_type);
    }
    activeVolume();

    function price(volume_type) {
        let fieldsPrice = document.querySelectorAll("._price input"),
            inputRes = document.querySelector("#product-option"),
            form = document.querySelector('#form-product');

        console.log(form);

        form.addEventListener('submit', function () {
            console.log("1");
            if (valid()){
                console.log("2");
                inputRes.value = generatePrice();
                form.submit();
            }else {
                //console.log("Huy")
            }
        });

        fieldsPrice.forEach(input => {
            input.addEventListener('input', function () {
                if (input.value == ''){
                    input.closest(".form-group").classList.add("has-error");
                }else {
                    input.closest(".form-group").classList.remove("has-error");
                }
            })
        })

        function valid(){
            console.log("valid");
            // let count = fieldsPrice.length;
            let i = 0;
            fieldsPrice.forEach(input => {
                if (input.value == ''){
                    input.closest(".form-group").classList.add("has-error");
                }else {
                    input.closest(".form-group").classList.remove("has-error");
                    i++;
                }
            })
            if (fieldsPrice.length ===  i){
                return true;
            } else {
                return false;
            }
        }

        function generatePrice() {
            let price = [];
            let sale = +document.querySelector("#product-sale").value;
            // console.log(sale);
            if (sale !== 0){
                fieldsPrice.forEach(input => {
                    price.push({
                        quantity: input.dataset.volume,
                        price: input.value,
                        new_price: Math.floor(input.value - ((input.value * sale) / 100))
                    })
                });
            }else {
                fieldsPrice.forEach(input => {
                    price.push({
                        quantity: input.dataset.volume,
                        price: input.value,
                        new_price: 0
                    })
                });
            }


            switch (volume_type) {
                case "grams":
                    return JSON.stringify({["Грам"]: price});
                    // break;
                case "kilograms":
                    return JSON.stringify({["Кілограм"]: price});
                case "liters":
                    return JSON.stringify({["Літр"]: price});
                case "count":
                    return JSON.stringify({["Штук"]: price});
            }

        }
    }


    let delImg = document.querySelectorAll(".kv-file-remove");
    //console.log(delImg);

    delImg.forEach(del => {
        del.addEventListener('click', function () {
            // console.log(del);
            const path = del.dataset.url,
                  name = del.dataset.key;

            let url = `/product/del-img?path=${path}&name=${name}`;
            let response = fetch(url)
                .then(response => response.json())
                .then(function (json) {
                    if (json == 'success'){
                        window.location.reload();
                    }
                })
        })
    })
// let response = fetch()

};







