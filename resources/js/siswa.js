import './siswa/package';

window.logoutSiswa = function () {
    Swal.fire({
        title: 'Apakah anda yakin ingin keluar?',
        html: "Jika anda dalam Ujian, maka durasi tetap <b style='color:red'>berjalan!</b>",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya, Saya mau keluar!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form-siswa').submit();
        }
    })
}
