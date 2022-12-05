import { fetchData, createChart } from "./fetcher";

fetchData("/staff/reportjson").then((data) => {
    console.log(data);
});
createChart("myChart", "/staff/reportjson", "List Reservation");
