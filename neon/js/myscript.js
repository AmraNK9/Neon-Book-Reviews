$(document).ready(function(){
    $(document).on('click','.delete_user',function(){
        
        console.log(111)
        let status=confirm('Are you sure want to delete')
        let tr=$(this).parent().parent();
        let id=tr.attr('id');
        console.log(id)
        if (status) {
            $.ajax({
                method: 'post',
                url: 'deleteUser.php',
                data: { id: id },
                success: function(response) {
                    
                    console.log(response)
                    if (response = "success") {
                        location.href="user.php"
                    }
                }
            });
        }
    })
    $(document).on('click','.delete_book',function(){
        let status=confirm('Are you sure want to delete')
        let tr=$(this).parent().parent();
        let id=tr.attr('id');
        if (status) {
            
            $.ajax({
                method: 'post',
                url: 'deleteBook.php',
                data: { id: id },
                success: function(response) {
                    if (response = "success") {
                        location.href="book.php";
                    }
                }
            });
        }
    })
    $(document).on('click','.delete_auther',function(){
        
        console.log(111)
        let status=confirm('Are you sure want to delete')
        let tr=$(this).parent().parent();
        let id=tr.attr('id');
        if (status) {
            $.ajax({
                method: 'post',
                url: 'deleteAuther.php',
                data: { id: id },
                success: function(response) {
                    
                    console.log(response)
                    if (response = "success") {
                        location.href="auther.php"
                    }
                }
            });
        }
    })
    // $(document).on('click','.open',function(){
    //     let id=$(this).attr('id')
    //         $.ajax({
    //             method:'post',
    //             url: 'openPdf.php',
    //             data:{id:id},
    //             success:function(response){
    //                 let pdfUrl='pdf/'+response;
                    
    //                 window.open(pdfUrl,'_blank')
    //             }
    //         })
    // })
    
    
})