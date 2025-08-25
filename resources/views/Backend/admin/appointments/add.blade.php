<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add New Appointment</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    body {
        font-family: Arial, sans-serif;
        background: #f8f9fa;
        margin: 0;
        padding: 0;
    }
    .page-wrapper {
        padding: 40px 0;
    }
    .content {
        background: #fff;
        border-radius: 10px;
        padding: 30px;
        max-width: 900px;
        margin: auto;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .page-title {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 25px;
        text-align: center;
    }
    .col-sm-6 {
        margin-bottom: 20px;
        width: 48%;
        float: left;
        margin-right: 2%;
    }
    .col-sm-6:nth-child(2n) {
        margin-right: 0;
    }
    .card {
        border: 1px solid #ddd !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08) !important;
        overflow: hidden !important;
        margin-bottom: 20px;
    }
    .card-header {
        background-color: #00A8FF !important;
        color: #fff !important;
        font-weight: 600 !important;
        padding: 12px 15px !important;
        font-size: 16px !important;
        border-bottom: 1px solid #ddd !important;
    }
    .card-body {
        background-color: #fff;
        padding: 20px;
        overflow: hidden;
    }
    .input-group {
        display: flex;
        align-items: center;
        width: 100%;
    }
    .input-group-text {
        background: #eee;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-right: none;
        border-radius: 4px 0 0 4px;
    }
    .form-control {
        width: 100%;
        padding: 8px 10px;
        border: 1px solid #ccc;
        border-left: none;
        border-radius: 0 4px 4px 0;
    }
    textarea.form-control {
        border-radius: 4px;
        border-left: 1px solid #ccc;
    }
    .btn {
        padding: 10px 25px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .btn-primary {
        background: #00A8FF;
        color: #fff;
    }
    .text-center {
        text-align: center;
    }
    .clearfix::after {
        content: "";
        display: table;
        clear: both;
    }
  </style>
</head>
<body>

<div class="page-wrapper">
  <div class="content">
    <h4 class="page-title">Add New Appointment</h4>

    <form>

      <!-- Appointment Details -->
      <div class="card">
        <div class="card-header">Appointment Details</div>
        <div class="card-body clearfix">

          <!-- Patient -->
          <div class="col-sm-6">
            <label>Patient Name <span class="text-danger">*</span></label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-user-injured"></i></span>
              <select class="form-control" required>
                <option value="" disabled selected hidden>Select Patient</option>
                <option>Patient 1</option>
                <option>Patient 2</option>
              </select>
            </div>
          </div>

          <!-- Department -->
          <div class="col-sm-6">
            <label>Department <span class="text-danger">*</span></label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-stethoscope"></i></span>
              <select class="form-control" required>
                <option value="" disabled selected hidden>Select Department</option>
                <option>Cardiology</option>
                <option>Neurology</option>
              </select>
            </div>
          </div>

          <!-- Doctor -->
          <div class="col-sm-6">
            <label>Doctor <span class="text-danger">*</span></label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-user-md"></i></span>
              <select class="form-control" required>
                <option value="" disabled selected hidden>Select Doctor</option>
                <option>Dr. John</option>
                <option>Dr. Smith</option>
              </select>
            </div>
          </div>

          <!-- Time -->
          <div class="col-sm-6">
            <label>Appointment Time <span class="text-danger">*</span></label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-clock"></i></span>
              <select class="form-control" required>
                <option value="" disabled selected hidden>Select Appointment Time</option>
                <option>09:00</option>
                <option>09:30</option>
              </select>
            </div>
          </div>

          <!-- Day -->
          <div class="col-sm-6">
            <label>Appointment Day <span class="text-danger">*</span></label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
              <select class="form-control" required>
                <option value="" disabled selected hidden>Select Day</option>
                <option>Monday</option>
                <option>Tuesday</option>
              </select>
            </div>
          </div>

        </div>
      </div>

      <!-- Notes -->
      <div class="card">
        <div class="card-header">Notes</div>
        <div class="card-body">
          <div class="form-group">
            <label>Notes</label>
            <textarea class="form-control" rows="3"></textarea>
          </div>
        </div>
      </div>

      <div class="text-center" style="margin-top:20px;">
        <button type="submit" class="btn btn-primary">Add Appointment</button>
      </div>

    </form>
  </div>
</div>

</body>
</html>
