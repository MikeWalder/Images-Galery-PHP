<?php
require_once('header.php');
?>

<style>
    <?php require_once('css/configurationStyle.css'); ?>
</style>

<br><br><br>
<?php
?>

<div class="h1 display-4 fw-bold text-center pt-5 animate__animated animate__fadeIn">Dashboard</div>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-12 col-md-10">
            <div class="alert alert-dark text-center mt-5">Configuration environment (in progress)</div>
            <div class="row">
                <div class="col-8 bg-secondary"></div>
                <div class="col-4 bg-light">
                    <canvas id="myChart" width="400px" height="400px"></canvas>
                    <script>
                        const ctx = document.getElementById('myChart').getContext('2d');
                        const myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['All', 'JPG', 'JPEG', 'PNG', 'GIF', 'SVG'],
                                datasets: [{
                                    label: '# of Votes',
                                    data: [12, 19, 3, 5, 2, 3],
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
                                        display: true,
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
</div>

<?php
require_once('footer.php');
