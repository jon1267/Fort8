//$(document).ready(function(){

//});

// это похоже на первый вариант но посылаем id и часть id-шника формы удаления без id
function confirmDelete(id, PartIdDeleteForm) {
    console.log(id, PartIdDeleteForm);
    event.preventDefault();
    Swal.fire({
        title: 'Вы уверены?',
        icon: 'warning',
        text: "Вы точно хотите это удалить?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Да, удалить!'
    }).then((result) => {
        console.log(result.value);
        if(result.value) {
            document.getElementById(PartIdDeleteForm + id).submit()
        }
    })
}

// это первый вариант (пока оставлю...)
function confirmDeleteUser(id) {
    //console.log(id);
    event.preventDefault();
    Swal.fire({
        title: 'Вы уверены?',
        icon: 'warning',
        text: "Вы точно хотите это удалить?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Да, удалить!'
    }).then((result) => {
        //console.log(result.value);
        if(result.value) {
            document.getElementById('user-delete-'+id).submit()
        }
    })
}
