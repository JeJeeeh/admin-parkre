import { createChart, fetchData } from "./fetcher";

const chartName = {
    "transaksi-user": "Laporan Transaksi User",
    "keuntungan-customer": "Laporan Keuntungan dari Customer (Rp)",
    "reservasi-customer": "Laporan Reservasi Customer",
    "reservasi-sukses": "Laporan Reservasi Sukses",
    "review-customer": "Laporan Review Customer",
};

const loadChart = () => {
    const type = document.getElementById("type-selector").value;
    const month = document.getElementById("month-selector").value;
    const url = `/admin/report/details/${type}/${month}`;
    createChart(
        "detail-report",
        url,
        chartName[`${type}`] +
            ` Bulan ${
                document.getElementById("month-selector").options[
                    document.getElementById("month-selector").selectedIndex
                ].text
            }`,
        false,
        {
            status: true,
            value: 0,
        }
    );
};

const loadStats = () => {
    const type = document.getElementById("type-selector").value;
    const month = document.getElementById("month-selector").value;
    const url = `/admin/report/updatestats/${type}/${month}`;

    const statTitle = document.querySelector(".stat-title");
    const statValue = document.querySelector(".stat-value");
    const statDesc = document.querySelector(".stat-desc");

    fetchData(url).then((data) => {
        statTitle.innerHTML = data.title;
        statValue.innerHTML = data.value;
        statDesc.innerHTML = data.desc;
    });
};

const refreshCanvas = () => {
    const parent = document.getElementById("canvas-parent");
    const canvas = document.createElement("canvas");
    canvas.id = "detail-report";
    canvas.height = 250;
    parent.innerHTML = "";
    parent.appendChild(canvas);
};

document
    .getElementById("month-selector")
    .addEventListener("change", function () {
        refreshCanvas();
        loadChart();
        loadStats();
    });
window.onload = function () {
    refreshCanvas();
    loadChart();
    loadStats();
};
