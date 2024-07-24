$(document).ready(function () {
    // Tombol Cari & Reset di hidden ato ga
    $("#cari").hide();
    // $("#reset").hide();


    load_data();
    function load_data(page,kolom,keyword){
            $.ajax({
                url:"ajax/buku.php",
                method:"GET",
                data:{page:page, Kolom:kolom, keyword:keyword},
                success:function(data){
                    $('#container').html(data);
                },
            })
            $(".loading").hide();
    }

    // Belajar debounce dari chatgpt
    function debounce(func, delay) {
        let debounceTimer;
        return function () {
            const context = this;
            const args = arguments;
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => func.apply(context, args), delay);
        };
    }

    const debouncedSearch = debounce(function () {
        $(".loading").show();

        const kolom = $("#Kolom").val();
        const keyword = $("#keyword").val();
        
        
        setTimeout(() => {load_data(1, kolom, keyword); }, 500);
        
    }, 500);

    $("#keyword").on("keyup", debouncedSearch);

    // Event when searching
    // $("#keyword").on("keyup", debounce(function () {
    //     // $(".loading").show();

    //     const kolom = $("#Kolom").val();
    //     const keyword = $("#keyword").val();


    //     if (keyword.length >= 3) {
    //         load_data(1,kolom,keyword);
    //         $(".loading").hide();
    //     } else {
            
    //     }
        

    //     // ajax load
    //     // $("#container").load("ajax/buku.php?Kolom="+$("#Kolom").val()+"&keyword="+$("#keyword").val());
        
    //     // $.get()
    //     // $.get("ajax/buku.php?Kolom="+$("#Kolom").val()+"&keyword="+$("#keyword").val(), function (data) {
    //     //     $("#container").html(data);
    //     //     $(".loading").hide();
    //     // })
    // }),500)

    $(document).on('click', '.halaman', function(){
        const kolom = $("#Kolom").val();
        const keyword = $("#keyword").val();

        let page = $(this).attr("id");
        console.log(page);
        load_data(page,kolom,keyword);
   });
})