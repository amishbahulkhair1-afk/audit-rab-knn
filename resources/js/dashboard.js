import Chart from 'chart.js/auto';

const rupiah = new Intl.NumberFormat('id-ID');

document.addEventListener('DOMContentLoaded', () => {
    const data = window.dashboardData;
    if (!data) return;

    Chart.defaults.font.family = 'Inter, system-ui, sans-serif';
    Chart.defaults.color = '#64748b';

    const grid = { color: 'rgba(148, 163, 184, 0.16)', drawBorder: false };

    const statistikCanvas = document.getElementById('statistikChart');
    if (statistikCanvas) {
        new Chart(statistikCanvas, {
            type: 'bar',
            data: {
                labels: ['Bangunan', 'Audit', 'Dataset KNN', 'RAB'],
                datasets: [{
                    data: data.statistik,
                    backgroundColor: ['#3b82f6', '#f59e0b', '#8b5cf6', '#10b981'],
                    borderRadius: 8,
                    borderSkipped: false,
                    barThickness: 28,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: { duration: 800, easing: 'easeOutQuart' },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        displayColors: false,
                        backgroundColor: '#0f172a',
                        padding: 12,
                        cornerRadius: 10,
                        callbacks: { label: (context) => ` ${rupiah.format(context.raw)} data` },
                    },
                },
                scales: {
                    x: { grid: { display: false }, border: { display: false }, ticks: { font: { weight: '600' } } },
                    y: { beginAtZero: true, grid, border: { display: false, dash: [4, 4] }, ticks: { precision: 0, padding: 8 } },
                },
            },
        });
    }

    const rabCanvas = document.getElementById('rabChart');
    if (rabCanvas) {
        const context = rabCanvas.getContext('2d');
        const gradient = context.createLinearGradient(0, 0, 0, 320);
        gradient.addColorStop(0, 'rgba(16, 185, 129, 0.28)');
        gradient.addColorStop(1, 'rgba(16, 185, 129, 0.015)');

        new Chart(rabCanvas, {
            type: 'line',
            data: {
                labels: data.bulan,
                datasets: [{
                    label: 'Total RAB',
                    data: data.grafikRab,
                    borderColor: '#059669',
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.38,
                    borderWidth: 3,
                    pointRadius: 3,
                    pointHoverRadius: 7,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#059669',
                    pointBorderWidth: 2,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { intersect: false, mode: 'index' },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        displayColors: false,
                        backgroundColor: '#0f172a',
                        padding: 12,
                        cornerRadius: 10,
                        callbacks: { label: (context) => ` Rp ${rupiah.format(context.raw)}` },
                    },
                },
                scales: {
                    x: { grid: { display: false }, border: { display: false }, ticks: { font: { weight: '600' } } },
                    y: {
                        beginAtZero: true,
                        grid,
                        border: { display: false },
                        ticks: { padding: 8, callback: (value) => value >= 1000000 ? `Rp ${(value / 1000000).toFixed(0)} jt` : `Rp ${rupiah.format(value)}` },
                    },
                },
            },
        });
    }

    const knnCanvas = document.getElementById('knnChart');
    if (knnCanvas) {
        new Chart(knnCanvas, {
            type: 'doughnut',
            data: {
                labels: Object.keys(data.knn),
                datasets: [{
                    data: Object.values(data.knn),
                    backgroundColor: ['#10b981', '#f59e0b', '#f43f5e', '#8b5cf6'],
                    borderColor: '#ffffff',
                    borderWidth: 4,
                    hoverOffset: 8,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                animation: { animateRotate: true, duration: 900 },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        displayColors: true,
                        backgroundColor: '#0f172a',
                        padding: 12,
                        cornerRadius: 10,
                        callbacks: { label: (context) => ` ${context.label}: ${rupiah.format(context.raw)} data` },
                    },
                },
            },
        });
    }
});
