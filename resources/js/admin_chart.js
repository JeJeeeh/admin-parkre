import { createChart } from "./fetcher";

const chart_data = [
    {
        id: "transaksi_user",
        url: "/admin/report/transaksi_user",
        chartName: "Laporan Transaksi User",
    },
    {
        id: "keuntungan_customer",
        url: "/admin/report/keuntungan_customer",
        chartName: "Laporan Keuntungan dari Customer (Rp)",
    },
    {
        id: "reservasi_customer",
        url: "/admin/report/reservasi_customer",
        chartName: "Laporan Reservasi Customer",
    },
    {
        id: "reservasi_sukses",
        url: "/admin/report/reservasi_sukses",
        chartName: "Laporan Reservasi Sukses",
    },
    {
        id: "review_customer",
        url: "/admin/report/review_customer",
        chartName: "Rata-rata Laporan Review Customer",
    },
];

chart_data.forEach((data) => {
    createChart(data.id, data.url, data.chartName, false, {
        status: true,
        value: 0,
    });
});
