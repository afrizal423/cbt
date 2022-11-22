import './bootstrap';
import '../css/app.css';
// import '/node_modules/bootstrap/dist/css/bootstrap.min.css';

// import 'alpinejs';
import '/node_modules/alpinejs/dist/cdn.min.js';

// import '/node_modules/@popperjs/core/dist/umd/popper.min.js';
// import '/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js';

import swal from 'sweetalert2';
window.Swal = swal;

function dataTableController (id) {
    return {
        id,
        deleteItem() {
            Swal.fire({
                title: 'Apakah anda yakin menghapus?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya, Hapus data ini!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteItem', this.id);
                    this.id = '';
                }
            })
        }
    }
}

function dataTableMainController () {
    return {
        setCallback() {
            Livewire.on('deleteResult', (result) => {
                if (result.status) {
                    Swal.fire(
                        'Deleted!',
                        result.message,
                        'success'
                    );
                } else {
                    Swal.fire(
                        'Error!',
                        result.message,
                        'error'
                    ).then(function() {
                        location.reload();
                    });
                }
            });
        }
    }
}

window.__controller = {
    dataTableController,
    dataTableMainController
}
