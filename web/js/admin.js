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



    let delImg = document.querySelectorAll(".kv-file-remove");

    delImg.forEach(del => {
        del.addEventListener('click', function () {
            // console.log(del);
            const path = del.dataset.url,
                  name = del.dataset.key;

            console.log(path);
            let url = `/product/del-img?path=${path}&name=${name}`;

            if (window.location.pathname.indexOf('banner-main') !== -1){
                let formID = del.dataset.key;
                url = `/banner-main/del-img?file=${path}&id=${formID}`;
            }
            if (window.location.pathname.indexOf('banner-catalog') !== -1){
                let formID = del.dataset.key;
                url = `/banner-catalog/del-img?file=${path}&id=${formID}`;
            }

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







