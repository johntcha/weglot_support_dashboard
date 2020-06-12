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
      <script type = "text/JavaScript">
            function AutoRefresh( t ) {
               setTimeout("location.reload(true);", t);
            }
      </script>
   </head>
   <body onload = "JavaScript:AutoRefresh(1000*300);" id="body">
      <h1>Weglot Support Dashboard</h1>
      <div class="container">
        <p>Relevés des statistiques du support</p>
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
                              <td>
                                RECORD DE REVIEWS : 30
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
        <div class="col youtube">
          <script src="https://www.youtube.com/iframe_api"></script>
          <div class="module module-home-video">
              <div id="video"></div>
          </div>
    <!-- REVIEWS DISCOOOOO -->
    <script>
        var player, playing = false;
        function onYouTubeIframeAPIReady() {
            player = new YT.Player('video', {
                height: '120',
                width: '300',
                videoId: 'XCPj4JPbKtA',
                events: {
                    'onStateChange': onPlayerStateChange
                }
            });
        }
        function onPlayerStateChange(event) {
              //clearInterval(interval);
          if(event.data == YT.PlayerState.PLAYING) {
             playing = true;
             clearInterval(interval);
             var i = 0; 
              function change() {
              var color = ["black", "bleu", "brown", "green", "yellow", "purple"];
              document.getElementById("body").style.background = color[i];
              i = (i + 1) % color.length;
              }
              var interval = setInterval(change, 100); 
              setTimeout(function(){clearInterval(interval);}, 22000);

              setTimeout(function(){ 
                  document.getElementById("body").style.background = "linear-gradient(180deg, rgba(252,252,255,1) 0%, rgba(233,235,255,1) 78%)";
              }, 23000);
            }
          else{
            playing = true;
           }
    }
    </script>
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
                    <!--ChartJS charts code -->
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
                                        '#3d46fb',
                                        '#2d1c6b',
                                    ],
                                    borderColor: [
                                        '#3d46fb',
                                        '#2d1c6b',
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                        
                                plugins: {
                                  labels: {
                                    render: 'value',
                                    fontSize: 30,
                                    fontColor: "#fcfcff"
                                    }
                                },
                                legend: {
                                    labels: {
                                        fontSize: 18,
                                        fontColor: "#18164c",
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
                                        '#3d46fb',
                                        '#2d1c6b',
                                    ],
                                    borderColor: [
                                        '#3d46fb',
                                        '#2d1c6b',
                                    ],
                                    borderWidth: 1,
                                }]
                            },
                            options: {
                                plugins: {
                                  labels: {
                                    render: 'value',
                                    fontSize: 30,
                                    fontColor: "#fcfcff"
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