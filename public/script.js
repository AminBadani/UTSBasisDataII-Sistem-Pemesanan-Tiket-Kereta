// -- Element
const listTicket = document.getElementById("list-ticket");

// -- Helper --
/**
 * Get all data from table jadwal -> kereta, stasiun asal, dan stasiun akhir
 *
 * @async
 * @function
 * @returns {{
 *      id_jadwal: number, waktu_berangkat: string, waktu_tiba: string, harga_dasar: number,
 *      id_kereta: string, nama_kereta: string, tipe_kereta: string, kapasitas_total: number,
 *      id_stasiun_asal: string, nama_stasiun_asal: string, kota_asal: string,
 *      id_stasiun_tujuan: string, nama_stasiun_tujuan: string, kota_tujuan: string
 * }[]}
 */
async function getAllJadwal() {
    try {
        const response = await fetch("process/select.php");
        const data = await response.json();

        console.log(data);
        return data;
    } catch (error) {
        console.error(error);
    }
}

// -- Main | Call --
window.onload = async () => {
    const allJadwal = await getAllJadwal();

    for (const jadwal of allJadwal) {
        const hargaRupiah = Number(jadwal.harga_dasar).toLocaleString("id-ID");
        const dateOptions = {
            weekday: "long",
            year: "numeric",
            month: "long",
            day: "numeric",
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit",
            hour12: false
        };
        const tanggalBerangkat = new Date(jadwal.waktu_berangkat).toLocaleString("id-ID", dateOptions);
        const tanggalTiba = new Date(jadwal.waktu_tiba).toLocaleString("id-ID", dateOptions);

        const cardTicket = `
            <div class="card-ticket" key="${jadwal.id_kereta}">
                <div class="card-header">
                    <h3>${jadwal.nama_kereta}</h3>
                    <p>Stasiun asal: ${jadwal.nama_stasiun_asal} - (${jadwal.kota_asal})</p>
                    <p>Stasiun tujuan: ${jadwal.nama_stasiun_tujuan} - (${jadwal.kota_tujuan})</p>
                </div>
                <div class="card-content">
                    <p>Tipe kereta: ${jadwal.tipe_kereta}</p>
                    <p>Harga tiket: Rp${hargaRupiah}</p>
                    <p>Berangkat: ${tanggalBerangkat}</p>
                    <p>Tiba: ${tanggalTiba}</p>
                </div>
                <div class="card-footer">
                    <p>Kapasitas: ${jadwal.kapasitas_total}</p>
                    <p>Terisi: 20</p>
                    <p>Sisa: 30</p>
                </div>
            </div>
        `;
        listTicket.innerHTML += cardTicket;
    }
};
