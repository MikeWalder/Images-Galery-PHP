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

<div class="h1 display-4 fw-bold text-center pt-5 animate__animated animate__fadeIn">Dashboard</div>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-12 col-md-10 mt-3">
            <div class="row">
                <div class="col-6 bg-light">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-5 border border-right">
                                <!-- <span class="h4 fw-bold">Chart type</span><br>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="" checked>
                                    <label class="form-check-label" value="bar" for="flexSwitchCheckChecked">Bar</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="" checked>
                                    <label class="form-check-label" value="bar" for="flexSwitchCheckChecked">Bar</label>
                                </div> -->
                            </div>
                            <div class="col-5"></div>
                        </div>
                    </div>
                </div>
                <div class="card col-4 ms-5 bg-light img-fluid">
                    <div class="card-header">
                        <div class="card-title h5 fw-bold">Image types</div>
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
        </div>
        <div class="col-md-1"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-1 col-md-4"></div>
            <div class="col-10 col-md-4 bg-light mt-5">
                <div class="card-header">
                    <!-- <div class="card-title h5 fw-bold">Calendar</div> -->
                    <?php displayCalendar(); ?>
                </div>
            </div>
            <div class="col-1 col-md-4">
            </div>
        </div>
    </div>
</div>

<?php
require_once('footer.php');
