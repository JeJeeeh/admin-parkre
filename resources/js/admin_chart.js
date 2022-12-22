import { createChart } from "./fetcher";

const chart_data = [
    {
        id: "transaksi_user",
        url: "/admin/report/user_transaction",
        chartName: "User Transaction Report",
    },
    {
        id: "keuntungan_customer",
        url: "/admin/report/profit",
        chartName: "Profit Report (Rp)",
    },
    {
        id: "reservasi_customer",
        url: "/admin/report/reservation_customer",
        chartName: "Customer Reservation Report",
    },
    {
        id: "reservasi_sukses",
        url: "/admin/report/reservation_success",
        chartName: "Success Reservation Report",
    },
    {
        id: "review_customer",
        url: "/admin/report/review_customer",
        chartName: "Average Customer Review",
    },
];

chart_data.forEach((data) => {
    createChart(data.id, data.url, data.chartName, false, {
        status: true,
        value: 0,
    });
});
