import axios from "axios";
import Chart from "chart.js/auto";

export const fetchData = async (url) => {
    return new Promise((resolve, reject) => {
        const response = axios.put(url);
        response.then((result) => resolve(result.data));
        response.catch((error) => reject(error));
    });
};

export async function createChart(id, url, chartName) {
    try {
        const rawdata = await fetchData(url);
        const labels = rawdata.labels;

        const data = {
            labels: labels,
            datasets: [
                {
                    label: chartName,
                    backgroundColor: "rgb(255, 99, 132)",
                    borderColor: "rgb(255, 99, 132)",
                    data: rawdata.data,
                },
            ],
        };

        const config = {
            type: "line",
            data: data,
            options: {},
        };

        new Chart(document.getElementById(id), config);
    } catch (error) {
        console.log(error);
    }
}
