@extends('layouts.dashboard')

@section('content')
    <div class="row">
      <div class="col-md-12 dashboard-col">
        <div class="dashboard-card">
          <div class="card-header">
            <h5 class="card-header-title">Dashboard</h5>
          </div>
          <div class="card-body">
            {{Route::currentRouteName()}}
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 dashboard-col">
        <div class="dashboard-card">
          <div class="card-header">
            <h5 class="card-header-title">Dashboard</h5>
          </div>
          <div class="card-body">
            <canvas id="myChart" width="400" height="400"></canvas>
            <script>
              const ctx = document.getElementById('myChart');
              const myChart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                      datasets: [{
                          label: '# of Votes',
                          data: [12, 19, 3, 5, 2, 3],
                          backgroundColor: [
                              'rgba(255, 99, 132, 0.2)',
                              'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 206, 86, 0.2)',
                              'rgba(75, 192, 192, 0.2)',
                              'rgba(153, 102, 255, 0.2)',
                              'rgba(255, 159, 64, 0.2)'
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
      <div class="col-md-4 dashboard-col">
        <div class="dashboard-card">
          <div class="card-header">
            <h5 class="card-header-title">Posts</h5>
          </div>
          <div class="card-body">
            <canvas id="myChart1"></canvas>
            <script>
              const ctxs = document.getElementById('myChart1');
              const myCharts = new Chart(ctxs, {
                  type: 'radar'
                  ,
                    options: {
                      elements: {
                        line: {
                          borderWidth: 3
                        }
                      }
                    },
                                    data: {
                                      labels: [
                      'Eating',
                      'Drinking',
                      'Sleeping',
                      'Designing',
                      'Coding',
                      'Cycling',
                      'Running'
                    ],
                    datasets: [{
                      label: 'My First Dataset',
                      data: [65, 59, 90, 81, 56, 55, 40],
                      fill: true,
                      backgroundColor: 'rgba(255, 99, 132, 0.2)',
                      borderColor: 'rgb(255, 99, 132)',
                      pointBackgroundColor: 'rgb(255, 99, 132)',
                      pointBorderColor: '#fff',
                      pointHoverBackgroundColor: '#fff',
                      pointHoverBorderColor: 'rgb(255, 99, 132)'
                    }, {
                      label: 'My Second Dataset',
                      data: [28, 48, 40, 19, 96, 27, 100],
                      fill: true,
                      backgroundColor: 'rgba(54, 162, 235, 0.2)',
                      borderColor: 'rgb(54, 162, 235)',
                      pointBackgroundColor: 'rgb(54, 162, 235)',
                      pointBorderColor: '#fff',
                      pointHoverBackgroundColor: '#fff',
                      pointHoverBorderColor: 'rgb(54, 162, 235)'
                    }]
                  }
              });
            </script>
          </div>
        </div>
      </div>
      <div class="col-md-4 dashboard-col">
        <div class="dashboard-card">
          <div class="card-header">
            <h5 class="card-header-title">Users</h5>
          </div>
          <div class="card-body">
            <canvas id="myChart12"></canvas>
            <script>
              const ctxsa = document.getElementById('myChart12');
              const data = {
                labels: [
                  'Red',
                  'Blue',
                  'Yellow'
                ],
                datasets: [{
                  label: 'My First Dataset',
                  data: [300, 50, 100],
                  backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                  ],
                  hoverOffset: 4
                }]
              };
              const myChartsa = new Chart(ctxsa, {
                type: 'doughnut',
                data: data
              });
            </script>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 dashboard-col">
        <div class="dashboard-card">
          <div class="card-header">
            <h5 class="card-header-title">Dashboard</h5>
          </div>
          <div class="card-body">
            <ul class="list-group">
              <li class="list-group-item">An item</li>
              <li class="list-group-item">A second item</li>
              <li class="list-group-item">A third item</li>
              <li class="list-group-item">A fourth item</li>
              <li class="list-group-item">And a fifth one</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
