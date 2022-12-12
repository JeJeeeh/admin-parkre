import axios from "axios";
import Chart from "chart.js/auto";

export const fetchData = (url) => {
    return new Promise((resolve, reject) => {
        const response = axios.put(url);
        response.then((result) => resolve(result.data));
        response.catch((error) => reject(error));
    });
};

/**
 * Create a chart
 * @param {string} id
 * @param {string} url
 * @param {string} chartName
 * @param {boolean} maintainAspectRatio
 * @param {Object} setBottomValue
 * @param {boolean} setBottomValue.status
 * @param {number} setBottomValue.value
 */
export async function createChart(
    id,
    url,
    chartName,
    maintainAspectRatio = true,
    setBottomValue = { status: false, value: 0 }
) {
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

        const option = {
            maintainAspectRatio: maintainAspectRatio,
            // y: {
            //     suggestedMin: setBottomValue.value,
            // },
        };

        if (setBottomValue.status) {
            Object.assign(option, { y: {} });
            Object.assign(option.y, { suggestedMin: setBottomValue.value });
        }

        const config = {
            type: "line",
            data: data,
            options: option,
        };

        const chart = new Chart(document.getElementById(id), config);
        return chart;
    } catch (error) {
        console.log("Error: ", error);
        return error;
    }
}
