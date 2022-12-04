import Chart from 'chart.js/auto';
import { fetchData } from './fetcher';

async function createChart(id, url, chartName) {
    try {
        const rawdata = await fetchData(url);
        const labels = rawdata.labels

        const data = {
            labels: labels,
            datasets: [{
                label: chartName,
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: rawdata.data,
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {}
        };

        new Chart(
            document.getElementById(id),
            config
        );
    }
    catch (error) {
        console.log(error);
    }
}
fetchData('/staff/reportjson').then(data => {
    console.log(data);
});
createChart('myChart', '/staff/reportjson', 'List Reservation');



