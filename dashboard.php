<?php
require_once('header.php');
?>

<style>
    <?php require_once('css/configurationStyle.css'); ?>
</style>

<br><br><br>

<?php
$tabImageTypes = selectTabDataImageTypes();
?>

<h1 class="display-4 fw-bold text-center py-5 animate__animated animate__fadeIn" id="maintitle">
    <script>
        checkModeMaintitle();
    </script>
    Dashboard
</h1>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-12 col-md-10 mt-2 mt-md-3">
            <div class="row">

                <div class="col-12 col-md-5 ms-md-2 me-md-3 rounded bg-light">
                    <?php $displayMode = displayCalendar(); ?>
                </div>

                <div class="col-md-1"></div>

                <div class="card col-12 col-md-5 ms-md-3 me-md-2 bg-light img-fluid">
                    <div class="card-header">
                        <div class="card-title h4 fw-bold">Image types</div>
                    </div>

                    <canvas id="myChart"></canvas>

                    <script>
                        const ctx = document.getElementById('myChart').getContext('2d');
                        const myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['All', 'JPG', 'JPEG', 'PNG', 'GIF', 'SVG'],
                                datasets: [{
                                    label: 'Image extension',
                                    data: [
                                        <?= $tabImageTypes['all'] ?>,
                                        <?= $tabImageTypes['jpg'] ?>,
                                        <?= $tabImageTypes['jpeg'] ?>,
                                        <?= $tabImageTypes['png'] ?>,
                                        <?= $tabImageTypes['gif'] ?>,
                                        <?= $tabImageTypes['svg'] ?>
                                    ],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.8)',
                                        'rgba(54, 162, 235, 0.8)',
                                        'rgba(255, 206, 86, 0.8)',
                                        'rgba(75, 192, 192, 0.8)',
                                        'rgba(153, 102, 255, 0.8)',
                                        'rgba(255, 159, 64, 0.8)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                plugins: {
                                    title: {
                                        display: false,
                                        text: 'Image types'
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>
                </div>

            </div>

            <div class="row">
                <div class="col-md-1 col-lg-2"></div>
                <div class="card col-12 col-md-10 col-lg-8 ms-md-2 me-lg-2 mt-2 mt-md-5 bg-light img-fluid">
                    <?php $viewByMonth = getNumberVisitorsByMonth(); ?>
                    <div class="card-header">
                        <div class="card-title h4 fw-bold">Views per month (2022)</div>
                    </div>
                    <canvas id="myChart2"></canvas>

                    <script>
                        const ctx2 = document.getElementById('myChart2').getContext('2d');
                        const myChart2 = new Chart(ctx2, {
                            type: 'bar',
                            data: {
                                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                                datasets: [{
                                    label: 'views / month',
                                    backgroundColor: "white",
                                    data: [
                                        <?= $viewByMonth[1] ?>,
                                        <?= $viewByMonth[2] ?>,
                                        <?= $viewByMonth[3] ?>,
                                        <?= $viewByMonth[4] ?>,
                                        <?= $viewByMonth[5] ?>,
                                        <?= $viewByMonth[6] ?>,
                                        <?= $viewByMonth[7] ?>,
                                        <?= $viewByMonth[8] ?>,
                                        <?= $viewByMonth[9] ?>,
                                        <?= $viewByMonth[10] ?>,
                                        <?= $viewByMonth[11] ?>,
                                        <?= $viewByMonth[12] ?>
                                    ],
                                    backgroundColor: [
                                        'rgba(54, 162, 235, 0.8)',
                                        'rgba(54, 162, 235, 0.8)',
                                        'rgba(54, 162, 235, 0.8)',
                                        'rgba(54, 162, 235, 0.8)',
                                        'rgba(54, 162, 235, 0.8)',
                                        'rgba(54, 162, 235, 0.8)',
                                        'rgba(54, 162, 235, 0.8)',
                                        'rgba(54, 162, 235, 0.8)',
                                        'rgba(54, 162, 235, 0.8)',
                                        'rgba(54, 162, 235, 0.8)',
                                        'rgba(54, 162, 235, 0.8)',
                                        'rgba(54, 162, 235, 0.8)',
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)',
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                legend: {
                                    display: false
                                },
                                tooltips: {
                                    enabled: false
                                },
                                layout: {
                                    padding: {
                                        bottom: 15
                                    }
                                },
                                plugins: {
                                    title: {
                                        display: false,
                                        text: 'Number of views'
                                    },
                                    legend: {
                                        labels: {
                                            color: "black",
                                        }
                                    }
                                },
                                scales: {
                                    y: {
                                        ticks: {
                                            stepSize: 1,
                                            beginAtZero: true
                                        }
                                    }
                                }
                            }
                        });
                    </script>

                </div>
            </div>

        </div>
        <div class="col-md-1"></div>
    </div>

</div>

<?php
require_once('footer.php');
