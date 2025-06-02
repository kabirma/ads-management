// sidebar toggle control

const sidebar = document.getElementById("sidebarToggle");
const toggler = document.getElementById("sidebarToggler");

toggler.addEventListener("click", () => {
    sidebar.classList.toggle("collapsed");

    if (sidebar.classList.contains("collapsed")) {
        toggler.style.left = "0px";
    } else {
        toggler.style.left = "210px";
    }
});

//   monthly and weekly chart

const ctx = document.getElementById("lineChart").getContext("2d");

const chartDataSets = {
    "24h": {
        labels: ["1AM", "4AM", "7AM", "10AM", "1PM", "4PM", "7PM", "10PM"],
        data: [12, 19, 10, 15, 22, 30, 25, 18],
    },
    week: {
        labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
        data: [15, 20, 25, 22, 18, 30, 27],
    },
    month: {
        labels: Array.from({ length: 30 }, (_, i) => `Day ${i + 1}`),
        data: Array.from(
            { length: 30 },
            () => Math.floor(Math.random() * 30) + 5
        ),
    },
};

let currentChart = new Chart(ctx, {
    type: "line",
    data: {
        labels: chartDataSets["month"].labels,
        datasets: [
            {
                // label: 'Activity',
                label: "", // Set an empty string instead of commenting or removing
                data: chartDataSets["month"].data,
                borderColor: "blue",
                backgroundColor: "rgba(0,123,255,0.2)",
                tension: 0.4,
            },
        ],
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false,
            },
        },
        scales: {
            y: {
                beginAtZero: true,
            },
        },
    },
});

document.querySelectorAll(".nav-link").forEach((btn) => {
    btn.addEventListener("click", () => {
        document
            .querySelectorAll(".nav-link")
            .forEach((b) => b.classList.remove("active"));
        btn.classList.add("active");

        const range = btn.getAttribute("data-range");
        const dataSet = chartDataSets[range];

        currentChart.data.labels = dataSet.labels;
        currentChart.data.datasets[0].data = dataSet.data;
        currentChart.update();
    });
});

//   month bar chart

const incomeCtx = document.getElementById("incomeChart").getContext("2d");
const expenseCtx = document.getElementById("expenseChart").getContext("2d");

new Chart(incomeCtx, {
    type: "line",
    data: {
        labels: ["W1", "W2", "W3", "W4"],
        datasets: [
            {
                data: [200, 300, 400, 385],
                borderColor: "green",
                backgroundColor: "rgba(0,255,0,0.1)",
                tension: 0.4,
                fill: true,
            },
        ],
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            x: { display: false },
            y: { display: false },
        },
    },
});

new Chart(expenseCtx, {
    type: "line",
    data: {
        labels: ["W1", "W2", "W3", "W4"],
        datasets: [
            {
                data: [400, 420, 410, 437],
                borderColor: "red",
                backgroundColor: "rgba(255,0,0,0.1)",
                tension: 0.4,
                fill: true,
            },
        ],
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            x: { display: false },
            y: { display: false },
        },
    },
});

// engagement analysis
const configLine = (ctx, borderColor) => ({
    type: "line",
    data: {
        labels: [
            "JAN",
            "FEB",
            "MAR",
            "APR",
            "MAY",
            "JUN",
            "JUL",
            "AUG",
            "SEP",
            "OCT",
            "NOV",
            "DEC",
        ],
        datasets: [
            {
                label: "Current Year",
                data: [6, 4, 5, 7, 4, 5, 6, 5, 4, 1.8, 2.5, 3],
                borderColor: "#38bdf8",
                backgroundColor: "transparent",
                tension: 0.4,
            },
            {
                label: "Last Year",
                data: [8, 9, 6, 3, 3, 3, 2, 4, 5, 0.4, 1, 2],
                borderColor: "#94a3b8",
                backgroundColor: "transparent",
                tension: 0.4,
            },
        ],
    },
    options: {
        responsive: true,
        plugins: {
            tooltip: {
                callbacks: {
                    title: (context) => `October 2025`,
                    label: (context) =>
                        `${context.dataset.label}: ${context.raw}k`,
                },
            },
            legend: { display: false },
        },
        scales: {
            x: {
                display: true,
                grid: {
                    display: true,
                    color: "#334155",
                },
                ticks: {
                    display: true,
                    color: "#94a3b8",
                },
            },
            y: {
                display: true,
                grid: {
                    display: true,
                    color: "#334155",
                },
                ticks: {
                    display: true,
                    color: "#94a3b8",
                },
            },
        },
    },
});

new Chart(document.getElementById("engagementChart"), configLine());

const miniChart = (id, color) => {
    new Chart(document.getElementById(id), {
        type: "line",
        data: {
            labels: [1, 2, 3, 4, 5, 6, 7],
            datasets: [
                {
                    data: [2, 3, 2, 5, 3, 4, 6],
                    borderColor: color,
                    backgroundColor: "transparent",
                    tension: 0.4,
                    pointRadius: 0,
                    borderWidth: 2,
                },
            ],
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { x: { display: false }, y: { display: false } },
            responsive: true,
        },
    });
};

miniChart("chartGoca", "#38bdf8");
miniChart("chartYoca", "#38bdf8");

// traffic chart

// Plugin to draw centered text
const centerTextPlugin = {
    id: "centerText",
    beforeDraw: function (chart) {
        const { width, height, ctx } = chart;
        const customText = chart.options.plugins.customText;

        if (!customText) return;

        const text = customText;
        const fontSize = (height / 5).toFixed(2);
        ctx.restore();
        ctx.font = `${fontSize}px Segoe UI`;
        ctx.fillStyle = "#fff";
        ctx.textBaseline = "middle";

        const textX = Math.round((width - ctx.measureText(text).width) / 2);
        const textY = height / 2;

        ctx.fillText(text, textX, textY);
        ctx.save();
    },
};

Chart.register(centerTextPlugin);

function createDoughnutChart(id, value, color) {
    const ctx = document.getElementById(id).getContext("2d");
    new Chart(ctx, {
        type: "doughnut",
        data: {
            datasets: [
                {
                    data: [value, 100 - value],
                    backgroundColor: [color, "#1e2a3a"],
                    borderWidth: 0,
                },
            ],
        },
        options: {
            cutout: "75%",
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: false },
                customText: `${value}%`, // ✅ Place it here inside plugins
            },
        },
    });
}

// Create charts
createDoughnutChart("paidChart", 70, "#00c9e0");
createDoughnutChart("directChart", 50, "#00d894");
createDoughnutChart("organicChart", 60, "#ff6b6b");

const currentPath = window.location.pathname.split("/").pop();

const sidebarLinks = document.querySelectorAll(".sidebar .nav-link");

sidebarLinks.forEach((link) => {
    const linkPath = link.getAttribute("href");

    // Compare current path with link path
    if (linkPath === currentPath) {
        sidebarLinks.forEach((l) => l.classList.remove("active"));
        link.classList.add("active");
    }
});

// here control the tab ,forgot password link
document.getElementById("forgotLink").addEventListener("click", function (e) {
    e.preventDefault();
    document.getElementById("passwordCard").classList.add("d-none");
    document.getElementById("resetPasswordCard").classList.remove("d-none");
});
