/**
 * Fungsi untuk menampilkan hasil download
 * @param {string} result - Nama file yang didownload
 */
function showDownload(result) {
  console.log("Download selesai");
  console.log(`Hasil Download: ${result}`);
}

/**
 * Fungsi untuk download file
 * @param {function} callback - Function callback show
 */
function download(callShowDownload) {
  setTimeout(function () {
    const result = "windows-10.exe";
    callShowDownload(result);
  }, 3000);
}

// Menggunakan Promise dan Async/Await
function downloadFile() {
  return new Promise(function (resolve) {
    download(resolve);
  });
}

async function startDownload() {
  console.log("Memulai download...");
  const result = await downloadFile();
  showDownload(result);
}

startDownload();
