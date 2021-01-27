$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


/* Xóa một row  */
function destroy(id) {
    console.log(base_url)
    var result = confirm("Bạn có chắc chắn muốn xóa ?");
    console.log(result)
    if (result) { // neu nhấn == ok , sẽ send request ajax
        $.ajax({
            url: base_url + '/admin/users/'+id,
            type: 'DELETE',
            data: {}, // dữ liệu truyền sang nếu có
            dataType: "json", // kiểu dữ liệu trả về
            success: function (response) { // success : kết quả trả về sau khi gửi request ajax
                if (response.status != 'undefined' && response.status == true) {
                    // xóa dòng vừa được click delete
                    $('#tr-'+id).closest('tr').remove(); // class .item- ở trong class của thẻ td đã khai báo trong file index
                }
            },
            error: function (e) { // lỗi nếu có
                console.log(e.message);
            }
        });
    }
}
