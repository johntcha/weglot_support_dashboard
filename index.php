<!doctype html>
<html lang="fr">
   <head>
      <meta charset="utf-8">
      <title>Weglot Support Team Dashboard</title>
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      <script src="js/Chart.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
   </head>
   <body>
      <h1>Weglot Support Dashboard</h1>
      <div class="container">
      <div class="row row-cols-2">
         <div class="col">
            <div class="card">
               <h2>Reviews</h2>
               <div class="card-body">
                  <!-- Reviews here-->
                  <div class="reviews">
                     <div class="number_reviews">
                        <?php include 'reviews.php' ?>
                        <table>
                           <tr>
                              <td style="border-top: none;
                                         border-left: none;">
                              </td>
                              <td>Semaine</td>
                              <td>All</td>
                           </tr>
                           <tr>
                              <td>Trustpilot</td>
                              <td>A la main</td>
                              <td><?php echo $review_trust ?></td>
                           </tr>
                           <tr>
                              <td>Shopify</td>
                              <td><?php echo $shopp ?></td>
                              <td><?php echo $review_shop ?></td>
                           </tr>
                           <tr>
                              <td>WordPress</td>
                              <td><?php echo $wordp ?></td>
                              <td><?php echo $review_word ?></td>
                           </tr>
                           <tr>
                              <td>Total</td>
                              <td><?php echo $total ?></td>
                              <td><?php echo $total_all ?></td>
                           </tr>
                        </table>
                     </div>
                     <!-- End Reviews here-->
                  </div>
               </div>
            </div>
         </div>
         <div class="col">
            <!-- Churn/React % here-->
            <div class="card">
               <div class="card-body">
                  <div class="churn">
                     Churn/React % here boyz
                     <div class="chart_mogul">
                        <?php include 'chartmogul.php' ?>
                        Still waiting for ChartMogul support...
                     </div>
                  </div>
                  <!-- End Churn/React % here-->
               </div>
            </div>
         </div>
         <div class="col">
            <!-- Stats here-->
            <div class="card">
              <h2>Statistiques de la semaine</h2>
               <div class="card-body">
                  <div class="stats">

                     <div class="stats_helpscout">
                        <table>
                           <tr>
                              <td>Prénom</td>
                              <td>Messages envoyés</td>
                              <td>Clients aidés</td>
                           </tr>
                           <?php include 'stats.php' ?>
                        </table>
                        <span class="ratio">Replies sent ratio: <em id="percentage"><?php echo $percentage; ?></em></span>
                        <script type="text/javascript">
                           var percentage = "<?php echo $percentage ?>";
                           if (percentage <= 1.50){
                               document.getElementById("percentage").style.color = "green";   
                           }
                           else {
                               document.getElementById("percentage").style.color = "red"; 
                           }
                        </script>
                     </div>
                  </div>
                  <!-- End Stats here-->
               </div>
            </div>
         </div>
         <div class="col col-charts">
            <div class="card">
               <div class="card-body">
                  <div class="weekly">
                     <div class="week_helpscout"><?php include 'helpscout.php' ?></div>
                     <div class="charts">
                        <canvas id="myChart"></canvas>
                        <canvas id="myChart1"></canvas>
                     </div>
                     <script>
                        var helped_this_week = "<?php echo $helped_this_week ?>";
                        var helped_last_week = "<?php echo $helped_last_week ?>";
                        var msg_this_week = "<?php echo $msg_this_week ?>";
                        var msg_last_week = "<?php echo $msg_last_week ?>";
                        var ctx = document.getElementById('myChart').getContext('2d');
                        var ctx1 = document.getElementById('myChart1').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: ['Clients aidés cette semaine', 'Clients aidés la semaine dernière'],
                                fontSize: 30,
                                datasets: [{
                                    data: [helped_this_week, helped_last_week],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                        
                                plugins: {
                                  labels: {
                                    render: 'value',
                                    fontSize: 30,
                                    }
                                },
                                legend: {
                                    labels: {
                                        fontSize: 18,
                                        fontColor: "#18164c"
                                    }
                                }
                            }
                        });
                        var myChart1 = new Chart(ctx1, {
                            type: 'pie',
                            data: {
                                labels: ['Messages envoyés cette semaine', 'Message envoyé la semaine dernière'],
                                datasets: [{
                                    data: [msg_this_week, msg_last_week],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                    ],
                                    borderWidth: 1,
                                }]
                            },
                            options: {
                                plugins: {
                                  labels: {
                                    render: 'value',
                                    fontSize: 30,
                                    }
                                },
                                legend: {
                                    labels: {
                                        fontSize: 18,
                                        fontColor: "#18164c"
                                    }
                                }
                            }
                        });
                     </script>
                  </div>
                  <!-- End Semaine here -->
               </div>
            </div>
         </div>
      </div>
   </body>
</html>