// -- Typedef --
/**
 * @typedef {{
 *      id_jadwal: number, waktu_berangkat: string, waktu_tiba: string, harga_dasar: number,
 *      id_kereta: string, nama_kereta: string, tipe_kereta: string, kapasitas_total: number,
 *      id_stasiun_asal: string, nama_stasiun_asal: string, kota_asal: string,
 *      id_stasiun_tujuan: string, nama_stasiun_tujuan: string, kota_tujuan: string
 * }} Jadwal
 *
 * @typedef {{ id_kereta: string, nama_kereta: string, tipe_kereta: string, kapasitas_total: number }} Kereta
 * 
 * @typedef {{ id_stasiun: string, nama_stasiun: string, kota: string }} Stasiun
 * 
 */

// -- Element --
const listCard = document.getElementById("list-card");

const buttonJadwal = document.getElementById("button-jadwal");
const buttonKereta = document.getElementById("button-kereta");
const buttonTiket = document.getElementById("button-tiket");
const buttonStasiun = document.getElementById("button-stasiun");

// -- Helper --
/**
 * Get all data from table jadwal -> kereta, stasiun asal, dan stasiun akhir
 *
 * @async
 * @function
 * @returns {Jadwal[]}
 */
async function getAllJadwal() {
    try {
        const response = await fetch("process/select-jadwal.php");
        const data = await response.json();

        return data;
    } catch (error) {
        console.error(error);
    }
}

/**
 * Get all data from table kereta
 *
 * @async
 * @function
 * @returns {Kereta[]}
 */
async function getAllKereta() {
    try {
        const response = await fetch("process/select-kereta.php");
        const data = await response.json();

        return data;
    } catch (error) {
        console.error(error);
    }
}

/**
 * Get all data from table stasiun
 *
 * @async
 * @function
 * @returns {Stasiun[]}
 */
async function getAllStasiun() {
    try {
        const response = await fetch("process/select-stasiun.php");
        const data = await response.json();

        return data;
    } catch (error) {
        console.error(error);
    }
}

/**
 * Render list for data jadwal
 *
 * @param {Jadwal[]} list
 * @param {HTMLElement} renderElement
 */
function renderListJadwal(list, renderElement) {
    renderElement.innerHTML = ''
    for (const jadwal of list) {
        const hargaRupiah = Number(jadwal.harga_dasar).toLocaleString("id-ID");
        const dateOptions = {
            weekday: "long",
            year: "numeric",
            month: "long",
            day: "numeric",
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit",
            hour12: false,
        };
        const waktuBerangkat = new Date(jadwal.waktu_berangkat).toLocaleString("id-ID", dateOptions);
        const waktuTiba = new Date(jadwal.waktu_tiba).toLocaleString("id-ID", dateOptions);

        const cardJadwal = `
            <div class="item-card" key="${jadwal.id_jadwal}">
                <div class="card-header">
                    <h3>
                        <a href="detail.php?id-jadwal=${jadwal.id_jadwal}">${jadwal.nama_kereta}</a>
                    </h3>
                    <p>Tipe kereta: ${jadwal.tipe_kereta}</p>
                    <p>Harga tiket: Rp${hargaRupiah}</p>
                    <p>Stasiun asal: ${jadwal.nama_stasiun_asal} - (${jadwal.kota_asal})</p>
                    <p>Stasiun tujuan: ${jadwal.nama_stasiun_tujuan} - (${jadwal.kota_tujuan})</p>
                </div>
                <div class="card-content">
                    <p>Berangkat: ${waktuBerangkat}</p>
                    <p>Tiba: ${waktuTiba}</p>
                    <p>Kapasitas: ${jadwal.kapasitas_total}</p>
                    <p>Terisi: 20</p>
                    <p>Sisa: 30</p>
                </div>
                <div class="card-footer">
                    <button>Edit kereta</button>
                    <button>Hapus kereta</button>
                </div>
            </div>
        `;
        renderElement.innerHTML += cardJadwal;
    }
}

/**
 * Render list for data kereta
 *
 * @param {Kereta[]} list
 * @param {HTMLElement} renderElement
 */
function renderListKereta(list, renderElement) {
    renderElement.innerHTML = ''
    for (const kereta of list) {
        const cardKereta = `
            <div class="item-card" key="${kereta.id_kereta}">
                <div class="card-header">
                    <h3>${kereta.nama_kereta}</h3>
                </div>
                <div class="card-content">
                    <p>Tipe kereta: ${kereta.tipe_kereta}</p>
                    <p>Kapasitas: ${kereta.kapasitas_total}</p>
                </div>
                <div class="card-footer">
                    <button>Edit kereta</button>
                    <button>Hapus kereta</button>
                </div>
            </div>
        `;
        renderElement.innerHTML += cardKereta;
    }
}

/**
 * Render list for data stasiun
 *
 * @param {Stasiun[]} list
 * @param {HTMLElement} renderElement
 */
function renderListStasiun(list, renderElement) {
    renderElement.innerHTML = ''
    for (const stasiun of list) {
        const cardStasiun = `
            <div class="item-card" key="${stasiun.id_stasiun}">
                <div class="card-header">
                    <h3>${stasiun.nama_stasiun}</h3>
                </div>
                <div class="card-content">
                    <p>Kota: ${stasiun.kota}</p>
                </div>
                <div class="card-footer">
                    <button>Edit stasiun</button>
                    <button>Hapus stasiun</button>
                </div>
            </div>
        `;
        renderElement.innerHTML += cardStasiun;
    }
}


// -- Main | Call --
window.onload = async () => {
    const allJadwal = await getAllJadwal();
    const allKereta = await getAllKereta();
    const allStasiun = await getAllStasiun();

    renderListJadwal(allJadwal, listCard)
    
    buttonJadwal.addEventListener('click', () => renderListJadwal(allJadwal, listCard)) 
    buttonKereta.addEventListener('click', () => renderListKereta(allKereta, listCard)) 
    buttonStasiun.addEventListener('click', () => renderListStasiun(allStasiun, listCard)) 
}