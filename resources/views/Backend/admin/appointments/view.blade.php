<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Appointments</title>
  <style>
    html, body {
      height: 100%;
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .page-wrapper {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      padding: 20px;
    }

    .content {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .table-responsive {
      overflow-x: auto;
      scrollbar-width: none;
    }
    .table-responsive::-webkit-scrollbar {
      display: none;
    }

    .table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    .table th, .table td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: center;
    }
    .table th {
      background: #f4f4f4;
    }

    .status-badge {
      min-width: 140px;
      display: inline-block;
      text-align: center;
      padding: 6px 12px;
      font-size: 15px;
      border-radius: 50px;
      color: #fff;
      font-weight: bold;
    }
    .Scheduled { background-color: #189de4; }
    .Completed { background-color: #15ef70; }
    .Cancelled { background-color: #f90d25; }

    .btn {
      padding: 6px 12px;
      border-radius: 5px;
      border: none;
      cursor: pointer;
      font-size: 14px;
    }
    .btn-success { background: #28a745; color: white; }
    .btn-primary { background: #007bff; color: white; }
    .btn-danger { background: #dc3545; color: white; }

    .page-title {
      font-size: 22px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .search-box {
      display: flex;
      gap: 15px;
      margin-bottom: 20px;
    }

    .search-box input, .search-box select {
      padding: 8px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="page-wrapper">
    <div class="content">

      <div class="row">
        <h4 class="page-title">View Appointments</h4>
      </div>

      <!-- Search -->
      <div class="search-box">
        <input type="text" placeholder="Search...">
        <select>
          <option>Patient Name</option>
          <option>Department Name</option>
          <option>Doctor Name</option>
          <option>Appointment Date</option>
          <option>Status</option>
        </select>
      </div>

      <!-- Table -->
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Id</th>
              <th>Patient Name</th>
              <th>Department Name</th>
              <th>Doctor Name</th>
              <th>Appointment Date</th>
              <th>Appointment Time</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- Example rows -->
            <tr>
              <td>1</td>
              <td>John Doe</td>
              <td>Cardiology</td>
              <td>Dr. Smith</td>
              <td>2025-08-24</td>
              <td>10:30</td>
              <td><span class="status-badge Scheduled">Scheduled</span></td>
              <td>
                <button class="btn btn-success">View</button>
                <button class="btn btn-primary">Edit</button>
                <button class="btn btn-danger">Delete</button>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>Jane Roe</td>
              <td>Neurology</td>
              <td>Dr. Brown</td>
              <td>2025-08-26</td>
              <td>12:00</td>
              <td><span class="status-badge Completed">Completed</span></td>
              <td>
                <button class="btn btn-success">View</button>
                <button class="btn btn-primary">Edit</button>
                <button class="btn btn-danger">Delete</button>
              </td>
            </tr>
            <tr>
              <td>3</td>
              <td>Mark Lee</td>
              <td>Oncology</td>
              <td>Dr. Wilson</td>
              <td>2025-08-28</td>
              <td>15:00</td>
              <td><span class="status-badge Cancelled">Cancelled</span></td>
              <td>
                <button class="btn btn-success">View</button>
                <button class="btn btn-primary">Edit</button>
                <button class="btn btn-danger">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</body>
</html>